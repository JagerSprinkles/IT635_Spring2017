<?php

class BodyShopAccess
{
private $db;

public function __construct()
{
	$this->db = new mysqli("localhost","root","12345","Body_Shop");
	if ($this->db->connect_errno != 0)
	{
		echo "Error connecting to databse: ".$this->db->connect_error.PHP_EOL;
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

public function getVehicleStatus($lname)
{
	$query = "select * from vehicles where `lname` = '".$lname."';";
	$queryResponse = $this->db->query($query);
	$response = $queryResponse->fetch_array(MYSQLI_ASSOC);
	return $response;
}

public function setVehicleStatus($lname, $status)
{
	$query = "update vehicles set status = '".$status."' where lname = '".$lname."';";
	echo "QQQ".$query."\n";
	$queryResponse = $this->db->query($query);
	return $queryResponse;
}

// public function addStudentRecord($studentName,$studentid,$studentaddress,$studentyear)
// {
// 	$sn = $this->db->real_escape_string($studentName);
// 	$id = $this->db->real_escape_string($studentid);
// 	$address = $this->db->real_escape_string($studentaddress);
// 	$year = $this->db->real_escape_string($studentyear);
// 	echo "before escape:\n\"$studentyear\"\n";
// 	echo "after escape:\n$year\n";
// 	$query = "insert into class(student,ID,address,year) VALUES ('$sn','$id','$address',$year);";

// 	echo "executing SQL statement:\n".$query."\n";
// 	if (!$this->db->query($query))
// 	{
// 		echo "failed to insert record for $studentName".PHP_EOL;
// 	}
// }

// public function validateUser($username,$password)
// {
// 	$un = $this->db->real_escape_string($username);
// 	$pw = $this->db->real_escape_string($password);

// 	$query = "select * from users where username = '$un';";
// 	$result = $this->db->query($query);

// 	while ($row = $result->fetch_assoc())
// 	{
// 		if ($row["password"] == $pw)
// 		{
// 			// I have a match
// 			return true;
// 		}
// 	}
// 	return false;
// }

}
?>

