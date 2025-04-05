<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Channel\AMQPChannel;

use Google\Auth\Credentials\ServiceAccountCredentials;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

require_once __DIR__ . '/../../../library/php-amqplib/vendor/autoload.php';

include(__DIR__.'/../../library/jwt/vendor/autoload.php');
use Firebase\JWT\JWT;

include(__DIR__.'/../../library/client/vendor/autoload.php');
use GuzzleHttp\Client;

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

// Hàm chia nhỏ mảng thành các nhóm 100 token
function splitArrayIntoChunks($array=[], $chunkSize=100) {
    $chunks = [];
    
    if(is_array($array)){
        if(count($array)>=$chunkSize){
            for ($i = 0; $i < count($array); $i += $chunkSize) {
                $chunks[] = array_slice($array, $i, $chunkSize);
            }
        }else{
            $chunks[] = $array;
        }
    }

    return $chunks;
}

function getTokenFirebaseV1()
{
    require __DIR__.'/../library/google-auth-library-php/vendor/autoload.php';

    $linkFileJson = __DIR__.'/../../hethongdaily/library/phoenix-crm-f6f64-firebase-adminsdk-lhgro-42139e7d2b.json';

    // Đường dẫn tới file JSON bạn đã tải về từ Firebase
    putenv('GOOGLE_APPLICATION_CREDENTIALS='.$linkFileJson);

    // Tạo một handler cho Guzzle
    $handler = HandlerStack::create();

    // Tạo client Guzzle với handler
    $client = new Client(['handler' => $handler]);

    // Sử dụng ServiceAccountCredentials với HTTP handler đúng
    $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
    $creds = new ServiceAccountCredentials($scopes, $linkFileJson);

    // Lấy Access Token với HTTP handler là callable hợp lệ
    $authToken = $creds->fetchAuthToken(function ($request) use ($client) {
        try {
            // Trả về đối tượng phản hồi (ResponseInterface) thay vì mảng đã giải mã
            return $client->send($request);
        } catch (RequestException $e) {
            // Xử lý lỗi nếu có
            return null;
        }
    });

    return $authToken['access_token'];
}

function getFirebaseToken()
{
     //$serviceAccountPath = __DIR__ . '/library/phoenix-crm-f6f64-firebase-adminsdk-lhgro-42139e7d2b.json'; // đổi lại nếu tên khác
    $serviceAccountPath = __DIR__ . '/../../library/phoenix-crm-f6f64-firebase-adminsdk-lhgro-70eecdee1a.json'; // đổi lại nếu tên khác
     // đổi lại nếu tên khác
    $serviceAccount = json_decode(file_get_contents($serviceAccountPath), true);

    if (!$serviceAccount || !isset($serviceAccount['private_key'])) {
        die("Không đọc được file JSON hoặc thiếu private_key.");
    }

    $privateKey = $serviceAccount['private_key'];
    $clientEmail = $serviceAccount['client_email'];

    $now = time();
    $jwtPayload = [
        'iss' => $clientEmail,
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud' => 'https://oauth2.googleapis.com/token',
        'iat' => $now,
        'exp' => $now + 3600
    ];

    $jwt = JWT::encode($jwtPayload, $privateKey, 'RS256');

    $client = new Client();

    try {
        $response = $client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['access_token'] ?? null;

    } catch (\GuzzleHttp\Exception\ClientException $e) {
       return null;
    }

}



function sendNotification($dataSend = [])
{
    /*
    $data = [
                'title'=>'Bạn được cộng tiền hoa hồng giới thiệu',
                'time'=>date('H:i d/m/Y'),
                'content'=>'Trần Mạnh ơi. Bạn được cộng 100.000 VND do thành viên Kim Oanh đã nạp tiền. Bấm vào đây để kiểm tra ngay nhé.',
                'action'=>'addMoneySuccess',
                'image'=>'',
            ];
    */

    $data = @$dataSend['dataSendNotification']; 
    $deviceTokens = @$dataSend['listToken']; 
    $keyFirebase = @$dataSend['keyFirebase']; 
    $projectId = @$dataSend['projectId']; 

    $tokenFirebase = getFirebaseToken(); // Bearer token
    $number_error = 0;
    
    if(!empty($tokenFirebase)){
        // Chia danh sách token thành các nhóm 100
        if(is_string($deviceTokens)){
            $deviceTokens = [$deviceTokens];
        }

        $chunks = splitArrayIntoChunks($deviceTokens, 1000);
        

        $headers = [
            'Authorization: Bearer ' . $tokenFirebase,
            'Content-Type: application/json'
        ];

        $url = 'https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send';

        foreach ($chunks as $chunk) {
            // Tạo thông báo cho mỗi nhóm 100 thiết bị
            $messages = [];
            foreach ($chunk as $token) {
                $messages[] = [
                    "message" => [
                        "token" => $token,
                        "notification" => [
                                            'title' => $data['title'],
                                            'body' => $data['content'],
                                            //'sound' => "default",
                                        ],
                        "data" => $data,
                    ]
                ];
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Gửi từng tin nhắn cho nhóm thiết bị hiện tại
            foreach ($messages as $message) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
                $result = curl_exec($ch);

                // Xử lý kết quả
                if ($result === FALSE) {
                    $number_error ++;
                }else{
                    //var_dump($result);
                }
            }

            curl_close($ch);
        }
    }

    return $number_error;
}


// lấy yêu cầu từ rabbitmq
$rabbitMQClient = new RabbitMQClient();

$callback = function ($msg) {
    $messageBody = $msg->body;
    
    // Xử lý tin nhắn ở đây
    $data = json_decode($messageBody, true);
   
    sendNotification($data);
};

// Tiêu thụ tin nhắn từ hàng đợi 'send_notification_firebase'
$rabbitMQClient->consumeMessage('send_notification_phoenixcamp', $callback);
//$rabbitMQClient->consumeMessageLimitTime('send_notification_phoenixcamp', $callback, 60);
// test 
//$rabbitMQClient->consumeOneMessage('send_notification_phoenixcamp', $callback);
?>