<?php
/*
Plugin Name: Amazon Widgets Shortcodes
Description: Adds a counter to track the number of times a post is viewed.
Author: Oncle Tom
Version: 1.0 alpha 3
Author URI: http://oncle-tom.net/
Plugin URI: http://case.oncle-tom.net/code/wordpress/

  This plugin is released under version 3 of the GPL:
  http://www.opensource.org/licenses/gpl-3.0.html
*/

class AmazonWidgetsShortcodes
{
  /**
   * Load textdomain even if the plugin is a symlink
   * 
   * In case of symlink, it assumes you linked it with its original plugin name
   * eg: `ln -s /path/to/plugins/amazon-widgets-shortcodes /real/path/to/aws-plugin`
   * 
   * @author oncletom
   * @since 1.0 alpha 3
   * @return null
   */
  function loadTextDomain()
  {
    if (function_exists('is_link') && is_link(ABSPATH.PLUGINDIR.'/amazon-widgets-shortcodes'))
    {
      load_plugin_textdomain('awshortcode', PLUGINDIR.'/amazon-widgets-shortcodes/i18n');
    }
    else
    {
      load_plugin_textdomain('awshortcode', PLUGINDIR.'/'.dirname(plugin_basename(__FILE__)).'/i18n');
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
    add_option('awshortcode_tracking_id', '', '', 'yes');
    add_option('awshortcode_feed', '0', '', 'yes');
    add_option('awshortcode_align', 'center', '', 'yes');
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
    delete_option('awshortcode_tracking_id');
    delete_option('awshortcode_feed');
    delete_option('awshortcode_align');
  }

  /**
   * Admin menu inclusion
   * 
   * @author oncletom
   * @since 1.0 alpha 2
   * @return null
   */
  function setupAdminMenu()
  {
    add_options_page(
      __('Amazon Widgets Shortcodes', 'awshortcode'),
      __('Amazon Widgets Shortcodes', 'awshortcode'),
      8,
      'awshortcode-options',
      array('AmazonWidgetsShortcodesAdmin', 'displayOptions')
    );
  }

  /**
   * Show a notice to the user if (s)he has not setup the plugin yet
   * 
   * @author oncletom
   * @since 1.0 alpha 2
   * @return null
   */
  function showNotice()
  {
    ?>
    <div class="updated fade">
      <p><strong><?php _e('Amazon Widget Shortcodes has been activated', 'awshortcode') ?></strong>.</p>
      <p><?php printf(
              __('You need to <a href="%s">setup your Amazon Tracking ID</a> in order to see your shortcodes display Amazon Widgets.', 'awshortcode'),
              'options-general.php?page=awshortcode-options'
            ) ?></p>
    </div>
    <?php
  }
}

/*
 * Registering classes
 */
define('AWS_PLUGIN_BASEPATH', dirname(__FILE__));
require(AWS_PLUGIN_BASEPATH.'/lib/shortcodesToolkit.class.php');
require(AWS_PLUGIN_BASEPATH.'/lib/shortcodes.class.php');

/*
 * Admin stuff
 */
if (is_admin())
{
  require(AWS_PLUGIN_BASEPATH.'/lib/shortcodesAdmin.class.php');
  add_action('admin_menu', array('AmazonWidgetsShortcodes', 'setupAdminMenu'));

  if (!get_option('awshortcode_tracking_id'))
  {
    add_action('admin_notices', array('AmazonWidgetsShortcodes', 'showNotice'));
  }
}

/*
 * Register main actions
 */
AmazonWidgetsShortcodes::loadTextDomain();
register_activation_hook(__FILE__, array('AmazonWidgetsShortcodes', 'pluginActivation'));
if (function_exists('register_uninstall_hook'))
{
  register_uninstall_hook(__FILE__, array('AmazonWidgetsShortcodes', 'pluginUninstall'));
}

if (get_option('awshortcode_tracking_id') && !is_admin())
{
  $AwShortcodes = new AmazonWidgetsShortcodesTags();
  add_shortcode('amazon-carrousel', array(&$AwShortcodes, 'widget_carrousel'));
  add_shortcode('amazon-product', array(&$AwShortcodes, 'widget_product'));
}