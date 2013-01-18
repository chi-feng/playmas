<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

class AjaxController { 
  
  private $db;
  
  private $view;
  
  public function __construct($db, $view) {
    $this->db = $db;
    $this->view = $view;
  }

  public function getAutocompleteSuggestions() {
    $field = $_GET['field'];
    $query = $_POST['query'];
    $suggestions = $this->db->getAutocompleteSuggestions($field, $query);
    $this->view->render('json', $suggestions);
  }

}

?>