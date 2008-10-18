<?php
/**
 * @author tparisot
 */

class AmazonWidgetsShortcodeFilters
{
  /**
   * Removes nasty tag wrapping the shortcode
   * 
   * @author oncletom
   * @version 2.0
   * @since 1.3
   * @return $html String Filtered HTML
   * @param $html String Post/page content to filter
   */
  function FormatXhtmlPost($html)
  {
    return preg_replace(
             '#<p>(<div .+ class="awshortcode-[a-z0-9]+">.+</div>)</p>#sU',
             "$1",
             $html
           );
  }
}
