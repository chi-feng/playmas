<?php 

/**
 * Model object to manipulate objects read from the database. 
 *
 * @package default
 * @author Chi Feng
 */
class Model { 

  /**
   * Local storage of field metadata and values
   *
   * @var array
   */
  protected $fields; 
  
  /**
   * Name of corresponding database table
   *
   * @var string
   */
  protected $table;
  
  /**
   * undocumented variable
   *
   * @var Database Initialized Database object
   */
  protected $db;
  
  /**
   * Default constructor allows creation of new object, or from database entry
   *
   * @param array $array Associative array of fields 
   * @var Database Initialized Database object
   * @param string $options 
   * @author Chi Feng
   */
  public function __construct($array, $db, $options=array()) {
    fatal_error('Model::_construct()', 'Model is abstract class, cannot instantiate.');
  }
  
  /**
   * Check the existence of a field
   *
   * @param string $field 
   * @return bool
   * @author Chi Feng
   */
  public function isField($field) {
    return isset($this->fields[$field]) ;
  }

  /**
   * Check if a field is a unique field
   *
   * @param string $field 
   * @return bool
   * @author Chi Feng
   */
  public function isUniqueField($field) {
    return isset($this->fields[$field]) && isset($this->fields[$field]['unique']);
  }
  
  /**
   * Populates the local $fields variable with values from $array or $database
   * depending on the value of $options. 
   *
   * @param array $array Associative array of field values
   * @param string $options 
   * @return void
   * @author Chi Feng
   */
  protected function populate($array, $options) {
    if ($options === 'new' || isset($options['new'])) {
      $this->populateFields($array);
    } else {
      if (count($array) != 2) {
        fatal_error('Model::populate()', 'Wrong number of arguments in WHERE clause.');
      }
      $array = $this->getArrayFromDatabase($array[0], $array[1]);
      $this->populateFields($array);
    }
  }
  
  /**
   * Populates the local $fields variable with values from $array 
   *
   * @param array $array 
   * @return void
   * @author Chi Feng
   */
  protected function populateFields($array) {
    foreach($this->fields as $name=>$field) {
      $this->set($name, $array[$name]);
    }
  }
  
  /**
   * Accessor for local fields
   *
   * @param string $fieldName 
   * @return mixed Value of field
   * @author Chi Feng
   */
  public function get($fieldName) {
    if (isset($this->fields[$fieldName])) {
      return $this->fields[$fieldName]['value']; 
    } else {
      fatal_error('Model::get()', "Tried to get nonexistent field '$fieldName'");
    }
  }
  
  /**
   * Mutator for local fields
   *
   * @param string $fieldName 
   * @param mixed $value 
   * @return void
   * @author Chi Feng
   */
  public function set($fieldName, $value) {
    if (isset($this->fields[$fieldName])) {
      $this->fields[$fieldName]['value'] = $value; 
    } else {
      fatal_error('Model::set()', "Tried to set nonexistent field '$fieldName'");
    }
  }
  
  /**
   * Get an associative array from the database given unique field and value
   *
   * @param string $field Name of field
   * @param string $value Value of field
   * @return array Associative array, first row of database result 
   * @author Chi Feng
   */
  protected function getArrayFromDatabase($field, $value) {
    // check that the field is a unique field
    if (isset($this->fields[$field]['unique'])) {
      // validate and sanitize value according to field type
      $sanitized = validate($value, $this->fields[$field]['type']);
      if ($sanitized['valid']) {
        // select user from database 
        $array = $this->db->select($this->table, '*', array(array($field,'=',$value)));
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
  
  /**
   * Save the object to the database, i.e. insert or commit changes.
   *
   * @return int insert_id if id was originally zero or null, otherwise the 
   *             number of affected rows (should be 1).
   * @author Chi Feng
   */
  public function save() {
    // if id = 0, we insert, otherwise, we update 
    if ($this->fields['id']['value'] == 0 ||
        $this->fields['id']['value'] == NULL) {
      // NULL is not integer and Database::insert() will give error
      $this->fields['id']['value'] = 0; 
      $id = $this->db->insert('users', $this->fields); 
      $this->fields['id']['value'] == $id;
      return $id;
    } else {
      $affected = $this->db->update($this->table, $this->fields, $this->fields['id']['value']);
      if ($affected < 1) {
        // TODO: this shouldn't actually be fatal
        fatal_error('Model::save()', 'Database::update() resulted in zero affected rows.');
      }
      return $affected;
    }
  }
}

?>
