<?php

require_once('./Common.php');

class Database {
  
  private $mysqli;
  
  public function __construct() {
    $this->mysqli = NULL; 
  }
  
  public function connect($host, $username, $password, $database) {
    $this->mysqli = new mysqli($host, $username, $password, $database);
    if ($this->mysqli->connect_errno()) {
      fatal_error('Database Error', $this->mysqli->connect_error);
    }
  }
  
  public function isConnected() {
    return !is_null($this->mysqli); 
  }
  
  public function disconnect() {
    if ($this->isConnected()) {
      $this->mysqli->close();
    }
  }
  
  public function insert($table, $fields) {
    
    if (!$this->isConnected()) {
      fatal_error('Database Error', 'Trying to call insert() on uninitialized mysqli object.');
    }
    
    $names = array();
    $values = array();
    
    foreach($fields as $f) {
      $names[] = $f['name'];
      switch($f['type']) {
        case 'string':
          $value = $f['value'];
          break;
        case 'int':
          if (is_int($f['value'])) {
            $value = int($f['value']);
          } else {
            fatal_error('Database Error', "In insert(), Field '{$field['name']}' not of type Integer.");
          }
          break;
        case 'double':
          if (is_double($f['value'])) {
            $value = float($f['value']);
          } else {
            fatal_error('Database Error', "In insert(), Field '{$field['name']}' not of type Double.");
          }
          break;
        default:
          fatal_error('Database Error', "In insert(), Field '{$field['name']}' has unknown type '{$field['type']}'.");
      }
      $values[] = $this->mysqli->real_escape_string($value);
    }
    
    $fields = '(`'.implode('`,`', $names).'`)';
    $values = '(\''.implode('\',\'', $values).'\')';

    $sql = "INSERT INTO $table $fields VALUES $values;";

    if($result = $this->con->query($sql)) {
      return $this->mysqli->insert_id;
    } else {
      fatal_error('Database Error', $sql.'<br />'.$this->con->error);
    }
    
  }

}

?>