<?php
$host = '127.0.0.1';
$port = 8080;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($socket, $host, $port);
if (socket_listen($socket, 1) === false) {
    echo "Не вдалося встановити прослуховування сокета: " . socket_strerror(socket_last_error()) . "\n";
    exit();
}

echo "Сервер слухає на $host:$port...\n";


while (true) {
    $client_socket = socket_accept($socket);

    if ($client_socket === false) {
        echo "Помилка прийому підключення: " . socket_strerror(socket_last_error()) . "\n";
        continue;
    }
	
	socket_set_option($client_socket, SOL_SOCKET, SO_RCVTIMEO, ["sec"=>30, "usec"=>0]);
	
    echo "Клієнт підключився.\n";

    socket_write($client_socket, "Ви підключені до сервера\n", 1024);

    while (true) {
        $message = socket_read($client_socket, 1024);
        if ($message === false || trim($message) === '') {
            break;
        }

        $response = strtoupper(strrev(trim($message)));           // ФУНКЦІЯ 
        socket_write($client_socket, $response, strlen($response));
    }

    socket_close($client_socket);
    echo "Клієнт відключився.\n";
}

socket_close($socket);
?>
