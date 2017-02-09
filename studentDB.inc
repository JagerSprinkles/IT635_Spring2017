<?php

class StudentAccess
{
private $db;

public function __construct($database)
{
	$this->db = new mysqli("localhost","root","12345",$database);
	if ($this->db->connect_errno != 0)
	{
		echo "error connecting to databse: ".$this->db->connect_error.PHP_EOL;
		exit();
	}
}

public function __destruct()
{
	if (isset($this->db))
	{
		$this->db->close();
	}
}

public function getStudentRecords()
{
	$query = "select * from class;";

	$queryResponse = $this->db->query($query);
	$response = array();
	while($row = $queryResponse->fetch_assoc())
	{
		$response[] = $row;
	}
	return $response;
}

public function addStudentRecord($studentName,$studentID,$studentaddress,$studentyear)
{
	//sanitize input
	$sn = $this->db->real_escape_string($studentName);
	$id = $this->db->real_escape_string($studentID);
	$address = $this->db->real_escape_string($studentaddress);
	$year = $this->db->real_escape_string($studentyear);
	//echo "before escape:\n$studentyear\n";
	//echo "after escape:\n$year\n

	$query = "insert into class(student,ID,address,year) VALUES ('$sn','$id','$address',$year);";

	echo "executing SQL statement:\n".$query."\n";
	if (!$this->db->query($query))
	{
		echo "failed to insert record for $studentName".PHP_EOL;
	}
}
}


public function validateUser($username,$password){
	$un = $this->db->real_escape_string($username);
	$pw = $this->db->real_escape_string($password);

	$query = "select * from users where username = '$un'";
	$result = $this->db->query($query);

	while ($row = $result->fetch_assoc()){
		if ($row["password"] == $pw){
			//there is a match
			return true;
		}
	}
	return false;
}


?>
