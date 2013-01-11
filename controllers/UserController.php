<?php

require_once('models/User.php');

class UserController { 
  
  public function __construct() {
    
  }

  public function showRegistrationForm() {
    global $views;
    $views->showView('registration_form');
  }
  
  public function showProfilePage($username) {
    global $db, $views; 
    if ($this->userExists('username', $username)) {
      $user = new User('username', $username);
      $this->showPublicProfilePage($user);
    } else {
      $this->showView('user_not_found');
    }
  }
  
  private function showPublicProfilePage($user) {
    global $views; 
    $views->showView('public_profile', array('user'=>$user));
  }
  
  private function userExists($field, $value) {
    global $db;
    $filters = array(array($field, '=', $value));
    return $db->select('users', 'count', $filters) > 0;
  }
  
  public function registerUser($postdata) {
    
    global $views, $db;
    
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
    if ($db->select('users','count', $filters) > 0) {
      $errors[] = 'Username already taken.';
    }
    $filters = array(array('email', '=', $userArray['email']));
    if ($db->select('users','count', $filters) > 0) {
      $errors[] = 'User with specified email already exists.';
    }
    
    if (count($errors) == 0) {
      $user = new User($userArray, 'new');
      $id = $user->save();
      // TODO: actually redirect or say something more useful
      $message = "Inserted user, id is '$id'";
      $views->showView('var_dump', array('var'=>$message));
    } else {
      $views->showView('registration_form', array('postdata'=>$postdata, 'errors'=>$errors));
    }
  }
  
}

?>
