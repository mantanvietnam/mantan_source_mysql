<?php 
/*Lễ hội*/
function listFestivalAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelFestival = $controller->loadModel('Festivals');
    $dataSend = $input['request']->getData();
    if(@$dataSend['language']=='en'){

        $dataPost= array('name'=>@$dataSend['name']);
            $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/listFestivalAPI', $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $return= json_decode($listData, true);
           
    }else{
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;

        $order= array('created'=>'desc');


        $totalData= $modelFestival->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

    }
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
         if(@$dataSend['language']=='en'){
            $dataPost= array('id'=>$dataSend['id']);
                $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/detailFestivalAPI', $dataPost);
                $listData= str_replace('ï»¿', '', utf8_encode($listData));
                $return= json_decode($listData, true);
               
        }else{    
    
            $data=$modelFestival->get( (int) $dataSend['id']);
            $data['listImage']=array( 
                $data['image'],
                $data['image2'],
                $data['image3'],
                $data['image4'],
                $data['image5'],
                $data['image6'],
                $data['image7'],
                $data['image8'],
                $data['image9'],
                $data['image10'],
        );

        $month=array();
        $month['status']=1;
        $order = array('created'=>'desc');
        $otherData = $modelFestival->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();

            $return= array('code'=>1,'data'=>$data,'otherData'=>$otherData);
        }
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
    if(@$dataSend['language']=='en'){

        $dataPost= array('name'=>@$dataSend['name']);
            $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/listGovernanceAgencyAPI', $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $return= json_decode($listData, true);
           
    }else{    
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;

        $order= array('created'=>'desc');

        $totalData= $modelGovernanceAgency->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);
    }

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
        if(@$dataSend['language']=='en'){
            $dataPost= array('id'=>$dataSend['id']);
                $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/detailGovernanceAgencyAPI', $dataPost);
                $listData= str_replace('ï»¿', '', utf8_encode($listData));
                $return= json_decode($listData, true);
               
        }else{ 
            $data=$modelGovernanceAgency->get( (int) $dataSend['id']);
            $data['listImage']=array( 
                $data['image'],
                $data['image2'],
                $data['image3'],
                $data['image4'],
                $data['image5'],
                $data['image6'],
                $data['image7'],
                $data['image8'],
                $data['image9'],
                $data['image10'],
        );
            $month=array();
        $month['status']=1;
        $order = array('created'=>'desc');
        $otherData = $modelGovernanceAgency->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();

            $return= array('code'=>1,'data'=>$data,'otherData'=>$otherData);
        }
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
    if(@$dataSend['language']=='en'){

        $dataPost= array('name'=>@$dataSend['name']);
            $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/listServiceAPI', $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $return= json_decode($listData, true);
           
    }else{
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;
        $order= array('created'=>'desc');

        $totalData= $modelService->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);
    }

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
        if(@$dataSend['language']=='en'){
            $dataPost= array('id'=>$dataSend['id']);
                $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/detailServiceAPI', $dataPost);
                $listData= str_replace('ï»¿', '', utf8_encode($listData));
                $return= json_decode($listData, true);
               
        }else{
            $data=$modelService->get( (int) $dataSend['id']);
            $data['listImage']=array( 
                $data['image'],
                $data['image2'],
                $data['image3'],
                $data['image4'],
                $data['image5'],
                $data['image6'],
                $data['image7'],
                $data['image8'],
                $data['image9'],
                $data['image10'],
        );
        $month=array();
        $month['status']=1;
        $order = array('created'=>'desc');
        $otherData = $modelService->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();

            $return= array('code'=>1,'data'=>$data,'otherData'=>$otherData);
        }
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
    if(@$dataSend['language']=='en'){

        $dataPost= array('name'=>@$dataSend['name']);
            $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/listCraftvillageAPI', $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $return= json_decode($listData, true);
           
    }else{    
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }

        $order= array('created'=>'desc');
        $conditions['status']= 1;

        $totalData= $modelCraftvillage->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);
    }

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
        if(@$dataSend['language']=='en'){
            $dataPost= array('id'=>$dataSend['id']);
                $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/detailCraftvillageAPI', $dataPost);
                $listData= str_replace('ï»¿', '', utf8_encode($listData));
                $return= json_decode($listData, true);
               
        }else{
            $data=$modelCraftvillage->get( (int) $dataSend['id']);
            $data['listImage']=array( 
                $data['image'],
                $data['image2'],
                $data['image3'],
                $data['image4'],
                $data['image5'],
                $data['image6'],
                $data['image7'],
                $data['image8'],
                $data['image9'],
                $data['image10'],
        );
            $month=array();
            $month['status']=1;
            $order = array('created'=>'desc');
            $otherData = $modelCraftvillage->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();

            $return= array('code'=>1,'data'=>$data,'otherData'=>$otherData);
        }
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
    if(@$dataSend['language']=='en'){

        $dataPost= array('name'=>@$dataSend['name'],'month'=>@$dataSend['month'],'year'=>@$dataSend['year'] );
            $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/listEventAPI', $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $return= json_decode($listData, true);
           
    }else{   
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
    }

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
        if(@$dataSend['language']=='en'){
            $dataPost= array('id'=>$dataSend['id']);
                $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/detailEventAPI', $dataPost);
                $listData= str_replace('ï»¿', '', utf8_encode($listData));
                $return= json_decode($listData, true);
               
        }else{
            $data=$modelEvent->get( (int) $dataSend['id']);
            $data['listImage']=array( 
                $data['image'],
                $data['image2'],
                $data['image3'],
                $data['image4'],
                $data['image5'],
                $data['image6'],
                $data['image7'],
                $data['image8'],
                $data['image9'],
                $data['image10'],
        );
            $month=array();
            if(!empty(@$data->month)){
            $month['month']=@$data->month;
            }
            $month['status']=1;
            $order = array('created'=>'desc');
            $otherData = $modelEvent->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();

            $return= array('code'=>1,'data'=>$data,'otherData'=>$otherData);
        }
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
    if(@$dataSend['language']=='en'){

        $dataPost= array('name'=>@$dataSend['name']);
            $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/listPlaceAPI', $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $return= json_decode($listData, true);
           
    }else{    
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;
        $order= array('created'=>'desc');

        $totalData= $modelPlace->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

    }

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
         if(@$dataSend['language']=='en'){
            $dataPost= array('id'=>$dataSend['id']);
                $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/detailPlaceAPI', $dataPost);
                $listData= str_replace('ï»¿', '', utf8_encode($listData));
                $return= json_decode($listData, true);
               
        }else{
            $data=$modelPlace->get( (int) $dataSend['id']);
            $data['listImage']=array( 
                $data['image'],
                $data['image2'],
                $data['image3'],
                $data['image4'],
                $data['image5'],
                $data['image6'],
                $data['image7'],
                $data['image8'],
                $data['image9'],
                $data['image10'],
        );
            $month=array();
            $month['status']=1;
            $order = array('created'=>'desc');
            $otherData = $modelPlace->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();

            $return= array('code'=>1,'data'=>$data,'otherData'=>$otherData);
        }
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
    if(@$dataSend['language']=='en'){

        $dataPost= array('name'=>@$dataSend['name']);
            $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/listEventcenterAPI', $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $return= json_decode($listData, true);
           
    }else{    
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;
        $order= array('created'=>'desc');

        $totalData= $modelEventcenter->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);
    }
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
        if(@$dataSend['language']=='en'){
            $dataPost= array('id'=>$dataSend['id']);
                $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/detailEventcenterAPI', $dataPost);
                $listData= str_replace('ï»¿', '', utf8_encode($listData));
                $return= json_decode($listData, true);
               
        }else{
            $data=$modelEventcenter->get( (int) $dataSend['id']);
            $data['listImage']=array( 
                $data['image'],
                $data['image2'],
                $data['image3'],
                $data['image4'],
                $data['image5'],
                $data['image6'],
                $data['image7'],
                $data['image8'],
                $data['image9'],
                $data['image10'],
        );
             $month=array();
            $month['status']=1;
            $order = array('created'=>'desc');
            $otherData = $modelEventcenter->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();

            $return= array('code'=>1,'data'=>$data,'otherData'=>$otherData);
        }
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
    if(@$dataSend['language']=='en'){

        $dataPost= array('name'=>@$dataSend['name']);
            $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/listImage360API', $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $return= json_decode($listData, true);
           
    }else{
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }

        $order= array('created'=>'desc');

        $totalData= $modelEvent->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

    }

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
        if(@$dataSend['language']=='en'){
            $dataPost= array('id'=>$dataSend['id']);
                $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/detailEventImage360API', $dataPost);
                $listData= str_replace('ï»¿', '', utf8_encode($listData));
                $return= json_decode($listData, true);
               
        }else{
            $data=$modelEventImage->get( (int) $dataSend['id']);
             $return= array('code'=>1,'data'=>$data);
        }
    }


   // echo json_encode($return);
        return $return;
}

/*tour*/
function listTourAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelTour = $controller->loadModel('Tours');
    $dataSend = $input['request']->getData();
    if(@$dataSend['language']=='en'){

        $dataPost= array('name'=>@$dataSend['name']);
            $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/listTourAPI', $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $return= json_decode($listData, true);
           
    }else{
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;
        $order= array('created'=>'desc');

        $totalData= $modelTour->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);
    }
    //echo json_encode($return);
        return $return;
}

function detailTourAPI($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $modelTour = $controller->loadModel('Tours');
    $dataSend =$input['request']->getData();     
    if (!empty($dataSend['id'])) {
        if(@$dataSend['language']=='en'){
            $dataPost= array('id'=>$dataSend['id']);
                $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/detailTourAPI', $dataPost);
                $listData= str_replace('ï»¿', '', utf8_encode($listData));
                $return= json_decode($listData, true);
               
        }else{
            $data=$modelTour->get( (int) $dataSend['id']);
            $data['listImage']=array( 
                $data['image'],
                $data['image2'],
                $data['image3'],
                $data['image4'],
                $data['image5'],
                $data['image6'],
                $data['image7'],
                $data['image8'],
                $data['image9'],
                $data['image10'],
        );
        $modelReport = $controller->loadModel('Reports');

         $repor = array();

        $repor['idtour'] = $data->id;

        $listRepor = $modelReport->find()->where($repor)->all();
         $month=array();
            $month['status']=1;
            $order = array('created'=>'desc');
            $otherData = $modelTour->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();

         

             $return= array('code'=>1,'data'=>$data, 'lichtrinh'=>$listRepor,'otherData'=>$otherData);
        }
    }


   // echo json_encode($return);
    return $return;
}

function booktourAPI($input) {
     global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelBookTour = $controller->loadModel('Booktours');

    $dataSend = $input['request']->getData();
     $return= array('code'=>0,'data'=>'');

    
    if(!empty($dataSend['name'])){

        $data = $modelBookTour->newEmptyEntity();
             $data->created = getdate()[0];

        $data->idtour = (int) @$dataSend['idtour'];
        $data->idcustomer = (int) @$dataSend['idcustomer'];
        $data->name = @$dataSend['name'];
        $data->phone = @$dataSend['phone'];
        $data->email = @$dataSend['email'];
        $data->numberpeople = (int) @$dataSend['numberpeople'];
        $data->note = @$dataSend['not'];
        $data->status = 'processing';


      
        if($modelBookTour->save($data)){
          $return = array('code'=>1,'data'=>'bạn đăt tuor thành công ');
        }else{
        $return = array('code'=>0,'data'=>'bạn đăt tuor không thành công');
        }

    }else{
        $return= array('code'=>0,'data'=>'bạn đăt tuor không thành công');
    } 
      return $return;
}

/*Tin tíc*/
function listPostAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelPost = $controller->loadModel('Posts');
    $dataSend = $input['request']->getData();
     if(@$dataSend['language']=='en'){

        $dataPost= array('name'=>@$dataSend['name']);
            $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/listPostAPI', $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $return= json_decode($listData, true);
           
    }else{   
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['slug']= array('$regex' => $key);
        }
       
        $order= array('created'=>'desc');

        $totalData= $modelPost->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);
    }

    //echo json_encode($return);
        return $return;
}

function detailPostAPI($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $modelPost = $controller->loadModel('Posts');
    $dataSend =$input['request']->getData();  

    if (!empty($dataSend['id'])) {
        if(@$dataSend['language']=='en'){
            $dataPost= array('id'=>$dataSend['id']);
                $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/detailPostAPI', $dataPost);
                $listData= str_replace('ï»¿', '', utf8_encode($listData));
                $return= json_decode($listData, true);
               
        }else{
            $data=$modelPost->get( $dataSend['id']);

             $month=array();
             $order = array('time'=>'desc');

           $otherData = $modelPost->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();
             $return= array('code'=>1,'data'=>$data, 'otherData'=>$otherData);
        }
    }


   // echo json_encode($return);
    return $return;
}

/*Nhà hàng*/
function listRestaurantAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelRestaurant = $controller->loadModel('Restaurants');
    $dataSend = $input['request']->getData();
    if(@$dataSend['language']=='en'){

        $dataPost= array('name'=>@$dataSend['name']);
            $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/listRestaurantAPI', $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $return= json_decode($listData, true);
           
    }else{
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;
        $order= array('created'=>'desc');

        $totalData= $modelRestaurant->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);
    }

    //echo json_encode($return);
        return $return;
}

function detailRestaurantAPI($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $modelRestaurant = $controller->loadModel('Restaurants');
    $dataSend =$input['request']->getData();     
    if (!empty($dataSend['id'])) {
        if(@$dataSend['language']=='en'){
            $dataPost= array('id'=>$dataSend['id']);
                $listData= sendDataConnectMantan('https://en.tayho360.vn/apis/detailRestaurantAPI', $dataPost);
                $listData= str_replace('ï»¿', '', utf8_encode($listData));
                $return= json_decode($listData, true);
               
        }else{
            $data=$modelRestaurant->get( (int) $dataSend['id']);
            $data['listImage']=array( 
                $data['image'],
                $data['image2'],
                $data['image3'],
                $data['image4'],
                $data['image5'],
                $data['image6'],
                $data['image7'],
                $data['image8'],
                $data['image9'],
                $data['image10'],
        );
        $month=array();
            $month['status']=1;
            $order = array('created'=>'desc');
            $otherData = $modelRestaurant->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();

         

             $return= array('code'=>1,'data'=>$data, 'otherData'=>$otherData);

        }
    }


   // echo json_encode($return);
    return $return;
}

function bookRestaurantAPI($input) {
     global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelBookTour = $controller->loadModel('Booktours');

    $dataSend = $input['request']->getData();
     $return= array('code'=>0,'data'=>'');

    
     $modelBooktable = $controller->loadModel('Booktables');

    $dataSend = $input['request']->getData();
    if(!empty($dataSend['timebook'])){
        $data = $modelBooktable->newEmptyEntity();
             $data->created = getdate()[0];

        $data->idrestaurant = (int) @$dataSend['idrestaurant'];
        $data->idcustomer = (int) @$dataSend['idcustomer'];
        $data->name = @$dataSend['name'];
        $data->phone = @$dataSend['phone'];
        $data->email = @$dataSend['email'];
        $data->numberpeople = (int) @$dataSend['numberpeople'];
        $data->not = @$dataSend['not'];
        $data->status = 'processing';
            $data->timebook = strtotime(str_replace("T", " ",@$dataSend['timebook']));
         if($modelBooktable->save($data)){
          $return = array('code'=>1,'data'=>'bạn đăt bàn thành công ');
        }else{
        $return = array('code'=>0,'data'=>'bạn đăt bàn không thành công');
        }

    }else{
        $return= array('code'=>0,'data'=>'bạn đăt bàn không thành công');
    } 
      return $return;
}

function bookHotelAPI($input) {
     global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $bookHotel = $controller->loadModel('BookHotels');

    $dataSend = $input['request']->getData();

 

    if(!empty($dataSend['name'])){
         $date_start = explode(' ', @$dataSend['date_start']);
            $date_end = explode(' ', @$dataSend['date_end']);
            $dataPost= array('idHotel'=>  @$dataSend['idhotel'],
                'date_start'=> @$date_start[0],
                'date_end'=> @$date_end[0],
                'typeRoom'=> @$dataSend['typeRoom'],
                'email'=> @$dataSend['email'],
                'phone'=> @$dataSend['phone'],
                'name'=> @$dataSend['name'],
                'typeBooking'=>  6,
                'number_room'=>  @$dataSend['number_room'],
                'number_people'=> @$dataSend['number_people'],
                'deposits'=> @$dataSend['pricePay'],
                'type_register'=> @$dataSend['type_register'],
                'key'=> '60d410dc2ac5db3f758b4567', 
                'timeStart'=>  @$date_start[1],
                'timeEnd'=>  @$date_end[1],
                'textNumberDate'=> @$dataSend['timePay'],
                'codeDiscount'=> '',
                'wed'=> '0',

            );


            $listHotel= sendDataConnectMantan('https://api.quanlyluutru.com/saveBookingAPI', $dataPost);
            $listHotel= str_replace('ï»¿', '', utf8_encode($listHotel));
            $listHotel= json_decode($listHotel, true);


        $data = $bookHotel->newEmptyEntity();
             $data->created = getdate()[0];

        $data->idhotel = @$dataSend['idhotel'];
        $data->idcustomer = (int) @$dataSend['idcustomer'];
        $data->name = @$dataSend['name'];
        $data->phone = @$dataSend['phone'];
        $data->email = @$dataSend['email'];
        $data->numberpeople = (int) @$dataSend['number_people'];
        $data->note = @$dataSend['not'];
        $data->status = 'processing';
        $data->type_register = @$dataSend['type_register'];
        $data->date_end = @$dataSend['date_end'];
        $data->date_start = @$dataSend['date_start'];
        $data->number_room = (int) @$dataSend['number_room'];
        $data->pricePay =(int) @$dataSend['pricepay'];


      
        if($bookHotel->save($data)){
          $return = array('code'=>1,'data'=>'bạn đăt phòng thành công ');
        }else{
        $return = array('code'=>0,'data'=>'bạn đăt phòng không thành công');
        }

    }else{
        $return= array('code'=>0,'data'=>'bạn đăt phòng không thành công');
    } 

    return $return;
}

function getmapAPI(){

    global $urlHomes;
    global $controller;
       $conditions['status']= 1;

        $modelGovernanceAgency = $controller->loadModel('Governanceagencys');
        $governanceAgency= $modelGovernanceAgency->find()->where($conditions)->all();

        $modelFestival = $controller->loadModel('Festivals');
        $festival= $modelFestival->find()->where($conditions)->all();

        $modelRestaurant = $controller->loadModel('Restaurants');
        $restaurant= $modelRestaurant->find()->where($conditions)->all();

        $modelTour = $controller->loadModel('Tours');
        $tour= $modelTour->find()->where($conditions)->all();

        $modelHotel = $controller->loadModel('Hotels');
        $hotel= $modelHotel->find()->where($conditions)->all();

        $modelHistoricalsite = $controller->loadModel('Historicalsites');
        $historicalsite= $modelHistoricalsite->find()->where($conditions)->all();

        $modelPlace = $controller->loadModel('Places');
        $Place= $modelPlace->find()->where($conditions)->all();

        $modelService = $controller->loadModel('Services');
        $service= $modelService->find()->where($conditions)->all();

        $modelEventcenter = $controller->loadModel('Eventcenters');
        $eventcenter= $modelEventcenter->find()->where($conditions)->all();

        $modelCraftvillage = $controller->loadModel('Craftvillages');
        $Craftvillage= $modelCraftvillage->find()->where($conditions)->all();



        $listData = array();

        if(!empty($Craftvillage)){
            foreach($eventcenter as $keyCraftvillage => $listCraftvillage){
                $listData[] =  array('name'=> $listCraftvillage->name,
                                    'id'=> $listCraftvillage->id,
                                    'address'=> $listCraftvillage->address,
                                    'phone'=> $listCraftvillage->phone,
                                    'image'=> $listCraftvillage->image,
                                    'lat'=> $listCraftvillage->latitude,
                                    'long'=> $listCraftvillage->longitude,
                                    'urlSlug'=> 'chi_tiet_lang_nghe/'.$listCraftvillage->urlSlug.'.html',
                                    'type'=> 'lang_nghe',
                                     'icon'=> 'https://tayho360.vn/themes/tayho360/assets/icon/khachsan.png',

                );
            }
        }

        if(!empty($governanceAgency)){
            foreach($governanceAgency as $keyGovernanceAgency => $listGovernanceAgency){
                $listData[] =  array('name'=> $listGovernanceAgency->name,
                                    'id'=> $listGovernanceAgency->id,
                                    'address'=> $listGovernanceAgency->address,
                                    'phone'=> $listGovernanceAgency->phone,
                                    'image'=> $listGovernanceAgency->image,
                                    'lat'=> $listGovernanceAgency->latitude,
                                    'long'=> $listGovernanceAgency->longitude,
                                    'urlSlug'=> 'chi_tiet_co_quan_hanh_chinh/'.$listGovernanceAgency->urlSlug.'.html',
                                    'type'=> 'co_quan_hanh_chinh',
                                     'icon'=> 'https://tayho360.vn/themes/tayho360/assets/icon/hanhchinh.png',

                );
            }
        } 

        if(!empty($service)){
            foreach($service as $keyService => $listService){
                $listData[] =  array('name'=> $listService->name,
                                    'id'=> $listService->id,
                                    'address'=> $listService->address,
                                    'phone'=> $listService->phone,
                                    'image'=> $listService->image,
                                    'lat'=> $listService->latitude,
                                    'long'=> $listService->longitude,
                                    'urlSlug'=> 'chi_tiet_dich_vu_ho_tro_du_lich/'.$listService->urlSlug.'.html',
                                    'type'=> 'dich_vu_ho_tro_du_lich',
                                     'icon'=> 'https://tayho360.vn/themes/tayho360/assets/icon/hotro.png',

                );
            }
        }

         if(!empty($eventcenter)){
            foreach($eventcenter as $keyEventcenter => $listEventcenter){
                $listData[] =  array('name'=> $listEventcenter->name,
                                    'id'=> $listEventcenter->id,
                                    'address'=> $listEventcenter->address,
                                    'phone'=> $listEventcenter->phone,
                                    'image'=> $listEventcenter->image,
                                    'lat'=> $listEventcenter->latitude,
                                    'long'=> $listEventcenter->longitude,
                                    'urlSlug'=> 'chi_tiet_trung_tam_hoi_nghi_su_kien/'.$listEventcenter->urlSlug.'.html',
                                    'type'=> 'trung_tam_hoi_nghi_su_kien',
                                     'icon'=> 'https://tayho360.vn/themes/tayho360/assets/icon/khachsan.png',

                );
            }
        } 

        if(!empty($historicalsite)){
            foreach($historicalsite as $keyGovernanceAgency => $listhistoricalsite){
                $listData[] =  array('name'=> $listhistoricalsite->name,
                                    'id'=> $listhistoricalsite->id,
                                    'address'=> $listhistoricalsite->address,
                                    'phone'=> $listhistoricalsite->phone,
                                    'image'=> $listhistoricalsite->image,
                                    'lat'=> $listhistoricalsite->latitude,
                                    'long'=> $listhistoricalsite->longitude,
                                    'urlSlug'=> 'chi_tiet_di_tich_lich_su/'.$listhistoricalsite->urlSlug.'.html',
                                    'type'=> 'di_tich_lich_su',
                                     'icon'=> 'https://tayho360.vn/themes/tayho360/assets/icon/ditich.png',

                );
            }
        } 

        if(!empty($Place)){
            foreach($Place as $keyPlace => $listPlace){
                $listData[] =  array('name'=> $listPlace->name,
                                    'id'=> $listPlace->id,
                                    'address'=> $listPlace->address,
                                    'phone'=> $listPlace->phone,
                                    'image'=> $listPlace->image,
                                    'lat'=> $listPlace->latitude,
                                    'long'=> $listPlace->longitude,
                                    'urlSlug'=> 'chi_tiet_danh_lam/'.$listPlace->urlSlug.'.html',
                                    'type'=> 'danh_lam',
                                     'icon'=> 'https://tayho360.vn/themes/tayho360/assets/icon/ditich.png',

                );
            }
        } 

        if(!empty($festival)){
            foreach($festival as $keyfestival => $listFestival){
                $listData[] =  array('name'=> $listFestival->name,
                                    'id'=> $listFestival->id,
                                    'address'=> $listFestival->address,
                                    'phone'=> $listFestival->phone,
                                    'image'=> $listFestival->image,
                                    'lat'=> $listFestival->latitude,
                                    'long'=> $listFestival->longitude,
                                    'urlSlug'=> 'chi_tiet_le_hoi/'.$listFestival->urlSlug.'.html',
                                    'type'=> 'le_hoi',
                                     'icon'=> 'https://tayho360.vn/themes/tayho360/assets/icon/lehoi.png',

                );
            }
        }
      if(!empty($restaurant)){
            foreach($restaurant as $keyrestaurant => $listRestaurant){
                $listData[] =  array('name'=> $listRestaurant->name,
                                    'id'=> $listRestaurant->id,
                                    'address'=> $listRestaurant->address,
                                    'phone'=> $listRestaurant->phone,
                                    'image'=> $listRestaurant->image,
                                    'lat'=> $listRestaurant->latitude,
                                    'long'=> $listRestaurant->longitude,
                                    'urlSlug'=> 'chi_tiet_nha_hang/'.$listRestaurant->urlSlug.'.html',
                                    'type'=> 'nha_hang',
                                     'icon'=> 'https://tayho360.vn/themes/tayho360/assets/icon/nhahanh.png',

                );
            }
        }
     if(!empty($tour)){
            foreach($tour as $keyTour => $listTour){
                $listData[] =  array('name'=> $listTour->name,
                                    'id'=> $listTour->id,
                                    'address'=> $listTour->address,
                                    'phone'=> $listTour->phone,
                                    'image'=> $listTour->image,
                                    'lat'=> $listTour->latitude,
                                    'long'=> $listTour->longitude,
                                    'urlSlug'=> 'chi_tiet_tour/'.$listTour->urlSlug.'.html',
                                    'type'=> 'tour',
                                     'icon'=> 'https://tayho360.vn/themes/tayho360/assets/icon/hotro.png',

                );
            }
        }

        $keyManMo = '5dc8f2652ac5db08348b4567';
        $city = 1;
        $district = 11;

        $dataPost= array('key'=>$keyManMo, 'city'=>1, 'lat'=>'','nameHotel'=> '', 'long'=>'', 'district'=>11, 'limit'=>'','page'=>1);
            $listHotel= sendDataConnectMantan('https://api.quanlyluutru.com/getHotelAroundAPI', $dataPost);
            $listHotel= str_replace('ï»¿', '', utf8_encode($listHotel));
            $listHotel= json_decode($listHotel, true);

        if(!empty($listHotel['data'])){
            foreach($listHotel['data'] as $keyHotel => $Hotel){
                $listData[] =  array('name'=> @$Hotel['Hotel']['name'],
                                    'id'=> $Hotel['Hotel']['id'],
                                    'address'=> @$Hotel['Hotel']['address'],
                                    'phone'=> @$Hotel['Hotel']['phone'],
                                    'image'=> @$Hotel['Hotel']['imageDefault'],
                                    'lat'=> sprintf("%.12f", $Hotel['Hotel']['coordinates_x']) ,
                                    'long'=> sprintf("%.12f", $Hotel['Hotel']['coordinates_y']) ,
                                    'urlSlug'=> 'chi_tiet_khach_san/'.$Hotel['Hotel']['slug'].'.html',
                                    'type'=> 'khach_san',
                                    'icon'=> 'https://tayho360.vn/themes/tayho360/assets/icon/khachsan.png',

                );
            }
        }

         $return= array('code'=>1,'listData'=>$listData);

    //echo json_encode($return);
        return $return;

}

 ?>