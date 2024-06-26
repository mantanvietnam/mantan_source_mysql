<?php

function addRegisterAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelOptions;
    $conditions = array('key_word' => 'contact_site');
    $data = $modelOptions->find()->where($conditions)->first();

    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    $metaTitleMantan = 'Đăng ký';

    $registerModel = $controller->loadModel('Registers');

    $mess = '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $registerModel->get( (int) $_GET['id']);
    }else{
        $data = $registerModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        $data = $registerModel->newEmptyEntity();
        
        if(!empty($dataSend['name']) && !empty($dataSend['phone_number']) && !empty($dataSend['email']) && !empty($dataSend['course'] && !empty($dataSend['address']) && !empty($dataSend['centre']))){
            // tạo dữ liệu save
            $data->address = @$dataSend['address'];
            $data->name = @$dataSend['name'];
            $data->email = @$dataSend['email'];
            $data->phone_number = @$dataSend['phone_number'];
            $data->course = @$dataSend['course'];
            $data->centre = @$dataSend['centre'];

            $registerModel->save($data);
          
            $mess = '<p class="text-success">Gửi yêu cầu liên hệ thành công</p>';
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }
        
    }
   
    setVariable('mess', $mess);

}
?>