<?php

require '../../../wp-config.php';

check_admin_referer('biblio-add');

function add_item() {
}

if ( !empty($_POST['url']) ) {
  // Save the url to the database here
  global $wpdb;
  $table_name = $wpdb->prefix . "biblio";
  $sql = "INSERT INTO $table_name " .
         "VALUES ();";
  echo 'url';
} elseif ( !empty($_POST['isbn']) ) {
  // A book isbn has been sent
  echo 'isbn';
}

wp_redirect(get_option('siteurl') . "/wp-admin/admin.php?page=biblio");
exit;

?>

