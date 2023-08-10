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
							'url'=>'/plugins/admin/zoomcheap-view-admin-history-listHistoryPlusAdmin.php',
							'classIcon'=>'bx bx-history',
							'permission'=>'listHistoryPlusAdmin'
						);

$menus[0]['sub'][5]= array(	'title'=>'Lịch sử trừ tiền',
							'url'=>'/plugins/admin/zoomcheap-view-admin-history-listHistoryMinusAdmin.php',
							'classIcon'=>'bx bx-history',
							'permission'=>'listHistoryMinusAdmin'
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
global $price_link;

$price_link = 50000;

$google_clientId= '637094275991-2f53f5g9ls2d34r05ugshhugb57ng4rm.apps.googleusercontent.com';
$google_clientSecret= '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';

$google_redirectURL= $urlHomes . 'ggCallback';

function closeRoom($clientId = '', $clientSecret = '', $account_id = '', $meetingId = '')
{
    if(!empty($clientId) && !empty($clientSecret) && !empty($account_id) && !empty($meetingId)){

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
            $jwtToken = $responseData['access_token'];

            // Gửi yêu cầu DELETE để kết thúc phòng họp
            $httpClient = new Client();

            // Endpoint API Zoom để kết thúc phòng họp
            $updateMeetingUrl = "https://api.zoom.us/v2/meetings/{$meetingId}/status";

            // Dữ liệu yêu cầu cập nhật trạng thái kết thúc phòng họp
            $meetingData = array(
                'action' => 'end', // Đặt trạng thái cuộc họp thành "end"
            );
            
            try {
                $response = $httpClient->put($updateMeetingUrl, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $jwtToken,
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'json' => $meetingData,
                ]);

                // Endpoint API Zoom để kết thúc phòng họp
                $deleteMeetingUrl = "https://api.zoom.us/v2/meetings/{$meetingId}";
                
                $responseDelete = $httpClient->delete($deleteMeetingUrl, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $jwtToken,
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                ]);

                // Xử lý dữ liệu phản hồi nếu cần
                return json_decode($responseDelete->getBody(), true);
            }catch (\GuzzleHttp\Exception\RequestException $e) {
                return [];

                // Xử lý lỗi nếu có
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}

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
                /*
			    'topic' => $topic,
			    'type' => 2, // 1 - Phòng họp, 2 - Hội nghị web
			    'start_time' => date('Y-m-dTH:m:s', $start_time), // Thời gian bắt đầu (UTC)
			    'duration' => $duration, // Độ dài phòng họp (phút)
			    'timezone' => 'Asia/Ho_Chi_Minh',
			    'password' => $pass
                */

                'topic' => $topic,
                'timezone' => 'Asia/Saigon',
                'password' => $pass,
                'agenda' => 'Phòng hợp được cung cấp bởi Zoom Cheap',
              
                'settings' => [
                    'host_video' => false,
                    'participant_video' => true,
                    'join_before_host' => true,
                    'audio' => true,
                    'approval_type' => 2,
                    'waiting_room' => false,
                ],

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
			    return [];

                // Xử lý lỗi nếu có
			    echo 'Error: ' . $e->getMessage();
			}
		}
	}

	return $return;
}

function sendEmailnewpassword($email='', $fullName='', $pass= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[ZoomCheap] ' . 'Mã xác thực cấp lại mật khẩu mới';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Quên mật khẩu</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <style>
                .bao{background: #fafafa;margin: 40px;padding: 20px 20px 40px;}
                .logo{

                }
                .logo img{height: 115px;margin:  0 auto;display:  block;margin-bottom: 15px;}
                .nd{background: white;max-width: 750px;margin: 0 auto;border-radius: 12px;overflow:  hidden;border: 2px solid #e6e2e2;line-height: 2;}
                .head{background: #3fb901; color:white;text-align: center;padding: 15px 10px;font-size: 17px;text-transform: uppercase;}
                .main{padding: 10px 20px;}
                .thong_tin{padding: 0 20px 20px;}
                .line{position: relative;height: 2px;}
                .line1{position: absolute;top: 0;left: 0;width: 100%;height: 100%;background-image: linear-gradient(to right, transparent 50%, #737373 50%);background-size: 26px 100%;}
                .cty{text-align:  center;margin: 20px 0 30px;}
                .main .fa{color:green;}
                table{margin:auto;}
                @media screen and (max-width: 768px){
                    .bao{margin:0;}
                }
                @media screen and (max-width: 767px){
                    .bao{padding:6px; }
                    .nd{text-align: inherit;}
                }
            </style>
        </head>
        <body>
            <div class="bao">
                <div class="nd">
                    <div class="head">
                        <span>MÃ XÁC THỰC</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Mã xác thực cấp lại mật khẩu mới của bạn là: <b>'.$pass.'</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH GIẢI PHÁP SỐ TOP TOP</span> <br>
                            <span>Dịch vụ thuê Zoom giá rẻ</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Vũ Tuyên Hoàng</li>
                            <li>Mobile: 0828266622</li>
                            <li>Website: <a href="https://zoomcheap.com">https://zoomcheap.com</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

       sendEmail($to, $cc, $bcc, $subject, $content);      
    }
}

function sendEmailAddMoney($email='', $fullName='', $coin= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[ZoomCheap] ' . 'Nạp thành công '.number_format($coin).'đ vào tài khoản';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền Zoom Cheap</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <style>
                .bao{background: #fafafa;margin: 40px;padding: 20px 20px 40px;}
                .logo{

                }
                .logo img{height: 115px;margin:  0 auto;display:  block;margin-bottom: 15px;}
                .nd{background: white;max-width: 750px;margin: 0 auto;border-radius: 12px;overflow:  hidden;border: 2px solid #e6e2e2;line-height: 2;}
                .head{background: #3fb901; color:white;text-align: center;padding: 15px 10px;font-size: 17px;text-transform: uppercase;}
                .main{padding: 10px 20px;}
                .thong_tin{padding: 0 20px 20px;}
                .line{position: relative;height: 2px;}
                .line1{position: absolute;top: 0;left: 0;width: 100%;height: 100%;background-image: linear-gradient(to right, transparent 50%, #737373 50%);background-size: 26px 100%;}
                .cty{text-align:  center;margin: 20px 0 30px;}
                .main .fa{color:green;}
                table{margin:auto;}
                @media screen and (max-width: 768px){
                    .bao{margin:0;}
                }
                @media screen and (max-width: 767px){
                    .bao{padding:6px; }
                    .nd{text-align: inherit;}
                }
            </style>
        </head>
        <body>
            <div class="bao">
                <div class="nd">
                    <div class="head">
                        <span>NẠP TIỀN '.number_format($coin).'Đ</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Bạn đã nạp thành công '.number_format($coin).'đ vào tài khoản của bạn trên hệ thống <a href="https://zoomcheap.com">https://zoomcheap.com</a>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH GIẢI PHÁP SỐ TOP TOP</span> <br>
                            <span>Dịch vụ thuê Zoom giá rẻ</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Vũ Tuyên Hoàng</li>
                            <li>Mobile: 0828266622</li>
                            <li>Website: <a href="https://zoomcheap.com">https://zoomcheap.com</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function randPass( $length ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars),0,$length);

}