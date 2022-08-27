<?php if( $active_tab == 'help' ) { ?>

<div class="fvm-wrapper">

<h2 class="title">FVM 3 Release Notes</h2>

<div class="accordion">
  <h3>Important JS and JavaScript changes</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>JavaScript merging functionality went through a significant change on FVM 3 and it now requires manual configuration to work.</p>
	<p>If you are upgrading from FVM 2 please refer to the help section below for more information on the settings.</p>
	<p>If you just installed the plugin, please note that JS is not being optimized yet. You have to choose which files to be render blocking and which ones to be deferred, plus it's inline script dependencies (if any). </p>
	<p>Previously, FVM merged everything and relied on having options to ignore scripts. This option frequently created issues with other plugin updates, when they changed something JavaScript related.</p>
	<p>Please understand that this plugin is and it has always been aimed at being a tool for advanced users and developers, so it's not meant just be plug and play, without manual settings in place.</p>
	<p>There is a new method to optimize third party scripts and load them on user interaction or automatically, after 5 seconds. This is a more recommended method to optimize scripts, as compared to FVM 2 which used document.write and other deprecated methods.</p>
	<p>Please refer to the JavaScript help section further down on this page to understand how you can optimize your scripts.</p>
  </div>
  <h3>Relevant CSS and Fonts changes</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>You can now ignore or completely remove CSS files by URI Path or domain name (such as google fonts or other unwanted CSS files).</p>
	<p>Known fonts, icon, animation and some other CSS files now have an option to be merged separately and loaded Async.</p>
	<p>FVM now preloads the external CSS files on the header, before render blocking them later on the page.</p>
  </div>
  <h3>Relevant Cache changes</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>Purging cache on FVM, renames the file name in order to bypass CDN and browser cache, however, expired CSS and JS cache files are only deleted 24 hours (by default) after your last cache purge request.</p>
	<p>This is needed because some hosting services can cache your HTML regardless of your cache purge request. If we were to delete the FVM cached files right away, it would break your layout for anonymous users, as the files would no longer exist but your page would still be referencing them.</p>
  </div>
 <h3>Other changes</h3>
  <div>
    <p><strong>Notes:</strong></p>
	<p>Preconnect and Preload Headers have been removed (please use your own PHP code and conditional tags for that).</p>
	<p>Critical Path CSS option has been removed (add your own code with code and <code>&lt;style id=&quot;critical-path&quot;&gt;</code> your code &lt;/style&gt; ).</p>
  </div>
</div>


<div style="height: 20px;"></div>
<h2 class="title">Global Settings</h2>

<div class="accordion">
  <h3>Purge Minified CSS/JS files instantly</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>When you purge CSS/JS files instantly, all CSS and JS cache files are deleted immediately when you clear everything on FVM. While this is great during development, it may cause issues when your hosting is doing page caching that cannot be purged by FVM. For example, if you were to delete the CSS and JS files instantly without purging the full page cache, that page cache would now be pointing to deleted files.</p>
	<p>If you deselect this option, whenever you clear everything on FVM, it will only try to delete files that are older than 24h (and hopefully this should be enough for your hosting to expire the page cache automatically). That way, even if your hosting is still showing your page cache to anonymous users, the referred CSS and JS files will still be available.</p>
	<p>If you are not sure about page caching on your server or hosting provider, you should keep this option disabled.</p>
  </div>
</div>

<div style="height: 20px;"></div>
<h2 class="title">HTML Settings</h2>

<div class="accordion">
  <h3>Enable HTML Processing</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>You need to enable this option, for any other options in the HTML section to work.</p>
  </div>
  <h3>Strip HTML Comments</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>Some plugins may need to use comments for certain functionality to work, however this is quite rare. The benefit of removing comments is usually very small, so if needed you can disable this setting.</p>
  </div>
  <h3>Cleanup Header</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>This options removes resource hints, generator tags, shortlinks, manifest link, etc from the header.</p> 
	<p>The header should be kept as lean as possible for the best TTFB response times and LCP metrics, but if you later find that you need some of the stuff that is removed by this option, you can disable this setting.</p>
  </div>
  <h3>Remove Emoji</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>This will remove the default emoji scripts from wordpress, thus reducing the amount of code during page loading. If you use WordPress emoji when posting content, you should keep this option disabled.</p>
  </div>
  <h3>Disable HTML Minification</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>Although rare, it's possible for the HTML minification to strip too much code thus breaking something. You can use this option to test if that is the case and keep this option disabled if that is the case.</p>
	<p>HTML minification is no longer a recommendation by gtmetrix or pagespeed insights, so you can keep this option disabled if there is any incompatibility issue.</p>
  </div>
</div>


<div style="height: 20px;"></div>
<h2 class="title">CSS Settings</h2>

<div class="accordion">
  <h3>Enable CSS Processing</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>You need to enable this option, for any other options in the CSS section to work.</p>
  </div>
  <h3>Merge Fonts and Icons Separately</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>This will try to collect and simplify all your CSS font face rules into a separate CSS file and load it async. It may be useful for de-duplication of fonts, or to evaluate how many fonts are in use. </p>
  </div>
  <h3>Remove "Print" stylesheets</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>As a generic rule this it's safe to remove it for the vast majority of sites, unless your users often need to print pages from your site and you have customized styles for when they do so.</p>
  </div>
  <h3>Combine CSS Files</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>Merging CSS is no longer recommended if your server supports HTTP/2. The feature also usually causes conflicts when merging multiple CSS files into one, due to the lack of specificity or other errors in the code. It's still available for legacy support on old installations or outdated servers that do not support HTTP/2 delivery.</p>
  </div>
  <h3>Disable CSS Files Minification</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>Although rare, it's possible that CSS files minification may strip too much code and break some style rules that are not supported by the minification library. You can always try to disable this and check if this fixes anything, then use the ignore list to exclude the file that is causing issues.</p>
  </div>
  <h3>Disable CSS Styles Minification</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>Although rare, it's possible that CSS Styles minification may strip too much code and break some style rules that are not supported by the minification library. You can always try to disable this and check if this fixes anything.</p>
  </div>
  <h3>Disable CSS Link Preload</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>CSS Link Preloading is useful when you are merging CSS files or when you defined certain paths as Async CSS. By default, FVM will send an HTTP preload request as well as adding the html preload tag on the header, which will prioritize downloading the critical styles earlier than the other resources.</p>
	<p>If you select this option, these headers will be removed and your default preload resources will load earlier than the CSS files. You need to test and see what works best for you.</p>
  </div>
  <h3>Ignore CSS files</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>If there is a conflict when merging CSS files or during individual minification of a specific CSS file, you can add the path on this section and FVM will ignore the file, thus leaving it alone.</p>
  </div>
  <h3>Remove CSS Files</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>If your plugins enqueue multiple duplicate libraries with different url paths, you can add the path on this section and FVM will remove the file from the frontend, thus reducing your total CSS size.</p>
  </div>
  <h3>Async CSS Files</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>CSS files from plugins that are not rendered above the fold, should ideally be loaded async. For example, if a plugin has CSS files but you only use the element on the footer, you could add the /plugins/plugin-name/ here to async it. But you should not async CSS files that are needed for content that is visible on the critical path.</p>
	<p>Also note that by loading certain CSS files async, you are changing the order of styles. This means, some styles may or may not work as intended, because now they load on a different position.</p>
  </div>
</div>


<div style="height: 20px;"></div>
<h2 class="title">JS Settings</h2>

<div class="accordion">
  <h3>Enable JS Processing</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>You need to enable this option, for any other options in the JS section to work.</p>
  </div>
  <h3>Combine JS Files</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>Merging JS is no longer recommended if your server supports HTTP/2. The feature also usually causes conflicts when merging multiple JS files into one, due to a different order of loading or other errors in the code. It's still available for legacy support on old installations or outdated servers that do not support HTTP/2 delivery.</p>
  </div>
  <h3>Disable JS Files Minification</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>JS files minification may strip too much code and break some code that is not supported by the minification library. You can always try to disable this and check if this fixes anything, then use the ignore list to exclude the file that is causing issues.</p>
  </div>
  <h3>Disable JS Inline Minification</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>Inline JS Styles minification may strip too much code and break some code that is not supported by the minification library. You can always try to disable this and check if this fixes anything.</p>
  </div>
  <h3>Disable JS Link Preload</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>JS Link Preloading is useful when you are merging JS files or when you defined certain paths as Defer JS. By default, FVM will send an HTTP preload request as well as adding the html preload tag on the header, which will prioritize downloading the render blocking scripts earlier than the other resources.</p>
	<p>If you select this option, these headers will be removed and your default preload resources will load earlier than the JS files. You need to test and see what works best for you.</p>
  </div>
  
  <h3>Ignore Script Files</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>When you are merging JS files, the order of scripts change positions and dependencies may break. Other times, a specific script is not supported by the minification and breaks as well. If you encounter issues while merging or minifying JS files, you can exclude them here and those files will be left alone.</p>
  </div>
  <h3>Render Blocking JS files</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>In most WordPress themes and for a significant amount of plugins, you usually need to render block jQuery and jQuery Migrate for compatibility reasons.</p> 
	<p>Some plugins may not work at all if they are not render blocking, so you should look out for browser console log errors in incognito mode.</p>
	<p><strong>Recommended Default Settings:</strong></p>
	<p class="fvm-code-full">
	/jquery-migrate<br>
	/jquery.js<br>
	/jquery.min.js<br>
	</p>
  </div>
  <h3>Defer JS Files</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>Deferring every single script is not always the best solution, especially if those are needed to generate content above the fold. You must check your browser console log in incognito mode for possible errors after enabling this feature, and either move them to the render blocking section or check if there is any inline script that also needs to be deferred (so the order of loading is preserved).</p>
	<p>Note that this is an advanced feature, hence it requires manual configuration for it to work.</p>
	<p><strong>Recommended Default Settings:</strong></p>
	<p class="fvm-code-full">
	/ajax.aspnetcdn.com/ajax/<br>
	/ajax.googleapis.com/ajax/libs/<br>
	/cdnjs.cloudflare.com/ajax/libs/<br>
	/stackpath.bootstrapcdn.com/bootstrap/<br>
	/wp-admin/<br>
	/wp-content/<br>
	/wp-includes/
	</p>
  </div>
  <h3>Defer Inline JavaScript</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>When you merge JS files and defer them, you are effectively changing the order in which they load, however for certain scripts, the order of loading matters. If you are deferring a certain JS file and you see an "undefined" error triggered on some inline code, you can try this option to also defer the inline code and preserve the order of execution.</p>
	<p>Note however, not all scripts can work with defer so you need to test if everything is working without errors.</p>
	<p>This is empty by default, unless you determine that it's needed.</p>
	<p><strong>Recommended Default Settings:</strong></p>
	<p class="fvm-code-full">
	wp.i18n<br>
	wp.apiFetch.use<br>
	window.lodash<br>
	wp.hooks<br>
	wp.url
	</p>
  </div>
  <h3>Delay third party scripts until user interaction</h3>
  <div>
    <p><strong>Notes:</strong></p>
	<p>Scripts like analytics, ads, tracking codes, etc, consume important CPU and network resources needed for the initial page view. You can force certain plugins to wait for user interaction (mouseover, keydown, touchstart, touchmove and wheel) and the scripts will only run on these events.</p>
	<p>Delaying these scripts will improve your speed because most third party scripts are not needed for showing any content (if they are, then they are on the critical path and you should not delay them). In addition, note that some codes make use of document.write and other methods, which do not support delaying (delaying will work as usual, but the script will not do anything or stop working).</p>
	<p>If you have render blocking third party scripts, ask your provider if they can provide you with an async or defer implementation (else remove them, because render blocking scripts are not recommended for speed).</p>
	<p><strong>Example Settings:</strong></p>
	<p class="fvm-code-full">
	function(w,d,s,l,i)<br>
	function(f,b,e,v,n,t,s)<br>
	function(h,o,t,j,a,r)<br>
	www.googletagmanager.com/gtm.js<br>
	gtag(<br>
	fbq(<br>
	</p>
  </div>
  <h3>Remove JavaScript Scripts</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>This can be used when you want to remove a duplicate JS file from the frontend source. However, if this is for a third party script you added to the header or footer (either code or via some plugin), it's better if you delete it at the source.</p>
  </div>
</div>



<div style="height: 20px;"></div>
<h2 class="title">CDN Settings</h2>

<div class="accordion">
  <h3>Enable CDN Processing</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>You need to enable this option, for any other options in the CDN section to work.</p>
  </div>
  <h3>Enable CDN for merged CSS files</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>When selecting this option, FVM will replace your domain name with the CDN domain, for the generated CSS cache file.</p>
	<p>Under certain situations, you may not want to serve the CSS file from the CDN, such as when your server compression level is significantly higher than the CDN (smaller file than the one delivered by the CDN).</p>
	<p>Also bare in mind, that if the CSS file is served from the CDN, any static assets inside the CSS file that make use of relative paths, will also be cached and served from the CDN, which may also be undesirable in certain situations.</p>
  </div>
  <h3>Enable CDN for merged JS files</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>When selecting this option, FVM will replace your domain name with the CDN domain, for the generated JS cache file.</p>
	<p>Under certain situations, you may not want to serve the JS file from the CDN, such as when your server compression level is significantly higher than the CDN (smaller file than the one delivered by the CDN).</p>
	<p>Also bare in mind, that if the JS file is served from the CDN, any static assets inside the JS file that make use of relative paths, will also be cached and served from the CDN, which may also be undesirable in certain situations.</p>
  </div>
  <h3>CDN URL</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>This is not required for providers such as Cloudflare.com as well as any reverse proxy CDN service that doesn't change your domain name (the whole site goes through their service).</p>
	<p>For other types of CDN, you are usually provided with an alternative domain name from where your static files can be served and in those cases, you would introduce your new domain name here.</p>
  </div>
  <h3>CDN Integration</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>Uses syntax from <a target="_blank" href="https://simplehtmldom.sourceforge.io/manual.htm">https://simplehtmldom.sourceforge.io/manual.htm</a> for modifying the HTML.</p>
	<p>The plugin will replace your site domain url with the CDN domain for the matching HTML tags.</p>
  </div>
</div>

<div style="height: 20px;"></div>
<h2 class="title">Query String Settings</h2>

<div class="accordion">
  <h3>Allowed Query Strings</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>This allows processing of CSS, HTML and JS when the url contains certain query strings, but note that if there are other query strings found on the same url not on the list of allowed query strings, it will still not process the url.</p>
	<p><strong>Example Settings:</strong></p>
	<p class="fvm-code-full">
	utm_source<br />utm_campaign<br />utm_medium<br />utm_expid<br />utm_term<br />utm_content<br />fb_action_ids<br />fb_action_types<br />fb_source<br />fbclid<br />_ga<br />gclid<br />age-verified<br />usqp<br />cn-reloaded<br />lang<br />s<br />permalink_name<br />lp-variation-id<br />author<br />author_name<br />cat<br />category_name<br />order<br />orderby<br />p<br />page_id<br />page<br />paged<br />post_type<br />posts<br />s<br />search<br />taxonomy<br />tag<br />tag_id<br />term
	</p>
  </div>
</div>

<div style="height: 20px;"></div>
<h2 class="title">User Settings</h2>

<div class="accordion">
  <h3>User Options</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>This will allow you to force CSS, HTML and JS processing for specific user roles.</p>
	<p>By default, only anonymous users should be optimized, to ensure that there is nothing broken for logged in users (unless you know what you are doing).</p>
  </div>
</div>



<div style="height: 20px;"></div>
<h2 class="title">Other FAQ's</h2>

<div class="accordion">
  <h3>Is the plugin GDPR compatible?</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>FVM does not collect any information from you, your site or your users. It also doesn't require cookies to work, therefore it's fully GDPR compatible.</p>
  </div>
  <h3>How do I know if the plugin is working?</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>For compatibility reasons, the plugin only optimizes anonymous users by default. That means, you need to open another browser window, or use incognito mode to test and see what it's doing. Logged in users will not see the optimizations, unless you manually enable certain user roles (not recommended for complex websites, unless you know what you are doing).</p> 
  </div>
  <h3>How do I purge the cache?</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>Please note that FVM is not a page cache plugin and it doesn't cache your content. The only time you should need to purge it's cache, is when you edit a css or js file.</p>
	<p>If your HTML page is being cached somewhere else, you must purge your cache either, unless FVM supports it natively.</p> 
  </div>
  <h3>Why am I getting 404 error not found for the generated CSS or JS files?</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>You deleted the FVM cache but forgot to purge the HTML page cache, or you are lacking writing permissions on the cache directory and files are not being created. </p>
	<p>You must purge your page cache either on some other cache plugin or at your server/hosting level for your page to update and find the latest merged file paths.</p>
	<p>Note that some hosts rate limit the amount of times you can purge caches to once every few minutes, so you may be purging and it doesn't work, because you are being rate limited by your hosting cache system.</p>
	<p>Avoid doing development on live sites and use a staging server without cache for testing. Production servers are for deploying once and leave it until the next deployment cycle.</p>
  </div>
  <h3>Why is my site layout broke after an update, a configuration change, or some other change?</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>You must check your browser console log in incognito mode, for possible errors after enabling certain features, deferring scripts or using some other optimization plugins, which may be conflicting with FVM optimization.</p>
	<p>If there are no errors, disable each option one by one on FVM (html processing, css processing, js processing, etc) until you find the feature breaking it. After that, adjust and tweak those settings accordingly, or hire a developer to help you.</p>
  </div>
  <h3>How can I download an older version of FVM for testing purposes?</h3>
  <div>
    <p><strong>Notes:</strong></p>
	<p>It's not recommended you do that, but if you want to test something, you can do so from the <a target="_blank" href="https://plugins.svn.wordpress.org/fast-velocity-minify/tags/">SVN repository</a> on WordPress.</p>
  </div>
  <h3>How do I undo all optimizations done by FVM?</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>Simply disable the plugin, and make sure to purge all page caches (Cache Plugins, Hosting, OPCache, etc).</p>
	<p>Note that some hosts rate limit the amount of times you can purge caches to once every few minutes, so you may be purging and it doesn't work, because you are being rate limited by your hosting cache system. If that happens, just wait and try again later or ask your hosting to manually purge all caches on the server.</p>
	<p>You can also delete any database entries on the wp_options table starting with fastvelocity to completely purge it.</p>
	<p>FVM does not modify your site. It runs after your template loads and filters the final HTML to present it to your users, in a more optimized way.</p>
  </div>
  <h3>I have disabled FVM but somehow the cache files are still being generated?</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>If you already purged all caches available, please ensure you have deleted the plugin and that it's no longer visible via wp-admin. If you still see references to FVM in incognito mode via google chrome, that means your server still has full page cache in memory that needs to be cleared.</p>
	<p>A few hosting providers will put your files on a remote storage and cache your disk and files in memory to speed things up, which may cause code to be cached even if you have completely deleted it from the remote storage. This means, it may take a few minutes, or several hours for the actual code to update. In that case, restart the server or ask your hosting to purge all disk and page caching memory.</p>
  </div>
  <h3>Where can I get support or ask questions about the plugin?</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>You can ask for help on <a href="https://wordpress.org/support/plugin/fast-velocity-minify/">https://wordpress.org/support/plugin/fast-velocity-minify/</a> but please note we cannot guide you on which files to merge or how to solve JavaScript conflicts. You need to try different settings (trial and error) and open a separate window in incognito mode, to look for console log errors on your browser, and adjust settings as needed.</p>
  </div>
  <h3>How is it possible that some scan is showing malware on the plugin?</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>I guarantee that the plugin is 100% clean of malware, provided you have downloaded the plugin from the official WordPress source AND that your other plugins, theme or core is not compromised.</p>
	<p>Malware can infect any plugin (even security plugins) regardless of the point of entry. Sometimes it propagates from different areas (including other sites you may have on the same server) or through a vulnerability on another theme or plugin (even disabled plugins or themes sometimes). </p>
	<p>For that reason, if there is already malware on any JS files or CSS being merged by FVM, they would still be merged as they are, as FVM also reads them as they are. </p>
	<p>If you are seeing malware on any cache file related to FVM, simply purge all caches and delete the FVM plugin. Then hire someone to manually audit the site (plugins or automated malware checks are not 100% accurate). You can then reinstall the FVM plugin from the official source on wordpress.org or via wp-admin if you like.</p>
  </div>
  <h3>How do I report a security issue or file a bug report?</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>If you are sure it's a bug and not a misconfiguration specific to your site, thank you for taking the time to report it.</p>
	<p>You can contact me on <a href="https://fastvelocity.com/">https://fastvelocity.com/</a> using the contact form.</p>
	<p>You are also welcome to submit patches and fixes via <a href="https://github.com/peixotorms/fast-velocity-minify">https://github.com/peixotorms/fast-velocity-minify</a> if you are a developer.</p>
	
  </div>
  <h3>I'm not a developer, can I hire you for a more complete speed optimization?</h3>
  <div>
	<p>You can contact me on <a href="https://fastvelocity.com/">https://fastvelocity.com/</a> using the contact form, providing me your site URL and what issues you are trying to fix, for a more exact quote.</p>
	<p>My speed optimization starts from $500 for small sites and from $850 for woocommerce and membership sites.</p>
	<p>I do not use the free FVM for my professional work, but I guarantee as best performance as possible for your site content.</p>
  </div>
  <h3>How can I donate to the plugin author?</h3>
  <div>
    <p><strong>Notes:</strong></p>
    <p>While not required, if you are happy with my work and would like to buy me a <del>beer</del> green tea, you can do it via PayPal at <a target="_blank" href="https://goo.gl/vpLrSV">https://goo.gl/vpLrSV</a> and thank you in advance :)</p> 
  </div>
</div>


</div>
<?php 
}
