<?php
function saveTokenDeviceAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelTokenDevices = $controller->loadModel('TokenDevices');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token_device'])){
            $data = $modelTokenDevices->find()->where(['token_device'=>$dataSend['token_device']])->first();
    
            if(empty($data)){
                $save = $modelTokenDevices->newEmptyEntity();

                $save->token_device = trim($dataSend['token_device']);

                $modelTokenDevices->save($save);

                $return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công');
            }else{
                $return = array('code'=>3, 'mess'=>'Token đã tồn tại');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
            
    }

    return $return;
}