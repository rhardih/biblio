<div class="readings_wrapper">
  <div id="readings" class="group">
    <?php foreach ( $readings as $read ) { ?>
    <div class="reading_wrapper">
      <div class="reading">
        <div class="title_author_wrapper">
          <h4 class="title"><?php echo $read['title']; ?></h4>
          <p class="author"><?php echo $read['author']; ?></p>
        </div>
        <div class="illustration">
          <?php if($read['illustration']) { ?>
          <img src="<?php echo $read['illustration'] ?>" alt="Book" />
          <?php } else { ?>
          <div class="placeholder">
            <img src="<?php echo BIBLIO_PLUGIN_URL . 'images/glyphicons_351_book_open.png' ?>" alt="Book" class="placeholder" />
          </div>
          <?php } ?>
        </div>
        <div class="actions">
          <?php
          switch ($read['status']) {
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

          <?php $_GET['page'] = 'biblio_notes'; ?>
          <?php $_GET['action'] = 'show'; ?>
          <?php $_GET['read_id'] = $read['id']; ?>
          <a href="<?php echo biblio_url($_GET); ?>">Notes</a>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
