<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

define('USER_DISABLED', 0);
define('USER_ACTIVE', 1);

class User extends Model { 
  
  public function __construct($array, $options=array()) {
    
    $this->table = 'users';
    
    $this->fields = array(
      'id'            => array('type' => 'int',     'value' => 0), 
      'username'      => array('type' => 'username','value' => ''), 
      'display_name'  => array('type' => 'string',  'value' => ''), 
      'email'         => array('type' => 'email',   'value' => ''), 
      'password_hash' => array('type' => 'string',  'value' => ''), 
      'cred'          => array('type' => 'int',     'value' => 0), 
      'created'       => array('type' => 'time',    'value' => time()), 
      'status'        => array('type' => 'int',     'value' => USER_DISABLED),
      'has_picture'   => array('type' => 'int',     'value' => 0),
      'twitter'       => array('type' => 'string',  'value' => ''),
      'description'   => array('type' => 'string',  'value' => ''),
      'timezone'      => array('type' => 'int',     'value' => 5),
      'location_id'   => array('type' => 'int',     'value' => 0),
      'location'      => array('type' => 'virtual', 'value' => '')
    );
    
    $this->populate($array, $options);
  
  }
  
  public function getNumbers($db) {
    $numberRows = $db->get('numbers', 'user_id', $this->get('id'));
    $numbers = array();
    if (count($numberRows) > 0) {
      foreach ($numberRows as $row) {
        $numbers[] = new Number($row);
      }
    } 
    return $numbers;
  }
  
  public function getRequests($db) {
    $requestRows = $db->get('requests', 'user_id', $this->get('id'));
    $requests = array();
    if (count($requestRows) > 0) {
      foreach ($requestRows as $row) {
        $requests[] = new Request($row);
      }
    } 
    return $requests;
  }
  
}

?>