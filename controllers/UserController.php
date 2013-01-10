<?php

require_once('models/User.php');

class UserController { 
  
  public function __construct() {
    
  }

  public function showRegistrationForm() {
    global $views;
    $views->showView('registration_form');
  }
  
  public function showPublicProfilePage($id) {
    global $views;
    $user = $this->getUserByID($id); 
    if (!is_null($user)) {
      $views->showView('public_profile', array('user'=>$user));
    } else {
      $views->showView('user_not_found');
    }
  }
  
  public function showPrivateProfilePage($id) {
    global $views;
    $user = $this->getUserByID($id); 
    if (!is_null($user)) {
      $views->showView('private_profile', array('user'=>$user));
    } else {
      $views->showView('user_not_found');
    }
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
      $userArray['passwordhash'] = $bcrypt->hash($postdata['password']);
    }
    
    // some default values 
    $userArray['cred'] = 0;
    $userArray['created'] = time();
    $userArray['status'] = 1;
    
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
      $user = new User($userArray);
      $id = $user->save();
      // TODO: actually redirect or say something more useful
      $message = "Inserted user, id is '$id'";
      $views->showView('var_dump', array('var'=>$message));
    } else {
      $views->showView('registration_form', array('postdata'=>$postdata, 'errors'=>$errors));
    }
  }
  
  private function validateRegistration($postData) {
    
  }
  
}

?>
