<?php
require __DIR__.'/library/apiclient/vendor/autoload.php';

function googleDriveCallback()
{	
	global $urlHomes;
	global $modelOptions;

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
?>