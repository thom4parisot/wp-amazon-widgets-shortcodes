<?php
/*
 * Basic security
 * @todo check the plugin dir+filename
 */
if (!defined('ABSPATH') || !defined('WP_UNINSTALL_PLUGIN'))
{
  exit('Invalid deletion.');
}

//bootstraps the plugin ; heavy but working
require_once dirname(__FILE__).'/amazon-widgets-shortcodes.php';

/*
 * 1) deleting known options
 */
foreach (array_keys(AmazonWidgetsShortcodeConfiguration::getOptions()) as $option_id)
{
  delete_option($option_id);
}