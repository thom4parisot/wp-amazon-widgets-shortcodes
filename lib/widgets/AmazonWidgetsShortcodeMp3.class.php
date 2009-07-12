<?php
/**
 * @author oncletom
 */

class AmazonWidgetsShortcodeMp3 extends AmazonWidgetsShortcodeBase
{
  /**
   * @see AmazonWidgetsShortcode::displayAsHtml()
   * @see AmazonWidgetsShortcodeBase::displayAsHtml()
   */
  function displayAsHtml($attributes, $value = null)
  {
    return parent::displayAsHtml($attributes, $value, __CLASS__);
  }

  /**
   * @see AmazonWidgetsShortcode::shortcodeToHtml()
   */
  function shortcodeToHtml($attributes, $value = null)
  {
    extract(
      shortcode_atts(
        array(
          'align' => get_option('awshortcode_align'),
          'alt' => '',
          'region' => get_option('awshortcode_region'),
          'tracking_id' => get_option('awshortcode_tracking_id'),
        ),
        $attributes
      )
    );

    /*
     * Preparing data
     */
    $region = AmazonWidgetsShortcodeConfiguration::getRegion($region);
    $uri = sprintf(
             $region['url']['widget-mp3'],
             $region['marketplace'],
             $tracking_id,
             $value
           );
    $uri_encoded = call_user_func(array(__CLASS__, 'encodeParameters'), $uri);

    /*
     * Display
     */
    return
      '<div class="awshortcode-mp3 align'.$align.'">'.
        '<script charset="utf-8" type="text/javascript" src="'.$uri.'"></script>'.
        '<noscript>'.
          '<a href="'.$uri_encoded.'&amp;Operation=NoScript">'.
            ($alt ? $alt : __('Consult my shared MP3 on Amazon.', 'awshortcode')).
          '</a>'.
        '</noscript>'.
      '</div>';
  }
}
