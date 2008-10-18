<?php
/**
 * @author tparisot
 */

class AmazonWidgetsShortcodeProductPreview
{
  /**
   * Displays context links on Amazon links
   * 
   * @static
   * @author oncletom
   * @version 2.0
   * @since 1.3
   * @return null
   */
  function getHtmlCode()
  {
    $region = AmazonWidgetsShortcodeConfiguration::getRegion();
    $src = sprintf(
            $region['url']['tool-productpreview'],
            get_option('awshortcode_tracking_id')
           );

    echo <<<EOF
<script type="text/javascript" src="{$src}"></script>
EOF;
  }
}
