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

global $biblio_db_version;
$biblio_db_version = "1.0";

function biblio_install() {
  global $wpdb;
  global $biblio_db_version;

  $table_name = $wpdb->prefix . "biblio";

  $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    name tinytext NOT NULL DEFAULT '',
    text text NOT NULL DEFAULT '',
    url VARCHAR(255) DEFAULT '',
    UNIQUE KEY id (id)
  );";
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);

  add_option("biblio_db_version", $biblio_db_version);
}

register_activation_hook(__FILE__,'biblio_install');

define('BIBLIO_PLUGIN_URL', WP_PLUGIN_URL.'/biblio/');

include('classes/class.biblio.php');
include('classes/menu_setup.php');

$biblio = new Biblio();
$ms = new Menu();

add_action('admin_menu', 'plugin_admin_add_page');

function plugin_admin_add_page() {
  add_options_page('Custom Plugin Page', 'Custom Plugin Menu', 'manage_options', 'plugin', 'plugin_options_page');
}


//if ( is_admin() ){ // admin actions
//  add_action( 'admin_menu', 'biblio_setup' );
//  add_action( 'admin_init', 'register_mysettings' );
//} else {
//  // non-admin enqueues, actions, and filters
//}

function plugin_options_page() {
?>


<pre>
  <?php print_r($_POST); ?>
</pre>

<div class="wrap">
  <h2>Biblio</h2>
  <h3>What are you reading?</h3>
  <h3>Read material</h3>

  <form action="options.php" method="post">
    <?php do_settings_sections('plugin'); ?>
    <?php settings_fields('plugin_options'); ?>
    <p><input type="text" name="search" placeholder="URL" /></p>
    <?php submit_button("Search"); ?>
  </form>
</div>
<?php
}

add_action('admin_init', 'plugin_admin_init');

function plugin_admin_init(){
  register_setting( 'plugin_options', 'plugin_options', 'plugin_options_validate' );
  add_settings_section('plugin_main', 'Main Settings', 'plugin_section_text', 'plugin');
  add_settings_field('plugin_text_string', 'Plugin Text Input', 'plugin_setting_string', 'plugin', 'plugin_main');
}

function plugin_section_text() {
  echo '<p>Main description of this section here.</p>';
}

function plugin_setting_string() {
  $options = get_option('plugin_options');
  echo "<input id='plugin_text_string' name='plugin_options[text_string]' size='40' type='text' value='{$options['text_string']}' />";
}

function plugin_options_validate($input) {
  $newinput['text_string'] = trim($input['text_string']);
  if(!preg_match('/^[a-z0-9]{32}$/i', $newinput['text_string'])) {
    $newinput['text_string'] = '';
  }
  return $newinput;
}
