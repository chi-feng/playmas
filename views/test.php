<?php
echo '<h2>Routing info</h2>';

echo '<pre>';
var_dump($_SERVER['REQUEST_METHOD']);
var_dump($_SERVER['REQUEST_URI']);
var_dump($_REQUEST);
echo '</pre>';

?>