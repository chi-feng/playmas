<?php

session_start();

require_once('app/Common.php');
require_once('app/View.php');
require_once('app/Database.php');

require_once('controllers/LoginController.php');
require_once('controllers/UserController.php');

require_once('models/Model.php');
require_once('models/User.php');
require_once('models/Number.php');

try {

$db = new Database();
$db->connect('localhost', 'root', 'hicfneg12', 'playmas');

$view = new View();

$action = isset($_GET['a']) ? $_GET['a'] : 'home';
$verb = $_SERVER['REQUEST_METHOD'];

if ($action == 'home') {
  $view->showView('home');
  $view->render('html');
}

elseif ($action == 'user_new') {
  $userCtrl = new UserController($db, $view); 
  if ($verb == 'GET') {
    $userCtrl->showRegistrationForm(); 
    $view->render('html');
  } elseif ($verb == 'POST') {
    $userCtrl->registerUser($_POST);
    $view->render('html');
  } else {
    throw new Exception('Invalid HTTP verb in this context.');
  }
}
elseif ($action == 'number_list') {
  if($verb == 'GET') {
    $numbers = $db->getPaginated('numbers', 1);
    $view->set('numbers', $numbers);
    $view->showView('numbers');
    $view->render('html');
  } else {
    throw new Exception('Invalid HTTP verb in this context.');
  }
}
elseif ($action == 'number_new') {
  if ($verb == 'GET') {
    $view->showView('number_new_form'); 
    $view->render('html');    
  } elseif ($verb == 'POST') {
    
    $user = $db->getUser('username', $_POST['username']);
    
    $arr = array(
      'number' => $_POST['number'],
      'user_id' => $user->get('id')
    );
    
    $number = new Number($arr);
    
    $number->save($db);
    header('Location: ' . route('numbers'));
    
  } 
  
}

elseif ($action == 'user_list') {
  $userCtrl = new UserController($db, $view);
  if($verb == 'GET') {
    $userCtrl->showUserTable();
    $view->render('html');
  } else {
    throw new Exception('Invalid HTTP verb in this context.');
  }

}

elseif ($action == 'login') {
  $loginCtrl = new LoginController($db, $view);
  if ($verb == 'GET') {
    $loginCtrl->showLoginForm();
    $view->render('html');
  } elseif ($verb == 'POST') {
    $loginCtrl->doLogin($_POST);
    $view->render('html');
  } else {
    throw new Exception('Invalid HTTP verb in this context.');
  }
}

elseif ($action == 'logout') {
  $loginCtrl = new LoginController($db, $view);
  if ($verb == 'GET') {
    $loginCtrl->doLogout();
    $view->render('html');
  } else {
    throw new Exception('Invalid HTTP verb in this context.');
  }
}

elseif ($action == 'user_view') {
  require_once('controllers/UserController.php');
  $userCtrl = new UserController($db, $view); 
  if ($verb == 'GET') {
    if (!isset($_GET['username'])) {
      fatal_error('Invalid Request', 'user_view not given id from routes');
    }
    $userCtrl->showProfilePage($_GET['username']); 
    $view->render('html');
  } elseif ($verb == 'POST') {
    $userCtrl->updateProfile($_POST);
  } else {
    fatal_error('Invalid Request', 'Unknown HTTP verb in user_view');
  }
}

elseif ($action == 'autocomplete') {
  $suggestions = $db->getAutocompleteSuggestions($_GET['field'], $_POST['query']);
  $view->render('json', $suggestions);
}

elseif ($action == 'dashboard') {
  $view->showView('dashboard');
  $view->render('html');
} 

else {
  header("HTTP/1.0 404 Not Found");
  $view->showView('404');
  $view->render('html');
}

session_write_close();

} catch (Exception $e) {
  echo '<h1>Exception</h1>';
  echo '<h2>'.$e->getMessage()."</h2>";
  echo '<pre>'.$e->getTraceAsString().'</pre>';
}


?>
