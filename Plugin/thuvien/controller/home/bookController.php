<?php 

function listbook($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

     $user = checklogin('listbook');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Danh sách nhân viên';

        $modelMember = $controller->loadModel('Members');
        $modelbooks = $controller->loadModel('books');
        
        $order = array('id'=>'desc');

        $conditions = array();
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        
        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }


        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }
        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelbooks->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel =   [
                ['name'=>'Tên sách', 'type'=>'text', 'width'=>25],
                ['name'=>'Tên tác giả', 'type'=>'text', 'width'=>25],
                ['name'=>'số lượng sách', 'type'=>'text', 'width'=>25],
                ['name'=>'giá sách', 'type'=>'text', 'width'=>25],
                ['name'=>'Mô tả', 'type'=>'text', 'width'=>25],
                
            ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $status= 'Khóa';
                    if($value->status=='active'){ 
                        $status= 'Kích hoạt';
                    }

                    $birthday = '';
                    if(!empty($value->birthday)){
                        $birthday = date('d/m/Y',$value->birthday);
                    }

                    $dataExcel[] = [
                        $value->name,   
                        $value->author,   
                        $value->address,   
                        $value->email,  
                        $status,
                        $birthday
                    ];
                }
            }
            export_excel($titleExcel,$dataExcel,'danh_sach_khach_hang');
        }else{
            $listData = $modelbooks->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        }

        // phân trang
        $totalData = $modelbooks->find()->where($conditions)->all()->toList();
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

        $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        setVariable('mess', $mess);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        
        setVariable('listData', $listData);
       // / setVariable('listGroup', $listGroup);
    }
}
function addbook($input){
    global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thêm sách';
	$modelbooks = $controller->loadModel('books');

    
	$mess= '';
	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelbooks->get( (int) $_GET['id']);
    }else{
        $data = $modelbooks->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            
            $data->name = $dataSend['name'];
            $data->author= $dataSend['author'];
            $data->published_date = (new DateTime($dataSend['published_date']))->getTimestamp();
            $data->image = $dataSend['image'];
            $data->description = $dataSend['description'];
            $data->price = $dataSend['price'];
            $data->publisher_id = $dataSend['publisher_id'];
            $data->quantity= $dataSend['quantity'];
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;
            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modelbooks->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;
            
            $modelbooks->save($data);   

          

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
	    }
    }
    setVariable('data', $data);
    setVariable('mess', $mess);
}


function deletebook($input){
	global $controller;
	$modelbooks = $controller->loadModel('books');
	if(!empty($_GET['id'])){
		$data = $modelbooks->find()->where(['id'=>(int) $_GET['id']])->first();
		if($data){
         	$modelbooks->delete($data);
        }
	}
	return $controller->redirect('/listbook');

}
function categorybook($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách danh mục sách';

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        
        // tính ID category
        if(!empty($dataSend['idCategoryEdit'])){
            $infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
        }else{
            $infoCategory = $modelCategories->newEmptyEntity();
        }

        // tạo dữ liệu save
        $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
        $infoCategory->parent = 0;
        $infoCategory->image = @$dataSend['image'];
        $infoCategory->status = @$dataSend['status'];
        $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
        $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
        $infoCategory->type = 'category_book';

        // tạo slug
        $slug = createSlugMantan($infoCategory->name);
        $slugNew = $slug;
        $number = 0;
        do{
            $conditions = array('slug'=>$slugNew,'type'=>'category_book');
            $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

            if(!empty($listData)){
                $number++;
                $slugNew = $slug.'-'.$number;
            }
        }while (!empty($listData));

        $infoCategory->slug = $slugNew;

        $modelCategories->save($infoCategory);

    }

    $conditions = array('type' => 'category_book');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('listData', $listData);
}

function deleteCategorybook($input){
    global $controller;
    global $session;

    global $modelCategories;
    $user = checklogin('listbook');   
    if(!empty($user)){
        if(empty($user->permission)){
            return $controller->redirect('/Categorybook?mess=noPermissiondelete');
        }


        if(!empty($_GET['id'])){
            $data = $modelCategories->get($_GET['id']);
            
            if($data){
                $modelCategories->delete($data);
                $note = $user->type.' '. $user->name.' xóa thông tin nhóm sản phẩm '.$data->name.' có id là:'.$data->id;
            
            addActivityHistory($user,$note,'deleteCategorybook',$data->id);
                
            }
        }

     return $controller->redirect('/categorybook');

    }else{
        return $controller->redirect('/login');
    }
}
function changequanlitybook($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Nhập và Hủy sách';



}
function historybook($Input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Lịch sử nhập và hủy sách';
}
?>