<?php 
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocket implements MessageComponentInterface {
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
?>