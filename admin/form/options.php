<?php
/**
 * @author tparisot
 */

if ($_POST['action'] == 'update')
{
  update_option('awshortcode_align', $_POST['awshortcode_align']);
  update_option('awshortcode_context_links', $_POST['awshortcode_context_links']);
  update_option('awshortcode_feed', $_POST['awshortcode_feed']);
  update_option('awshortcode_tracking_id', $_POST['awshortcode_tracking_id']);

  ?>
  <div class="updated">
    <p>
      <strong><?php _e('Options saved.', 'awshortcode') ?></strong>
    </p>
  </div>
  <?php
}