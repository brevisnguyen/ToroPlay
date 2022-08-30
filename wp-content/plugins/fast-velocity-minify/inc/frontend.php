<?php

# Exit if accessed directly				
if (!defined('ABSPATH')){ exit(); }	

# functions needed only for frontend ###########

# must have for large strings processing during minification
@ini_set('pcre.backtrack_limit', 5000000); 
@ini_set('pcre.recursion_limit', 5000000); 

# our own minification libraries
include_once($fvm_var_inc_lib . DIRECTORY_SEPARATOR . 'raisermin' . DIRECTORY_SEPARATOR . 'minify.php');

# php simple html
# https://sourceforge.net/projects/simplehtmldom/
include_once($fvm_var_inc_lib . DIRECTORY_SEPARATOR . 'simplehtmldom' . DIRECTORY_SEPARATOR . 'simple_html_dom.php');

# PHP Minify [1.3.60] for CSS minification only
# https://github.com/matthiasmullie/minify
$fvm_var_inc_lib_mm = $fvm_var_inc_lib . DIRECTORY_SEPARATOR . 'matthiasmullie' . DIRECTORY_SEPARATOR;
include_once($fvm_var_inc_lib_mm . 'minify' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Minify.php');
include_once($fvm_var_inc_lib_mm . 'minify' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'CSS.php');
include_once $fvm_var_inc_lib_mm . 'minify'. DIRECTORY_SEPARATOR .'src'. DIRECTORY_SEPARATOR .'JS.php';
include_once $fvm_var_inc_lib_mm . 'minify'. DIRECTORY_SEPARATOR .'src'. DIRECTORY_SEPARATOR .'Exception.php';
include_once $fvm_var_inc_lib_mm . 'minify'. DIRECTORY_SEPARATOR .'src'. DIRECTORY_SEPARATOR .'Exceptions'. DIRECTORY_SEPARATOR .'BasicException.php';
include_once $fvm_var_inc_lib_mm . 'minify'. DIRECTORY_SEPARATOR .'src'. DIRECTORY_SEPARATOR .'Exceptions'. DIRECTORY_SEPARATOR .'FileImportException.php';
include_once $fvm_var_inc_lib_mm . 'minify'. DIRECTORY_SEPARATOR .'src'. DIRECTORY_SEPARATOR .'Exceptions'. DIRECTORY_SEPARATOR .'IOException.php';
include_once($fvm_var_inc_lib_mm . 'path-converter' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ConverterInterface.php');
include_once($fvm_var_inc_lib_mm . 'path-converter' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Converter.php');

################################################


# start buffering before template
function fvm_start_buffer() {
	if(fvm_can_minify_css() || fvm_can_minify_js() || fvm_can_process_html()) {
		ob_start('fvm_process_page', 0, PHP_OUTPUT_HANDLER_REMOVABLE);
	}
}

# process html
function fvm_process_page($html) {
	
	# get globals
	global $fvm_settings, $fvm_cache_paths, $fvm_urls;
	
	# get html into an object
	# https://simplehtmldom.sourceforge.io/manual.htm
	$html_object = fvm_str_get_html($html, false, true, 'UTF-8', false, PHP_EOL, ' ');

	# return early if html is not an object, or overwrite html into an object for processing
	if (!is_object($html_object)) {
		return $html . '<!-- simplehtmldom failed to process the html -->';
	} else {
		$html_src = $html;
		$html = $html_object;
	}
	
	# get globals
	global $fvm_settings, $fvm_urls;
				
	# defaults
	$tvers = get_option('fvm_last_cache_update', '0');
	$htmlpreloads = array();
	$htmlcssheader = array();
	$htmljsheader = array();
	$htmljsdefer = array();
	
	# only error possible for now
	$fvm_error = PHP_EOL . '<!-- ['.date('r').'] FVM has no write access for CSS / JS cache files under '. fvm_get_cache_location()['ch_url'] . ' -->'. PHP_EOL;
	
	
	# collect all link preload headers, skip amp
	if(fvm_is_amp_page() !== true) {
		
		# skip on web stories
		if(count($html->find('script[src*=cdn.ampproject.org]')) > 0) {
			return $html_src . DIRECTORY_SEPARATOR . '<!-- FVM ['.date('r').'] does not support AMP -->';
		}
		
		# add other preloads
		foreach($html->find('link[rel=preload]') as $tag) {
			$htmlpreloads[] = $tag->outertext;
			$tag->outertext = '';
		}
		
	}
	
	
	# START CSS PROCESSING
	if(fvm_can_minify_css()) {
		
		# defaults
		$fvm_styles = array();
		$allcss = array();
		$css_lowpriority_code = '';
		
		# start log
		$log = array();
		$css_total = 0;
		
		# start log
		$log[]= 'PAGE - '. fvm_get_uripath(true) . PHP_EOL . '---' . PHP_EOL;
		
							
		# exclude styles and link tags inside scripts, no scripts or html comments
		$excl = array();
		foreach($html->find('script link[rel=stylesheet], script style, noscript style, noscript link[rel=stylesheet], comment') as $element) {
			$excl[] = $element->outertext;
		}

		# collect all styles, but filter out if excluded
		foreach($html->find('link[rel=stylesheet], style') as $element) {
			if(!in_array($element->outertext, $excl)) {
				$allcss[] = $element;
			}
		}
		
		# START CSS LOOP
		foreach($allcss as $k=>$tag) {
			
			# mediatypes
			if(isset($tag->media)) {
			
				# Normalize mediatypes
				if($tag->media == 'screen' || $tag->media == 'screen, print' || strlen($tag->media) == 0) {
					$tag->media = 'all'; 
				}
				
				# Remove print styles
				if(isset($fvm_settings['css']['noprint']) && $fvm_settings['css']['noprint'] == true && $tag->media == 'print'){
					$tag->outertext = '';
					unset($allcss[$k]);
					continue;
				}
				
			} else {
				# must have
				$tag->media = 'all';
			}
			
			
			# START CSS FILES
			if($tag->tag == 'link' && isset($tag->href)) {
				
				# filter url
				$href = fvm_normalize_url($tag->href);
				
				# Ignore css files
				$ignore_css_merging = false;
				if(isset($fvm_settings['css']['ignore']) && !empty($fvm_settings['css']['ignore'])) {
					$arr = fvm_string_toarray($fvm_settings['css']['ignore']);
					if(is_array($arr) && count($arr) > 0) {
						foreach ($arr as $e) { 
							if(stripos($href, $e) !== false) {
								unset($allcss[$k]);
								continue 2;
							} 
						}
					}
				}			

				# Remove CSS files
				if(isset($fvm_settings['css']['remove']) && !empty($fvm_settings['css']['remove'])) {
					$arr = fvm_string_toarray($fvm_settings['css']['remove']);
					if(is_array($arr) && count($arr) > 0) {
						foreach ($arr as $e) { 
							if(stripos($href, $e) !== false) {
								$tag->outertext = '';
								unset($allcss[$k]);
								continue 2;
							} 
						}
					}
				}
				
				# css merging functionality
				if(isset($fvm_settings['css']['combine']) && $fvm_settings['css']['combine'] == true) {

					# download or fetch from transient, minified
					$css = fvm_get_css_from_file($tag);
					
					if($css !== false && is_array($css)) {
						
						# error
						if(isset($css['error'])) {
							$tag->outertext = '/* Error on '.$href.' : '.$css['error'].' */'. PHP_EOL . $tag->outertext;
							unset($allcss[$k]);
							continue;
						}
						
						# extract fonts and icons
						if(isset($fvm_settings['css']['fonts']) && $fvm_settings['css']['fonts'] == true) {
							$extract_fonts_arr = fvm_extract_fonts($css['code'], $href);
							$css_lowpriority_code.= '/* '.$href.' */'. PHP_EOL . $extract_fonts_arr['fonts'];
							$css_code = $extract_fonts_arr['code'];
						} else {
							$css_code = $css['code'];
						}
						
						
						# async from the list only
						if(isset($fvm_settings['css']['async']) && $fvm_settings['css']['async'] == true) {
							if(isset($fvm_settings['css']['async']) && !empty($fvm_settings['css']['async'])) {
								$arr = fvm_string_toarray($fvm_settings['css']['async']);
								if(is_array($arr) && count($arr) > 0) {
									foreach ($arr as $aa) { 
										if(stripos($href, $aa) !== false) {
											
											# save css for merging
											$fvm_styles[$tag->media]['async'][] = $css_code;
											
											# log
											$size = strlen($css['code']);
											$css_total = $css_total + $size;
											$log[] = '[CSS Async: '.str_pad(fvm_format_filesize($size), 9,' ',STR_PAD_LEFT).']'."\t".str_replace($fvm_urls['wp_site_url'], '', $css['url']). PHP_EOL;

											# finish early
											$tag->outertext = '';
											unset($allcss[$k]);
											continue 2;
											
										} 
									}
								}
							}
						}
						
						# else render block
						
						# save css for merging as fallback
						$fvm_styles[$tag->media]['block'][] = $css_code;
						
						# log
						$size = strlen($css['code']);
						$css_total = $css_total + $size;
						$log[] = '[CSS Block: '.str_pad(fvm_format_filesize($size), 9,' ',STR_PAD_LEFT).']'."\t".str_replace($fvm_urls['wp_site_url'], '', $css['url']). PHP_EOL;
						
						# finish early
						$tag->outertext = '';
						unset($allcss[$k]);
						continue;
						
					}
				}
				
				
				# minify individually, if enabled
				if(!isset($fvm_settings['css']['min_disable']) || (isset($fvm_settings['css']['min_disable'])&& $fvm_settings['css']['min_disable'] != true)) {
					
					# download or fetch from transient, minified
					$css = fvm_get_css_from_file($tag);
					
					if($css !== false && is_array($css)) {
						
						# error
						if(isset($css['error'])) {
							$tag->outertext = '/* Error on '.$href.' : '.$css['error'].' */'. PHP_EOL . $tag->outertext;
							unset($allcss[$k]);
							continue;
						}
						
						# extract fonts and icons
						if(isset($fvm_settings['css']['fonts']) && $fvm_settings['css']['fonts'] == true) {
							$extract_fonts_arr = fvm_extract_fonts($css['code'], $href);
							$css_lowpriority_code.= '/* '.$href.' */'. PHP_EOL . $extract_fonts_arr['fonts'];
							$css_code = $extract_fonts_arr['code'];
						} else {
							$css_code = $css['code'];
						}
						
						# empty files
						if(empty(trim($css_code))) {
							$tag->outertext = '';
							unset($allcss[$k]);
							continue;
						} else {
							$css_code = '/* '.$href.' */'. PHP_EOL . $css_code;
						}
							
						# generate url
						$ind_css_url = fvm_generate_min_url($href, $css['tkey'], 'css', $css_code);
						if($ind_css_url === false) { 
							return $html_src . $fvm_error;
						}
						
						# cdn
						if(isset($fvm_settings['cdn']['cssok']) && $fvm_settings['cdn']['cssok'] == true) {
							$ind_css_url = fvm_rewrite_cdn_url($ind_css_url);
						}
						
						# async from the list only
						if(isset($fvm_settings['css']['async']) && !empty($fvm_settings['css']['async'])) { 
							$arr = fvm_string_toarray($fvm_settings['css']['async']);
							if(is_array($arr) && count($arr) > 0) {
								foreach ($arr as $aa) { 
									if(stripos($href, $aa) !== false) {
										
										# async attributes
										$tag->rel = 'preload';
										$tag->as = 'style';
										$tag->onload = "this.rel='stylesheet';this.onload=null";
											
										# log
										$size = strlen($css['code']);
										$css_total = $css_total + $size;
										$log[] = '[CSS Async: '.str_pad(fvm_format_filesize($size), 9,' ',STR_PAD_LEFT).']'."\t".str_replace($fvm_urls['wp_site_url'], '', $css['url']). PHP_EOL;
										
										# finish early
										$tag->href = $ind_css_url;
										unset($allcss[$k]);
										continue 2;
										
									} 
								}
							}
						}

						# force render blocking for other files

						# http and html preload for render blocking css
						if(!isset($fvm_settings['css']['nopreload']) || (isset($fvm_settings['css']['nopreload']) && $fvm_settings['css']['nopreload'] != true)) {
							$htmlpreloads[] = '<link rel="preload" href="'.$ind_css_url.'" as="style" media="'.$tag->media.'" />';	
						}
						
						# log
						$size = strlen($css['code']);
						$css_total = $css_total + $size;
						$log[] = '[CSS Block: '.str_pad(fvm_format_filesize($size), 9,' ',STR_PAD_LEFT).']'."\t".str_replace($fvm_urls['wp_site_url'], '', $css['url']). PHP_EOL;
						
						# finish early
						$tag->href = $ind_css_url;
						unset($allcss[$k]);
						
					}
				}
			}
			# END CSS FILES
				
			
			# START STYLE TAGS
			if($tag->tag == 'style' && !isset($tag->href)) {
							
				# remove if empty
				if(strlen(trim($tag->innertext)) == 0) {
					$tag->outertext = '';
					unset($allcss[$k]);
					continue;
				}
				
				# default
				$css = $tag->innertext;
				
				# minify?
				if(!isset($fvm_settings['css']['min_disable_styles']) || (isset($fvm_settings['css']['min_disable_styles'])&& $fvm_settings['css']['min_disable_styles'] != true)) {
					$css = fvm_minify_css_string($css); 
				}
				
				# handle import rules
				$css = fvm_replace_css_imports($css);
				
				# simplify font face
				$arr = fvm_simplify_fontface($css);
				if($arr !== false && is_array($arr)) {
					$css = str_replace($arr['before'], $arr['after'], $css);
				}
								
				# extract fonts and icons
				if(isset($fvm_settings['css']['fonts']) && $fvm_settings['css']['fonts'] == true) {
					$extract_fonts_arr = fvm_extract_fonts($css);
					$css_lowpriority_code.= $extract_fonts_arr['fonts'];
					$css = $extract_fonts_arr['code'];
				}		
				
				# add filtered css code
				if(!empty($css)) {
					$tag->innertext = $css;
					unset($allcss[$k]);
					continue;
				}
				
			}			
			# END STYLE TAGS
			
		}
		# END CSS LOOP
		
		# START CSS LOG
		if(count($log) > 1) {
			$log[] = str_pad('-', 22, '-',STR_PAD_LEFT) . PHP_EOL;
			$log[] = '[CSS Total: '.str_pad(fvm_format_filesize($css_total), 9,' ',STR_PAD_LEFT).']' . PHP_EOL;
			$log[] = str_pad('-', 22, '-',STR_PAD_LEFT);
			fvm_save_log(array('type'=>'min','msg'=>implode('', $log)));
		}
		# END CSS LOG
			
		
		# START OPTIMIZED FONT DELIVERY
		if(!empty($css_lowpriority_code)) {
			
			# minify?
			if(!isset($fvm_settings['css']['min_disable']) || (isset($fvm_settings['css']['min_disable'])&& $fvm_settings['css']['min_disable'] != true)) {
				$css_lowpriority_code = fvm_minify_css_string($css_lowpriority_code); 
			}
			
			# save transient, if not yet saved
			$tkey = fvm_generate_hash_with_prefix(hash('sha256', $css_lowpriority_code), 'css');
			
			# generate url
			$css_fonts_url = fvm_generate_min_url('fonts', $tkey, 'css', $css_lowpriority_code);
			if($css_fonts_url === false) { 
				return $html_src . $fvm_error;
			}
				
				# cdn
				if(isset($fvm_settings['cdn']['cssok']) && $fvm_settings['cdn']['cssok'] == true) {
					$css_fonts_url = fvm_rewrite_cdn_url($css_fonts_url);
				}
				
				# preload
				$htmlcssheader[0] = '<link rel="preload" fetchpriority="low" id="fvmfonts-css" href="'.$css_fonts_url.'" as="style" media="all" onload="this.rel=\'stylesheet\';this.onload=null">';
				
			
		}		
		# END OPTIMIZED FONT DELIVERY
		
		# START COMBINING CSS
		if(is_array($fvm_styles) && count($fvm_styles) > 0) {
						
			# process mediatypes
			foreach ($fvm_styles as $mediatype=>$css_arr) {
				
				# process types, block or async
				foreach ($css_arr as $css_method=>$css_arr2) {

					# merge and hash
					$merged_css = implode(PHP_EOL, $css_arr2);
					$tkey = fvm_generate_hash_with_prefix(hash('sha256', $merged_css), 'css');
					
					# inline if small
					if(strlen($merged_css) < 15000 && $css_method == 'block') {
						$htmlcssheader[] = '<style type="text/css" media="'.$mediatype.'">'.$merged_css.'</style>';
						continue;
					}
					
					# url, preload, add
					$merged_css_url = fvm_generate_min_url('combined', $tkey, 'css', $merged_css);
					if($merged_css_url === false) { 
						return $html_src . $fvm_error;
					}
						
						# cdn
						if(isset($fvm_settings['cdn']['cssok']) && $fvm_settings['cdn']['cssok'] == true) {
							$merged_css_url = fvm_rewrite_cdn_url($merged_css_url);
						}
						
						# http, html preload + header
						if($css_method == 'block') {
							
							# add to header
							$htmlcssheader[] = '<link rel="stylesheet" href="'.$merged_css_url.'" media="'.$mediatype.'" />';
							
							# http and html preload for render blocking css
							if(!isset($fvm_settings['css']['nopreload']) || (isset($fvm_settings['css']['nopreload']) && $fvm_settings['css']['nopreload'] != true)) {
								$htmlpreloads[] = '<link rel="preload" href="'.$merged_css_url.'" as="style" media="'.$mediatype.'"  />';
							}
							
						} else {
							
							# async
							$htmlcssheader[] = '<link rel="preload" as="style" href="'.$merged_css_url.'" media="'.$mediatype.'" onload="this.rel=\'stylesheet\'" />';
						
						}
					
				}
			}
		}
		# END COMBINING CSS

	}
	# END CSS PROCESSING
	
	
	# START JS PROCESSING
	if(fvm_can_minify_js()) {

		# defaults
		$scripts_duplicate_check = array();
		$fvm_scripts_header = array();
		$fvm_scripts_defer = array();
		
		# start log
		$log = array();
		$js_total = 0;
		
		# start log
		$log[]= 'PAGE - '. fvm_get_uripath(true) . PHP_EOL . '---' . PHP_EOL;
		
		# get all scripts
		$allscripts = array();
		foreach($html->find('script') as $element) {
			$allscripts[] = $element;
		}
				
		# START JS LOOP
		if (is_array($allscripts) && count($allscripts) > 0) {
			foreach($allscripts as $k=>$tag) {
				
				# handle application/ld+json or application/json before anything else
				if(isset($tag->type) && ($tag->type == 'application/ld+json' || $tag->type == 'application/json')) {
					
					# minify
					if(isset($fvm_settings['js']['js_enable_min_inline']) && $fvm_settings['js']['js_enable_min_inline'] == true) { $tag->innertext = fvm_minify_microdata($tag->innertext); }
					
					# remove
					unset($allscripts[$k]);
					continue;
				}
				
				# skip unknown script types
				if(isset($tag->type) && $tag->type != 'text/javascript') { 
					unset($allscripts[$k]);
					continue;
				}
				
				# remove default script type
				if(isset($tag->type) && $tag->type == 'text/javascript') { unset($tag->type); }
				
				# START JS FILES
				if(isset($tag->src)) {
					
					# filter url
					$href = fvm_normalize_url($tag->src);
					
					# ignore js files
					if(isset($fvm_settings['js']['ignore']) && !empty($fvm_settings['js']['ignore'])) {
						$arr = fvm_string_toarray($fvm_settings['js']['ignore']);
						if(is_array($arr) && count($arr) > 0) {
							foreach ($arr as $a) { 
								if(stripos($tag->src, $a) !== false) {
									unset($allscripts[$k]);
									continue 2;
								} 
							}
						}
					}
					
					# remove js files
					if(isset($fvm_settings['js']['remove']) && !empty($fvm_settings['js']['remove'])) {
						$arr = fvm_string_toarray($fvm_settings['js']['remove']);
						if(is_array($arr) && count($arr) > 0) {
							foreach ($arr as $a) { 
								if(stripos($tag->src, $a) !== false) {
									$tag->outertext = '';
									unset($allscripts[$k]);
									continue 2;
								} 
							}
						}
					}

					
					# JS files to delay until user interaction (unmergeable)
					if(isset($fvm_settings['js']['thirdparty']) && !empty($fvm_settings['js']['thirdparty'])) {
						$arr = fvm_string_toarray($fvm_settings['js']['thirdparty']);
						if(is_array($arr) && count($arr) > 0) {
							foreach ($arr as $ac) { 
								if(stripos($tag->src, $ac) !== false) {
									
									# unique identifier
									$uid = fvm_generate_hash_with_prefix(hash('sha256', $tag->outertext), 'js');
									
									# remove exact duplicates, or replace transformed tag
									if(isset($scripts_duplicate_check[$uid])) {
										$tag->outertext = '';
									} else { 
										$tag->type = 'fvmdelay';
										$scripts_duplicate_check[$uid] = $uid;
									}					
									
									# mark as processed, unset and break inner loop
									unset($allscripts[$k]);
									continue 2;
									
								} 
							}
						}
					}
					
					
					# START MERGING JS
					if(isset($fvm_settings['js']['combine']) && $fvm_settings['js']['combine'] == true) {
											
						# force render blocking
						if(isset($fvm_settings['js']['merge_header']) && !empty($fvm_settings['js']['merge_header'])) {
							$arr = fvm_string_toarray($fvm_settings['js']['merge_header']);
							if(is_array($arr) && count($arr) > 0) {
								foreach ($arr as $aa) { 
									if(stripos($tag->src, $aa) !== false) {
										
										# download or fetch from transient, minified
										$js = fvm_get_js_from_file($tag);
										if($js !== false && is_array($js)) {
											
											# error
											if(isset($js['error'])) {
												$tag->outertext = '/* Error on '.$href.' : '.$js['error'].' */'. PHP_EOL . $tag->outertext;
												unset($allscripts[$k]);
												continue 2;
											}
										
											# save js for merging
											$fvm_scripts_header[] = $js['code'];
											
											# log
											$size = strlen($js['code']);
											$js_total = $js_total + $size;
											$log[] = '[JS Block: '.str_pad(fvm_format_filesize($size), 9,' ',STR_PAD_LEFT).']'."\t".str_replace($fvm_urls['wp_site_url'], '', $js['url']). PHP_EOL;
																						
											# remove from html
											$tag->outertext = '';
											unset($allscripts[$k]);
											continue 2;
																						
										}
									} 
								}
							}
						}
						
						# force defer
						if(isset($fvm_settings['js']['merge_defer']) && !empty($fvm_settings['js']['merge_defer'])) {
							$arr = fvm_string_toarray($fvm_settings['js']['merge_defer']);
							if(is_array($arr) && count($arr) > 0) {
								foreach ($arr as $aa) { 
									if(stripos($tag->src, $aa) !== false) {
										
										# download or fetch from transient, minified
										$js = fvm_get_js_from_file($tag);
										if($js !== false && is_array($js)) {
											
											# error
											if(isset($js['error'])) {
												$tag->outertext = '/* Error on '.$href.' : '.$js['error'].' */'. PHP_EOL . $tag->outertext;
												unset($allscripts[$k]);
												continue 2;
											}
										
											# save js for merging
											$fvm_scripts_defer[] = $js['code'];
											
											# log
											$size = strlen($js['code']);
											$js_total = $js_total + $size;
											$log[] = '[JS Defer: '.str_pad(fvm_format_filesize($size), 9,' ',STR_PAD_LEFT).']'."\t".str_replace($fvm_urls['wp_site_url'], '', $js['url']). PHP_EOL;
										
											# remove from html
											$tag->outertext = '';
											unset($allscripts[$k]);
											continue 2;
											
										}
									} 
								}
							}
						}
								
						# jquery needs to load earlier, if not being merged (while merging is active)
						if(stripos($tag->src, '/jquery.js') !== false || stripos($tag->src, '/jquery.min.js') !== false || stripos($tag->src, '/jquery-migrate') !== false) {
							
							# http and html preload for render blocking js
							if(!isset($fvm_settings['js']['nopreload']) || (isset($fvm_settings['js']['nopreload']) && $fvm_settings['js']['nopreload'] != true)) {
								$htmlpreloads[] = '<link rel="preload" href="'.$href.'" as="script" />';
							}
							
							# header
							if(stripos($tag->src, '/jquery-migrate') !== false) {
								$htmljsheader[1] = "<script data-cfasync='false' src='".$href."'></script>"; # jquery migrate
							} else {
								$htmljsheader[0] = "<script data-cfasync='false' src='".$href."'></script>"; # jquery
							}
							
							# content
							$tag->outertext = '';
							unset($allscripts[$k]);
							continue;
						}
						
					}
					# END MERGING JS
					
					
					# START INDIVIDUAL JS MINIFICATION	
					# minify individually, if enabled
					if(!isset($fvm_settings['js']['min_disable']) || (isset($fvm_settings['js']['min_disable'])&& $fvm_settings['js']['min_disable'] != true)) {
						
						# skip third party scripts, unless allowed
						$allowed = array($fvm_urls['wp_domain'], '/ajax.aspnetcdn.com/ajax/', '/ajax.googleapis.com/ajax/libs/',  '/cdnjs.cloudflare.com/ajax/libs/');
						if(str_replace($allowed, '', $href) == $href) {
							unset($allscripts[$k]);
							continue;
						}
						
						# force render blocking
						if(isset($fvm_settings['js']['merge_header']) && !empty($fvm_settings['js']['merge_header'])) {
							$arr = fvm_string_toarray($fvm_settings['js']['merge_header']);
							if(is_array($arr) && count($arr) > 0) {
								foreach ($arr as $aa) { 
									if(stripos($tag->src, $aa) !== false) {
										
										# download or fetch from transient, minified
										$js = fvm_get_js_from_file($tag);
										if($js !== false && is_array($js)) {
											
											# error
											if(isset($js['error'])) {
												$tag->outertext = '/* Error on '.$href.' : '.$js['error'].' */'. PHP_EOL . $tag->outertext;
												unset($allscripts[$k]);
												continue 2;
											}
										
											# generate url
											$ind_js_url = fvm_generate_min_url($tag->src, $js['tkey'], 'js', $js['code']);
											if($ind_js_url === false) { 
												return $html_src . $fvm_error;
											}
											
											# cdn
											if(isset($fvm_settings['cdn']['jsok']) && $fvm_settings['cdn']['jsok'] == true) {
												$ind_js_url = fvm_rewrite_cdn_url($ind_js_url);
											}
											
											# render block
											if(isset($tag->async)) { unset($tag->async); }
											if(isset($tag->defer)) { unset($tag->defer); }
											
											# http and html preload for render blocking scripts
											if(!isset($fvm_settings['js']['nopreload']) || (isset($fvm_settings['js']['nopreload']) && $fvm_settings['js']['nopreload'] != true)) {
												$htmlpreloads[] = '<link rel="preload" href="'.$ind_js_url.'" as="script" />';
											}
											
											# log
											$size = strlen($js['code']);
											$js_total = $js_total + $size;
											$log[] = '[JS Block: '.str_pad(fvm_format_filesize($size), 9,' ',STR_PAD_LEFT).']'."\t".str_replace($fvm_urls['wp_site_url'], '', $js['url']). PHP_EOL;
											
											# finish early
											$tag->src = $ind_js_url;												
											unset($allscripts[$k]);
											continue 2;
											
										}
									} 
								}
							}
						}
						
						# force defer
						if(isset($fvm_settings['js']['merge_defer']) && !empty($fvm_settings['js']['merge_defer'])) {
							$arr = fvm_string_toarray($fvm_settings['js']['merge_defer']);
							if(is_array($arr) && count($arr) > 0) {
								foreach ($arr as $aa) { 
									if(stripos($tag->src, $aa) !== false) {
										
										# download or fetch from transient, minified
										$js = fvm_get_js_from_file($tag);
										if($js !== false && is_array($js)) {
											
											# error
											if(isset($js['error'])) {
												$tag->outertext = '/* Error on '.$href.' : '.$js['error'].' */'. PHP_EOL . $tag->outertext;
												unset($allscripts[$k]);
												continue 2;
											}
										
											# generate url
											$ind_js_url = fvm_generate_min_url($tag->src, $js['tkey'], 'js', $js['code']);
											if($ind_js_url === false) { 
												return $html_src . $fvm_error;
											}
											
											# cdn
											if(isset($fvm_settings['cdn']['jsok']) && $fvm_settings['cdn']['jsok'] == true) {
												$ind_js_url = fvm_rewrite_cdn_url($ind_js_url);
											}
											
											# add defer
											if(!isset($tag->defer)) { $tag->defer = 'defer'; }
																						
											# log
											$size = strlen($js['code']);
											$js_total = $js_total + $size;
											$log[] = '[JS Defer: '.str_pad(fvm_format_filesize($size), 9,' ',STR_PAD_LEFT).']'."\t".str_replace($fvm_urls['wp_site_url'], '', $js['url']). PHP_EOL;
											
											# finish early
											$tag->src = $ind_js_url;												
											unset($allscripts[$k]);
											continue 2;
											
										}
									} 
								}
							}
						}
						
						# remove unprocessed scripts from loop
						unset($allscripts[$k]);
						continue;
					}	
					# END INDIVIDUAL JS MINIFICATION	
									
				}
				# END JS FILES
				
				
				# START INLINED SCRIPTS
				if(!isset($tag->src)) {
									
					# remove if empty
					if(strlen(trim($tag->innertext)) == 0) {
						$tag->outertext = '';
						unset($allcss[$k]);
						continue;
					}
					
					# default
					$js = ''; $js = $tag->innertext;
					
					# minify?
					if(!isset($fvm_settings['js']['min_disable_inline']) || (isset($fvm_settings['js']['min_disable_inline'])&& $fvm_settings['js']['min_disable_inline'] != true)) {
						$js = PHP_EOL . fvm_maybe_minify_js($js, null, true) . PHP_EOL;
					}
					
					# delay inline scripts until user interaction (unmergeable)
					if(isset($fvm_settings['js']['thirdparty']) && !empty($fvm_settings['js']['thirdparty'])) {
						$arr = fvm_string_toarray($fvm_settings['js']['thirdparty']);
						if(is_array($arr) && count($arr) > 0) {
							foreach ($arr as $b) {
								if(stripos($js, $b) !== false || stripos($js, $b) !== false) {
									
									# delay
									$tag->type = 'fvmdelay';
									
									# minified
									if(!empty($js)) {
										$tag->innertext = $js;
									}
									
									# unset
									unset($allscripts[$k]);
									continue 2;
								}
							}
						}
					}

					# defer inline scripts
					if(isset($fvm_settings['js']['defer_dependencies']) && !empty($fvm_settings['js']['defer_dependencies'])) {
						$arr = fvm_string_toarray($fvm_settings['js']['defer_dependencies']);
						if(is_array($arr) && count($arr) > 0) {
							foreach ($arr as $b) {
								if((stripos($js, $b) !== false || stripos($js, $b) !== false) && !isset($tag->src)) {
									
									# defer and rawurlencode
									# jquery document ready needs to execute before deferred scripts
									if(!empty($js) && stripos($js, ').ready(') === false) {
										$tag->src = 'data:application/javascript,'.rawurlencode($js);					
										$tag->innertext = '';
									}
																		
									# unset
									unset($allscripts[$k]);
									continue 2;
								}
							}
						}
					}					
				}
				# END INLINED SCRIPTS
							
			}
		}
		# END JS LOOP
	
	
		# START JS LOG
		if(count($log) > 1) {
			$log[] = str_pad('-', 21, '-',STR_PAD_LEFT) . PHP_EOL;
			$log[] = '[JS Total: '.str_pad(fvm_format_filesize($js_total), 9,' ',STR_PAD_LEFT).']' . PHP_EOL;
			$log[] = str_pad('-', 21, '-',STR_PAD_LEFT);
			fvm_save_log(array('type'=>'min','msg'=>implode('', $log)));
		}
		# END JS LOG
	
		# START COMBINING JS
		
		# header scripts
		if(is_array($fvm_scripts_header) && count($fvm_scripts_header) > 0) {
			
			# merge code, hash
			$merged_js = implode(PHP_EOL, $fvm_scripts_header);
			$tkey = fvm_generate_hash_with_prefix(hash('sha256', $merged_js), 'js');
						
			# generate url
			$merged_js_url = fvm_generate_min_url('combined', $tkey, 'js', $merged_js);
			if($merged_js_url === false) { 
				return $html_src . $fvm_error;
			}
				
				# cdn
				if(isset($fvm_settings['cdn']['jsok']) && $fvm_settings['cdn']['jsok'] == true) {
					$merged_js_url = fvm_rewrite_cdn_url($merged_js_url);
				}
				
				# http and html preload for render blocking scripts
				if(!isset($fvm_settings['js']['nopreload']) || (isset($fvm_settings['js']['nopreload']) && $fvm_settings['js']['nopreload'] != true)) {
					$htmlpreloads[] = '<link rel="preload" href="'.$merged_js_url.'" as="script" />';
				}
				
				# add to header
				$htmljsheader[] = "<script data-cfasync='false' src='".$merged_js_url."'></script>";

		}
		
		# deferred scripts
		if(is_array($fvm_scripts_defer) && count($fvm_scripts_defer) > 0) {
			
			# merge code, hash
			$merged_js = implode(PHP_EOL, $fvm_scripts_defer);
			$tkey = fvm_generate_hash_with_prefix(hash('sha256', $merged_js), 'js');
						
			# generate url
			$merged_js_url = fvm_generate_min_url('combined', $tkey, 'js', $merged_js);
			if($merged_js_url === false) { 
				return $html_src . $fvm_error;
			}
				
				# cdn
				if(isset($fvm_settings['cdn']['jsok']) && $fvm_settings['cdn']['jsok'] == true) {
					$merged_js_url = fvm_rewrite_cdn_url($merged_js_url);
				}
				
				# header, no preload for deferred files
				$htmljsheader[] = "<script defer='defer' src='".$merged_js_url."'></script>";
				
		}
		
	}
	# END JS PROCESSING
	
	
	
	# process HTML minification, if not disabled ###############################	
	if(fvm_can_process_html()) {		
			
		# Remove HTML comments and IE conditionals
		if(isset($fvm_settings['html']['nocomments']) && $fvm_settings['html']['nocomments'] == true) {
			foreach($html->find('comment') as $element) {
				 $element->outertext = '';
			}
		}
		
		# Remove generator tags
		if(isset($fvm_settings['html']['cleanup_header']) && $fvm_settings['html']['cleanup_header'] == true) {
			
			# remove
			foreach($html->find('head meta[name=generator], head link[rel=shortlink], head link[rel=dns-prefetch], head link[rel=preconnect], head link[rel=prefetch], head link[rel=prerender], head meta[name*=msapplication], head link[rel=apple-touch-icon], head link[rel=EditURI], head link[rel=preconnect], head link[rel=wlwmanifest], head link[rel=https://api.w.org/], head link[href*=/wp-json/], head link[rel=pingback], head link[type=application/json+oembed], head link[type=text/xml+oembed]') as $element) {
				 $element->outertext = '';
			}
			
			# allow only the last link[rel=icon]
			$ic = array(); $ic = $html->find('head link[rel=icon]');
			$i = 1; $len = count($ic);
			if($len > 1) {
				foreach($ic as $element) {
					if ($i != $len) { $element->outertext = ''; } $i++; # delete except if last
				}
			}
		}
	
	}
	
	# build extra head and footer ###############################	
	
	# header and footer markers
	$hm = '<!-- h_preheader --><!-- h_header_function -->';
	$hm_late = '<!-- h_cssheader --><!-- h_jsheader -->';
	$fm = '<!-- h_footer_fvm_scripts -->';
	
	# add our function to head
	if(fvm_can_minify_css() || fvm_can_minify_js()) { 
		$hm = fvm_add_header_function($hm);
	}
		
	# remove charset meta tag and collect it to first position
	if(!is_null($html->find('meta[charset]', 0))) {
		$hm = str_replace('<!-- h_preheader -->', $html->find('meta[charset]', 0)->outertext.'<!-- h_preheader -->', $hm);
		foreach($html->find('meta[charset]') as $element) { $element->outertext = ''; }
	}
	
	# remove other meta tag and collect them between preload and css/js files
	foreach($html->find('head meta, head title, head link[rel=canonical], head link[rel=alternate], head link[rel=pingback], head script[type=application/ld+json]') as $element) { 
		$hm_late = str_replace('<!-- h_cssheader -->', $element->outertext.'<!-- h_cssheader -->', $hm_late);
		$element->outertext = ''; 
	}
	
	# preload headers, by fetchpriority attribute
	if(is_array($htmlpreloads)) {
		
		# deduplicate
		$htmlpreloads = array_unique($htmlpreloads);
		
		# get values
		$pre_html = array_values($htmlpreloads); 
		
		# add preload html header
		if(count($pre_html) > 0) {
			$hm = str_replace('<!-- h_preheader -->', implode(PHP_EOL, $pre_html).'<!-- h_preheader -->', $hm);
		}
		
	}
		
	# add stylesheets
	if(isset($htmlcssheader)) {
		if(is_array($htmlcssheader) && count($htmlcssheader) > 0) {
			ksort($htmlcssheader); # priority
			$hm_late = str_replace('<!-- h_cssheader -->', implode(PHP_EOL, $htmlcssheader).'<!-- h_cssheader -->', $hm_late);
		}
	}
	
	# add header scripts
	if(isset($htmljsheader)) {
		if(is_array($htmljsheader) && count($htmljsheader) > 0) {
			ksort($htmljsheader); # priority
			$hm_late = str_replace('<!-- h_jsheader -->', implode(PHP_EOL, $htmljsheader).'<!-- h_jsheader -->', $hm_late);
		}
	}
	
	# add defer scripts
	if(isset($htmljscodedefer)) {
		if(is_array($htmljscodedefer) && count($htmljscodedefer) > 0) {
			ksort($htmljscodedefer); # priority
			$hm_late = str_replace('<!-- h_jsheader -->', implode(PHP_EOL, $htmljscodedefer), $hm_late);
		}
	}
	
	# add fvm_footer scripts, if enabled
	if(fvm_can_minify_js()) { 
		$fm = fvm_add_footer_function($fm);
	}	
			
	# cleanup leftover markers
	$hm = str_replace(array('<!-- h_preheader -->', '<!-- h_header_function -->'), '', $hm); 
	$hm_late = str_replace(array('<!-- h_cssheader -->', '<!-- h_jsheader -->'), '', $hm_late);
	$fm = str_replace('<!-- h_footer_fvm_scripts -->', '', $fm);
	
	# append header and footer
	if(!is_null($html->find('head', 0)) && !is_null($html->find('body', -1))) {
		if(!is_null($html->find('head', 0)->first_child()) && !is_null($html->find('body', -1)->last_child())) {
			$html->find('head', 0)->first_child()->outertext = $hm . $html->find('head', 0)->first_child()->outertext . $hm_late;
			$html->find('body', -1)->last_child()->outertext = $html->find('body', -1)->last_child ()->outertext . $fm;
		}
	}
	
	
	# convert html object to string, save all objects to string
	$html = trim($html->save());
	
	# process cdn optimization
	if(fvm_can_process_cdn()) { 
		$html = fvm_process_cdn($html);
	}
	
	# minify remaining HTML at the end, if enabled
	if(fvm_can_process_html()) {
		if(!isset($fvm_settings['html']['min_disable']) || (isset($fvm_settings['html']['min_disable']) && $fvm_settings['html']['min_disable'] != true)) {
			$html = fvm_raisermin_html($html);
		}
	}
	
	# filter final html if needed
	if(function_exists('fvm_filter_final_html')) {
		$html = fvm_filter_final_html($html);
	}
	
	# return html
	return $html;
	
}

