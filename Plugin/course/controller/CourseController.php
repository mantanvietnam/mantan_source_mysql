<?php 
function listcourse($input)
{
	
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách khóa học';

	$modelcourses = $controller->loadModel('course');

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
    
    $listData = $modelcourses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modelcourses->find()->where($conditions)->all()->toList();
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
function addcourse($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thông tin Dự án';
	$modelcourse = $controller->loadModel('course');
	$mess= '';
	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelcourse->get( (int) $_GET['id']);
    }else{
        $data = $modelcourse->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            $data->address = $dataSend['address'];
            $data->name = $dataSend['name'];
            $data->generalim = $dataSend['generalim'];
            $data->description= $dataSend['description'];
            $data->time_create= $dataSend['time_create'];
            $data->image = $dataSend['image'];
            $data->content = $dataSend['content'];
            $data->title1 = $dataSend['title1'];
            $data->title2 = $dataSend['title2'];
            $data->title3 = $dataSend['title3'];
            $data->contenttiele1 = $dataSend['contenttiele1'];
            $data->contenttiele2 = $dataSend['contenttiele2'];
            $data->contenttiele3 = $dataSend['contenttiele3'];
            // tạo slug
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modelcourse->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;

            $modelcourse->save($data);   

          

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);

    

}
function deletecourse($input){
    global $controller;

    $modelcourse = $controller->loadModel('course');
    
    if(!empty($_GET['id'])){
        $data = $modelcourse->get($_GET['id']);
        
        if($data){
            $modelcourse->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/course-view-admin-listcourse');
}

?>