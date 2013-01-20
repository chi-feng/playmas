<?php
  if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }
?>
<div id="content">
<?php

$requests = $this->data['requests'];

echo '<table>';
foreach ($requests as $request) {
  printf('<tr><td>%s</td><td>%s</td><td>%s</td></tr>',
  '<a href="'.route('users/'.$request['username']).'">'.$request['username'].'</a>',
  $request['body'],$request['from']);
}
echo '</table>';

?>

</div>
