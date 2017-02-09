#!/usr/bin/php

<?php

require_once("studentDB.inc");


for ($i = 1; $i < $argc; $i++){
	switch ($argv[$i]) {
		case "--auth":
			$action = "auth";
			break;

		case "-u":
			$username = $argv[$i + 1];
			$i++;
			break;
		
		case '-p':
			$password = $argv[$i + 1];
			$i++;
			break;
	}
}

switch ($action) {
	case 'auth':
		if (!isset($username)){
			echo "please provide a username with -u <username>".PHP_EOL
		}
		$studentDB = new StudentAccess("Classes");
		if ($studentDB->validateUser($username,$password) == false){
			echo "login failed!".PHP_EOL;
		}else{
			echo "login successful".PHP_EOL;
		}

		break;
	
	default:
		echo "No action specified, exiting".PHP_EOL;
		exit (1);
		break;
}

if ($action == NULL){
	
}

/*
echo "executing script: ".$argv[0].PHP_EOL;
$studentName = $argv[1];
$studentID = $argv[2];
$studentAddress = $argv[3];
$studentYear = $argv[4];

$studentDB = new StudentAccess("Classes");

$studentDB->addStudentRecord(
	$studentName,
	$studentID,
	$studentAddress,
	$studentYear
);

$studentDB = new StudentAccess("Classes");

$students = $studentDB->getStudentRecords();

echo "student records in db are:".PHP_EOL;
print_r($students);
*/

echo $argv[0]." complete".PHP_EOL;

?>
