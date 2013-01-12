<?php
require_once('models/User.php');

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
    $this->view->showView('registration_form');
  }
  
  /**
   * Displays a user's profile page
   *
   * @param string $username target user
   * @return void
   * @author Chi Feng
   */
  public function showProfilePage($username) {
    if ($this->userExists('username', $username)) {
      $user = new User(array('username', $username));
      $this->view->showView('public_profile', array('user'=>$user));
    } else {
      $this->view->showView('user_not_found');
    }
  }
  
  /**
   * Checks if a user exists in the database
   *
   * @param string $field the selection criteria, e.g. 'username', or 'id'
   * @param string $value the value of $field
   * @return boolean true if user exists, false otherwise
   * @author Chi Feng
   */
  private function userExists($field, $value) {
    $filters = array(array($field, '=', $value));
    return $this->db->select('users', 'count', $filters) > 0;
  }
  
  /**
   * Handles POST request from registration form and creates user if valid, 
   * otherwise displays registration form with errors
   *
   * @param array $postdata the $_POST array
   * @return void
   * @author Chi Feng
   */
  public function registerUser($postdata) {
    // populate userArray with sanitized postdata
    $userArray = array();
    // keep track of errors on the way 
    $errors = array();
    
    $sanitized = validate($postdata['username'], 'alphanumeric', array('minlen'=>3, 'maxlen'=>30));
    if (!$sanitized['valid']) {
      $errors[] = 'Username must be alphanumeric between 3 and 30 characters long.';
    } else {
      $userArray['username'] = $sanitized['value']; 
    }
    
    $sanitized = validate($postdata['email'], 'email'); 
    if (!$sanitized['valid']) {
      $errors[] = 'You must provide a valid email address.';
    } else {
      $userArray['email'] = $sanitized['value']; 
    }
    
    if (strlen($postdata['password']) < 6) {
      $errors[] = 'Password must be at least 6 characters long';
    } else {
      require_once('app/Bcrypt.php');
      $bcrypt = new Bcrypt(BCRYPT_ITER);
      $userArray['password_hash'] = $bcrypt->hash($postdata['password']);
    }
    
    // some default values 
    $userArray['cred'] = 0;
    $userArray['timezone'] = -5;
    $userArray['created'] = time();
    $userArray['status'] = 1;
    $userArray['description'] = 'Describe yourself';
    $userArray['city'] = '';
    $userArray['country'] = 'United States';
    $userArray['twitter'] = '';
    $userArray['display_name'] = $userArray['username'];
    $userArray['has_picture'] = 0;
    
    // check if user already exists (either username or email)
    $filters = array(array('username', '=', $userArray['username']));
    if ($this->db->select('users','count', $filters) > 0) {
      $errors[] = 'Username already taken.';
    }
    $filters = array(array('email', '=', $userArray['email']));
    if ($this->db->select('users','count', $filters) > 0) {
      $errors[] = 'User with specified email already exists.';
    }
    
    if (count($errors) == 0) {
      $user = new User($userArray, 'new');
      $id = $user->save();
      // TODO: actually redirect or say something more useful
      $message = "Inserted user, id is '$id'";
      $this->view->showView('var_dump', array('var'=>$message));
    } else {
      $this->view->showView('registration_form', array('postdata'=>$postdata, 'errors'=>$errors));
    }
  }
  
}

?>
