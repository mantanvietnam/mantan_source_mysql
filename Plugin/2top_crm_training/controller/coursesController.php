<?php 
function listCourseCRM($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách khóa học';

    $modelCourses = $controller->loadModel('Courses');
    $modelLesson = $controller->loadModel('Lessons');

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelCourses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            if(!empty($value->id_category) && empty($category[$value->id_category])){
                $category[$value->id_category] = $modelCategories->find()->where(['id' => (int) $value->id_category])->first();
            }
            
            $listData[$key]->name_category = (!empty($category[$value->id_category]->name))?$category[$value->id_category]->name:'';

            $lessons = $modelLesson->find()->where(['id_course'=>$value->id])->all()->toList();
            $listData[$key]->number_lesson = count($lessons);
        }
    }

    // phân trang
    $totalData = $modelCourses->find()->where($conditions)->all()->toList();
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
    
    setVariable('listData', $listData);
}

function addCourseCRM($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin khóa học';

    $modelCourses = $controller->loadModel('Courses');
    $modelSlugs = $controller->loadModel('Slugs');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelCourses->get( (int) $_GET['id']);
    }else{
        $data = $modelCourses->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
            // tạo dữ liệu save
            $data->title = $dataSend['title'];
            $data->image = $dataSend['image'];
            $data->description = $dataSend['description'];
            $data->youtube_code = $dataSend['youtube_code'];
            $data->id_category = $dataSend['id_category'];
            $data->status = $dataSend['status'];
            $data->content = $dataSend['content'];

            // tạo slug
            $slug = createSlugMantan($dataSend['title']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                    $conditions = array('slug'=>$slugNew);
                    $listData = $modelCourses->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                    if(!empty($listData)){
                        $number++;
                        $slugNew = $slug.'-'.$number;
                    }
                }while (!empty($listData));
            }

            $data->slug = $slugNew;

            $modelCourses->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên bài học</p>';
        }
    }

    $conditions = array('type' => '2top_crm_training');
    $listCategory = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listCategory', $listCategory);
}

function deleteCourseCRM($input){
    global $controller;

    $modelCourses = $controller->loadModel('Courses');
    
    if(!empty($_GET['id'])){
        $data = $modelCourses->get($_GET['id']);
        
        if($data){
            $modelCourses->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/2top_crm_training-view-admin-course-listCourseCRM');
}
?>