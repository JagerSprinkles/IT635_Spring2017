#!/usr/bin/php

<?php

$db = new mysqli("localhost" , "root" , "12345" , "classes");

if($db->connect_errno != 0)
{
	echo "Error Connecting to Database" . $db->connect_error.PHP_EOL;
	exit();

}

echo "Connection Success!".PHP_EOL.PHP_EOL;

$query = "select * from class;";

$db->query($query);





$db->close();


echo "Program Complete".PHP_EOL;





?>