<?php
/**
 * @author oncletom
 * 
 * Basic skeleton for all widgets
 * It is not used for now to keep Wordpress + PHP4 compatibility
 * 
 * In PHP 5, it would be an abstract class to avoid its direct usage
 */

class AmazonWidgetsShortcodeBase
{
  /**
   * Display the widget as HTML, if available
   * 
   * @static
   * @protected
   * @author oncletom
   * @version 1.0
   * @since 1.3
   * @return $html String HTML shortcode equivalent
   * @param $attributes Array
   * @param $value String[optional]
   * @param $class String[optional]
   */
  function displayAsHtml($attributes, $value = null, $class = null)
  {
    if (is_feed() && !get_option('awshortcode_feed'))
    {
      return '';
    }

    $class = !is_null($class) && class_exists($class) ? $class : __CLASS__;
    return call_user_func(array($class, 'shortcodeToHtml'), $attributes, $value);
  }

  /**
   * Encode some parameters located in the query string of an URL for proper behavior purpose
   * 
   * Encode characters such as :
   * - / -> %2F
   * - & -> &amp;
   * - &amp;amp; -> &amp; (avoids double "&" encoding)
   * 
   * @author oncletom
   * @version 1.0
   * @since 1.1 beta
   * @return $encoded_uri String Encoded URI
   * @param $uri String Uri to encode
   */
  function encodeParameters($uri)
  {
    $parsed_uri = parse_url($uri);
    $qs_original = $parsed_uri['query'];
    $qs = str_replace(array('/', '&', '&amp;amp;'), array('%2F', '&amp;', '&amp;'), $qs_original);

    return str_replace($qs_original, $qs, $uri);
  }

  /**
   * Filter an hexa code to return it with a prefix, if needed
   * 
   * @author oncletom
   * @version 2.0
   * @since 1.3
   * @return $color String
   * @param $color String Hexadecimal color to filter
   * @param $prefix Boolean[optional] Add a hash prefix or not
   * 
   * @todo add a better filter which checks hexa code and more
   */
  function getHexadecimalFromString($color, $prefix = true)
  {
    // no need to go further
    if (!$color)
    {
      return '';
    }

    $color = preg_replace('/[^a-fA-F0-9]/U', '', $color);
    $prefix = (bool)$prefix && $color ? '#' : '';
    return $prefix.$color;    
  }

  /**
   * Render a tracking image thanks to some parameters
   * 
   * @author oncletom
   * @version 1.0
   * @since 1.3
   * @return String Tracking image HTML code
   * @param Array $options
   * @param Array $params
   * @param Boolean $render[optional]
   */
  function getTrackingImage($options, $params, $render = null)
  {
    $render = is_null($render) ? (bool)get_option('awshortcode_tracking_image') : (bool)$render;
    $query_string = array();

    if (function_exists('http_build_query'))
    {
      $query_string = http_build_query($params, '', '&amp;');
    }
    /*
     * @todo remove that when PHP4 support ends
     */
    else
    {
      foreach ($params as $key => $value)
      {
        $query_string[] = sprintf('%s=%s', $key, $value);
      }
      $query_string = implode('&amp;', $query_string);
    }

    $uri = sprintf(
      'http://www.assoc-amazon.%s/e/ir?%s',
      $options['tld'],
      $query_string
    );

    return
      '<img src="'.$uri.'" alt="" style="height:1px !important; width:1px !important; border:none !important; margin:0 !important; padding: 0 !important;" />';
  }
}
