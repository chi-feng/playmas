<?php

require_once('models/Model.php');

class Request extends Model{
  /*
   $id; //unique message id
   $from; //from phone number
   $to; //destination phone number
   $user_id; //destination user id
   $received; 
   $seen; 
   $response_msg; 
   $response_time; 
   $body; 
   $songid; //external song info id
  */
  public function __construct($array, $db, $options=array())) {
    
    $this->db = $db;
    
    $this->table = 'requests';
    
    $this->fields = array(
      'id' => array('type' => 'int', 'unique'=>true), 
      'from' => array('type' => 'int'), 
      'to' => array('type' => 'int'), 
      'user_id' => array('type' => 'int'),
      'received' => array('type' => 'int'),//timestamp for when received
      'seen' => array('type' => 'int'),    //timestamp for when seen by user
      'status' => array('type' => 'int'), //Code for status:
                                          //0:uninit 1:received 2:ignored
                                          //3:accepted 4:played
                                          //negative:archived
      'response_msg' => array('type' => 'string'),//text of response message
      'response_time' => array('type' => 'int'),  //timestamp for response
      'body' => array('type' => 'string'), //request msg text
      'song_id' => array('type' => 'int')  //external song info id
    );
    $this->populate($array, $options);
  }

}

?>