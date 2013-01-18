<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

class LoginController { 
  
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
   * Constructor for LoginController
   *
   * @param Database $db an initialized Database object
   * @param View $view an initialized View object
   * @author Chi Feng
   */
  public function __construct($db, $view) {
    $this->db = $db;
    $this->view = $view;
  }

  public function showLoginForm() {
    $this->view->show('login_form');
    $this->view->render('html');
  }
  
  public function doLogin() {
    
    $errors = array();
    
    if ($this->db->exists('users', 'username', $_POST['username'])) {
      $user = $this->db->getUser('username', $_POST['username']);
      if (cryptVerify($_POST['password'], $user->get('password_hash'))) {
        createSession($user);
        header('Location: '.route('dashboard'));
      } else {
        $errors[] = "Username/password mismatch.";
      }
    } else {
      $errors[] = 'Username does not exist.';
    }
    
    $this->view->show('login_form', array('postdata'=>$postdata, 'errors'=>$errors));
    $this->view->render('html');
  }
  
  public function doLogout() {
    session_destroy();
    header('Location: '.route('home'));
  }
  
}

?>
