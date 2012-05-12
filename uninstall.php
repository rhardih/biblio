<?php

global $wpdb;
$table_name = $wpdb->prefix . "biblio";
$wpdb->query("DROP TABLE IF EXISTS $table_name;");

?>
