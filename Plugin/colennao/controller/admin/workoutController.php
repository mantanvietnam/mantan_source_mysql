<?php 
function listWorkout($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách bài luyện tập';
    $modelWorkout = $controller->loadModel('Workouts');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');

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

    
    $listData = $modelWorkout->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();
    if(!empty($listData)){
        foreach($listData as $key => $item){
            $listData[$key]->total_exercise = count($modelExerciseWorkouts->find()->where(['id_workout'=>$item->id])->all()->toList());
        }
    }
    
    $totalUser = $modelWorkout->find()->where($conditions)->all()->toList();
    $paginationMeta = createPaginationMetaData(count($totalUser),$limit,$page); 

    

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function addWorkout($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;


    $metaTitleMantan = 'Thông tin bài luyện tập';

    $modelWorkout = $controller->loadModel('Workouts');
    
    
        $mess= '';
        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelWorkout->get( (int) $_GET['id']);

        }else{
            $data = $modelWorkout->newEmptyEntity();
            $data->created_at = time();
        }


        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            

            if(!empty($dataSend['title'])){
                if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
                    if(!empty($data->id)){
                        $fileName = 'image__workout'.$data->id;
                    }else{
                        $fileName = 'image__workout'.time().rand(0,1000000);
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
                $data->youtube_code = @$dataSend['youtube_code'];
                

                $modelWorkout->save($data);

                }
                

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

        }
        


        setVariable('mess', $mess);
        setVariable('data', $data);         
    
}


function deleteWorkout(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $metaTitleMantan = 'Thông tin thách thức';
    
    $modelWorkout = $controller->loadModel('Workouts');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');
    $modelIntermePackageWorkout = $controller->loadModel('IntermePackageWorkouts');


    if(!empty($_GET['id'])){
        $data = $modelWorkout->find()->where(['id'=>(int) $_GET['id']])->first();
        if($data){
            $conditions = ['id_workout'=>$data->id];
            $modelExerciseWorkouts->deleteAll($conditions);
            $modelIntermePackageWorkout->deleteAll($conditions);
            $modelWorkout->delete($data);
        }
    }
    return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listWorkout');


}


function listExerciseWorkout($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách bài luyện tập';
    $modelWorkout = $controller->loadModel('Workouts');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');
    $modelChildExerciseWorkouts = $controller->loadModel('ChildExerciseWorkouts');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] =(int) $_GET['id'];
    }

    if(!empty($_GET['id_workout'])) {
        $conditions['id_workout'] =(int) $_GET['id_workout'];

        $data = $modelWorkout->find()->where(['id'=>$_GET['id_workout']])->first();

            if(empty($data)){
                return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listWorkout');
            }
    }else{
         return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listWorkout');
    }

    if (!empty($_GET['title'])) {
        $conditions['title LIKE'] = '%' . $_GET['title'] . '%';
    }

    
    $listData = $modelExerciseWorkouts->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();
    if(!empty($listData)){
        foreach($listData as $key => $item){
            $listData[$key]->total_child = count($modelChildExerciseWorkouts->find()->where(['id_exercise'=>$item->id])->all()->toList());
        }
    }
    
    $totalUser = $modelExerciseWorkouts->find()->where($conditions)->all()->toList();
    $paginationMeta = createPaginationMetaData(count($totalUser),$limit,$page); 

    

    setVariable('page', $page);
    setVariable('data', $data);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function addExerciseWorkout($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;


    $metaTitleMantan = 'Thông tin bài luyện tập';

    $modelWorkout = $controller->loadModel('Workouts');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');
    $modelDevices = $controller->loadModel('Devices');


    if(!empty($_GET['id_workout'])) {

        $checkWorkout = $modelWorkout->find()->where(['id'=>$_GET['id_workout']])->first();

            if(empty($checkWorkout)){
                return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listWorkout');
            }
    }else{
         return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listWorkout');
    }
    
    
        $mess= '';
        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelExerciseWorkouts->get( (int) $_GET['id']);

        }else{
            $data = $modelExerciseWorkouts->newEmptyEntity();
            $data->created_at = time();
        }


        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            

            if(!empty($dataSend['title'])){
                if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
                    if(!empty($data->id)){
                        $fileName = 'image__workout'.$data->id;
                    }else{
                        $fileName = 'image__workout'.time().rand(0,1000000);
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

                if(isset($_FILES['area_image']) && empty($_FILES['area_image']["error"])){
                    if(!empty($data->id)){
                        $fileName = 'image__workout'.$data->id;
                    }else{
                        $fileName = 'image__workout'.time().rand(0,1000000);
                    }

                    $area_image = uploadImage(1, 'area_image', $fileName);
                }

                if(!empty($area_image['linkOnline'])){
                    $data->area_image = $area_image['linkOnline'].'?time='.time();
                }else{
                    if(empty($data->area_image)){
                        $data->area_image = '';
                    }
                }

                // tạo dữ liệu save
                $data->title = @$dataSend['title'];
                $data->status = @$dataSend['status'];
                $data->description = @$dataSend['description'];
                $data->youtube_code = @$dataSend['youtube_code'];
                $data->time =(int) @$dataSend['time'];
                $data->area = @$dataSend['area'];
                $data->level = @$dataSend['level'];
                $data->kcal =(int)@$dataSend['kcal'];
                $data->device = json_encode(@$dataSend['device']);

                $group_exercise = [];
                if(!empty($dataSend['group_exercise'])){
                    foreach($dataSend['group_exercise'] as $key => $item){
                         $group_exercise[] = ['id'=>(int)$dataSend['id_group'][$key],
                                            'name' =>$item

                                ];
                    }
                }


               
                $data->group_exercise = json_encode(@$group_exercise);
                $data->id_workout = @$checkWorkout->id;  

           

                $modelExerciseWorkouts->save($data);

                }
                

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

        }

        if(!empty($data->group_exercise)){
            $data->group_exercise = json_decode($data->group_exercise, true);
        }           


        
        if(!empty($data->device)){
            $data->device = json_decode($data->device, true);
        }

         $conditions = array();
        $listdevice = $modelDevices->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();
        
        // debug($data);
        // die();

        setVariable('mess', $mess);
        setVariable('data', $data);         
        setVariable('checkWorkout', $checkWorkout);         
        setVariable('listdevice', $listdevice);         
    
}


function deleteExerciseWorkout(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $metaTitleMantan = 'Thông tin thách thức';
    
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');
    $modelChildExerciseWorkouts = $controller->loadModel('ChildExerciseWorkouts');


    if(!empty($_GET['id'])){
        $data = $modelExerciseWorkouts->find()->where(['id'=>(int) $_GET['id']])->first();
        if($data){
            $conditions = ['id_exercise'=>$data->id];
            $modelChildExerciseWorkouts->deleteAll($conditions);
            $modelExerciseWorkouts->delete($data);
        }
    }
    return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listExerciseWorkout?id_workout='.@$_GET['id_workout']);


}

function listChildExerciseWorkout($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách bài luyện tập';
    $modelWorkout = $controller->loadModel('Workouts');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');
    $modelChildExerciseWorkouts = $controller->loadModel('ChildExerciseWorkouts');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] =(int) $_GET['id'];
    }

    if(!empty($_GET['id_workout'])) {
        //$conditions['id_workout'] =(int) $_GET['id_workout'];

        $dataWorkout = $modelWorkout->find()->where(['id'=>$_GET['id_workout']])->first();

            if(empty($dataWorkout)){
                return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listWorkout');
            }
    }else{
         return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listWorkout');
    }


    if(!empty($_GET['id_exercise'])) {
        $conditions['id_exercise'] =(int) $_GET['id_exercise'];

        $dataExercise = $modelExerciseWorkouts->find()->where(['id'=>$_GET['id_exercise']])->first();

            if(empty($dataExercise)){
                return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listExerciseWorkout?id_workout='.$_GET['id_workout']);
            }
    }else{
         return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listExerciseWorkout?id_workout='.$_GET['id_workout']);
    }

    if (!empty($_GET['title'])) {
        $conditions['title LIKE'] = '%' . $_GET['title'] . '%';
    }

    
    $listData = $modelChildExerciseWorkouts->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();
    
    
    $totalUser = $modelChildExerciseWorkouts->find()->where($conditions)->all()->toList();
    $paginationMeta = createPaginationMetaData(count($totalUser),$limit,$page); 
    if(!empty($dataExercise->group_exercise)){
            $dataExercise->group_exercise = json_decode($dataExercise->group_exercise, true);
        } 

    

    setVariable('page', $page);
    setVariable('dataWorkout', $dataWorkout);
    setVariable('dataExercise', $dataExercise);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function addChildExerciseWorkout($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;


    $metaTitleMantan = 'Thông tin bài luyện tập';

    $modelWorkout = $controller->loadModel('Workouts');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');
    $modelDevices = $controller->loadModel('Devices');
    $modelChildExerciseWorkouts = $controller->loadModel('ChildExerciseWorkouts');


    if(!empty($_GET['id_workout'])) {

        $dataWorkout = $modelWorkout->find()->where(['id'=>(int)$_GET['id_workout']])->first();

            if(empty($dataWorkout)){
                return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listWorkout');
            }
    }else{
         return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listWorkout');
    }

    if(!empty($_GET['id_exercise'])) {

        $dataExercise = $modelExerciseWorkouts->find()->where(['id'=>(int)$_GET['id_exercise']])->first();

            if(empty($dataExercise)){
                return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listExerciseWorkout?id_workout='.$_GET['id_workout']);
            }
    }else{
         return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listExerciseWorkout?id_workout='.$_GET['id_workout']);
    }
    
    
        $mess= '';
        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelChildExerciseWorkouts->get( (int) $_GET['id']);

        }else{
            $data = $modelChildExerciseWorkouts->newEmptyEntity();
            $data->created_at = time();
        }


        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            

            if(!empty($dataSend['title'])){
                if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
                    if(!empty($data->id)){
                        $fileName = 'image_childexercise'.$data->id;
                    }else{
                        $fileName = 'image_childexercise'.time().rand(0,1000000);
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
                $data->time =(int) @$dataSend['time'];
                $data->description = @$dataSend['description'];
                $data->youtube_code = @$dataSend['youtube_code'];
                $data->content = @$dataSend['content'];
                $data->id_group =(int) @$dataSend['id_group'];
                $data->device = json_encode(@$dataSend['device']);
               
                $data->group_exercise = json_encode(@$group_exercise);
                $data->id_exercise = @$dataExercise->id;  

           

                $modelChildExerciseWorkouts->save($data);

                }
                

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

        }          
        
        if(!empty($data->device)){
            $data->device = json_decode($data->device, true);
        }

         if(!empty($dataExercise->device)){
            $dataExercise->device = json_decode($dataExercise->device, true);
        }

        if(!empty($dataExercise->group_exercise)){
            $dataExercise->group_exercise = json_decode($dataExercise->group_exercise, true);
        } 



         $conditions = array();
        $listdevice = $modelDevices->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();
        
        // debug($data);
        // die();

        setVariable('mess', $mess);
        setVariable('data', $data);         
        setVariable('dataWorkout', $dataWorkout);
        setVariable('dataExercise', $dataExercise);          
        setVariable('listdevice', $listdevice);         
    
}


function deleteChildExerciseWorkout(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $metaTitleMantan = 'Thông tin thách thức';
    
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');
    $modelChildExerciseWorkouts = $controller->loadModel('ChildExerciseWorkouts');


    if(!empty($_GET['id'])){
        $data = $modelExerciseWorkouts->find()->where(['id'=>(int) $_GET['id']])->first();
        if($data){
            $conditions = ['id_exercise'=>$data->id];
            $modelChildExerciseWorkouts->deleteAll($conditions);
            $modelExerciseWorkouts->delete($data);
        }
    }
    return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listExerciseWorkout?id_workout='.@$_GET['id_workout']);


}


?>