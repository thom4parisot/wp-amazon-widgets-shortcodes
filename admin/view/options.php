<div class="wrap">
  <h2><?php _e('Amazon Widgets Shortcodes: Options') ?></h2>
  <?php
  /*
   * Options dynamic options
   */
  $alignments = array(
    'left' => __('left'),
    'center' => __('centered'),
    'right' => __('right')
  );
  ?>

  <form action="options.php" method="post">
    <?php wp_nonce_field('update-options') ?>
    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="awshortcode_tracking_id,awshortcode_feed,awshortcode_align" />

    <h3><?php _e('Main Options') ?></h3>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="awshortcode_tracking_id"><?php _e('Amazon Tracking ID:') ?></label>
          </th>
          <td>
            <input type="text"
              id="awshortcode_tracking_id"
              name="awshortcode_tracking_id"
              value="<?php echo get_option('awshortcode_tracking_id') ?>" />
            <span class="help">
              <?php _e('Your Amazon Tracking ID, generally suffixed by -21') ?>
            </span>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="awshortcode_feed"><?php _e('Show Amazon widgets in RSS feeds?') ?></label>
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
          </td>
        </tr>
      </tbody>
    </table>

    <h3><?php _e('Layout Options') ?></h3>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="awshortcode_align"><?php _e('Default widget alignment:') ?></label>
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

  <p class="submit">
    <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
  </p>

  </form>
</div>