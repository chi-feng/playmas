<?php

require_once('models/Model.php');

class Number extends Model { 
  
  public function __construct($array, $options=array()) {
    
    $this->table = 'numbers';
    
    $this->fields = array(
      'id'            => array('type' => 'int', 'value' => 0), 
      'number'        => array('type' => 'int', 'value' => 0), 
      'user_id'       => array('type' => 'int', 'value' => 0), 
      'created'       => array('type' => 'int', 'value' => time()), 
    );
    
    $this->populate($array, $options);
  
  }
  
}

?>