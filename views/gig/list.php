<?php
  if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }
?>
<div id="content">
<?php

$gigs = $this->data['gigs'];

echo '<pre>';
foreach ($gigs as $gig) {
  print_r($gig);
}
echo '</pre>';

?>

</div>
