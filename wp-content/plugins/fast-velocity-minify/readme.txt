=== Fast Velocity Minify ===
Contributors: Alignak
Tags: PHP Minify, Lighthouse, GTmetrix, Pingdom, Pagespeed, Merging, Minification, Optimization, Speed, Performance, FVM
Requires at least: 4.9
Requires PHP: 5.6
Stable tag: 3.2.9
Tested up to: 6.0.2
Text Domain: fast-velocity-minify
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Improve your speed score on GTmetrix, Pingdom Tools and Google PageSpeed Insights by adjusting CSS and JS files (defer, async, minify, combine, etc), compressing HTML, simplifying fonts and a few more speed optimization options. 
 

== Description ==
HTML, CSS & JS optimization plugin for developers and advanced users. Note you need to look into the HELP tab after installing the plugin and manually configure it for your site. Each site is different, so the default recommendations may or may not work for you and you will need to test and find out how to adjust your settings.

Minification is done on the frontend during the first uncached request. Once the first request is processed, any other pages that require the same set of CSS and JS files will be able to reuse the same generated static CSS or JS file.

If your cache is growing significantly, this could mean one of your CSS or JS files is dynamic and changes on every pageview. In that case, you would need to add the file to the ignore list, else the cache would grow indefinitely (because obviously the original files themselves are dynamic and when you minify, the plugin sees a different file). 

Kindly read the HELP section after installing the plugin, about possible issues and how to solve them.

= Additional Optimization =

I can offer you additional `custom made` optimization on top of this plugin. If you would like to hire me, please visit my profile links for further information.


= WP-CLI Commands =
*	Purge all caches: `wp fvm purge`
*	Purge all caches on a network site: `wp --url=blog.example.com fvm purge`
*	Purge all caches on the entire network (linux): `wp site list --field=url | xargs -n1 -I % wp --url=% fvm purge`

= How to customize the cache path ? =
You need a public directory to store and serve minified cache files. If you need to customize the path and url, you need to edit your `wp-config.php` and add both `define('FVM_DIR', '/path/to/example.com/your/public/directory');` and `define('FVM_URL', 'https://example.com/your/public/directory');` .


== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory or upload the zip within WordPress
2. Activate the plugin through the `Plugins` menu in WordPress
3. Configure the options under: `Settings > Fast Velocity Minify` and that's it.


== Screenshots ==

1. The Settings page.


== Changelog ==

= 3.2.9 [2022.08.30] =
* legacy code removal and other bugfixes

= 3.2.8 [2022.05.30] =
* ajax bugfix

= 3.2.7 [2022.05.30] =
* cloudways & godaddy cache purging fixes

= 3.2.6 [2022.02.06] =
* cache purging fixes

= 3.2.5 [2022.02.01] =
* changed writing the css/js files to WP_Filesystem_Direct with a secondary fallback method
* fixed a bug when merging css/js can break the site layout if the plugin failed to write the cache file (there will be an html comment on the footer if this happens)
* renamed a common name class to avoid conflicts with other plugins

= 3.2.4 [2022.01.31] =
* WP 5.9 / PHP 8 maintenance release
* changed deferred css/js cache clearing from 24h to 7 days
* added cache purging support for nginx helper plugin
* added option to allow processing on specific query strings
* other bug fixes

= 3.2.3 [2021.05.15] =
* added auto varnish cache purge for Cloudways
* switched from WP_Filesystem_Direct() to WP_Filesystem() 

= 3.2.2 [2021.05.09] =
* fixed some JS files not being minified

= 3.2.1 [2021.05.07] =
* added support for custom cache location via wp-config.php constants
* changed the default cache directory to wp-content/cache

= 3.2.0 [2021.05.06] =
* fixed an issue where some files were not being minified
* better sourceMappingURL removal during minification

= 3.1.9 [2021.05.05] =
* fixed an issue with some base64 encoded fonts and icons becoming invalid
* changed @import CSS rules order according to specification (@import rules need to get processed first when minifying)

= 3.1.8 [2021.04.30] =
* fixed missing dynamic css/js urls
* fixed some relative static assets paths 
* added auto disabling of FVM on Web Stories (AMP)

= 3.1.7 [2021.04.26] =
* more php notices fixes

= 3.1.6 [2021.04.25] =
* php notices fixes
* better http2 support

= 3.1.5 [2021.04.24] =
* added support for WP Cloudflare Super Page Cache plugin
* fixed support for LiteSpeed Cache purging
* changed the cache directory to the uploads directory (WP_Filesystem_Direct)
* deprecated CSS and JS merging as this is no longer recommended for HTTP/2 servers
* stop removing RSS feeds references on the header cleanup option
* changed some descriptions and updated the HELP section
* other bug fixes

= 3.1.4 [2021.01.11] =
* disable FVM update routines when a user runs wp-cli commands outside of the root directory
* database routine improvements for users with custom table prefixes

= 3.1.3 [2021.01.10] =
* Link preload headers improvement

= 3.1.2 [2021.01.09] =
* Fixed a PHP notice on wp-admin

= 3.1.1 [2021.01.09] =
* Added option to disable preload header
* Added support for the preload header importance attribute
* Better default settings for new installs
* Other bug fixes related to UTF-8 decoding and merging

= 3.1.0 [2021.01.06] =
* Added support for WP AMP by custom4web
* Fix for <code> and <pre> tags being minified
* Better HTML document detection for minification

= 3.0.9 [2021.01.04] =
* Added page caching purging support for Hummingbird and WP-Optimize from FVM

= 3.0.8 [2021.01.02] =
* Improved compatibility and better detection of dynamic CSS and JS files (files generated with PHP instead of being static)

= 3.0.7 [2021.01.02] =
* Fixed incorrect paths on subdirectory sites (inside merged CSS files)

= 3.0.6 [2021.01.01] =
* Adjusted the HELP tab settings
* Improved compatibility with CSS merging on WP Bakery

= 3.0.5 [2021.01.01] =
* Fixed the cache paths on Windows Servers
* Fixed incorrect file paths on subdirectory sites
* Fixed the CDN integration not replacing the domain name
* Fixed CSS font-display replacements

= 3.0.4 [2020.12.31] =
* Improved compatibility on CSS merging with optimole and similar services
* Fixed some PHP notices and other minor issues

= 3.0.3 [2020.12.29] =
* Prevent minification on XML content that do not trigger WordPress conditionals
* Added support for critical path positioning before the CSS files when Async mode is enabled
* Minor bugfixes

= 3.0.2 [2020.12.29] =
* Added option to preserve settings on uninstall
* Added option to inline all CSS (merging is still the recommended method)
* Added option to force HTTPS on the generated cache file urls
* Added an ignore list to the JS section (also imported from FVM 2 settings)
* Improved compatibility with FVM 2 (you still need to specify what JS paths you want to merge)
* Preserve the old FVM 2 settings on the database (will be removed on version 3.2)

= 3.0.1 [2020.12.27] =
* Added initial translation support under the "fast-velocity-minify" text domain.

= 3.0.0 [2020.12.26] =
* New version has been remade from scratch
* JS Optimization is disabled by default and requires manual configuration
* Third party scripts can now be delayed until user interaction, to improve the initial loading time

= 2.8.9 [2020.06.23] =
* new filter for wp hide compatibility

= 2.8.8 [2020.05.01] =
* bug fixes for woocommerce, which could result in 403 errors when adding to cart under certain cases

= 2.8.7 [2020.04.30] =
* fixed the sourceMappingURL removal regex introduced on 2.8.3 for js files and css files

= 2.8.6 [2020.04.30] =
* fixed an error notice on php

= 2.8.5 [2020.04.30] =
* bug fixes and some more minification default exclusions

= 2.8.4 [2020.04.24] =
* added frontend-builder-global-functions.js to the list of minification exclusions, but allowing merging (Divi Compatibility)

= 2.8.3 [2020.04.17] =
* Removed some options out of the autoload wp_option to avoid getting cached on the alloptions when using OPCache 
* Removed the CDN purge option for WP Engine (not needed since FVM automatically does cache busting)
* Added support for Kinsta, Pagely, Pressidum, Savvii and Pantheon
* Better sourcemaps regex removal from minified css and js files

= 2.8.2 [2020.04.13] =
* Skip changing clip-path: url(#some-svg); to absolute urls during css minification
* Added a better cronjob duplicate cleanup task, when uninstalling the plugin

= 2.8.1 [2020.03.15] =
* added filter for the fvm_get_url function

= 2.8.0 [2020.03.10] =
* improved compatibility with Thrive Architect editor
* improved compatibility with Divi theme

= 2.7.9 [2020.02.18] =
* changed cache file names hash to longer names to avoid colisions on elementor plugin

= 2.7.8 [2020.02.06] =
* updated PHP Minify with full support for PHP 7.4
* added try, catch wrappers for merged javacript files with console log errors (instead of letting the browser stop execution on error)
* improved compatibility with windows servers
* improved compatibility for font paths with some themes

= 2.7.7 [2019.10.15] =
* added a capability check on the status page ajax request, which could show the cache file path when debug mode is enabled to subscribers

= 2.7.6 [2019.10.10] =
* bug fix release

= 2.7.5 [2019.10.09] =
* added support to "after" scripts added via wp_add_inline_script 

= 2.7.4 [2019.08.18] =
* change to open JS/CSS files suspected of having PHP code via HTTP request, instead of reading the file directly from disk

= 2.7.3 [2019.07.29] =
* Beaver Builder compatibility fix

= 2.7.2 [2019.07.29] =
* fixed a PHP notice when WP_DEBUG mode is enabled on wordpress
* small improvements on google fonts merging

= 2.7.1 [2019.07.27] =
* fixed an AMP validation javascript error

= 2.7.0 [2019.07.23] =
* some score fixes when deferring to pagespeed is enabled

= 2.6.9 [2019.07.15] =
* custom cache path permissions fix (thanks to @fariazz)

= 2.6.8 [2019.07.06] =
* header preload fixes (thanks to @vandreev)

= 2.6.7 [2019.07.04] =
* added cache purging support for the swift cache plugin
* changed cache directory to the uploads directory for compatibility reasons
* better cache purging checks

= 2.6.6 [2019.06.20] =
* cache purging bug fixes
* php notice fixes

= 2.6.5 [2019.05.04] =
* fixed cache purging on Hyper Cache plugin
* removed support for WPFC (plugin author implemented a notice stating that FVM is incompatible with WPFC)
* improved the filtering engine for pagespeed insights on desktop

= 2.6.4 [2019.03.31] =
* fixed subdirectories permissions

= 2.6.3 [2019.03.30] =
* fixed another minor PHP notice

= 2.6.2 [2019.03.27] =
* fixed a PHP notice on urls with query strings that include arrays on keys or values

= 2.6.1 [2019.03.26] =
* fixed compatibility with the latest elementor plugin
* fixed adding duplicate cron jobs + existing duplicate cronjobs cleanup
* fixed duplicate "cache/cache" directory path
* changed the minimum PHP requirements to PHP 5.5

= 2.6.0 [2019.03.02] =
* fixed cache purging with the hypercache plugin
* fixed a bug with inline scripts and styles not showing up if there is no url for the enqueued handle
* changed the cache directory from the wp-content/uploads to wp-content/cache
* improved compatibility with page cache plugins and servers (purging FVM without purging the page cache should be fine now)
* added a daily cronjob, to delete public invalid cache files that are older than 3 months (your page cache should expire before this)

= 2.0.0 [2017.05.11] =
* version 2.x branch release

= 1.0 [2016.06.19] =
* Initial Release
