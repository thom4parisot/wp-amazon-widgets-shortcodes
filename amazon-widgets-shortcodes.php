<?php
/*
Plugin Name: Amazon Widgets Shortcodes
Description: Enables many shortcodes to display Amazon products on your blog easily! Also adds some features such as context links.
Author: Oncle Tom
Version: 1.0 beta 1
Author URI: http://oncle-tom.net/
Plugin URI: http://case.oncle-tom.net/code/wordpress/

  This plugin is released under version 3 of the GPL:
  http://www.opensource.org/licenses/gpl-3.0.html
*/

class AmazonWidgetsShortcodes
{
  /**
   * Getter for international Amazon parameters
   * 
   * @author oncletom
   * @version 1.0
   * @since 1.0 beta 1
   * @return $settings Array Settings for all or a limited area
   * @param $country_code String[Optionnal] limit the returned settings to this country code
   */
  function getRegionParameters($country_code = 'autodetect')
  {
    if ($country_code == 'autodetect')
    {
      $country_code = get_option('awshortcode_region');
      $country_code = $country_code ? $country_code : 'us';
    }

    $amazon = array(
      /*'ca' => array(
        'lang_iso_code' => 'en_CA',
        'name' => __('Amazon Canada', 'awshortcode'),
        'url' => array(
          'affiliate' => '',
          'site' => 'http://www.amazon.ca/',
          'tool-contextlinks' => '',
          'widget-carrousel' => '',
          'widget-product' => '',
        ),
      ),*/
      /*'de' => array(
        'lang_iso_code' => 'de_DE',
        'name' => __('Amazon Germany', 'awshortcode'),
        'url' => array(
          'affiliate' => '',
          'site' => 'http://www.amazon.de/',
          'tool-contextlinks' => '',
          'widget-carrousel' => '',
          'widget-product' => '',
        ),
      ),*/
      'fr' => array(
        'lang_iso_code' => 'fr_FR',
        'name' => __('Amazon France', 'awshortcode'),
        'url' => array(
          'affiliate' => 'http://partenaires.amazon.fr/',
          'site' => 'http://www.amazon.fr/',
          'tool-contextlinks' => 'http://cls.assoc-amazon.fr/fr/s/cls.js',
          'tool-enhancelinks' => 'http://www.assoc-amazon.fr/s/link-enhancer?tag=%s&amp;o=8',
          'widget-carrousel' => '',
          'widget-product' => 'http://rcm-fr.amazon.fr/e/cm?',
        ),
      ),
      /*'jp' => array(
        'lang_iso_code' => 'ja_JP',
        'name' => __('Amazon Japan', 'awshortcode'),
        'url' => array(
          'affiliate' => '',
          'site' => 'http://www.amazon.co.jp/',
          'tool-contextlinks' => '',
          'widget-carrousel' => '',
          'widget-product' => '',
        ),
      ),*/
      /*'uk' => array(
        'lang_iso_code' => 'en_UK',
        'name' => __('Amazon United Kingdom', 'awshortcode'),
        'url' => array(
          'affiliate' => '',
          'site' => 'http://www.amazon.co.uk/',
          'tool-contextlinks' => '',
          'widget-carrousel' => '',
          'widget-product' => '',
        ),
      ),*/
      'us' => array(
        'lang_iso_code' => 'en_US',
        'name' => __('Amazon USA', 'awshortcode'),
        'url' => array(
          'affiliate' => 'https://affiliate-program.amazon.com/',
          'site' => 'http://www.amazon.com/',
          'tool-contextlinks' => '',
          'widget-carrousel' => '',
          'widget-product' => '',
        ),
      ),
    );

    return $country_code ? $amazon[$country_code] : $amazon;
  }

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
    add_option('awshortcode_enhanced_links', '0', '', 'yes');
    add_option('awshortcode_feed', '0', '', 'yes');
    add_option('awshortcode_region', 'us', '', 'yes');
    add_option('awshortcode_tracking_id', '', '', 'yes');
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
    delete_option('awshortcode_region');
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

  /*
   * We enqueue Amazon JS at the bottom
   * Why the bottom ? Because it is recommended for external scripts
   * And it is one ;-)
   */
  if (get_option('awshortcode_context_links'))
  {
    add_action('wp_footer', array('AmazonWidgetsShortcodesToolkit', 'displayContextLinks'));
  }
}