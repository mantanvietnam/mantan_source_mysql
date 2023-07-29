<?php

function contact($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Liên hệ';

    $modelContacts = $controller->loadModel('Contacts');

    $mess = '';

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        $data = $modelContacts->newEmptyEntity();

        if(!empty($dataSend['subject']) && !empty($data->name) && !empty($data->phone_number)){
            // tạo dữ liệu save
            $data->subject = $dataSend['subject'];
            $data->name = $dataSend['name'];
            $data->email = $dataSend['email'];
            $data->phone_number = $dataSend['phone_number'];
            $data->content = $dataSend['content'];
            $data->submitted_at = time();
            
            $modelContacts->save($data);

            $mess = '<p class="text-danger">Lưu dữ liệu thành công</p>';
        }
        
    }

    setVariable('mess', $mess);
}
?>