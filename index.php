<?php

require_once('include/Common.php');
require_once('include/Views.php');

$views = new Views();

$action = isset($_GET['a']) ? $_GET['a'] : 'home';
$verb = $_SERVER['REQUEST_METHOD'];

if ($action == 'test') {
  $views->showView('test');
}

if ($action == 'user_new') {
  require_once('include/UserController.php');
  $userCtrl = new UserController(); 
  if ($verb == 'GET') {
    $userCtrl->displayRegistrationForm(); 
  } elseif ($verb == 'POST') {
    $userCtrl->registerUser($_POST);
  } else {
    fatal_error('Invalid Request', 'Unknown HTTP verb in user_new');
  }
}
  
$views->render('html');

?>