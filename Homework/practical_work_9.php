<?php
	// 1 параметр - назва файлу (без розширення), всі наступні - рядкок тексту, якщо треба розділити рядок в середині параметру - \n

	if ($argc < 3) {
		echo "Неправильна структура запиту. Спробуйте ще раз" . "\n";
	} else {
		$filename = $argv[1];
		$filename .= ".txt";
		
		$text = "";
		$text .= "Дата створення файлу: " . date('Y-m-d H:i:s') . "\n";
		for ($i = 2; $i < $argc; $i++) {
			$text .= str_replace("\\n", "\n", $argv[$i]);
			if ($i + 1 < $argc){
				$text .= "\n";
			};
		};
		
		$file = fopen($filename, 'w+');
		fwrite($file, $text);
		echo "Файл створено та наповнено" . "\n";;
		rewind($file);
		fclose($file);
		
		echo "Кількість рядків у файлі: " . substr_count($text, "\n")+1 . "\n";
		
		$text_word_count = substr_count(implode(" ", explode("\n", $text)), " ")+1;
		echo "Кількість слів у файлі: " . $text_word_count . "\n";
		
		$text_with_space = str_replace(["\n", "\r"], "", $text);
		$text_with_spaces  = iconv_strlen($text_with_space, 'UTF-8');
		echo "Кількість символів (з пропусками, але без символів переносу рядка): " . $text_with_spaces . "\n";

		$text_nospace = str_replace([" ", "\n", "\r"], "", $text);
		$text_without_spaces = iconv_strlen($text_nospace, 'UTF-8');
		echo "Кількість символів (без пропусків, і без символів переносу рядка): " . $text_without_spaces . "\n";

	}
?>