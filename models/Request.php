<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

define('REQUEST_UNINIT',0);
define('REQUEST_RECEIVED',1);
define('REQUEST_IGNORED',2);
define('REQUEST_ACCEPTED',3);
define('REQUEST_PLAYED',4);
/**
 * Model for a song request
 *
 * @package default
 * @author Jeff Liu
 */
class Request extends Model{
  
  /**
   * Constructor for Request model
   *
   * @param string $array 
   * @param string $options 
   * @author Jeff Liu
   */
  public function __construct($array, $options=array()) {
    
    $this->table = 'requests';
    $this->fields = array(
      'id'            => array('type' => 'int',   'value'=> 0), 
      'from'          => array('type' => 'int',   'value'=> 0), 
      'to'            => array('type' => 'int',   'value'=> 0), 
      'user_id'       => array('type' => 'int',   'value'=> 0),
      'received'      => array('type' => 'int',   'value'=> time()),//timestamp
      'seen'          => array('type' => 'int',   'value'=> 0),//timestamp     
      'status'        => array('type' => 'int',   'value'=> REQUEST_UNINIT),
      'response_msg'  => array('type' => 'string','value'=> ''),
      'response_time' => array('type' => 'int',   'value'=> 0), 
      'body'          => array('type' => 'string','value'=> ''), 
      'song_id'       => array('type' => 'int',   'value'=> 0)
    );
    $this->populate($array, $options);
  }

}

?>
