<?php 

function listuserpeople($input){
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách ';
    $modeluserpeople = $controller->loadModel('userpeople');
    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    
    $listData = $modeluserpeople->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modeluserpeople->find()->where($conditions)->all()->toList();
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
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);

}
function adduserpeople($input) {
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thêm userpeople';
    $modeluserpeople = $controller->loadModel('userpeople');
    $modelWorkouts = $controller->loadModel('Workouts');
    $modelExerciseWorkouts = $controller->loadModel('ExerciseWorkouts');
    $modelmyplane = $controller->loadModel('myplane');
    $mess = '';

    $dataExerciseWorkouts = $modelExerciseWorkouts->find()->all();
    
    $dataWorkouts = $modelWorkouts->find()->all();
   
    $datamyplane = $modelmyplane->find()->all();

    if (!empty($_GET['id'])) {
        $data = $modeluserpeople->get((int)$_GET['id']);
    } else {
        $data = $modeluserpeople->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['name'])) {
            $data->name = $dataSend['name'];
            $data->image = $dataSend['image'];
            $data->id_consume = $dataSend['id_consume'];
            $data->type = $dataSend['type'];
    
            $idLessons = [];

         
            if (!empty($dataSend['workout_group']) && !empty($dataSend['workout_title'])) {
                foreach ($dataSend['workout_group'] as $index => $workoutGroup) {
                    $workoutTitle = $dataSend['workout_title'][$index];
            
                    if (!empty($workoutGroup) && !empty($workoutTitle)) {
                        $idLessons[] = [(int)$workoutGroup, (int)$workoutTitle];
                    }
                }
            
                $data->id_lesson = json_encode($idLessons);
            } else {
                $data->id_lesson = null;
            }

   
            if ($modeluserpeople->save($data)) {
                $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
            } else {
                $mess = '<p class="text-danger">Có lỗi xảy ra, vui lòng thử lại</p>';
            }
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
        }
    }


    setVariable('dataExerciseWorkouts', $dataExerciseWorkouts);
    setVariable('dataWorkouts', $dataWorkouts);
    setVariable('datamyplane', $datamyplane);
    setVariable('data', $data);
    setVariable('mess', $mess);
}


function deleteuserpeople($input){
    global $controller;

    $modeluserpeople = $controller->loadModel('userpeople');
    
    if(!empty($_GET['id'])){
        $data = $modeluserpeople->get($_GET['id']);
        
        if($data){
            $modeluserpeople->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/colennao-view-admin-listuserpeople-listuserpeople');
}




?>