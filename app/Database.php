<?php

class Database {

  private $mysqli;

  public function __construct() {
    $this->mysqli = NULL; 
  }
  
  public function connect($host, $username, $password, $database) {
    $this->mysqli = new mysqli($host, $username, $password, $database);
    if ($this->mysqli->connect_errno) {
      throw new Exception($this->mysqli->connect_error);
    }
  }
  
  public function disconnect() {
    if (!is_null($this->mysqli)) {
      $this->mysqli->close();
    }
  }
  
  private function sanitizeString($value) {
    return $this->mysqli->real_escape_string(trim($value));
  }
  
  public function exists($table, $field, $value) {
    $value = ($field == 'id') ? intval($value) : $this->sanitizeString($value);
    $sql = "SELECT COUNT(*) AS count FROM $table WHERE `$field`='$value'";
    if ($result = $this->mysqli->query($sql)) {
      $row = $result->fetch_assoc();
      return intval($row['count']) > 0;
    }
    return false;
  }
  
  public function insert($table, $object) {
    $fields = $object->getFields();
    $names = array();
    $values = array();
    foreach ($fields as $name=>$arr) {
      if ($arr['type'] != 'virtual') {
        $names[] = $name;
        $values[] = ($arr['type'] == 'int') ? 
          intval($arr['value']) : $this->sanitizeString($arr['value']);
      }
    }
    $fields = '(`'.implode('`,`', $names).'`)';
    $values = '(\''.implode('\',\'', $values).'\')';
    $sql = "INSERT INTO $table $fields VALUES $values;";
    if ($result = $this->mysqli->query($sql)) {
      return $this->mysqli->insert_id;
    } else {
      throw new Exception("Failed to execute query <pre>$sql</pre>");
    }
  }
  
  public function update($table, $object) {$fields = $object->getFields();
    $id = $object->get('id');
    if ($this->exists($table, 'id', $id)) {
      $set = array();
      foreach ($fields as $name=>$field) {
        if ($field['type'] != 'virtual') {
        $set[] = sprintf("`%s`='%s'", (string)$name, (string)$field['value']);
        }
      }
      $set = implode(',', $set);
      $sql = "UPDATE $table SET $set WHERE `id`='$id' LIMIT 1;";
      if ($result = $this->mysqli->query($sql)) {
        return $this->mysqli->affected_rows > 0;
      } else {
        throw new Exception("Failed to execute query <pre>$sql</pre>");
      }
    } else {
      throw new Exception('Cannot update nonexistant database entry.');
    }
    return false; 
  }
  
  /**
   * Get user from database 
   *
   * @param string $field 
   * @param string $value 
   * @return User or NULL if user does not exist
   * @author Chi Feng
   */
  public function getUser($field, $value, $options = NULL) {
    switch ($field) {
      case 'id':
        $value = intval($value);
      case 'username':
        $value = $this->sanitizeString($value);
        break;
      case 'email':
        $value = $this->sanitizeString($value);
        break;
      default:
        throw new Exception("Invalid field '$field'.");
        break;
    }
    $sql = "SELECT users.*, locations.city as location FROM users 
            LEFT JOIN locations ON users.location_id=locations.zip 
            WHERE users.`$field`='$value' ORDER BY users.id LIMIT 1";
    if ($result = $this->mysqli->query($sql)) {
      $arr = $result->fetch_assoc();
      $result->close(); 
      return new User($arr, $this);
    } else {
      throw new Exception("Failed to execute query <pre>$sql</pre>");
    }
    return NULL;
  }
  
  /**
   * Queries the database to find partial matches to a City, State for
   * location autocomplete 
   *
   * @param string $value 
   * @return string json representation of locations 
   * @author Chi Feng
   */
  public function getLocationJSON($value) {
    $value = $this->sanitizeString($value);
    $sql = "SELECT city as location 
            FROM locations WHERE city LIKE '$value%' 
            ORDER BY population DESC LIMIT 5";
    $suggestions = array();
    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['location'];
      }
      $result->close(); 
    }
    return json_encode($suggestions);
  }

}

?>