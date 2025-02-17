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
 ?>