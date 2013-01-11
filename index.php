<?php

session_start();

require_once('app/Common.php');
require_once('app/View.php');
require_once('app/Database.php');

$db = new Database();
$db->connect('localhost', 'root', 'hicfneg12', 'playmas');

$view = new View();

$action = isset($_GET['a']) ? $_GET['a'] : 'home';
$verb = $_SERVER['REQUEST_METHOD'];

if ($action == 'home') {
  $view->showView('home');
}

if ($action == 'test') {
  $view->showView('test');
}

if ($action == 'user_new') {
  require_once('controllers/UserController.php');
  $userCtrl = new UserController($db, $view); 
  if ($verb == 'GET') {
    $userCtrl->showRegistrationForm(); 
  } elseif ($verb == 'POST') {
    $userCtrl->registerUser($_POST);
  } else {
    fatal_error('Invalid Request', 'Unknown HTTP verb in user_new');
  }
}

if ($action == 'users') {
  require_once('controllers/UserController.php');
  $userCtrl = new UserController();
  if($verb == 'GET') {

  } else {
    fatal_error('Invalid REquest','Unknown HTTP verb in users');
  }

}

if ($action == 'login') {
  require_once('controllers/LoginController.php');
  $loginCtrl = new LoginController($db, $view);
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
  $loginCtrl = new LoginController($db, $view);
  if ($verb == 'GET') {
    $loginCtrl->doLogout();
  } else {
    fatal_error('Invalid Request', 'Unknown HTTP verb in logout');
  }
}

if ($action == 'user_view') {
  require_once('controllers/UserController.php');
  $userCtrl = new UserController($db, $view); 
  if ($verb == 'GET') {
    if (!isset($_GET['username'])) {
      fatal_error('Invalid Request', 'user_view not given id from routes');
    }
    $userCtrl->showProfilePage($_GET['username']); 
  } elseif ($verb == 'POST') {
    $userCtrl->updateProfile($_POST);
  } else {
    fatal_error('Invalid Request', 'Unknown HTTP verb in user_view');
  }
}

$view->render('html');

session_write_close();

?>
