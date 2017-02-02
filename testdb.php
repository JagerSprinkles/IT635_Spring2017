#!/usr/bin/php

<?php

require_once("studentDB.inc");

echo "executing script: ".$argv[0].PHP_EOL;


$studentDB = new StudentAccess("classes");

$students = $studentDB->getStudentRecords();

echo "student records in db are:".PHP_EOL;
print_r($students);
echo $argv[0]." complete".PHP_EOL;


?>