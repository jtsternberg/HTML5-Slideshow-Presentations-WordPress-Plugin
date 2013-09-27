=== Plugin Name ===
HTML5 Slideshow Presentations

Contributors: jtsternberg
Plugin Name: HTML5 Slideshow Presentations
Plugin URI: http://j.ustin.co/s3bst2
Tags: slideshow, presentations, html5, css3, slides, slideshare, speaker presentations, powerpoint, keynote
Author URI: http://j.ustin.co
Author: Jtsternberg
Donate link: http://j.ustin.co/rYL89n
Requires at least: 3.1
Tested up to: 3.6
Stable tag: 1.0.7
Version: 1.0.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create HTML5 slideshow presentations using our favorite cms, WordPress. Host your own presentations and share/present them anytime.

== Description ==

With this plugin, You'll be able to create a presentation in no time using WordPress' familiar built-in toolset, and the best part is, You won't need to upload to slideshare when you're done. You're hosting your own presentations and can share/present them anytime. The presentation template is based on [html5slides](http://code.google.com/p/html5slides/) by Luke Mahé and Marcin Wichary. This plugin was built with CSS3 and HTML5 and is intended to be used on modern browsers.

Feel free to [contribute to this plugin on github](http://j.ustin.co/zMQtc0).

--------------------------

= Demo =

[http://dsgnwrks.pro/html5-presentation-example](http://j.ustin.co/yZe7Il)

--------------------------

= Instructions for editing slides =

If you [view the demo](http://j.ustin.co/yZe7Il), it will walk you through the styles and slide types available in this plugin. The sample presentation is available for you to download so you can see the slides in action.  Just [download the xml file](http://j.ustin.co/yk0vMn), and import it to WordPress the way you normally import WordPress to WordPress.

= Customizing the Plugin =

If you want to use your own styles and completely disregard the default styles provided, add a stylesheet named `html5slide-replace.css` to your theme folder. If you would like to add a stylesheet in addition to the one provided, instead add a stylesheet named `html5slide-style.css` to your theme folder.

The plugin provides an option to enable/disable `<?php wp_head(); ?>` as well as `<?php wp_footer(); ?>`.

This plugin is intended to operate completely independent of your installed theme, so by default this option is off. You may find that when `<?php wp_head(); ?>` is enabled, that your theme, and other plugins stylesheets may interfere with the default stylesheet, but you may be missing other plugins functionality if you disable it.

The `<?php wp_footer(); ?>` option will allow the admin bar to be displayed on the slide page (if it is enabled) and will allow other plugins and your theme to add functionality. If you have a plugin that keeps track of analytics and you want it to track the slide pages, you will probably want this enabled.

That being said if you don't want `<?php wp_head(); ?>` or `<?php wp_footer(); ?>` enabled, you can use the built-in hooks, `dsgnwrks_html5_head();` and `dsgnwrks_html5_footer();` to add functionality to the slide pages.

--------------------------

*Example:*

	<?php
	add_action( 'dsgnwrks_html5_footer', 'add_slide_google_analytics' );
	function add_slide_google_analytics() {
		?>
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try{
		var pageTracker = _gat._getTracker("UA-xxxxxx-x");
		pageTracker._trackPageview();
		} catch(err) {}
		</script>
		<?php
	}
	?>

--------------------------

= Different Slide Types =

Each Slide has several options for determing the type of slide, whether it is a slide without a title, a segue slide, if you want animated revealing child elements, ect.

= Different layouts =

Each "Title Slide" has a few options for determining the type of presentation, including whether it's widescreen, "Faux Widescreen," or standard, and if the presentation will have a logo stamp on the bottom right (the featured image).

--------------------------

= Instructions for presenting =

After you create a presentation, create a page to display it on. You'll see a new dropdown menu for choosing HTML5 Presentations. Select you presentation, save and view!

* Press Enter, space, right arrow to advance; Backspace, left arrow to go back.
* Enter full-screen mode (F11 or Shift-Command-F in Chrome) before presenting.
* You should be able to press Ctrl+R/F5/Cmd+R at any time to refresh without losing your place in the presentation.
* If an iframe steals your focus and you can’t advance any more, please click outside the slide on the background to give the focus back to the presentation.

--------------------------

= Caveats =
These presentations should work on modern Chrome, Firefox, Safari, Opera… and generally touch devices. Your mileage in IE9 may vary.


== Installation ==

1. Upload the `html5_slideshow_presentation` directory to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Visit the plugin settings page (`/wp-admin/options-general.php?page=html5presentation-settings`) to verify the plugin options you want enabled.
4. Add/Edit Presentation Slides with the new post-type added in the sidebar (`/wp-admin/edit.php?post_type=html5presentation`).

== Frequently Asked Questions ==

= ?? =
If you run into a problem or have a question, contact me ([contact form](http://j.ustin.co/scbo43) or [@jtsternberg on twitter](http://j.ustin.co/wUfBD3)). I'll add them here.


== Screenshots ==

1. Sample slide.
2. Title slide edit screen.
3. Slide Management.
4. Plugin Options.
5. Slides overview (large screen).
5. Create a WordPress Page, and choose your presentation.

== Changelog ==

= 1.0.7 =
* Add META header for IE 9+ compatibility mode. props (fabienbancharel)[https://github.com/jtsternberg/HTML5-Slideshow-Presentations-WordPress-Plugin/pull/1].

= 1.0.6 =
* Would you believe another "build" lists bug fix? Also addressed some php notices.

= 1.0.5 =
* Fixed another bug with the "build" lists not working correctly in some instances.

= 1.0.4 =
* Fixed a bug with the "build" lists not working correctly in some instances.

= 1.0.3 =
* Added default WordPress admin styles to the default stylesheet. Also added an optional "Return to the beginning" navigation element by using the id of "back-to-beginning"

= 1.0.2 =
* fix link to plugin uri in readme.txt and plugin files

= 1.0.1 =
* Removed dead options to allow edit link on slides.

= 1.0 =
* Launch.


== Upgrade Notice ==

= 1.0.7 =
* Add META header for IE 9+ compatibility mode. props (fabienbancharel)[https://github.com/jtsternberg/HTML5-Slideshow-Presentations-WordPress-Plugin/pull/1].

= 1.0.6 =
* Would you believe another "build" lists bug fix? Also addressed some php notices.

= 1.0.5 =
* Fixed another bug with the "build" lists not working correctly in some instances.

= 1.0.4 =
* Fixed a bug with the "build" lists not working correctly in some instances.

= 1.0.3 =
* Added default WordPress admin styles to the default stylesheet. Also added an optional "Return to the beginning" navigation element by using the id of "back-to-beginning"

= 1.0.2 =
* fix link to plugin uri in readme.txt and plugin files

= 1.0.1 =
* Removed dead options to allow edit link on slides.

= 1.0 =
* Launch

== Presentation Examples ==

= Send me your presentations! =
Send me links to presentations you make ([contact form](http://j.ustin.co/scbo43) or [@jtsternberg on twitter](http://j.ustin.co/wUfBD3)), and I'll post them here, as well as on my site.

= Sample Slide Show =
[http://dsgnwrks.pro/html5-presentation-example](http://j.ustin.co/yZe7Il)