<?php

echo '<pre>' . print_r($_POST, true) . '</pre>';

function handle_create() {
  $read = new Read(intval($_POST['read_id']));
  if ($read->is_valid) {
    $params = array(
      'notes' => $_POST['content']
    );
    if($read->update($params)) {
      notice('Updated!');
    } else {
      error_log('update failed');
    }
  } else {
    error('No Read by that id.');
  }
}

if ($_POST && check_admin_referer('note', 'biblio_nonce')) {
  switch ($_POST['action']) {
  case 'update':
    handle_create();
    break;
  default:
    error('Unknown action.');
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
