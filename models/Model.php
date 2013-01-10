<?php 

class Model { 

  protected $fields; 
  protected $table;
  
  public function __construct($array, $option = '') {
    fatal_error('Model::_construct()', 'Model is abstract class, cannot instantiate.');
  }
  
  protected function populate($array, $option) {
    if ($option == 'new') {
      $this->populateFields($array);
    } else {
      if (count($array) != 2) {
        fatal_error('Model::populate()', 'Wrong number of arguments in WHERE clause.');
      }
      $array = $this->getArrayFromDatabase($array[0], $array[1]);
      $this->populateFields($array);
    }
  }
  
  protected function populateFields($array) {
    foreach($this->fields as $name=>$field) {
      $this->set($name, $array[$name]);
    }
  }
  
  public function get($fieldName) {
    if (isset($this->fields[$fieldName])) {
      return $this->fields[$fieldName]['value']; 
    } else {
      fatal_error('Model::get()', "Tried to get nonexistent field '$fieldName'");
    }
  }
  
  public function set($fieldName, $value) {
    if (isset($this->fields[$fieldName])) {
      $this->fields[$fieldName]['value'] = $value; 
    } else {
      fatal_error('Model::set()', "Tried to set nonexistent field '$fieldName'");
    }
  }
  
  protected function getArrayFromDatabase($field, $value) {
    // check that the field is a unique field
    if (isset($this->fields[$field]['unique'])) {
      // validate and sanitize value according to field type
      $sanitized = validate($value, $this->fields[$field]['type']);
      if ($sanitized['valid']) {
        // select user from database 
        global $db;    
        $array = $db->select($this->table, '*', array(array($field,'=',$value)));
        // if we didn't get an array back, return empty array
        if (!is_array($array)) {
          $array = array(); 
        } else {
          // otherwise return result from database query
          return $array[0];
        }
      } else {
        fatal_error('Model::getArrayFromDatabase()', "Bad values for $field=$value");
      }
    } else {
      fatal_error('Model::getArrayFromDatabase', "Trying to select from database using invalid field '$field'");
    }
  }
  
  public function save() {
    // if id = 0, we insert, otherwise, we update 
    global $db;
    if ($this->fields['id']['value'] == 0 ||
        $this->fields['id']['value'] == NULL) {
      // NULL is not integer and Database::insert() will give error
      $this->fields['id']['value'] = 0; 
      $id = $db->insert('users', $this->fields); 
      $this->fields['id']['value'] == $id;
      return $id;
    } else {
      $affected = $db->update($this->table, $this->fields, $this->fields['id']['value']);
      if ($affected < 1) {
        // TODO: this shouldn't actually be fatal
        fatal_error('Model::save()', 'Database::update() resulted in zero affected rows.');
      }
    }
  }
}

?>
