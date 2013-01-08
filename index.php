<?php

require_once('include/Common.php');
require_once('include/Database.php');

$db = new Database();
$db->connect('localhost', 'root', 'hicfneg12', 'playmas');

$count = $db->select('users', 'count', '1');

printf('<p>Number of rows in users: %d</p>', $count);

$result = $db->select('users', '*', '1');

printf('<p>Query returned %d rows and %d columns.</p>', $db->getRowCount(), $db->getFieldCount());

echo '<table><tr>';
foreach ($result[0] as $name=>$value)
  printf('<th>%s</th>', htmlspecialchars($name));
echo '</tr>';

foreach ($result as $row) {
  echo '<tr>';
  foreach ($row as $name=>$value)
    printf('<td>%s</td>', htmlspecialchars($value));
  echo '</tr>';
}
echo '</table>';

echo '<h2>Routing info</h2>';

echo '<pre>';
var_dump($_SERVER['REQUEST_METHOD']);
var_dump($_SERVER['REQUEST_URI']);
var_dump($_REQUEST);
echo '</pre>';

success('End of execution.');
exit();

?>