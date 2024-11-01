=== WP SHAPES ===
Requires at least: 4.6
Tested up to: 4.9
Requires PHP: 5.6
Contributors: holithemes
Donate link: https://www.paypal.me/ugadi
Stable tag: trunk
Tags: wp shapes, css shapes, wp css shapes, image shapes, content shape, text shape, shape-outside, svg, enable svg, holithemes
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Wrap Inline Content around image on one side.

== Description ==
Add transparent image using this plugin shortcode makes the inline content wrap around the images on one side left or right.

Instead of content looks like a box shape, now content looks in a shape based on image

for more information and to get an idea please check the demo. 

[Documentation, Demo, Examples](https://holithemes.com/wp-shapes/)

Happy to say that, This is the first WordPress plugin released in public, based on CSS Shapes

= note =
This plugin is build based on CSS Shapes
It a new css feature. Currently 80% of the usage browsers [supports](https://caniuse.com/#feat=css-shapes) this feature. 
And some other browsers are in development. Expect to launch soon.

If browser supports then content shape will appear.
If browser not supports then content appear in normal way. like box shape


= Enable SVG Images =
By default WordPress not supports uploading SVG images.
At plugin setting page, We can enable upload SVG Images.

== Documentation ==
Its easy to get started with WP-Shapes plugin

= step-1 : upload image and get image id =

Upload images from Dashboard

Media -> add New  - and upload images

after uploading images, WordPress adds an ID for each image.

to get ID of images

Media  ->  Media Library 

set the image to view as list instead of grid view

then at image when hover the mouse 

can notice at bottom left corner with an url 

at there we can notice post=<id-number>

[more info](https://holithemes.com/wp-shapes/how-to-find-image-id-wordpress/)


= step-2: Add shortcode and its attributes =

Add shortcode in WordPress post edit with a attribute

[shape id=40]

id=40, 40 is the image id.

[more info](https://holithemes.com/wp-shapes/shortcodes/)


= Adding svg images =

WordPress defaults to not support uploading SVG images

If you like to add svg images, at wp admin 
go to menu  - wp css shapes - and then checkmark - enable svg images
and save changes

[more info](https://holithemes.com/wp-shapes/enable-svg-images-upload/)


== screenshots ==

1. Enable SVG Images
1. Add shortcode - e.g.
1. Result
1. sample 1
1. sample 2
1. sample 3
1. Find image ID
1. If browsers supports
1. If browsers not supports


== Installation ==

= using FTP or similar =
* unzip wp-shapes file and 
* Upload "wp-shapes" folder to the "/wp-content/plugins/" directory.
* Activate the plugin through the "Plugins" menu in WordPress.

= From Dashboard ( WordPress admin ) =
* plugins -> Add New
* search for 'wp shapes'
* click on Install Now  and then Active.

== Upgrade Notice ==

= using FTP or similar =
* Delete wp-shapes folder - your setting will not lost.
* unzip wp-shapes file and 
* Upload "wp-shapes" folder to the "/wp-content/plugins/" directory.
* Activate the plugin through the "Plugins" menu in WordPress.

= From Dashboard ( WordPress admin ) =
* If plugin new version released - you can see 'update now' link at wp-admin -> plugins
* click on 'update now'

== Changelog ==

= 1.0 =
* Initial release.