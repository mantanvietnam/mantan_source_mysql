<?php 
function searchDiscountCodeAgencyAPI($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $return = array('code'=>1);

    $modelDiscountCode = $controller->loadModel('DiscountCodes');
    
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
    }

    $conditions = array();
    
    if(!empty($_GET['code']) && !empty($_GET['id_member'])){
        $conditions['code'] = strtoupper($_GET['code']);
        $conditions['status'] = 1;
        $conditions['id_member'] = (int) $_GET['id_member'];
        
        $data = $modelDiscountCode->find()->where($conditions)->first();

        if(!empty($data)){
            $return = array('code'=>0, 'mess'=>'', 'data'=>$data);
        }else{
            $return = array('code'=>3, 'mess'=>'Không tồn tại mã khuyến mại này');
        }
    }else{
        $return = array('code'=>2, 'mess'=>'');
    }

    return $return;
} 
 ?>