<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

class Gig extends Model { 
  
  public function __construct($array, $options=array()) {
    
    $this->table = 'Gigs';
    
    $this->fields = array(
      'name'          => array('type' => 'string',  'value' => 0),
      'id'            => array('type' => 'int',     'value' => 0), 
      'user_id'       => array('type' => 'int',     'value' => 0), 
      'setlist_id'    => array('type' => 'int',     'value' => 0), 
      'created'       => array('type' => 'int',     'value' => time()), 
      'begin'         => array('type' => 'int',     'value' => 0), //timestamp
      'end'           => array('type' => 'int',     'value' => 0), 
      'status'        => array('type' => 'int',     'value' => 0), 
      'url'           => array('type' => 'string',  'value' => ''),
      'location_id'   => array('type' => 'int',     'value' => 0),
      'location'      => array('type' => 'virtual', 'value' => ''),
      'venue'         => array('type' => 'string',  'value' => ''),
      'genre'         => array('type' => 'string',  'value' => ''),
    );
    
    $this->populate($array, $options);
  
  }
  
}

?>
