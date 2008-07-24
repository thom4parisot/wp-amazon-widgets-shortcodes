<?php
/*
Plugin Name: Amazon Widgets Shortcodes
Description: Enables many shortcodes to display Amazon products on your blog easily! Also adds some features such as context links.
Author: Oncle Tom
Version: 1.0
Author URI: http://oncle-tom.net/
Plugin URI: http://case.oncle-tom.net/code/wordpress/

  This plugin is released under version 3 of the GPL:
  http://www.opensource.org/licenses/gpl-3.0.html
*/

class AmazonWidgetsShortcodes
{
  /**
   * Returns plugin location
   * 
   * In case of symlink, it assumes you linked it with its original plugin name
   * eg: `ln -s /path/to/plugins/amazon-widgets-shortcodes /real/path/to/aws-plugin`
   * 
   * @author oncletom
   * @since 1.0 beta 1
   * @return $location Array
   */
  function getPluginLocation()
  {
    if (function_exists('is_link') && is_link(ABSPATH.PLUGINDIR.'/amazon-widgets-shortcodes'))
    {
      return array(
        ABSPATH.PLUGINDIR.'/amazon-widgets-shortcodes/'.basename(__FILE__),
        PLUGINDIR.'/amazon-widgets-shortcodes/i18n'
      );
    }
    else
    {
      return array(
        __FILE__,
        PLUGINDIR.'/'.dirname(plugin_basename(__FILE__)).'/i18n'
      );
    }
  }

  /**
   * Plugin activation processing
   * 
   * @author oncletom
   * @since 1.0 alpha 1
   * @return $state Mixed null if nothing, else false
   */
  function pluginActivation()
  {
    /*
     * Default options
     */
    add_option('awshortcode_align', 'center', '', 'yes');
    add_option('awshortcode_context_links', '0', '', 'yes');
    add_option('awshortcode_feed', '0', '', 'yes');
    add_option('awshortcode_product_preview', '0', '', 'yes');
    add_option('awshortcode_region', 'us', '', 'yes');
    add_option('awshortcode_strict_standards', '', '', 'yes');
    add_option('awshortcode_tracking_id', '', '', 'yes');

    /*
     * Remove deprecate
     */
    delete_option('awshortcode_enhanced_links');
  }

  /**
   * Removes all data set by the plugin, including custom settings
   * 
   * Note : in use if the function `register_uninstall_hook` is implemented
   * Either in a case of a plugin or Core WP files
   * 
   * @author oncletom
   * @since 1.0 alpha 2
   * @return null
   */
  function pluginUninstall()
  {
    delete_option('awshortcode_align');
    delete_option('awshortcode_context_links');
    delete_option('awshortcode_enhanced_links');
    delete_option('awshortcode_feed');
    delete_option('awshortcode_product_preview');
    delete_option('awshortcode_region');
    delete_option('awshortcode_strict_standards');
    delete_option('awshortcode_tracking_id');
  }
}

/*
 * Register main actions
 */
list($filename, $i18n_path) = AmazonWidgetsShortcodes::getPluginLocation();
load_plugin_textdomain('awshortcode', $i18n_path);
register_activation_hook($filename, array('AmazonWidgetsShortcodes', 'pluginActivation'));
if (function_exists('register_uninstall_hook'))
{
  register_uninstall_hook($filename, array('AmazonWidgetsShortcodes', 'pluginUninstall'));
}

/*
 * Registering classes
 */
define('AWS_PLUGIN_BASEPATH', dirname($filename));
require(AWS_PLUGIN_BASEPATH.'/lib/shortcodesToolkit.class.php');
require(AWS_PLUGIN_BASEPATH.'/lib/shortcodes.class.php');

/*
 * Admin stuff
 */
if (is_admin())
{
  require(AWS_PLUGIN_BASEPATH.'/lib/shortcodesAdmin.class.php');
  add_action('admin_menu', array('AmazonWidgetsShortcodesAdmin', 'setupAdminMenu'));
  add_action('edit_form_advanced', array('AmazonWidgetsShortcodesAdmin', 'displayDocumentation'));

  if (!get_option('awshortcode_tracking_id'))
  {
    add_action('admin_notices', array('AmazonWidgetsShortcodesAdmin', 'printNotice'));
  }
}

/*
 * Frontend stuff
 */
if (get_option('awshortcode_tracking_id') && !is_admin())
{
  $AwShortcodes = new AmazonWidgetsShortcodesTags();
  add_shortcode('amazon-carrousel', array(&$AwShortcodes, 'widget_carrousel'));
  add_shortcode('amazon-product', array(&$AwShortcodes, 'widget_product'));
  add_shortcode('amazon-slideshow', array(&$AwShortcodes, 'widget_slideshow'));
  add_filter('the_excerpt', array(&$AwShortcodes, 'filterXhtmlFormatting'), 999);
  add_filter('the_content', array(&$AwShortcodes, 'filterXhtmlFormatting'), 999);

  /*
   * We enqueue Amazon JS at the bottom
   * Why the bottom ? Because it is recommended for external scripts
   * And it is one ;-)
   * @see http://developer.yahoo.net/blog/archives/2007/07/high_performanc_5.html
   */
  if (get_option('awshortcode_context_links'))
  {
    add_filter('the_excerpt', array(&$AwShortcodes, 'filterContextLinks'), 900);
    add_filter('the_content', array(&$AwShortcodes, 'filterContextLinks'), 900);
    add_action('wp_footer', array(&$AwShortcodes, 'displayContextLinks'));
  }

  if (get_option('awshortcode_product_preview'))
  {
    add_action('wp_footer', array(&$AwShortcodes, 'displayProductPreview'));
  }
}