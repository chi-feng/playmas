<?php

require_once('app/Bcrypt.php');
require_once('models/User.php');

class LoginController { 
  
  private $db;
  private $view;
  
  public function __construct($db, $view) {
    $this->db = $db;
    $this->view = $view;
  }

  public function showLoginForm() {
    $this->view->showView('login_form');
  }
  
  public function doLogin($postvars) {
    $errors = array();
    // check if username exists
    $filters = array(array('username', '=', $postvars['username'])); 
    if ($this->db->select('users','count', $filters) == 0) {
      $errors[] = 'Username does not exist.';
    } else {
      $user = new User(array('username', $postvars['username'])); 
      $bcrypt = new Bcrypt(BCRYPT_ITER);;
      if ($bcrypt->verify($postvars['password'], $user->get('password_hash'))) {
        $_SESSION['username'] = $user->get('username');
        $_SESSION['display_name'] = $user->get('display_name');
        $_SESSION['id'] = $user->get('id');
        header('Location: '.route('home'));
      } else {
        $errors[] = "Username/password mismatch.";
      }
    }
    $this->view->showView('login_form', array('postdata'=>$postdata, 'errors'=>$errors));
  }
  
  public function doLogout() {
    session_destroy();
    header('Location: '.route('home'));
  }
  
}

?>
