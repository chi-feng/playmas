<?php

require_once('./include/Common.php');
require_once('./include/Database.php');

$db = new Database();
$db->connect('localhost', 'root', 'hicfneg12', 'playmas');

success('End of execution.');
exit();

?>