<?php

class Read extends DatabaseResource
{
    //public function __construct($id)
    //{
    //  parent::__construct($id);
    //}

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
