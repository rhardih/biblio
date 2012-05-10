<?php
/**
 * Setup menu and other hooks
 */
class Menu
{
  
  public function __construct()
  {
    add_action('admin_menu', array($this, 'add_pages'));
  }

  public function add_pages()
  {
    add_menu_page(
      'Biblio - What are you reading?',
      'Biblio',
      'manage_options',
      'biblio',
      'plugin_options_page'
    );

    add_submenu_page('biblio', 'I am reading', 'Search', 'manage_options', 'biblio', 'iar_load_menu');
    add_submenu_page('biblio', 'I am reading', 'Amazon API', 'manage_options', 'biblio-amazon', 'iar_load_menu');
  }
}
?>
