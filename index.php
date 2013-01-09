<?php

require_once('app/Common.php');
require_once('app/Views.php');

require_once('app/Database.php');
$db = new Database();
$db->connect('localhost', 'root', 'hicfneg12', 'playmas');

$views = new Views();

$action = isset($_GET['a']) ? $_GET['a'] : 'home';
$verb = $_SERVER['REQUEST_METHOD'];

if ($action == 'home') {
  $views->showView('home');
}

if ($action == 'test') {
  $views->showView('test');
}

if ($action == 'user_new') {
  require_once('controllers/UserController.php');
  $userCtrl = new UserController(); 
  if ($verb == 'GET') {
    $userCtrl->showRegistrationForm(); 
  } elseif ($verb == 'POST') {
    $userCtrl->registerUser($_POST);
  } else {
    fatal_error('Invalid Request', 'Unknown HTTP verb in user_new');
  }
}

if ($action == 'login') {
  require_once('controllers/LoginController.php');
  $loginCtrl = new LoginController();
  if ($verb == 'GET') {
    $loginCtrl->showLoginForm();
  } elseif ($verb == 'POST') {
    $loginCtrl->doLogin($_POST);
  } else {
    fatal_error('Invalid Request', 'Unknown HTTP verb in login');
  }
}

if ($action == 'logout') {
  require_once('controllers/LoginController.php');
  $loginCtrl = new LoginController();
  if ($verb == 'GET') {
    $loginCtrl->showLoginForm();
  } else {
    fatal_error('Invalid Request', 'Unknown HTTP verb in logout');
  }
}

$views->render('html');

?>