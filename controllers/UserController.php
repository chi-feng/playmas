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
  
  public function registerUser($postData) {
    // TODO: if valid, put into database and redirect to 
    //       inbox otherwise, display registration form 
    //       and show errors
  }
  
  private function validateRegistration($postData) {
    
  }
  
}

?>
