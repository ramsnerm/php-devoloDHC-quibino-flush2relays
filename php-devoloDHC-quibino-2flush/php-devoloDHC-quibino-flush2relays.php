#!/usr/bin/php
<?php
	// NAME: 	php-devoloDHC-quibino-flush2relays.php
	// VERSION:	v0.1 (2017-09-22)
	//
	// Copyright (c) 2017 ramsnerm
  //
	// DESCRIPTION
	//   A simple php script to operate the Qubino Flush 2 relays per contact and therfore to enable an implementation
 	//   in other scripts and/or home automation systems like ha-bridge (hue bridge emulator) or homebridge (homekit bridge).
	//
	// REQUIREMENTS
	//   - php API for Devolo Home Control (https://github.com/KiboOst/php-devoloDHC)
	//   - PHP v5+
	//   - The script require internet access (it will authenticate against Devolo servers) if it fails local.

  // Include Devolo API php class from KiboOst
	// Configure the path to the location where you have stored the DHC php API
	require($_SERVER['DOCUMENT_ROOT']."/dhc-php-api/phpDevoloAPI.php");
	require($_SERVER['DOCUMENT_ROOT']."/dhc-php-api/localphpdevoloAPI.php");

	// Configuration to access Devolo Bridge (DHC)
	// Change the values according to your environment.
        $login 		= "<ENTER YOUR YOUR LOGIN E-MAIL ADDRESS>";
        $password = "<ENTER YOUR YOUR LOGIN PASSWORD>";
        $localIP 	= "<ENTER YOUR YOUR DHC LOCAL IP ADDRESS>";
        $uuid 		= "<ENTER YOUR DHC UUID STRING>";
        $gateway 	= "<ENTER YOUR DHC GATEWAY ID>";
        $passkey 	= "<ENTER YOUR DHC PASSKEY>";

	// Welcome message
	echo "Starting CLI better control Qubino 2 Flush relays with the DHC php API ...\n";
	echo "\n";

	// Check command line arguemnts ...
	if ( $argc == 4 && ( $argv[3] == "on" || $argv[3] == "off" ) && $argv[1] >= 0 && $argv[1] <= 2 ) {
		// Set variables with command line arguments
    		$device=$argv[1];
    		$command=$argv[3];
	    	$contact=$argv[2];
	}
	else {
		echo "ERROR: Unkown arguments received!\n";
                echo "\n";
		echo "Usage: ./" . basename(__FILE__) . " [device name] [contact number] [action]\n";
		echo "\n";
		echo "  [device name]\n";
		echo "    DHC Name of the Qubino Flush 2 Relays.\n";
		echo "    The related DHC scenes must begin with the devicename.\n";
		echo "\n";
		echo "  [contact number]\n";
		echo "    The Contact number to be controlled:\n";
		echo "      0: Relay contact 1 & 2\n";
		echo "      1: Relay contact 1\n";
		echo "	    2: Relay Contact 2\n";
		echo "\n";
		echo "    The related DHC scenes must containt the number beginning with a '#'.\n";
		echo "\n";
		echo "  [action]\n";
		echo "    on:  Set the given relay contact to on\n";
		echo "    off: Set the given relay contact to off\n";
		echo "\n";
		echo "    The related DHC scenes must end with on, off depending on the DHC rule function\n";
		echo "\n";
		echo "\n";
		echo "Example: ./" . basename(__FILE__) . " \"living room\" 1 on\n";
		echo "\n";
		echo "    This will switch on the relay contact number 1 of the DHC Living Room device.\n";
		echo "    The CLI will call the DHC scene \"living room #1 on\"\n";
		echo "\n";
		echo "Version:\n";
		echo "    v0.1 (2017-09-22)";
		echo "\n";
		exit(-1);
	}

	// Connect to Devolo Home Control Center (DHC)
	$DHC = new DevoloDHC($login, $password, $localIP, $uuid, $gateway, $passkey, false);	// First we try a local connection
	if (isset($DHC->error)) {
		$DHC = new DevoloDHC($login, $password); 					// As fallback we try www connection
		if (isset($DHC->error)) {
			print $DHC->error; print "\n";
			exit(-2);
		}
	}

	// Check if the device exists/is detected as Quibino 2Flush relay
	$device_data = $DHC->getDeviceStates($device);

	if (  $device_data["result"][0]["sensorType"] != "BinarySwitch" || $device_data["result"][2]["sensorType"] != "BinarySwitch" ) {
		echo "ERROR: Device \"{$device}\" not detected as proper Qubino Flush 2 Relay!\n";
		exit(-3);
	}

	// Now we store the relay contact states
	$relay_contact_state[1] = $device_data["result"][0]["state"];
	$relay_contact_state[2] = $device_data["result"][2]["state"];

	// Define the requries scene definition from current states and request by CLI
	$required_status =  ($command == "on") ? "1" : "0";

	if	( $contact == "0" ) $required_status = "{$required_status}{$required_status}";
	elseif 	( $contact == "1" ) $required_status = "{$required_status}{$relay_contact_state[2]}";
	else 			    $required_status = "{$relay_contact_state[1]}{$required_status}";

	// Start the scene based on the requested status
	switch ($required_status) {
		case "00":
		case "11":
			$result = $DHC->startScene($device . " all " . $command );
			if ( $result['result'] != "true" ) {
				echo "ERROR: Scene \"{$device} all {$command}\" not found!";
				exit(-4);
			}
			break;

		case "01":
		case "10":
                        $result = $DHC->startScene($device . " #" . $contact . " " . $command );
                        if ( $result['result'] != "true" ) {
                                echo "ERROR: Scene \"{$device} #{$contact} {$command}\" not found!";
                                exit(-4);
                        }
			break;
	}

	// Everthing looks fine so we use standard exit
	echo "Requested DHC scene has been successfully started\n";
	exit(0);
?>
