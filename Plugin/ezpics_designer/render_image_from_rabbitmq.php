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

function sendDataConnectMantan($url,$data=null,$header=array(),$typeData='form', $typeSend= 'POST')
{
    /*
    $headers = array(
        'Authorization: key=' .self::$API_ACCESS_KEY,
        'Content-Type: application/json');
    */
        
    if(!empty($data) && $typeSend!='GET'){
        $stringSend= '';
        if($typeData=='form'){
            $stringSend= array();
            
            foreach($data as $key=>$value){
                $stringSend[]= $key.'='.$value;
            }

            $stringSend= implode('&', $stringSend);
        }elseif($typeData=='raw'){
            $stringSend= json_encode($data);
        }elseif($typeData=='x-www-form-urlencoded'){
            $stringSend= http_build_query($data); // Dữ liệu được chuyển dạng x-www-form-urlencoded
        }
        
        $ch = curl_init($url);

        if(strtoupper($typeSend)=='PUT'){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_PUT, 1);
            $header[]= 'Content-Length: '.strlen($stringSend);
            //$stringSend= http_build_query($data);
            //$stringSend= json_encode($data);
        }else{
            curl_setopt($ch, CURLOPT_POST, 1);
        }

        curl_setopt($ch, CURLOPT_URL,$url);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$stringSend);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

        return $server_output;
    }else{
        $stringSend = '';
        if(!empty($data)){
            if($typeData=='x-www-form-urlencoded'){
                $stringSend= http_build_query($data); // Dữ liệu được chuyển dạng x-www-form-urlencoded
            }
        }

        // Khởi tạo một phiên cURL
        $curl = curl_init();

        // Cấu hình cURL để thiết lập URL và các tùy chọn khác
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $stringSend);

        // Thực hiện yêu cầu cURL
        $response = curl_exec($curl);

        // Đóng phiên cURL
        curl_close($curl);

        // Kiểm tra xem có lỗi không
        if ($response === false) {
            return '';
        } else {
            return $response;
        }
    }
}

function removeFileFTP($fileToDelete='', $server='', $username='', $password='')
{
    if(!empty($fileToDelete) && !empty($server) && !empty($username) && !empty($password)){
        // Kết nối đến máy chủ FTP
        $ftpConnection = ftp_connect($server);
        if (!$ftpConnection) {
            //die("Không thể kết nối đến máy chủ FTP");
        }else{
            // Đăng nhập vào FTP
            $login = ftp_login($ftpConnection, $username, $password);
            if (!$login) {
                //die("Không thể đăng nhập vào FTP");
            }else{
                // Xóa tệp tin
                if (ftp_delete($ftpConnection, $fileToDelete)) {
                    // echo "Đã xóa tệp tin thành công";
                } else {
                    // echo "Không thể xóa tệp tin";
                }
            }
        }
    }
}

function renderImageRabbit($data)
{
    $ftp_server_upload_image = "103.74.123.202";
    $ftp_username_upload_image = "ezpics";
    $ftp_password_upload_image = "uImzVeNYgF";

    $host = 'localhost'; // Địa chỉ máy chủ
    $db   = 'ezpics_home'; // Tên cơ sở dữ liệu
    $user = 'ezpics_home'; // Tên người dùng
    $pass = 'yyZ0lONeM'; // Mật khẩu

    $urlHomes = "https://" . @$_SERVER['HTTP_HOST'].'/';

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $imageData = '';

    if(!empty($data['url']) && !empty($data['id_request'])){
        $dataImage = sendDataConnectMantan($data['url']);

        $imageData = base64_decode($dataImage);

        // xóa ảnh người dùng up lên sau khi chụp xong
        if(!empty($data['listRemoveImage'])){
            foreach ($data['listRemoveImage'] as $item) {
                removeFileFTP($item, $ftp_server_upload_image, $ftp_username_upload_image, $ftp_password_upload_image);
            }
        }

        // lưu ảnh vào file
        $filePath = __DIR__.'/../../upload/admin/images/render_images/'.$data['fileName'];
        file_put_contents($filePath, $imageData);

        // cập nhập database
        $linkOnline = $urlHomes.'upload/admin/images/render_images/'.$data['fileName'];
        $render_at = time();

        $sql = "UPDATE render_images SET linkOnline='".$linkOnline."', render_at=".$render_at." WHERE id=".(int) $data['id_request'];

        $conn->query($sql);
    }

    mysqli_close($conn);
}


// lấy yêu cầu từ rabbitmq
$rabbitMQClient = new RabbitMQClient();

$callback = function ($msg) {
    $messageBody = $msg->body;
    
    // Xử lý tin nhắn ở đây
    $data = json_decode($messageBody, true);

    renderImageRabbit($data);
};

// Tiêu thụ tin nhắn từ hàng đợi 'render_image_requests'
$rabbitMQClient->consumeMessage('render_image_requests', $callback);
//$rabbitMQClient->consumeMessageLimitTime('render_image_requests', $callback, 60);
//$rabbitMQClient->consumeOneMessage('render_image_requests', $callback);
?>