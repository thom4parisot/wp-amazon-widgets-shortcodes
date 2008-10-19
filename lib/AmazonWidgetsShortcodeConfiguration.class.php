<?php
/**
 * @author oncletom
 */

class AmazonWidgetsShortcodeConfiguration
{
  /**
   * Easy way to get the whole list of registered options
   * 
   * @author oncletom
   * @version 2.0
   * @since 1.3
   * @return $options Array List of options and meta
   */
  function getOptions()
  {
    return array(
      'awshortcode_align' => array(
        'autoload' => true,
        'defaultValue' => 'center',
        'onSaveCallback' => '',
        'possibleValues' => array(
          'left' => __('left', 'awshortcode'),
          'center' => __('centered', 'awshortcode'),
          'right' => __('right', 'awshortcode')
        ),
      ),
      'awshortcode_context_links' => array(
        'autoload' => true,
        'defaultValue' => 0,
        'onSaveCallback' => 'intval',
        'possibleValues' => array(0, 1),
      ),
      'awshortcode_feed' => array(
        'autoload' => true,
        'defaultValue' => 0,
        'onSaveCallback' => 'intval',
        'possibleValues' => array(0, 1),
      ),
      'awshortcode_inline_documentation' => array(
        'autoload' => true,
        'defaultValue' => 0,
        'onSaveCallback' => 'intval',
        'possibleValues' => array(0, 1),
      ),
      'awshortcode_product_preview' => array(
        'autoload' => true,
        'defaultValue' => 0,
        'onSaveCallback' => 'intval',
        'possibleValues' => array(0, 1),
      ),
      'awshortcode_region' => array(
        'autoload' => true,
        'defaultValue' => 'us',
        'onSaveCallback' => '',
        'possibleValues' => '',
      ),
      'awshortcode_strict_standards' => array(
        'autoload' => true,
        'defaultValue' => 0,
        'onSaveCallback' => 'intval',
        'possibleValues' => array(0, 1),
      ),
      'awshortcode_tracking_id' => array(
        'autoload' => true,
        'defaultValue' => '',
        'onSaveCallback' => '',
        'possibleValues' => '',
      ),
    );
  }

  /**
   * Return a region configuration
   * 
   * @author oncletom
   * @version 1.0
   * @since 1.3
   * @return $region Array Specific region settings
   * @param $country_code String[optional] Country code to get settings ; if null, grab the default region
   */
  function getRegion($country_code = null)
  {
    if (is_null($country_code))
    {
      $country_code = get_option('awshortcode_region');
      $country_code = $country_code ? $country_code : 'us';
    }

    $regions = AmazonWidgetsShortcodeConfiguration::getRegions();

    return $regions[$country_code];
  }

  /**
   * Returns all region configuration
   * 
   * @author oncletom
   * @version 2.0
   * @since 1.3
   * @return $regions Array
   */
  function getRegions()
  {
    return array(
      'ca' => array(
        'lang_iso_code' => 'en_CA',
        'marketplace' => 'CA',
        'name' => __('Amazon Canada', 'awshortcode'),
        'suffix' => '-20',
        'url' => array(
          'affiliate' => 'http://associates.amazon.ca/',
          'site' => 'http://www.amazon.ca/',
          'tool-contextlinks' => 'http://cls.assoc-amazon.ca/ca/s/cls.js',
          'tool-productpreview' => 'http://www.assoc-amazon.ca/s/link-enhancer?tag=%s&amp;o=15',
          'widget-carrousel' => 'http://ws.amazon.ca/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8010%%2F%s&amp;Operation=%s',
          'widget-myfavorites' => 'http://ws.amazon.ca/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8001/%s',
          'widget-product' => 'http://rcm-ca.amazon.ca/e/cm?t=%s&amp;o=15&amp;p=8&amp;l=as1&amp;asins=%s&amp;fc1=%s&amp;%s=1&amp;lt1=%s&amp;lc1=%s&amp;bc1=%s&amp;bg1=%s&amp;f=ifr',
          'widget-productcloud' => 'http://ws.amazon.ca/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8006/%s',
          'widget-slideshow' => 'http://ws.amazon.ca/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8003%%2F%s&amp;Operation=%s',
          'widget-wishlist' =>  'http://ws.amazon.ca/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8004/%s',
        ),
      ),
      /*'de' => array(
        'lang_iso_code' => 'de_DE',
        'marketplace' => 'DE',
        'name' => __('Amazon Germany', 'awshortcode'),
        'suffix' => '-21',
        'url' => array(
          'affiliate' => '',
          'site' => 'http://www.amazon.de/',
          'tool-contextlinks' => '',
          'tool-productpreview' => '',
          'widget-carrousel' => '',
          'widget-product' => '',
        ),
      ),*/
      'fr' => array(
        'lang_iso_code' => 'fr_FR',
        'marketplace' => 'FR',
        'name' => __('Amazon France', 'awshortcode'),
        'suffix' => '-21',
        'url' => array(
          'affiliate' => 'http://partenaires.amazon.fr/',
          'site' => 'http://www.amazon.fr/',
          'tool-contextlinks' => 'http://cls.assoc-amazon.fr/fr/s/cls.js',
          'tool-productpreview' => 'http://www.assoc-amazon.fr/s/link-enhancer?tag=%s&o=8',
          'widget-carrousel' => 'http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8010%%2F%s&amp;Operation=%s',
          'widget-myfavorites' => 'http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8001/%s',
          'widget-product' => 'http://rcm-fr.amazon.fr/e/cm?t=%s&amp;o=8&amp;p=8&amp;l=as1&amp;asins=%s&amp;fc1=%s&amp;%s=1&amp;lt1=%s&amp;lc1=%s&amp;bc1=%s&amp;bg1=%s&amp;f=ifr',
          'widget-productcloud' => 'http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8006/%s',
          'widget-slideshow' => 'http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8003%%2F%s&amp;Operation=%s',
          'widget-wishlist' =>  'http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8004/%s',
        ),
      ),
      /*'jp' => array(
        'lang_iso_code' => 'ja_JP',
        'marketplace' => 'JP',
        'name' => __('Amazon Japan', 'awshortcode'),
        'suffix' => '',
        'url' => array(
          'affiliate' => '',
          'site' => 'http://www.amazon.co.jp/',
          'tool-contextlinks' => '',
          'tool-productpreview' => '',
          'widget-carrousel' => '',
          'widget-product' => '',
        ),
      ),*/
      'uk' => array(
        'lang_iso_code' => 'en_UK',
        'marketplace' => 'UK',
        'name' => __('Amazon United Kingdom', 'awshortcode'),
        'suffix' => '-21',
        'url' => array(
          'affiliate' => 'http://affiliate-program.amazon.co.uk/',
          'site' => 'http://www.amazon.co.uk/',
          'tool-contextlinks' => 'http://cls.assoc-amazon.co.uk/gb/s/cls.js',
          'tool-productpreview' => 'http://www.assoc-amazon.co.uk/s/link-enhancer?tag=%s&amp;o=2',
          'widget-carrousel' => 'http://ws.amazon.co.uk/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8010%%2F%s&amp;Operation=%s',
          'widget-myfavorites' => 'http://ws.amazon.co.uk/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8001/%s',
          'widget-product' => 'http://rcm-uk.amazon.co.uk/e/cm?t=%s&amp;o=2&amp;p=8&amp;l=as1&amp;asins=%s&amp;fc1=%s&amp;%s=1&amp;lt1=%s&amp;lc1=%s&amp;bc1=%s&amp;bg1=%s&amp;f=ifr',
          'widget-productcloud' => 'http://ws.amazon.co.uk/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8006/%s',
          'widget-slideshow' => 'http://ws.amazon.co.uk/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8003%%2F%s&amp;Operation=%s',
          'widget-wishlist' =>  'http://ws.amazon.co.uk/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8004/%s',
        ),
      ),
      'us' => array(
        'lang_iso_code' => 'en_US',
        'marketplace' => 'US',
        'name' => __('Amazon USA', 'awshortcode'),
        'suffix' => '-20',
        'url' => array(
          'affiliate' => 'https://affiliate-program.amazon.com/',
          'site' => 'http://www.amazon.com/',
          'tool-contextlinks' => 'http://cls.assoc-amazon.com/s/cls.js',
          'tool-productpreview' => 'http://www.assoc-amazon.com/s/link-enhancer?tag=%s&amp;o=1',
          'widget-carrousel' => 'http://ws.amazon.com/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8010%%2F%s&amp;Operation=%s',
          'widget-myfavorites' => 'http://ws.amazon.com/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8001/%s',
          'widget-product' => 'http://rcm.amazon.com/e/cm?t=%s&amp;o=1&amp;p=8&amp;l=as1&amp;asins=%s&amp;fc1=%s&amp;%s=1&amp;lt1=%s&amp;lc1=%s&amp;bc1=%s&amp;bg1=%s&amp;f=ifr',
          'widget-productcloud' => 'http://ws.amazon.com/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8006/%s',
          'widget-slideshow' => 'http://ws.amazon.com/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8003%%2F%s&amp;Operation=%s',
          'widget-wishlist' =>  'http://ws.amazon.com/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8004/%s',
        ),
      ),
    );
  }

  /**
   * Returns shortcodes configuration
   * 
   * @static
   * @version 1.0
   * @since 1.3
   * @return $shortcodes Array Shortcodes configuration
   */
  public function getShortcodes()
  {
    return array(
      'amazon-carrousel' => array(
        'class' => 'AmazonWidgetsShortcodeCarrousel',
      ),
      'amazon-myfavorites' => array(
        'class' => 'AmazonWidgetsShortcodeMyFavorites',
      ),
      'amazon-product' => array(
        'class' => 'AmazonWidgetsShortcodeProduct',
      ),
      'amazon-productcloud' => array(
        'class' => 'AmazonWidgetsShortcodeProductCloud',
      ),
      'amazon-slideshow' => array(
        'class' => 'AmazonWidgetsShortcodeSlideshow',
      ),
      'amazon-wishlist' => array(
        'class' => 'AmazonWidgetsShortcodeWishlist',
      ),
    );
  }
}
