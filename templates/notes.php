<?php

var_dump($_POST);

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

<div class="wrap">
  <div id="biblio_wrapper">
    <h2>Biblio</h2>

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
</div>
