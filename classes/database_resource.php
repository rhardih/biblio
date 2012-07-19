<?php

class DatabaseResource extends ArrayObject {

  var $id;

  var $is_valid = false;

  var $wpdb;

  function __construct($id = null) {
    global $wpdb;
    $this->wpdb = $wpdb;

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

  public function update($params = null) {
    $values = $params ? $params : (array) $this;

    return $this->wpdb->update(
      DB_TABLE_NAME,
      $values,
      array( 'id' => $this->id)
    );
  }

  public function delete() {
    $prepared_query = $this->wpdb->prepare(
      'DELETE FROM ' . DB_TABLE_NAME . ' WHERE id = %d;',
      $this->id
    );
    return $this->wpdb->query($prepared_query);
  }

}

?>
