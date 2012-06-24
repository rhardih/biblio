<?php

//include(


global $wpdb;
$dh = new DatabaseHandler($wpdb, DB_TABLE_NAME);

?>

<pre>
<?php $dh->current_readings(); ?>
</pre>

<div class="wrap">
  <h2>Biblio</h2>
  <h3>Current readings</h3>

  <!-- Display a grid of currently started readings -->
</div>
