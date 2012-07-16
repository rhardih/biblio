<?php

class Read extends DatabaseResource
{

  const Active   = 0;
  const Inactive = 1;
  const Done     = 2;

  // Public: returns all readings of certain status
  //
  // $status - one of (Read::Active, Read::Inactive, Read::Done)
  //
  // Returns void.
  public static function all($status) {

    global $wpdb;

    $sql = sprintf("SELECT * FROM %s WHERE status = %s;",
      DB_TABLE_NAME,
      $status
    );

    $reads = $wpdb->get_results($sql);
    foreach($reads as $read) {
      $reads[] = new Read($read);
    }
    return $reads;
  }
}

?>
