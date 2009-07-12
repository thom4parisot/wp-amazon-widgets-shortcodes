<div class="wrap awshortcode-options" id="awshortcode">
  <h2><?php _e('Amazon Widgets Shortcodes', 'awshortcode') ?></h2>

  <p><?php _e('Gladly welcome to the <em>Amazon Widgets Shortcodes</em> configuration page!', 'awshortcode') ?>

  <p><?php printf(
            __(
              'You can <a href="%s" class="new-window">ask for help</a>'.
              ', <a href="%s" class="new-window">write a feedback</a> (positive or negative)'.
              ', <a href="%s" class="new-window">declare a bug</a>'.
              ' or even <a href="%s" class="new-window">read existing feedbacks</a>.'.
              '<br />If you are already a Wordpress developer, '.
              'please use <a href="%s" class="new-window">Wordpress Plugins Trac</a> instead.',
              'awshortcode')
            ,
            'http://wordpress.org/tags/amazon-widgets-shortcodes,help?forum_id=10#postform',
            'http://wordpress.org/tags/amazon-widgets-shortcodes,feedback?forum_id=10#postform',
            'http://wordpress.org/tags/amazon-widgets-shortcodes,bug?forum_id=10#postform',
            'http://wordpress.org/tags/amazon-widgets-shortcodes',
            'http://plugins.trac.wordpress.org/newticket?component=amazon-widgets-shortcodes&owner=oncletom'
            ) ?></p>

  <p><?php _e('Enjoy the usage of this plugin!', 'awshortcode') ?></p>

  <form action="options.php" method="post">
    <?php if ($wp_version < '2.7' && !isset($wpmu_version)): ?>
      <?php wp_nonce_field('update-options') ?>
    <?php else: ?>
      <?php wp_nonce_field('awshortcode-options') ?>
      <input type="hidden" name="option_page" value="awshortcode" />
    <?php endif ?>
    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="<?php echo implode(',', array_keys($options)) ?>" />

    <ul id="awshortcode-navigation" class="tablenav">
      <li><a href="#awshortcode-main" class="button-secondary"><?php _e('Main Options', 'awshortcode') ?></a></li>
      <li><a href="#awshortcode-tools" class="button-secondary"><?php _e('Additional Tools', 'awshortcode') ?></a></li>
      <li><a href="#awshortcode-documentation" class="button-secondary"><?php _e('Documentation', 'awshortcode') ?></a></li>
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
            <?php foreach($regions as $id => $region): ?>
              <option value="<?php echo $id ?>"<?php echo $id === get_option('awshortcode_region') ? ' selected="selected"' : '' ?>>
                <?php echo $region['name'] ?>
              </option>
            <?php endforeach ?>
            </select>
            <span class="help">
              (<?php printf(
                             __('currenty set on <a href="%2$s" class="new-window">%1$s</a>', 'awshortcode'),
                             $regions[get_option('awshortcode_region')]['name'],
                             $regions[get_option('awshortcode_region')]['url']['affiliate']
                           ) ?>)
            </span>
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
              <?php printf(
                      __('Your Amazon Tracking ID, generally suffixed by %s.', 'awshortcode'),
                      $regions[get_option('awshortcode_region')]['suffix']
                    ) ?>
            </span>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="awshortcode_inline_documentation">
              <?php _e('Show inline documentation?', 'awshortcode') ?>
            </label>
          </th>
          <td>
            <input type="checkbox"
              id="awshortcode_inline_documentation"
              name="awshortcode_inline_documentation"
              value="1"
              <?php if (get_option('awshortcode_inline_documentation')): ?>
              checked="checked"
              <?php endif ?>
               />
            <span class="help">
              <?php _e(
                'Inline documentation will be located under your writing area '.
                'in both post and page admin area.<br />It will help you to include '.
                'Amazon Widgets in a wiser way.'
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
            <?php foreach ($options['awshortcode_align']['possibleValues'] as $key => $value): ?>
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
        <tr>
          <th scope="row">
            <label for="awshortcode_strict_standards">
              <?php _e('Strict Standards compliance?', 'awshortcode') ?>
            </label>
          </th>
          <td>
            <input type="checkbox"
              id="awshortcode_strict_standards"
              name="awshortcode_strict_standards"
              value="1"
              <?php if (get_option('awshortcode_strict_standards')): ?>
              checked="checked"
              <?php endif ?>
               />
            <span class="help">
              <?php _e(
                'If you need to validate your website in HTML or XHTML Strict, '.
                'please tick this box.<br />Just keep in mind Internet Explorer 6 '.
                'may display glitches on some Amazon Widgets.'
                , 'awshortcode') ?>
            </span>
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
              <?php _e('Enable context links:', 'awshortcode') ?>
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
            <label for="awshortcode_product_preview">
              <?php _e('Enable product preview:', 'awshortcode') ?>
            </label>
          </th>
          <td>
            <input type="checkbox"
              id="awshortcode_product_preview"
              name="awshortcode_product_preview"
              value="1"
              <?php if (get_option('awshortcode_product_preview')): ?>
              checked="checked"
              <?php endif ?>
               />
            <span class="help">
              <?php _e(
                'Product preview display a tooltip on all hypertext '.
                'links aiming to an Amazon product with informations such '.
                'as price, picture, full name etc.'
                , 'awshortcode') ?>
            </span>
          </td>
        </tr>
      </tbody>
    </table>
    </div>

    <div id="awshortcode-documentation">
      <?php AmazonWidgetsShortcodesAdmin::displayDocumentation() ?>
    </div>

    <p class="submit">
      <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
    </p>

  </form>
</div>