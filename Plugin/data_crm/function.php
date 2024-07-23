<?php
$menus = array();
$menus[0]['title'] = 'DATA CRM';
$menus[0]['sub'][0] = array('title' => 'Danh sách đăng ký',
                            'url'=>'/plugins/admin/data_crm-views-admin-listRegAdmin',
                            'classIcon' => 'menu-icon tf-icons bx bxs-data',
                            'permission'=>'listRegAdmin'
);
addMenuAdminMantan($menus);

global $vst_hostname;
global $ftpUser;
global $ftpPass;
global $ftpIP;
global $ftpPort;

$vst_hostname = '171.244.16.96';
$ftpUser = 'datacrm';
$ftpPass = 'fkkREZMmxj';
$ftpIP= '171.244.16.96';
$ftpPort= 21;

function createPass($length=30)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length).time();
}

function listDomain($domain='icham.vn')
{	
	global $vst_hostname;
	global $ftpUser;
	global $ftpPass;

	if(!empty($domain)){
		$data = array(
		    'domain' => $domain
		);

		$url = 'http://'.$vst_hostname.':2222/CMD_API_SUBDOMAINS';

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
		    return $response;
		}

		// Đóng kết nối cURL
		curl_close($ch);
	}
}

function deleteDomain($domain='')
{	
	global $vst_hostname;
	global $ftpUser;
	global $ftpPass;

	if(!empty($domain)){
		$domainRoot = explode('.', $domain);
		$n1 = count($domainRoot)-2;
		$n2 = count($domainRoot)-1;

		$data = array(
		    'confirmed' => 'Confirm',
			'delete' => 'yes',
		    'select0' => $domain,
			'action' => 'delete',
			'contents' => 'yes',
			'keep_data' => 'no'
		);

		$url = 'http://'.$vst_hostname.':2222/CMD_API_DOMAIN';

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
		    return 'Đã xóa thành công tên miền: ' . $domain.'<br/>';
		}

		// Đóng kết nối cURL
		curl_close($ch);
	}
}

function createDomain($domain='')
{	
	global $vst_hostname;
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
		);

		$url = 'http://'.$vst_hostname.':2222/CMD_API_DOMAIN';

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

function createDatabase($domain='', $db_name='', $db_password='')
{
	global $vst_hostname;
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
		$url = 'http://'.$vst_hostname.':2222/CMD_API_DATABASES';

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

function deleteDatabase($db_name='')
{
	global $vst_hostname;
	global $ftpUser;
	global $ftpPass;

	if(!empty($db_name)){
		// Thông tin cơ sở dữ liệu mới
		$db_user = $db_name;

		// Dữ liệu yêu cầu
		$data = array(
		    'action' => 'delete',
		    'name' => $db_name,
		    'select0' => $db_name,
		);

		// URL của API DirectAdmin
		$url = 'http://'.$vst_hostname.':2222/CMD_API_DATABASES';

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
		    return 'Đã xóa thành công database: ' . $db_name.'<br/>';
		}

		// Đóng kết nối cURL
		curl_close($ch);
	}
}

function downloadCode($domain)
{
	unlink(__DIR__.'/../../../../'.$domain.'/public_html/index.html');
	unlink(__DIR__.'/../../../../'.$domain.'/public_html/400.shtml');
	unlink(__DIR__.'/../../../../'.$domain.'/public_html/401.shtml');
	unlink(__DIR__.'/../../../../'.$domain.'/public_html/403.shtml');
	unlink(__DIR__.'/../../../../'.$domain.'/public_html/404.shtml');
	unlink(__DIR__.'/../../../../'.$domain.'/public_html/500.shtml');
	unlink(__DIR__.'/../../../../'.$domain.'/public_html/logo.png');

	// copy file zip
	$source = __DIR__.'/code/data_crm_code.zip'; // Đường dẫn tới file ZIP nguồn
	$destination = __DIR__.'/../../../../'.$domain.'/public_html/'; // Đường dẫn tới thư mục đích

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
		$file = __DIR__.'/../../../../'.$domain.'/public_html/config/app_local.php'; // Đường dẫn tới thư mục đích
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
			$sql_file = __DIR__."/code/database.sql";

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

			$sql .= "INSERT INTO `categories` (`id`, `name`, `parent`, `image`, `keyword`, `description`, `type`, `slug`, `status`, `weighty`) VALUES (NULL, '".$dataInsert->system_name."', '0', '".$dataInsert->system_logo."', '', '', 'system_sales', '".$dataInsert->system_slug."', 'active', '0');";

			$sql .= "INSERT INTO `members` (`id`, `name`, `avatar`, `phone`, `id_father`, `email`, `password`, `status`, `created_at`, `id_system`, `otp`, `address`, `deadline`, `verify`, `birthday`, `facebook`, `id_position`, `create_agency`, `coin`, `twitter`, `tiktok`, `youtube`, `web`, `linkedin`, `description`, `zalo`, `view`, `banner`, `instagram`, `token_device`, `token`, `last_login`, `portrait`, `create_order_agency`, `img_card_member`, `img_logo`, `noti_new_order`, `noti_new_customer`, `noti_checkin_campaign`, `noti_reg_campaign`, `noti_product_warehouse`) VALUES (NULL, '".$dataInsert->boss_name."', '".$dataInsert->boss_avatar."', '".$dataInsert->boss_phone."', '0', '".$dataInsert->boss_email."', 'e10adc3949ba59abbe56e057f20f883e', 'active', '".$time."', '1', NULL, 'HN', '".$deadline."', 'active', NULL, NULL, '0', 'active', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, NULL, '1', '1', '1', '1', '1');";

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

?>