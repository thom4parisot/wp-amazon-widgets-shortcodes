<?php
/**
 * @author oncletom
 * @version 1.0
 */
class AmazonWidgetsShortcodesTags extends AmazonWidgetsShortcodesToolkit
{
  /**
   * Produces an Amazon Carrousel shortcode
   * 
   * @version 1.1
   * @since 1.0 alpha 1
   * @author oncletom
   * @return $html String HTML code
   * @param $atts Array Attributes of the shortcode
   * @param $flash_id String Flash ID (eg: fc64116b-6b59-444b-b4ee-074a4adecf57)
   */
  function widget_carrousel($atts, $flash_id)
  {
    extract(
      shortcode_atts(
        array(
          'align' => get_option('awshortcode_align'),
          'bgcolor' => 'fff',
          'height' => '200',
          'width' => '600',
        ),
        $atts
      )
    );

    /*
     * Dealing with pre-beta area where the whole URI was needed
     */
    if (preg_match('#^http#U', $flash_id))
    {
      $uri = $flash_id;
    }
    else
    {
      $region = $this->getRegionParameters();
      $uri = sprintf(
               $region['url']['widget-carrousel'],
               $region['marketplace'],
               get_option('awshortcode_tracking_id'),
               $flash_id,
               'GetDisplayTemplate'
             );
    }

    return $this->displayShortcode(
      '<div style="text-align:'.$align.'" class="awshortcode-carrousel">'.
        '<object type="application/x-shockwave-flash" data="'.$uri.'" width="'.$width.'" height="'.$height.'">'.
          '<param name="movie" value="'.$uri.'" />'.
          '<param name="bgcolor" value="#'.$bgcolor.'" />'.
          '<param name="quality" value="high" />'.
          '<param name="allowscriptaccess" value="always" />'.
          '<p>'.__("You don't have a sufficient version of Flash Player to display this animation.").'</p>'.
        '</object>'.
      '</div>'
    );
  }

  /**
   * Produces an Amazon Product shortcode
   * 
   * @version 1.0
   * @since 1.0 alpha 2
   * @author oncletom
   * @return $html String HTML code
   * @param $atts Array Attributes of the shortcode
   * @param $asin String ASIN code to build the widget on
   */
  function widget_product($atts, $asin)
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
        $atts
      )
    );

    $region = $this->getRegionParameters();
    $uri = sprintf(
             $region['url']['widget-product'],
             get_option('awshortcode_tracking_id'),
             $asin,
             $color,
             (int)$small === 0 ? 'IS2' : 'IS1',
             $target,
             $alink,
             $bordercolor,
             $bgcolor
           );

    if (get_option('awshortcode_strict_standards'))
    {
      return $this->displayShortcode(
        '<div style="text-align:'.$align.'" class="awshortcode-product">'.
          '<object type="text/html" data="'.$uri.'" style="width:'.$width.'px;height:'.$height.'px;" '.
            '>'.
          '</object>'.
        '</div>'
      );
    }
    else
    {
      return $this->displayShortcode(
        '<div style="text-align:'.$align.'" class="awshortcode-product">'.
          '<iframe src="'.$uri.'" style="width:'.$width.'px;height:'.$height.'px;" '.
            'scrolling="no" marginwidth="0" marginheight="0" frameborder="0">'.
          '</iframe>'.
        '</div>'
      );
    }
  }

  /**
   * Produces an Amazon Slideshow shortcode
   * 
   * HTML code very similar of the Carrousel, only the String Url changes
   * 
   * @version 1.0
   * @since 1.0 
   * @author oncletom
   * @return $html String HTML code
   * @param $atts Array Attributes of the shortcode
   * @param $flash_id String Flash ID (eg: fc64116b-6b59-444b-b4ee-074a4adecf57)
   */
  function widget_slideshow($atts, $flash_id)
  {
    extract(
      shortcode_atts(
        array(
          'align' => get_option('awshortcode_align'),
          'bgcolor' => 'fff',
          'height' => '250',
          'width' => '300',
        ),
        $atts
      )
    );

    $region = $this->getRegionParameters();
    $uri = sprintf(
             $region['url']['widget-slideshow'],
             $region['marketplace'],
             get_option('awshortcode_tracking_id'),
             $flash_id,
             'GetDisplayTemplate'
           );

    return $this->displayShortcode(
      '<div style="text-align:'.$align.'" class="awshortcode-carrousel">'.
        '<object type="application/x-shockwave-flash" data="'.$uri.'" width="'.$width.'" height="'.$height.'">'.
          '<param name="movie" value="'.$uri.'" />'.
          '<param name="bgcolor" value="#'.$bgcolor.'" />'.
          '<param name="quality" value="high" />'.
          '<param name="allowscriptaccess" value="always" />'.
          '<p>'.__("You don't have a sufficient version of Flash Player to display this animation.").'</p>'.
        '</object>'.
      '</div>'
    );
  }
}