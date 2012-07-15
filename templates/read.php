<pre>
  <?php print_r($_POST); ?>
</pre>

<div class="wrap">
  <h2>Biblio</h2>
  <h3>What are you reading?</h3>
  <form method="post" action="<?php echo BIBLIO_PLUGIN_URL . 'add.php' ?>">
    <!--<form method="post" action="<?php echo get_option('siteurl') ?>/wp-admin/admin.php?page=biblio">-->
      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row">
              <label for="book_title">Book title</label>
            </th>
            <td>
              <input id="book_title" type="text" class="regular-text" name="book_title">
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
      </tbody>
    </table>
<?php
wp_nonce_field('biblio-add','name_of_nonce_field');
submit_button("Search");
?>
  </form>
</div>
