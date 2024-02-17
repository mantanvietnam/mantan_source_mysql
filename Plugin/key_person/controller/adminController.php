<?php 
function categoryPersonAdmin($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách khu vực';

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
        $infoCategory->type = 'category_person';

        // tạo slug
        $slug = createSlugMantan($infoCategory->name);
        $slugNew = $slug;
        $number = 0;
        do{
            $conditions = array('slug'=>$slugNew,'type'=>'category_person');
            $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

            if(!empty($listData)){
                $number++;
                $slugNew = $slug.'-'.$number;
            }
        }while (!empty($listData));

        $infoCategory->slug = $slugNew;

        $modelCategories->save($infoCategory);

    }

    $conditions = array('type' => 'category_person');
    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('listData', $listData);
}

function listPersonAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Đại lý';

    $modelPerson = $controller->loadModel('Persons');

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('Persons.id'=>'desc');

    

    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }

   
    if(!empty($_GET['id_category'])){
        $conditions['cp.id_category'] = (int)$_GET['id_category'];
    }
      
        $listData = $modelPerson->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        $totalData = $modelPerson->find()->where($conditions)->all()->toList();
    
    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            if(!empty($value->id_category)){
                $listData[$key]->name_category = $modelCategories->find()->where(array('id'=>$value->id_category))->first()->name;
            } 
            
        }
    }
    // phân trang
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

    $conditions = array('type' => 'category_person');
    $categories = $modelCategories->find()->where($conditions)->all()->toList();

    $conditions = array('type' => 'manufacturer_Person');
    $manufacturers = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
    setVariable('categories', $categories);
    setVariable('manufacturers', $manufacturers);
}

function addPersonAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin Đại lý';

    $modelPerson = $controller->loadModel('Persons');

    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelPerson->get( (int) $_GET['id']);  
    }else{
        $data = $modelPerson->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
          
            // $data->id_category = (int) @$dataSend['id_category'];
            $data->name = @$dataSend['name'];
            $data->address = @$dataSend['address'];
            $data->phone = @$dataSend['phone'];
            $data->email = @$dataSend['email'];
            $data->image = @$dataSend['image'];
            $data->note = @$dataSend['note'];
            $data->facebook = @$dataSend['facebook'];
            $data->zalo = @$dataSend['zalo'];
            $data->id_category = (int) @$dataSend['id_category'];

            $modelPerson->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên đại lý</p>';
        }
    }

            
   

    $conditions = array('type' => 'category_person');
    $listCategory = $modelCategories->find()->where($conditions)->all()->toList();

    
    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listCategory', $listCategory);
}

function deletePerson($input){
    global $controller;

    $modelPerson = $controller->loadModel('Persons');
    
    if(!empty($_GET['id'])){
        $data = $modelPerson->get($_GET['id']);
        
        if($data){
            $modelPerson->delete($data);

            // deleteSlugURL($data->slug);
        }
    }

    return $controller->redirect('/plugins/admin/key_person-view-admin-person-listPersonAdmin');
}

?>