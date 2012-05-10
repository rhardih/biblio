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
<div>
<h2>My custom plugin</h2>
Options relating to the Custom Plugin.
<form action="options.php" method="post">
<?php settings_fields('plugin_options'); ?>
<?php do_settings_sections('plugin'); ?>

<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>

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
