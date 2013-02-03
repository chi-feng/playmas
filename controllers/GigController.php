<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

class GigController { 
  
  private $db;
  
  private $view;
  
  public function __construct($db, $view) {
    $this->db = $db;
    $this->view = $view;
  }

  /**
   * Add a new gig to database
   *
   * @param null
   * @return void
   * @author Jeff Liu
   */
  public function addNewGig() {
    $user = $this->db->getUser('username', $_POST['username']);  
    $arr = array(
      'user_id' => $user->get('id'),
      'name'    => $_POST['name'],
      'begin'   => $_POST['begin'],
      'end'     => $_POST['end'],
      'location'=> $_POST['location'],
    );
    $location_id = $this->db->getLocationID($arr['location']);
    $arr['location_id'] = $location_id;
    $gig = new Gig($arr);
    $gig->save($this->db);
    header('Location: ' . route('gigs'));
  }

  //TODO Need a function to toggle active/inactive
  //TODO Need a function to show gigs for specific user,date,location

  /**
   * Show all Gigs
   * 
   * @param null
   * @return void
   * @author Jeff Liu
   */
  public function showGigs() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $gigs = $this->db->getPaginated('gigs', $page);
    $this->view->set('gigs', $gigs);
    $this->view->show('gig/list');
    $this->view->render('html');
  }
  
  public function showNewGigForm() {
    $this->view->show('gig/new'); 
    $this->view->render('html');    
  }
  
}

?>
