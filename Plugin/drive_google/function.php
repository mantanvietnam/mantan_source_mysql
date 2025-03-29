<?php 
$menus= array();
$menus[0]['title']= 'Google Drive';
$menus[0]['sub'][0]= array(	'title'=>'Cài đặt phân quyền',
							'url'=>'/plugins/admin/drive_google-view-permissionDrive',
							'classIcon'=>'bx bxs-data',
							'permission'=>'permissionDrive'
						);

addMenuAdminMantan($menus);

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
	        	// tìm ảnh trong thư mục con
	        	$folder = [];
	        	foreach ($json['items'] as $key => $value) {
	        		if($value['mimeType'] == 'application/vnd.google-apps.folder'){
	        			$folder = getListFileDrive($value['id']);
	        		}
	        	}

	        	$json['items'] = array_merge($folder, $json['items']);

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

function showButtonPermissionDrive($client_id='770286303827-8o6n91equnisth2u99n9o3f4f2va4cpv.apps.googleusercontent.com')
{
	global $urlHomes;
	//$client_id = "YOUR_CLIENT_ID"; // Thay bằng Client ID từ Google
	$redirect_uri = $urlHomes."googleDriveCallback"; // URL nhận phản hồi OAuth
	$scope = "https://www.googleapis.com/auth/drive.file https://www.googleapis.com/auth/spreadsheets";

	$auth_url = "https://accounts.google.com/o/oauth2/auth?"
	    . "response_type=code"
	    . "&client_id=" . $client_id
	    . "&redirect_uri=" . urlencode($redirect_uri)
	    . "&scope=" . urlencode($scope)
	    . "&access_type=offline"
	    . "&prompt=consent";

	echo '	<a href="'.$auth_url.'">
		        <button class="btn btn-danger">Ủy quyền Google Drive</button>
		    </a>';
}

function addRowExcelDrive($spreadsheetId='', $newRow=[])
{
	require __DIR__.'/library/apiclient/vendor/autoload.php';

	global $modelOptions;

	if(!empty($spreadsheetId) && !empty($newRow)){
		$conditions = array('key_word' => 'tokenPermissionDrive');
	    $data = $modelOptions->find()->where($conditions)->first();
	    if(empty($data)){
	        $data = $modelOptions->newEmptyEntity();
	    }

	    if(!empty($data->value)){
		    $token = json_decode($data->value, true);

			$client = new Google_Client();
			$client->setAuthConfig(__DIR__.'/config/credentials.json');
			$client->setAccessToken($token);

			$sheets = new Google_Service_Sheets($client);

			// Chọn sheet cần ghi dữ liệu (VD: "Sheet1")
			$range = "Sheet1"; // Nếu muốn chỉ định cột, có thể dùng "Sheet1!A:C"

			// Dữ liệu mới cần thêm vào hàng tiếp theo
			$newRow = [
			    "Nguyễn Văn B",     // Cột A - Họ Tên
			    "nguyenvanb@gmail.com", // Cột B - Email
			    date('Y-m-d H:i:s') // Cột C - Ngày Ghi
			];

			// Chuẩn bị dữ liệu gửi lên Google Sheets
			$body = new Google_Service_Sheets_ValueRange([
			    'values' => [$newRow]
			]);

			// Cấu hình API để thêm dòng mới vào vị trí tiếp theo
			$params = [
			    'valueInputOption' => 'RAW', // Giữ nguyên định dạng dữ liệu
			    'insertDataOption' => 'INSERT_ROWS' // Thêm dòng mới vào cuối bảng
			];

			// Gửi yêu cầu API
			$response = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

			// Thông báo kết quả
			if ($response) {
			    echo "✅ Thêm dữ liệu thành công vào Google Sheets! <a href='https://docs.google.com/spreadsheets/d/$spreadsheetId' target='_blank'>Xem bảng tính</a>";
			} else {
			    echo "❌ Lỗi khi thêm dữ liệu!";
			}
		}else{
			echo "Chưa cấp quyền Google Sheets!";
		}
	}else{
		echo "Chưa có ID file Google Sheets!";
	}
}
?>