<?php 
function listfield($input)
{
	
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Lĩnh vực';

	$modelfields = $controller->loadModel('field');

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
    
    $listData = $modelfields->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modelfields->find()->where($conditions)->all()->toList();
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
function addfield($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thông tin Dự án';
	$modelfield = $controller->loadModel('field');
	$mess= '';
	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelfield->get( (int) $_GET['id']);
    }else{
        $data = $modelfield->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            $data->name = $dataSend['name'];
            $data->imagebanner = $dataSend['imagebanner'];
            $data->title1= $dataSend['title1'];
            $data->content1= $dataSend['content1'];
            $data->content2= $dataSend['content2'];
            $data->image1 = $dataSend['image1'];
            $data->image2 = $dataSend['image2'];
            $data->image3 = $dataSend['image3'];
            $data->image4 = $dataSend['image4'];
            $data->content3 = $dataSend['content3'];
            $data->content4 = $dataSend['content4'];
            // tạo slug
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modelfield->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;

            $modelfield->save($data);   

          

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);

    

}
function deletefield($input){
    global $controller;

    $modelfield = $controller->loadModel('field');
    
    if(!empty($_GET['id'])){
        $data = $modelfield->get($_GET['id']);
        
        if($data){
            $modelfield->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/field-view-admin-listfield');
}

?>