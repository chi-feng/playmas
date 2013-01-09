<?php

class User { 

  private $id;
  private $username;
  private $email;
  private $passwordhash; 
  private $number;
  private $cred;
  private $created;
  private $accessed;
  private $status; 
  
  public function __construct($array) {
    global $Users;
    $this->id = $array['id'];
    $this->username = $array['username'];
    $this->email = $array['email'];
    $this->passwordhash = $array['passwordhash'];
    $this->number = $array['number'];
    $this->cred = $array['cred'];
    $this->created = $array['created'];
    $this->accessed = $array['accessed'];
    $this->status = $array['status'];
  }
  
  public function getID(){
    return $this->id;  
  }
  
  public function getUsername(){
    return $this->username;
  }
  
  public function getEmail(){
    return $this->email;
  }
  
  public function getPasswordhash(){
    return $this->passwordhash;
  }
  
  public function getNumber(){
    return $this->number;
  }
  
  public function getCred(){
    return $this->cred;
  }
  
  public function getCreated(){
    return $this->created;
  }
  
  public function getAccessed(){
    return $this->accessed;
  }
  
  public function getStatus() {
    return $this->status;
  }
  
  public function setUsername($username){
     $this->username = username;
  }
  
  public function setEmail($email){
    $this->email = email;
  }
  
  public function setPasswordhash($passwordhash){
    $this->passwordhash = passwordhash;
  }
  
  public function setNumber($number){
    $this->number = number;
  }
  
  public function setCred($cred){
    $this->cred = cred;
  }
  
  public function setAccessed(){
    $this->accessed = time();
  }
  
  public function setStatus($status) {
    $this->status = $status;
  }
  
  public function save() {
    
  }

}

?>
