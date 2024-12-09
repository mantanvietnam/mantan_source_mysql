<?php

function listPublisher($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('listPublisher');
    $modelCategories = $controller->loadModel('Category');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }

        $metaTitleMantan = 'Danh sách nhà xuất bản';
        
        $order = array('id' => 'desc');
        $conditions = array('type' => 'category_publisher');
        $limit = 20;
        $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
        if($page < 1) $page = 1;

        // Lọc theo ID
        if(!empty($_GET['id'])){
            $conditions['id'] = (int)$_GET['id'];
        }

        // Lọc theo tên
        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
        }

        // Lọc theo trạng thái
        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        // Xử lý xuất Excel
        if(!empty($_GET['action']) && $_GET['action'] == 'Excel'){
            $listData = $modelCategories->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel = [
                ['name' => 'ID', 'type' => 'text', 'width' => 10],
                ['name' => 'Tên nhà xuất bản', 'type' => 'text', 'width' => 25],
                ['name' => 'Mô tả', 'type' => 'text', 'width' => 35],
                ['name' => 'Trạng thái', 'type' => 'text', 'width' => 15]
            ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $status = ($value->status == 'active') ? 'Kích hoạt' : 'Khóa';
                    $dataExcel[] = [
                        $value->id,
                        $value->name,
                        $value->description,
                        $status
                    ];
                }
            }

            export_excel($titleExcel, $dataExcel, 'danh_sach_nha_xuat_ban');
        } else {
            // Lấy dữ liệu với phân trang
            $listData = $modelCategories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        }

        // Tính tổng dữ liệu và phân trang
        $totalData = $modelCategories->find()->where($conditions)->count();
        $totalPage = ceil($totalData / $limit);
        $back = max(1, $page - 1);
        $next = min($totalPage, $page + 1);

        // Xây dựng URL phân trang
        $urlPage = $urlCurrent;
        if (isset($_GET['page'])) {
            $urlPage = str_replace('&page=' . $_GET['page'], '', $urlPage);
            $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
        }
        $urlPage .= (strpos($urlPage, '?') !== false ? '&' : '?') . 'page=';

        // Thông báo
        $mess = '';
        if (@$_GET['mess'] == 'saveSuccess') {
            $mess = '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        } elseif (@$_GET['mess'] == 'deleteSuccess') {
            $mess = '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        } elseif (@$_GET['mess'] == 'deleteError') {
            $mess = '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        // Gán biến hiển thị
        setVariable('mess', $mess);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        setVariable('listData', $listData);
    } else {
        return $controller->redirect('/login');
    }
}

function addPublisher($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    $metaTitleMantan = 'Thêm nhà xuất bản';
    $modelCategories = $controller->loadModel('Category'); 

    $user = checklogin('addPublisher');
    if (!empty($user)) {
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }

        if (!empty($_GET['id'])) {
            $data = $modelCategories->find()->where(['id' => (int)$_GET['id']])->first();

            if (empty($data)) {
                return $controller->redirect('/listPublisher');
            }
        } else {
            $data = $modelCategories->newEmptyEntity();
            $data->created_at = time();
        }
        $mess = '';
        // Xử lý khi có request POST
        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if (!empty($dataSend['name'])) {
                $data->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                $data->parent = 0;
                $data->image = NULL;
                $data->status = $dataSend['status'];
                $data->keyword = NULL;
                $data->description =  str_replace(array('"', "'"), '’', $dataSend['description']);
                $data->type = 'category_publisher';

                $slug = createSlugMantan($data->name);
                $slugNew = $slug;
                $number = 0;
                do{
                    $conditions = array('slug'=>$slugNew,'type'=>'category_publisher');
                    $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                    if(!empty($listData)){
                        $number++;
                        $slugNew = $slug.'-'.$number;
                    }
                }while (!empty($listData));

                $data->slug = $slugNew;

                if ($modelCategories->save($data)) {
                    return $controller->redirect('/listPublisher?mess=saveSuccess');
                } else {
                    $mess = '<p class="text-danger">Lưu dữ liệu không thành công</p>';
                }
            } else {
                $mess = '<p class="text-danger">Tên nhà xuất bản là bắt buộc</p>';
            }
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
    } else {
        return $controller->redirect('/login');
    }
}

function deletePublisher($input){  
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Xóa nhà xuất bản';
    
    $user = checklogin('deletePublisher');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }

       $modelCategory = $controller->loadModel('Category');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id']);
            
            $category = $modelCategory->find()->where($conditions)->first();

            $checkProducts = $modelCategory->find()->where(array('parent'=>$category->id))->all()->toList();

            if(!empty($checkProducts)){
                return $controller->redirect('/listPublisher?error=requestDeleteHasProducts');
            }

            if(!empty($category)){
                $note =  $user->name.' xóa thông tin nhà xuất bản '.$category->name.' có id là:'.$category->id;
                addActivityHistory($user, $note, 'deletePublisher', $category->id);

                $modelCategories->delete($category);

                return $controller->redirect('/listPublisher?error=requestDeleteSuccess');
            }
        }
    }else{
        return $controller->redirect('/');
    }
}
