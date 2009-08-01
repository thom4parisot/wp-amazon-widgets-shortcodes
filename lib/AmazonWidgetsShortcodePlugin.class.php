<?php
/**
 * @author oncletom
 */

class AmazonWidgetsShortCodePlugin
{
  /**
   * Register main functions for plugin's sake
   * 
   * @static
   * @author oncletom
   * @version 1.0
   * @since 1.3
   * @return null
   * @param $plugin_home_path String Path to the plugin home (generally given as __FILE__)
   */
  function bootstrap($plugin_home_path)
  {
    $class = __CLASS__;
    list($filename, $i18n_path, $i18n_from_plugin_path) = call_user_func(array($class, 'getLocation'), $plugin_home_path);
    $pluginfile = preg_replace('#(.+)([^/]+/[^/]+)$#sU', "$2", $filename);
    load_plugin_textdomain('awshortcode', $i18n_path, $i18n_from_plugin_path);
    register_activation_hook($filename, array($class, 'executeActivation'));
    add_filter('plugin_action_links_'.$pluginfile, array($class, 'executeFilterPluginActionLinks'));

    define('AWS_PLUGIN_BASEPATH', dirname($filename));
  }

  /**
   * Returns plugin location
   * 
   * In case of symlink, it assumes you linked it with its original plugin name
   * eg: `ln -s /path/to/plugins/amazon-widgets-shortcodes /real/path/to/aws-plugin`
   * 
   * Array returned contains 3 fields:
   * - fixed filename (for relocated wordpress ABSPATH ; like SVN install/symlinked plugin)
   * - relative path to i18n folder (from abspath ; will fail on 2.7 if WP is relocated)
   * - plugin relative path to i18n folder (from plugin dir) (supported since WP 2.7)
   * 
   * @static
   * @author oncletom
   * @version 2.1
   * @since 1.3
   * @return $location Array
   * @param $filepath String File location
   */
  function getLocation($filepath)
  {
    /*
     * The plugin is installed as a symlink
     */
    if (function_exists('is_link') && is_link(WP_PLUGIN_DIR.'/amazon-widgets-shortcodes'))
    {
      return array(
        WP_PLUGIN_DIR.'/amazon-widgets-shortcodes/'.basename($filepath),
        PLUGINDIR.'/amazon-widgets-shortcodes/i18n',
        'amazon-widgets-shortcodes/i18n'
      );
    }
    else
    {
      return array(
        $filepath,
        PLUGINDIR.'/'.dirname(plugin_basename($filepath)).'/i18n',
        dirname(plugin_basename($filepath)).'/i18n'
      );
    }
  }

  /**
   * Plugin activation processing
   * 
   * @static
   * @author oncletom
   * @version 2.0
   * @since 1.3
   * @return $state Mixed null if nothing, else false
   */
  function executeActivation()
  {
    /*
     * Default options
     */
    foreach (AmazonWidgetsShortcodeConfiguration::getOptions() as $id => $option)
    {
      add_option(
        $id,
        $option['defaultValue'],
        '',
        (bool)$option['autoload'] ? 'yes' : 'no'
      );
    }

    /*
     * Purge TinyMCE config
     */
    $js_cache_dir = WP_CONTENT_DIR.'/uploads/js_cache';
    $dp = opendir($js_cache_dir);
    while ($element = readdir($dp))
    {
      if (preg_match('/^tinymce/', $element) && is_file($js_cache_dir.'/'.$element))
      {
        unlink($js_cache_dir.'/'.$element);
      }
    }
    closedir($dp);
  }

  /**
   * Filter action plugin action links to add context links
   * 
   * @author oncletom
   * @version 1.0
   * @since 1.4
   * @return array
   * @param array $action_links
   */
  function executeFilterPluginActionLinks($action_links)
  {
    return array_merge(array('<a href="options-general.php?page=awshortcode-options">'.__('Configure').'</a>'), $action_links);
  }

  /**
   * Register shortcode class & syntax
   * 
   * @author oncletom
   * @version 1.0
   * @since 1.3
   * @return $registered_shortcodes Integer Number of registered shortcodes
   */
  function registerShortcodes()
  {
    $registered_shortcodes = 0;

    require AWS_PLUGIN_BASEPATH.'/lib/widgets/AmazonWidgetsShortcodeBase.class.php';

    foreach (AmazonWidgetsShortcodeConfiguration::getShortcodes() as $shortcode_id => $shortcode_config)
    {
      require AWS_PLUGIN_BASEPATH.'/lib/widgets/'.$shortcode_config['class'].'.class.php';
      add_shortcode($shortcode_id, array($shortcode_config['class'], 'displayAsHtml'));
      $registered_shortcodes++;
    }

    return $registered_shortcodes;
  }
}
