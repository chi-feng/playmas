<?php

class SMSController {
  
  /**
   * Database handle
   *
   * @var Database an initialized Database object
   */
  private $db;
  
  /**
   * View hand
   *
   * @var View an initialized View object
   */
  private $view;
  
  /**
   * Constructor for SMSController
   *
   * @param Database $db an initialized Database object
   * @param View $view an initialized View object
   * @author Chi Feng
   */
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
