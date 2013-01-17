<?php 

class Model { 

  protected $fields; 
  protected $table;
  
  protected function populate($array) {
    foreach($this->fields as $name=>$field) {
      if (!is_null($array[$name])) {
        $this->set($name, $array[$name]);
      }
    }
  }
  
  public function get($fieldName) {
    if (isset($this->fields[$fieldName])) {
      return $this->fields[$fieldName]['value']; 
    } else {
      throw new Exception("Field '$fieldName' does not exist.");
    }
  }
  
  public function set($fieldName, $value) {
    if (isset($this->fields[$fieldName])) {
      $this->fields[$fieldName]['value'] = $value; 
    } else {
      throw new Exception("Field '$fieldName' does not exist.");
    }
  }
  
  public function getFields() {
    return $this->fields;
  }
  
  public function save($db) {
    if ($this->fields['id']['value'] == 0) {
      $insert_id = $db->insert($this->table, $this);
      $this->set('id', $insert_id);
    } else {
      $db->update($this->table, $this);
    }
  }
  
}

?>
