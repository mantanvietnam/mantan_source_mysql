<?php 
function getListFileDrive($id_folder='')
{
	$apiKeyDrive = 'AIzaSyCOoYx8DCIEM7LTgZfiATh3gaLhplMPd34';

	// Tạo URL yêu cầu
	$url = 'https://www.googleapis.com/drive/v2/files';

	// Thiết lập tham số yêu cầu
	$params = array(
		'q' => "'".$id_folder."'+in+parents",
	    'pageSize' => 100,
	    'key' => $apiKeyDrive
	);

	// Gửi yêu cầu HTTP GET sử dụng cURL
	$files = array();

	do {
		$urlSend = $url . '?' . http_build_query($params);
		$urlSend = str_replace('%2B', '+', $urlSend);
		
	    // Gửi yêu cầu
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $urlSend);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($ch);
	    curl_close($ch);

	    // Kiểm tra và xử lý kết quả
	    if ($response === false) {
	        echo 'Lỗi kết nối tới API.';
	        break;
	    } else {
	        $json = json_decode($response, true);
	        
	        if (isset($json['items'])) {
	            // Thêm các tệp tin vào mảng
	            $files = array_merge($files, $json['items']);

	            // Kiểm tra nếu có nextPageToken
	            if (isset($json['nextPageToken'])) {
	                // Thiết lập nextPageToken cho yêu cầu tiếp theo
	                $params['pageToken'] = $json['nextPageToken'];
	            } else {
	                // Không có nextPageToken, thoát vòng lặp
	                break;
	            }
	        } else {
	            echo 'Không có kết quả trả về.';
	            break;
	        }
	    }
	} while (true);

	return $files;
}


?>