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
    global $searchtime;
    global $listLevel;
    global $listdevice;


    $metaTitleMantan = 'Thông tin bài luyện tập';

    $modelWorkout = $controller->loadModel('Workouts');
    $modelDevices = $controller->loadModel('Devices');
    $modelAreas = $controller->loadModel('Areas');
    
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
            

            if(!empty($dataSend['title']) && !empty($dataSend['title_en'])){
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
                $data->title_en = @$dataSend['title_en'];
                $data->status = @$dataSend['status'];
                $data->description = @$dataSend['description'];
                $data->description_en = @$dataSend['description_en'];
                $data->youtube_code = @$dataSend['youtube_code'];

                $search =  array( 'time' =>json_encode(@$dataSend['time']),
                                  'area' =>json_encode(@$dataSend['area']),
                                  'level' =>json_encode(@$dataSend['level']),
                                  'device' =>json_encode(@$dataSend['device']),

                );
                $data->search = json_encode(@$search);
                

                $modelWorkout->save($data);
                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

                }else{
                    $mess = '<p class="text-danger">Bạn thiếu dữ liệu</p>';
                }
                

                

        }
        if(!empty($data->search)){
            $data->search = json_decode($data->search, true);
        }
        

        $listarea = $modelAreas->find()->where()->order(['id'=>'desc'])->all()->toList();

     


        setVariable('mess', $mess);
        setVariable('listdevice', $listdevice);
        setVariable('listarea', $listarea);
        setVariable('data', $data);         
        setVariable('searchtime', $searchtime);         
        setVariable('listLevel', $listLevel);         
        setVariable('listdevice', $listdevice);         
    
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
    $modelAreas = $controller->loadModel('Areas');


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
            

            if(!empty($dataSend['title']) && !empty($dataSend['title_en'])){
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


                if(isset($_FILES['sound']) && empty($_FILES['sound']["error"])){
                    if(!empty($data->id)){
                        $fileName = 'sound__workout'.$data->id;
                    }else{
                        $fileName = 'sound__workout'.time().rand(0,1000000);
                    }

                    $sound = uploadImage(1, 'sound', $fileName);
                }

                if(!empty($sound['linkOnline'])){
                    $data->sound = $sound['linkOnline'].'?time='.time();
                }else{
                    if(empty($data->sound)){
                        $data->sound = '';
                    }
                }

                // tạo dữ liệu save
                $data->title = @$dataSend['title'];
                $data->title_en = @$dataSend['title_en'];
                $data->status = @$dataSend['status'];
                $data->description = @$dataSend['description'];
                $data->description_en = @$dataSend['description_en'];
                $data->youtube_code = @$dataSend['youtube_code'];
                $data->time =(int) @$dataSend['time'];
                $data->level = @$dataSend['level'];
                $data->kcal =(int)@$dataSend['kcal'];
                $data->time_reverse =(int)@$dataSend['time_reverse'];
                $data->device = json_encode(@$dataSend['device']);
                $data->area = json_encode(@$dataSend['area']);

                $group_exercise = [];
                if(!empty($dataSend['group_exercise'])){
                    foreach($dataSend['group_exercise'] as $key => $item){
                         $group_exercise[] = ['id'=>(int)$dataSend['id_group'][$key],
                                            'name' =>$item,
                                            'name_en' =>@$dataSend['group_exercise_en'][$key],

                                ];
                    }
                }


               
                $data->group_exercise = json_encode(@$group_exercise);
                $data->id_workout = @$checkWorkout->id;  

                $modelExerciseWorkouts->save($data);

                 $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

            }else{
                    $mess = '<p class="text-danger">Bạn thiếu dữ liệu</p>';
            }

        }

        if(!empty($data->group_exercise)){
            $data->group_exercise = json_decode($data->group_exercise, true);
        }           


        
        if(!empty($data->device)){
            $data->device = json_decode($data->device, true);
        }
        if(!empty($data->area)){
            $data->area = json_decode($data->area, true);
        }

         $conditions = array();
        $listdevice = $modelDevices->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();
        $listarea = $modelAreas->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();
        
        // debug($data);
        // die();

        setVariable('mess', $mess);
        setVariable('data', $data);         
        setVariable('checkWorkout', $checkWorkout);         
        setVariable('listdevice', $listdevice);         
        setVariable('listarea', $listarea);         
    
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
            if(!empty($dataSend['title']) && !empty($dataSend['title_en'])  && !empty($dataSend['youtube_code'])  && !empty($dataSend['content'])  && !empty($dataSend['content_en'])){
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
                $data->title_en = @$dataSend['title_en'];
                $data->time =(int) @$dataSend['time'];
                $data->description = @$dataSend['description'];
                $data->description_en = @$dataSend['description_en'];
                $data->youtube_code = @$dataSend['youtube_code'];
                $data->content = @$dataSend['content'];
                $data->content_en = @$dataSend['content_en'];
                $data->id_group =(int) @$dataSend['id_group'];
                $data->device = json_encode(@$dataSend['device']);
                $data->time_reverse =(int)@$dataSend['time_reverse'];
                $data->group_exercise = json_encode(@$group_exercise);
                $data->id_exercise = @$dataExercise->id;  

           

                $modelChildExerciseWorkouts->save($data);
                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

            }else{
                $mess= '<p class="text-danger">bạn thiếu dữ liệu</p>';
            }
                

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