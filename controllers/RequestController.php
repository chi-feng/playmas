<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

class RequestController { 
  
  /**
   * Database handle
   *
   * @var Database an initialized Database object
   */
  private $db;
  
  /**
   * View handle
   *
   * @var View an initialized View object
   */
  private $view;
  
  /**
   * Constructor for RequestController
   *
   * @param Database $db an initialized Database object
   * @param View $view an initialized View object
   * @author Chi Feng
   */
  public function __construct($db, $view) {
    $this->db = $db;
    $this->view = $view;
  }

  /**
   * Generates a new request from POST request
   * Gives errors if target user doesn't exist
   *
   * @param array $postdata the $_POST array
   * @return void
   * @author Jeff Liu
   */
  public function newRequest($postdata) {
    $requestArray = array(); //holds all the information to make new request
    $errors = array(); //holds any errors that may arise
  }

}

?>
