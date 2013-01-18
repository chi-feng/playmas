<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

class SiteController { 
  
  private $db;
  
  private $view;
  
  public function __construct($db, $view) {
    $this->db = $db;
    $this->view = $view;
  }

  public function showHome() {
    $this->view->show('site/home');
    $this->view->render('html');
  }
  
  public function showDashboard() {
    $this->view->show('dashboard/dashboard');
    $this->view->render('html');
  }

}

?>
