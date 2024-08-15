<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../library/ratchet/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

include('WebSocket.php');

// Tạo đối tượng WebSocket
$webSocket = new WebSocket();

// Tạo máy chủ WebSocket
$server = IoServer::factory(
    new HttpServer(
        new WsServer($webSocket)
    ),
    8765
);

// Chạy máy chủ WebSocket
$server->run();


// Gửi thông báo khi có bản ghi mới
$newRecordData = [
    'id' => 10,
    'name' => 'Trần Mạnh',
    // Thêm thông tin khác nếu cần
];

$webSocket->sendNotificationToAll($newRecordData);

echo 'Đã gửi dữ liệu';