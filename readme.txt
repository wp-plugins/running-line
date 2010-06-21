=== Running Line ===
Contributors: Ruben Sargsyan
Donate link: http://rubensargsyan.com/donate/
Tags: running line, ads, advertisment, advertise
Requires at least: 2.6
Tested up to: 3.0

If you would like to have your running line on your Wordpress blog, so this plugin is just for you!

== Description ==

If you would like to have your running line on your Wordpress blog, so this plugin is just for you! It gives you the possibility to show one of the posts from your chosen category by the running line. So download and enjoy!

In administration interface you can do the following settings:
1. select order type of chosen category posts
2. select the direction of the running line
3. select the position of the running line
4. set running line scroll speed
5. set running line height
6. set running line text font size
7. set running line text color
8. set running line border size
9. set running line border color
10. set running line background color
11. set running line padding

== Installation ==

1. Upload the running-line directory (including all files within) to the /wp-content/plugins/ directory
2. Activate the plugin through the Plugins menu in WordPress

== Frequently Asked Questions ==

= There is no running line after activation or the running line is not completely seen in the bottom of page. =

Make sure that the code `<?php wp_footer(); ?>` is included in your theme's `footer.php` file just before the `</body>` line.

== Screenshots ==

1. The Running Line
2. Administration Interface

== Changelog ==

= 1.2 =
* Added new events on running line: running line is stopped when the mouse moved over it and starts when the mouse is out of the running line, if you click on the running line it moves to the post page.

= 1.1 =
* Added new option "select the position of the running line".
* Fixed some bugs.

= 1.0 =
* First release.