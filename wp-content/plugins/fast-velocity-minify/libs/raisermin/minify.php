<?php
/**
*
* Website: https://wpraiser.com/
* Author: Raul Peixoto (https://www.upwork.com/fl/raulpeixoto)
* Licensed under GPLv2 (or later)
* Version 1.0
*
* Usage: fvm_raisermin_js($js);
*
*/

# Exit if accessed directly				
if (!defined('ABSPATH')){ exit(); }	

# minify js, whitespace only
function fvm_raisermin_js($code){

	# remove // comments
	$code = preg_replace('/(^|\s)\/\/(.*)\n/m', '', $code);
	$code = preg_replace('/(\{|\}|\[|\]|\(|\)|\;)\/\/(.*)\n/m', '$1', $code);
	
	# remove /* ... */ comments
	$code = preg_replace('/(^|\s)\/\*(.*)\*\//Us', '', $code);
	$code = preg_replace('/(\;|\{)\/\*(.*)\*\//Us', '$1', $code);

	# remove sourceMappingURL
	$code = preg_replace('/(\/\/\s*[#]\s*sourceMappingURL\s*[=]\s*)([a-zA-Z0-9-_\.\/]+)(\.map)/ui', '', $code);
	
	# uniform line endings, make them all line feed
	$code = str_replace(array("\r\n", "\r"), "\n", $code);

	# collapse all non-line feed whitespace into a single space
	$code = preg_replace('/[^\S\n]+/', ' ', $code);

	# strip leading & trailing whitespace
	$code = str_replace(array(" \n", "\n "), "\n", $code);

	# collapse consecutive line feeds into just 1
	$code = preg_replace('/\n+/', "\n", $code);
			
	# process horizontal space
	$code = preg_replace('/([\[\]\(\)\{\}\;\<\>])(\h+)([\[\]\(\)\{\}\;\<\>])/ui', '$1 $3', $code);
	$code = preg_replace('/([\)])(\h?)(\.)/ui', '$1$3', $code);
	$code = preg_replace('/([\)\?])(\h?)(\.)/ui', '$1$3', $code);
	$code = preg_replace('/(\,)(\h+)/ui', '$1 ', $code);
	$code = preg_replace('/(\h+)(\,)/ui', ' $2', $code);
	$code = preg_replace('/([if])(\h+)(\()/ui', '$1$3', $code);
			
	# trim whitespace on beginning/end
	return trim($code);
}


# remove UTF8 BOM
function fvm_min_remove_utf8_bom($text) {
    $bom = pack('H*','EFBBBF');
	while (preg_match("/^$bom/", $text)) {
		$text = preg_replace("/^$bom/ui", '', $text);
	}
    return $text;
}




# minify html, don't touch certain tags
function fvm_raisermin_html($html) {

	# clone
	$content = $html;
		
	# get all scripts
	$skp = array();
	preg_match_all('/(\<script(.*?)\<(\s*)\/script(\s*)\>|\<noscript(.*?)\<(\s*)\/noscript(\s*)\>|\<code(.*?)\<(\s*)\/code(\s*)\>|\<pre(.*?)\<(\s*)\/pre(\s*)\>)/uis', $html, $skp);
	
	# replace all skippable patterns with comment
	if(is_array($skp) && isset($skp[0]) && count($skp[0]) > 0) {
		foreach ($skp[0] as $k=>$v) {
			$content = str_replace($v, '<!-- SKIP '.$k.' -->', $content);
		}
	}
	
	# remove line breaks, and colapse two or more white spaces into one
	$content = preg_replace('/\s+/u', " ", $content);
	
	# add linebreaks after html and head tags, for readability
	$content = str_replace('<head>',  PHP_EOL . '<head>' . PHP_EOL, $content);
	$content = str_replace('</head>',  PHP_EOL . '</head>' . PHP_EOL, $content);
	$content = str_replace('<html',  PHP_EOL . '<html', $content);
	$content = str_replace('</html>',  PHP_EOL . '</html>', $content);
	
	# final readability adjustments
	$content = str_replace('<meta ',  PHP_EOL . '<meta ', $content);
	$content = str_replace('<link ',  PHP_EOL . '<link ', $content);
	$content = str_replace('<style',  PHP_EOL . '<style', $content);
	$content = str_replace('<noscript',  PHP_EOL . '<noscript>', $content);
	
	# replace markers for scripts last		
	if(is_array($skp) && isset($skp[0]) && count($skp[0]) > 0) {
		foreach ($skp[0] as $k=>$v) {
			$content = str_replace('<!-- SKIP '.$k.' -->',  PHP_EOL . $v . PHP_EOL, $content);
		}
	}

	# no empty lines
	$lines = explode(PHP_EOL, $content);
	foreach($lines as $k=>$ln) { $ln = ltrim($ln); if(empty($ln)) { unset($lines[$k]); } else { $lines[$k] = $ln; } }
	$content = implode(PHP_EOL, $lines);
		
	# save as html, if not empty
	if(!empty($content)) {
		$html = $content;
	}
			
	# return
	return $html;
}
