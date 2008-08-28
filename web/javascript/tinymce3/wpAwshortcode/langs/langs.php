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
  desc:                 "'.js_escape(__('Amazon Widgets Shortcodes', 'awshortcode')).'",
  zzz:                  ""
});

tinyMCE.addI18n("'.$mce_locale.'.wpAwshortcode_dlg",{
  alt_options:          "'.js_escape(__('Other Options', 'awshortcode')).'",
  main_options:         "'.js_escape(__('Main Options', 'awshortcode')).'",
  widget_id:            "'.js_escape(__('Widget ID', 'awshortcode')).'",
  zzz:                  ""
});';
?>