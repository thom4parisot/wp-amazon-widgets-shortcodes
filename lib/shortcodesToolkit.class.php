<?php
/**
 * Tookit functions used by the AmazonWidgetsShortcodesTags class
 * 
 * @author oncletom
 * @version 1.0
 * @since 1.0 alpha 2
 */
class AmazonWidgetsShortcodesToolkit
{
  /**
   * Displays or not the widget according to some conditions
   * 
   * Conditions are:
   * - publication to feed is enabled (disabled by default)
   * - AND we are in a feed
   * 
   * @author oncletom
   * @version 1.0
   * @since 1.0 alpha 2
   * @return $html String HTML widget
   * @param $html String HTML widget
   */
  function displayShortcode($html)
  {
    return get_option('awshortcode_feed') || !is_feed() ? $html : '';
  }

  /**
   * Find and replace the tracking ID within a given string
   * 
   * @author oncletom
   * @version 1.0
   * @since 1.0 alpha 2
   * @return $string String Modified string (or not, if nothing found)
   * @param $string String String to modify
   * @param $tracking_id String[optional] Tracking ID ; if null, uses the main one
   */
  function replaceTrackingId($string, $tracking_id = null)
  {
    return preg_replace(
      '#(%2F|\?|&)([a-z0-9_\-]+)-21#iU',
      "$1".($tracking_id ? $tracking_id : get_option('awshortcode_tracking_id')),
      $string
    );
  }
}