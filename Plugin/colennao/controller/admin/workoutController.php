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


    if(!empty($_GET['id'])){
        $data = $modelWorkout->find()->where(['id'=>(int) $_GET['id']])->first();
        if($data){

            $modelWorkout->delete($data);
        }
    }
    return $controller->redirect('/plugins/admin/colennao-view-admin-workout-listWorkout');


}


?>