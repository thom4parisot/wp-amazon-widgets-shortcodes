<div class="wrap awshortcode-options" id="awshortcode">
  <h2><?php _e('Amazon Widgets Shortcodes', 'awshortcode') ?></h2>

  <p><?php printf(
            __(
              'Gladly welcome to the <em>Amazon Widgets Shortcodes</em> configuration page.<br />'.
              'You can also help improving this plugin by '.
              '<a href="%s" class="new-window">declaring a bug</a> '.
              'or even look at the <a href="%s" class="new-window">official plugin homepage</a> '.
              '(or <a href="%s" class="new-window">the author\'s one</a>).',
              'awshortcode')
            ,
            'http://plugins.trac.wordpress.org/newticket?component=amazon-widgets-shortcodes&owner=oncletom',
            'http://wordpress.org/extend/plugins/amazon-widgets-shortcodes/',
            'http://case.oncle-tom.net/code/wordpress/') ?></p>
  <p><?php printf(
            __(
              'For your convenience, the shortcode documentation is available on each '.
              'post and page edit screen, in a box called <em>%s</em>.',
              'awshortcode')
            ,
            __('Amazon Widgets Shortcodes documentation', 'awshortcode')) ?></p>

  <?php
  /*
   * Options dynamic options
   */
  $alignments = array(
    'left' => __('left', 'awshortcode'),
    'center' => __('centered', 'awshortcode'),
    'right' => __('right', 'awshortcode')
  );
  ?>

  <form action="options.php" method="post">
    <?php wp_nonce_field('update-options') ?>
    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="awshortcode_tracking_id,awshortcode_feed,awshortcode_align,awshortcode_context_links,awshortcode_region" />

    <ul id="awshortcode-navigation" class="tablenav">
      <li><a href="#awshortcode-main" class="button-secondary"><?php _e('Main Options', 'awshortcode') ?></a></li>
      <li><a href="#awshortcode-tools" class="button-secondary"><?php _e('Additional Tools', 'awshortcode') ?></a></li>
    </ul>

    <div id="awshortcode-main">
    <h3><?php _e('Main Options', 'awshortcode') ?></h3>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="awshortcode_region">
              <?php _e('Amazon affiliate region:', 'awshortcode') ?>
            </label>
          </th>
          <td>
            <select name="awshortcode_region" id="awshortcode_region">
            <?php foreach(AmazonWidgetsShortcodes::getRegionParameters('') as $id => $region): ?>
              <option value="<?php echo $id ?>"<?php echo $id === get_option('awshortcode_region') ? ' selected="selected"' : '' ?>>
                <?php echo $region['name'] ?>
              </option>
            <?php endforeach ?>
            </select>
          </td>
        </tr>
          <th scope="row">
            <label for="awshortcode_tracking_id">
              <?php _e('Amazon Tracking ID:', 'awshortcode') ?>
            </label>
          </th>
          <td>
            <input type="text"
              id="awshortcode_tracking_id"
              name="awshortcode_tracking_id"
              value="<?php echo get_option('awshortcode_tracking_id') ?>" />
            <span class="help">
              <?php _e('Your Amazon Tracking ID, generally suffixed by -21', 'awshortcode') ?>
            </span>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="awshortcode_feed">
              <?php _e('Show Amazon Widgets in RSS feeds?', 'awshortcode') ?>
            </label>
          </th>
          <td>
            <input type="checkbox"
              id="awshortcode_feed"
              name="awshortcode_feed"
              value="1"
              <?php if (get_option('awshortcode_feed')): ?>
              checked="checked"
              <?php endif ?>
               />
            <span class="help">
              <?php _e(
                'You may want to hide widgets in feeds in order to keep them '.
                'clean.<br />Usefull if you need to republish it on external '.
                'websites againsts ads.'
                , 'awshortcode') ?>
            </span>
          </td>
        </tr>
      </tbody>
    </table>

    <h3><?php _e('Layout Options', 'awshortcode') ?></h3>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="awshortcode_align">
              <?php _e('Default Widgets alignment:', 'awshortcode') ?>
            </label>
          </th>
          <td>
            <select id="awshortcode_align" name="awshortcode_align">
            <?php foreach ($alignments as $key => $value): ?>
              <option value="<?php echo $key ?>"
                <?php if ($key == get_option('awshortcode_align')): ?>
                  selected="selected"
                <?php endif ?>>
                <?php echo $value ?>
              </option>
            <?php endforeach ?>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
    </div>

    <div id="awshortcode-tools">
    <h3><?php _e('Additional Tools', 'awshortcode') ?></h3>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="awshortcode_context_links">
              <?php _e('Enable Amazon\'s context links:', 'awshortcode') ?>
            </label>
          </th>
          <td>
            <input type="checkbox"
              id="awshortcode_context_links"
              name="awshortcode_context_links"
              value="1"
              <?php if (get_option('awshortcode_context_links')): ?>
              checked="checked"
              <?php endif ?>
               />
            <span class="help">
              <?php _e(
                'Context links are hyperkinks automatically '.
                'added on relevant keywords of your page.'
                , 'awshortcode') ?>
            </span>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="awshortcode_enhanced_links">
              <?php _e('Enable Amazon\'s enhanced links:', 'awshortcode') ?>
            </label>
          </th>
          <td>
            <input type="checkbox"
              id="awshortcode_enhanced_links"
              name="awshortcode_enhanced_links"
              value="1"
              <?php if (get_option('awshortcode_enhanced_links')): ?>
              checked="checked"
              <?php endif ?>
               />
            <span class="help">
              <?php _e(
                'Enhanced links display a tooltip on all hypertext '.
                'links pointing to an Amazon product with informations such '.
                'as price, picture, full name etc.'
                , 'awshortcode') ?>
            </span>
          </td>
        </tr>
      </tbody>
    </table>
    </div>

    <p class="submit">
      <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
    </p>

  </form>
</div>