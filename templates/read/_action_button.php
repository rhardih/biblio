<form class="<?php echo $action; ?>" action="?page=biblio_main" method="post">
  <input type="hidden" name="action" value="<?php echo $action; ?>" />
  <input type="hidden" name="id" value="<?php echo $reading['id']; ?>" />
  <input type="hidden" name="status" value="<?php echo $status_value; ?>" />
  <?php wp_nonce_field('read', 'biblio_nonce'); ?>
  <?php submit_button($text, 'secondary', 'submit', false) ?>
</form>
