<?php
/*
Plugin Name: Amazon Widgets Shortcodes
Description: Adds a counter to track the number of times a post is viewed.
Author: Oncle Tom
Version: 1.0 alpha 2
Author URI: http://oncle-tom.net/
Plugin URI: http://case.oncle-tom.net/code/wordpress/

  This plugin is released under version 3 of the GPL:
  http://www.opensource.org/licenses/gpl-3.0.html
*/

class AmazonWidgetsShortcodes
{
  /**
   * Plugin activation processing
   * 
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
   * Note : not in use for now
   * 
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
   * @return null
   */
  function setupAdminMenu()
  {
    add_options_page(
      __('Amazon Widgets Shortcodes'),
      __('Amazon Widgets Shortcodes'),
      8,
      'awshortcode-options',
      array('AmazonWidgetsShortcodesAdmin', 'displayOptions')
    );
  }

  /**
   * Show a notice to the user if (s)he has not setup the plugin yet
   * 
   * @return null
   */
  function showNotice()
  {
    ?>
    <div class="updated fade">
      <p><strong><?php _e('Amazon Widget Shortcodes has been activated') ?></strong>.</p>
      <p><?php printf(
              __('You need to <a href="%s">setup your Amazon Tracking ID</a> in order to see your shortcodes display Amazon Widgets.'),
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
//load_plugin_textdomain('amazon-widgets-shortcodes', 'wp-content/plugins/amazon-widgets-shortcodes/i18n');
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