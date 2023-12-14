<?php

function contact($input)
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

    $modelContacts = $controller->loadModel('Contacts');

    $mess = '';

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        $data = $modelContacts->newEmptyEntity();

        if(!empty($dataSend['subject']) && !empty($dataSend['name']) && !empty($dataSend['phone_number'])){
            // tạo dữ liệu save
            $data->subject = @$dataSend['subject'];
            $data->name = @$dataSend['name'];
            $data->email = @$dataSend['email'];
            $data->phone_number = @$dataSend['phone_number'];
            $data->content = @$dataSend['content'];
            $data->submitted_at = time();
            
            $modelContacts->save($data);
            if(!empty($data_value['email'])){
                sendEmailContact(@$data_value['email'], @$dataSend['name'],@$dataSend['phone_number'],@$dataSend['subject'], @$dataSend['content']);
            }
            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }
        
    }

    setVariable('mess', $mess);
}
?>