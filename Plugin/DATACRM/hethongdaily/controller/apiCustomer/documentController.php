<?php 
function listCategoryDocumentCustomerAPI($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $modelCategoryConnects;
    global $isRequestPost;


	$modelDocument = $controller->loadModel('Documents');
	$modelDocumentinfo = $controller->loadModel('Documentinfos');
    $modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);	
	if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['type'])){
            	 $boss = $modelMember->find()->where(['id_father'=>0])->first();
                $conditions = array('parent'=>$boss->id,'status'=>'active','type'=>'category_'.$dataSend['type']);
			    if(!empty($dataSend['name'])){
			        $key=createSlugMantan($dataSend['name']);
			        $conditions['slug LIKE']= '%'.$key.'%';
			    }

			        
			    $limit = 20;
			    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
			    if($page<1) $page = 1;
			    $order = array('id'=>'desc');
			    
			    $listData = $modelCategories->find()->where($conditions)->order($order)->all()->toList();

			    // phân trang
			    $totalData = $modelCategories->find()->where($conditions)->all()->toList();
			    $totalData = count($totalData);

			    
			     $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
			
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

function listDocumentCustomerAPI($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $modelCategoryConnects;
    global $isRequestPost;


	$modelDocument = $controller->loadModel('Documents');
	$modelDocumentinfo = $controller->loadModel('Documentinfos');
    $modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);	
	if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['type'])){
            	 $boss = $modelMember->find()->where(['id_father'=>0])->first();
                $conditions = array('id_parent'=>$boss->id, 'public'=>'public','status'=>'active','type'=>$dataSend['type']);
			    if(!empty($dataSend['name'])){
			        $key=createSlugMantan($dataSend['name']);
			        $conditions['slug LIKE']= '%'.$key.'%';
			    }

			     if(!empty($dataSend['id_category'])){
			        $list_id = [];
			        $listCheck = $modelCategoryConnects->find()->where(['id_category'=>$dataSend['id_category'], 'keyword'=>'category_'.$dataSend['type']])->all()->toList();
			        if(!empty($listCheck)){
			            foreach ($listCheck as $check) {
			                $list_id[] = $check->id_parent;
		                }
		            }
		            $conditions['id IN'] = $list_id;
			    }
			        
			    $limit = 20;
			    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
			    if($page<1) $page = 1;
			    $order = array('id'=>'desc');
			    
			    $listData = $modelDocument->find()->where($conditions)->order($order)->all()->toList();

			    // phân trang
			    $totalData = $modelDocument->find()->where($conditions)->all()->toList();
			    $totalData = count($totalData);

			    
			     $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
			
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}


function listDocumentinfoCustomerAPI($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    $modelDocument = $controller->loadModel('Documents');
	$modelDocumentinfo = $controller->loadModel('Documentinfos');
    $modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);	
	if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['type']) && !empty($dataSend['id_document'])){
            	 $boss = $modelMember->find()->where(['id_father'=>0])->first();
		    	$data = $modelDocument->find()->where(['id_parent'=>$boss->id, 'id'=>(int)$dataSend['id_document'], 'type'=>$dataSend['type']])->first();

		    	if(empty($data)){
		    		return array('code'=>3, 'mess'=>'Dữ liệu không tồn tại');
		    	}

		    $conditions = array('id_document'=>$data->id);
		   
		     if(!empty($_GET['name'])){
		        $key=createSlugMantan($_GET['name']);

		        $conditions['slug LIKE']= '%'.$key.'%';
		    }


		    $limit = 20;
		    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		    if($page<1) $page = 1;
		    $order = array('id'=>'desc');
		    
		    $listData = $modelDocumentinfo->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		     // phân trang
		    $totalData = $modelDocumentinfo->find()->where($conditions)->all()->toList();
		    $totalData = count($totalData);
		    if(!empty($data->id_drive)){
		    	$datadrive = getListFileDrive($data->id_drive);
                    if(!empty($datadrive)){
                        foreach($datadrive as $key => $item){  
                        	$k = (int)$totalData + (int)$key;               	
                            $listData[$k]['title'] = $item['title'];
                            $listData[$k]['file'] = $item['thumbnailLink'];
                            $listData[$k]['status'] = null;
                            $listData[$k]['id_document'] = $data->id;
                            $listData[$k]['description'] = '';
                            $listData[$k]['slug'] = $item['title'];
                            $listData[$k]['id'] = $k;
                        }
                    }
		    }


		   
		    $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ','data'=>$data, 'listData'=>$listData, 'totalData'=>$totalData);
			
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

function getDocumentinfoCustomerAPI($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    $modelDocument = $controller->loadModel('Documents');
	$modelDocumentinfo = $controller->loadModel('Documentinfos');
    $modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);	
	if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['id_documentilfo'])){
            
		    	$data = $modelDocumentinfo->find()->where(array('id'=>$dataSend['id_documentilfo']))->first();

		    	if(empty($data)){
		    		return array('code'=>3, 'mess'=>'Dữ liệu không tồn tại');
		    	}
		    
		    $data->document = $modelDocument->find()->where(array('id'=>$data->id_document))->first();

		    // phân trang
		   
		    $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ','data'=>$data);
			
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
 ?>