=== Amazon Widgets Shortcodes ===
Contributors: oncletom
Tags: amazon, affiliate, shortcode, monetization
Requires at least: 2.5+
Tested up to: 2.5.1
Stable tag: 1.0-a2


Keep your time and save your money with these Amazon widgets shortcodes. Standard compliants, easy to use and so on !

== Description ==

This plugin is made for you if you use Amazon Affiliate links (aka Amazon Associates, Amazon Partenaires etc.).

Copy&Paste Amazon Widgets HTML tags is boring and causing trouble if you switch between HTML and rich text editor.
Now you can earn money with affiliate links without any pain and with XHTML standard compliant code.

You may like it for these features:

* valid XHTML code
* deals nice with both HTML and Rich editors (no more glitches)
* RSS feed filtering (don't spam your feeds)
* minimal shortcodes (1 option and it runs)

The Todo-list is full of promising features. It will be hard to wait for them!

== Installation ==

The plugin is very basic and is primarily made for my own usage.

1. Simply upload the `amazon-widgets-shortcodes` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go in the `Settings` admin panel to customize at least your Amazon Tracking ID

Now you plug 'n play 'n earn money ;-)

== Usage ==

This plugin provides those following shortcodes. Please remember it's still in alpha development.

= Amazon Carrousel =

 * **Shortcode**: [amazon-carrousel][/amazon-carrousel]
 * **CSS Class**: `awshortcode-carrousel`
 * **Options**:
  * *align* [left, right, center]: align the widget on the desired way
  * *bgcolor* (CSS hexa or code value): customize the background color of the widget
  * *height* (value in pixels): height of the animation
  * *width* (value in pixel): width of the animation
 * **Content**:
  * URI provided in the code to paste, usually starting by `http://ws.amazon.com/widgets/`
 * **Example**: `[amazon-carrousel]http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&MarketPlace=FR&ID=V20070822%2FFR%2Fonctom-21%2F8010%2Ffc64116b-6b59-444b-b4ee-074a4adecf57&Operation=NoScript[/amazon-carrousel]`

= Amazon Product =
For now, it only handles this widget in the "Text + picture" version.

 * **Shortcode**: [amazon-product][/amazon-product]
 * **CSS Class**: `awshortcode-product`
 * **Options**:
  * *align* [left, right, center]: align the widget on the desired way
  * *alink* (CSS hexa or code value): hypertext link color
  * *bgcolor* (CSS hexa or code value): customize the background color of the widget
  * *bordercolor* (CSS hexa or code value): border color of the widget
  * *height* (value in pixels): height of the frame
  * *small* [0, 1]: display a small picture or a big one (0 by default)
  * *target* (string): window name to open the link in (_blank by default)
  * *width* (value in pixel): width of the frame
 * **Content**:
  * ASIN code of the product 
 * **Example**: `[amazon-product]0596529309[/amazon-product]`


== Release notes ==

= Version 1.0 alpha 2 =

 * new widget : Amazon Product (text + picture)
 * file organization revamping
 * new option to define default alignment of widgets
 * handling widget alignment (previously customizable but not used)
 * added CSS class to widget container to ease their styling from your stylesheets
 * options are handled by the admin dashboard, no need to edit config.php anymore

= Version 1.0 alpha 1 =

 * Improved documentation
 * Provides filter for syndication feed publishing (avoid the display of affiliate media in your feed)
 * Separation of the code ; `trunk` is for dev version

== Todo-list ==
1. Add a "copy/paste" feature that magically converts the HTML code in Wordpress shortcode
1. Add a widget feature to add directly your Amazon Widgets in any sidebar of your blog
1. Add support for i18n
1. Support for these widgets:
 * Context link
 * Slideshow
 * Products cloud
 * My favourites
 * Wishlist
 * etc.
1. Earning a lot of money thanks to this widget ;-)
