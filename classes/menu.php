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
      'biblio_main',
      array($this, 'main_page')
    );

    add_submenu_page(
      'biblio_main',
      'Biblio - Test',
      'Test',
      'manage_options',
      'biblio_test',
      array($this, 'test_page')
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
    load_template(TEMPLATES_DIR . "test.php");
  }

  public function test_page() {
    load_template(TEST_DIR . "database_handler_test.php");
  }

  public function notes_page() {
    load_template(TEMPLATES_DIR . "notes.php");
  }
}
?>
