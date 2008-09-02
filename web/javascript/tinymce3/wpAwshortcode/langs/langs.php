<?php
/**
 * Location strings for the wpAwshortcode TinyMCE 3 plugin
 * 
 * It relies on the WP filter `mce_external_languages`.
 * This late filter loads this file and adds the strings into the JS.
 * It is easier to maintain i18n with this mecanism.
 * 
 * $strings is the advocate output ; it is used as an "include", it is why.
 * 
 * @author oncletom
 * @since 1.1
 * @return null
 */

$strings = 'tinyMCE.addI18n("'.$mce_locale.'.wpAwshortcode",{
  amazon_carrousel:     "'.js_escape(__('Amazon Carrousel', 'awshortcode')).'",
  amazon_product:       "'.js_escape(__('Amazon Product', 'awshortcode')).'",
  amazon_slideshow:     "'.js_escape(__('Amazon Slideshow', 'awshortcode')).'",
  amazon_wishlist:      "'.js_escape(__('Amazon Wishlist', 'awshortcode')).'",
  desc:                 "'.js_escape(__('Amazon Widgets Shortcodes', 'awshortcode')).'",
  zzz:                  ""
});

tinyMCE.addI18n("'.$mce_locale.'.wpAwshortcode_dlg",{
  align:                "'.js_escape(__('Align', 'awshortcode')).'",
  align_center:         "'.js_escape(__('centered', 'awshortcode')).'",
  align_left:           "'.js_escape(__('left', 'awshortcode')).'",
  align_right:          "'.js_escape(__('right', 'awshortcode')).'",
  alink:                "'.js_escape(__('Link Color', 'awshortcode')).'",
  alt_options:          "'.js_escape(__('Other Options', 'awshortcode')).'",
  asin:                 "'.js_escape(__('ASIN Code', 'awshortcode')).'",
  bgcolor:              "'.js_escape(__('Background Color', 'awshortcode')).'",
  bordercolor:          "'.js_escape(__('Border color', 'awshortcode')).'",
  copypaste_tab:        "'.js_escape(__('Copy/Paste Code', 'awshortcode')).'",
  general_tab:          "'.js_escape(__('Main Options', 'awshortcode')).'",
  height:               "'.js_escape(__('Height', 'awshortcode')).'",
  main_options:         "'.js_escape(__('Main Options', 'awshortcode')).'",
  pixels:               "'.js_escape(__('pixels', 'awshortcode')).'",
  plugin_setting:       "'.js_escape(__('Default Plugin Setting', 'awshortcode')).'",
  small:                "'.js_escape(__('Small size?', 'awshortcode')).'",
  widget_id:            "'.js_escape(__('Widget ID', 'awshortcode')).'",
  width:                "'.js_escape(__('Width', 'awshortcode')).'",
  cpp_welcome:          "'.js_escape(__('Glad you look at here!', 'awshortcode')).'",
  cpp_message:          "'.js_escape(__('This feature is under heave development and you should enjoy it in the next 1.2 release of this plugin.'.
                                        'As you may guess, you will copy/paste widget HTML code provided by Amazon to autofill the previous tab.', 'awshortcode')).'",
  cpp_close:            "'.js_escape(__('Nice isn\t it?', 'awshortcode')).'",
  zzz:                  ""
});';
?>