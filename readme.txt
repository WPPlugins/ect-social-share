=== ECT Social Share ===
Contributors: etemplates
Donate link: http://www.ecommercetemplates.com/donations.asp
Tags: Wordpress ecommerce, ecommerce, online store, sell products, shopping cart, wordpress store, wordpress shopping cart, ecommerce software, seo, meta description, title tag, search engine friendly, search engine optimization
Requires at least: 3
Tested up to: 4.7.2
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allow customers to share their purchases on Facebook, Twitter, Pinterest and Google +.

== Description ==

This plugin is for Ecommerce Templates shopping cart with WordPress only and allows customers to share their purchase details on Facebook, Twitter, Pinterest and Google + following purchase. You can choose which social media outlets to offer and suggest default text and headings that can be shared along with the product image. The layout is responsive and will appear on the thanks page following the order summary.

Please note, the ECT Social Share plug-in is only available for Ecommerce Templates shopping cart software WordPress integration.

For more details, screenshots and information please visit [Ecommerce Templates for WordPress](http://www.ecommercetemplates.com/wordpress-ecommerce.asp).

**Key Features**

* Choose which social media outlets you want to support
* Define the default text and headings
* Responsive Design compatible
* Configurable CSS

**Notes**

The ECT Social Share plug-in is only available for Ecommerce Templates shopping cart software WordPress integration.

**View Demo Store**

We have set up a [demo store](http://ectwp.com/) using the Responsive theme and Ecommerce Templates shopping cart where you will also find examples of the [ECT Social Share plugin](http://ectwp.com/plugins/).

**Support**

If you have any problems with the plugin please post your support questions here on the WordPress support forum. Any questions about the shopping cart or WordPress integration can be posted on the Ecommerce Templates support forum. 

If you have a problem with the plug-in please don't just give it a bad rating or review without seeking our help first.

**Plug-in resources**

[Plug-in home page](http://www.ecommercetemplates.com/wordpress/wp-plugins.asp) - [Shopping cart home page](http://www.ecommercetemplates.com/wordpress-ecommerce.asp) - [Demo](http://ectwp.com/)

== Installation ==

1. Unzip and upload the folder 'ect-social-share' to the '/wp-content/plugins/' directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Upload the file "incectsocialshare.php" to the vsadmin/inc folder
1. Go to the ECT Social Media Plugin Settings page in the WordPress admin and choose which social media outlets you want to support
1. Enter the default text in the field provided
 Share URL: The URL of your store including the "http://"
 Share Subject: The title which will appear on the thanks page
 Title on Facebook: The suggested title of the posting on Facebook
 Share Text: Suggested text to accompany the product image. There are two variables available %%PRODUCT_NAME%% which replaces the product name and %%STORE_URL%% which will show the Store URL. For example you might want to enter something like this
 Have a look at the %%PRODUCT_NAME%% I have just bought from %%STORE_URL%% 
 1. Open the file thanks.php and change this line
 <?php
 include "vsadmin/inc/incthanks.php";
 ?>
 to
 <?php
 include "vsadmin/inc/incthanks.php";
 include "vsadmin/inc/incectsocialshare.php";
 ?>

 Now try a test order and check the results.

== Frequently asked questions ==

= Can I use this plug-in with any shopping cart software or WordPress site? =

NO, this plug-in can only be used with [Ecommerce Templates shopping cart software](http://www.ecommercetemplates.com/wordpress-ecommerce.asp) using the WordPress integration.

= Will this share all items that were purchased? =

No, it will just share the first item added to cart.

== Screenshots ==

1. Thanks page display
2. WordPress admin display

== Changelog ==

= 1.1 =
* Code fixes and version update. January 31st 2017
= 1.0 =
* Initial Release. December 19th 2013