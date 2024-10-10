<?php 
function listPost(){
	global $urlCurrent;
	global $modelPosts;
	global $modelCategories;
	global $controller;

	$user = checklogin('listPost');
	if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

		$conditions = array('type'=>'post');
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['title'])){
			$conditions['title LIKE'] = '%'.$_GET['title'].'%';
		}

		if(!empty($_GET['idCategory'])){
			$conditions['idCategory'] = (int) $_GET['idCategory'];
		}

		$listData = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'DESC'])->all()->toList();

		$totalData = $modelPosts->find()->where($conditions)->all()->toList();
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

		  $mess ='';
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
		setVariable('mess', $mess);
		setVariable('urlPage', $urlPage);

		setVariable('listData', $listData);
		setVariable('listCategory', $categories);
	}else{
        return $controller->redirect('/login');
    }
}

function addPost($input){
	global $modelPosts;
	global $modelSlugs;
	global $modelCategories;
    global $isRequestPost;
    global $controller;
	global $modelCategoryConnects;

	$mess = '';
	$modelSlugs = $controller->loadModel('Slugs');
	$user = checklogin('addPost');
	if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listPost');
        }

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

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

		if($isRequestPost) {
			$dataSend =  $input['request']->getData();

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

				$infoPost->categories = $dataSend['idCategory'];

				if(!empty($_GET['id'])){
                      $note = $user->type_tv.' '. $user->name.' sửa thông tin bài tin tức '.$infoPost->title.' có id là:'.$infoPost->id;
                }else{
                      $note = $user->type_tv.' '. $user->name.' thêm thông tin bài tin tức '.$infoPost->title.' có id là:'.$infoPost->id;
                }

                 addActivityHistory($user,$note,'addPost',$infoPost->id);

                 return $controller->redirect('/listPost?mess=saveSuccess');

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

		setVariable('infoPost', $infoPost);
		setVariable('mess', $mess);
		setVariable('listCategory', $categories);

	}else{
        return $controller->redirect('/login');
    }
}

function deletePost(){

	global $urlCurrent;
	global $modelPosts;
	global $modelCategories;
	global $controller;
	$user = checklogin('deletePost');
	if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listPost');
        }

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }
	

		if(!empty($_GET['id'])){
			$data = $modelPosts->get($_GET['id']);
			if($data){
				$note = $user->type_tv.' '. $user->name.' xóa thông tin nhóm tin tức '.$data->title.' có id là:'.$data->id;
                

            addActivityHistory($user,$note,'deletePost',$data->id);
				$modelPosts->delete($data);

				deleteSlugURL($data->slug);
				 return $controller->redirect('/listPost?mess=deleteSuccess');
            }
        }

    return $controller->redirect('/listPost?mess=deleteError');

	}else{
        return $controller->redirect('/login');
    }
}

function listCategoryPost($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    $user = checklogin('listCategoryPost');  
    $modelSlugs = $controller->loadModel('Slugs');
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listPost');
        }

         if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

        if ($isRequestPost) {
            $checluser = checklogin('addCategoryPost'); 
            if(!empty($checluser->grant_permission)){
                $dataSend = $input['request']->getData();
                
                // tính ID category
                if(!empty($dataSend['idCategoryEdit'])){
                    $infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
                }else{
                    $infoCategory = $modelCategories->newEmptyEntity();
                }

                // tạo dữ liệu save
                $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                $infoCategory->parent = 0;
                $infoCategory->image = @$dataSend['image'];
                $infoCategory->status = 'active';
                $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
                $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
                $infoCategory->type = 'post';

                // tạo slug
                $slug = createSlugMantan($infoCategory->name);
                $slugNew = $slug;
                $number = 0;
                $checkSlug = $modelSlugs->find()->where(['slug'=>$slugNew])->first();
		            if(empty($infoCategory->slug) || $infoCategory->slug!=$slugNew || empty($checkSlug)){
		                do{
		                    $conditions = array('slug'=>$slugNew);
		                    $listData = $modelSlugs->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

		                    if(!empty($listData)){
		                        $number++;
		                        $slugNew = $slug.'-'.$number;
		                    }
		                }while (!empty($listData));

		                // lưu url slug
		                saveSlugURL($slugNew,'homes','category_post');
		                if(!empty($infoCategory->slug)){
		                    deleteSlugURL($infoCategory->slug);
		                }
		            }


                $infoCategory->slug = $slugNew;

                $modelCategories->save($infoCategory);

                if(!empty($dataSend['idCategoryEdit'])){
                        $note = $user->type_tv.' '. $user->name.' sửa thông tin nhóm tin tức '.$infoCategory->name.' có id là:'.$infoCategory->id;
                    
                }else{
                    $note = $user->type_tv.' '. $user->name.' tạo mới thông tin nhóm tin tức '.$infoCategory->name.' có id là:'.$infoCategory->id;
                }

            addActivityHistory($user,$note,'listCategoryPost',$infoCategory->id);


             $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }else{
               $mess= '<p class="text-danger">Bạn không có quyền thêm sửa </p>'; 
            }

        }

        if(!empty($_GET['mess']) && $_GET['mess']=='noPermissiondelete'){
             $mess= '<p class="text-danger">Bạn không có quyền xóa</p>'; 
        }

        $conditions = array('type' => 'post','status'=>'active');
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
        setVariable('mess', @$mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteCategoryPost($input){
    global $controller;
    global $session;

    global $modelCategories;
     $user = checklogin('deleteCategoryPost');  
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCategoryPost?mess=noPermissiondelete');
        }


        if(!empty($_GET['id'])){
            $data = $modelCategories->get($_GET['id']);
            
            if($data){
                $data->status = 'lock';
                $modelCategories->save($data);
                $note = $user->type_tv.' '. $user->name.' xóa thông tin nhóm tin tức '.$data->name.' có id là:'.$data->id;
                

            addActivityHistory($user,$note,'deleteCategoryPost',$data->id);
                //deleteSlugURL($data->slug);
            }
        }

     return $controller->redirect('/listCategoryPost');

    }else{
        return $controller->redirect('/login');
    }
}


?>