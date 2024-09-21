<?php

function contributecomments($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'đóng góp ý kiến';

    $modelcontributecomments = $controller->loadModel('contributecomments');

    $mess = '';

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        $data = $modelcontributecomments->newEmptyEntity();

        if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->email = @$dataSend['email'];
            $data->phone = @$dataSend['phone'];
            $data->content = @$dataSend['content'];
            $data->submitted_at = time();
            $modelcontributecomments->save($data);
            $mess = '<p class="text-success">Cảm ơn đóng góp từ bạn.Ý kiến của bạn đã được gửi đi.</p>';
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }
        
    }

    setVariable('mess', $mess);
}
?>