<?php
/**
 * @author oncletom
 * @php5
 * 
 * Basic skeleton for all widgets
 * It is not used for now to keep Wordpress + PHP4 compatibility
 */

class AmazonWidgetsShortcode
{
  /**
   * Returns HTML code corresponding to a shortcode, if available
   * 
   * @author oncletom
   * @version 1.0
   * @since 1.3
   * @return $html String Shortcode HTML
   * @param $attributes Array
   * @param $value String[optional]
   */
  public function displayAsHtml(array $attributes, $value = null);

  /**
   * Converts a shortcode as HTML
   * 
   * @author oncletom
   * @version 2.0
   * @since 1.3
   * @return $html String Shortcode HTML
   * @param $attributes Array
   * @param $value String[optional]
   */
  public function shortcodeToHtml(array $attributes, $value = null);
}
