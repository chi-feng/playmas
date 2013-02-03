<?php

define('INCLUDE_GUARD', true);
define('SHOW_EXCEPTIONS', true); 

require_once 'includes.php';

session_start();

try {
  // initialize database and view
  $view = new View();
  $db = new Database();
  $db->connect('localhost', 'root', 'hicfneg12', 'playmas');
  // get the action and request method
  $action = isset($_GET['a']) ? $_GET['a'] : 'home';
  $method = $_SERVER['REQUEST_METHOD'];
  // search for a route that matches the action and method
  $foundMatchingRoute = false; 
  foreach ($routes as $route) {
    if ($action == $route[0] && $method == $route[1]) {
      // get class name and function
      $controllerClassName = $route[2] . 'Controller';
      $functionName = $route[3];
      // instantiate object and call function
      $controller = new $controllerClassName($db, $view);
      $controller->$functionName();
      $foundMatchingRoute = true;
    }
  }
  // did not find matching route: display 404 page
  if (!$foundMatchingRoute) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
    $view->show('site/404');
    $view->render('html');
  }
} catch (Exception $ex) {
  header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
  if (SHOW_EXCEPTIONS) {
    echo '<h1>Exception</h1>';
    echo '<h2>'.$ex->getMessage()."</h2>";
    echo '<pre>'.$ex->getTraceAsString().'</pre>';
  }
}

session_write_close();

?>
