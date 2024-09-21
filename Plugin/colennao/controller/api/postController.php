<?php 
function listPostAPI($input){
    
    global $controller;
    global $isRequestPost;
    $modelPost = $controller->loadModel('Posts');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $conditions = array();
        if(!empty($dataSend['name'])){
            $key = createSlugMantan($dataSend['name']);
            $conditions['slug LIKE'] = '%'.$key.'%';
        }
        $order = array('created'=>'desc');
        $totalData = $modelPost->find()->where($conditions)->all()->toList();
        $return = array('code'=>1,'listData'=>$totalData);
    }else{
        return array('code'=>0,'mess'=>'gửi sai kiểu post');
    }
   
       return $return;
}

function detailPostAPI($input){
   
   $return= array('code'=>0);
   global $controller;
   global $isRequestPost;
   $metaTitleMantan = 'chi tiết tin tức';
   $modelPost = $controller->loadModel('Posts');
   
   if($isRequestPost){
        $dataSend =$input['request']->getData(); 
        $data = $modelPost->get($dataSend['id']);
        $month = array();
        $order = array('time'=>'desc');
        $otherData = $modelPost->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();
        $return = array('code'=>1,'data'=>$data,'otherData'=>$otherData);
   }else{
        $return = array('code'=>0,'mess'=>'gửi sai kiểu post');
   }

   return $return;
}

?>