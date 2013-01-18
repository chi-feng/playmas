<?php
  if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }
?>
<div id="content">
<?php

$users = $this->data['users'];

echo '<table>';
foreach ($users as $user) {
  printf('<tr><td>%s</td><td>%s</td></tr>',
  '<a href="'.route('users/'.$user['username']).'">'.$user['username'].'</a>',
  $user['email']);
}
echo '</table>';

?>

</div>