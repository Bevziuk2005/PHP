<?php
 
$domain = "google.com"; // Домен для перевірки
$server = "whois.verisign-grs.com"; // WHOIS-сервер для доменів .com
$port = 43;
 
// Створюємо TCP-сокет
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if (!$socket) {
    die("Помилка створення сокета: " . socket_strerror(socket_last_error()) . "\n");
}
 
// Підключаємося до WHOIS-сервера
if (!socket_connect($socket, $server, $port)) {
    die("Помилка підключення: " . socket_strerror(socket_last_error()) . "\n");
}
 
// Відправляємо запит
$request = $domain . "\r\n";
socket_write($socket, $request, strlen($request));
 
// Отримуємо відповідь
$response = "";
while ($chunk = socket_read($socket, 4096)) {
    $response .= $chunk;
}
 
// Виводимо відповідь
echo "WHOIS-дані для $domain:\n$response\n";
 
// Закриваємо сокет
socket_close($socket);
 
?>