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

add_action( 'admin_menu', 'biblio_setup' );

function biblio_setup() {
  $biblio = new Biblio();
}

class Biblio {

  function __construct() {
    add_menu_page( 'Biblio - What have you read?', 'Biblio', 'manage_options', 'bilio-iden', array($this, 'plugin_options'));
  }

  public function plugin_options()
  {
    if ( !current_user_can( 'manage_options' ) )  {
      wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    echo '<div class="wrap">';
    echo '<p>Here is where the form would go if I actually had options.</p>';
    echo '</div>';
  }

}
?>
