<?php

require_once('include/Common.php');

class Database {
  
  private $mysqli;
  
  private $fieldCount;
  private $numRows;
  
  public function __construct() {
    $this->mysqli = NULL; 
  }
  
  public function connect($host, $username, $password, $database) {
    $this->mysqli = new mysqli($host, $username, $password, $database);
    if ($this->mysqli->connect_errno) {
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

    $sql = "INSERT INTO $table $fields VALUES $values ;";

    if($result = $this->con->query($sql)) {
      return $this->mysqli->insert_id;
    } else {
      fatal_error('Database Error', $sql.'<br />'.$this->con->error);
    }
    
  }
  
  private function flatten($filters) {
    $clauses = array();
    foreach($filters as $filter) {
      $name = $f['name'];
      $operator = $f['operator']; 
      $value = $this->con->real_escape_string($f['value']);
      $clauses[] = "`$name` $operator '$value'";
    }
    if (count(clauses) > 1) {
      return implode(' AND ', $clauses);
    } else if (count(clauses) == 1) {
      return $clauses[0];
    } else {
      fatal_error('Database Error', 'SELECT without WHERE clause.');
    }
  }
  
  public function select($table, $fields, $filters, $limit=NULL) {
    
    $count = ($fields == 'count' || $fields == 'COUNT(*)');
        
    if ($fields !== '*') {
      $fields = '(`'.implode('`,`', $names).'`)';
    }
    
    $clauses = 'FALSE'; // returns nothing
    if (is_array($filters)) {
      $clauses = $this->flatten($filters);
    } else if ($filters == 1) {
      $clauses = '1';
    } else {
      fatal_error('Database Error', 'In select(), filters must be an array or 1');
    }

    if ($count) {
      $fields = 'COUNT(*) as `count`';
    }

    $sql = "SELECT $fields FROM $table WHERE $filters ";

    if (!is_null($limit)) {
      if (count($limit) != 2) {
        fatal_error('Database Error', 'In select(), limit must be 1x2 array');
      }
      $sql .= "LIMIT {$limit[0]}, {$limit[1]} ";
    }

    if ($result = $this->mysqli->query($sql)) {
      if ($count) {
        $row = $result->fetch_assoc();
        return $row['count'];
      }
      $this->numRows = $this->mysqli->num_rows;
      $this->fieldCount = $this->mysqli->field_count;
      if ($this->numRows == 0) {
        return array();
      }
      $array = array();
      while ($row = $result->fetch_assoc()) {
        $array[] = $row;
      }
      $result->close(); // free result set
      return $array;
    }
  }

  public function getFieldCount() {
    return $this->fieldCount;
  }
  
  public function getRowCount() {
    return $this->numRows();
  }

}

?>