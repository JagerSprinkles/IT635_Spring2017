#!/usr/bin/php

<?php
echo "Welcome to the Übertastic Auto Body Car and Part Tracker Thingy, or ÜABCPTT! \nType 'stop' by itself to exit at any time.\nPlease press enter to run the program!\n\n";

#$fp = fopen('php://stdin', 'r');
$stop = false;
#$input = '';
$menu = 0;
while (!$stop) {
#    $next_line = fgets($fp, 1024); 
	echo "start loop menu = ".$menu."\n";
	$next = trim(fgets(STDIN)); # read user input from keyboard
    if ($next == "stop") {
      $stop = true;
    } else {
    	switch ($menu) {
    		case '0': // first menu, login
    		echo "Type 'admin' to login to the admin account or press enter to login as read only access\n\n";
    		$next = trim(fgets(STDIN));
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
    		
    		case '1':
    			
    			break;
    	}
      #$input .= $next_line;
    }
    echo "end loop\n" . $next . "\n";
}
?>



