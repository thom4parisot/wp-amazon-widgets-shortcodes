<?php
/**
 * @author tparisot
 */

class AmazonWidgetsShortcodeProduct extends AmazonWidgetsShortcodeBase
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
          'alink' => '00f',
          'bgcolor' => 'fff',
          'bordercolor' => '000',
          'color' => '000',
          'height' => '240',
          'small' => 0,
          'target' => '_blank',
          'width' => '120',
        ),
        $attributes
      )
    );

    $region = AmazonWidgetsShortcodeConfiguration::getRegion();
    $uri = sprintf(
             $region['url']['widget-product'],
             get_option('awshortcode_tracking_id'),
             $value,
             call_user_func(array(__CLASS__, 'getHexadecimalFromString'), $color, false),
             (int)$small === 0 ? 'IS2' : 'IS1',
             $target,
             call_user_func(array(__CLASS__, 'getHexadecimalFromString'), $alink, false),
             call_user_func(array(__CLASS__, 'getHexadecimalFromString'), $bordercolor, false),
             call_user_func(array(__CLASS__, 'getHexadecimalFromString'), $bgcolor, false)
           );

    if (get_option('awshortcode_strict_standards'))
    {
      return
        '<div style="text-align:'.$align.'" class="awshortcode-product">'.
          '<object type="text/html" data="'.$uri.'" style="width:'.$width.'px;height:'.$height.'px;" '.
            '>'.
          '</object>'.
        '</div>';
    }
    else
    {
      return
        '<div style="text-align:'.$align.'" class="awshortcode-product">'.
          '<iframe src="'.$uri.'" style="width:'.$width.'px;height:'.$height.'px;" '.
            'scrolling="no" marginwidth="0" marginheight="0" frameborder="0">'.
          '</iframe>'.
        '</div>';
    }
  }
}
