#!/usr/bin/php

<?php
require_once("bodyShopDB.inc");
system('clear');


$q = 113;
$col = exec('tput cols');


// if ($col < 120) $x = 150; else $x = $col;

// for ($x; $x >= 0 ; $x--) { 

// 	$banner = substr("Welcome to the Übertastic Auto Body Vehicle and Part Tracker Thingy, or ÜABVPTT! \nPress CTRL+c to exit at any time.\n\n", $q);
// 	if ($q > 0) $q--;
// 	$space = "";
// 	for ($y = $col - $q; $y > 0 ; $y--) { 
// 		$space .= " ";

// 	}
// 	system('clear');
// 	if ($x < 37) $space = "";
// 	echo $space.$banner;
// 	usleep(25000);
// }


system('clear');

$pad = "";
for ($i=0; $i < exec('tput cols'); $i++) { 
	$pad .= "-=";
}
echo "Welcome to the Übertastic Auto Body Vehicle and Part Tracker Thingy, or ÜABVPTT! \nPress CTRL+c to exit at any time.\nPlease press enter to get started!\n\n";
trim(fgets(STDIN));
$BSDB = new BodyShopAccess();
$menu = 1;
while ("Tuesday") {

	switch ($menu) {
		case '0': // first menu, login
		
		system('clear');
		
		echo "Please enter admin password.\n";
		$pass = hash('sha256', trim(fgets(STDIN)));
		system('clear');
			if ($pass == "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8"){  //password
				echo "Admin login successful!\n";
				$menu = 69;
			} else {
				echo "Cannot login, did you forget your password?\nMaybe it was something like 'correct horse battery staple'?\nPress enter to try again or enter any text to return to the main menu.\n";
				$next = trim(fgets(STDIN));
				if ($next) $menu = 1;

			}
			break;

		case '1': //main menu
		system('clear');
		echo str_pad("Main Menu", exec('tput cols'), "=", STR_PAD_BOTH);
		echo "\nPlease type the number for the option you would like to choose:\n1. Get current vehicle list.\n2. Add vehicle to database.\n3. Check or update status of a vehicle.\n4. Check or update the notes on a vehicle.\n5. Check stock levels on all parts.\n6. Order a part.\n7. Show the most ordered parts.\n8. Check which parts were installed on what vehicles.\n9. Enter the date when a part was installed on a vehicle.\n10. Access admin menu.\n11. Exit.\n\n";
		$next = trim(fgets(STDIN));
		switch ($next) {
			case '1':
			system('clear');
			echo $BSDB->getVehicles(NULL);
			echo "\nPlease press enter to return to the main menu.\n";
			trim(fgets(STDIN));
			break;
			case '2': //Add vehicle to database
			system('clear');
			echo "Please enter the customer's first name.\n";
			$fname = trim(fgets(STDIN));
			echo "Please enter the customer's last name.\n";
			$lname = trim(fgets(STDIN));
			echo "Please enter the vehicle's make.\n";
			$make = trim(fgets(STDIN));
			echo "Please enter the vehicle's model.\n";
			$model = trim(fgets(STDIN));
			echo "Please enter the vehicle's year.\n";
			$year = trim(fgets(STDIN));
			if (strlen($year) != 4) $year = 'THE GAME';
			while (!is_numeric($year)) {
				echo "That was not a valid year, please enter a four digit integer for the year.\n";
				$year = trim(fgets(STDIN));
				if (strlen($year) != 4) $year = 'THE GAME';
			}
			echo "Please enter the vehicle's color.\n";
			$color = trim(fgets(STDIN));

			echo "Please enter any notes about the vehicle.\n";
			$notes = trim(fgets(STDIN));

			$BSDB->addVehicle($fname,$lname,$make,$model,$year,$color,$notes);
			echo "\n".$fname." ".$lname."'s vehicle has been added to the database.\n\n";
			echo "Please press enter to return to the main menu.\n";
			trim(fgets(STDIN));
			break;

			case '3': //Check or update status of a vehicle
			system('clear');
			echo "Please enter the customer's last name to select their vehicle\n";
			$lname = trim(fgets(STDIN));// get cur stat of vehicle here
			
			$result = $BSDB->getVehicleStatus($lname);
			system('clear');
			if ($result['fname']){
				echo $result['fname']." ".$result['lname']."'s vehicle's status is currently '".$result['status']."'.\nIf you would like to update the status please type 'update', otherwise press enter to return to the main menu\n\n"; 
				$next = trim(fgets(STDIN));
				if ($next == "update"){
					system('clear');
					echo "Please enter the new status of the vehicle:\n1. Needs estimate.\n2. Waiting for authorization to begin repairs.\n3. Waiting for parts.\n4. Repairs underway!\n5. In paint shop.\n6. In detail shop.\n7. Ready for customer pickup.\n\n";
					$next = trim(fgets(STDIN));
					system('clear');
					switch ($next) {
						case '1':
						$BSDB->setVehicleStatus($lname,'Needs estimate');
						break;
						case '2':
						$BSDB->setVehicleStatus($lname,'Waiting for authorization to begin repairs');
						break;
						case '3':
						$BSDB->setVehicleStatus($lname,'Waiting for parts');
						break;
						case '4':
						$BSDB->setVehicleStatus($lname,'Repairs underway!');
						break;
						case '5':
						$BSDB->setVehicleStatus($lname,'In paint shop');
						break;
						case '6':
						$BSDB->setVehicleStatus($lname,'In detail shop');
						break;
						case '7':
						$BSDB->setVehicleStatus($lname,'Ready for customer pickup');
						break;
					}
					$result = $BSDB->getVehicleStatus($lname);
					echo $result['fname']." ".$result['lname']."'s vehicle's status has been updated to '".$result['status']."'.\n\n";
					echo "Please press enter to return to the main menu.\n";
					
				}else break;
			}
			else echo "Customer '".$lname."' not found, please press enter to return to the main menu.\n\n";
			trim(fgets(STDIN));
			break;


			case '4': //Check or update notes of a vehicle
			system('clear');
			echo "Please enter the customer's last name to select their vehicle\n";
			$lname = trim(fgets(STDIN));
			
			$result = $BSDB->getVehicleNotes($lname);
			system('clear');
			if ($result['fname']){
				echo $result['fname']." ".$result['lname']."'s vehicle's notes are currently '".$result['notes']."'.\nIf you would like to update the notes please type 'update', otherwise press enter to return to the main menu\n\n"; 
				$next = trim(fgets(STDIN));
				if ($next == "update"){
					system('clear');
					echo "Please enter the new notes for the vehicle, any existing notes will be overwritten.\n\n";
					$notes = trim(fgets(STDIN));
					$BSDB->setVehicleNotes($lname,$notes);

					system('clear');
					$result = $BSDB->getVehicleNotes($lname);
					echo $result['fname']." ".$result['lname']."'s vehicle's notes have been updated to '".$result['notes']."'.\n\n";
					echo "Please press enter to return to the main menu.\n";
					
				}else break;
			}
			else echo "Customer '".$lname."' not found, please press enter to return to the main menu.\n\n";
			trim(fgets(STDIN));
			break;






			case '5': //Check stock levels on all parts
			system('clear');
			echo $BSDB->getPartStock(exec('tput cols'))."\nPlease press enter to return to the main menu.\n";
			trim(fgets(STDIN));
			break;


			case '6': //Order a part
			system('clear');
			echo "Please choose the part you would like to order.\nInstant delivery is guaranteed!\n\n1. Front bumper.\n2. Rear bumper.\n3. Fender.\n4. Quarter panel.\n5. Hood.\n6. Front door.\n7. Rear door.\n8. Headlight.\n9. Taillight.\n\n";
			$next = trim(fgets(STDIN));
			$part = "";
			switch ($next) {
				case '1':
				$part = "Front Bumper";
				break;
				case '2':
				$part = "Rear Bumper";
				break;
				case '3':
				$part = "Fender";
				break;
				case '4':
				$part = "Quarter Panel";
				break;
				case '5':
				$part = "Hood";
				break;
				case '6':
				$part = "Front Door";
				break;
				case '7':
				$part = "Rear Door";
				break;
				case '8':
				$part = "Headlight";
				break;
				case '9':
				$part = "Taillight";
				break;
			}
			echo "How many ".$part."s would you like to order?\n";
			$amount = trim(fgets(STDIN));
			if (!is_numeric($amount)) $amount = 'THE GAME';
			while (!is_numeric($amount)) {
				echo "That was not a number, please try again.\n";
				$amount = trim(fgets(STDIN));
				if (!is_numeric($amount)) $amount = 'THE GAME';
			}
			$stock = $BSDB->orderPart($part,$amount);
			system('clear');
			echo "The new stock level of ".$part."s is ".$stock.".\n\n";
			echo "Please press enter to return to the main menu.\n";
			trim(fgets(STDIN));
			
			break;
			case '7': //Show the most ordered parts
			system('clear');
			echo $BSDB->getMostOrdered(exec('tput cols'));
			echo "\nPlease press enter to return to the main menu.\n";
			trim(fgets(STDIN));
			break;

			case '8':
			system('clear');
			echo "Please select the part to see what vehicles it was installed on:\n\n1. Front bumper.\n2. Rear bumper.\n3. Fender.\n4. Quarter panel.\n5. Hood.\n6. Front door.\n7. Rear door.\n8. Headlight.\n9. Taillight.\n\n";
			$next = trim(fgets(STDIN));
			$part = "";
			switch ($next) {
				case '1':
				$part = "Front Bumper";
				break;
				case '2':
				$part = "Rear Bumper";
				break;
				case '3':
				$part = "Fender";
				break;
				case '4':
				$part = "Quarter Panel";
				break;
				case '5':
				$part = "Hood";
				break;
				case '6':
				$part = "Front Door";
				break;
				case '7':
				$part = "Rear Door";
				break;
				case '8':
				$part = "Headlight";
				break;
				case '9':
				$part = "Taillight";
				break;
			}

			$out = $BSDB->getPartsInstalled($part);
			system('clear');
			echo $out;
			echo "\n\nPlease press enter to return to the main menu.\n";
			trim(fgets(STDIN));
			break;

			case '9':
			system('clear');
			echo "Please enter the customer's last name to select their vehicle\n";
			$lname = trim(fgets(STDIN));
			system('clear');
			echo "Please select the part to enter the date it was installed on the vehicle:\n\n1. Front bumper.\n2. Rear bumper.\n3. Fender.\n4. Quarter panel.\n5. Hood.\n6. Front door.\n7. Rear door.\n8. Headlight.\n9. Taillight.\n\n";
			$next = trim(fgets(STDIN));
			$part = "";
			switch ($next) {
				case '1':
				$part = "Front Bumper";
				break;
				case '2':
				$part = "Rear Bumper";
				break;
				case '3':
				$part = "Fender";
				break;
				case '4':
				$part = "Quarter Panel";
				break;
				case '5':
				$part = "Hood";
				break;
				case '6':
				$part = "Front Door";
				break;
				case '7':
				$part = "Rear Door";
				break;
				case '8':
				$part = "Headlight";
				break;
				case '9':
				$part = "Taillight";
				break;
			}
			system('clear');
			echo "Please enter the date the part was installed\n";
			$date = trim(fgets(STDIN));
			$BSDB->installPart($lname,$part,$date);
			trim(fgets(STDIN));

			break;

			case '10':
			$menu = 0;
			break;


			case '11':
			goto VELOCIRAPTOR_ATTACK; //  https://xkcd.com/292/
			break;



		}
		break;












		case '69':
		system('clear');
		echo str_pad("Admin Menu", exec('tput cols'), "|", STR_PAD_BOTH);
		echo "\nPlease type the number for the option you would like to choose:\n1. Remove customer from database.\n2. Update part stock.\n3. Return to main menu.\n\n";
		$next = trim(fgets(STDIN));

		switch ($next) {
			case '1':
			system('clear');
			echo "Please enter the last name of the customer you would like to remove.\n\n";
			$lname = trim(fgets(STDIN));
			echo $BSDB->getVehicles($lname);
			echo "If you would like to remove the entry listed above please type 'remove' otherwise press enter to return to the admin menu.\n\n";
			$next = trim(fgets(STDIN));
			if ($next == 'remove') {
				$BSDB->removeVehicle($lname);
				echo "Entry removed from database, please press enter to return to the admin menu.\n";
				trim(fgets(STDIN));
			}
			break;
			
			case '2':
			system('clear');
			echo "Please choose the part you would update the stock level for.\n\n1. Front bumper.\n2. Rear bumper.\n3. Fender.\n4. Quarter panel.\n5. Hood.\n6. Front door.\n7. Rear door.\n8. Headlight.\n9. Taillight.\n\n";
			
			$part = trim(fgets(STDIN));
			switch ($part) {
				case '1':
				$part = "Front Bumper";
				break;
				case '2':
				$part = "Rear Bumper";
				break;
				case '3':
				$part = "Fender";
				break;
				case '4':
				$part = "Quarter Panel";
				break;
				case '5':
				$part = "Hood";
				break;
				case '6':
				$part = "Front Door";
				break;
				case '7':
				$part = "Rear Door";
				break;
				case '8':
				$part = "Headlight";
				break;
				case '9':
				$part = "Taillight";
				break;
			}
			
			echo "What would you like to set the new stock level for ".$part."s?\n";
			$amount = trim(fgets(STDIN));
			if (!is_numeric($amount)) $amount = 'THE GAME';
			while (!is_numeric($amount)) {
				echo "That was not a number, please try again.\n";
				$amount = trim(fgets(STDIN));
				if (!is_numeric($amount)) $amount = 'THE GAME';
			}
			$BSDB->updatePartStock($part,$amount);
			echo "Stock level updated successfully! Please press enter to return to the admin menu.\n";
			trim(fgets(STDIN));
			break;

			case '3':
			$menu = 1;
			break;
		}

		break;
	}

}
VELOCIRAPTOR_ATTACK:
system('clear');
exit();
?>



