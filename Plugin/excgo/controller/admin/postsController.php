<?php 
function addPostAdmin($input){

	global $modelPosts;
    global $controller;
    global $isRequestPost;

	$modelSlugs = $controller->loadModel('Slugs');
	$modelCategories = $controller->loadModel('Categories');
	$modelCategoryConnects = $controller->loadModel('CategoryConnects');
	$modelPostProvince = $controller->loadModel('PostProvinces');
	$modelProvince = $controller->loadModel('Provinces');
		
		$mess = '';

		// lấy data edit
	    if(!empty($_GET['id'])){
	        $infoPost = $modelPosts->find()->where(['id'=>(int) $_GET['id']])->first();

	        if(!empty($infoPost)){
	        	$categories = $modelCategoryConnects->find()->where(['keyword'=>'post', 'id_parent'=>(int) $_GET['id']])->all()->toList();
	        	$infoPost->categories = [];

	        	if(!empty($categories)){
	        		foreach ($categories as $key => $value) {
	        			$infoPost->categories[] = $value->id_category;
	        		}
	        	}
	    	}
	    }else{
	        $infoPost = $modelPosts->newEmptyEntity();
	    }

        if ($isRequestPost){
        	$dataSend = $input['request']->getData();

        	if(!empty($dataSend['title'])){
	            // xử lý thời gian đăng
	            $today= getdate();
	            $datePost = explode('/', $dataSend['date']);
	            
	            if(!empty($datePost))
	            {
		            $time= mktime($today['hours'], $today['minutes'], $today['seconds'], $datePost[1], $datePost[0], $datePost[2]);
	            }

	            if(empty($dataSend['idCategory'])){
	            	$dataSend['idCategory'] = [];
	            }

	            // tạo dữ liệu save
	            $infoPost->title = str_replace(array('"', "'"), '’', $dataSend['title']);
	            $infoPost->author = $dataSend['author'];
	            $infoPost->pin = (int) $dataSend['pin'];
	            $infoPost->time = $time;
	            $infoPost->image = $dataSend['image'];
	            $infoPost->idCategory = (int) @$dataSend['idCategory'][0];
	            $infoPost->keyword = $dataSend['keyword'];
	            $infoPost->description = $dataSend['description'];
	            $infoPost->content = $dataSend['content'];
	            $infoPost->number_order = (int)$dataSend['number_order'];
	            $infoPost->type = 'post';

	            // tạo slug
	            $slug = createSlugMantan($infoPost->title);
	            $slugNew = $slug;
	            $number = 0;

	            $checkSlug = $modelSlugs->find()->where(['slug'=>$slugNew])->first();

	            if(empty($infoPost->slug) || $infoPost->slug!=$slugNew || empty($checkSlug) ){
		            do{
		            	$conditions = array('slug'=>$slugNew);
	        			$listData = $modelSlugs->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

	        			if(!empty($listData)){
	        				$number++;
	        				$slugNew = $slug.'-'.$number;
	        			}
		            }while (!empty($listData));
		        
		            // lưu url slug
		            saveSlugURL($slugNew, 'homes', 'info_page');
		            
		            if(!empty($infoPost->slug)){
		            	deleteSlugURL($infoPost->slug);
		            }
		        }
	            
	            $infoPost->slug = $slugNew;

	            $modelPosts->save($infoPost);

	            // tạo dữ liệu bảng chuyên mục
	            $modelCategoryConnects->deleteAll(['id_parent'=>$infoPost->id, 'keyword'=>'post']);

	            if(!empty($dataSend['idCategory'])){
	            	foreach ($dataSend['idCategory'] as $idCategory) {
	            		$categoryConnects = $modelCategoryConnects->newEmptyEntity();

		        		$categoryConnects->keyword = 'post';
		        		$categoryConnects->id_parent = $infoPost->id;
		        		$categoryConnects->id_category = $idCategory;

		        		$modelCategoryConnects->save($categoryConnects);
	            	}
	            }

	            $modelPostProvince->deleteAll(['post_id'=>$infoPost->id]);

	            if(!empty($dataSend['province_id'])){
	            	foreach ($dataSend['province_id'] as $key => $province_id) {
	            		$province = $modelPostProvince->newEmptyEntity();
		        		$province->province_id = $province_id;
		        		$province->post_id =  $infoPost->id;
		        		$province->number_order = (int) $dataSend['number_province'][$key];

		        		$modelPostProvince->save($province);
	            	}
	            }

	            $infoPost->categories = $dataSend['idCategory'];

	            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	        }else{
	        	$mess= '<p class="text-danger">Nhập thiếu dữ liệu</p>';
	        }
        }

        // lấy danh sách danh mục
        $conditions = array('type' => 'post');
    	$listCategory = $modelCategories->find()->where($conditions)->order(['parent'=>'asc', 'id'=>'asc'])->all()->toList();

    	$categories = [];
    	if(!empty($listCategory)){
    		foreach ($listCategory as $key => $value) {
    			if($value->parent == 0){
    				$categories[$value->id]['name'] = $value->name;
    			}else{
    				foreach ($categories as $key1 => $value1) {
    					if($key1 == $value->parent){
    						$categories[$key1]['sub'][$value->id]['name'] = $value->name;
    					}elseif(!empty($categories[$key1]['sub'])){
    						foreach ($categories[$key1]['sub'] as $key2 => $value2) {
    							if($key2 == $value->parent){
		    						$categories[$key1]['sub'][$key2]['sub'][$value->id]['name'] = $value->name;
		    					}elseif(!empty($categories[$key1]['sub'][$key2]['sub'])){
		    						foreach ($categories[$key1]['sub'][$key2]['sub'] as $key3 => $value3) {
		    							if($key3 == $value->parent){
				    						$categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['name'] = $value->name;
				    					}elseif(!empty($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'])){
				    						foreach ($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'] as $key4 => $value4) {
				    							if($key4 == $value->parent){
						    						$categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['name'] = $value->name;
						    					}
				    						}
				    					}
		    						}
		    					}
    						}
    					}
    				}
    			}
    		}
    	}

    	$listProvince = $modelProvince->find()->where(['parent_id' => 0, 'status' => 1])->order(['id'=>"asc"])->all()->toList();
    	 $listPost = [];

    	 if(!empty($infoPost->id)){
        $PostProvince = $modelPostProvince->find()->where(['post_id'=>$infoPost->id])->all()->toList();

        if(!empty($PostProvince)){
            foreach ($PostProvince as $key => $item) {
                $listPost[$item->province_id] = $item->number_order;
            }
        }
    }



        setVariable('infoPost', $infoPost);
        setVariable('listCategory', $categories);
        setVariable('mess', $mess);
        setVariable('listPost', $listPost);
        setVariable('listProvince', $listProvince);
	}
 ?>