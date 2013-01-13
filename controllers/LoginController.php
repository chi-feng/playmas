<?php

require_once('app/Bcrypt.php');
require_once('models/User.php');

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
    $this->view->showView('login_form');
  }
  
  public function doLogin($postvars) {
    $errors = array();
    // check if username exists
    $filters = array(array('username', '=', $postvars['username'])); 
    if ($this->db->select('users','count', $filters) == 0) {
      $errors[] = 'Username does not exist.';
    } else {
      $user = new User(array('username', $postvars['username']), $this->db); 
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
