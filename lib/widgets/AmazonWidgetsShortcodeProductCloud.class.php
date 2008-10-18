<?php
/**
 * @author tparisot
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

    $region = AmazonWidgetsShortcodeConfiguration::getRegion();
    $uri = sprintf(
             $region['url']['widget-productcloud'],
             $region['marketplace'],
             get_option('awshortcode_tracking_id'),
             $value
           );

    return
      '<div style="text-align:'.$align.'" class="awshortcode-productcloud">'.
        '<script charset="utf-8" type="text/javascript" src="'.$uri.'"></script>'.
        '<noscript>'.
          '<a href="'.call_user_func(array(__CLASS__, 'encodeParameters'), $uri).'&amp;Operation=NoScript">'.
            ($alt ? $alt : __('Consult this product cloud on Amazon.', 'awshortcode')).
          '</a>'.
        '</noscript>'.
      '</div>';
  }
}
