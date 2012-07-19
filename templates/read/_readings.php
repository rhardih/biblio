<div class="readings_wrapper">
  <div id="readings" class="group">
    <?php foreach ( $readings as $reading ) { ?>
    <div class="reading_wrapper">
      <div class="reading">
        <div class="title_author_wrapper">
          <h4 class="title"><?php echo $reading['title']; ?></h4>
          <p class="author"><?php echo $reading['author']; ?></p>
        </div>
        <div class="illustration">
          <?php if($reading['url']) { ?>
          <img src="<?php echo $reading['url'] ?>" alt="Book" />
          <?php } else { ?>
          <div class="placeholder">
            <img src="<?php echo BIBLIO_PLUGIN_URL . 'images/glyphicons_351_book_open.png' ?>" alt="Book" class="placeholder" />
          </div>
          <?php } ?>
        </div>
        <div class="actions">
          <?php
          switch ($reading['status']) {
          case Read::Begun:
            $status_value = Read::Done;
            $text = 'Finish';
            include('_action_button.php');
            break;
          case Read::Done:
            $status_value = Read::Begun;
            $text = 'Reread';
            include('_action_button.php');
            break;
          }
          ?>
          <form action="?page=biblio_main" method="post">
            <input type="hidden" name="action" value="delete" />
            <a class="delete" href="" data-title="<?php echo $reading['title']; ?>" data-author="<?php echo $reading['author']; ?>">
              Delete
            </a>
            <input type="hidden" name="id" value="<?php echo $reading['id']; ?>" />
            <?php wp_nonce_field('read', 'biblio_nonce'); ?>
          </form>
          <a href="<?php echo http_build_query($_GET) ?>">Notes</a>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
