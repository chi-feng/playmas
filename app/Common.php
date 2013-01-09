<?php

define('TIMEZONE', 'America/New_York');
date_default_timezone_set(TIMEZONE);

define('SITEROOT', 'http://localhost/~feng/playmas/');

function fatal_error($errname, $details) {
  echo '<div class="error">';
  echo '<p><strong>' . $errname .'</strong></p>';
  echo '<p>' . $details . '</p>';
  echo '</div>';
  exit();
}

function success($message) {
  echo '<div class="success">';
  echo '<p><strong>Success!</strong></p>';
  echo '<p>' . $message . '</p>';
  echo '</div>';
}

function validate($value, $type, $options=NULL) {
  $value = trim($value);
  switch ($type) {
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

function route($route) {
  return SITEROOT.$route;
}

function href($route, $text) {
  return sprintf('<a href="%s">%s</a>', SITEROOT.$route, $text);
}

?>