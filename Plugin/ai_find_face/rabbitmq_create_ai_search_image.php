<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Channel\AMQPChannel;

require_once __DIR__ . '/../../library/php-amqplib/vendor/autoload.php';

class RabbitMQClient
{
    private $connection;
    private $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('172.16.33.6', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
    }

    public function sendMessage($queueName, $messageBody)
    {
        $this->channel->queue_declare($queueName, false, false, false, false);
        $msg = new AMQPMessage($messageBody);
        $this->channel->basic_publish($msg, '', $queueName);
    }

    public function consumeMessageLimitTime($queueName, $callback, $timeout = 5)
    {
        $this->channel->queue_declare($queueName, false, false, false, false);
        $this->channel->basic_consume($queueName, '', false, true, false, false, $callback);

        while ($this->channel->is_consuming()) {
            try {
                // Chờ message với timeout
                $this->channel->wait(null, false, $timeout);
            } catch (\PhpAmqpLib\Exception\AMQPTimeoutException $e) {
                // Nếu timeout, dừng việc tiêu thụ message
                echo "No messages in queue for {$timeout} seconds, stopping...\n";
                break;
            }
        }
    }

    public function consumeOneMessage($queueName, $callback)
    {
        $this->channel->queue_declare($queueName, false, false, false, false);

        try {
            $message = $this->channel->basic_get($queueName);

            if ($message) {
                $callback($message);
                $this->channel->basic_ack($message->delivery_info['delivery_tag']);
            } else {
                echo "No messages in queue\n";
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }

        $this->channel->close();
        $this->connection->close();
    }

    
    public function consumeMessage($queueName, $callback)
    {
        $this->channel->queue_declare($queueName, false, false, false, false);
        $this->channel->basic_consume($queueName, '', false, true, false, false, $callback);

        while($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}

function createAISearchImage($data)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $data['url'],
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($data['filePath'])),
      CURLOPT_HTTPHEADER => $data['header'],
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $response = json_decode($response, true);

    unlink($data['filePath']);

    // cập nhập database
    $host = 'localhost'; // Địa chỉ máy chủ
    $db   = 'tranmanh_ai'; // Tên cơ sở dữ liệu
    $user = 'tranmanh_ai'; // Tên người dùng
    $pass = 'aL4TpMQCW'; // Mật khẩu

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE  search_image_events SET status='active' WHERE collection_ai='".$data['collection_name']."'";

    $conn->query($sql);

    mysqli_close($conn);
}


// lấy yêu cầu từ rabbitmq
$rabbitMQClient = new RabbitMQClient();

$callback = function ($msg) {
    $messageBody = $msg->body;
    
    // Xử lý tin nhắn ở đây
    $data = json_decode($messageBody, true);

    createAISearchImage($data);
};

// Tiêu thụ tin nhắn từ hàng đợi 'create_ai_search_image'
$rabbitMQClient->consumeMessage('create_ai_search_image', $callback);
//$rabbitMQClient->consumeMessageLimitTime('create_ai_search_image', $callback, 60);
//$rabbitMQClient->consumeOneMessage('create_ai_search_image', $callback);
?>