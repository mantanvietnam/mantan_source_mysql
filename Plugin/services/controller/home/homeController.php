<?php

function listServicesAdmin($input)
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

    $servicesModel = $controller->loadModel('Services');

    $mess = '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $servicesModel->get( (int) $_GET['id']);
    }else{
        $data = $servicesModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        $data = $servicesModel->newEmptyEntity();
        
        if(!empty($dataSend['name']) && !empty($dataSend['phone_number']) && !empty($dataSend['email']) && !empty($dataSend['title'] && !empty($dataSend['content']))){
            // tạo dữ liệu save
            $data->title = @$dataSend['title'];
            $data->name = @$dataSend['name'];
            $data->email = @$dataSend['email'];
            $data->phone_number = @$dataSend['phone_number'];
            $data->content = @$dataSend['content'];

            $servicesModel->save($data);
          
            $mess = '<p class="text-success">Gửi yêu cầu liên hệ thành công</p>';
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }
        
    }
   
    setVariable('mess', $mess);

}
?>