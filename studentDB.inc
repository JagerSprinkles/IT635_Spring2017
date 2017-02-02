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

public function addStudentRecord($studentName,$id,$address,$year)
{
	//sanitize input
	//$studentName = mysqli_real_escape_string($studentName);

	$query = "insert into class(student,ID,address,year) VALUES ('$studentName','$id','$address',$year);";

	echo "executing SQL statement:\n".$query."\n";
	if (!$this->db->query($query))
	{
		echo "failed to insert record for $studentName".PHP_EOL;
	}
}
}

?>
