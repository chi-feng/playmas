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
  
  public function getUserByID($id) {
    $sanitized = validate($id, 'int');
    if ($sanitized['valid']) {
      global $db;    
      $array = $db->select('users', '*', array(array('id','=',$id)));
      if (is_array($array)) {
        $user = new User($array);
        return $user;
      } else {
        return NULL;
      }
    } else {
      return NULL;
    }
  }
  
  public function getUserByUsername($username) {
    $sanitized = validate($username, 'string');
    if ($sanitized['valid']) {
      global $db;    
      $array = $db->select('users', '*', array(array('username','=',$username)));
      if (is_array($array)) {
        $user = new User($array);
        return $user;
      } else {
        return NULL;
      }
    } else {
      return NULL;
    } 
  }
  
  public function getUserByEmail($email) {
    $sanitized = validate($email, 'email');
    if ($sanitized['valid']) {
      global $db;    
      $array = $db->select('users', '*', array(array('email','=',$email)));      
      if (is_array($array)) {
        $user = new User($array);
        return $user;
      } else {
        return NULL;
      }
    } else {
      return NULL;
    }
  }
  
  public function registerUser($postdata) {
    // TODO: if valid, put into database and redirect to 
    //       inbox otherwise, display registration form 
    //       and show errors
    // TODO: Check if user specified is unique
    global $views;
    $views->showView('test');
    
    $userArray = array();
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
    
    $userArray['cred'] = 0;
    $userArray['created'] = time();
    $userArray['status'] = 1;
    
    $views->showView('var_dump', array('var'=>$userArray));
    
    if (count($errors) == 0) {
      require_once('models/User.php');
      $user = new User($userArray);
      $id = $this->insertUser($user);
      // TODO: actually redirect or say something more useful
      $message = "Inserted user, id is '$id'";
      $views->showView('var_dump', array('var'=>$message));
    } else {
      $views->showView('registration_form', array('postdata'=>$postdata, 'errors'=>$errors));
    }
  }
  
  public function insertUser(&$user) {
    // TODO: check if user exists and do error handling here. 
    // NOTE: the Database::insert will only give fatal errors.
    $fields = $user->getInsertFields();
    global $db;
    $id = $db->insert('users', $fields);
    $user->setID($id);
    return $id;
  }
  
  private function validateRegistration($postData) {
    
  }
  
}

?>
