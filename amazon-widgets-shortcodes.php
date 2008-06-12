<?php
/*
Plugin Name: Amazon Widgets Shortcodes
Description: Adds a counter to track the number of times a post is viewed.
Author: Oncle Tom
Version: 1.0 beta 1
Author URI: http://oncle-tom.net/
Plugin URI: http://case.oncle-tom.net/code/wordpress/

  This plugin is released under version 2 of the GPL:
  http://www.opensource.org/licenses/gpl-license.php
*/

class AmazonWidgetsShortcodes
{
  /**
   * 
   * @return 
   */
  function pluginActivation()
  {
    if (!file_exists(dirname(__FILE__).'/config.php'))
    {
      deactivate_plugins(__FILE__);
      _e('Please configure the config.php file. It is temporary during the beta.');
      return false;
    }
  }

  /**
   * 
   * @return 
   */
  function pluginDeActivation()
  {
    
  }
}

/*
 * Register main actions
 */
//load_plugin_textdomain('amazon-widgets-shortcodes', 'wp-content/plugins/amazon-widgets-shortcodes/i18n');
register_activation_hook(__FILE__, array('AmazonWidgetsShortcodes', 'pluginActivation'));
register_deactivation_hook(__FILE__, array('AmazonWidgetsShortcodes', 'pluginDeActivation'));

/*
 * Stop the loading if no config file found
 */
if (!file_exists(dirname(__FILE__).'/config.php'))
{
  return false;
}

/*
 * Registering shortcodes
 */
require('config.php');
require('shortcodes.class.php');
