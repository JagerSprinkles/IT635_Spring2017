<?php

require_once("../include/studentDB.inc");




if(!isset($_POST)){
	echo "error: expected POST data";
	exit(1);
}
if (!isset($_POST["type"])){
	echo "error: no type specified";
	exit(2);
}
$response = "unsupported request type";
switch ($_POST["type"]) {
	case "authenticate":
		$response = "lets do some authentication";

		//$auth = 

		break;
	
}

echo $response;

?>
