<?php 
/*Lễ hội*/
function listFestivalAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelFestival = $controller->loadModel('Festivals');
    $dataSend = $input['request']->getData();
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;

        $order= array('created'=>'desc');

        $totalData= $modelFestival->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

    // echo json_encode($return);
        return $return;
}

function detailFestivalAPI($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $modelFestival = $controller->loadModel('Festivals');
    $dataSend =$input['request']->getData();       
    if (!empty($dataSend['id'])) {
            $data=$modelFestival->get( (int) $dataSend['id']);
             $return= array('code'=>1,'data'=>$data);
        }


    //echo json_encode($return);
        return $return;
}

/*cơ quan hang chinh*/
function listGovernanceAgencyAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelGovernanceAgency = $controller->loadModel('GovernanceAgencys');
    $dataSend = $input['request']->getData();
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;

        $order= array('created'=>'desc');

        $totalData= $modelGovernanceAgency->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

    //echo json_encode($return);
        return $return;
}

function detailGovernanceAgencyAPI($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $modelGovernanceAgency = $controller->loadModel('GovernanceAgencys');
    $dataSend =$input['request']->getData(); 

    if (!empty($dataSend['id'])) {
            $data=$modelGovernanceAgency->get( (int) $dataSend['id']);
             $return= array('code'=>1,'data'=>$data);
        }


   // echo json_encode($return);
    return $return;
}

/*Dịch vụ hỗ trợ*/
function listServiceAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelService = $controller->loadModel('Services');
    $dataSend = $input['request']->getData();
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;
        $order= array('created'=>'desc');

        $totalData= $modelService->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

    //echo json_encode($return);
        return $return;
}

function detailServiceAPI($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $modelService = $controller->loadModel('Services');
    $dataSend =$input['request']->getData();       
    if (!empty($dataSend['id'])) {
            $data=$modelService->get( (int) $dataSend['id']);
             $return= array('code'=>1,'data'=>$data);
        }


   // echo json_encode($return);
    return $return;
}

/*Làng nghề */
function listCraftvillageAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelCraftvillage = $controller->loadModel('Craftvillages');
    $dataSend = $input['request']->getData();
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }

        $order= array('created'=>'desc');
        $conditions['status']= 1;

        $totalData= $modelCraftvillage->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

    //echo json_encode($return);
        return $return;
}

function detailCraftvillageAPI($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $modelCraftvillage = $controller->loadModel('Craftvillages');
    $dataSend =$input['request']->getData();       
    if (!empty($dataSend['id'])) {
            $data=$modelCraftvillage->get( (int) $dataSend['id']);
             $return= array('code'=>1,'data'=>$data);
        }


   // echo json_encode($return);
        return $return;
}

/*Sự kện */
function listEventAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelEvent = $controller->loadModel('Events');
    $dataSend = $input['request']->getData();
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
         if(!empty($dataSend['month'])){
             
            $conditions['month']= $dataSend['month'];
        }

        if(!empty($dataSend['year'])){
             
            $conditions['year']= $dataSend['year'];
        }

        
        $conditions['status']= 1;

        $order= array('created'=>'desc');

        $totalData= $modelEvent->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

    //echo json_encode($return);
        return $return;
}

function detailEventAPI($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $modelEvent = $controller->loadModel('Events');
    $dataSend =$input['request']->getData();       
    if (!empty($dataSend['id'])) {
            $data=$modelEvent->get( (int) $dataSend['id']);
             $return= array('code'=>1,'data'=>$data);
        }


   // echo json_encode($return);
        return $return;
}

/*Danh lam */
function listPlaceAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelPlace = $controller->loadModel('Places');
    $dataSend = $input['request']->getData();
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;
        $order= array('created'=>'desc');

        $totalData= $modelPlace->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

    //echo json_encode($return);
        return $return;
}

function detailPlaceAPI($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $modelPlace = $controller->loadModel('Places');
    $dataSend =$input['request']->getData();       
    if (!empty($dataSend['id'])) {
            $data=$modelPlace->get( (int) $dataSend['id']);
             $return= array('code'=>1,'data'=>$data);
        }


   // echo json_encode($return);
    return $return;
}

/*Trung tâm hội nghị sư khện */
function listEventcenterAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelEventcenter = $controller->loadModel('Eventcenters');
    $dataSend = $input['request']->getData();
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;
        $order= array('created'=>'desc');

        $totalData= $modelEventcenter->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

    //echo json_encode($return);
        return $return;
}

function detailEventcenterAPI($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $modelEventcenter = $controller->loadModel('Eventcenters');
    $dataSend =$input['request']->getData();       
    if (!empty($dataSend['id'])) {
            $data=$modelEventcenter->get( (int) $dataSend['id']);
             $return= array('code'=>1,'data'=>$data);
        }


   // echo json_encode($return);
    return $return;
}

/*ảnh 360 */
function listImage360API($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelImage = $controller->loadModel('Images');
    $dataSend = $input['request']->getData();
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }

        $order= array('created'=>'desc');

        $totalData= $modelEvent->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

   // echo json_encode($return);
        return $return;
}

function detailEventImage360API($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $modelEventImage = $controller->loadModel('Images');
    $dataSend =$input['request']->getData();       
    if (!empty($dataSend['id'])) {
            $data=$modelEventImage->get( (int) $dataSend['id']);
             $return= array('code'=>1,'data'=>$data);
        }


   // echo json_encode($return);
        return $return;
}

 ?>