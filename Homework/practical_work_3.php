<?php
	
	start:
	
	$text = 'Please, select a device to check:' . "\n" . "\n";

	$text .= "1. Studio1" . "\n";
	$text .= "2. Studio2" . "\n";
	$text .= "3. Studio3" . "\n";
	$text .= "4. Studio4" . "\n";
	$text .= "5. Studio5" . "\n";
	$text .= "\n";
	$text .= "Your choise: ";

	echo $text;

	$input = trim(fgets(STDIN));
	echo "\n";

	switch ($input) {
		case 1:
			$device = 'Studio1';
			$IPAdress = '10.0.19.11';
			$port = 1911;
			break;
		case 2:
                	$device = 'Studio2';
	                $IPAdress = '10.0.19.12';
        	        $port = 1912;
                	break;
        	case 3:
                	$device = 'Studio3';
                	$IPAdress = '10.0.19.13';
                	$port = 1913;
        	        break;
	        case 4:
                	$device = 'Studio4';
               		$IPAdress = '10.0.19.14';
               		$port = 1914;
                	break;
        	case 5:
                	$device = 'Studio5';
        	        $IPAdress = '10.0.19.15';
                	$port = 1915;
                	break;
		default:
			echo "\033[31mError input: only digits from 1 to 5\033[0m" . "\n" . "\n";
			sleep(5);
			goto start;
			
	}

	$text = "TCP\IP Connection to \033[92m $device \033[0m device will be established."."\n";
	echo $text;

	sleep(3);

	$text = "Trying to connect \033[43m$IPAdress: $port\033[0m..." . "\n" . "\n";
	echo $text;

	$IPAdress = "8.8.8.8";
	$text = "Trying to connect \033[94m$IPAdress: $port\033[0m..." . "\n" . "\n";
	echo $text;




?>
