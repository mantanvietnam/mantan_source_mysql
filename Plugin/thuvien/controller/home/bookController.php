<?php 

function listbook($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;
    $listcategorypublishers = $modelCategories->find()->where(['type' => 'category_publisher'])->all()->toList();
    $listcategorybooks = $modelCategories->find()->where(['type' => 'category_book'])->all()->toList();

     $user = checklogin('listbook');   
    if(!empty($user)){
       
        $metaTitleMantan = 'Danh sách books';

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
        if(!empty($_GET['id_category'])){
            $conditions['id_category'] = (int) $_GET['id_category'];
        }
        if(!empty($_GET['status'])){
            $conditions['status'] =  $_GET['status'];
        }
        if(!empty($_GET['book_code'])){
            $conditions['book_code'] =  $_GET['book_code'];
        }
        if(!empty($_GET['author'])){
            $conditions['author'] =  $_GET['author'];
        }
        if(!empty($_GET['publishing_id'])){
            $conditions['publishing_id'] = (int) $_GET['publishing_id'];
        }
        if (!empty($_GET['published_date'])) {
            $publishedDate = $_GET['published_date'];
            $dateParts = explode('/', $publishedDate);
            if (count($dateParts) === 3) {
                $formattedDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
                $publishedDateTimestamp = strtotime($formattedDate);
                if ($publishedDateTimestamp) {
                    $conditions['published_date'] = $publishedDateTimestamp;
                } else {
                    echo "Ngày tháng không hợp lệ.";
                }
            } else {
                echo "Định dạng ngày tháng không đúng (dd/mm/yyyy).";
            }
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
        setVariable('listcategorybooks', $listcategorybooks);
        setVariable('listcategorypublishers', $listcategorypublishers);
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
function addbook($input) {
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thêm sách';
    $modelbooks = $controller->loadModel('books');
    $listcategory = $modelCategories->find()->where(['type' => 'category_book'])->all()->toList();
    $listcategorypublishers = $modelCategories->find()->where(['type' => 'category_publisher'])->all()->toList();
    $mess = '';

    // Lấy data edit
    if (!empty($_GET['id'])) {
        $data = $modelbooks->get((int) $_GET['id']);
    } else {
        $data = $modelbooks->newEmptyEntity();
    }

    $user = checklogin('addbook');  

    if (!empty($user)) {
        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            $idCondition = isset($data->id) ? ['id !=' => $data->id] : [];

            $existingPublisher = $modelbooks->find()
                ->where(['book_code' => $dataSend['book_code']] + $idCondition)
                ->first();

            if (!empty($existingPublisher)) {
                $mess = '<p class="text-danger">Mã xuất bản đã tồn tại. Vui lòng nhập mã khác.</p>';
            } else {
                $data->name = $dataSend['name'];
                $data->author = $dataSend['author'];
                $data->published_date = (new DateTime($dataSend['published_date']))->getTimestamp();
                $data->image = $dataSend['image'];
                // $data->typebook = $dataSend['typebook'];
                $data->description = $dataSend['description'];
                $data->price = $dataSend['price'];
                $data->book_code = $dataSend['book_code'];
                $data->id_category = $dataSend['id_category'];
                $data->publishing_id = $dataSend['publishing_id'];
                $data->quantity = $dataSend['quantity'];
                $data->file_pdf = $dataSend['file_pdf'];

                $slug = createSlugMantan($dataSend['name']);
                $slugNew = $slug;
                $number = 0;

                if (empty($data->slug) || $data->slug != $slugNew) {
                    do {
                        $conditions = ['slug' => $slugNew];
                        $listData = $modelbooks->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                        if (!empty($listData)) {
                            $number++;
                            $slugNew = $slug . '-' . $number;
                        }
                    } while (!empty($listData));
                }
                $data->slug = $slugNew;

                $modelbooks->save($data);

                if (!empty($_GET['id'])) {
                    $note = $user->name . ' sửa ' . $data->name . '(' . $data->book_code . ') có id là:' . $data->id;
                } else {
                    $note = $user->name . ' Thêm sách ' . $data->name . '(' . $data->book_code . ') có id là:' . $data->id;
                }
                addActivityHistory($user, $note, 'addBuilding', $data->id);

                $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
            }
        }   
    } else {
        return $controller->redirect('/login');
    }

    setVariable('listcategorypublishers', $listcategorypublishers);
    setVariable('listcategory', $listcategory);
    setVariable('data', $data);
    setVariable('mess', $mess);
}



function deletebook($input){
	global $controller;
	$modelbooks = $controller->loadModel('books');
    $user = checklogin('deletebook');  
	if(!empty($user)){
        if(!empty($_GET['id'])){
            $data = $modelbooks->find()->where(['id'=>(int) $_GET['id']])->first();
            if($data){
                 $modelbooks->delete($data);
            }
        }
    }
	return $controller->redirect('/listbook');

}
function categorybook($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    $metaTitleMantan = 'Danh sách danh mục sách';

    $user = checklogin('categorybook');  
    if(!empty($user)){
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
    }else{
        return $controller->redirect('/login');
    }

    $conditions = array('type' => 'category_book');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('listData', $listData);
}

function deleteCategorybook($input){
    global $controller;
    global $session;

    global $modelCategories;
    $user = checklogin('categorybook');   
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
function changequanlitybook($input) {
    global $isRequestPost;
    global $metaTitleMantan;
    global $controller;
 
    $metaTitleMantan = 'Nhập và Hủy sách';
    $mess= '';
    $user = checklogin('changequanlitybook');
    if (!empty($user)) {
        $modelbooks = $controller->loadModel('books');
        $modelhistorybook = $controller->loadModel('historybook');
        $listbook = $modelbooks->find()->all()->toList();
        if ($isRequestPost) {
            $data = $input['request']->getData();
            $action = isset($data['action']) ? $data['action'] : '';
            $idBook = isset($data['id_book']) ? (int)$data['id_book'] : 0;
            $quantity = isset($data['quantity']) ? (int)$data['quantity'] : 0;
            $day = isset($data['day']) ? strtotime($data['day']) : time();
            $type = '';
            if ($idBook > 0 && $quantity > 0) {
                $book = $modelbooks->get($idBook);
           
                if ($action === 'add') {
                    $book->quantity += $quantity; 
                    $modelbooks->save($book);
                    $historyBook = $modelhistorybook->newEmptyEntity();
                    $historyBook->id_book = $idBook;
                    $historyBook->number = $quantity;
                    $historyBook->type = 'plus'; 
                    $historyBook->day = $day;
                    $modelhistorybook->save($historyBook);
                    $mess = '<p class="text-success">Thêm sách thành công</p>';
                
                }
                elseif ($action === 'remove') {
                    if ($book->quantity >= $quantity) {
                        $book->quantity -= $quantity; 
                        $modelbooks->save($book);
                        $historyBook = $modelhistorybook->newEmptyEntity();
                        $historyBook->id_book = $idBook;
                        $historyBook->number = $quantity;
                        $historyBook->type = 'minus'; 
                        $historyBook->day = $day;
                        $modelhistorybook->save($historyBook);

                        $mess = '<p class="text-danger">giảm lượng sách nhập thành công</p>';
                       
                    } else {
                       $mess = '<p class="text-danger">Số lượng sách hiện tại nhập về hiện tại đã là 0</p>';
                      
                    }
                } else {
                    $mess = '<p class="text-danger">Hành động không hợp lệ</p>';
                   
                }
            } else {
                $mess = '<p class="text-danger">Hành động không hợp lệ</p>';
               
            }
            return $controller->redirect('/changequanlitybook');
        }
        
        setVariable('listbook', $listbook);
        setVariable('mess', $mess);
    } else {
        setVariable('mess', $mess);
        return $controller->redirect('/login');
    }
}



function historybook($Input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    global $urlCurrent;
    $metaTitleMantan = 'Lịch sử nhập và hủy sách';
    $user = checklogin('historybook'); 
    if(!empty($user)){
       $modelhistorybook = $controller->loadModel('historybook');
       $modelbooks = $controller->loadModel('books');
       $order = array('id'=>'desc');

        $conditions = array();
        $limit = 10;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        
        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }
        $listhistorybook = $modelhistorybook->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
       $totalData = $modelhistorybook->find()->where($conditions)->all()->toList();
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
       setVariable('listhistorybook', $listhistorybook);
    }else{
        return $controller->redirect('/login');
    }
}
function deletehistorybook($input){
	global $controller;
	$modelhistorybook = $controller->loadModel('historybook');
    $user = checklogin('historybook');  
	if(!empty($user)){
        if(!empty($_GET['id'])){
            $data = $modelhistorybook->find()->where(['id'=>(int) $_GET['id']])->first();
            if($data){
                 $modelhistorybook->delete($data);
            }
        }
    }
	return $controller->redirect('/historybook');

}
function addDatabook(){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlHomes;

    $metaTitleMantan = 'Thêm sách bằng Excel';
    $modelbooks = $controller->loadModel('books');
    
    $mess = '';

    // Lấy data edit
    if (!empty($_GET['id'])) {
        $data = $modelbooks->get((int) $_GET['id']);
    } else {
        $data = $modelbooks->newEmptyEntity();
    }

    $user = checklogin('addDatabook');  

    if (!empty($user)) {
        if($isRequestPost){
            $dataSeries = uploadAndReadExcelData('databook');

            if($dataSeries){
                unset($dataSeries[0]);

                $double = [];

                foreach ($dataSeries as $key => $value) {
                    if(!empty($value[0]) && !empty($value[1])){
                        $value[1] = trim(str_replace(array(' ','.','-'), '', $value[1]));
                        $value[1] = str_replace('+84','0',$value[1]);

                        $conditions = ['book_code'=>$value[0]];
                        $checkPhone = $modelbooks->find()->where($conditions)->first();

                        if(empty($checkPhone)){
                            $data = $modelbooks->newEmptyEntity();
                            
                            $data->name = @$value[1];
                            $data->author = @$value[4];
                            $data->price = @$value[6];
                            $data->book_code = @$value[0];
                            $data->id_category = @$value[2];
                            $data->publishing_id =@$value[3];
                            $data->file_pdf = @$value[5];

                            $slug = createSlugMantan(@$value[1]);
                            $slugNew = $slug;
                            $number = 0;

                            if (empty($data->slug) || $data->slug != $slugNew) {
                                do {
                                    $conditions = ['slug' => $slugNew];
                                    $listData = $modelbooks->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                                    if (!empty($listData)) {
                                        $number++;
                                        $slugNew = $slug . '-' . $number;
                                    }
                                } while (!empty($listData));
                            }
                            $data->slug = $slugNew;

                            $modelbooks->save($data);
                        }else{
                            $double[] = $value[1];
                        }

                    }else{
                        $mess= '<p class="text-danger">Bạn không được để trống tên và mã</p>';
                    }
                }

                if(!empty($double)){
                    $mess= '<p class="text-danger">Các khách hàng sau đã có tài khoản từ trước: '.implode(', ', $double).'</p>';
                }

                $mess .= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }
        }

        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}
function documenteditor($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    $metaTitleMantan = 'Danh sách danh mục sách';

    $user = checklogin('categorybook');  
    if(!empty($user)){
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
            $infoCategory->type = 'category_documenteditor';
    
            // tạo slug
            $slug = createSlugMantan($infoCategory->name);
            $slugNew = $slug;
            $number = 0;
            do{
                $conditions = array('slug'=>$slugNew,'type'=>'category_documenteditor');
                $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();
    
                if(!empty($listData)){
                    $number++;
                    $slugNew = $slug.'-'.$number;
                }
            }while (!empty($listData));
    
            $infoCategory->slug = $slugNew;
    
            $modelCategories->save($infoCategory);
    
        }
    }else{
        return $controller->redirect('/login');
    }

    $conditions = array('type' => 'category_documenteditor');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('listData', $listData);
}

function deletedocumenteditor($input){
    global $controller;
    global $session;

    global $modelCategories;
    $user = checklogin('categorybook');   
    if(!empty($user)){
        if(empty($user->permission)){
            return $controller->redirect('/documenteditor?mess=noPermissiondelete');
        }


        if(!empty($_GET['id'])){
            $data = $modelCategories->get($_GET['id']);
            
            if($data){
                $modelCategories->delete($data);
                $note = $user->type.' '. $user->name.' xóa thông tin nhóm sản phẩm '.$data->name.' có id là:'.$data->id;
            
            addActivityHistory($user,$note,'deletedocumenteditor',$data->id);
                
            }
        }

     return $controller->redirect('/documenteditor');

    }else{
        return $controller->redirect('/login');
    }
}
?>