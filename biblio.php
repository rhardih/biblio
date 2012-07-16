<?php
/*
 * Plugin Name: biblio
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Simple plugin to showcase your personal reading interesests, library etc.
 * Version: 0.1
 * Author: René Hansen
 * Author URI: http://éncoder.dk
 * License: A "Slug" license name e.g. GPL2
 *
 * Copyright 2012  René Hansen  (email : biblio@éncoder.dk)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

global $wpdb;

define('BIBLIO_PLUGIN_URL', plugin_dir_url(__FILE__));
define('BASE_DIR', dirname(__FILE__).'/');
define('TEMPLATES_DIR', BASE_DIR .'templates/');
define('CLASS_DIR', BASE_DIR .'classes/');
define('INTERFACE_DIR', BASE_DIR .'interfaces/');
define('TEST_DIR', BASE_DIR .'test/');
define('PLUGIN_NAME', 'biblio');
define('DB_VERSION_OPTION', PLUGIN_NAME . '_db_version');
define('DB_TABLE_NAME', $wpdb->prefix . PLUGIN_NAME);

foreach (glob(BASE_DIR . "classes/*.php") as $filename) { include $filename; }

global $dh;
$dh = new DatabaseHandler($wpdb, DB_TABLE_NAME);

function var_to_str($in)
{
   if(is_bool($in))
   {
      if($in)
         return "true";
      else
         return "false";
   }
   else
      return $in;
}

function biblio_activate() {
  global $dh;

  $db_version = get_option(DB_VERSION_OPTION);
  if (is_bool($db_version)) { // Fresh install, value false
    add_option(DB_VERSION_OPTION, 0);
    $dh->create();
    error_log($dh->version());
    $dh->migrate(0, $dh->version());
  } else { // Update or reactivation
    error_log($dh->version());
    error_log($db_version);
    $dh->migrate(intval($db_version), $dh->version());
  }
}


function biblio_deactivate() {
  global $dh;
  delete_option("biblio_db_version");
  $dh->destroy();
}

register_activation_hook(__FILE__, 'biblio_activate');
register_deactivation_hook(__FILE__, 'biblio_deactivate');


function check_install() {
  $biblio_db_version = get_option('biblio_db_version');
  if (!empty($biblio_db_version)) {
    echo "<h1>$biblio_db_version</h1>";
  } else {
    echo "<h1>Empty</h1>";
  }
}

//check_install();


new Menu();

// Add custom css
function add_custom_css() {
    $url = BIBLIO_PLUGIN_URL . '/styles.css';
    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}
add_action('admin_head', 'add_custom_css');

// Utility methods
function error($message) {
  echo "<div class=\"error\"><p>$message</p></div>";
}

function notice($message) {
  echo "<div class=\"updated\"><p>$message</p></div>";
}



