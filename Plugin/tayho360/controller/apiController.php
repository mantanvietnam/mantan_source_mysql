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

/*tour*/
function listTourAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelTour = $controller->loadModel('Tours');
    $dataSend = $input['request']->getData();
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;
        $order= array('created'=>'desc');

        $totalData= $modelTour->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

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
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['slug']= array('$regex' => $key);
        }
       
        $order= array('created'=>'desc');

        $totalData= $modelPost->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

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
            $data=$modelPost->get( (int) $dataSend['id']);

             $month=array();
             $order = array('created'=>'desc');

           $otherData = $modelEventcenter->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();
             $return= array('code'=>1,'data'=>$data, 'otherData'=>$otherData);
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
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;
        $order= array('created'=>'desc');

        $totalData= $modelRestaurant->find()->where($conditions)->all()->toList();

        $return= array('code'=>1,'listData'=>$totalData);

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

 ?>