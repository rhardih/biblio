<?php
global $dh;
?>

<h3>Current readings</h3>

<div id="readings" class="group">
  <?php foreach ( $dh->current_readings() as $reading ) { ?>
  <div class="reading">
    <?php //echo var_dump($reading); ?>
    <h4 class="title"><?php echo $reading->name ?></h4>
    <div class="illustration">
      <?php if($reading->url) { ?>
      <img src="<?php echo $reading->url ?>" alt="Book" />
      <?php } else { ?>
      <div class="placeholder">
        <img src="<?php echo BIBLIO_PLUGIN_URL . 'images/glyphicons_351_book_open.png' ?>" alt="Book" class="placeholder" />
      </div>
      <?php } ?>
    </div>
    <p>
    <?php
      $_GET['read'] = $reading->id;
      $_GET['action'] = 'show';
    ?>
    <a href="?<?php echo http_build_query($_GET) ?>">Notes</a>
    </p>
  </div>
  <?php } ?>
</div>

<h3>Past readings</h3>
