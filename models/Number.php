<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

class Number extends Model { 
  
  public function __construct($array, $options=array()) {
    
    $this->table = 'numbers';
    
    $this->fields = array(
      'id'            => array('type' => 'int', 'value' => 0), 
      'number'        => array('type' => 'string', 'value' => ''), 
      'user_id'       => array('type' => 'int', 'value' => 0), 
      'created'       => array('type' => 'int', 'value' => time()), 
    );
    
    $this->populate($array, $options);
  
  }
  
}

?>