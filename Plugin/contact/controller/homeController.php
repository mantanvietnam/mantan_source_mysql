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

        if(!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['subject']) && !empty($dataSend['content'])){
            // tạo dữ liệu save
            $data->subject = @$dataSend['subject'];
            $data->name = @$dataSend['name'];
            $data->email = @$dataSend['email'];
            $data->phone_number = @$dataSend['phone'];
            $data->content = @$dataSend['content'];
            $data->submitted_at = time();
            $modelContacts->save($data);
            if(!empty($data_value['email'])){
                sendEmailContact(@$data_value['email'], @$dataSend['name'],@$dataSend['phone'], @$dataSend['content']);
            }
            $mess = '<p class="text-success">Gửi yêu cầu liên hệ thành công</p>';
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }
        
    }

    setVariable('mess', $mess);
}

function contactAPI($input)
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

    $return = '';

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        $data = $modelContacts->newEmptyEntity();

        if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
            // tạo dữ liệu save
           $data->subject = @$dataSend['subject'];
            $data->name = @$dataSend['name'];
            $data->email = @$dataSend['email'];
            $data->phone_number = @$dataSend['phone'];
            $data->content = @$dataSend['content'];
            $data->submitted_at = time();
            $modelContacts->save($data);
           /* if(!empty($data_value['email'])){
                sendEmailContact(@$data_value['email'], @$dataSend['name'],@$dataSend['phone_number'], @$dataSend['content']);
            }*/
            $return =  array('code'=>1, 'mess'=>'Bạn gửi thành công');
        }else{
            $return = array('code'=>0, 'mess'=>'Bạn gửi thiếu dữ liệu');
        }
        
    }

   return $return;
}
?>