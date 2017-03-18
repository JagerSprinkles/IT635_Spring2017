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

public function addVehicle($fname,$lname,$make,$model,$year,$color)
{
	$query = "insert into vehicles values (NULL,'".$fname."','".$lname."','".$make."','".$model."','".$year."','".$color."',DEFAULT);";
	$queryResponse = $this->db->query($query);
}

public function getVehicleStatus($lname)
{
	$query = "select * from vehicles where `lname` = '".$lname."';";
	$queryResponse = $this->db->query($query);
	return $queryResponse->fetch_array(MYSQLI_ASSOC);
}

public function setVehicleStatus($lname, $status)
{
	$query = "update vehicles set status = '".$status."' where lname = '".$lname."';";
	$queryResponse = $this->db->query($query);
	return $queryResponse;
}

public function getPartStock($col)
{
	$query = "select part,stock from parts;";
	$queryResponse = $this->db->query($query);
	$response = "Here is the current stock of parts:\n";
	while($row = $queryResponse->fetch_assoc()) $response .= str_pad($row['part']." ", $col - strlen($row['stock']) ) . $row['stock']."\n";
	return $response;
}

public function orderPart($part, $amount)
{

	$query = "select * from parts where part = '".$part."';";
	$queryResponse = $this->db->query($query);
	$selectedPart = $queryResponse->fetch_array(MYSQLI_ASSOC);
	$query = "update parts set stock = '".($selectedPart['stock']+$amount)."' where part = '".$part."';";
	$queryResponse = $this->db->query($query);
	$query = "update parts set times_ordered = '".($selectedPart['times_ordered']+$amount)."' where part = '".$part."';";
	$queryResponse = $this->db->query($query);
	$query = "select part,stock from parts where part = '".$part."';";
	$queryResponse = $this->db->query($query);
	$selectedPart = $queryResponse->fetch_array(MYSQLI_ASSOC);
	return $selectedPart['stock'];
}

public function getMostOrdered($col)
{
	$query = "select part,times_ordered from parts;";
	$queryResponse = $this->db->query($query);
	//$response = "Here is the current stock of parts:\n";
	$x = 0;
	$list = array();
	while($row = $queryResponse->fetch_assoc()) $list[$row['times_ordered']] = $row['part'];
	krsort($list);
	$out = "";
	foreach ($list as $key => $val) $out .= str_pad($val."s have been orderd ", $col - strlen($key)-7).$key." times.\n";
	return $out;
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

