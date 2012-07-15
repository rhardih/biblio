<?php

if (isset($_GET['read'])) {
  
  $read = new Read($_GET['read']);

  if ($read->is_valid) {
?>

<h3>Notes</h3>
<form method="post" action="?page=biblio_notes">
  <p>
  <b><?php echo $read['title'] ?></b><br />
  <?php echo $read['author'] ?>
  </p>
  <div id="poststuff">
    <?php the_editor($read['notes']); ?>
  </div>
  <input type="hidden" name="read" value="<?php echo $_GET['read']; ?>" />

<?php
wp_nonce_field('biblio-add','name_of_nonce_field');
submit_button("Submit");
?>

</form>

<?php
  } else {
?>

<div class="error">
  <p>No Read by that id.</p>
</div>

<?php
  }
}
?>
