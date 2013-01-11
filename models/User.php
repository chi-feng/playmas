<?php

require_once('models/Model.php');

class User extends Model { 
  
  public function __construct($array, $option = '') {
    
    $this->table = 'users';
    
    $this->fields = array(
      'id' => array('type' => 'int', 'unique'=>true), 
      'username' => array('type' => 'string', 'unique'=>true), 
      'email' => array('type' => 'string', 'unique'=>true), 
      'password_hash' => array('type' => 'string'), 
      'cred' => array('type' => 'int'), 
      'created' => array('type' => 'int'), 
      'status' => array('type' => 'int'),
      'timezone' => array('type' => 'int'),
      'description' => array('type' => 'string'),
      'location' => array('type' => 'string'),
      'twitter' => array('type' => 'string')
    );
    
    $this->populate($array, $option);
  
  }
  
}

?>
