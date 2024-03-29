=== Fluency Admin ===
Contributors: deanjrobinson
Donate link: http://deanjrobinson.com/donate/
Tags: fluency, admin, plugin, theme, login, design, color scheme
Requires at least: 2.9
Tested up to: 3.0
Stable tag: 2.3.2
Text Domain: fluency-admin

Give your WordPress admin the Fluency look, Fluency 2.3.2 is the latest update and is compatible with WP 3.0.x.

== Description ==

Fluency Admin give the WordPress admin interface a boost, with a new style and some cool features.

Features include:

* Hover menus
* Switch between full menu view and icon-only view
* Hot keys for menu/submenu access
* Support for both Grey and Classic/Blue color schemes (now with a third 'Coffee' color scheme included)
* Turn on/off Fluency login styles
* Display your own custom logo on WP Login page

New in Fluency 2.3:

* Compatibility with WordPress 3.0
* Add your own custom link to your custom logo on the WP login page
* Display your own custom logo at the top of the WP Menu once logged in.
* Turn Hover menus on/off
* Turn Hot Keys on/off
* iPad friendly menus
* Improved support for Opera 10.5+
* Added 'Coffee' color scheme (set in your profile) (2.3.1)
* .pot file now included for those wishing to translate Fluency (2.3.1)
* See changelog for full list of changes/additions

== Installation ==

There a couple of ways to install Fluency Admin on your WordPress blog.

First up, you can download it directly from the WordPress.org plugins directory, and install it by following these steps:

1. Upload the whole fluency admin directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

Or, you can install it directory from the Admin section of your WordPress blog by following these steps:

1. Under the 'Plugins' menu in WordPress select 'Add New'
2. Enter 'Fluency Admin' into the search box
3. Choose the 'install' option on the right hand side of the Fluency Admin listing

== Frequently Asked Questions ==

= What browsers does this work in? =

Fluency Admin has been tested in the latest versions of Safari, Firefox, Opera and Internet Explorer. Users of Internet Explorer may experience some display "issues" to to each browsers particular css-handling ability.

Internet Explorer 6 is NOT supported. It is an 8 year old browser which has now been superseded twice. Upgrade. Please.
Internet Explorer 7 works with the exception of a few display bugs.
Internet Explorer 8 works pretty well except for the lack of CSS3.

= Why doesn't my plugin work with Fluency? =

The majority of plugins should work without issue when Fluency is activated, however there are a few that don't for one reason or another. If you come across a plugin that doesn't play nice with Fluency please let me know so that I can address any issues in a future release.

Most common cause of a plugins incompatibility are highly custom admin pages, ie. those that don't follow the standard WordPress admin design. In the majority of these cases its not particularly feasible for me to write a bunch of custom styles just to get them to play nice.

= I'm using a version of WordPress other that 3.0.x and some things look weird, what can I do? =

The obvious suggestion would be for you to upgrade to WordPress 3.0, if you are unable to do this for one reason or another then I would suggest downloading a previous version of Fluency (Fluency 2.2 for WP2.9 and Fluency 2.1 for WP2.8).

= How do I get support for plugin X to be added to Fluency? =

Leave a comment on my blog or post something in the support forums here on WordPress.org or on my Help site (http://help.deanjrobinson.com/groups/fluency-admin/).

Please note that I will not test be testing commercial paid for plugins or those that require me to signup to some spam laden site just to download and/or use them.

= What plugins have been tested with Fluency Admin? =

The following plugins have been tested with Fluency 2.3, any minors issues noted.

It's worth noting that most issues that other plugins have are due to poorly designed/coded admin pages, some of this issues I can 'hack' around with css, but many should be fixed by the author of the plugin in question.

* Acronyms 1.6.2
* Akismet
* Analytics360
* cFormsII 11.1 (not pretty, but functional, the admin pages are too far from the WP standard)
* Contact Form 7
* Event Calendar
* Events Calendar 6.6
* Feedburner Feed Replacement
* Fresh Page (Flutter) 1.1
* Google Analytics
* Google XML Sitemaps
* Gregarious (not pretty, but fully functional)
* Headspace2 3.6.32
* MEENEWS 2.7.1 (not pretty, but seems to be functional)
* My Category Order 2.8.3
* NextGen Gallery 1.4.3
* One Click Plugin Updater 2.4.14
* OpenID
* Order Categories
* Page Management Dropdown 2.1
* PageMash 1.3.0
* Simple Tags
* Simple:Press 4.3.1 (not pretty at all, although still seems functional. Pulls in login stylesheet when logged out of forums - plugin problem, incorrectly calling 'login_head' action - this is not a Fluency problem)
* Subscribe To Comments
* TDO Mini forms 0.13.7
* WordPress Download Monitor
* WP-Polls 2.50
* WP-PostRatings
* wp-typogrify
* WP Movie Ratings

= What languages does Fluency Admin support? =

Thanks to some great Fluency users the following translations are included in the Fluency Admin download.

* Spanish translation (Thanks to David http://www.verasoul.com)
* Turkish translation (Thanks to Tercan Keskin http://www.tercan.net)
* Italian translation (Thanks to Daniele Raimondi http://www.w3b.it)
* Chinese translation (Thanks to JackyTsu)

Please note I am not responsible for any errors in these translations, they have been included 'as provided'.

If you're interested in supplying a translation for your language please get in contact, you'll find the .pot file in the 'languages' folder to get you started.

== Screenshots ==

1. The Dashboard
2. Add New Post
3. Edit Posts
4. Blue/Classic color scheme - Dashboard
5. Blue/Classic color scheme - Add New Post
6. Blue/Classic color scheme - Edit Posts
7. Coffee color scheme - Dashboard

== Changelog ==

= 2.3.2 =
* Fixes disappearing 'hide menu' button bug (hopefully)
* Fixes 'Comments' menu item link color when active
* Fixes 'Comments' link overlap when menu is collapsed and additional plugins have added top level menu items directly below it
* Footer overlap issue is being caused by bug in WordPress, bug reported (ticket #14098), now fixed in trunk
* Added Spanish translation (Thanks to David http://www.verasoul.com)
* Added Turkish translation (Thanks to Tercan Keskin http://www.tercan.net)
* Added Italian translation (Thanks to Daniele Raimondi http://www.w3b.it)
* Added Chinese translation (Thanks to JackyTsu)

= 2.3.1 =
* Fixes menu position bug on Appearance > Menus
* Re-added two-column sub menus (when menu height exceeds window height)
* Change to the styling of the 'update nag'. Protip: If you don't like the styling, upgrade your WP install and it'll go away ;)
* Add 'Coffee' color scheme (set in your profile)
* .pot file added to 'languages' folder (send me your translations and I'll include them in future releases)

= 2.3 =
* Updated css to work with changes introduced in 3.0
* Updated menu and page icons so that Grey and Blue styles match
* Fixed styles for 'Register' and 'Lost Password' pages
* Fixed Fluency option saving - customisations should now show instantly, no need for a second refresh
* Fixed minor bugs in menu styles - mainly to do with custom menu widths
* Fixed display of Akismet stats page when viewed from Comments menu
* Fixed overlap issue with BuddyPress admin bar
* Restyled 'Manage Themes' admin page
* New 'filter bar' style on edit post/page/link etc listing pages
* New style for comment/update notification bubbles
* Rewrote menu javascript to support both hover and click style menus
* Added option to disable hover menus - returns to click-to-open style, auto-disables fixed position menu and hot keys
* Added iPad 'finger friendly' menus - auto-disables hover menus, fixed positioning and hot keys
* Added contextual help on the Fluency Options page.
* Improved support for Opera 10.5+
* Improved documentation of plugin code

= 2.2 =
* Updated css to work with changes introduced in 2.9
* Fixed Login styles for WP2.9
* Now using wp_enqueue_style and wp_enqueue_script functions
* Added custom menu width option for users with wide menu items that were previously wrapping over multiple lines
* Added option to disable the fixed positioned menu for users with lots of plugins that add menu items or that have small screens

= 2.1.1 =
* Fixed display issues with Acronyms, NextGen Gallery, One-Click Plugin Updater, HeadSpace2 and WP-Polls
* Fixed broken styling of Media Library popup
* Fixed custom menu icons no longer display over default icon
* Fixed positioning of "Update WordPress" message (not perfect, but better)
* Added option to set custom logo to display at the top of the menu (replaces WordPress logo)

= 2.1 =
* Updated css to work with slight changes introduced in WordPress 2.8.x
* Updated menu script to fix bug with long submenus disappearing off screen.
* Updated hotkeys to work with submenus longer that 9 items
* Added support for collapsing/showing side menu.
* Added Blue/Classic color scheme (based on user preference).
* Added option to disable the Fluency style on the login screen.
* Added option to specify a custom logo to be show on the login screen.
* Added function to add Akismet menu item to the Comments submenu (if Akismet is activated)

= 2.0 =
* Complete re-write of Fluency to work with the all-new Admin interface that was introduced in WordPress 2.7

== Upgrade Notice ==

= 2.3.2 =
* Includes important bug fixes, plus Spanish, Turkish, Italian and Chinese translations

= 2.3.1 =
* Includes bug fixes and an additional 'coffee' color scheme

= 2.3 =
* Recommended upgrade for users that have upgraded to WordPress 3.0