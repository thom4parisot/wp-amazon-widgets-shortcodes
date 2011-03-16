<?php
/**
 * @author oncletom
 */

class AmazonWidgetsShortcodeConfiguration
{
  /**
   * Retrieves disabled widgets list
   *
   * @author	oncletom
   * @version	1.0
   * @since		1.6
   */
  function getDisabledWidgets()
  {
  	static $disabledWidgets;

  	if (null === $disabledWidgets)
  	{
  		$disabledWidgets = ('' === $disabledWidgets) ? array() : get_option('awshortcode_disabled_widgets');

      if (is_string($disabledWidgets))
      {
        $disabledWidgets = unserialize($disabledWidgets);
      }
  	}

  	return $disabledWidgets;
  }

  /**
   * Retrieves enabled widgets list
   *
   * @author  oncletom
   * @version 1.0
   * @since   1.6
   */
  function getEnabledWidgets()
  {
    static $enabledWidgets;

    if (null === $enabledWidgets)
    {
      $enabledWidgets = array_flip(array_keys(AmazonWidgetsShortcodeConfiguration::getShortcodes()));
      foreach (AmazonWidgetsShortcodeConfiguration::getDisabledWidgets() as $w)
      {
        unset($enabledWidgets[$w]);
      }

      $enabledWidgets = array_flip($enabledWidgets);
    }

    return $enabledWidgets;
  }

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
      'awshortcode_disabled_widgets' => array(
      	'autoload' => yes,
      	'defaultValue' => array(),
      	'onSaveCallback' => 'serialize',
      	'possibleValue' => '',
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
      'awshortcode_tracking_image' => array(
        'autoload' => true,
        'defaultValue' => 1,
        'onSaveCallback' => '',
        'possibleValues' => array(0, 1),
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
   * @param $region String[optional] Country code to get settings ; if null, grab the default region
   */
  function getRegion($region = null)
  {
    if (is_null($region) || !$region)
    {
      $region = get_option('awshortcode_region');
      $region = $region ? $region : 'us';
    }

    $regions = AmazonWidgetsShortcodeConfiguration::getRegions();

    return $regions[$region];
  }

  /**
   * Returns all region configuration
   *
   * @author oncletom
   * @version 2.1
   * @since 1.3
   * @return $regions Array
   */
  function getRegions()
  {
    return array(
      'ca' => array(
        'lang_iso_code' => 'en_CA',
        'marketplace' =>   'CA',
        'name' =>          __('Amazon Canada', 'awshortcode'),
        'suffix' =>        '-20',
        'tld' =>           'ca',
        'url' => array(
          'affiliate' =>            'http://associates.amazon.ca/',
          'images' =>               'http://ecx.images-amazon.com/images/I/%s',
          'product' =>              'http://www.amazon.ca/gp/product/%s?ie=UTF8&amp;tag=%s&amp;linkCode=as2&amp;camp=1642&amp;creative=6746&amp;creativeASIN=%1$s',
          'site' =>                 'http://www.amazon.ca/',
          'tool-contextlinks' =>    'http://cls.assoc-amazon.ca/ca/s/cls.js',
          'tool-productpreview' =>  'http://www.assoc-amazon.ca/s/link-enhancer?tag=%s&amp;o=15',
          'widget-carrousel' =>     'http://ws.amazon.ca/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8010%%2F%s&amp;Operation=%s',
          'widget-deals' =>         'http://ws.amazon.ca/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8009%%2F%s&amp;Operation=%s',
          'widget-mp3' =>           'http://ws.amazon.ca/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8014%%2F%s&amp;Operation=%s',
          'widget-myfavorites' =>   'http://ws.amazon.ca/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8001/%s',
          'widget-product' =>       'http://rcm-ca.amazon.ca/e/cm?t=%s&amp;o=15&amp;p=8&amp;l=as1&amp;asins=%s&amp;fc1=%s&amp;%s=1&amp;lt1=%s&amp;lc1=%s&amp;bc1=%s&amp;bg1=%s&amp;f=ifr',
          'widget-productcloud' =>  'http://ws.amazon.ca/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8006/%s',
          'widget-slideshow' =>     'http://ws.amazon.ca/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8003%%2F%s&amp;Operation=%s',
          'widget-wishlist' =>      'http://ws.amazon.ca/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8004/%s',
        ),
      ),
      'de' => array(
        'lang_iso_code' => 'de_DE',
        'marketplace' =>   'DE',
        'name' =>          __('Amazon Germany', 'awshortcode'),
        'suffix' =>        '-21',
        'url' => array(
          'affiliate' =>            'http://partnernet.amazon.de/',
          'images' =>               'http://ecx.images-amazon.com/images/I/%s',
          'product' =>              'http://www.amazon.de/gp/product/%s?ie=UTF8&amp;tag=%s&amp;linkCode=as2&amp;camp=1642&amp;creative=6746&amp;creativeASIN=%1$s',
          'site' =>                 'http://www.amazon.de/',
          'tool-contextlinks' =>    'http://cls.assoc-amazon.de/de/s/cls.js',
          'tool-productpreview' =>  'http://www.assoc-amazon.de/s/link-enhancer?tag=%s&amp;o=3',
          'widget-carrousel' =>     'http://ws.amazon.de/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8010%%2F%s&amp;Operation=%s',
          'widget-deals' =>         'http://ws.amazon.de/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8009%%2F%s&amp;Operation=%s',
          'widget-mp3' =>           'http://ws.amazon.de/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8014%%2F%s&amp;Operation=%s',
          'widget-myfavorites' =>   'http://ws.amazon.de/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8001/%s',
          'widget-product' =>       'http://rcm-de.amazon.de/e/cm?t=%s&amp;o=3&amp;p=8&amp;l=as1&amp;asins=%s&amp;fc1=%s&amp;%s=1&amp;lt1=%s&amp;lc1=%s&amp;bc1=%s&amp;bg1=%s&amp;f=ifr',
          'widget-productcloud' =>  'http://ws.amazon.de/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8006/%s',
          'widget-slideshow' =>     'http://ws.amazon.de/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8003%%2F%s&amp;Operation=%s',
          'widget-wishlist' =>      'http://ws.amazon.de/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8004/%s',
        ),
      ),
      'fr' => array(
        'lang_iso_code' => 'fr_FR',
        'marketplace' =>   'FR',
        'name' =>          __('Amazon France', 'awshortcode'),
        'tld' =>           'fr',
        'suffix' =>        '-21',
        'url' => array(
          'affiliate' =>            'http://partenaires.amazon.fr/',
          'images' =>               'http://ecx.images-amazon.com/images/I/%s',
          'product' =>              'http://www.amazon.fr/gp/product/%s?ie=UTF8&amp;tag=%s&amp;linkCode=as2&amp;camp=1642&amp;creative=6746&amp;creativeASIN=%1$s',
          'site' =>                 'http://www.amazon.fr/',
          'tool-contextlinks' =>    'http://cls.assoc-amazon.fr/fr/s/cls.js',
          'tool-productpreview' =>  'http://www.assoc-amazon.fr/s/link-enhancer?tag=%s&o=8',
          'widget-carrousel' =>     'http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8010%%2F%s&amp;Operation=%s',
          'widget-deals' =>         'http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8009%%2F%s&amp;Operation=%s',
          'widget-mp3' =>           'http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8014%%2F%s&amp;Operation=%s',
          'widget-myfavorites' =>   'http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8001/%s',
          'widget-product' =>       'http://rcm-fr.amazon.fr/e/cm?t=%s&amp;o=8&amp;p=8&amp;l=as1&amp;asins=%s&amp;fc1=%s&amp;%s=1&amp;lt1=%s&amp;lc1=%s&amp;bc1=%s&amp;bg1=%s&amp;f=ifr',
          'widget-productcloud' =>  'http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8006/%s',
          'widget-slideshow' =>     'http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8003%%2F%s&amp;Operation=%s',
          'widget-wishlist' =>      'http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8004/%s',
        ),
      ),
      'it' => array(
        'lang_iso_code' => 'it_IT',
        'marketplace' =>   'IT',
        'name' =>          __('Amazon Italia', 'awshortcode'),
        'tld' =>           'it',
        'suffix' =>        '-21',
        'url' => array(
          'affiliate' =>            'http://programma-affiliazione.amazon.it/',
          'images' =>               'http://ecx.images-amazon.com/images/I/%s',
          'product' =>              'http://www.amazon.it/gp/product/%s?ie=UTF8&amp;tag=%s&amp;linkCode=as2&amp;camp=3370&amp;creative=23322&amp;creativeASIN=%1$s',
          'site' =>                 'http://www.amazon.it/',
          'tool-contextlinks' =>    'http://cls.assoc-amazon.it/it/s/cls.js',
          'tool-productpreview' =>  'http://www.assoc-amazon.it/s/link-enhancer?tag=%s&o=29',
          'widget-carrousel' =>     'http://ws.amazon.it/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8010%%2F%s&amp;Operation=%s',
          'widget-deals' =>         'http://ws.amazon.it/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8009%%2F%s&amp;Operation=%s',
          'widget-mp3' =>           'http://ws.amazon.it/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8014%%2F%s&amp;Operation=%s',
          'widget-myfavorites' =>   'http://ws.amazon.it/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8001/%s',
          'widget-product' =>       'http://rcm-fr.amazon.it/e/cm?t=%s&amp;o=29&amp;p=8&amp;l=as1&amp;asins=%s&amp;fc1=%s&amp;%s=1&amp;lt1=%s&amp;lc1=%s&amp;bc1=%s&amp;bg1=%s&amp;f=ifr',
          'widget-productcloud' =>  'http://ws.amazon.it/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8006/%s',
          'widget-slideshow' =>     'http://ws.amazon.it/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8003%%2F%s&amp;Operation=%s',
          'widget-wishlist' =>      'http://ws.amazon.it/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8004/%s',
        ),
      ),
      'jp' => array(
        'lang_iso_code' => 'ja_JP',
        'marketplace' =>   'JP',
        'name' =>          __('Amazon Japan', 'awshortcode'),
        'suffix' =>        '-22',
        'url' => array(
          'affiliate' =>            'http://affiliate.amazon.co.jp/',
          'images' =>               'http://ecx.images-amazon.com/images/I/%s',
          'product' =>              'http://www.amazon.co.jp/gp/product/%s?ie=UTF8&amp;tag=%s&amp;linkCode=as2&amp;camp=1642&amp;creative=6746&amp;creativeASIN=%1$s',
          'site' =>                 'http://www.amazon.co.jp/',
          'tool-contextlinks' =>    '',
          'tool-productpreview' =>  'http://www.assoc-amazon.jp/s/link-enhancer?tag=%s&o=9',
          'widget-carrousel' =>     'http://ws.amazon.co.jp/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8010%%2F%s&amp;Operation=%s',
          'widget-deals' =>         'http://ws.amazon.co.jp/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8009%%2F%s&amp;Operation=%s',
          'widget-mp3' =>           'http://ws.amazon.co.jp/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8014%%2F%s&amp;Operation=%s',
          'widget-myfavorites' =>   'http://ws.amazon.co.jp/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8001/%s',
          'widget-product' =>       'http://rcm-jp.amazon.co.jp/e/cm?t=%s&amp;o=9&amp;p=8&amp;l=as1&amp;asins=%s&amp;fc1=%s&amp;%s=1&amp;lt1=%s&amp;lc1=%s&amp;bc1=%s&amp;bg1=%s&amp;f=ifr',
          'widget-productcloud' =>  'http://ws.amazon.co.jp/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8006/%s',
          'widget-slideshow' =>     'http://ws.amazon.co.jp/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8003%%2F%s&amp;Operation=%s',
          'widget-wishlist' =>      'http://ws.amazon.co.jp/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8004/%s',
        ),
      ),
      'uk' => array(
        'lang_iso_code' => 'en_UK',
        'marketplace' =>   'UK',
        'name' =>          __('Amazon United Kingdom', 'awshortcode'),
        'suffix' =>        '-21',
        'tld' =>           'co.uk',
        'url' => array(
          'affiliate' =>            'http://affiliate-program.amazon.co.uk/',
          'images' =>               'http://ecx.images-amazon.com/images/I/%s',
          'product' =>              'http://www.amazon.co.uk/gp/product/%s?ie=UTF8&amp;tag=%s&amp;linkCode=as2&amp;camp=1642&amp;creative=6746&amp;creativeASIN=%1$s',
          'site' =>                 'http://www.amazon.co.uk/',
          'tool-contextlinks' =>    'http://cls.assoc-amazon.co.uk/gb/s/cls.js',
          'tool-productpreview' =>  'http://www.assoc-amazon.co.uk/s/link-enhancer?tag=%s&amp;o=2',
          'widget-carrousel' =>     'http://ws.amazon.co.uk/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8010%%2F%s&amp;Operation=%s',
          'widget-deals' =>         'http://ws.amazon.co.uk/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8009%%2F%s&amp;Operation=%s',
          'widget-mp3' =>           'http://ws.amazon.co.uk/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8014%%2F%s&amp;Operation=%s',
          'widget-myfavorites' =>   'http://ws.amazon.co.uk/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8001/%s',
          'widget-product' =>       'http://rcm-uk.amazon.co.uk/e/cm?t=%s&amp;o=2&amp;p=8&amp;l=as1&amp;asins=%s&amp;fc1=%s&amp;%s=1&amp;lt1=%s&amp;lc1=%s&amp;bc1=%s&amp;bg1=%s&amp;f=ifr',
          'widget-productcloud' =>  'http://ws.amazon.co.uk/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8006/%s',
          'widget-slideshow' =>     'http://ws.amazon.co.uk/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8003%%2F%s&amp;Operation=%s',
          'widget-wishlist' =>      'http://ws.amazon.co.uk/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8004/%s',
        ),
      ),
      'us' => array(
        'lang_iso_code' => 'en_US',
        'marketplace' =>   'US',
        'name' =>          __('Amazon USA', 'awshortcode'),
        'suffix' =>        '-20',
        'tld' =>           'com',
        'url' => array(
          'affiliate' =>            'https://affiliate-program.amazon.com/',
          'images' =>               'http://ecx.images-amazon.com/images/I/%s',
          'product' =>              'http://www.amazon.com/gp/product/%s?ie=UTF8&amp;tag=%s&amp;linkCode=as2&amp;camp=1642&amp;creative=6746&amp;creativeASIN=%1$s',
          'site' =>                 'http://www.amazon.com/',
          'tool-contextlinks' =>    'http://cls.assoc-amazon.com/s/cls.js',
          'tool-productpreview' =>  'http://www.assoc-amazon.com/s/link-enhancer?tag=%s&amp;o=1',
          'widget-carrousel' =>     'http://ws.amazon.com/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8010%%2F%s&amp;Operation=%s',
          'widget-deals' =>         'http://ws.amazon.com/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8009%%2F%s&amp;Operation=%s',
          'widget-mp3' =>           'http://ws.amazon.com/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8014%%2F%s&amp;Operation=%s',
          'widget-myfavorites' =>   'http://ws.amazon.com/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8001/%s',
          'widget-product' =>       'http://rcm.amazon.com/e/cm?t=%s&amp;o=1&amp;p=8&amp;l=as1&amp;asins=%s&amp;fc1=%s&amp;%s=1&amp;lt1=%s&amp;lc1=%s&amp;bc1=%s&amp;bg1=%s&amp;f=ifr',
          'widget-productcloud' =>  'http://ws.amazon.com/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8006/%s',
          'widget-slideshow' =>     'http://ws.amazon.com/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822%%2F%1$s%%2F%s%%2F8003%%2F%s&amp;Operation=%s',
          'widget-wishlist' =>      'http://ws.amazon.com/widgets/q?ServiceVersion=20070822&amp;MarketPlace=%s&amp;ID=V20070822/%1$s/%s/8004/%s',
        ),
      ),
    );
  }

  /**
   * Return a specific shortcode configuration
   *
   * @static
   * @author oncletom
   * @version 1.0
   * @since 1.3
   * @return $settings Array
   * @param $shortcode String
   */
  function getShortcode($shortcode)
  {
    $shortcodes = AmazonWidgetsShortcodeConfiguration::getShortcodes();

    return $shortcodes['amazon-'.$shortcode];
  }

  /**
   * Returns shortcodes configuration
   *
   * @static
   * @version 1.0
   * @since 1.3
   * @return $shortcodes Array Shortcodes configuration
   */
  function getShortcodes()
  {
    return array(
      'amazon-carrousel' => array(
        'class' => 'AmazonWidgetsShortcodeCarrousel',
    	'name' => __('Amazon Carrousel', 'awshortcode'),
      ),
      'amazon-deals' => array(
        'class' => 'AmazonWidgetsShortcodeDeals',
    	'name' => __('Amazon Deals', 'awshortcode'),
      ),
      'amazon-mp3' => array(
        'class' => 'AmazonWidgetsShortcodeMp3',
    	'name' => __('Amazon MP3', 'awshortcode'),
      ),
      'amazon-myfavorites' => array(
        'class' => 'AmazonWidgetsShortcodeMyFavorites',
    	'name' => __('Amazon My Favorites', 'awshortcode'),
      ),
      'amazon-product' => array(
        'class' => 'AmazonWidgetsShortcodeProduct',
        'default_type' => 'both',
    	'name' => __('Amazon Product', 'awshortcode'),
        'types' => array(
          'both' => __('Image and Text'),
          'image' => __('Image only'),
          'text' => __('Text only'),
        ),
      ),
      'amazon-productcloud' => array(
        'class' => 'AmazonWidgetsShortcodeProductCloud',
    	'name' => __('Amazon Product Cloud', 'awshortcode'),
      ),
      'amazon-slideshow' => array(
        'class' => 'AmazonWidgetsShortcodeSlideshow',
    	'name' => __('Amazon Slideshow', 'awshortcode'),
      ),
      'amazon-wishlist' => array(
        'class' => 'AmazonWidgetsShortcodeWishlist',
    	'name' => __('Amazon Wishlist', 'awshortcode'),
      ),
    );
  }
}
