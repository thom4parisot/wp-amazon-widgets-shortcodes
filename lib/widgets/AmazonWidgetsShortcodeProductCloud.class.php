<?php
/**
 * @author oncletom
 */

class AmazonWidgetsShortcodeProductCloud extends AmazonWidgetsShortcodeBase
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
        ),
        $attributes
      )
    );

    /*
     * Preparing data
     */
    $region = AmazonWidgetsShortcodeConfiguration::getRegion();
    $uri = sprintf(
             $region['url']['widget-productcloud'],
             $region['marketplace'],
             get_option('awshortcode_tracking_id'),
             $value
           );
    $uri_encoded = call_user_func(array(__CLASS__, 'encodeParameters'), $uri);

    /*
     * Display
     */
    return
      '<div style="text-align:'.$align.'" class="awshortcode-productcloud">'.
        '<script charset="utf-8" type="text/javascript" src="'.$uri.'"></script>'.
        '<noscript>'.
          '<a href="'.$uri_encoded.'&amp;Operation=NoScript">'.
            ($alt ? $alt : __('Consult this product cloud on Amazon.', 'awshortcode')).
          '</a>'.
        '</noscript>'.
      '</div>';
  }
}
