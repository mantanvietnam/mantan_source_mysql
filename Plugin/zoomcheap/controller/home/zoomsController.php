<?php
use GuzzleHttp\Client;

function createRoom($input)
{
	// Thông tin ứng dụng Zoom
	$clientId = 'RiMjLLS3RRmab8cSuV3BhA';
	$clientSecret = 'WKiWTjvePqhnPnJbWU7fWyx9XzqeT0wO';
	$account_id = 'QkZRn44DR-uiXpE8EW8viQ';

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

		debug($accessToken);

		// Endpoint API Zoom
		$apiUrl = 'https://api.zoom.us/v2/';

		// Dữ liệu yêu cầu tạo phòng họp mới
		$meetingData = array(
		    'topic' => 'Tên phòng họp mới '.time(),
		    'type' => 2, // 1 - Phòng họp, 2 - Hội nghị web
		    'start_time' => date('Y-m-dTH:m:s'), // Thời gian bắt đầu (UTC)
		    'duration' => 60, // Độ dài phòng họp (phút)
		    'timezone' => 'Asia/Ho_Chi_Minh',
		    // Các thông tin khác nếu cần thiết
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
		    $responseData = json_decode($response->getBody(), true);
		    debug($responseData);
		} catch (\GuzzleHttp\Exception\RequestException $e) {
		    // Xử lý lỗi nếu có
		    echo 'Error: ' . $e->getMessage();
		}
	}
}