<?php
/**
 * @author oncletom
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
    $attributes = shortcode_atts(
      array(
        'align' => get_option('awshortcode_align'),
        'alink' => '00f',
        'alt' => '',
        'bgcolor' => 'fff',
        'bordercolor' => '000',
        'color' => '000',
        'height' => '240',
        'image' => '',
        'region' => get_option('awshortcode_region'),
        'tracking_id' => get_option('awshortcode_tracking_id'),
        'small' => 0,
        'target' => '_blank',
        'text' => '',
        'type' => 'both',
        'width' => '120',
      ),
      $attributes
    );
    $config = AmazonWidgetsShortcodeConfiguration::getShortcode('product');
    $attributes['type'] = isset($config['types'][$attributes['type']]) ? $attributes['type'] : $config['default_type'];

    /*
     * Preparing data
     */
    $region = AmazonWidgetsShortcodeConfiguration::getRegion($region);

    /*
     * Display
     */
    return call_user_func(
      array(__CLASS__, 'shortcodeToHtml'.ucfirst($attributes['type'])),
      $attributes,
      $value,
      $region
    );
  }

  /**
   * Display as full widget
   * @see AmazonWidgetsShortcode::shortcodeToHtml()
   */
  function shortcodeToHtmlBoth($attributes, $value, $region)
  {
    extract($attributes);
    $uri = sprintf(
             $region['url']['widget-product'],
             $tracking_id,
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
          '<object type="text/html" data="'.$uri.'" style="width:'.$width.'px;height:'.$height.'px;">'.
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

  /**
   * Display as image widget
   * @see AmazonWidgetsShortcode::shortcodeToHtml()
   */
  function shortcodeToHtmlImage($attributes, $value, $region)
  {
    extract($attributes);

    if (!preg_match('/^https?/', $image))
    {
      $image = sprintf($region['url']['images'], $image);
    }

    $uri = sprintf(
             $region['url']['product'],
             $value,
             $tracking_id
    );

    return
      '<a href="'.$uri.'" class="awshortcode-product awshortcode-product-image" rel="external">'.
        '<img src="'.$image.'" alt="'.$alt.'" />'.
      '</a>';
  }

  /**
   * Display as text widget
   * @see AmazonWidgetsShortcode::shortcodeToHtml()
   */
  function shortcodeToHtmlText($attributes, $value, $region)
  {
    extract($attributes);

    $uri = sprintf(
             $region['url']['product'],
             $value,
             $tracking_id
    );

    return
      '<a href="'.$uri.'" class="awshortcode-product awshortcode-product-text" rel="external">'.
        $text.
      '</a>';
  }
}
