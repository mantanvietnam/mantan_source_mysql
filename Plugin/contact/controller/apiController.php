<?php 
function savecontactAPI ($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    $modelCustomer = $controller->loadModel('contact');

       
    $dataSend = $input['request']->getData();

     $data = $modelCustomer->newEmptyEntity();
     $data->created_at = getdate()[0];
         if(!empty($dataSend)){
            // tạo dữ liệu save
            $data->fullname = @$dataSend['fullname'];
            $data->content = @$dataSend['content'];
            $data->phone_number = @$dataSend['phone'];
            $data->email = @$dataSend['email'];
            $data->subject = @$dataSend['subject'];

            $modelCustomer->save($data);
         
             $return = array('code'=>1,
                            'data' =>$data,
                            'messages'=>'Bạn lưu liên hệ thành công '
            );
             }else{
                 $return = array('code'=>2,
                            'messages'=>'Bạn lưu liên hệ không thành công'
            );
             }
        return $return;
}
 ?>