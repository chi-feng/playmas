<?php

class RequestController { 
  
  private $db;
  private $view;
  
  public function __construct($db, $view) {
    $this->db = $db;
    $this->view = $view;
  }

}

?>
