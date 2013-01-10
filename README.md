View at http://107.21.217.140/playmas/

TODO: 
make a route /users/ that will list all users and their email addresses in a table
(use same method as registration_form that passes information from the controller to the view)

To get multiple rows 
$rows = $db->select('users', array('username', 'email'), '1'); 
foreach ($rows as $row) {
  $row['username'];
  $row['email'];
}

make form to create requests to see if they get added to the database correctly. 
implement relevant methods in RequestController to handle requests made from the form 


