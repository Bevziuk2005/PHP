<?php
function get_ntp_time($server = "time.google.com", $port = 123)
{
    // 48-байтовий NTP-запит (перший байт: 0x1B)
    $request = chr(0x1B) . str_repeat("\0", 47); //створює рядок з 47 нульових байтів, що є частиною запиту для NTP
 
    // Створюємо UDP-сокет
    $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    if (!$socket) {
        die("Помилка створення сокета: " . socket_strerror(socket_last_error()) . "\n");
    }
 
    // Встановлюємо таймаут (2 секунди)
    socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, ["sec" => 2, "usec" => 0]);
 
    // Відправляємо NTP-запит
    if (!socket_sendto($socket, $request, strlen($request), 0, $server, $port)) {
        die("Помилка відправлення запиту: " . socket_strerror(socket_last_error()) . "\n");
    }
 
    // Отримуємо відповідь (48 байтів)
    $buffer = "";
    $from = "";
    $port = 0;
    if (@socket_recvfrom($socket, $buffer, 48, 0, $from, $port) === false) {
        die("Помилка отримання відповіді від сервера\n");
    }
 
    // Закриваємо сокет
    socket_close($socket);
 
    // Розбираємо відповідь: байти 40-43 містять часову мітку NTP
    $data = unpack("N12", $buffer);
    if (!isset($data[9])) {
        die("Помилка обробки відповіді\n");
    }
 
    // Конвертуємо час (NTP Epoch -> Unix Epoch)
    $timestamp = $data[9] - 2208988800;
    return date("Y-m-d H:i:s", $timestamp) . " UTC";
}
 
// Виклик функції та вивід результату
echo "Поточний час за NTP: " . get_ntp_time() . "\n";
?>