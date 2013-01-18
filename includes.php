<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

require_once('app/Common.php');
require_once('app/View.php');
require_once('app/Database.php');

require_once('routes.php');
require_once('views.php');

require_once('controllers/LoginController.php');
require_once('controllers/UserController.php');
require_once('controllers/SiteController.php');
require_once('controllers/AjaxController.php');
require_once('controllers/NumberController.php');

require_once('models/Model.php');
require_once('models/User.php');
require_once('models/Number.php');

?>