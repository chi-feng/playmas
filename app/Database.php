<?php

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

    $sanitized = $this->sanitizeFields($fields, array('split'=>'true'));

    $names = $sanitized['names'];
    $values = $sanitized['values'];
    
    $fields = '(`'.implode('`,`', $names).'`)';
    $values = '(\''.implode('\',\'', $values).'\')';

    $sql = "INSERT INTO $table $fields VALUES $values ;";

    if($result = $this->mysqli->query($sql)) {
      return $this->mysqli->insert_id;
    } else {
      fatal_error('Database Error', '<code>'.$sql.'</code><br />'.$this->mysqli->error);
    }
    
  }
  
  private function sanitizeFields($fields, $options=array()) {
        
    $names = array();
    $values = array();
    $sanitized = array();
    
    foreach($fields as $name=>$f) {
      $names[] = $name;
      switch($f['type']) {
        case 'string':
          $value = $f['value'];
          break;
        case 'int':
          if (is_numeric($f['value'])) {
            $value = intval($f['value']);
          } else {
            fatal_error('Database Error', "In sanitizeFields(), Field '{$name}' not of type Integer.");
          }
          break;
        case 'double':
          if (is_numeric($f['value'])) {
            $value = floatval($f['value']);
          } else {
            fatal_error('Database Error', "In sanitizeFields(), Field '{$name}' not of type Double.");
          }
          break;
        default:
          fatal_error('Database Error', "In sanitizeFields(), Field '{$name}' has unknown type '{$f['type']}'.");
      }
      $escaped = $this->mysqli->real_escape_string($value);
      $values[] = $escaped;
      $sanitized[$f['name']] = $escaped;
    }
    
    if (isset($options['split'])) {
      return array('names' => $names, 'values' => $values);
    } else {
      return $sanitized;
    }

  }
  
  public function update($table, $fields, $id) {
    
    if (!$this->isConnected()) {
      fatal_error('Database Error', 'Trying to call update() on uninitialized mysqli object.');
    }

    // TODO: check that $fields are valid $fields
    // TODO: check that $id is valid $id

    $sanitized = $this->sanitizeFields($fields);

    $setList = array();

    foreach ($sanitized as $name => $value) {
      $setList[] = sprintf("`%s`='%s'", $name, $value);
    }
    
    if (count($setList) > 1) {
      $setList = implode(',', $setList);
    }
    
    $sql = "UPDATE $table SET $setList WHERE `id`='$id' LIMIT 1;";

    if($result = $this->mysqli->query($sql)) {
      return $this->mysqli->insert_id;
    } else {
      fatal_error('Database Error', '<code>'.$sql.'</code><br />'.$this->mysqli->error);
    }
    
    return $this->mysqli->affected_rows;
    
  }
  
  private function flatten($filters) {
    $clauses = array();
    foreach($filters as $f) {
      $name = $f[0];
      $operator = $f[1]; 
      $value = $this->mysqli->real_escape_string($f[2]);
      $clauses[] = "`$name` $operator '$value'";
    }
    if (count(clauses) > 1) {
      return implode(' OR ', $clauses);
    } else if (count(clauses) == 1) {
      return $clauses[0];
    } else {
      fatal_error('Database Error', 'SELECT without WHERE clause.');
    }
  }
  
  public function select($table, $fields, $filters, $limit=NULL) {
    
    if (!$this->isConnected()) {
      fatal_error('Database Error', 'Trying to call select() on uninitialized mysqli object.');
    }
    
    $count = ($fields == 'count' || $fields == 'COUNT(*)');
        
    if (is_array($fields)) {
      $fields = '(`'.implode('`,`', $fields).'`)';
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

    $sql = "SELECT $fields FROM $table WHERE $clauses ";

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
      $this->numRows = $result->num_rows;
      $this->fieldCount = $result->field_count;
      if ($this->numRows == 0) {
        return NULL;
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
    return $this->numRows;
  }

}

?>