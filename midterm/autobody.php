#!/usr/bin/php

<?php
echo "Welcome to the Übertastic Auto Body Car and Part Tracker Thingy, or ÜABCPTT! \nType 'stop' by itself to exit at any time.\n\n";


$stop = false;

$menu = 0;
while ("Tuesday") {
	echo "start loop menu = ".$menu."\n";
	switch ($menu) {
			case '0': // first menu, login
			echo "Type 'admin' to login to the admin account or press enter to login as the standard user\n\n";
			$next = trim(fgets(STDIN));
			if ($next == "stop") break;
			if ($next == "admin") {
				echo "Please enter admin password.\n";
				$pass = hash('sha256', trim(fgets(STDIN)));
				if ($pass == "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8"){
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
			echo "in menu 1\n";
			echo "Please type the number for the option you would like to choose\n1. Add vehicle to database.\n2. Check or update status of a vehicle.\n3. Schedule existing vehicle for repairs.\n4. Check stock levels on all parts.\n5. Order a part.\n6. Show the most ordered parts.\n\n";
			$next = trim(fgets(STDIN));
			if ($next == "stop") break;
			switch ($next) {
				case '1':
				echo "Please enter the customer's first name.\n";
				$fname = trim(fgets(STDIN));
				if ($fname == "stop") break;
				echo "Please enter the customer's last name.\n";
				$lname = trim(fgets(STDIN));
				if ($lname == "stop") break;
				echo "Please enter the vehicle's make.\n";
				$make = trim(fgets(STDIN));
				if ($make == "stop") break;
				echo "Please enter the vehicle's model.\n";
				$model = trim(fgets(STDIN));
				if ($model == "stop") break;
				echo "Please enter the vehicle's year.\n";
				$year = trim(fgets(STDIN));
				if ($year == "stop") break;
				echo "Please enter the vehicle's color.\n";
				$color = trim(fgets(STDIN));
				if ($color == "stop") break;
				echo $fname.$lname.$make.$model.$year.$color."\n";
					//insert into vehicle table here
				break;
				case '2':
				echo "Please enter the customer's last name to select their vehicle\n";
				$lname = trim(fgets(STDIN));
				if ($lname == "stop") break;
					// get cur stat of vehicle here
				echo "lastname's vehicle's status is currently XX.\nIf you would like to update the status please type update, otherwise press enter to return to the main menu\n";
				$next = trim(fgets(STDIN));
				if ($next == "stop") break;
				if ($next == "update"){
					echo "Please enter the new status of the vehicle:\n1. Needs estimate.\n2. Waiting for authorization to begin repairs.\n3. Waiting for parts\n4. Repairs underway!\n5. In paint shop\n6. In detail shop\n7. Ready for customer pickup.\n";
					$next = trim(fgets(STDIN));
					if ($next == "stop") break;
					switch ($next) {
						case '1':
							echo "update 1";
							break;
						case '2':
							echo "update 2";
							
							break;
						case '3':
							echo "update 3";
							
							break;
						case '4':
							echo "update 4";
							
							break;
						case '5':
							echo "update 5";
							
							break;
						case '6':
							echo "update 6";
							
							break;
						case '7':
							echo "update 7";
							
							break;

					}
				}else break;

				break;
				case '3':

				break;
				case '4':

				break;
				case '5':

				break;
				case '6':

				break;

			}
			break;

			case '69':
			echo "in menu 69\n";
			$next = trim(fgets(STDIN));
			if ($next == "stop") break;
			break;
		}
	  #$input .= $next_line;

		echo "end loop\n" . $next . "\n";
		if ($next == "stop") break;
	}
	?>



