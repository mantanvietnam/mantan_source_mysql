<?php 
function listPackageWorkouts(){
	{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách gói luyên tập';
    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] = $_GET['id'];
    }

    if (!empty($_GET['title'])) {
        $conditions['title LIKE'] = '%' . $_GET['title'] . '%';
    }

    
    $listData = $modelPackageWorkout->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();
    if(!empty($listData)){
        foreach($listData as $key => $item){
            $listData[$key]->Workout = count($modelIntermePackageWorkout->find()->where(['id_package'=>$item->id])->all()->toList());
        }
    }
    
    $totalUser = $modelPackageWorkout->find()->where($conditions)->all()->toList();
    $paginationMeta = createPaginationMetaData(count($totalUser),$limit,$page); 
        

    

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}


function addPackageWorkouts($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;


    $metaTitleMantan = 'Thông tin thách thức';
    
    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');
    $modelWorkout = $controller->loadModel('Workouts');
        $mess= '';
        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelPackageWorkout->get( (int) $_GET['id']);

        }else{
            $data = $modelPackageWorkout->newEmptyEntity();
            $data->created_at = time();
        }


        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            

            if(!empty($dataSend['title'])){
                if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
                    if(!empty($data->id)){
                        $fileName = 'image_product_'.$data->id;
                    }else{
                        $fileName = 'image_product_'.time().rand(0,1000000);
                    }

                    $image = uploadImage(1, 'image', $fileName);
                }

                if(!empty($image['linkOnline'])){
                    $data->image = $image['linkOnline'].'?time='.time();
                }else{
                    if(empty($data->image)){
                        $data->image = '';
                    }
                }

                // tạo dữ liệu save
                $data->title = @$dataSend['title'];
                $data->status = @$dataSend['status'];
                $data->description = @$dataSend['description'];
                $data->content = @$dataSend['content'];

                
                if(!empty($dataSend['price'])){
                	$price_package = array();
                    foreach ($dataSend['price'] as $key => $price) {
                    	if(!empty($price)){
                       		$price_package[$key] = array( 'id' => $dataSend['id_price'][$key],
                       			 'price' => $price,
                       			 'status' =>  $dataSend['status_price'][$key],
                       			 'title' => $dataSend['title_price'][$key],
                       			 'number_day' => $number_day,
                       			);
                        }
                    }

                   $data->price_package = json_encode(@$price_package);

                }	

                $modelPackageWorkout->save($data);
                    if(!empty($dataSend['id_workout'])){
                    	$conditions = ['id_package'=>$data->id];
                        $modelIntermePackageWorkout->deleteAll($conditions);
                        foreach ($dataSend['id_workout'] as $key => $id_workout) {
                       		$save = $modelIntermePackageWorkout->newEmptyEntity();
                            $save->id_workout = @$id_workout;
                            $save->id_package = $data->id;
                            $modelTipChallenges->save($save);
                        }
                    }else{
                        $conditions = ['id_package'=>$data->id];
                        $modelIntermePackageWorkout->deleteAll($conditions);
                    }
                

                }
                


                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

        }

         if(!empty($data->price_package)){
        	$data->price_package = json_decode($data->price_package, true);
    	}

        if(!empty($data->id)){
            $data->Workouts = $modelIntermePackageWorkout->find()->where(['id_package'=>$data->id])->all()->toList();
        }

         $dataWorkout = $modelWorkout->find()->where(array())->order(['id' => 'desc'])->all()->toList();


        setVariable('mess', $mess);
        setVariable('dataWorkout', $dataWorkout);
        setVariable('data', $data);
    
}



}
 ?>
