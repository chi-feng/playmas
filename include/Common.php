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

function validate($value, $type) {
  
}

function route($route) {
  return SITEROOT.$route;
}

function href($route, $text) {
  return sprintf('<a href="%s">%s</a>', SITEROOT.$route, $text);
}

?>