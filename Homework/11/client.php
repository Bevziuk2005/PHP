<?php
$host = '127.0.0.1';
$port = 8080;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, ["sec"=>5, "usec"=>0]);
$result = socket_connect($socket, $host, $port);
if ($result === false) {
    echo "Не вдалося підключитися до сервера: " . socket_strerror(socket_last_error()) . "\n";
    exit();
}

echo "Підключено до сервера на $host:$port\n";

$response = socket_read($socket, 1024);
if ($response === false) {
    echo "Помилка отримання відповіді від сервера.\n";
    socket_close($socket);
    exit();
}
$response = trim($response);
if ($response === "Сервер зайнятий, зачекайте...") {
    echo "Сервер зайнятий. Спробуйте пізніше.\n";
    socket_close($socket);
    exit();
}

echo "Сервер: $response\n";

while (true) {
    $message = readline("Введіть повідомлення ('exit' для виходу): ");
    if (strtolower($message) === 'exit') {
        echo "Завершення роботи!\n";
        break;
    }

    socket_write($socket, $message, strlen($message));

    $response = socket_read($socket, 1024);
    if ($response === false || trim($response) === '') {
        $error_code = socket_last_error($socket);
        $error_message = socket_strerror($error_code);
        if ($error_code !== 0) {
            echo "Помилка з'єднання: $error_message\n";
        } else {
            echo "Сервер закрив з'єднання.\n";
        }
        break;
    }

    echo "Відповідь від сервера: $response\n";
}

socket_close($socket);
?>
