<?php

require_once('models/Model.php');

class User extends Model { 
  
  public function __construct($array, $db, $options=array()) {
  
    $this->db = $db;
    
    $this->table = 'users';
    
    $this->fields = array(
      'id' => array('type' => 'int', 'unique'=>true), 
      'username' => array('type' => 'string', 'unique'=>true), 
      'display_name' => array('type' => 'string', 'unique'=>true), 
      'email' => array('type' => 'string', 'unique'=>true), 
      'password_hash' => array('type' => 'string'), 
      'cred' => array('type' => 'int'), 
      'created' => array('type' => 'int'), 
      'status' => array('type' => 'int'),
      'has_picture' => array('type' => 'int'),
      'twitter' => array('type' => 'int'),
      'description' => array('type' => 'string'),
      'city' => array('type' => 'string'),
      'country' => array('type' => 'string'),
      'timezone' => array('type' => 'int')
    );
    
    $this->populate($array, $options);
  
  }
  
}

?>