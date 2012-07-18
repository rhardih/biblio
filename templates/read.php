<?php

if ( $_POST && check_admin_referer('add-read', 'add_wpnonce') )
{
  if (!$_POST['title']) {
    error('<b>Title</b> cannot be empty.');
  } else {
    $read = new Read(array(
      'title' => $_POST['title'],
      'author' => $_POST['author'],
      'url' => $_POST['url']
    ));

    if ($read->create()) {
      notice('Succesfully added <b>' . $_POST['title'] . '</b>.');
    } else {
      error('An error occured while trying to save <b>' . $_POST['title'] . '</b>.');
    }
  }
}

?>

<div class="wrap">
  <h2>Biblio</h2>

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
            <input id="book_title" type="text" class="regular-text" name="title">
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">
            <label for="author">Author</label>
          </th>
          <td>
            <input id="author" type="text" class="regular-text" name="author">
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">
            <label for="url">URL</label>
          </th>
          <td>
            <input id="url" type="text" class="regular-text" name="url">
          </td>
        </tr>
        <tr>
          <td>
            <small>(*) Required fields</small>
          </td>
        </tr>
      </tbody>
    </table>
<?php
wp_nonce_field('add-read', 'add_wpnonce');
submit_button('Submit');
?>
  </form>
</div>
