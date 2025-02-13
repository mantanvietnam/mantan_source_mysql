<?php 
function listfastingadmin($input){
    
        global $controller;
        global $urlCurrent;
        global $metaTitleMantan;
        global $modelCategories;
    
        $metaTitleMantan = 'Danh sách kiểu giảm cân';
    
        $modelfasting = $controller->loadModel('fasting');
    
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
        
        $listData = $modelfasting->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
     
        // phân trang
        $totalData = $modelfasting->find()->where($conditions)->all()->toList();
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
function addtypefasting($input){
    global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thông tin ke hoach giam can';
	$modelfasting = $controller->loadModel('fasting');
	$mess= '';
    $conditions = array('type' => 'category_losingweight');
    $listlosingweight = $modelCategories->find()->where($conditions)->all()->toList();
	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelfasting->get( (int) $_GET['id']);
    }else{
        $data = $modelfasting->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
            
            $data->title = $dataSend['title'];
            $data->titleen = $dataSend['titleen'];
            $data->description= $dataSend['description'];
            $data->descriptionen = $dataSend['descriptionen'];
            $data->author = $dataSend['author'];
            $data->authoren = $dataSend['authoren'];
            $data->imageauthor = $dataSend['imageauthor'];
            $data->textsource1 = $dataSend['textsource1'];
            $data->textsource2 = $dataSend['textsource2'];
            $data->linksource1 = $dataSend['linksource1'];
            $data->linksource2 = $dataSend['linksource2'];
            $data->image = $dataSend['image'];
           
           
            // tạo slug
            $slug = createSlugMantan($dataSend['title']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modelfasting->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;

            $modelfasting->save($data);   

          

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
	    }
    }
    setVariable('listlosingweight', $listlosingweight);
    setVariable('data', $data);
    setVariable('mess', $mess);
}
function deletefasting($input){
    global $controller;

    $modelfasting = $controller->loadModel('fasting');
    
    if(!empty($_GET['id'])){
        $data = $modelfasting->get($_GET['id']);
        
        if($data){
            $modelfasting->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/colennao-view-admin-fasting-listfastingadmin');
}
?>