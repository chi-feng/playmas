<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

class NumberController { 
  
  private $db;
  
  private $view;
  
  public function __construct($db, $view) {
    $this->db = $db;
    $this->view = $view;
  }
  
  public function showNumbers() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $numbers = $this->db->getPaginated('numbers', $page);
    $this->view->set('numbers', $numbers);
    $this->view->show('number/list');
    $this->view->render('html');
  }
  
  public function showNewNumberForm() {
    $this->view->show('number/new'); 
    $this->view->render('html');    
  }
  
  public function addNewNumber() {
    $user = $this->db->getUser('username', $_POST['username']);  
    $arr = array(
      'number' => $_POST['number'],
      'user_id' => $user->get('id')
    );
    $number = new Number($arr);
    $number->save($this->db);
    header('Location: ' . route('numbers'));
  }
  
}

?>
