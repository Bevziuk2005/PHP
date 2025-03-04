<?php
	function my_while($st, $f_ip, $f_port) {
		while ($st < 100) {
			$ip = $f_ip . (10 + $st);
			$text = $st . "--" . $ip . " and " . $st + $f_port . "\n";
			echo $text;
			$st++;
		}
	}

	function my_for($f_ip, $f_port) {
		for ($st = 1; $st < 100; $st++) {
			$ip = $f_ip . (10 + $st);
			$text = $st . "--" . $ip . " and " . $st + $f_port . "\n";
			echo $text;
		}
	}

	$studios = 1;
	$first_ip = "10.0.1.";
	$first_port = 30000;
	my_while($studios, $first_ip, $first_port);

	echo "-------------------------\n";
	echo sleep(5);
	
	my_for($first_ip, $first_port);
?>
