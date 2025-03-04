<?php
	$integ = 0;

	start:
	$text = "$integ  \033[$integ" . "m" . " TEXT \033[0m" . "\n";
	echo $text;
	$integ += 1;
	
	switch ($integ) {
		case 200:
			break;
		default:
			goto start;
	}
	



?>
