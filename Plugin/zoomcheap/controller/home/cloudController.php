<?php 
function listCloud($input){
    global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách clound zoom';
	$modelZooms = $controller->loadModel('Zooms');
    $modelRooms = $controller->loadModel('Rooms');
    $modelOrders = $controller->loadModel('Orders');
    $modelmanagers = $controller->loadModel('managers');
    
    $clientid = $_GET['clientid'] ?? '';
    $clientsecret = $_GET['clientsecret'] ?? '';
    $accountid = $_GET['accountid'] ?? '';
    $idmeeting = $_GET['idmeeting'] ?? '';
    if (!empty($clientid) && !empty($clientsecret) && !empty($accountid) && !empty($idmeeting)) {
        $cloudRecords = getmeetingcloud($clientid, $clientsecret, $accountid, $idmeeting);
    } else {
        return 'https://zoomcheap.2top.vn/listCloud/';
    }
    setVariable('cloudRecords', $cloudRecords);
   
}
function listparticipants($input){
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách người đã tham gia';
	$modelZooms = $controller->loadModel('Zooms');
    $modelRooms = $controller->loadModel('Rooms');
    $modelOrders = $controller->loadModel('Orders');
    $modelmanagers = $controller->loadModel('managers');
    
    $clientid = $_GET['clientid'] ?? '';
    $clientsecret = $_GET['clientsecret'] ?? '';
    $accountid = $_GET['accountid'] ?? '';
    $idmeeting = $_GET['idmeeting'] ?? '';
    if (!empty($clientid) && !empty($clientsecret) && !empty($accountid) && !empty($idmeeting)) {
        $listregistrant = getreportregistrant($clientid, $clientsecret, $accountid, $idmeeting);
    } else {
        return 'https://zoomcheap.2top.vn/listparticipants/';
    }
    setVariable('listregistrant', $listregistrant);
}
function addNotification($input)
{
    global $controller;
    global $isRequestPost;
    global $session;

    if (!empty($session->read('infoUser'))) {
        $modelManagers = $controller->loadModel('Managers');
        $mess = '';


        $infoUser = $modelManagers->find()->where(['id' => $session->read('infoUser')->id])->first();

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();


            if (isset($dataSend['email_nofitication'])) {
                $infoUser->email_nofitication = 1; 
            } else {
                $infoUser->email_nofitication = 0; 
            }


            if ($modelManagers->save($infoUser)) {

                if ($infoUser->email_nofitication == 1) {
                     $mess= '<p class="text-success">Bạn đã đăng ký nhận thông báo thành công</p>';
                } else {
                    $mess= '<p class="text-danger">Bạn đã hủy đăng ký nhận thông báo</p>';
                }
            } else {
                $errors = $infoUser->getErrors();
                $mess = 'Có lỗi xảy ra khi lưu thông tin: ' . json_encode($errors);
            }
        }


        $session->write('infoUser', $infoUser);
        setVariable('infoUser', $infoUser);
        setVariable('mess', $mess);
    } else {
        return $controller->redirect('/login'); 
    }
}







?>