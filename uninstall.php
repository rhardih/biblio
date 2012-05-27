<?php

global $wpdb;
$table_name = $wpdb->prefix . "biblio";
$wpdb->query("DROP TABLE IF EXISTS $table_name;");

delete_option( 'biblio_db_version' );

?>
