<?php
$server = "time.nist.gov"; // Один із серверів точного часу NIST
$port = 13; // Стандартний порт Daytime Protocol
 
// Створюємо TCP-сокет
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if (!$socket) {
    die("Помилка створення сокета: " . socket_strerror(socket_last_error()) . "\n");
}
 
// Підключаємося до сервера
if (!socket_connect($socket, $server, $port)) {
    die("Помилка підключення: " . socket_strerror(socket_last_error()) . "\n");
}
 
echo "Підключено до $server:$port\n";
 
// Читаємо відповідь від сервера
$response = socket_read($socket, 1024);
echo "Отриманий час від сервера: \n$response\n";
 
// Закриваємо з'єднання
socket_close($socket);
?>