<?php
/**
 * Admin functions
 *
 * @author oncletom
 * @version 1.0
 * @since 1.0 alpha 2
 */
class AmazonWidgetsShortcodesAdmin
{
  /**
   * Display tags help
   *
   * @author oncletom
   * @since 1.0 beta 1
   * @return null
   */
  function displayDocumentation()
  {
    include AWS_PLUGIN_BASEPATH.'/admin/view/documentation.php';
  }

  /**
   * Display options page
   *
   * @author oncletom
   * @since 1.0 alpha 2
   * @return null
   */
  function displayOptions()
  {
    global $wp_version, $wpmu_version;

    /*
     * Options dynamic options
     */
    $options = AmazonWidgetsShortcodeConfiguration::getOptions();
    $regions = AmazonWidgetsShortcodeConfiguration::getRegions();

    /*
     * Including elements
     */
    include AWS_PLUGIN_BASEPATH.'/admin/form/options.php';
    include AWS_PLUGIN_BASEPATH.'/admin/view/options.php';
  }

  /**
   * Include our own stylesheet
   * @author oncletom
   * @since 1.0 beta 1
   * @return null
   */
  function printJavaScript()
  {
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('awshortcode-main', WP_PLUGIN_URL.'/amazon-widgets-shortcodes/web/javascript/awshortcode.js');
  }

  /**
   * Show a notice to the user if (s)he has not setup the plugin yet
   *
   * @author oncletom
   * @since 1.0 alpha 2
   * @return null
   */
  function printNotice()
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

  /**
   * Include our own stylesheet
   * @author oncletom
   * @since 1.0 beta 1
   * @return null
   */
  function printStylesheet()
  {
    echo '<link rel="stylesheet" type="text/css" media="screen" href="'.WP_PLUGIN_URL.'/amazon-widgets-shortcodes/web/css/awshortcode.css" />';
  }

  /**
   * Setup admin pages
   *
   * Includes menu
   * Hook scripts & stylesheets
   *
   * @author oncletom
   * @version 1.1
   * @since 1.0 alpha 2
   * @return null
   */
  function setupAdminMenu()
  {
    /*
     * Hooking pages
     */
    $options_page = add_options_page(
      __('Amazon Widgets Shortcodes', 'awshortcode'),
      __('Amazon Widgets Shortcodes', 'awshortcode'),
      8,
      'awshortcode-options',
      array('AmazonWidgetsShortcodesAdmin', 'displayOptions')
    );

    /*
     * Hooking styles
     */
    add_action('admin_head-'.$options_page, array('AmazonWidgetsShortcodesAdmin', 'printStylesheet'));
    add_action('admin_print_scripts-'.$options_page, array('AmazonWidgetsShortcodesAdmin', 'printJavascript'));
  }

  /**
   * Copying master informations and activate plugin
   *
   * @since 1.5.3
   * @author oncletom
   * @param $blog_id integer
   * @param $user_id integer
   */
  function setupNewMuBlog($blog_id, $user_id)
  {
    $dashblog = get_dashboard_blog();
    $copy_options = array('tracking_id', 'region');
    $copied_values = array();

    if (!(int)$blog_id || (int)$blog_id === (int)$dashblog->blog_id)
    {
      return false;
    }

    /*
     * Options to copy
     */
    foreach ($copy_options as $option_id)
    {
      $copied_values['awshortcode_'.$option_id] = get_option('awshortcode_'.$option_id);
    }

    switch_to_blog($blog_id);

    activate_plugin(AWS_PLUGIN_PLUGINFILE);
    foreach ($copied_values as $option_id => $option_value)
    {
      update_option($option_id, $option_value);
    }

    restore_current_blog();
  }

  /**
   * Add whitelist options for WPMU
   *
   * @see http://wordpress.org/support/topic/191773#post-876524
   * @see http://mu.wordpress.org/forums/topic.php?id=9210
   * @author oncletom
   * @since 1.2.2
   * @return $whitelist Array
   * @param $whitelist Array
   */
  function setupOptionsWhitelist($whitelist)
  {
    if (is_array($whitelist))
    {
      $whitelist = array_merge(
        $whitelist,
        array(
          'awshortcode' => array_keys(AmazonWidgetsShortcodeConfiguration::getOptions())
        ));
    }

    return $whitelist;
  }
}