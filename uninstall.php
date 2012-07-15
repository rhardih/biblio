<?php

global $wpdb;
$dh = new DatabaseHandler($wpdb, DB_TABLE_NAME);
$dh->destroy();

delete_option( 'biblio_db_version' );

?>
