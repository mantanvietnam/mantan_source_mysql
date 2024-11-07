<?php 
function listDocumentAPI($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $isRequestPost;


	$modelDocument = $controller->loadModel('Documents');
	$modelDocumentinfo = $controller->loadModel('Documentinfos');
    $modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);	
	if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['type']) && !empty($dataSend['token'])){

        	if($dataSend['type']=='album'){
	    		$type = 'listAlbum';   
	    	}elseif($dataSend['type']=='video'){
	    		$type = 'listVideo';
	    	}else{
	    		$type = 'listDocument';  
	    	}
        	$infoMember = getMemberByToken($dataSend['token'],$type);

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
	    		$conditions = array('id_parent !='=>$infoMember->id, 'public'=>'public');

            	$conditions['type']= $dataSend['type'];
	    		$order = array('id'=>'desc');

	    		 if(!empty($dataSend['name'])){
			        $key=createSlugMantan($dataSend['name']);

			        $conditions['slug LIKE']= '%'.$key.'%';
			    }

			    $limit = 20;
	    		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
            	 
            	$listData = $modelDocument->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            	$totalData = count($modelDocument->find()->where($conditions)->order($order)->all()->toList());
			    if(!empty($listData)){
			        foreach ($listData as $key => $value) {
			            $conditions_scan = array('id_document'=>$value->id);
			            $static = $modelDocumentinfo->find()->where($conditions_scan)->all()->toList();
			            $listData[$key]->number_document = count($static);
			        }
			    }
			    
			    $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
			}else{
               $return = array('code'=>3, 'mess'=>'Sai mã token');
           }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

function listDocumentMyMemberAPI($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $isRequestPost;


	$modelDocument = $controller->loadModel('Documents');
	$modelDocumentinfo = $controller->loadModel('Documentinfos');
    $modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);	
	if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['type']) && !empty($dataSend['token'])){
        	if($dataSend['type']=='album'){
	    		$type = 'listAlbum';   
	    	}elseif($dataSend['type']=='video'){
	    		$type = 'listVideo';
	    	}else{
	    		$type = 'listDocument';  
	    	}
        	$infoMember = getMemberByToken($dataSend['token'],$type);

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
	    		$conditions = array('id_parent'=>$infoMember->id);

            	$conditions['type']= $dataSend['type'];
	    		$order = array('id'=>'desc');

	    		 if(!empty($dataSend['name'])){
			        $key=createSlugMantan($dataSend['name']);

			        $conditions['slug LIKE']= '%'.$key.'%';
			    }

			    $limit = 20;
	    		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
            	 
            	$listData = $modelDocument->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            	$totalData = count($modelDocument->find()->where($conditions)->order($order)->all()->toList());
			    if(!empty($listData)){
			        foreach ($listData as $key => $value) {
			            $conditions_scan = array('id_document'=>$value->id);
			            $static = $modelDocumentinfo->find()->where($conditions_scan)->all()->toList();
			            $listData[$key]->number_document = count($static);
			        }
			    }
			    
			    $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
			}else{
               $return = array('code'=>3, 'mess'=>'Sai mã token');
           }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

function addDocumentAPI($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    if ($isRequestPost) {
	    $dataSend = $input['request']->getData();
	    if(!empty($dataSend['type']) && !empty($dataSend['token']) && !empty($dataSend['title'])){
        	if($dataSend['type']=='album'){
	    		$type = 'addAlbum';   
	    	}elseif($dataSend['type']=='video'){
	    		$type = 'addVideo';
	    	}else{
	    		$type = 'addAlDocument';  
	    	}
        	$infoMember = getMemberByToken($dataSend['token'],$type);

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
			    $modelDocument = $controller->loadModel('Documents');
			    $mess= '';
			    // lấy data edit
			    if(!empty($dataSend['id'])){
			        $data = $modelDocument->find()->where(['id'=>(int) $dataSend['id'],'id_parent'=>$infoMember->id])->first();

			    }else{
			        $data = $modelDocument->newEmptyEntity();
			        $data->created_at = time();
			    }
			    $time = time();
			    if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
                $images = uploadImage($infoMember->id, 'image', 'image_'.$time);
	            }
	            $image = '';
	            if(!empty($images['linkOnline'])){
	                $image = $images['linkOnline'];
	            }

		            // tạo dữ liệu save
			    $data->title = @$dataSend['title'];
			    $data->type = $dataSend['type'];
			    $data->image = @$image;
			    $data->id_parent = $infoMember->id;
			    $data->status = @$dataSend['status'];
			    $data->content = @$dataSend['content'];
			    $data->public = @$dataSend['public'];
			    $data->description = @$dataSend['description'];
			    $data->slug = createSlugMantan(trim($dataSend['title']));


			    $modelDocument->save($data);
			    $return = array('code'=>1, 'mess'=>'Lưu dữ liệu thành công');
		    }else{
               $return = array('code'=>3, 'mess'=>'Sai mã token');
           }
	    }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;    
}

function getDocumentAPI($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    if ($isRequestPost) {
	    $dataSend = $input['request']->getData();
	    if(!empty($dataSend['id']) && !empty($dataSend['token'])){
        	if($dataSend['type']=='album'){
	    		$type = 'listAlbum';   
	    	}elseif($dataSend['type']=='video'){
	    		$type = 'listVideo';
	    	}else{
	    		$type = 'listDocument';  
	    	}
        	$infoMember = getMemberByToken($dataSend['token'],$type);

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
			    $modelDocument = $controller->loadModel('Documents');
			    $mess= '';
			    // lấy data edit
			    $data = $modelDocument->find()->where(['id'=>(int) $dataSend['id']])->first();
			    if(!empty($data)){
			    
		            $return = array('code'=>1, 'mess'=>'lấy dữ liệu thành công', 'data'=> $data);
		        }else{
		            $return = array('code'=>2, 'mess'=>'Dữ liệu không tồn tại');
		        }
		    }else{
               $return = array('code'=>3, 'mess'=>'Sai mã token');
           }
	    }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;    
}

function deleteDocumentAPI($input){	
    global $controller;
    global $isRequestPost;
   

    if ($isRequestPost) {
	    $dataSend = $input['request']->getData();
	    if(!empty($dataSend['id']) && !empty($dataSend['token'])){
        	$infoMember = getMemberByToken($dataSend['token'],$type);

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                } 
				$modelDocument = $controller->loadModel('Documents');

				$modelDocumentinfo = $controller->loadModel('Documentinfos');
			   
			        $data = $modelDocument->find()->where(['id'=>(int) $dataSend['id'],'id_parent'=>$infoMember->id])->first();
			        
			        if(!empty($data)){
			        	if($data->type=='album'){
	    					$type = 'deleteAlbum';   
				    	}elseif($data->type=='video'){
				    		$type = 'deleteVideo';
				    	}else{
				    		$type = 'deleteDocument';  
				    	}
			        	$infoMember = getMemberByToken($dataSend['token'],$type);
			        	if(empty($infoMember->grant_permission)){
                  		  return array('code'=>4, 'mess'=>'Bạn không có quyền');
                		} 
			        	if($data->type=='album'){
		    				$note = $user->type_tv.' '. $user->name.' xóa thông tin hình ảnh'.$data->title.' có id là:'.$data->id;
		    			}elseif($data->type=='video'){
		    				$note = $user->type_tv.' '. $user->name.' xóa thông tin Video  '.$data->title.' có id là:'.$data->id;
		    			}else{
		    				$note = $user->type_tv.' '. $user->name.' xóa thông tin thành liệu  '.$data->title.' có id là:'.$data->id;
		    			}
		                    
		                addActivityHistory($user,$note,'deleteDocument',$data->id);
			        	$modelDocumentinfo->deleteAll((['id_document'=>$data->id]));

			            $modelDocument->delete($data);
			      $return = array('code'=>1, 'mess'=>'xóa dữ liệu thành công');
		        }else{
		            $return = array('code'=>2, 'mess'=>'Dữ liệu không tồn tại');
		        }
		    }else{
               $return = array('code'=>3, 'mess'=>'Sai mã token');
           }
	    }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }
    return $return;    
}

function listDocumentinfoAPI($input){
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
       if(!empty($dataSend['type']) && !empty($dataSend['token']) && !empty($dataSend['id_document'])){
        	if($dataSend['type']=='album'){
	    		$type = 'listAlbuminfo';   
	    	}elseif($dataSend['type']=='video'){
	    		$type = 'listVideoinfo';
	    	}else{
	    		$type = 'listAlDocumentinfo';  
	    	}
        	$infoMember = getMemberByToken($dataSend['token'],$type);

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
		    	$data = $modelDocument->find()->where(['id'=>(int)$dataSend['id_document'],'id_parent !='=>$infoMember->id, 'type'=>$dataSend['type'], 'public'=>'public'])->first();

		    	if(empty($data)){
		    		return array('code'=>3, 'mess'=>'Dữ liệu không tồn tại');
		    	}

			    $conditions = array('id_document'=>$data->id);
			   
			     if(!empty($dataSend['name'])){
			        $key=createSlugMantan($dataSend['name']);

			        $conditions['slug LIKE']= '%'.$key.'%';
			    }


			    $limit = 20;
			    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
			    if($page<1) $page = 1;
			    $order = array('id'=>'desc');
			    
			    $listData = $modelDocumentinfo->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

			    // phân trang
			    $totalData = $modelDocumentinfo->find()->where($conditions)->all()->toList();
			    $totalData = count($totalData);
			    $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ','data'=>$data, 'listData'=>$listData, 'totalData'=>$totalData);
		    }else{
               $return = array('code'=>3, 'mess'=>'Sai mã token');
           }
			
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

function listDocumentinfoMyMemberAPI($input){
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
       if(!empty($dataSend['type']) && !empty($dataSend['token']) && !empty($dataSend['id_document'])){
        	if($dataSend['type']=='album'){
	    		$type = 'listAlbuminfo';   
	    	}elseif($dataSend['type']=='video'){
	    		$type = 'listVideoinfo';
	    	}else{
	    		$type = 'listAlDocumentinfo';  
	    	}
        	$infoMember = getMemberByToken($dataSend['token'],$type);

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
		    	$data = $modelDocument->find()->where(['id'=>(int)$dataSend['id_document'],'id_parent '=>$infoMember->id, 'type'=>$dataSend['type']])->first();

		    	if(empty($data)){
		    		return array('code'=>3, 'mess'=>'Dữ liệu không tồn tại');
		    	}

			    $conditions = array('id_document'=>$data->id);
			   
			     if(!empty($dataSend['name'])){
			        $key=createSlugMantan($dataSend['name']);

			        $conditions['slug LIKE']= '%'.$key.'%';
			    }


			    $limit = 20;
			    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
			    if($page<1) $page = 1;
			    $order = array('id'=>'desc');
			    
			    $listData = $modelDocumentinfo->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

			    // phân trang
			    $totalData = $modelDocumentinfo->find()->where($conditions)->all()->toList();
			    $totalData = count($totalData);
			    $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ','data'=>$data, 'listData'=>$listData, 'totalData'=>$totalData);
		    }else{
               $return = array('code'=>3, 'mess'=>'Sai mã token');
           }
			
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

function addDocumentinfoAPI($input){
	global $controller;
	global $urlCurrent;
	global $modelCategories;
	global $metaTitleMantan;
	global $session;
	global $isRequestPost;

	$return = array('code'=>1);	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['type']) && !empty($dataSend['token']) && !empty($dataSend['title']) && !empty($dataSend['id_document'])){
			if($dataSend['type']=='album'){
	    		$type = 'addAlbum';   
	    	}elseif($dataSend['type']=='video'){
	    		$type = 'addVideo';
	    	}else{
	    		$type = 'addAlDocument';  
	    	}
        	$infoMember = getMemberByToken($dataSend['token'],$type);

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                } 

				$modelDocument = $controller->loadModel('Documents');
				$modelDocumentinfo = $controller->loadModel('Documentinfos');
				$mess= '';

				$info = $modelDocument->find()->where(['id'=>$dataSend['id_document'], 'type'=>$type, 'id_parent'=>$infoMember->id])->first();

				if(empty($info)){
					return  array('code'=>4, 'mess'=>'thư viện không tồn tại');
				}

	    // lấy data edit
				if(!empty($dataSend['id'])){
					$data = $modelDocumentinfo->find()->where(['id'=>(int) $dataSend['id'],'id_document'=>$info->id])->first();
				}else{
					$data = $modelDocumentinfo->newEmptyEntity();
					$data->created_at = time();
				}

				$file = '';
				if($dataSend['type']=='video'){
					$file = $dataSend['file'];
				}else{
					$time = time();
					if(isset($_FILES['file']) && empty($_FILES['file']["error"])){
						$images = uploadImage($id_parent, 'file', 'file_'.$time);
					}
					if(!empty($images['linkOnline'])){
						$file = $images['linkOnline'];
					}else{
						$file = @$data->file;
					}
				}
	            // tạo dữ liệu save
				$data->title = @$dataSend['title'];
				$data->file = @$file;
				$data->id_document = $info->id;
				$data->description = @$dataSend['description'];
				$data->slug = createSlugMantan(trim($dataSend['title']));


				$modelDocumentinfo->save($data);
				if(!empty($dataSend['id'])){
		        	if($dataSend['type']=='album'){
    					 $note = $infoMember->type_tv.' '. $infoMember->name.' sửa thông tin hình ảnh '.$data->title.' có id là:'.$data->id;
    				}elseif($dataSend['type']=='video'){
    					 $note = $infoMember->type_tv.' '. $infoMember->name.' sửa thông tin Video '.$data->title.' có id là:'.$data->id;
    				}else{
    					 $note = $infoMember->type_tv.' '. $infoMember->name.' sửa thông tin thành liệu  '.$data->title.' có id là:'.$data->id;
    				}
                   
                }else{
                	if($dataSend['type']=='album'){
    					 $note = $infoMember->type_tv.' '. $infoMember->name.' thêm mới thông tin hình ảnh '.$data->title.' có id là:'.$data->id;
    				}elseif($dataSend['type']=='video'){
    					 $note = $infoMember->type_tv.' '. $infoMember->name.' thêm mới thông tin Video  '.$data->title.' có id là:'.$data->id;
    				}else{
    					 $note = $infoMember->type_tv.' '. $infoMember->name.' thêm mới thông tin tài liệu  '.$data->title.' có id là:'.$data->id;
    				}
                    
                }
                addActivityHistory($infoMember,$note,'add'.$dataSend['type'],$data->id);

				$return = array('code'=>2, 'mess'=>'Lưu dữ liệu thành công');
			}else{
				$return = array('code'=>3, 'mess'=>'Sai mã token');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}else{
		$return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
	}

	return $return;    
}   


function deleteDocumentinfoAPI($input){
	global $controller;
    global $isRequestPost;

    if ($isRequestPost) {
	    $dataSend = $input['request']->getData();
	    if(!empty($dataSend['id']) && !empty($dataSend['token'])){
        	if($dataSend['type']=='album'){
	    		$type = 'deleteAlbum';   
	    	}elseif($dataSend['type']=='video'){
	    		$type = 'deleteVideo';
	    	}else{
	    		$type = 'deleteDocument';  
	    	}
        	$infoMember = getMemberByToken($dataSend['token'],$type);

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                } 
				$modelDocument = $controller->loadModel('Documents');

				$modelDocumentinfo = $controller->loadModel('Documentinfos');
			   
			        $data = $modelDocumentinfo->find()->where(['id'=>(int) $dataSend['id']])->first();
			        
			        if(!empty($data->id_document)){

			        	$document = $modelDocument->find()->where(['id'=>$data->id_document,'id_parent'=>$infoMember->id])->first();
			        	if(!empty($document)){
			            $modelDocument->delete($data);
			      			$return = array('code'=>1, 'mess'=>'xóa dữ liệu thành công');

			      		}else{
			      			$return = array('code'=>2, 'mess'=>'Dữ liệu này không được xóa');
			      		}
		        }else{
		            $return = array('code'=>2, 'mess'=>'Dữ liệu này không được xóa');
		        }
		    }else{
               $return = array('code'=>3, 'mess'=>'Sai mã token');
           }
	    }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }
    return $return;
}


function getDocumentinfoAPI($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    $modelDocument = $controller->loadModel('Documents');
	$modelDocumentinfo = $controller->loadModel('Documentinfos');
    $modelMember = $controller->loadModel('Members');
   	if($isRequestPost){
	$return = array('code'=>1);	
	$dataSend = $input['request']->getData();
	    if(!empty($dataSend['id']) && !empty($dataSend['token'])){
        	if($dataSend['type']=='album'){
	    		$type = 'listAlbuminfo';   
	    	}elseif($dataSend['type']=='video'){
	    		$type = 'listVideoinfo';
	    	}else{
	    		$type = 'listAlDocumentinfo';  
	    	}
        	$infoMember = getMemberByToken($dataSend['token'],$type);

            if(!empty($infoMember)){
            	if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
            
		    	$data = $modelDocumentinfo->find()->where(array('id'=>$dataSend['id']))->first();

		    	if(empty($data)){
		    		return array('code'=>3, 'mess'=>'Dữ liệu không tồn tại');
		    	}
		    
		    $data->document = $modelDocument->find()->where(array('id'=>$data->id_document))->first();

		    // phân trang
		   
		    $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ','data'=>$data);
			
       	}else{
               $return = array('code'=>3, 'mess'=>'Sai mã token');
           }
	    }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }
    return $return;
}


?>