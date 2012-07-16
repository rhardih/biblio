<?php

class DatabaseResource extends ArrayObject {

  var $name;
  var $id;

  var $is_valid = false;

  var $wpdb;

  function __construct($id = null) {
    global $wpdb;
    $this->wpdb = $wpdb;

    $this->name = $name;
    if ($id) {
      $this->id = $id;
      $this->read();
    }
  }

  public function create() {
    return $this->wpdb->insert(DB_TABLE_NAME, (array)$this);
  }

  public function read() {
    $sql = sprintf(
      "SELECT * FROM %s WHERE id = %s;",
      DB_TABLE_NAME,
      $this->id
    );
    $read = $this->wpdb->get_row($sql);

    error_log("SQL: $sql");
    error_log(print_r($read, true));

    if($read != null) {
      foreach ($read as $attribute => $value) {
        $this[$attribute] = $value;
      }
      $this->is_valid = true;
    }
  }

  public function update($params) {
    $tmp = array();
    array_walk(
      $params,
      create_function(
        '$val,$key,$result',
        '$result[]="$key = \'$val\'";'
      ),
      &$tmp
    );

    $sql = sprintf(
      "UPDATE %s SET %s WHERE id = %s;",
      DB_TABLE_NAME,
      join(', ', $tmp),
      $this->id
    );
    error_log($sql);

    return $res = $this->wpdb->update(
      DB_TABLE_NAME,
      $params,
      array('id' => $this->id)
    );
  }

  public function delete() {
    $this->sql = sprintf(
      "DELETE FROM %s WHERE id = %s;",
      "whatever",
      $this->id
    );
  }

}

?>
