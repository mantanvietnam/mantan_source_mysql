<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Channel\AMQPChannel;

use Google\Auth\Credentials\ServiceAccountCredentials;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

require_once __DIR__ . '/../../../library/php-amqplib/vendor/autoload.php';

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

global $vst_hostname;
global $vst_port;
global $ftpUser;
global $ftpPass;
global $ftpIP;
global $ftpPort;

$vst_hostname = 'da.phoenixtech.vn';
$vst_port = '2244';
$ftpUser = 'datacrm';
$ftpPass = 'fkkREZMmxj';
$ftpIP= '103.74.123.202';
$ftpPort= 21;

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

function createPass($length=30)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length).time();
}

function createDomain($domain='')
{	
	global $vst_hostname;
	global $vst_port;
	global $ftpUser;
	global $ftpPass;

	if(!empty($domain)){
		$data = array(
		    "domain" => $domain,
			"action" => "create",
			//"bandwidth" => "10240",
			//"quota" => "500",
			"ssl" => "ON",
			"cgi" => "ON",
			"php" => "ON",
			'php1_select' => 2,
		);

		$url = 'https://'.$vst_hostname.':'.$vst_port.'/CMD_API_DOMAIN';

		// Khởi tạo yêu cầu cURL
		$ch = curl_init($url);

		// Cấu hình yêu cầu
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, "$ftpUser:$ftpPass");

		// Gửi yêu cầu và nhận phản hồi
		$response = curl_exec($ch);
		
		// Kiểm tra phản hồi
		if ($response === false) {
		    return 'Error: ' . curl_error($ch);
		} else {
		    return 'Đã tạo thành công tên miền: ' . $domain.'<br/>';
		}

		// Đóng kết nối cURL
		curl_close($ch);
	}
}

function updatePHPVersion($domain='', $php_version='8.0')
{
	global $vst_hostname;
	global $vst_port;
	global $ftpUser;
	global $ftpPass;

	// Thông tin kết nối
	$directadmin_url = 'https://'.$vst_hostname.':'.$vst_port;
	$username = $ftpUser;
	$password = $ftpPass;

	// Tạo yêu cầu cURL để cập nhật phiên bản PHP
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $directadmin_url . '/CMD_API_DOMAIN');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

	// Dữ liệu gửi đi để thay đổi phiên bản PHP
	$data = [
	    'action' => 'php_selector',
	    'domain' => $domain,
	    'php1_select' => $php_version
	];

	// Cấu hình gửi dữ liệu
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

	// Thực thi và lấy phản hồi
	$response = curl_exec($ch);

	if ($response === false) {
	    return 'Lỗi cURL: ' . curl_error($ch);
	} else {
	    return 'Phản hồi từ DirectAdmin: ' . $response;
	}

	// Đóng kết nối
	curl_close($ch);
}

function createDatabase($domain='', $db_name='', $db_password='')
{
	global $vst_hostname;
	global $vst_port;
	global $ftpUser;
	global $ftpPass;

	if(!empty($domain) && !empty($db_name) && !empty($db_password)){
		// Thông tin cơ sở dữ liệu mới
		$db_user = $db_name;

		// Dữ liệu yêu cầu
		$data = array(
		    'action' => 'create',
		    'name' => $db_name,
		    'db' => 'mysql',
		    'user' => $db_user,
		    'passwd' => $db_password,
		    'passwd2' => $db_password,
		    'domain' => $domain,
		    'create' => 'Create'
		);

		// URL của API DirectAdmin
		$url = 'https://'.$vst_hostname.':'.$vst_port.'/CMD_API_DATABASES';

		// Khởi tạo yêu cầu cURL
		$ch = curl_init($url);

		// Cấu hình yêu cầu
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, "$ftpUser:$ftpPass");

		// Gửi yêu cầu và nhận phản hồi
		$response = curl_exec($ch);

		// Kiểm tra phản hồi
		if ($response === false) {
		    return 'Error: ' . curl_error($ch);
		} else {
		    return 'Đã tạo thành công database: ' . $db_name.'<br/>';
		}

		// Đóng kết nối cURL
		curl_close($ch);
	}
}

function downloadCode($domain)
{
	if(file_exists(__DIR__.'/../../../../../'.$domain.'/public_html/index.html')){
		unlink(__DIR__.'/../../../../../'.$domain.'/public_html/index.html');
	}

	if(file_exists(__DIR__.'/../../../../../'.$domain.'/public_html/400.shtml')){
		unlink(__DIR__.'/../../../../../'.$domain.'/public_html/400.shtml');
	}

	if(file_exists(__DIR__.'/../../../../../'.$domain.'/public_html/401.shtml')){
		unlink(__DIR__.'/../../../../../'.$domain.'/public_html/401.shtml');
	}

	if(file_exists(__DIR__.'/../../../../../'.$domain.'/public_html/403.shtml')){
		unlink(__DIR__.'/../../../../../'.$domain.'/public_html/403.shtml');
	}

	if(file_exists(__DIR__.'/../../../../../'.$domain.'/public_html/404.shtml')){
		unlink(__DIR__.'/../../../../../'.$domain.'/public_html/404.shtml');
	}

	if(file_exists(__DIR__.'/../../../../../'.$domain.'/public_html/500.shtml')){
		unlink(__DIR__.'/../../../../../'.$domain.'/public_html/500.shtml');
	}

	if(file_exists(__DIR__.'/../../../../../'.$domain.'/public_html/logo.png')){
		unlink(__DIR__.'/../../../../../'.$domain.'/public_html/logo.png');
	}

	// copy file zip
	$source = __DIR__.'/../code/data_crm_code.zip'; // Đường dẫn tới file ZIP nguồn
	$destination = __DIR__.'/../../../../../'.$domain.'/public_html/'; // Đường dẫn tới thư mục đích

	$zipArchive = new ZipArchive();
	$result = $zipArchive->open($source);
	if ($result === TRUE) {
	    $zipArchive ->extractTo($destination);
	    $zipArchive ->close();

	    return "File ZIP đã được sao chép thành công. Giải nén thành công.".'<br/>';
	}else{
		return "File ZIP đã được sao chép thành công. Giải nén thất bại.".'<br/>';
	}

}

function importData($domain='', $db_name='', $db_password='', $dataInsert=[])
{
	if(!empty($domain) && !empty($db_name) && !empty($db_password)){
		$file = __DIR__.'/../../../../../'.$domain.'/public_html/config/app_local.php'; // Đường dẫn tới thư mục đích
		$data = '<?php
					
					$configMantanSource = [
					    
					    "debug" => filter_var(env("DEBUG", false), FILTER_VALIDATE_BOOLEAN),

					   
					    "Security" => [
					        "salt" => env("SECURITY_SALT", "3e24e2301cc9b3013587286652998647162b2eef71d4f61be351ceb70c9f0097"),
					    ],

					    
					    "Datasources" => [
					        "default" => [
					            "host" => "localhost",

					            "username" => "'.$db_name.'",
					            "password" => "'.$db_password.'",

					            "database" => "'.$db_name.'",
					            
					            "url" => env("DATABASE_URL", null),
					        ],

					        
					        "test" => [
					            "host" => "localhost",
					            //"port" => "non_standard_port_number",
					            "username" => "my_app",
					            "password" => "secret",
					            "database" => "test_myapp",
					            //"schema" => "myapp",
					            "url" => env("DATABASE_TEST_URL", "sqlite://127.0.0.1/tests.sqlite"),
					        ],
					    ],

					    
					    "EmailTransport" => [
					        "default" => [
					            "host" => "localhost",
					            "port" => 25,
					            "username" => null,
					            "password" => null,
					            "client" => null,
					            "url" => env("EMAIL_TRANSPORT_DEFAULT_URL", null),
					        ],
					    ],
					];

					include("email.php");

					return $configMantanSource;'; 

		if (file_put_contents($file, $data) !== false) {
			// Thông tin kết nối đến cơ sở dữ liệu
			$servername = "localhost";
			$username = $db_name;
			$password = $db_password;
			$database = $db_name;

			// Đường dẫn đến tệp SQL bạn muốn import
			$sql_file = __DIR__."/../code/database.sql";

			// Tạo kết nối đến cơ sở dữ liệu
			$conn = new mysqli($servername, $username, $password, $database);

			// Kiểm tra kết nối
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			// Đọc dữ liệu từ tệp SQL
			$sql = file_get_contents($sql_file);

			$time = time();
			$deadline = time() + 30*24*60*60;

			$sql .= "INSERT INTO `categories` (`id`, `name`, `parent`, `image`, `keyword`, `description`, `type`, `slug`, `status`, `weighty`) VALUES (NULL, '".$dataInsert['system_name']."', '0', '".$dataInsert['system_logo']."', '', '', 'system_sales', '".$dataInsert['system_slug']."', 'active', '0');";

			$sql .= "INSERT INTO `members` (`id`, `name`, `avatar`, `phone`, `id_father`, `email`, `password`, `status`, `created_at`, `id_system`, `otp`, `address`, `deadline`, `verify`, `birthday`, `facebook`, `id_position`, `create_agency`, `coin`, `twitter`, `tiktok`, `youtube`, `web`, `linkedin`, `description`, `zalo`, `view`, `banner`, `instagram`, `token_device`, `token`, `last_login`, `portrait`, `create_order_agency`, `img_card_member`, `img_logo`, `noti_new_order`, `noti_new_customer`, `noti_checkin_campaign`, `noti_reg_campaign`, `noti_product_warehouse`) VALUES (NULL, '".$dataInsert['boss_name']."', '".$dataInsert['boss_avatar']."', '".$dataInsert['boss_phone']."', '0', '".$dataInsert['boss_email']."', 'e10adc3949ba59abbe56e057f20f883e', 'active', '".$time."', '1', NULL, 'HN', '".$deadline."', 'active', NULL, NULL, '0', 'active', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, NULL, '1', '1', '1', '1', '1');";

			// Thực hiện truy vấn SQL
			if (mysqli_multi_query($conn, $sql)) {
				// Đóng kết nối
				$conn->close();

			    return "Import file SQL thành công.".'<br/>';
			} else {
			    return "Lỗi khi import file SQL: " . mysqli_error($conn).'<br/>';
			}

		    return "Dữ liệu đã được ghi vào tệp tin thành công.".'<br/>';
		} else {
		    return "Đã xảy ra lỗi khi ghi dữ liệu vào tệp tin.".'<br/>';
		}
	}
}

function createDataCRM($input)
{
	$host = 'localhost'; // Địa chỉ máy chủ
    $db   = 'datacrm_home'; // Tên cơ sở dữ liệu
    $user = 'datacrm_home'; // Tên người dùng
    $pass = 'RoPvGrGe'; // Mật khẩu

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(!empty($input['id_request'])){
    	$sql = "SELECT * FROM request_datacrms WHERE id = ".(int) $input['id_request']." AND status = 'new'"; 
    	$result = mysqli_query($conn, $sql);

    	if (mysqli_num_rows($result) > 0) {
		    $data = mysqli_fetch_assoc($result);

			// tạo tên miền
			$domain = $data['system_slug'].'.icham.vn';
			echo createDomain($domain);

			// cập nhập phiên bản PHP
			echo updatePHPVersion($domain, '2');

			// tải code zip
			echo downloadCode($domain);

			// tạo databse
			$db_password = $data['pass_db'];
			echo createDatabase($domain, $data['system_slug'], $db_password);

			// import database
			echo importData($domain, $data['user_db'], $db_password, $data);

			// lưu lại trạng thái
			$sql = "UPDATE request_datacrms SET status='done' WHERE id=".(int) $input['id_request'];
        	$conn->query($sql);

			// gửi thông báo Mess
			if(!empty($data['boss_id_messenger'])){
				/*
				// page phoenix tech
				$idBot = '6633df29cec63d36a4ed6e16';
				$tokenBot = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2MzNkZjI5Y2VjNjNkMzZhNGVkNmUxNiIsIm5hbWUiOiJCTEFOSyBCT1QgLSBDb3B5IiwiaWF0IjoxNzE0Njc1NDk3LCJleHAiOjIwMzAwMzU0OTd9.3VULeYKNscvvpdTYZzab2QD_LoTSZvTfGn09QNlJXnM';
				$idBlockRegDataCRM = '664e6fa65129b0f1c1e41bfc';
				*/

				// page iCham
				$idBot = '6690d7fbd6f147a3339288fc';
				$tokenBot = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2OTBkN2ZiZDZmMTQ3YTMzMzkyODhmYyIsIm5hbWUiOiJCTEFOSyBCT1QgLSBDb3B5IiwiaWF0IjoxNzIwNzY4NTA3LCJleHAiOjIwMzYxMjg1MDd9.gWFU7cc8xjAZzctTwdKXsyLNlUMbUv32SF7TiEu3owA';
				$idBlockRegDataCRM = '6690d886bf4f95e96aab9d3f';

				$attributesSmax = [];
	            $attributesSmax['linkDataCRM']= 'https://'.$domain;
	            
	            $urlSmax= 'https://api.smax.bot/bots/'.$idBot.'/users/'.$data['boss_id_messenger'].'/send?bot_token='.$tokenBot.'&block_id='.$idBlockRegDataCRM.'&messaging_tag="CONFIRMED_EVENT_UPDATE"';
	            
	            $returnSmax= sendDataConnectMantan($urlSmax, $attributesSmax);
			}
		} else {
		    echo "Không tìm thấy bản ghi.";
		}

		mysqli_close($conn);
    }
}


// lấy yêu cầu từ rabbitmq
$rabbitMQClient = new RabbitMQClient();

$callback = function ($msg) {
    $messageBody = $msg->body;
    
    // Xử lý tin nhắn ở đây
    $data = json_decode($messageBody, true);
   
    createDataCRM($data);
};

// Tiêu thụ tin nhắn từ hàng đợi 'create_account_icham'
$rabbitMQClient->consumeMessage('create_account_icham', $callback);
//$rabbitMQClient->consumeMessageLimitTime('create_account_icham', $callback, 60);
//$rabbitMQClient->consumeOneMessage('create_account_icham', $callback);
?>