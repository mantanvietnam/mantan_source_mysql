<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/*
require __DIR__.'/../../library/ratchet/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketServer implements MessageComponentInterface {
    protected $connections;
    protected $listDataStart;

    public function __construct() {
        $this->connections = new \SplObjectStorage();
    }

    public function getConnections() {
        return $this->connections;
    }

    public function setListDataStart($listStart) {
        $this->listDataStart = $listStart;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->connections->attach($conn);

        $this->sendNotificationToAll($this->listDataStart);
    }

    public function onClose(ConnectionInterface $conn) {
        $this->connections->detach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->connections as $connection) {
            $connection->send($msg);
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function sendNotificationToAll($data) {
        foreach ($this->connections as $connection) {
            $connection->send(json_encode($data));
        }
    }
}
*/
class WebsocketsController extends AppController{
    /*
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->viewBuilder()->setLayout('ajax');
    }
    */

    public function startServer($port=8765) {
        echo 'abc';
        debug($port);die;

        /*
        // Tạo đối tượng WebSocket
        $webSocket = new WebSocketServer();

        // Tạo máy chủ WebSocket
        $server = IoServer::factory(
            new HttpServer(
                new WsServer($webSocket)
            ), $port
        );

        $server->run();
        */
    }
}