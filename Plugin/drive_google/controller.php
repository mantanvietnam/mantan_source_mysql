<?php
//require __DIR__.'/library/apiclient/vendor/autoload.php';

function googleDriveCallback()
{	
	global $urlHomes;
	global $modelOptions;
	global $controller;

	$client = new Google_Client();
	$client->setAuthConfig(__DIR__.'/config/credentials.json'); // File JSON tải từ Google Cloud
	$client->setRedirectUri($urlHomes."googleDriveCallback"); // Trùng với Google Cloud
	$client->addScope(Google_Service_Drive::DRIVE_FILE);
	$client->addScope(Google_Service_Sheets::SPREADSHEETS);
	$client->setAccessType('offline');

	if (isset($_GET['code'])) {
	    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

	    $conditions = array('key_word' => 'tokenPermissionDrive');
	    $data = $modelOptions->find()->where($conditions)->first();
	    if(empty($data)){
	        $data = $modelOptions->newEmptyEntity();
	    }

	    $data->key_word = 'tokenPermissionDrive';
        $data->value = json_encode($token);

        $modelOptions->save($data);
	    
	    return $controller->redirect('/plugins/admin/drive_google-view-permissionDrive');
	}

	echo "Không có mã xác thực!";
}

function permissionDrive($input)
{
	global $modelOptions;
	global $isRequestPost;
    
    $conditions = array('key_word' => 'settingSecretDrive');
    $settingSecretDrive = $modelOptions->find()->where($conditions)->first();
    if(empty($settingSecretDrive)){
        $settingSecretDrive = $modelOptions->newEmptyEntity();
    }
    
    $mess = '';

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

        $value['clientIdDrive']= $dataSend['clientIdDrive'];
        $value['clientSecretDrive']= $dataSend['clientSecretDrive'];
        $value['spreadsheetIdOrder']= $dataSend['spreadsheetIdOrder'];


        $settingSecretDrive->key_word = 'settingSecretDrive';
        $settingSecretDrive->value = json_encode($value);

        $modelOptions->save($settingSecretDrive);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data = [];
    if(!empty($settingSecretDrive->value)){
    	$data = json_decode($settingSecretDrive->value, true);
    }

    $conditions = array('key_word' => 'tokenPermissionDrive');
    $tokenPermissionDrive = $modelOptions->find()->where($conditions)->first();
    $token = [];

    if(!empty($tokenPermissionDrive->value)){
    	$token = json_decode($tokenPermissionDrive->value, true);

    	$deadline = $token['created']+$token['expires_in'];

    	if($deadline<=time()){
    		$token = getNewTokenDrive($token['refresh_token']);
    		$mess .= 'Đã load lại token mới';
    	}

    	/*
    	$spreadsheetId= '19mBL1LeVVWli-kIQhCX5DFQtAdj4pTIMYgGL80cKVf4';
    	$row = ['Trần Mạnh', '0816560000', 'HN'];

    	addRowToGoogleSheet($row, $spreadsheetId);
    	*/
    }

    setVariable('token', $token);
    setVariable('data', $data);
    setVariable('mess', $mess);
}
?>