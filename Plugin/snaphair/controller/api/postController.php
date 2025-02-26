<?php 	
function listPostAPI($input){
    
    global $controller;
    global $isRequestPost;
    global $modelPosts;
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $totalData = $modelPosts->find()->all()->toList();
  
        return apiResponse(3, 'bạn lấy dũ liệu thành công ', $totalData);
        
    }
}

function detailPostAPI($input){
   
   $return= array('code'=>0);
   global $controller;
   global $isRequestPost;
    global $modelPosts;
   $metaTitleMantan = 'chi tiết tin tức';

   
   if($isRequestPost){
        $dataSend =$input['request']->getData(); 
        if(!empty($dataSend['id'])){
            $data = $modelPosts->get($dataSend['id']);
            $return = apiResponse(1,'gửi thiếu dữ liệu', $data);
        }else{
            $return = apiResponse(1,'gửi thiếu dữ liệu');
        }

   }else{
        $return = apiResponse(0,'gửi sai kiểu post');
   }

   return $return;
}


function getInfoContactAPI($input){
    global $modelOptions;
    $conditions = array('key_word' => 'contact_site');
    $contact_site = $modelOptions->find()->where($conditions)->first();

    $contact_site_value = array();
        if(!empty($contact_site->value)){
            $contact_site_value = json_decode($contact_site->value, true);
        }


    return apiResponse(0, 'Lấy dữ liệu thành công', $contact_site_value);
}

function getParameterAPI(){
    return apiResponse(1, 'Lấy dữ liệu thành công', getParameter());
}
 ?>