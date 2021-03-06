<?php
/*
 * Plugin Name: biblio
 * Plugin URI: https://github.com/rhardih/biblio
 * Description: Simple plugin to showcase your personal reading interests, library etc.
 * Version: 0.1
 * Author: René Hansen
 * Author URI: http://éncoder.dk/blog
 * License: GPL2
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

// Utility methods
function error($message) {
  echo "<div class=\"error\"><p>$message</p></div>";
}

function notice($message) {
  echo "<div class=\"updated\"><p>$message</p></div>";
}

function biblio_url($params) {
  return admin_url('admin.php?') . http_build_query($params);
}

// Add custom css for admin pages
function biblio_styles() {
  wp_enqueue_style('thickbox');
  wp_enqueue_style('biblio-styles', BIBLIO_PLUGIN_URL . '/styles.css');
}
add_action('admin_print_styles', 'biblio_styles');

// Add custom javascript for admin pages
function biblio_scripts() {
  wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
  wp_register_script(
    'biblio-scripts',
    BIBLIO_PLUGIN_URL . '/scripts.js',
    array('jquery', 'media-upload', 'thickbox')
  );
  wp_enqueue_script('biblio-scripts');
}
add_action('admin_print_scripts', 'biblio_scripts');

// Add widget
add_action( 'widgets_init', 'init_biblio_widget' );
function init_biblio_widget() {
	register_widget( 'BiblioWidget' );
}

// Add custom css for widget
function widget_styles() {
  wp_enqueue_style( 'widget-styles', BIBLIO_PLUGIN_URL . '/widget.css' );
}
add_action( 'wp_enqueue_scripts', 'widget_styles' );
