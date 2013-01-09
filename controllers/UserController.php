<?php

class UserController { 
  
  public function __construct() {
    
  }

  public function showRegistrationForm() {
    global $views;
    $views->showView('registration_form');
  }
  
  public function registerUser($postData) {
    // TODO: if valid, put into database and redirect to 
    //       inbox otherwise, display registration form 
    //       and show errors
  }
  
  private function validateRegistration($postData) {
    
  }
  
}

?>
