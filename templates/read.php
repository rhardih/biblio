<?php

echo '<pre>' . print_r($_POST, true) . '</pre>';

function handle_create() {
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

function handle_delete() {
  $read = new Read(intval($_POST['id']));
  if($read->delete()) {
    notice('Deleted succesfully!');
  } else {
    error('An error occured deleting <b>' . $read['title'] . '</b> by ' . $read['author']);
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
  default:
    error('Unknown action.');
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
            <label for="url">URL</label>
          </th>
          <td>
            <input id="url" type="text" class="regular-text" name="url" value="<?php echo $_POST["url"]; ?>">
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

  <?php $active_readings = Read::all(Read::Active); ?>

  <h3>Current readings</h3>
  <div class="readings_wrapper">
    <div id="readings" class="group">
      <?php foreach ( $active_readings as $reading ) { ?>
      <div class="reading_wrapper">
        <div class="reading">
          <div class="title_author_wrapper">
            <h4 class="title"><?php echo $reading->title; ?></h4>
            <p class="author"><?php echo $reading->author; ?></p>
          </div>
          <div class="illustration">
            <?php if($reading->url) { ?>
            <img src="<?php echo $reading->url ?>" alt="Book" />
            <?php } else { ?>
            <div class="placeholder">
              <img src="<?php echo BIBLIO_PLUGIN_URL . 'images/glyphicons_351_book_open.png' ?>" alt="Book" class="placeholder" />
            </div>
            <?php } ?>
          </div>
          <div class="actions">
            <a href="<?php echo http_build_query($_GET) ?>">Finish</a>
            <a href="<?php echo http_build_query($_GET) ?>">Pause</a>
            <a href="<?php echo http_build_query($_GET) ?>">Notes</a>
            <form action="?page=biblio_main" method="post">
              <input type="hidden" name="action" value="delete" />
              <a class="delete" href="" data-title="<?php echo $reading->title; ?>" data-author="<?php echo $reading->author; ?>">
                Delete
              </a>
              <input type="hidden" name="id" value="<?php echo $reading->id ?>" />
              <?php wp_nonce_field('read', 'biblio_nonce'); ?>
            </form>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <h3>Past readings</h3>
</div>

