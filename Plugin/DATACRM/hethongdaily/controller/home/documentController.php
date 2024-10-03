<?php 
function listDocument($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('');   
    if(!empty($user)){


	    $mess = "";

	    $modelDocument = $controller->loadModel('Documents');
	    $modelDocumentinfo = $controller->loadModel('Documentinfos');


	    
	    $conditions = array('id_parent'=>$user->id);
	    $conditioneverybody = array('id_parent !='=>$user->id, 'public'=>'public');

		$url= explode('?', $urlCurrent);	    
	    if($url[0]=='/listAlbum'){
	    	$user = checklogin('listAlbum');   
    		if(empty($user->grant_permission)){
    			return $controller->redirect('/statisticAgency');
    		}
	    	$conditions['type']= 'album';
	    	$conditioneverybody['type']= 'album';
	    	$title = 'Hình ảnh';
	    	$slug = 'Album';
	    	$type ='album';
	    }elseif($url[0]=='/listVideo'){
	    	$user = checklogin('listVideo');   
    		if(empty($user->grant_permission)){
    			return $controller->redirect('/statisticAgency');
    		}
	    	$conditions['type']= 'video';
	    	$conditioneverybody['type']= 'video';
	    	$title = 'Video';
	    	$slug = 'Video';
	    	$type ='video';
	    }else{
	    	$user = checklogin('listDocument');   
    		if(empty($user->grant_permission)){
    			return $controller->redirect('/statisticAgency');
    		}
	    	$conditions['type']= 'document';
	    	$conditioneverybody['type']= 'document';
	    	$title = 'Tài liệu';
	    	$slug = 'Document';
	    	$type ='document';
	    }

	    $metaTitleMantan = 'Danh sách '.$title;


	    if(!empty($_GET['name'])){
	        $key=createSlugMantan($_GET['name']);

	        $conditions['slug LIKE']= '%'.$key.'%';
	        $conditioneverybody['slug LIKE']= '%'.$key.'%';
	    }


	    $limit = 20;
	    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');
	    
	    $listData = $modelDocument->find()->where($conditions)->order($order)->all()->toList();
	    $conditioneverybody = $modelDocument->find()->limit($limit)->page($page)->where($conditioneverybody)->order($order)->all()->toList();

	    

	    if(!empty($listData)){
	        foreach ($listData as $key => $value) {
	            $conditions_scan = array('id_document'=>$value->id);
	            $static = $modelDocumentinfo->find()->where($conditions_scan)->all()->toList();
	            $listData[$key]->number_document = count($static);
	        }
	    }

	    if(!empty($conditioneverybody)){
	        foreach ($conditioneverybody as $key => $value) {
	            $conditions_scan = array('id_document'=>$value->id);
	            $static = $modelDocumentinfo->find()->where($conditions_scan)->all()->toList();
	            $conditioneverybody[$key]->number_document = count($static);
	        }
	    }

	    // phân trang
	    $totalData = $modelDocument->find()->where($conditions)->all()->toList();
	    $totalData = count($totalData);

	    $balance = $totalData % $limit;
	    $totalPage = ($totalData - $balance) / $limit;
	    if ($balance > 0)
	        $totalPage+=1;

	    $back = $page - 1;
	    $next = $page + 1;
	    if ($back <= 0)
	        $back = 1;
	    if ($next >= $totalPage)
	        $next = $totalPage;

	    if (isset($_GET['page'])) {
	        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
	        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
	    } else {
	        $urlPage = $urlCurrent;
	    }
	    if (strpos($urlPage, '?') !== false) {
	        if (count($_GET) >= 1) {
	            $urlPage = $urlPage . '&page=';
	        } else {
	            $urlPage = $urlPage . 'page=';
	        }
	    } else {
	        $urlPage = $urlPage . '?page=';
	    }

	    if(@$_GET['mess']=='saveSuccess'){
	    	$mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
	    }elseif(@$_GET['mess']=='deleteSuccess'){
	    	$mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
	    }elseif(@$_GET['mess']=='deleteError'){
	    	$mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
	    }
	    
	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('title', $title);
	    setVariable('slug', $slug);
	    setVariable('type', $type);
	    setVariable('mess', $mess);
	    
	    setVariable('listData', $listData);
	    setVariable('conditioneverybody', $conditioneverybody);
	}else{
        return $controller->redirect('/login');
    }
}

function addDocument($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $user = checklogin('');   
    if(!empty($user)){

    	$url= explode('?', $urlCurrent);
    	if($url[0]=='/addAlbum'){
    		$user = checklogin('addAlbum');   
    		if(empty($user->grant_permission)){
    			return	$controller->redirect('/listAlbum');
    		}
	    	$type= 'album';
	    	$title = 'Hình ảnh';
	    	$name = 'file ảnh';
	    	$slug = 'Album';
	    }elseif($url[0] == '/addVideo'){
	    	$user = checklogin('addVideo');   
    		if(empty($user->grant_permission)){
    			return	$controller->redirect('/listAlbum');
    		}
	    	$type= 'video';
	    	$title = 'Video';
	    	$name = 'Mã youtube';
	    	$slug = 'Video';
	    }else{
	    	$user = checklogin('addDocument');   
    		if(empty($user->grant_permission)){
    			return	$controller->redirect('/listDocument');
    		}
	    	$type= 'document';
	    	$title = 'Tài liệu';
	    	$name = 'file tài liệu';
	    	$slug = 'Document';
	    }

	    $metaTitleMantan = 'Thông tin '.$title;
	    $modelDocumentinfo = $controller->loadModel('Documentinfos');
	    $modelDocument = $controller->loadModel('Documents');
	    $mess= '';
	    // lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelDocument->get( (int) $_GET['id']);

	    }else{
	        $data = $modelDocument->newEmptyEntity();
	        $data->created_at = time();
	    }

	    if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['title'])){
	            // tạo dữ liệu save
	            $data->title = @$dataSend['title'];
	            $data->type = $type;
	            $data->image = @$dataSend['image'];
	            $data->id_parent = $user->id;
	            $data->status = @$dataSend['status'];
	            $data->content = @$dataSend['content'];
	            $data->public = @$dataSend['public'];
	            $data->description = @$dataSend['description'];
	            $data->slug = createSlugMantan(trim($dataSend['title']));


	            $modelDocument->save($data);

	            // lưu thông tin file

                if(@$type !='album'){
               	 	if(!empty($dataSend['title_info'])){
                    	$conditions = ['id_document'=>$data->id];
                    	$modelDocumentinfo->deleteAll($conditions);
	                    foreach ($dataSend['title_info'] as $key => $title_info) {
	                    	$file = '';
	                    	if(@$type=='video'){
	                    		$file = $dataSend['file'][$key];
	                    	}else{
	                    		if(isset($_FILES['file'.$key]) && empty($_FILES['file'.$key]["error"])){
			                        if(!empty($data->id)){
			                            $fileName = 'file'.$key.'_file_'.$data->id;
			                        }else{
			                            $fileName = 'file'.$key.'_file_'.time().rand(0,1000000);
			                        }

			                        $image = uploadImage($user->id, 'file'.$key, $fileName);
	                    	

			                        if(!empty($image['linkOnline'])){
			                            $file= $image['linkOnline'].'?time='.time();
			                        }
			                    }elseif(!empty($dataSend['file_cu'])){
			                    	$file = $dataSend['file_cu'][$key];
			                    }
	                    	}

	                        $info = $modelDocumentinfo->newEmptyEntity();

	                        $info->title = @$title_info;
		            		$info->file = $file;
		            		$info->id_document = $data->id;
		            		$info->description = @$dataSend['description_info'][$key];
		            		$info->slug = createSlugMantan(trim(@$title_info));


		            		$modelDocumentinfo->save($info);
	                    }
	                }else{
                    	$conditions = ['id_document'=>$data->id];
                    	$modelDocumentinfo->deleteAll($conditions);
                	}
	            }else{
		            if(!empty($_FILES['listImage']['name'][0])){
		                foreach($_FILES['listImage']['name'] as $key => $value){
		                    $_FILES['listImages'.$key]['name'] = $value;
		                    $_FILES['listImages'.$key]['type'] = $_FILES['listImage']['type'][$key];
		                    $_FILES['listImages'.$key]['tmp_name'] = $_FILES['listImage']['tmp_name'][$key];
		                    $_FILES['listImages'.$key]['error'] = $_FILES['listImage']['error'][$key];
		                    $_FILES['listImages'.$key]['size'] = $_FILES['listImage']['size'][$key];
		                }
	                }	                
		            $totalImage = count(@$dataSend['anh'])+1;
		            $listImages = [];
		           
		            for($y=0;$y<=$totalImage;$y++){
		                if(!empty($dataSend['anh'][$y])){
		                    $listImages[$y] = $dataSend['anh'][$y];
		                }
		                    
		                 if(isset($_FILES['image'.$y]) && empty($_FILES['image'.$y]["error"])){
		                    if(!empty($data->id)){
		                        $fileName = 'image'.$y.'_product_'.$data->id;
		                    }else{
		                        $fileName = 'image'.$y.'_product_'.time().rand(0,1000000);
	                        }
		                    $image = uploadImage($user->id, 'image'.$y, $fileName);

		                    if(!empty($image['linkOnline'])){
		                        $listImages[$y] = $image['linkOnline'].'?time='.time();
		                    }
		                }
		            }
		            $total = count($_FILES['listImage']['name']);
		                
		            for($i=0;$i<=$total;$i++){
		            	if(isset($_FILES['listImages'.$i]) && empty($_FILES['listImages'.$i]["error"])){
		            		if(!empty($data->id)){
		            			$fileName = 'image'.$i.'_product_'.$data->id;
		            		}else{
		            			$fileName = 'image'.$i.'_product_'.time().rand(0,1000000);
		            		}
		            		$image = uploadImage($user->id, 'listImages'.$i, $fileName);
		            		if(!empty($image['linkOnline'])){
		            			$listImages[$i+$totalImage] = $image['linkOnline'].'?time='.time();
		            		}
		            	}
		            }
		            $so = 0;
		            if(!empty($listImages)){
		            	$conditions = ['id_document'=>$data->id];
                    	$modelDocumentinfo->deleteAll($conditions);
		            	foreach($listImages as $key => $image){
		            		$so++;
		            		$info = $modelDocumentinfo->newEmptyEntity();
		            		$info->title = 'hình '.$so;
		            		$info->file = $image;
		            		$info->id_document = $data->id;
		            		$info->description = '';
		            		$info->slug = createSlugMantan(trim( 'hình '.$so));
		            		$modelDocumentinfo->save($info);

		            	}
		            }else{
		            	$conditions = ['id_document'=>$data->id];
                    	$modelDocumentinfo->deleteAll($conditions);
		            }

		        }

		        if(!empty($_GET['id'])){
		        	if($type=='album'){
    					 $note = $user->type_tv.' '. $user->name.' sửa thông tin hình ảnh '.$data->title.' có id là:'.$data->id;
    				}elseif($type=='video'){
    					 $note = $user->type_tv.' '. $user->name.' sửa thông tin Video '.$data->title.' có id là:'.$data->id;
    				}else{
    					 $note = $user->type_tv.' '. $user->name.' sửa thông tin thành liệu  '.$data->title.' có id là:'.$data->id;
    				}
                   
                }else{
                	if($type=='album'){
    					 $note = $user->type_tv.' '. $user->name.' thêm mới thông tin hình ảnh '.$data->title.' có id là:'.$data->id;
    				}elseif($type=='video'){
    					 $note = $user->type_tv.' '. $user->name.' thêm mới thông tin Video  '.$data->title.' có id là:'.$data->id;
    				}else{
    					 $note = $user->type_tv.' '. $user->name.' thêm mới thông tin thành liệu  '.$data->title.' có id là:'.$data->id;
    				}
                    
                }
                addActivityHistory($user,$note,'add'.$slug,$data->id);            

	            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

	            if($type=='album'){
    				return $controller->redirect('/listAlbum?mess=saveSuccess');
    			}elseif($type=='video'){
    				return $controller->redirect('/listVideo?mess=saveSuccess');
    			}else{
    				return $controller->redirect('/listDocument?mess=saveSuccess');
    			}
	            
	        }else{
	            $mess= '<p class="text-danger">Bạn chưa nhập tiêu đề</p>';
	        }
	    }

        if(!empty($data->id)){
            $conditions = array('id_document'=>$data->id);
            $data->info = $modelDocumentinfo->find()->where($conditions)->all()->toList();
        }


	    setVariable('mess', $mess);
	    setVariable('data', $data);

	    setVariable('title', $title);
	    setVariable('type', $type);
		setVariable('slug', $slug);
		setVariable('name', $name);
	   
	}else{
        return $controller->redirect('/login');
    }
}

function deleteDocument($input){
    global $controller;

    $user = checklogin('');   
    if(!empty($user)){

	    if($_GET['type']=='album'){
	    	$user = checklogin('deleteAlbum');   
    		if(empty($user->grant_permission)){
    			return	$controller->redirect('/listAlbum');
    		}
	    }elseif($_GET['type']=='video'){
	    	$user = checklogin('deleteVideo');   
    		if(empty($user->grant_permission)){
    			return	$controller->redirect('/listVideo');
    		}
	    }else{
	    	$user = checklogin('deleteAlDocument');   
    		if(empty($user->grant_permission)){
    			return	$controller->redirect('/listDocument');
    		}
	    }
	   
		$modelDocument = $controller->loadModel('Documents');

		$modelDocumentinfo = $controller->loadModel('Documentinfos');
	    if(!empty($_GET['id'])){
	        $data = $modelDocument->get($_GET['id']);
	        
	        if($data){
	        	if($type=='album'){
    				$note = $user->type_tv.' '. $user->name.' xóa thông tin hình ảnh'.$data->title.' có id là:'.$data->id;
    			}elseif($type=='video'){
    				$note = $user->type_tv.' '. $user->name.' xóa thông tin Video  '.$data->title.' có id là:'.$data->id;
    			}else{
    				$note = $user->type_tv.' '. $user->name.' xóa thông tin thành liệu  '.$data->title.' có id là:'.$data->id;
    			}
                    
                addActivityHistory($user,$note,'deleteDocument',$data->id);
	        	$modelDocumentinfo->deleteAll((['id_document'=>$data->id]));
	            $modelDocument->delete($data);
	        }
	    }


	    if($_GET['type']=='album'){
	    	return $controller->redirect('/listAlbum');
	    }elseif($_GET['type']=='video'){
	    	return $controller->redirect('/listVideo');
	    }else{
	    	return $controller->redirect('/listDocument');
	    }
    }else{
        return $controller->redirect('/login');
    }
    
}

function listDocumentinfo($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('');   
    if(!empty($user)){

    	$url= explode('?', $urlCurrent);	    
	    if($url[0]=='/listAlbuminfo'){
	    	$user = checklogin('listAlbuminfo');   
    		if(empty($user->grant_permission)){
    			return $controller->redirect('/listAlbum');
    		}
	    	$conditions['type']= 'album';
	    	$title = 'Hình ảnh';
	    	$slug = 'Album';
	    	$type ='album';
	    }elseif($url[0]=='/listVideoinfo'){
	    	$user = checklogin('listVideoinfo');   
    		if(empty($user->grant_permission)){
    			return $controller->redirect('/listVideo');
    		}
	    	$conditions['type']= 'video';
	    	$title = 'Video';
	    	$slug = 'Video';
	    	$type ='video';
	    }else{
	    	$user = checklogin('listAlDocumentinfo');   
    		if(empty($user->grant_permission)){
    			return $controller->redirect('/listDocument');
    		}
	    	$conditions['type']= 'document';
	    	$title = 'Tài liệu';
	    	$slug = 'Document';
	    	$type ='document';
	    }

	    $metaTitleMantan = 'Danh sách '.$title;

	    $user = $session->read('infoUser');

	    $modelDocument = $controller->loadModel('Documents');
	    $modelDocumentinfo = $controller->loadModel('Documentinfos');
	    
	    $conditions = array();

	    if(!empty($_GET['id_document'])){
	    	$conditions['id_document']= $_GET['id_document'];
	    	$data = $modelDocument->find()->where(['id'=>$_GET['id_document'], 'type'=>$type ])->first();

	    	if(empty($data)){
	    		return $controller->redirect('/listAlbum');
	    	}
	    }else{
	    	return $controller->redirect('/listAlbum');
	    }
	     if(!empty($_GET['title'])){
	        $key=createSlugMantan($_GET['title']);

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

	    $balance = $totalData % $limit;
	    $totalPage = ($totalData - $balance) / $limit;
	    if ($balance > 0)
	        $totalPage+=1;

	    $back = $page - 1;
	    $next = $page + 1;
	    if ($back <= 0)
	        $back = 1;
	    if ($next >= $totalPage)
	        $next = $totalPage;

	    if (isset($_GET['page'])) {
	        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
	        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
	    } else {
	        $urlPage = $urlCurrent;
	    }
	    if (strpos($urlPage, '?') !== false) {
	        if (count($_GET) >= 1) {
	            $urlPage = $urlPage . '&page=';
	        } else {
	            $urlPage = $urlPage . 'page=';
	        }
	    } else {
	        $urlPage = $urlPage . '?page=';
	    }
	    
	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('data', $data);
	    setVariable('title', $title);
	    setVariable('slug', $slug);
	    setVariable('type', $type);
	    
	    setVariable('listData', $listData);
	}else{
        return $controller->redirect('/login');
    }
}

function addDocumentinfo($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    if(!empty($session->read('infoUser'))){

	    $url= explode('?', $urlCurrent);	    
	    if($url[0]=='/addAlbuminfo'){
	    	$conditions['type']= 'album';
	    	$title = 'Hình ảnh';
	    	$slug = 'Album';
	    	$type ='album';
	    }elseif($url[0]=='/addVideoinfo'){
	    	$conditions['type']= 'video';
	    	$title = 'Video';
	    	$slug = 'Video';
	    	$type ='video';
	    }else{
	    	$conditions['type']= 'document';
	    	$title = 'Tài liệu';
	    	$slug = 'Document';
	    	$type ='document';
	    }

	    $metaTitleMantan = 'Thông tin '.$title;
	    $user = $session->read('infoUser');

	    $modelDocument = $controller->loadModel('Documents');
	    $modelDocumentinfo = $controller->loadModel('Documentinfos');
	    $mess= '';

	     if(!empty($_GET['id_document'])){
	    	$conditions['id_document']= $_GET['id_document'];
	    	$info = $modelDocument->find()->where(['id'=>$_GET['id_document'], 'type'=>$type])->first();

	    	if(empty($info)){
	    		return $controller->redirect('/listAlbum');
	    	}
	    }else{
	    	return $controller->redirect('/listAlbum');
	    }
	    // lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelDocumentinfo->get( (int) $_GET['id']);

	    }else{
	        $data = $modelDocumentinfo->newEmptyEntity();
	        $data->created_at = time();
	    }


	    if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['title'])){
	            // tạo dữ liệu save
	            $data->title = @$dataSend['title'];
	            $data->file = @$dataSend['file'];
	            $data->id_document = $info->id;
	            $data->description = @$dataSend['description'];
	            $data->slug = createSlugMantan(trim($dataSend['title']));


	            $modelDocumentinfo->save($data);

	            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

	             
	            
	        }else{
	            $mess= '<p class="text-danger">Bạn chưa nhập tiêu đề</p>';
	        }
	    }
	    setVariable('mess', $mess);
     	setVariable('data', $data);
     	setVariable('info', $info);
     	setVariable('title', $title);
	    setVariable('slug', $slug);
	    setVariable('type', $type);

	   
	}else{
        return $controller->redirect('/login');
    }
}

function deleteDocumentinfo($input){
    global $controller;
   
	$modelDocument = $controller->loadModel('Documents');
	$modelDocumentinfo = $controller->loadModel('Documentinfos');

	if(!empty($_GET['id_document'])){
	    $info = $modelDocument->find()->where(['id'=>$_GET['id_document']])->first();

	    if(empty($info)){
	    	return $controller->redirect('/listAlbum');
	    }
	}else{
	   	return $controller->redirect('/listAlbum');
	}
    if(!empty($_GET['id'])){
        $data = $modelDocumentinfo->get($_GET['id']);
        
        if($data){
            $modelDocumentinfo->delete($data);
        }
    }
    if($info->type=='album'){
    	return $controller->redirect('/listAlbuminfo?id_document='.$info->id);
    }elseif($info->type=='video'){
    	return $controller->redirect('/listVideoinfo?id_document='.$info->id);
    }else{    	
    	return $controller->redirect('/listDocumentinfo?id_document='.$info->id);
    }
}


?>