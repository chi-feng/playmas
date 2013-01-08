<?php

require_once('include/Common.php');
require_once('include/Database.php');

$db = new Database();
$db->connect('localhost', 'root', 'hicfneg12', 'playmas');

$count = $db->select('users', 'count', '1');

echo '<p>Number of rows in users: ' . $count . '</p>';

success('End of execution.');
exit();

?>