<?php if( $active_tab == 'settings' ) { ?>
<div class="fvm-wrapper">

<form method="post" id="fvm-save-changes">
			
<?php
	# nounce
	wp_nonce_field('fvm_settings_nonce', 'fvm_settings_nonce');
?>

<h2 class="title"><?php _e( 'Global Settings', 'fast-velocity-minify' ); ?></h2>
<h3 class="fvm-bold-green"><?php _e( 'Settings that affect the plugin and are not specific to speed optimization.', 'fast-velocity-minify' ); ?></h3>

<table class="form-table fvm-settings">
<tbody>

<tr>
<th scope="row"><?php _e( 'Global Options', 'fast-velocity-minify' ); ?></th>
<td>
<p class="fvm-bold-green fvm-rowintro"><?php _e( 'Handle with Care', 'fast-velocity-minify' ); ?></p>

<fieldset>
<label for="fvm_settings_cache_min_instant_purge">
<input name="fvm_settings[cache][min_instant_purge]" type="checkbox" id="fvm_settings_cache_min_instant_purge" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'cache', 'min_instant_purge')); ?>>
<?php _e( 'Purge Minified CSS/JS files instantly', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'CSS & JS cache files are preserved for 7 days by default, for better compatibility with certain hosting providers.', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

</fieldset></td>
</tr>

</tbody>
</table>


<h2 class="title"><?php _e( 'HTML Settings', 'fast-velocity-minify' ); ?></h2>
<h3 class="fvm-bold-green"><?php _e( 'Optimize your HTML and remove some clutter from the HTML page.', 'fast-velocity-minify' ); ?></h3>

<table class="form-table fvm-settings">
<tbody>

<tr>
<th scope="row"><?php _e( 'HTML Options', 'fast-velocity-minify' ); ?></th>
<td>
<p class="fvm-bold-green fvm-rowintro"><?php _e( 'Recommended Settings', 'fast-velocity-minify' ); ?></p>

<fieldset>
<label for="fvm_settings_html_enable">
<input name="fvm_settings[html][enable]" type="checkbox" id="fvm_settings_html_enable" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'html', 'enable')); ?>>
<?php _e( 'Enable HTML Processing', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will enable processing for the settings below', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

<label for="fvm_settings_html_nocomments">
<input name="fvm_settings[html][nocomments]" type="checkbox" id="fvm_settings_html_nocomments" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'html', 'nocomments')); ?>>
<?php _e( 'Strip HTML Comments', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will strip HTML comments from your HTML page', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

<label for="fvm_settings_html_cleanup_header">
<input name="fvm_settings[html][cleanup_header]" type="checkbox" id="fvm_settings_html_cleanup_header" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'html', 'cleanup_header')); ?>>
<?php _e( 'Cleanup Header', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Removes resource hints, generator tag, shortlinks, manifest link, etc', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

<label for="fvm_settings_html_disable_emojis">
<input name="fvm_settings[html][disable_emojis]" type="checkbox" id="fvm_settings_html_disable_emojis" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'html', 'disable_emojis')); ?>>
<?php _e( 'Remove Emoji', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Removes the default emoji scripts and styles that come with WordPress', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

</fieldset></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Advanced HTML Options', 'fast-velocity-minify' ); ?></th>
<td>
<p class="fvm-bold-green fvm-rowintro"><?php _e( 'Handle with Care', 'fast-velocity-minify' ); ?></p>

<fieldset>
<label for="fvm_settings_html_min_disable">
<input name="fvm_settings[html][min_disable]" type="checkbox" id="fvm_settings_html_min_disable" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'html', 'min_disable')); ?>>
<?php _e( 'Disable HTML Minification', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will disable HTML minification for compatibility purposes', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

</fieldset></td>
</tr>

</tbody>
</table>

<div style="height: 60px;"></div>
<h2 class="title"><?php _e( 'CSS Settings', 'fast-velocity-minify' ); ?></h2>
<h3 class="fvm-bold-green"><?php _e( 'Optimize your CSS and Styles settings.', 'fast-velocity-minify' ); ?></h3>

<table class="form-table fvm-settings">
<tbody>

<tr>
<th scope="row"><?php _e( 'CSS Options', 'fast-velocity-minify' ); ?></th>
<td>
<p class="fvm-bold-green fvm-rowintro"><?php _e( 'Recommended Settings', 'fast-velocity-minify' ); ?></p>

<fieldset>
<label for="fvm_settings_css_enable">
<input name="fvm_settings[css][enable]" type="checkbox" id="fvm_settings_css_enable" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'css', 'enable')); ?>>
<?php _e( 'Enable CSS Processing', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will enable processing for the settings below', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

<label for="fvm_settings_css_fonts">
<input name="fvm_settings[css][fonts]" type="checkbox" id="fvm_settings_css_fonts" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'css', 'fonts')); ?>>
<?php _e( 'Merge Fonts and Icons separately', 'fast-velocity-minify' ); ?><span class="note-info">[ <?php _e( 'Will merge fonts and icons into a separate CSS file', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

<label for="fvm_settings_css_noprint">
<input name="fvm_settings[css][noprint]" type="checkbox" id="fvm_settings_css_noprint" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'css', 'noprint')); ?>>
<?php _e( 'Remove "Print" CSS files', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will remove CSS files of mediatype "print" from the frontend', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

</fieldset></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Advanced CSS Options', 'fast-velocity-minify' ); ?></th>
<td>
<p class="fvm-bold-green fvm-rowintro"><?php _e( 'Handle with Care', 'fast-velocity-minify' ); ?></p>

<fieldset>

<label for="fvm_settings_css_combine">
<input name="fvm_settings[css][combine]" type="checkbox" id="fvm_settings_css_combine" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'css', 'combine')); ?>>
<?php _e( 'Combine CSS Files', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Deprecated: Will combine all CSS files by mediatype groups in the header (no longer recommended for HTTP/2 servers)', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

<label for="fvm_settings_css_min_disable">
<input name="fvm_settings[css][min_disable]" type="checkbox" id="fvm_settings_css_min_disable" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'css', 'min_disable')); ?>>
<?php _e( 'Disable CSS Files Minification', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will disable CSS Files minification for compatibility purposes', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

<label for="fvm_settings_css_min_disable_styles">
<input name="fvm_settings[css][min_disable_styles]" type="checkbox" id="fvm_settings_css_min_disable_styles" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'css', 'min_disable_styles')); ?>>
<?php _e( 'Disable CSS Styles Minification', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will disable CSS Styles minification for compatibility purposes', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

<label for="fvm_settings_css_nopreload">
<input name="fvm_settings[css][nopreload]" type="checkbox" id="fvm_settings_css_nopreload" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'css', 'nopreload')); ?>>
<?php _e( 'Disable CSS Link Preload', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will remove the Render Blocking CSS files Link Preload from the header', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

</fieldset></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Ignore CSS files', 'fast-velocity-minify' ); ?></th>
<td><fieldset>
<label for="fvm_settings_css_ignore"><span class="fvm-bold-green fvm-rowintro"><?php _e( "Ignore the following CSS URL's", 'fast-velocity-minify' ); ?></span></label>
<p><textarea name="fvm_settings[css][ignore]" rows="7" cols="50" id="fvm_settings_css_ignore" class="large-text code" placeholder="ex: /plugins/something/assets/problem.css"><?php echo fvm_get_settings_value($fvm_settings, 'css', 'ignore'); ?></textarea></p>
<p class="description">[ <?php _e( 'CSS files are merged and grouped automatically by mediatype, hence you have an option to exclude files.', 'fast-velocity-minify' ); ?> ]</p>
<p class="description">[ <?php _e( 'Will match using <code>PHP stripos</code> against the <code>href attribute</code> on the <code>link tag</code>', 'fast-velocity-minify' ); ?> ]</p>
</fieldset></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Remove CSS Files', 'fast-velocity-minify' ); ?></th>
<td><fieldset>
<label for="fvm_settings_css_remove"><span class="fvm-bold-green fvm-rowintro"><?php _e( 'Remove the following CSS files', 'fast-velocity-minify' ); ?></span></label>
<p><textarea name="fvm_settings[css][remove]" rows="7" cols="50" id="fvm_settings_css_remove" class="large-text code" placeholder="ex: fonts.googleapis.com"><?php echo fvm_get_settings_value($fvm_settings, 'css', 'remove'); ?></textarea></p>
<p class="description">[ <?php _e( 'This will allow you to remove unwanted CSS files by URI path from the frontend', 'fast-velocity-minify' ); ?> ]</p>
<p class="description">[ <?php _e( 'Will match using <code>PHP stripos</code> against the <code>href attribute</code> on the <code>link tag</code>', 'fast-velocity-minify' ); ?> ]</p>
</fieldset></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Async CSS Files', 'fast-velocity-minify' ); ?></th>
<td><fieldset>
<label for="fvm_settings_css_async"><span class="fvm-bold-green fvm-rowintro"><?php _e( 'Async the following CSS files', 'fast-velocity-minify' ); ?></span></label>
<p><textarea name="fvm_settings[css][async]" rows="7" cols="50" id="fvm_settings_css_async" class="large-text code" placeholder="ex: /plugins/something/assets/low-priority.css"><?php echo fvm_get_settings_value($fvm_settings, 'css', 'async'); ?></textarea></p>
<p class="description">[ <?php _e( 'This will allow you to Async CSS files by URI path from the frontend', 'fast-velocity-minify' ); ?> ]</p>
<p class="description">[ <?php _e( 'Will match using <code>PHP stripos</code> against the <code>href attribute</code> on the <code>link tag</code>', 'fast-velocity-minify' ); ?> ]</p>
</fieldset></td>
</tr>


</tbody>
</table>



<div style="height: 60px;"></div>
<h2 class="title"><?php _e( 'JS Settings', 'fast-velocity-minify' ); ?></h2>
<h3 class="fvm-bold-green"><?php _e( 'In this section, you can optimize your JS files and inline scripts manually (by default all scripts are ignored for compatibility reasons).', 'fast-velocity-minify' ); ?></h3>

<table class="form-table fvm-settings">
<tbody>

<tr>
<th scope="row"><?php _e( 'JS Options', 'fast-velocity-minify' ); ?></th>
<td>
<p class="fvm-bold-green fvm-rowintro"><?php _e( 'Recommended Settings', 'fast-velocity-minify' ); ?></p>

<fieldset>
<label for="fvm_settings_js_enable">
<input name="fvm_settings[js][enable]" type="checkbox" id="fvm_settings_js_enable" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'js', 'enable')); ?>>
<?php _e( 'Enable JS Processing', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will enable processing for the settings below', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

</fieldset></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Advanced JS Options', 'fast-velocity-minify' ); ?></th>
<td>
<p class="fvm-bold-green fvm-rowintro"><?php _e( 'Handle with Care', 'fast-velocity-minify' ); ?></p>

<fieldset>

<label for="fvm_settings_js_combine">
<input name="fvm_settings[js][combine]" type="checkbox" id="fvm_settings_js_combine" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'js', 'combine')); ?>>
<?php _e( 'Combine JS Files', 'fast-velocity-minify' ); ?> <span class="note-info">[<?php _e( 'Deprecated: Will combine all JS files by render blocking type (no longer recommended for HTTP/2 servers)', 'fast-velocity-minify' ); ?>  ]</span></label>
<br />


<label for="fvm_settings_js_min_disable">
<input name="fvm_settings[js][min_disable]" type="checkbox" id="fvm_settings_js_min_disable" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'js', 'min_disable')); ?>>
<?php _e( 'Disable JS Files Minification', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will disable JS Files minification for testing purposes', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

<label for="fvm_settings_js_min_disable_inline">
<input name="fvm_settings[js][min_disable_inline]" type="checkbox" id="fvm_settings_js_min_disable_inline" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'js', 'min_disable_inline')); ?>>
<?php _e( 'Disable JS Inline Minification', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will disable JS Inline minification for testing purposes', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

<label for="fvm_settings_js_inline-all">
<input name="fvm_settings[js][nopreload]" type="checkbox" id="fvm_settings_js_nopreload" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'js', 'nopreload')); ?>>
<?php _e( 'Disable JS link Preload', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will remove the Render Blocking JS files Link Preload from the header', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

</fieldset></td>
</tr>


<tr>
<th scope="row"><?php _e( 'Ignore Script Files', 'fast-velocity-minify' ); ?></th>
<td><fieldset>
<label for="fvm_settings_js_ignore"><span class="fvm-bold-green fvm-rowintro"><?php _e( 'Will prevent merging or minification for all JS files matching the paths below', 'fast-velocity-minify' ); ?></span></label>
<p><textarea name="fvm_settings[js][ignore]" rows="7" cols="50" id="fvm_settings_js_ignore" class="large-text code" placeholder="<?php _e( '--- ex: /plugins/something/assets/problem.js ---', 'fast-velocity-minify' ); ?>"><?php echo fvm_get_settings_value($fvm_settings, 'js', 'ignore'); ?></textarea></p>
<p class="description">[ <?php _e( 'Will match using <code>PHP stripos</code> against the script <code>src</code> attribute', 'fast-velocity-minify' ); ?> ]</p>
<p class="description">[ <?php _e( 'It is highly recommended to try to leave this empty and later be more specific on what to merge', 'fast-velocity-minify' ); ?> ]</p>
</fieldset></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Render Blocking JS files', 'fast-velocity-minify' ); ?></th>
<td><fieldset>
<label for="fvm_settings_merge_header"><span class="fvm-bold-green fvm-rowintro"><?php _e( 'This will render block all JS files matching the paths below', 'fast-velocity-minify' ); ?></span></label>
<p><textarea name="fvm_settings[js][merge_header]" rows="7" cols="50" id="fvm_settings_js_merge_header" class="large-text code" placeholder="<?php _e( '--- example ---', 'fast-velocity-minify' ); ?> 
/jquery-migrate.js 
/jquery.js 
/jquery.min.js"><?php echo fvm_get_settings_value($fvm_settings, 'js', 'merge_header'); ?></textarea></p>
<p class="description">[ <?php _e( 'Will match using <code>PHP stripos</code> against the script <code>src attribute</code>', 'fast-velocity-minify' ); ?> ]</p>
</fieldset></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Defer JS Files', 'fast-velocity-minify' ); ?></th>
<td><fieldset>
<label for="fvm_settings_merge_defer"><span class="fvm-bold-green fvm-rowintro"><?php _e( 'This will defer all JS files matching the paths below', 'fast-velocity-minify' ); ?></span></label>
<p><textarea name="fvm_settings[js][merge_defer]" rows="7" cols="50" id="fvm_settings_js_merge_defer" class="large-text code" placeholder="<?php _e( '--- example ---', 'fast-velocity-minify' ); ?> 
/wp-admin/ 
/wp-includes/ 
/wp-content/"><?php echo fvm_get_settings_value($fvm_settings, 'js', 'merge_defer'); ?></textarea></p>
<p class="description">[ <?php _e( 'Will match using <code>PHP stripos</code> against the script <code>src attribute', 'fast-velocity-minify' ); ?></code> ]</p>
</fieldset></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Defer Inline JavaScript', 'fast-velocity-minify' ); ?></th>
<td><fieldset>
<label for="fvm_settings_defer_dependencies"><span class="fvm-bold-green fvm-rowintro"><?php _e( 'Preserve the order of scripts execution when deferring JS files dependencies', 'fast-velocity-minify' ); ?></span></label>
<p><textarea name="fvm_settings[js][defer_dependencies]" rows="7" cols="50" id="fvm_settings_js_defer_dependencies" class="large-text code" placeholder="<?php _e( '--- example ---', 'fast-velocity-minify' ); ?> 
wp.i18n
wp.apiFetch.use
window.lodash
wp.hooks
wp.url"><?php echo fvm_get_settings_value($fvm_settings, 'js', 'defer_dependencies'); ?></textarea></p>
<p class="description">[ <?php _e( 'Inline JavaScript matching these rules, will be deferred with script type module', 'fast-velocity-minify' ); ?> ]</p>
<p class="description">[ <?php _e( 'Will match using <code>PHP stripos</code> against the script <code>innerHTML</code>', 'fast-velocity-minify' ); ?> ]</p>
</fieldset></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Delay third party scripts until user interaction', 'fast-velocity-minify' ); ?></th>
<td><fieldset>
<label for="fvm_settings_js_thirdparty"><span class="fvm-bold-green fvm-rowintro"><?php _e( 'Delay JS files or inline scripts until user interaction', 'fast-velocity-minify' ); ?></span></label>
<p><textarea name="fvm_settings[js][thirdparty]" rows="7" cols="50" id="fvm_settings_js_thirdparty" class="large-text code" placeholder="<?php _e( '--- example ---', 'fast-velocity-minify' ); ?> 
function(w,d,s,l,i) 
function(f,b,e,v,n,t,s)
function(h,o,t,j,a,r)
www.googletagmanager.com/gtm.js"><?php echo fvm_get_settings_value($fvm_settings, 'js', 'thirdparty'); ?></textarea></p>
<p class="description">[ <?php _e( 'Used interaction events: mouseover, keydown, touchstart, touchmove and wheel', 'fast-velocity-minify' ); ?> ]</p>
<p class="description">[ <?php _e( 'Will match using <code>PHP stripos</code> against the inline script <code>innerHTML</code> or <code>src</code> attribute for JS files', 'fast-velocity-minify' ); ?> ]</p>
</fieldset></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Remove JavaScript Scripts', 'fast-velocity-minify' ); ?></th>
<td><fieldset>
<label for="fvm_settings_js_remove"><span class="fvm-bold-green fvm-rowintro"><?php _e( 'Remove the following JS files or Inline Scripts', 'fast-velocity-minify' ); ?></span></label>
<p><textarea name="fvm_settings[js][remove]" rows="7" cols="50" id="fvm_settings_js_remove" class="large-text code" placeholder="<?php _e( '--- example ---', 'fast-velocity-minify' ); ?> 
/some/duplicate/file.js"><?php echo fvm_get_settings_value($fvm_settings, 'js', 'remove'); ?></textarea></p>
<p class="description">[ <?php _e( 'This will allow you to remove unwanted script tags from the frontend', 'fast-velocity-minify' ); ?> ]</p>
<p class="description">[ <?php _e( 'Will match using <code>PHP stripos</code> against the script <code>outerHTML</code>', 'fast-velocity-minify' ); ?> ]</p>
</fieldset></td>
</tr>


</tbody>
</table>



<div style="height: 60px;"></div>
<h2 class="title"><?php _e( 'CDN Settings', 'fast-velocity-minify' ); ?></h2>
<h3 class="fvm-bold-green"><?php _e( 'If your CDN provider gives you a different URL for your assets, you can use it here', 'fast-velocity-minify' ); ?></h3>
<table class="form-table fvm-settings">
<tbody>
<tr>
<th scope="row"><?php _e( 'CDN Options', 'fast-velocity-minify' ); ?></th>
<td>
<p class="fvm-bold-green fvm-rowintro"><?php _e( 'Select your options below', 'fast-velocity-minify' ); ?></p>

<fieldset>
<label for="fvm_settings_cdn_enable">
<input name="fvm_settings[cdn][enable]" type="checkbox" id="fvm_settings_cdn_enable" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'cdn', 'enable')); ?>>
<?php _e( 'Enable CDN Processing', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will enable processing for the settings below', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

<label for="fvm_settings_cdn_cssok">
<input name="fvm_settings[cdn][cssok]" type="checkbox" id="fvm_settings_cdn_cssok" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'cdn', 'cssok')); ?>>
<?php _e( 'Enable CDN for merged CSS files', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will serve the FVM generated CSS files from the CDN', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

<label for="fvm_settings_cdn_jsok">
<input name="fvm_settings[cdn][jsok]" type="checkbox" id="fvm_settings_cdn_jsok" value="1" <?php echo fvm_get_settings_checkbox(fvm_get_settings_value($fvm_settings, 'cdn', 'jsok')); ?>>
<?php _e( 'Enable CDN for merged JS files', 'fast-velocity-minify' ); ?> <span class="note-info">[ <?php _e( 'Will serve the FVM generated JS files from the CDN', 'fast-velocity-minify' ); ?> ]</span></label>
<br />

</fieldset></td>
</tr>
<tr>
<th scope="row"><span class="fvm-label-special"><?php _e( 'CDN URL', 'fast-velocity-minify' ); ?></span></th>
<td><fieldset>
<label for="fvm_settings_cdn_domain">
<p><input type="text" name="fvm_settings[cdn][domain]" id="fvm_settings_cdn_domain" value="<?php echo fvm_get_settings_value($fvm_settings, 'cdn', 'domain'); ?>" size="80" /></p>
<p class="description">[ <?php _e( 'You can ignore this if your CDN url matches your domain name (ie: Cloudflare)', 'fast-velocity-minify' ); ?> ]</p>
</label>
<br />
</fieldset></td>
</tr>
<tr>
<th scope="row"><?php _e( 'CDN Integration', 'fast-velocity-minify' ); ?></th>
<td><fieldset>
<label for="fvm_settings_cdn_integration"><span class="fvm-bold-green fvm-rowintro"><?php _e( 'Missing HTML elements to replace', 'fast-velocity-minify' ); ?></span></label>
<p><textarea name="fvm_settings[cdn][integration]" rows="7" cols="50" id="fvm_settings_cdn_integration" class="large-text code" placeholder="--- check the help section for suggestions ---"><?php echo fvm_get_settings_value($fvm_settings, 'cdn', 'integration'); ?></textarea></p>
<p class="description">[ <?php _e( 'Additional replacement rules with syntax from <code>https://simplehtmldom.sourceforge.io/manual.htm</code>', 'fast-velocity-minify' ); ?> ]</p>
</fieldset></td>
</tr>
</tbody></table>


<div style="height: 60px;"></div>
<h2 class="title"><?php _e( 'Query Strings', 'fast-velocity-minify' ); ?></h2>
<h3 class="fvm-bold-green"><?php _e( 'Allow processing of CSS, JS & HTML on specific query strings', 'fast-velocity-minify' ); ?></h3>
<table class="form-table fvm-settings">
<tbody>
<tr>
<th scope="row"><?php _e( 'Allowed Query Strings', 'fast-velocity-minify' ); ?></th>
<td><fieldset>
<label for="fvm_settings_settings_qs"><span class="fvm-bold-green fvm-rowintro"><?php _e( 'One query string key per line', 'fast-velocity-minify' ); ?></span></label>
<p><textarea name="fvm_settings[settings][qs]" rows="7" cols="50" id="fvm_settings_settings_qs" class="large-text code" placeholder="--- check the help section for suggestions ---"><?php echo fvm_get_settings_value($fvm_settings, 'settings', 'qs'); ?></textarea></p>
<p class="description">[ <?php _e( 'Additional query strings, keys only', 'fast-velocity-minify' ); ?> ]</p>
</fieldset></td>
</tr>
</tbody></table>


<div style="height: 60px;"></div>
<h2 class="title"><?php _e( 'User Settings', 'fast-velocity-minify' ); ?></h2>
<h3 class="fvm-bold-green"><?php _e( 'For compatibility reasons, only anonymous users should be optimized by default.', 'fast-velocity-minify' ); ?></h3>
<table class="form-table fvm-settings">
<tbody>

<tr>
<th scope="row"><?php _e( 'User Options', 'fast-velocity-minify' ); ?></th>
<td>
<p class="fvm-bold-green fvm-rowintro"><?php _e( 'Force optimization for the following user roles', 'fast-velocity-minify' ); ?></p>

<fieldset>
<?php
# output user roles checkboxes
echo fvm_get_user_roles_checkboxes();
?>
</fieldset></td>
</tbody></table>


<input type="hidden" name="fvm_action" value="save_settings" />
<p class="submit"><input type="submit" class="button button-primary" value="<?php _e( 'Save Changes', 'fast-velocity-minify' ); ?>"></p>

</form>
</div>
<?php 
}
