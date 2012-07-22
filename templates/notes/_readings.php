<table class="widefat">
  <thead>
    <tr>
      <th>Title</th>
      <th class="author">Author</th>       
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Title</th>
      <th class="author">Author</th>       
    </tr>
  </tfoot>
  <tbody>
  <?php
  foreach ( $readings as $read ) {
  ?>
    <tr>
      <?php $_GET['action'] = 'show'; ?>
      <?php $_GET['read_id'] = $read['id']; ?>
      <td><a href="<?php echo biblio_url($_GET); ?>"><?php echo $read['title']; ?></a></td>
      <td><?php echo $read['author']; ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
