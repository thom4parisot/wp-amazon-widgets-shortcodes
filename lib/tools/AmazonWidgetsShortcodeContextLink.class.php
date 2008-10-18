<?php
/**
 * @author tparisot
 */

class AmazonWidgetsShortcodeContextLink
{
  /**
   * Display HTML Code
   * 
   * @author oncletom
   * @version 2.0
   * @since 1.3
   * @return 
   */
  function getHtmlCode()
  {
    $tracking_id = get_option('awshortcode_tracking_id');
    $region = AmazonWidgetsShortcodeConfiguration::getRegion();
    $src = $region['url']['tool-contextlinks'];

    echo <<<EOF
<script type="text/javascript">//<![CDATA[
var amzn_cl_tag = '{$tracking_id}';
//]]></script><script type="text/javascript" src="{$src}"></script>
EOF;
  }

  /**
   * Wraps content in Amazon proprietary HTML comments tag
   * 
   * Context links are added by Amazon engine only between those parts.
   * 
   * @author oncletom
   * @version 2.0
   * @since 1.3
   * @return $html String Filtered HTML
   * @param $html String Post/page content to filter
   */
  function filterContextLinks($html)
  {
    return
      '<!--Amazon_CLS_IM_START-->'.
      $html.
      '<!--Amazon_CLS_IM_END-->';
  }
}
