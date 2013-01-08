<?php

function fatal_error($errname, $details) {
  echo '<div style="clear:both;padding:1em;margin:1em;border:1px solid #f00;background:#fcc;">';
  echo '<p><strong>' . htmlspecialchars($errname) .'</strong></p>';
  echo '<p>' . htmlspecialchars($details) . '</p>';
  echo '</div>';
  exit();
}


?>