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
function addNotification($input){
    global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách clound zoom';
	$modelZooms = $controller->loadModel('Zooms');
    $modelRooms = $controller->loadModel('Rooms');
    $modelOrders = $controller->loadModel('Orders');
    $modelmanagers = $controller->loadModel('managers');
    
  

   
}
?>