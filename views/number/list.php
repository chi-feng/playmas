<?php
  if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }
?>
<div id="content">
<?php

$numbers = $this->data['numbers'];

echo '<table>';
foreach ($numbers as $number) {
  printf('<tr><td>%s</td><td>%s</td></tr>',
  '<a href="'.route('users/'.$number['username']).'">'.$number['username'].'</a>',
  $number['number']);
}
echo '</table>';

?>

</div>
