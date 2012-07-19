<?php

class Read extends DatabaseResource
{

  const Active   = 0;
  const Inactive = 1;
  const Done     = 2;

  function __construct($arg) {
    if (is_int($arg)) { // id
      parent::__construct($arg);
    } elseif (is_array($arg)) {
      foreach ($arg as $attribute => $value) {
        $this[$attribute] = $value;
      }
      parent::__construct();
    }
  }

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
