<?php

function fatal_error($errname, $details) {
  echo '<div style="clear:both;padding:1em;margin:1em;border:1px solid #f00;background:#fcc;">';
  echo '<p style="font-size:120%"><strong>' . htmlspecialchars($errname) .'</strong></p>';
  echo '<p style="font-size:90%>Details:</p>';
  echo '<p style="font-family:monospace">' . htmlspecialchars($details) . '</p>';
  echo '</div>';
  exit();
}

function success($message) {
  echo '<div style="clear:both;padding:1em;margin:1em;border:1px solid #0c0;background:#cfc;">';
  echo '<p style="font-size:120%"><strong>Success!</strong></p>';
  echo '<p style="font-size:90%>Details:</p>';
  echo '<p style="font-family:monospace">' . htmlspecialchars($message) . '</p>';
  echo '</div>';
}

?>