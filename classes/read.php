<?php

class Read extends DatabaseResource
{

  const Begun = 0;
  const Done  = 1;

  function __construct($arg) {
    if (is_int($arg)) { // id
      parent::__construct($arg);
    } elseif (is_object($arg) || is_array($arg)) {
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

    $sql = sprintf("SELECT * FROM %s WHERE status = %d;",
      DB_TABLE_NAME,
      $status
    );

    $results = $wpdb->get_results($sql);
    $reads = array();

    foreach($results as $read) {
      $reads[] = new Read($read);
    }
    //error_log(print_r($reads, true));

    return $reads;
  }
}

?>
