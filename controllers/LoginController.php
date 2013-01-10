<?php

require_once('app/Bcrypt.php');
require_once('models/User.php');

class LoginController { 
  
  public function __construct() {
    
  }

  public function showLoginForm() {
    global $views;
    $views->showView('login_form');
  }
  
  public function doLogin($postvars) {
    global $db, $views;
    $errors = array();
    // check if username exists
    $filters = array(array('username', '=', $postvars['username'])); 
    if ($db->select('users','count', $filters) == 0) {
      $errors[] = 'Username does not exist.';
    } else {
      $user = new User(array('username', $postvars['username'])); 
      $bcrypt = new Bcrypt(BCRYPT_ITER);;
      if ($bcrypt->verify($postvars['password'], $user->get('password_hash'))) {
        $_SESSION['username'] = $user->get('username');
        $_SESSION['id'] = $user->get('id');
        header('Location: '.route('home'));
      } else {
        $errors[] = "Username/password mismatch.";
      }
    }
    $views->showView('login_form', array('postdata'=>$postdata, 'errors'=>$errors));
  }
  
  public function doLogout() {
    session_destroy();
    header('Location: '.route('home'));
  }
  
}

?>
