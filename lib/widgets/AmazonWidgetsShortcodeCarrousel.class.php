<?php
/**
 * @author tparisot
 * 
 * In PHP5, it would implement AmazonWidgetsShortcode interface
 */

class AmazonWidgetsShortcodeCarrousel extends AmazonWidgetsShortcodeBase
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
          'bgcolor' => 'fff',
          'height' => '200',
          'width' => '600',
        ),
        $attributes
      )
    );

    /*
     * Preparing data
     */
    $region = AmazonWidgetsShortcodeConfiguration::getRegion();
    $uri = sprintf(
             $region['url']['widget-carrousel'],
             $region['marketplace'],
             get_option('awshortcode_tracking_id'),
             $value,
             'GetDisplayTemplate'
           );
    $bgcolor = call_user_func(array(__CLASS__, 'getHexadecimalFromString'), $bgcolor);

    /*
     * Display
     */
    return
      '<div style="text-align:'.$align.'" class="awshortcode-carrousel">'.
        '<object type="application/x-shockwave-flash" data="'.$uri.'" width="'.$width.'" height="'.$height.'">'.
          '<param name="movie" value="'.$uri.'" />'.
          '<param name="bgcolor" value="'.$bgcolor.'" />'.
          '<param name="quality" value="high" />'.
          '<param name="allowscriptaccess" value="always" />'.
          '<param name="wmode" value="transparent" />'.
          '<p>'.__("You don't have a sufficient version of Flash Player to display this animation.", 'awshortcode').'</p>'.
        '</object>'.
      '</div>';
  }
}
