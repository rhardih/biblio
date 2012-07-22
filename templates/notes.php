<?php

echo '<pre>' . print_r($_POST, true) . '</pre>';

if ($_POST) {
  $read = new Read($_POST['read']);
  if ($read->is_valid) {
    $params = array(
      'notes' => $_POST['content']
    );
    if($read->update($params) == false) {
      error_log('update failed');
    }
  } else {
?>

<div class="error">
  <p>No Read by that id.</p>
</div>

<?php
  }
}
?>

<div class="wrap biblio">
  <h2><?php echo get_admin_page_title(); ?></h2>
  <hr />

  <?php
  switch ($_GET['action']) {
  case "edit":
    include(TEMPLATES_DIR . 'notes/edit.php');
    break;
  case "new":
    include(TEMPLATES_DIR . 'notes/new.php');
    break;
  case "show":
    include(TEMPLATES_DIR . 'notes/show.php');
    break;
  default:
    include(TEMPLATES_DIR . 'notes/index.php');
  }
  ?>

</div>
