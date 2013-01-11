<?php

class SMSController {
  
  private $db;
  private $view;
  
  public function __construct($db, $view) {
    $this->db = $db;
    $this->view = $view;
  }

  public function receiveSMS($incoming) {
    //TODO: check if SMS goes to a valid account
    //      if yes, add to database, if no: error

  }

  public function sendSMS($outgoing) {

  }

}


?>
