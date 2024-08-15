<?php
require __DIR__.'/../library/ratchet/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

include(__DIR__.'/WebSocket.php');

// Tạo đối tượng WebSocket
$webSocket = new WebSocket();

// Tạo máy chủ WebSocket
$server = IoServer::factory(
    new HttpServer(
        new WsServer($webSocket)
    ), 8765
);

/*
// Cấu hình SSL
$server->loop->addPeriodicTimer(1, function () use ($webSocket) {
    foreach ($webSocket->getConnections() as $conn) {
        if ($conn->WebSocket->request->getUri()->getScheme() !== 'wss') {
            continue;
        }

        $certFile = "/usr/local/directadmin/data/users/excgo/domains/apis.exc-go.vn.cert";
        $keyFile = "/usr/local/directadmin/data/users/excgo/domains/apis.exc-go.vn.key";

        $context = stream_context_create([
            'ssl' => [
                'local_cert' => $certFile,
                'local_pk' => $keyFile,
                'verify_peer' => true,
                'allow_self_signed' => false,
            ],
        ]);

        $socket = $conn->WebSocket->request->getSocket();
        stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_SERVER, $context);
    }
});
*/

// Chạy máy chủ WebSocket
$server->run();

