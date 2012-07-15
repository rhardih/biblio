<?php

// Public: handles database interactions
class DatabaseHandler
{

  var $db;
  var $table;
  var $migrations;

  function __construct($database, $table)
  {
    $this->db = $database;
    $this->table = $table;
    $this-> migrations = array(
      "ALTER TABLE $this->table ADD email VARCHAR(60);",
      "ALTER TABLE $this->table ADD phone VARCHAR(60);",
      "ALTER TABLE $this->table ADD area_code VARCHAR(60);"
    );
  }

  // Public: migrates the plugin table from one version to another.
  //
  // $from
  // $to
  //
  // Returns void.
  public function migrate($from, $to) {
    for ($i = $from; $i < $to; $i++) {
      error_log("Running migration #$i: " . $this->migrations[$i]);
      if(!$this->db->query($this->migrations[$i])) {
        error_log("Query failed: " . $this->migrations[$i]);
      }
      update_option(DB_VERSION_OPTION, $i + 1);
    }
  }

  // Public: creates initial version the plugin table.
  //
  // Returns void.
  public function create() {
    $sql = "CREATE TABLE $this->table (
      id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
      created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      name TINYTEXT NOT NULL DEFAULT '',
      text TEXT NOT NULL DEFAULT '',
      url VARCHAR(255) DEFAULT '',
      UNIQUE KEY id (id)
    ) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;";

    return $this->db->query($sql);
  }

  // Public: creates a new reading in the books table
  public function create_reading($title, $author, $url) {
    $data = array(
      'name' => $title,
      'text' => $author,
      'url' => $url
    );
    return $this->db->insert($this->table, $data);
  }

  public function destroy() {
    $this->db->query("DROP TABLE IF EXISTS $this->table;");
  }

  // Public: provides the latest database version.
  //
  // Returns int.
  public function version() {
    return count($this->migrations);
  }

  // Public: returns the books that are currently being read
  public function current_readings() {
    $sql = "SELECT * FROM $this->table;";
    return $this->db->get_results($sql);
  }

}
?>