<?php
/*
Plugin Name: Amazon Widgets Shortcodes
Description: Enables many shortcodes to display Amazon products on your blog easily! Also adds some features such as context links. Also works on WPMU.
Author: Oncle Tom
Version: 1.3 beta
Author URI: http://oncle-tom.net/
Plugin URI: http://case.oncle-tom.net/code/wordpress/

  This plugin is released under version 3 of the GPL:
  http://www.opensource.org/licenses/gpl-3.0.html
*/

/*
 * Compatibility with WP 2.5
 */
if (!defined('WP_PLUGIN_DIR'))
{
  define('WP_PLUGIN_DIR', ABSPATH.PLUGINDIR);
  define('WP_PLUGIN_URL', get_bloginfo('url').'/'.PLUGINDIR);
}


/*
 * Bootstrap
 */
require dirname(__FILE__).'/lib/AmazonWidgetsShortcodePlugin.class.php';
require dirname(__FILE__).'/lib/AmazonWidgetsShortcodeConfiguration.class.php';
AmazonWidgetsShortcodePlugin::bootstrap(__FILE__);


/*
 * Admin stuff
 * Or stuff done from admin like TinyMCE and all
 */
if (is_admin())
{
  $class = 'AmazonWidgetsShortcodesAdmin';
  require(AWS_PLUGIN_BASEPATH.'/lib/'.$class.'.class.php');
  add_action('admin_menu', array($class, 'setupAdminMenu'));
  add_filter('whitelist_options', array($class, 'setupOptionsWhitelist'));

  if (get_option('awshortcode_inline_documentation'))
  {
    add_action('edit_form_advanced', array($class, 'displayDocumentation'));
  }

  if (!get_option('awshortcode_tracking_id'))
  {
    add_action('admin_notices', array($class, 'printNotice'));
  }
}


/*
 * Frontend stuff
 */
if (get_option('awshortcode_tracking_id') && !is_admin())
{
  AmazonWidgetsShortcodePlugin::registerShortcodes();

  $class = 'AmazonWidgetsShortcodeFilters';
  require AWS_PLUGIN_BASEPATH.'/lib/'.$class.'.class.php';
  add_filter('the_excerpt', array($class, 'FormatXhtmlPost'), 999);
  add_filter('the_content', array($class, 'FormatXhtmlPost'), 999);

  /*
   * We enqueue Amazon JS at the bottom
   * Why the bottom ? Because it is recommended for external scripts
   * And it is one ;-)
   * 
   * @see http://developer.yahoo.net/blog/archives/2007/07/high_performanc_5.html
   */
  if (get_option('awshortcode_context_links'))
  {
    $class = 'AmazonWidgetsShortcodeContextLink';
    require AWS_PLUGIN_BASEPATH.'/lib/tools/'.$class.'.class.php';
    add_filter('the_excerpt', array($class, 'filterContextLinks'), 900);
    add_filter('the_content', array($class, 'filterContextLinks'), 900);
    add_action('wp_footer', array($class, 'getHtmlCode'));
  }

  if (get_option('awshortcode_product_preview'))
  {
    $class = 'AmazonWidgetsShortcodeProductPreview';
    require AWS_PLUGIN_BASEPATH.'/lib/tools/'.$class.'.class.php';
    add_action('wp_footer', array($class, 'displayProductPreview'));
  }
}


/*
 * Global stuff
 */
$class = 'AmazonWidgetsShortcodeRteTinyMce';
require AWS_PLUGIN_BASEPATH.'/lib/rte/'.$class.'.class.php';
add_action('init', array($class, 'bootstrap'));