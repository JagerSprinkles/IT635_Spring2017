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

	public function getVehicles($lname)
	{
		if ($lname)
			$query = "select * from vehicles where `lname` = '".$lname."';";
		else
			$query = "select * from vehicles;";
		$queryResponse = $this->db->query($query);
		if ($lname)
			$response = "You have selected the entry for:\n";
		else
			$response = "Here is the current list of vehicles\nThey are listed by:\n".str_pad("First name",15)." | ".str_pad("Last name",15)." | ".str_pad("Make",15)." | ".str_pad("Model",15)." | Year | ".str_pad("Color",10)." | Notes\n";
		while($row = $queryResponse->fetch_assoc()) $response .= str_pad($row['fname'], 15)." | ".str_pad($row['lname'],15)." | ".str_pad($row['make'],15)." | ".str_pad($row['model'],15)." | ".$row['year']." | ".str_pad($row['color'],10)." | ".$row['notes']."\n";
		return $response;

	}

	public function addVehicle($fname,$lname,$make,$model,$year,$color,$notes)
	{
		$query = "insert into vehicles values (NULL,'".$fname."','".$lname."','".$make."','".$model."','".$year."','".$color."',DEFAULT,'".$notes."');";
		$queryResponse = $this->db->query($query);
	}

	public function getVehicleStatus($lname)
	{
		$query = "select * from vehicles where `lname` = '".$lname."';";
		$queryResponse = $this->db->query($query);
		return $queryResponse->fetch_array(MYSQLI_ASSOC);
	}

	public function getVehicleNotes($lname)
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

	public function setVehicleNotes($lname, $notes)
	{
		$query = "update vehicles set notes = '".$notes."' where lname = '".$lname."';";
		$queryResponse = $this->db->query($query);
		return $queryResponse;
	}
	public function getPartStock($col)
	{
		$query = "select part,stock from parts;";
		$queryResponse = $this->db->query($query);
		$response = "Here is the current stock of parts:\n";
		$flip='-';
		while($row = $queryResponse->fetch_assoc()){
			$response .= str_pad($row['part']."", $col - strlen($row['stock']), $flip ) . $row['stock']."\n";
			if ($flip == '-') $flip = '=';
			else $flip = '-';
		}
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

		$x = 0;
		$list = array();
		while($row = $queryResponse->fetch_assoc()) $list[$row['times_ordered']] = $row['part'];
		krsort($list);
		$out = "";
		$flip='-';
		foreach ($list as $key => $val){
			$out .= str_pad($val."s have been ordered", $col - strlen($key)-7, $flip).$key." times\n";
			if ($flip == '-') $flip = '=';
			else $flip = '-';
		}
		return $out;
	}


	public function removeVehicle($lname)
	{
		$query = "delete from vehicles where lname = '".$lname."';";
		$queryResponse = $this->db->query($query);
	}

	public function updatePartStock($part, $amount)
	{

		$query = "update parts set stock = '".$amount."' where part = '".$part."';";
		$queryResponse = $this->db->query($query);
	}

	public function getPartsInstalled($part)
	{
		try
		{
			$mdb = new MongoDB\Driver\Manager("mongodb://towel:thegame@ds163718.mlab.com:63718/it_635");	
			$command = new MongoDB\Driver\Command(['ping' => 1]);
			$mdb->executeCommand('db', $command);
			$servers = $mdb->getServers();
				//print_r($servers);
			$filter = array('part'=>$part);
			$query = new MongoDB\Driver\Query($filter);
			$results = $mdb->executeQuery("it_635.auto_body",$query);
				//print_r($results->toArray());
			$out = $results->toArray();

			$data = (get_object_vars($out['0']));

			$query = "select * from vehicles;";
			$queryResponse = $this->db->query($query);

			$x='';
			while($row = $queryResponse->fetch_assoc() )
			{

				if(array_key_exists($row['id'], $data))
				{
					$query2 = "select * from vehicles where id = '".$row['id']."';";
					$queryResponse2 = $this->db->query($query2);
					$vehicle = $queryResponse2->fetch_assoc();
					$x.="A ".$part." was installed on ".$row['lname']."'s vehicle on ".$data[$row['id']].".\n";
				}
			}
			return $x;
		}
		catch(exception $e)
		{
			print_r($e);
		}
	}

}
?>

