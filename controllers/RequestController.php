<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

class RequestController { 
  
  /**
   * Database handle
   *
   * @var Database an initialized Database object
   */
  private $db;
  
  /**
   * View handle
   *
   * @var View an initialized View object
   */
  private $view;
  
  /**
   * Constructor for RequestController
   *
   * @param Database $db an initialized Database object
   * @param View $view an initialized View object
   * @author Chi Feng
   */
  public function __construct($db, $view) {
    $this->db = $db;
    $this->view = $view;
  }

  /**
   * Generates a new request from POST request
   * Gives errors if target user doesn't exist
   *
   * @param array $postdata the $_POST array
   * @return void
   * @author Jeff Liu
   */
  public function addNewRequest() {
    $user = $this->db->getUser('username',$_POST['username']);
    $arr = array(
      'from' => $_POST['from'],
      'user_id' => $user->get('id'),
      'status' => REQUEST_RECEIVED,
      'body' => $_POST['body']
    );
    $request = new Request($arr);
    $request->save($this->db);
    header('Location: '.route('requests'));
  }

  public function receiveTwilio() {

    ob_start();
    var_dump($_POST);
    $result = ob_get_clean() . "\n\n";
    
    file_put_contents('queries.txt', $result, FILE_APPEND); 
    $this->view->set('var', $_POST);
    $this->view->show('var_dump');
    $this->view->render('html');
  }

  /**
   * Shows the new request form
   *
   * @param null
   * @return void
   * @author Jeff Liu
   */
  public function showNewRequestForm() {
    $this->view->show('request/new');
    $this->view->render('html');
  }

  /**
   * Display all requests
   *
   * @param null
   * @return void
   * @author Jeff Liu
   */
  public function showRequests() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $requests = $this->db->getPaginated('requests',$page);
    $this->view->set('requests',$requests);
    $this->view->show('request/list');
    $this->view->render('html');
  }

}

?>
