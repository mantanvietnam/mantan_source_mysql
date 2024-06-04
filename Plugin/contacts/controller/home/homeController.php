<?php

function addContactAdmin($input)
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

    $metaTitleMantan = 'Liên hệ';

    $contactModel = $controller->loadModel('Contacts');

    $mess = '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $contactModel->get( (int) $_GET['id']);
    }else{
        $data = $contactModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        $data = $contactModel->newEmptyEntity();
        
        if(!empty($dataSend['name']) && !empty($dataSend['phone_number']) && !empty($dataSend['email']) && !empty($dataSend['object'] && !empty($dataSend['message']))){
            // tạo dữ liệu save
            $data->object = @$dataSend['object'];
            $data->name = @$dataSend['name'];
            $data->email = @$dataSend['email'];
            $data->phone_number = @$dataSend['phone_number'];
            $data->message = @$dataSend['message'];

            $contactModel->save($data);
          
            $mess = '<p class="text-success">Gửi yêu cầu liên hệ thành công</p>';
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }
        
    }
   
    setVariable('mess', $mess);

}
?>