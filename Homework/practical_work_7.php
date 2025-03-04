<?php
 
	$apiKey = "13acd068ea9006ecc8ffb8c407771da2";  // Замініть на ваш API-ключ
	$city = "Kyiv";
	$url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";
	 
	$response = file_get_contents($url);

	echo $response . "\n";
	 
	$data = json_decode($response, true);

	echo "Температура максимальна у місті $city: " . $data['main']['temp_max'] . "°C" . "\n";
	echo "Description у місті $city: " . $data['weather'][0]['description']  . "\n";
	echo "Швидкість вітру у місті $city: " . $data['wind']['speed']  . "\n";
	echo "Схід сонця у місті $city: " . $data['sys']['sunrise']  . "\n";
	echo "Захід сонця у місті $city: " . $data['sys']['sunset']  . "\n";
?>
 
 
