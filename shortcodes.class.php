<?php
/**
 * @author oncletom
 * @version 1.0
 */
class AmazonWidgetsShortcodesTags
{
  /**
   * 
   * @author oncletom
   * @return 
   * @param $atts Object
   * @param $uri Object[optional]
   */
  function widget_carrousel($atts, $uri = null)
  {
    extract(
      shortcode_atts(
        array(
          'align' => 'center',
          'bgcolor' => '#fff',
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
    $uri = preg_replace('#%2F([a-z0-9_\-]+)-21#iU', '%2F'.AWS_TRACKING_ID, $uri);

    return 
      AWS_FEED_ENABLE === true || !is_feed() ?
      '<div style="text-align:center">'.
        '<object type="application/x-shockwave-flash" data="'.$uri.'&amp;Operation=GetDisplayTemplate" width="'.$width.'" height="'.$height.'">'.
          '<param name="movie" value="'.$uri.'&amp;Operation=GetDisplayTemplate" />'.
          '<param name="bgcolor" value="'.$bgcolor.'" />'.
          '<param name="quality" value="high" />'.
          '<param name="allowscriptaccess" value="always" />'.
          '<p>'.__("You don't have a sufficient version of Flash Player to display this animation.").'</p>'.
        '</object>'.
      '</div>' :
      '';
  }
}

/*
 * 
 */
add_shortcode('amazon-carrousel', array('AmazonWidgetsShortcodesTags', 'widget_carrousel'));