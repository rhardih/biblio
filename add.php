<?php

require '../../../wp-config.php';

$siteurl = get_option('siteurl');

error_log(print_r($_POST, true));

if ( !empty($_POST) && check_admin_referer('biblio-add','name_of_nonce_field') )
{
  $dh->create_reading(
    $_POST['book_title'],
    $_POST['author'],
    $_POST['url']
  );
  wp_redirect($siteurl . "/wp-admin/admin.php?page=biblio_main");
  exit;
}
?>

