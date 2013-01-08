<?php

define('TIMEZONE', 'America/New_York');
date_default_timezone_set(TIMEZONE);

function fatal_error($errname, $details) {
  echo '<div class="error">';
  echo '<p><strong>' . htmlspecialchars($errname) .'</strong></p>';
  echo '<p>' . htmlspecialchars($details) . '</p>';
  echo '</div>';
  exit();
}

function success($message) {
  echo '<div class="error">';
  echo '<p><strong>Success!</strong></p>';
  echo '<p>' . htmlspecialchars($message) . '</p>';
  echo '</div>';
}

?>