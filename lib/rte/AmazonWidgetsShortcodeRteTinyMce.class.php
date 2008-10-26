<?php
/**
 * @author oncletom
 */

class AmazonWidgetsShortcodeRteTinyMce
{
  /**
   * Register TinyMCE hooks & filters
   * 
   * @author oncletom
   * @version 2.0
   * @since 1.3
   * @return null or false if no permission to edit page or post
   */
  function bootstrap()
  {
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages'))
    {
      return false;
    }

    if (get_user_option('rich_editing') == 'true')
    {
      $class = __CLASS__;
      add_filter('mce_external_plugins', array($class, 'registerPlugin'));
      add_filter('mce_buttons', array($class, 'registerGui'));
      add_filter('mce_external_languages', array($class, 'registerI18n') );
      add_filter('tiny_mce_before_init', array($class, 'registerConfig'));
    }
  }

  /**
   * Pass some more configuration to TinyMCE, essentially WP related options
   * 
   * @author oncletom
   * @version 1.0
   * @since 1.3
   * @return Array Modified configuration
   * @param Array $config
   */
  function registerConfig($config)
  {
    return array_merge(
      $config,
      array(
        'awshortcode_region' => get_option('awshortcode_region'),
        'awshortcode_tracking_id' => get_option('awshortcode_tracking_id'),
      )
    );
  }

  /**
   * Loads additional buttons into the TinyMCE 3 UI
   * 
   * @author oncletom
   * @version 2.0
   * @since 1.3
   * @return $buttons Array Set of TinyMCE buttons, modified
   * @param $buttons Array Set of TinyMCE buttons
   */
  function registerGui($buttons)
  {
    $buttons[] = 'awshortcode-selector';
    return $buttons;
  }

  /**
   * Loads TinyMCE 3 language files
   * 
   * @author oncletom
   * @version 1.0
   * @since 1.1
   * @return $langs Array Set of TinyMCE languages, modified
   * @param $langs Array Set of TinyMCE languages
   */
  function registerI18n($langs)
  {
    $langs['wpAwshortcode'] = WP_PLUGIN_DIR.'/amazon-widgets-shortcodes/web/javascript/tinymce3/wpAwshortcode/langs/langs.php';
    return $langs;
  }

  /**
   * Loads TinyMCE 3 external plugins
   * 
   * @author oncletom
   * @version 2.0
   * @since 1.3
   * @return $plugins Array Set of TinyMCE plugins, modified
   * @param $plugins Array Set of TinyMCE plugins
   */
  function registerPlugin($plugins)
  {
    $plugins['wpAwshortcode'] = WP_PLUGIN_URL.'/amazon-widgets-shortcodes/web/javascript/tinymce3/wpAwshortcode/editor_plugin.js';
    return $plugins;
  }
}
