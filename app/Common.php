<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

/**
 * Server time zone, to satisfy PHP warning and to get consistent timestamps 
 */
define('TIMEZONE', 'America/New_York');
date_default_timezone_set(TIMEZONE);

if (strstr($_SERVER['SCRIPT_FILENAME'], 'feng')) {
  define('SITEROOT', 'http://localhost/~feng/playmas/');
}
else {
  define('SITEROOT', 'http://play.measong.com/');
}

define('BCRYPT_ITER', 10);

function validate($type, $value) {
  $value = trim($value);
  switch ($type) {
    case 'username':
      return ctype_alnum($value);
      break;
    case 'string':
      $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
      return true;
      break;
    case 'int':
      $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
      return filter_var($value, FILTER_VALIDATE_INT);
      break;
    case 'email':
      $value = filter_var($value, FILTER_SANITIZE_EMAIL);
      return filter_var($value, FILTER_VALIDATE_EMAIL);
      break;
    case 'url':
      $value = filter_var($value, FILTER_SANITIZE_URL);
      return filter_var($value, FILTER_VALIDATE_URL);
      break;
    default:
      throw new Exception("Unkown type '$type'");
      break;
  }
  return false;
}

function sanitize($type, &$value) {
  $value = trim($value);
  switch ($type) {
    case 'username':
      return $value;
      break;
    case 'string':
      $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
      return $value;
      break;
    case 'int':
      $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
      return $value;
      break;
    case 'email':
      $value = filter_var($value, FILTER_SANITIZE_EMAIL);
      return $value;
      break;
    case 'url':
      $value = filter_var($value, FILTER_SANITIZE_URL);
      return $value;
      break;
    default:
      throw new Exception("Unkown type '$type'");
      break;
  }
  return NULL;
}

/**
 * Returns the full url for a route
 *
 * @param string $route local relative route, e.g. inbox/new
 * @return string full url for route http://play.measong.com/inbox/new
 * @author Chi Feng
 */
function route($route) {
  return SITEROOT.$route;
}

function createSession($user) {      
  $_SESSION['username'] = $user->get('username');
  $_SESSION['display_name'] = $user->get('display_name');
  $_SESSION['id'] = $user->get('id');
}

function cryptHash($value) {
  require_once('app/Bcrypt.php');
  $bcrypt = new Bcrypt(BCRYPT_ITER);
  return $bcrypt->hash($value);
}

function cryptVerify($value, $hash) {
  require_once('app/Bcrypt.php');
  $bcrypt = new Bcrypt(BCRYPT_ITER);
  return $bcrypt->verify($value, $hash);
}

function errorHandler($errno, $errstr, $errfile, $errline) {

    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        return;
    }

    switch ($errno) {
      
    case E_USER_ERROR:
        echo "<b>ERROR</b> [$errno] $errstr<br />\n";
        echo "  Fatal error on line $errline in file $errfile";
        echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
        echo "Aborting...<br />\n";
        exit(1);
        break;

    case E_USER_WARNING:
        echo "<b>WARNING</b> [$errno] $errstr<br />\n";
        break;

    case E_USER_NOTICE:
        echo "<b>NOTICE</b> [$errno] $errstr<br />\n";
        break;

    default:
        echo "Unknown error type: [$errno] $errstr<br />\n";
        break;
        
    }

    return true;
}

set_error_handler('errorHandler');

?>