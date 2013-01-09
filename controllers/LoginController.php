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
    $bcrypt = new Bcrypt(10);
    $errors = array();
    // TODO: get user from Database::select()
    $user = new User($dbresult);
    if ($user) {
      $passwordhash = $user->getPasswordHash();
      if ($bcrypt->verify($postvars['password'], $passwordhash)) {
        // sucessfully logged in
        // set session flags and redirect to inbox
      } else {
        $errors[] = "Username/password mismatch.";
      }
    } else {
      $errors[] = "Username does not exist";
    }
    // do something with errors, return json or html
  }
  
  public function doLogout() {
    // TODO: unset/destroy session variables
    // redirect to home page or login screen.
  }
  
}

?>
