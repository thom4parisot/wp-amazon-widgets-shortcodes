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
   * @version 1.0
   * @since 1.0 alpha 1
   * @author oncletom
   * @return $html String HTML code
   * @param $atts Array Attributes of the shortcode
   * @param $uri URI of the Flash object
   */
  function widget_carrousel($atts, $uri)
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
     * Preparing URI
     */
    $uri = str_replace(array(
      '&amp;Operation=NoScript',
      '&amp;Operation=GetDisplayTemplate'
    ), '', $uri);
    $uri = $this->replaceTrackingId($uri);

    return $this->displayShortcode(
      '<div style="text-align:'.$align.'" class="awshortcode-carrousel">'.
        '<object type="application/x-shockwave-flash" data="'.$uri.'&amp;Operation=GetDisplayTemplate" width="'.$width.'" height="'.$height.'">'.
          '<param name="movie" value="'.$uri.'&amp;Operation=GetDisplayTemplate" />'.
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

    return $this->displayShortcode(
      '<div style="text-align:'.$align.'" class="awshortcode-product">'.
        '<iframe src="http://rcm-fr.amazon.fr/e/cm?t='.get_option('awshortcode_tracking_id').
          '&amp;o=8'.
          '&amp;p=8'.
          '&amp;l=as1'.
          '&amp;asins='.$asin.
          '&amp;fc1='.$color.
          '&amp;'.((int)$small === 0 ? 'IS2' : 'IS1').'=1'.
          '&amp;lt1='.$target.
          '&amp;lc1='.$alink.
          '&amp;bc1='.$bordercolor.
          '&amp;bg1='.$bgcolor.
          '&amp;f=ifr" style="width:'.$width.'px;height:'.$height.'px;" '.
          'scrolling="no" marginwidth="0" marginheight="0" frameborder="0">'.
        '</iframe>'.
      '</div>'
    );
  }
}