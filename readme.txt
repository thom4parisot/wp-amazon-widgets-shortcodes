=== Amazon Widgets Shortcodes ===
Contributors: oncletom
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=752034
Tags: amazon, affiliate, shortcode, shortcodes, monetization, context, links, product, preview, carrousel, documentation, plugin, slideshow, admin, post, page, tinymce, wysiwyg, wpmu
Requires at least: 2.5
Tested up to: 3.1
Stable tag: 1.6.1


Keep your time and save your money with these Amazon widgets shortcodes. Standard compliants, easy to use and so on !


== Description ==

Easy management of Amazon Links & Widgets on your blog. Preserve your post consistency, use copy/paste Amazon code or build your links with an easy to use interface

**Hot Features**

* switch from TinyMCE to HTML without loosing anything!
* international Amazon support (Canada, France, Germany, Japan, United Kingdom, USA)
* easy insertion from TinyMCE
* autoconfigure from copy/paste code
* minimal shortcodes (1 option and it runs)
* inline documentation for people who want to manually write Amazon Shortcodes

**Other Features**

 * XHTML Strict validation
 * RSS feed filtering (don't spam your feeds)
 * Amazon Context Links

**Available Amazon Widgets**

* Carrousel Widget
* Deals Widget
* MP3
* My Favorites Widget
* Product Preview
* Product Links
* Slideshow Widget
* Product Cloud Widget
* Wishlist Widget

**Built-in Translations**

* Belorussian (by [Fat Cow](http://www.fatcow.com/))
* English
* French
* Italian (by [Gianni Diurno](http://gidibao.net/))
* Russian (by [ilyuha](http://antsar.info/)]
* Uzbek (by [Alexsandra Bolshova](http://www.comfi.com/)]


Don't forget to look at the [screenshots](http://wordpress.org/extend/plugins/amazon-widgets-shortcodes/screenshots/) if you are not convinced.

== Installation ==

The plugin is very basic and is primarily made for my own usage.

1. Simply upload the `amazon-widgets-shortcodes` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go in the `Settings` admin panel to customize at least your Amazon Tracking ID

Now you plug 'n play 'n earn money ;-)


== Todo-list ==
1. Provide an API to let other developers to plug-in
1. Blog sidebar Widgets
1. Profile management
1. Widgets management
1. Amazon Associate browsing in the same window
1. Support for these widgets:
 * aStore
 * Banners
 * Dynamic Links
1. Makes you earning a lot of money thanks to this widget ;-)


== Changelog ==
= Version 2.0 =
*Work in progress*.

Please notice that this forthcoming version **will require at least**:

 * PHP 5.1.2 (so that the `spl_autoload` function is available)
 * WordPress 3.0

= Version 1.6.1 =
 * fix: disabled widgets messed up things when none set (as said, always...)

= Version 1.6 =
 * added support for Amazon Italia (restricted to Products so far)
 * admin: you can now enable/disable some widgets
 * i18n: updated strings
 * widget: fixed Link Enhancer for Germany (was displaying Canadian links)
 * widget: fixed Amazon Products for Germany (was displaying Canadian links)
 * widget: fixed Link Enhancer for Japan (was displaying French links)
 * multisite: by default, all new blogs have the plugin enabled
 * multisite: by default, a new blog import your Tracking ID and region

= Version 1.5.2 =
 * i18n: added Russian translation
 * i18n: added Uzbek translation

= Version 1.5.1 =
 * fixed plugin uninstall process ([report topic](http://wordpress.org/support/topic/241974))
 * ui: fixed *apply the magic* color for WordPress 2.8
 * widget: fixed Amazon Product widget alternate pattern parsing ([report topic](http://wordpress.org/support/topic/293885))
 * widget: fixed Amazon Product widget display for Amazon Japan ([report topic](http://wordpress.org/support/topic/292387))

= Version 1.5 =
 * support of the `Changelog` feature
 * i18n : fixed relocated WordPress folder for WordPress 2.7+ ; translations were not loading due to wrong path
 * ui: documentation tab now displays the ... documentation (it helps a bit ...)
 * widget: added MP3 Widget
 * widget: fixed 'apply the magic' parser which missed some ASIN codes with alpha chars inside (reported by [DavidBorrink](http://wordpress.org/support/profile/20995))
 * widget: fixed Germany widgets (reported by [jetztlernin](http://wordpress.org/support/profile/3392887))
 * widget: fixed some inconsistencies with titles and regions

= Version 1.4.1 =
 * i18n: new Belorussian translation thanks to [Fat Cow](http://www.fatcow.com/)

= Version 1.4 =
 * added configuration link within plugins list
 * added support for Amazon Germany
 * added support for Amazon Japan
 * fixed typo in documentation (`Amazon My Favourites` example)
 * tinymce: fixed tracking ID parsing with some Flash Widget (messed up with classID)
 * widget: added Deals Widget
 * widget: fixed Context Links for Amazon Japan (missing feature so far)

= Version 1.3.2 =
 * fixed classname typo for "My Favourites widget"
 * fixed an issue on some hosting plans which display a 404 page in TinyMCE Editor
 * removed inlined CSS to use .alignleft, .aligncenter, .alignright WP classes (props of tbrincefield)

= Version 1.3.1 =
 * fixed Product Preview bug on plugin activation

= Version 1.3 =
 * inline documentation is now more displayed by default
 * huge code overhaul for easier maintenance
 * tracking images are now enabled for Product Links
 * tinymce: fixed RTE/HTML switching causing removal of all `<span>` tags
 * tinymce: rich formating inside shortcode is now removed (avoid to break shortcode display on the frontend)
 * tinymce: tracking ID and region are filled automatically from copy/paste feature
 * widget: region and/or tracking ID can be overridden individually
 * widget: added My Favorites Widget
 * widget: Product Widget now handles text+image, image and text
 * widget: added Product Cloud Widget
 * wordpress: Wordpress 2.7 compatibility

HUGE thanks to [Kathryn Presner](http://www.zoonini.com) for testing and reporting problems.
Kudos to LesBessant and fredl for reporting usage problems with Wordpress µ and Wordpress 2.7.

= Version 1.2.2 =
 * wordpress: support of Wordpress µ 2.5+

= Version 1.2.1 =
 * small reorganization of screenshots on WP.org plugin page
 * i18n: new Italian translation thanks to [Gianni Diurno](http://gidibao.net/)

= Version 1.2 =
 * Copy/Paste HTML feature
 * Small code bug fixes
 * tinymce: Compressed plugin for faster loading

= Version 1.1 =
 * secured plugin directory using new WP 2.6 constants (backward compatibility for WP 2.5)
 * improved welcoming text to give more accurate hyperlinks
 * fixed typo issues
 * added the ability to hide the documentation from writing pages
 * this same documentation is also available from the configuration page
 * the old way call for the carrousel is now obsolete, please follow the usage provided by the widget documentation
 * tinymce: added Amazon Widgets rich text editor button:
  * insert or edit current widgets in one click
  * handles all supported widgets for now
  * easy inclusion without having to read the documentation
 * widget: reintroduced the slideshow shortcode which was accidentaly removed

= Version 1.0 =
 * added Strict Standards compliance mode (`object` instead of `iframe`)
 * markup fix (no more `<p>` embracing the shortcode)
 * amazon: added region support for United Kingdom
 * amazon: Amazon Partner developer center aware of the plugin (not a feature I admit)
 * widget: added Slideshow widget support

= Version 1.0 beta 1 =
 * inline documentation in the edit page/post screen
 * added extra links to declare bugs and official homepage
 * revamped some parts of code
 * improved stability while plugin is a symlink (activation hook now works)
 * updated the options pages with a tabbed view
 * added screenshots to convince you it's a good plugin ;-)
 * amazon: added region support (USA, Canada and France for now)
 * i18n: fixed some translation issues
 * widget: added Product Preview support

= Version 1.0 alpha 3 =
 * "hide widgets in feed" renamed as "show widgets in feed" to match better the setting name (more natural)
 * i18n: internationalisation support (english and french)
 * widget: basic support of context links (no options for now)

= Version 1.0 alpha 2 =
 * file organization revamping
 * new option to define default alignment of widgets
 * handling widget alignment (previously customizable but not used)
 * added CSS class to widget container to ease their styling from your stylesheets
 * options are handled by the admin dashboard, no need to edit config.php anymore
 * widget: added Amazon Product (text + picture)

= Version 1.0 alpha 1 =
 * Improved documentation
 * Provides filter for syndication feed publishing (avoid the display of affiliate media in your feed)
 * Separation of the code ; `trunk` is for dev version


== Frequently Asked Questions ==

= What are those shortcodes? =
It is a bundled Wordpress feature. It looks like this : `[shortcode]sample value[/shortcode]`.
It looks like nothing but it is an expandable feature so we can plug our own shortcodes ... like with this widget.

= How can I use the shortcodes? =
You have 2 ways to using them:

 * by writing yourself the shortcode as plain text
 * by using the shortcode wizard provided with the Rich Text Editor (TinyMCE)

You can even insert them through the copy/paste feature.

= What is the copy/paste feature you talk about? =
It's easy : when you want to insert a widget through the RTE wizard, you have a copy/paste tab.
It's waiting you to copy/paste the Amazon's provided HTML.

It then auto-fills every single field needed.

That is smart. You save time, you gain in quality usage.

= Won't context links garbage my whole page? =
No it won't.

I added a filter so the context links areas are confined to post and page contents.
If politely asked, I can make this customizable from the plugin management page.

= Can I translate your plugin? =
Yes for sure but do it only if it's not already translated in your language.
For this, check Wordpress documentation about [translating a plugin](http://codex.wordpress.org/Writing_a_Plugin#Internationalizing_Your_Plugin) and [translating Wordpress](http://codex.wordpress.org/Translating_WordPress)

Once you have done your first translation from the trunk, [contact me](http://case.oncle-tom.net/contact).

= How is organized the translation =
There are 3 steps:

1. code freezing
2. translation
3. code release

The code freeze will ... freeze the code in the repository. It means there won't be any changes, except some small bug fixes which don't impact translating work.
All the translation team will be notified by email about the code change and will let 1 week to translate new chains.

Once all the translations are up, they are added in the repository and the new plugin released.

= Nespresso, what else? =
Yep, what else?

But no, George Clooney neither Nespresso are a feature of this plugin. Too bad!


== Screenshots ==

1. Widget selection via Rich Text Editor (with TinyMCE)
2. Widget configuration via Rich Text Editor (TinyMCE)
3. Copy/Paste feature
4. Main configuration panel
5. Extra tools configuration panel
6. Inline documentation
