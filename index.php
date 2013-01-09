<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<link href="css/screen.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="content">
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

$fields = array(
  array(
    'name' => 'username',
    'type' => 'string',
    'value' => 'yes'
    ),
  array(
    'name' => 'email',
    'type' => 'string',
    'value' => 'yes'
    ),
  array(
    'name' => 'passwordhash',
    'type' => 'string',
    'value' => 'yes'
    ),
  array(
    'name' => 'number',
    'type' => 'int',
    'value' => '0'
    ),
  array(
    'name' => 'cred',
    'type' => 'int',
    'value' => '0'
    ),
  array(
    'name' => 'created',
    'type' => 'int',
    'value' => time()
    ),
  array(
    'name' => 'status',
    'type' => 'int',
    'value' => '1'
    )   
);

$id = $db->insert('users', $fields); 

printf('<p>Insert user, got id %d.</p>', $id);

echo '<h2>Routing info</h2>';

echo '<pre>';
var_dump($_SERVER['REQUEST_METHOD']);
var_dump($_SERVER['REQUEST_URI']);
var_dump($_REQUEST);
echo '</pre>';

success('End of execution.');
exit();

?>
</div>
</body>
</html>