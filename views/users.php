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