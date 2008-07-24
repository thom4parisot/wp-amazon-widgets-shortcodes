=== Amazon Widgets Shortcodes ===
Contributors: oncletom
Donate link:
Tags: amazon, affiliate, shortcode, monetization, context, links, product, preview, carrousel, documentation, plugin, slideshow, admin, post, page
Requires at least: 2.5
Tested up to: 2.6
Stable tag: 1.0


Keep your time and save your money with these Amazon widgets shortcodes. Standard compliants, easy to use and so on !

== Description ==

This plugin is made for you if you use Amazon Affiliate links (aka Amazon Associates, Amazon Partenaires etc.).

Copy&Paste Amazon Widgets HTML tags is boring and causing trouble if you switch between HTML and rich text editor.
Now you can earn money with affiliate links without any pain and with XHTML standard compliant code.

You may like it for these features:

* international support (Canada, France, United Kingdrom, USA)
* valid XHTML code
* deals nice with both HTML and Rich editors (no more glitches)
* RSS feed filtering (don't spam your feeds)
* minimal shortcodes (1 option and it runs)
* inlined documentation to help you using the shortcodes while writing your posts


Currently supported Amazon widgets/features:

* Carrousel Widget
* Context Links
* Product Preview
* Product Links (text + picture)
* Slideshow Widget

The Todo-list is full of promising features. It will be hard to wait for them!

== Installation ==

The plugin is very basic and is primarily made for my own usage.

1. Simply upload the `amazon-widgets-shortcodes` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go in the `Settings` admin panel to customize at least your Amazon Tracking ID

Now you plug 'n play 'n earn money ;-)


== Release notes ==

= Version 1.0 =
 * added Strict Standards compliance mode (`object` instead of `iframe`)
 * added region support for United Kingdom
 * added Slideshow widget support
 * Amazon Partner developer center aware of the plugin (not a feature I admit)
 * markup fix (no more `<p>` embracing the shortcode)

= Version 1.0 beta 1 =
 * added region support (USA, Canada and France for now)
 * added Product Preview support
 * inlined documentation in the edit page/post screen
 * added extra links to declare bugs and official homepage
 * revamped some parts of code
 * improved stability while plugin is a symlink (activation hook now works)
 * updated the options pages with a tabbed view
 * fixed some translation issues
 * added screenshots to convince you it's a good plugin ;-)

= Version 1.0 alpha 3 =
 * internationalisation support (i18n, english and french)
 * "hide widgets in feed" renamed as "show widgets in feed" to match better the setting name (more natural)
 * basic support of context links (no options for now)

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
1. Add support for all Amazon Partners programs
1. Support for these widgets:
 * Products cloud
 * My favourites
 * Wishlist
 * etc.
1. Makes you earning a lot of money thanks to this widget ;-)

== Frequently Asked Questions ==

= What are those shortcodes? =
It is a bundled Wordpress feature. It looks like this : `[shortcode]sample value[/shortcode]`.
It looks like nothing but it is an expandable feature so we can plug our own shortcodes ... like with this widget.

= How can I use the shortcodes? =
For now, there is an inlined documentation right below your post/page edit screen. It explains all shortcodes
and how you can customize their usage.

You will see, it's easy.

= Won't context links garbage my whole page? =
No it won't.

I added a filter so the context links areas are confined to post and page contents.
If politely asked, I can make this customizable from the plugin management page.

= Why a Beta ? I can't use it? =
I consider this plugin as really stable one in term of usage. However not every feature
are yet complete (especially concerning customization).

So I prefer to encourage only g33k and technical people to use it.

However, I make all my best to keep the plugin as much stable as possible. It will avoid you
to edit all the post you included widgets in. Better isn't it?

= Nespresso, what else? =
Yep, what else?

But no, George Clooney neither Nespresso are a feature of this plugin. Too bad!

== Screenshots ==

1. Main configuration panel
2. Extra tools configuration panel
3. Inlined documentation
