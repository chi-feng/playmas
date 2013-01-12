<?php

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

/**
 * Display fatal error message and die
 *
 * @param string $errname name/category of the error
 * @param string $details details of the error
 * @return void
 * @author Chi Feng
 */
function fatal_error($errname, $details) {
  echo '<link href="'.route('css/screen.css').'" rel="stylesheet" type="text/css" media="screen" />';
  echo '<div class="error">';
  echo '<p><strong>' . $errname .'</strong></p>';
  echo '<p>' . $details . '</p>';
  echo '</div>';
  exit();
}

/**
 * Validate and Sanitize 
 *
 * @param string $value value to be sanitized
 * @param string $type type of validation to perform, e.g. alphanumeric, int
 * @param array $options additional options, e.g. min_length, max_length
 * @return array 'valid' => boolean, 'value' => sanitized value
 * @author Chi Feng
 */
function validate($value, $type, $options=NULL) {
  $value = trim($value);
  switch ($type) {
    case 'alphanumeric':
      return array(
        'valid' => ctype_alnum($value),
        'value' => $value);
      break;
    case 'string':
      $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
      return array(
        'valid'=>!empty($value),
        'value'=>$value);
      break;
    case 'int':
      $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
      return array(
        'valid'=>filter_var($value, FILTER_VALIDATE_INT),
        'value'=>$value);
      break;
    case 'email':
      $value = filter_var($value, FILTER_SANITIZE_EMAIL);
      return array(
        'valid'=>filter_var($value, FILTER_VALIDATE_EMAIL),
        'value'=>$value);
      break;
    case 'url':
      $value = filter_var($value, FILTER_SANITIZE_URL);
      return array(
        'valid'=>filter_var($value, FILTER_VALIDATE_URL),
        'value'=>$value);
      break;
    default:
      fatal_error('Common.validate', 'Unknown type '.$type);
  }
  return false;
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

?>