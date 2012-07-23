<?php

echo '<pre>' . print_r($_POST, true) . '</pre>';

function handle_create() {
  if (!$_POST['title']) {
    error('<b>Title</b> cannot be empty.');
  } else {
    $read = new Read(array(
      'title' => $_POST['title'],
      'author' => $_POST['author'],
      'link' => $_POST['link'],
      'illustration' => $_POST['illustration']
    ));

    if ($read->create()) {
      notice('Succesfully added <b>' . $_POST['title'] . '</b>.');
    } else {
      error('An error occured while trying to save <b>' . $_POST['title'] . '</b>.');
    }
  }
}

function handle_delete() {
  $read = new Read(intval($_POST['id']));
  if ($read->is_valid) {
    if($read->delete()) {
      notice('Deleted succesfully!');
    } else {
      error('An error occured deleting <b>' . $read['title'] . '</b> by ' . $read['author']);
    }
  } else {
    error('No Read by that id.');
  }
}

function handle_update() {
  $read = new Read(intval($_POST['id']));
  if ($read->is_valid) {
    $read['status'] = $_POST['status'];
    if ($read->update()) {
      $title_author = '<b>' . $read['title'] . '</b> by ' . $read['author'];
      notice("Status updated sucessfully for $title_author.");
    } else {
      error("An error occured updating $title_author");
    }
  }
}

if ( $_POST && check_admin_referer('read', 'biblio_nonce') )
{
  switch ($_POST['action']) {
  case 'create':
    handle_create();
    break;
  case "delete":
    handle_delete();
    break;
  case "update":
    handle_update();
    break;
  default:
    error('Unknown action.');
  }
}

?>

<div class="wrap biblio">
  <h2><?php echo get_admin_page_title(); ?></h2>
  <hr />

  <h3>New read?</h3>
  <form method="post" action="?page=biblio_main">
    <table class="form-table">
      <tbody>
        <tr valign="top">
          <th scope="row">
            <label for="book_title">Title*</label>
          </th>
          <td>
            <input id="book_title" type="text" class="regular-text" name="title" value="<?php echo $_POST["title"]; ?>">
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">
            <label for="author">Author</label>
          </th>
          <td>
            <input id="author" type="text" class="regular-text" name="author" value="<?php echo $_POST["author"]; ?>">
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">
            <label for="link">Link</label>
          </th>
          <td>
            <input id="link" type="text" class="regular-text" name="link" value="<?php echo $_POST["link"]; ?>">
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">
            <label for="illustration">Illustration</label>
          </th>
          <td>
            <input id="illustration" class="regular-text" type="text" name="illustration" />
            <br />
            <small>Enter a URL or upload an image.</small>
            <br />
            <input id="illustration_button" class="button-secondary" type="button" value="Upload" />
          </td>
        </tr>
        <tr>
          <td>
            <small>(*) Required fields</small>
          </td>
        </tr>
      </tbody>
    </table>
    <input type="hidden" name="action" value="create" />
    <?php
    wp_nonce_field('read', 'biblio_nonce');
    submit_button('Submit');
    ?>
  </form>

  <hr />

  <h3>Current readings</h3>
  <?php
  $readings = Read::all(Read::Begun);
  if(count($readings) > 0) { 
    include(TEMPLATES_DIR . 'read/_readings.php');
  } else {
    echo '<p>No current readings.</p>';
  }
  ?>

  <h3>Finished readings</h3>
  <?php
  $readings = Read::all(Read::Done);
  if(count($readings) > 0) {
    include(TEMPLATES_DIR . 'read/_readings.php');
  } else {
    echo '<p>No finished readings.</p>';
  }
  ?>

  <hr />

  <div class="attribution">
    Icons by <a href="http://glyphicons.com">glyphicons.com</a>.
  </div>
</div>

