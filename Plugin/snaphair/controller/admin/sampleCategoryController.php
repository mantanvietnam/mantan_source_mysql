<?php 

function listSampleCategoryAdmin($input) {
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    global $session;
    global $isRequestPost;

    $metaTitleMantan = 'Quản lý danh mục';
    $mess = '';

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

            if (!empty($dataSend['idCategoryEdit'])) {
                $infoCategory = $modelCategories->get((int)$dataSend['idCategoryEdit']);
            } else {
                $infoCategory = $modelCategories->newEmptyEntity();
            }

            $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $infoCategory->parent = 0;
            $infoCategory->image = NULL;
            $infoCategory->status = NULL;
            $infoCategory->keyword = NULL;
            $infoCategory->description =  NULL;
            $infoCategory->type = 'sample_category';
            
            // tạo slug
            $slug = createSlugMantan($infoCategory->name);
            $slugNew = $slug;
            $number = 0;
            do{
                $conditions = array('slug'=>$slugNew,'type'=>'sample_category');
                $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                if(!empty($listData)){
                    $number++;
                    $slugNew = $slug.'-'.$number;
                }
            }while (!empty($listData));

            $infoCategory->slug = $slugNew;
            $modelCategories->save($infoCategory);
            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

        $conditions = ['type' => 'sample_category'];
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
        setVariable('mess', $mess);
}

function deleteCategory($input) {  
    global $isRequestPost;
    global $metaTitleMantan;
    global $controller;
    global $modelCategories;

    $metaTitleMantan = 'Xóa danh mục';
    
    // Không cần kiểm tra quyền ở đây
    // $user = checklogin('deleteSampleCategory');   
    // if (!empty($user)) {
    //     if (empty($user->grant_permission)) {
    //         return $controller->redirect('/');
    //     }


    if (!empty($_GET['id'])) {
        $conditions = array('id' => $_GET['id']);
        
        $category = $modelCategories->find()->where($conditions)->first();

        if (!empty($category)) {
            // Ghi chú và lịch sử bị tắt
            // $note = $user->name . ' xóa danh mục ' . $category->name . ' (ID: ' . $category->id . ')';
            // addActivityHistory($user, $note, 'deleteCategory', $category->id);

            $modelCategories->delete($category);

            return $controller->redirect('/plugins/admin/snaphair-view-admin-sample-listSampleCategoryAdmin?error=requestDeleteSuccess');
        }
    }
    // } else {
    //     return $controller->redirect('/');
    // }
}

?>
