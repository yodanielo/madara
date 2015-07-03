=== Plugin Name ===
Contributors: automattic, niallkennedy, josephscott, hailin
Plugin Name: VideoPress
Tags: video, videopress, wpvideo, WordPress.com
Requires at least: 2.7
Tested up to: 2.9
Stable tag: 1.1.2

Manage and embed videos hosted on a WordPress.com blog with the VideoPress upgrade.

== Description ==

Add VideoPress videos stored on WordPress.com to your self-hosted WordPress.org site through the use of simple shortcodes. Edit video metadata directly from your blog's administrative interface.

The VideoPress plugin allows blog administrators to upload new videos to their WordPress.com video account and manage existing videos from the convenience of their self-hosted WordPress.org blog's administrative interface. Authors can add any VideoPress video into a blog post through the use of a simple shortcode and customizations.

This plugin allows you to click a button to login to your WordPress.com video blog, retrieve a video's `[wpvideo xyz]` shortcode, and insert it into your post. 
You can specify the width and height of the video container with w= h= shortcode attributes. The following are all valid shortcodes:

* `[wpvideo xyz]` uses your default theme content_width if present, otherwise uses 400px as width.
* `[wpvideo xyz w=640]` specifies the width of video container to be 640px while preserving the aspect ratio.
* `[wpvideo xyz w=640 h=360]` specifies both width and height of the video container.
* `[wpvideo xyz h=300]` specifies the height of the video container to be 300px, while preserving the aspect ratio.

You will need an account on WordPress.com with the VideoPress upgrade in order to use this plugin. If you don't have already have a WordPress.com account signing up is easy and only takes a few minutes. Then go to the "Upgrades" section of wp-admin on your new WordPress.com blog and purchase a [VideoPress upgrade](http://wordpress.com/products/#videopress "VideoPress WordPress.com upgrade").

== Installation ==

Installing should be very easy and take fewer than five minutes.

1. Upload `video.zip` into your blog's plugins directory (typically `/wp-content/plugins/`)
2. Unzip the `video.zip` file
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Manage and embed videos on the post edit screen by clicking on the new media icon (looks like a camcorder).

== Frequently Asked Questions ==

= Do I need a WordPress.com account to use this plugin? =

Yes.  This plugin relies on a WordPress.com blog with the VideoPress upgrade to host videos and related information.

= Can I use this plugin to host videos on my own server? =

No.  This plugin requires a WordPress.com blog with the VideoPress upgrade and has no support for hosting videos on your own server.

== Screenshots ==

1. Edit video metadata and a video to your self-hosted WordPress.org blog from your blog's administrative interface.
2. Embed VideoPress videos in blog posts with a shortcode.

== Changelog ==
= 1.1.2 =
* Improves support for private videos restricted by playback domain
* Includes SWFObject JavaScript handlers for Flash required version detection and DOM manipulation across browsers.

= 1.1.1 =
* Fixes render issue in some versions of Internet Explorer

= 1.1 =
* XML-based parsing
* Display error message to blog users with edit_posts capability when an embed fails for a known reason such as restricted embed domains.
* Double-baked objects for standards compatibility with all blogs.

= 1.0 = 
* up the ver number to update plugin dir

= 0.2.1 = 
* add site flashvar

= 0.2.0 =
* Fixed various width and height issues, and handles default width height correctly

= 0.1.1 =
* Fix the problem with users getting redirected outside of the iframe

= 0.1.0 =
* Initial release

== Upgrade Notice ==

= 1.1.1 =
Fixes render issues on some versions of Internet Explorer.

= 1.1 =
Improved embed codes for browsers and feed using standards-compliant markup. Cached VideoPress XML data is now stored with your WordPress install. Displays warning message for failed video embeds to blog users capable of editing posts.
