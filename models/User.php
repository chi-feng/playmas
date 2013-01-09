<?php

class User { 

  private $id;
  private $username;
  private $email;
  private $passwordhash;
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
    $this->cred = $array['cred'];
    $this->created = $array['created'];
    $this->status = $array['status'];
  }
  
  public function getInsertFields() {
    $fields = array(
      array(
        'name'=>'username',
        'type'=>'string',
        'value'=>$this->username
      ),
      array(
        'name'=>'email',
        'type'=>'string',
        'value'=>$this->email
      ),
      array(
        'name'=>'passwordhash',
        'type'=>'string',
        'value'=>$this->passwordhash
      ),
      array(
        'name'=>'cred',
        'type'=>'int',
        'value'=>$this->cred
      ),
      array(
        'name'=>'created',
        'type'=>'int',
        'value'=>$this->created
      ),
      array(
        'name'=>'status',
        'type'=>'int',
        'value'=>$this->status
      )      
    );
    return $fields; 
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
  
  public function setCred($cred){
    $this->cred = cred;
  }
  
  public function setStatus($status) {
    $this->status = $status;
  }
  
  public function setID($id) {
    $this->id = $id;
  }

}

?>
