=== Page Template Thumbnails ===
Contributors: camdagr8, Cameron Tullos
Tags: admin, page template, thumbnails
Requires at least: 2.0.2
Tested up to: 3.0.1
Stable tag: 1.2

This plugin creates a thumbnail list of the available page templates. 


== Description ==

This plugin creates a thumbnail list of the available page templates.
<br>
Clicking a thumbnail updates the `Page Attributes -> Templates` drop down to the corresponding page template.


== Installation ==

1. Upload `page-template-thumbnails` directory to the `wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Take screen shots of each page template in use.
4. Name each thumbnail file the same as how it appears in the `Page Attributes -> Templates` drop down. Replace spaces with the underscore for legacy compatability (ex: Full Page Template = `Full_Page_Template.png`). This is how the plugin knows which thumbnail is associated with each page template.
5. Save the thumbnails to a directory on your site (ex: `wp-content/gallery/page_templates/`).
6. Navigate to: `Wp-admin -> Settings -> Page Template Thumbs` and set the options for the plugin. Be sure to set the Thumbnail Path to the directory where you saved your thumbnails. 


== Screenshots ==

1. Page Template Thumbnails
2. Settings


== Changelog ==

= 1.1 =
* Fixed plugin directory error.

= 1.2 =
* Update: international support