<?php 
function listtablepost($input){
    
        global $controller;
        global $urlCurrent;
        global $metaTitleMantan;
        global $modelCategories;
    
        $metaTitleMantan = 'Danh sách';
    
        $modeltablepost = $controller->loadModel('tablepost');
        $modelcategorypost = $controller->loadModel('categorypost');
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
        
        $listData = $modeltablepost->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
     
        // phân trang
        $totalData = $modeltablepost->find()->where($conditions)->all()->toList();
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
function addtablepost($input){
    global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thông tin tin tức';
	$modeltablepost = $controller->loadModel('tablepost');
    $modelcategorypost = $controller->loadModel('categorypost');
    
	$mess= '';
    $datacategorypost = $modelcategorypost->find()->all();
	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modeltablepost->get( (int) $_GET['id']);
    }else{
        $data = $modeltablepost->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
            
            $data->title = $dataSend['title'];
            $data->author= $dataSend['author'];
            $data->time = (new DateTime($dataSend['time']))->getTimestamp();
            $data->image = $dataSend['image'];
            $data->description = $dataSend['description'];
            $data->content = $dataSend['content'];
            $data->id_categorypost = $dataSend['id_categorypost'];
            $data->titleen = $dataSend['titleen'];
            $data->authoren= $dataSend['authoren'];
            $data->descriptionen = $dataSend['descriptionen'];
            $data->contentenen = $dataSend['contentenen'];


            $modeltablepost->save($data);   

          

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
	    }
    }
    setVariable('datacategorypost', $datacategorypost);
    setVariable('data', $data);
    setVariable('mess', $mess);
}
function deletepost($input){
    global $controller;

    $modeltablepost = $controller->loadModel('tablepost');
    
    if(!empty($_GET['id'])){
        $data = $modeltablepost->get($_GET['id']);
        
        if($data){
            $modeltablepost->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/colennao-view-admin-post-listtablepost');
}
function listcategorypost($input){
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách';

    $modelcategorypost = $controller->loadModel('categorypost');

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
    
    $listData = $modelcategorypost->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modelcategorypost->find()->where($conditions)->all()->toList();
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
function addcategorypost($input){
global $controller;
global $isRequestPost;
global $modelCategories;
global $metaTitleMantan;
$metaTitleMantan = 'Thông tin tin tức';
$modelcategorypost = $controller->loadModel('categorypost');
$mess= '';
// lấy data edit
if(!empty($_GET['id'])){
    $data = $modelcategorypost->get( (int) $_GET['id']);
}else{
    $data = $modelcategorypost->newEmptyEntity();
}

if ($isRequestPost) {
    $dataSend = $input['request']->getData();

    if(!empty($dataSend['name'])){
        
        $data->name = $dataSend['name'];
        $data->image = $dataSend['image'];
        $data->description = $dataSend['description'];
        $data->nameen = $dataSend['nameen'];
        $data->descriptionen = $dataSend['descriptionen'];
        $modelcategorypost->save($data);   
        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }else{
        $mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
    }
}
setVariable('data', $data);
setVariable('mess', $mess);
}
function deletecategorypost($input){
global $controller;

$modelcategorypost = $controller->loadModel('categorypost');

if(!empty($_GET['id'])){
    $data = $modelcategorypost->get($_GET['id']);
    
    if($data){
        $modelcategorypost->delete($data);
    }
}

return $controller->redirect('/plugins/admin/colennao-view-admin-post-listcategorypost');
}
?>