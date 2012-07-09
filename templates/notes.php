<?php

switch ($_GET['action']) {
case "show":
  load_template(TEMPLATES_DIR . 'notes/show.php');
  break;
default:
  load_template(TEMPLATES_DIR . 'notes/index.php');
}

?>
