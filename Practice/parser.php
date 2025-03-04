<?php
	$options = [];
	$arguments = [];
	 
	foreach ($argv as $key => $arg) {
		if ($key === 0) continue; // Пропускаємо ім'я скрипта
	 
		if (str_starts_with($arg, '--')) {
			$option = explode('=', $arg, 2);
			$options[$option[0]] = $option[1] ?? true;
		} else {
			$arguments[] = $arg;
		}
	}
	 
	echo "Options:\n";
	print_r($options);
	 
	echo "\nArguments:\n";
	print_r($arguments);
?>