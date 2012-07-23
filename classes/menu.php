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
      'Biblio - Your reading',
      'Biblio',
      'manage_options',
      'biblio_main',
      array($this, 'main_page')
    );

    add_submenu_page(
      'biblio_main',
      'Biblio - Notes',
      'Notes',
      'manage_options',
      'biblio_notes',
      array($this, 'notes_page')
    );
  }

  public function main_page() {
    load_template(TEMPLATES_DIR . 'read.php');
  }

  public function notes_page() {
    load_template(TEMPLATES_DIR . 'notes.php');
  }
}
?>
