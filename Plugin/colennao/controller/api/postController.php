<?php 
function listPostAPI($input){
    
    global $controller;
    $modelPost = $controller->loadModel('Posts');
    $dataSend = $input['request']->getData();
  
    $conditions = array();
    if(!empty($dataSend['name'])){
        $key=createSlugMantan($dataSend['name']);
        $conditions['slug LIKE']= '%'.$key.'%';
    }
       $order= array('created'=>'desc');
       $totalData= $modelPost->find()->where($conditions)->all()->toList();
       $return= array('code'=>1,'listData'=>$totalData);
   
       return $return;
}

function detailPostAPI($input){
   
   $return= array('code'=>0);
   global $controller;
   $modelPost = $controller->loadModel('Posts');
   $dataSend =$input['request']->getData();  

   if (!empty($dataSend['id'])) {
        $data=$modelPost->get( $dataSend['id']);
        $month=array();
        $order = array('time'=>'desc');
        $otherData = $modelPost->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();
        $return= array('code'=>1,'data'=>$data, 'otherData'=>$otherData);
       
   }
   return $return;
}

?>