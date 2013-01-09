<?php

require_once('include/Common.php');
require_once('include/Views.php');

$views = new Views();

$action = isset($_GET['a']) ? $_GET['a'] : 'home';

if ($action == 'test') {
  $views->showView('test');
}

$views->render('html');

?>