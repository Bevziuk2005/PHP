<?php
	echo "Вітаємо на грі 'Вгадай число'\n";

	game:
	$game_num = rand(1, 100);

	for ($i = 1; $i <= 5; $i++) {
		echo "Введіть число: ";
		$num = trim(fgets(STDIN));
    
		if (is_numeric($num)) {
			if ($num == $game_num) {
				echo "Вітаю! Ви перемогли за $i спроб!\n";
				break;
			} elseif ($num > $game_num) {
				echo "Ваше число більше за задане\n";
			} elseif ($num < $game_num) {
				echo "Ваше число менше за задане\n";
			}
			if ($i > 5) {
				echo "Ви програли. Задане число - $game_num\n";
			}	
		} else {
			echo "Ви ввели не число\n" ;
			$i--;
		}
	}

	echo "Ви бажаєте продовжити? (так/ні): ";
	$yn = trim(fgets(STDIN));

	if ($yn == "так") {
		goto game;
	} else {
		echo "Дякуємо за гру!\n";
	}

?>
 
 
