<?php
$read = new Read(intval($_GET['read_id']));
if ($read->is_valid) {
?>

<h3><?php echo $read['title'] ?> - <?php echo $read['author'] ?></h3>
<br />

<form method="post" action="<?php echo biblio_url($_GET); ?>">
  <div id="poststuff">
    <?php the_editor($read['notes']); ?>
  </div>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="read_id" value="<?php echo $_GET['read_id']; ?>" />

  <p class="submit">
    <?php
    wp_nonce_field('note','biblio_nonce');
    submit_button("Save note", 'primary', 'submit', false);
    $params = array_intersect_key($_GET, array('page' => 0));
    ?>
    or <a href="<?php echo biblio_url($params); ?>">Back</a>
  </p>
</form>

<?php
  } else {
    error('No Read by that id.');
  }
?>
