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
            $action = 'update';
            $status_value = Read::Done;
            $text = 'Finish';
            include('_action_button.php');
            break;
          case Read::Done:
            $action = 'update';
            $status_value = Read::Begun;
            $text = 'Reread';
            include('_action_button.php');
            break;
          }

          $action = 'delete';
          $text = 'Delete';
          include('_action_button.php');
          ?>
          <a href="<?php echo http_build_query($_GET) ?>">Notes</a>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
