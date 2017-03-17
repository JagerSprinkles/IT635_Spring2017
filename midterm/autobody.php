#!/usr/bin/php

<?php
require_once("bodyShopDB.inc");
system('clear');
echo "Welcome to the Übertastic Auto Body Car and Part Tracker Thingy, or ÜABCPTT! \nPress CTRL+c to exit at any time.\n\n";

$BSDB = new BodyShopAccess();
$menu = 0;
while ("Tuesday") {
	//echo "start loop menu = ".$menu."\n";
	switch ($menu) {
			case '0': // first menu, login
			echo "Type 'admin' to login to the admin account or press enter to login as the standard user\n\n";
			$next = trim(fgets(STDIN));
			if ($next == "admin") {
				echo "Please enter admin password.\n";
				$pass = hash('sha256', trim(fgets(STDIN)));
				if ($pass == "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8"){  //password
					echo "Admin login successful!\n";
					$menu = 69;
				} else {
					echo "Cannot login, did you forget your password?\nMaybe it was something like 'correct horse battery staple'.\n";
				}
			} else {
				$menu = 1;

			}
			break;
			
			case '1': //main menu
			system('clear');
			echo "-----Main Menu-----\nPlease type the number for the option you would like to choose:\n1. Add vehicle to database.\n2. Check or update status of a vehicle.\n3. Check stock levels on all parts.\n4. Order a part.\n5. Show the most ordered parts.\n\n";
			$next = trim(fgets(STDIN));
			switch ($next) {
				case '1': //Add vehicle to database
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
				echo "Please enter the vehicle's color.\n";
				$color = trim(fgets(STDIN));
				echo $fname.$lname.$make.$model.$year.$color."\n";
					//insert into vehicle table here
				break;

				case '2': //Check or update status of a vehicle
				system('clear');
				echo "Please enter the customer's last name to select their vehicle\n";
				$lname = trim(fgets(STDIN));// get cur stat of vehicle here
				//$BSDB = new BodyShopAccess();
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
							if ($BSDB->setVehicleStatus($lname,'Needs estimate')){
								$result = $BSDB->getVehicleStatus($lname);
								echo $result['fname']." ".$result['lname']."'s vehicle's status has been updated to '".$result['status']."'.\n";

							} else echo "There was an error somewhere, you shouldn't see this...\n";

							break;
							case '2':
							if ($BSDB->setVehicleStatus($lname,'Waiting for authorization to begin repairs')){
								$result = $BSDB->getVehicleStatus($lname);
								echo $result['fname']." ".$result['lname']."'s vehicle's status has been updated to '".$result['status']."'.\n";

							} else echo "There was an error somewhere, you shouldn't see this...\n";

							break;
							case '3':
							if ($BSDB->setVehicleStatus($lname,'Waiting for parts')){
								$result = $BSDB->getVehicleStatus($lname);
								echo $result['fname']." ".$result['lname']."'s vehicle's status has been updated to '".$result['status']."'.\n";

							} else echo "There was an error somewhere, you shouldn't see this...\n";

							break;
							case '4':
							if ($BSDB->setVehicleStatus($lname,'Repairs underway!')){
								$result = $BSDB->getVehicleStatus($lname);
								echo $result['fname']." ".$result['lname']."'s vehicle's status has been updated to '".$result['status']."'.\n";

							} else echo "There was an error somewhere, you shouldn't see this...\n";

							break;
							case '5':
							if ($BSDB->setVehicleStatus($lname,'In paint shop')){
								$result = $BSDB->getVehicleStatus($lname);
								echo $result['fname']." ".$result['lname']."'s vehicle's status has been updated to '".$result['status']."'.\n";

							} else echo "There was an error somewhere, you shouldn't see this...\n";

							break;
							case '6':
							if ($BSDB->setVehicleStatus($lname,'In detail shop')){
								$result = $BSDB->getVehicleStatus($lname);
								echo $result['fname']." ".$result['lname']."'s vehicle's status has been updated to '".$result['status']."'.\n";

							} else echo "There was an error somewhere, you shouldn't see this...\n";

							break;
							case '7':
							if ($BSDB->setVehicleStatus($lname,'Ready for customer pickup')){
								$result = $BSDB->getVehicleStatus($lname);
								echo $result['fname']." ".$result['lname']."'s vehicle's status has been updated to '".$result['status']."'.\n";

							} else echo "There was an error somewhere, you shouldn't see this...\n";

							break;

						}
						echo "Please press enter to return to the main menu.\n";
						trim(fgets(STDIN));
					}else break;
				}
				else echo "Customer '".$lname."' not found, returning to the main menu.\n\n";

				break;

				case '3': //Check stock levels on all parts
				system('clear');
				echo $BSDB->getPartStock()."\nPlease press enter to return to the main menu.\n";
				trim(fgets(STDIN));
				break;


				case '4': //Order a part
				echo "Please choose the part you would like to order:\n1. Front bumper.\n2. Rear bumper.\n3. Fender.\n4. Quarter panel.\n5. Hood.\n6. Front door.\n7. Rear door.\n8. Headlight.\n9. Taillight.\n\n";
				$next = trim(fgets(STDIN));
				switch ($next) {
					case '1':
					
					break;
					case '2':
					
					break;
					case '3':
					
					break;
					case '4':
					
					break;
					case '5':
					
					break;
					case '6':
					
					break;
					case '7':
					
					break;
					case '8':
					
					break;
					case '9':
					
					break;

				}
				break;
				case '5': //Show the most ordered parts

				break;

			}
			break;

			case '69':
			echo "You can type SQL statements here and they will be sent to the database. Any output will be displayed here after the command runs.";
			$next = trim(fgets(STDIN));

			break;
		}
	  #$input .= $next_line;

		//echo "end loop\n" . $next . "\n";
	}
	?>



