<?php
/**
 * @author oncletom
 */

if ($_POST['action'] == 'update')
{
  foreach ($options as $id => $option)
  {
    update_option(
      $id,
      $option['onSaveCallback']
        ? call_user_func($option['onSaveCallback'], $_POST[$id])
        : $_POST[$id]
    );
  }

  ?>
  <div class="updated">
    <p>
      <strong><?php _e('Options saved.', 'awshortcode') ?></strong>
    </p>
  </div>
  <?php
}