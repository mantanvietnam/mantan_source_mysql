<?php 

function listCategory($input) {
    global $modelCategory;
    global $metaTitleMantan;
    global $controller;
    global $session;
    global $isRequestPost;

    $metaTitleMantan = 'Quản lý chức vụ';
    $user = checklogin('listCategory');
    $mess = '';

    $modelCategory = $controller->loadModel('Category');
    if (!empty($user)) {
        if (empty($user->grant_permission)) {
            return $controller->redirect('/');
        }

        // Xử lý thêm hoặc sửa chức vụ
        if ($isRequestPost) {
            $checkuser = checklogin('editCategory'); 
            if(!empty($checkuser->grant_permission)){
            $dataSend = $input['request']->getData();

                if (!empty($dataSend['idCategoryEdit'])) {
                    $infoCategory = $modelCategory->get((int)$dataSend['idCategoryEdit']);
                } else {
                    $infoCategory = $modelCategory->newEmptyEntity();
                }

                $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                $infoCategory->parent = 0;
                $infoCategory->image = NULL;
                $infoCategory->status = $dataSend['status'];
                $infoCategory->keyword = NULL;
                $infoCategory->description =  str_replace(array('"', "'"), '’', $dataSend['description']);
                $infoCategory->type = 'category_position';
                
                // tạo slug
                $slug = createSlugMantan($infoCategory->name);
                $slugNew = $slug;
                $number = 0;
                do{
                    $conditions = array('slug'=>$slugNew,'type'=>'category_position');
                    $listData = $modelCategory->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                    if(!empty($listData)){
                        $number++;
                        $slugNew = $slug.'-'.$number;
                    }
                }while (!empty($listData));

                $infoCategory->slug = $slugNew;

                $modelCategory->save($infoCategory);

                if (!empty($dataSend['idCategoryEdit'])) {
                    $note = $user->name . ' sửa chức vụ ' . $infoCategory->name . ' (ID: ' . $infoCategory->id . ')';
                } else {
                    $note = $user->name . ' thêm mới chức vụ ' . $infoCategory->name . ' (ID: ' . $infoCategory->id . ')';
                }

                addActivityHistory($user, $note, 'listCategory', $infoCategory->id);
                $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
            } else {
                $mess = '<p class="text-danger">Bạn không có quyền thêm hoặc sửa</p>';
            }
        }

        // Lấy danh sách chức vụ
        $conditions = ['type' => 'category_position'];
        $listData = $modelCategory->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
        setVariable('mess', $mess);
    } else {
        return $controller->redirect('/login');
    }
}

function deleteCategory($input){  
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Xóa nhóm sản phẩm';
    
    $user = checklogin('deleteCategory');   
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
                return $controller->redirect('/listCategory?error=requestDeleteHasProducts');
            }

            if(!empty($category)){
                $note =  $user->name.' xóa thông tin chức vụ '.$category->name.' có id là:'.$category->id;
                addActivityHistory($user, $note, 'deleteCategory', $category->id);

                $modelCategories->delete($category);

                return $controller->redirect('/listCategory?error=requestDeleteSuccess');
            }
        }
    }else{
        return $controller->redirect('/');
    }
}



?>