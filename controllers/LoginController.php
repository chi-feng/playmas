<?php

class LoginController { 
  
  public function __construct() {
    
  }

  public function showLoginForm() {
    global $views;
    $views->showView('login_form');
  }
  
  public function doLogin($postvars) {
    require_once('app/Bcrypt.php');
    require_once('models/User.php');
    
    // do something with errors, return json or html
  }
  
  public function doLogout() {
    // TODO: unset/destroy session variables
    // redirect to home page or login screen.
  }
  
}

?>
