<?php 
$menus= array();
$menus[0]['title']= 'Google Drive';
$menus[0]['sub'][0]= array(	'title'=>'Cài đặt phân quyền',
							'url'=>'/plugins/admin/drive_google-view-permissionDrive',
							'classIcon'=>'bx bxs-data',
							'permission'=>'permissionDrive'
						);

addMenuAdminMantan($menus);

global $clientIdDrive;
global $clientSecretDrive;
global $spreadsheetIdOrder;
global $modelOptions;

$clientIdDrive = '';
$clientSecretDrive = '';
$spreadsheetIdOrder = '';

$conditions = array('key_word' => 'settingSecretDrive');
$settingSecretDrive = $modelOptions->find()->where($conditions)->first();
if(!empty($settingSecretDrive->value)){
	$value = json_decode($settingSecretDrive->value, true);

	$clientIdDrive = $value['clientIdDrive'];
	$clientSecretDrive = $value['clientSecretDrive'];
	$spreadsheetIdOrder = $value['spreadsheetIdOrder'];
}

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

function showButtonPermissionDrive()
{
	global $urlHomes;
	global $clientIdDrive;


	$redirectUri = $urlHomes."googleDriveCallback"; 
	$scope = "https://www.googleapis.com/auth/drive.file https://www.googleapis.com/auth/spreadsheets";
	$responseType = "code";
	$accessType = "offline"; // Để lấy refresh_token
	$prompt = "consent"; // Luôn hiển thị yêu cầu cấp quyền

	$authUrl = "https://accounts.google.com/o/oauth2/auth?" . http_build_query([
	    "client_id" => $clientIdDrive,
	    "redirect_uri" => $redirectUri,
	    "scope" => $scope,
	    "response_type" => $responseType,
	    "access_type" => $accessType,
	    "prompt" => $prompt
	]);

	return '<a href="'.$authUrl.'">
		        <button class="btn btn-danger">Ủy quyền Google Drive</button>
		    </a>';
	
}

function getFirstSheetName($accessToken, $spreadsheetId) {
    $url = "https://sheets.googleapis.com/v4/spreadsheets/$spreadsheetId";
    
    $headers = [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    
    if (isset($data['sheets'][0]['properties']['title'])) {
        return $data['sheets'][0]['properties']['title']; // Tên sheet đầu tiên
    } else {
        return null; // Không tìm thấy sheet nào
    }
}

function addRowToGoogleSheet($values=[], $spreadsheetId='', $sheetName='') 
{
	global $modelOptions;
	global $spreadsheetIdOrder;

	if(!empty($spreadsheetId) && !empty($values)){

		$conditions = array('key_word' => 'tokenPermissionDrive');
	    $data = $modelOptions->find()->where($conditions)->first();
	    if(empty($data)){
	        $data = $modelOptions->newEmptyEntity();
	    }

	    if(!empty($data->value)){
		    $token = json_decode($data->value, true);

	    	$deadline = $token['created']+$token['expires_in'];

	    	if($deadline<=time()){
	    		$token = getNewTokenDrive($token['refresh_token']);
	    	}

	    	if(empty($spreadsheetId)){
	    		$spreadsheetId = $spreadsheetIdOrder;
	    	}

	    	if(empty($sheetName)){
	    		$sheetName = getFirstSheetName($token['access_token'], $spreadsheetId);
	    	}

		    $url = "https://sheets.googleapis.com/v4/spreadsheets/$spreadsheetId/values/". urlencode($sheetName) .":append?valueInputOption=RAW";

		    $postData = [
		        "values" => [$values]
		    ];

		    $headers = [
		        "Authorization: Bearer ".$token['access_token'],
		        "Content-Type: application/json"
		    ];

		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_POST, 1);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
		    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		    $response = curl_exec($ch);
		    curl_close($ch);
		  
		    return json_decode($response, true);
		}else{
			echo 'Chưa cấp quyền truy cập Drive';die;
		}
	}else{
		echo 'Gửi thiếu dữ liệu GG Drive';die;
	}
}

function getNewTokenDrive($refresh_token='')
{
	global $modelOptions;
	global $clientIdDrive;
	global $clientSecretDrive;

	$new_token = [];
	$old_token = [];

	if(!empty($refresh_token)){
		$url = 'https://oauth2.googleapis.com/token';

	    $postFields = [
	        'client_id'     => $clientIdDrive,
	        'client_secret' => $clientSecretDrive,
	        'refresh_token' => $refresh_token,
	        'grant_type'    => 'refresh_token',
	    ];

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	    $new_token = curl_exec($ch);
	    curl_close($ch);

	    $new_token = json_decode($new_token, true);

		$conditions = array('key_word' => 'tokenPermissionDrive');
	    $data = $modelOptions->find()->where($conditions)->first();
	    
	    $old_token = json_decode($data->value, true);
	    $old_token['access_token'] = $new_token['access_token'];
	    $old_token['created'] = time();

	    $data->value = json_encode($old_token);

        $modelOptions->save($data);
	}

	return $old_token;
}
?>