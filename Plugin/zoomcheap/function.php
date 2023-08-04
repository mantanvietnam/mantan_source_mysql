<?php 
require_once __DIR__.'/lib/Guzzle/vendor/autoload.php';
require_once __DIR__ . '/lib/google/vendor/autoload.php';

use GuzzleHttp\Client;

$menus= array();
$menus[0]['title']= 'Zoom Cheap';
$menus[0]['sub'][0]= array(	'title'=>'Khách hàng',
							'url'=>'/plugins/admin/zoomcheap-view-admin-manager-listManagerAdmin.php',
							'classIcon'=>'bx bxs-user-detail',
							'permission'=>'listManagerAdmin'
						);

$menus[0]['sub'][1]= array(	'title'=>'Lịch sử nạp tiền',
							'url'=>'/plugins/admin/zoomcheap-view-admin-history-listHistoryAddMoney.php',
							'classIcon'=>'bx bx-history',
							'permission'=>'listHistoryAddMoney'
						);

$menus[0]['sub'][2]= array(	'title'=>'Đơn hàng thuê Zoom',
							'url'=>'/plugins/admin/zoomcheap-view-admin-order-listOrderZoomAdmin.php',
							'classIcon'=>'bx bx-history',
							'permission'=>'listOrderZoomAdmin'
						);

$menus[0]['sub'][3]= array(	'title'=>'Tài khoản Zoom',
							'url'=>'/plugins/admin/zoomcheap-view-admin-zoom-listAccountZoomAdmin.php',
							'classIcon'=>'bx bxl-zoom',
							'permission'=>'listAccountZoomAdmin'
						);

$menus[0]['sub'][4]= array(	'title'=>'Cài đặt giá',
							'url'=>'/plugins/admin/zoomcheap-view-admin-price-listPriceAdmin.php',
							'classIcon'=>'bx bxl-zoom',
							'permission'=>'listPriceAdmin'
						);

addMenuAdminMantan($menus);

global $urlHomes;
global $google_clientId;
global $google_clientSecret;
global $google_redirectURL;

$google_clientId= '637094275991-2f53f5g9ls2d34r05ugshhugb57ng4rm.apps.googleusercontent.com';
$google_clientSecret= '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';

$google_redirectURL= $urlHomes . 'ggCallback';

function createNewRoom($clientId = '', $clientSecret = '', $account_id = '', $topic= '' , $start_time=0 , $duration = 60, $pass = '')
{
	$return = [];

	if(!empty($clientId) && !empty($clientSecret) && !empty($account_id)){
		/*
		// Thông tin ứng dụng Zoom
		$clientId = 'RiMjLLS3RRmab8cSuV3BhA';
		$clientSecret = 'WKiWTjvePqhnPnJbWU7fWyx9XzqeT0wO';
		$account_id = 'QkZRn44DR-uiXpE8EW8viQ';
		*/

		if(empty($topic)) $topic = 'Phòng họp '.time();
		if(empty($start_time)) $start_time = time();
		if(empty($pass)) $pass = rand(100000,999999);

		// Endpoint API Zoom để lấy Access Token
		$tokenUrl = 'https://zoom.us/oauth/token';

		// Dữ liệu yêu cầu lấy Access Token
		$data = array(
		    'grant_type' => 'account_credentials',
		    'account_id' => $account_id, // Thay thế YOUR_ACCOUNT_ID bằng account_id cụ thể
		);

		// Chuỗi mã xác thực Basic (clientId:clientSecret được mã hóa Base64)
		$authHeader = base64_encode($clientId . ':' . $clientSecret);

		// Gửi yêu cầu POST với thông tin xác thực
		$httpClient = new Client();
		$response = $httpClient->post($tokenUrl, [
		    'form_params' => $data,
		    'headers' => [
		        'Authorization' => 'Basic ' . $authHeader,
		        'Accept' => 'application/json',
		    ],
		]);

		// Xử lý dữ liệu phản hồi nếu cần
		$responseData = json_decode($response->getBody(), true);

		if(!empty($responseData['access_token'])){
			// Thông tin tài khoản Zoom của người dùng (sau khi ủy quyền)
			$accessToken = $responseData['access_token'];

			// Endpoint API Zoom
			$apiUrl = 'https://api.zoom.us/v2/';

			// Dữ liệu yêu cầu tạo phòng họp mới
			$meetingData = array(
			    'topic' => $topic,
			    'type' => 1, // 1 - Phòng họp, 2 - Hội nghị web
			    'start_time' => date('Y-m-dTH:m:s', $start_time), // Thời gian bắt đầu (UTC)
			    'duration' => $duration, // Độ dài phòng họp (phút)
			    'timezone' => 'Asia/Ho_Chi_Minh',
			    'password' => $pass
			);

			// Gọi API Zoom để tạo phòng họp mới
			$httpClient = new \GuzzleHttp\Client(['base_uri' => $apiUrl]);

			try {
			    $response = $httpClient->post('users/me/meetings', [
			        'headers' => [
			            'Authorization' => 'Bearer ' . $accessToken,
			            'Content-Type' => 'application/json',
			            'Accept' => 'application/json',
			        ],
			        'json' => $meetingData,
			    ]);

			    // Xử lý dữ liệu phản hồi nếu cần
			    $return = json_decode($response->getBody(), true);
			} catch (\GuzzleHttp\Exception\RequestException $e) {
			    // Xử lý lỗi nếu có
			    echo 'Error: ' . $e->getMessage();
			}
		}
	}

	return $return;
}