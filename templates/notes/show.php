<?php
$read = new Read(intval($_GET['read_id']));
if ($read->is_valid) {
?>

<h3><?php echo $read['title'] ?> - <?php echo $read['author'] ?></h3>
<br />

<form method="post" action="?page=biblio_notes">
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
    error('No Read by that id.');
  }
?>
