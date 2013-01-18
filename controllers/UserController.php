<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

class UserController { 
  
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
   * Constructor for UserController
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
   * Display the registration form
   *
   * @return void
   * @author Chi Feng
   */
  public function showRegistrationForm() {
    $this->view->show('user/new');
    $this->view->render('html');
  }
  
  /**
   * Displays a user's profile page
   *
   * @param string $username target user
   * @return void
   * @author Chi Feng
   */
  public function showProfilePage() {
    $username = $_GET['username'];
    if ($this->db->exists('users', 'username', $username)) {
      $user = $this->db->getUser('username', $username);
      $this->view->set('user', $user);
      $this->view->show('user/view');
      $this->view->render('html');
    } else {
      $this->view->show('user/notfound');
      $this->view->render('html');
    }
  }
  
  /**
   * Displays a table of all registered users
   *
   * @return void
   * @author Jeff Liu
   */
  public function showUsers() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $users = $this->db->getPaginated('users', $page);
    $this->view->set('users', $users);
    $this->view->show('user/list');
    $this->view->render('html');
  }
  
  /**
   * Handles POST request from registration form and creates user if valid, 
   * otherwise displays registration form with errors
   *
   * @param array $postdata the $_POST array
   * @return void
   * @author Chi Feng
   */
  public function registerUser() {

    $arr = array();
    
    $errors = array();
    
    if (!validate('username', $_POST['username'])) {
      $errors[] = 'Username must be alphanumeric,dash,underscore between 3 and 30 characters.';
    } else {
      if ($this->db->exists('users', 'username', $_POST['username'])) {
        $errors[] = 'Username already in use';
        // TODO: forgot username/pass?
      }
    }
    
    if (!validate('email', $_POST['email'])) {
      $errors[] = 'Email is not valid';
    } else {
      if ($this->db->exists('users', 'email', $_POST['email'])) {
        $errors[] = 'Email already in use';
        // TODO: forgot username/pass?
      }
    }
    
    if (strlen($_POST['password']) < 6) {
      $errors[] = 'Password must be at least 6 characters';
    }
    
    if (count($errors) == 0) {
      
      $arr['username'] = sanitize('username', $_POST['username']);
      $arr['email'] = sanitize('email', $_POST['email']); 
      $arr['password_hash'] = cryptHash($_POST['password']);
      
      $user = new User($arr);
      $user->save($this->db);
      
      createSession($user);
      
      header('Location: ' . route('dashboard'));
      
    } else {
      
      $this->view->set('errors', $errors);
      $this->view->set('postdata', $_POST);
      $this->view->show('user/new');
      $this->view->render('html');
      
    }
    
  }
  
}

?>
