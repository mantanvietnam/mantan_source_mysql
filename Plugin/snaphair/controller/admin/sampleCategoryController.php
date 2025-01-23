<?php 

function listSampleCategoryAdmin($input) {
    global $modelCategory;
    global $metaTitleMantan;
    global $controller;
    global $session;
    global $isRequestPost;

    $metaTitleMantan = 'Quản lý danh mục';
    $mess = '';

    $modelCategory = $controller->loadModel('SampleCategory');
    // Không cần kiểm tra quyền ở đây
    // $user = checklogin('listSampleCategory');

    // Xử lý thêm hoặc sửa danh mục
    if ($isRequestPost) {
        // $checkuser = checklogin('editSampleCategory'); 
        // if (!empty($checkuser->grant_permission)) {
        $dataSend = $input['request']->getData(); // Lấy dữ liệu từ request

        if (!empty($dataSend['idCategoryEdit'])) {
            $infoCategory = $modelCategory->get((int)$dataSend['idCategoryEdit']);
        } else {
            $infoCategory = $modelCategory->newEmptyEntity();
        }

        $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);

        $modelCategory->save($infoCategory);

        // Ghi chú và lịch sử bị tắt
        // if (!empty($dataSend['idCategoryEdit'])) {
        //     $note = $user->name . ' sửa danh mục ' . $infoCategory->name . ' (ID: ' . $infoCategory->id . ')';
        // } else {
        //     $note = $user->name . ' thêm mới danh mục ' . $infoCategory->name . ' (ID: ' . $infoCategory->id . ')';
        // }

        // addActivityHistory($user, $note, 'listCategory', $infoCategory->id);
        $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        // } else {
        //     $mess = '<p class="text-danger">Bạn không có quyền thêm hoặc sửa</p>';
        // }
    }

    // Lấy danh sách danh mục
    $listData = $modelCategory->find()->all()->toList();

    setVariable('listData', $listData);
    setVariable('mess', $mess);
    // Không cần kiểm tra đăng nhập ở đây
    // } else {
    //     return $controller->redirect('/login');
    // }
}

function deleteCategory($input) {  
    global $isRequestPost;
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = 'Xóa danh mục';
    
    // Không cần kiểm tra quyền ở đây
    // $user = checklogin('deleteSampleCategory');   
    // if (!empty($user)) {
    //     if (empty($user->grant_permission)) {
    //         return $controller->redirect('/');
    //     }

    $modelCategory = $controller->loadModel('SampleCategory');

    if (!empty($_GET['id'])) {
        $conditions = array('id' => $_GET['id']);
        
        $category = $modelCategory->find()->where($conditions)->first();

        if (!empty($category)) {
            // Ghi chú và lịch sử bị tắt
            // $note = $user->name . ' xóa danh mục ' . $category->name . ' (ID: ' . $category->id . ')';
            // addActivityHistory($user, $note, 'deleteCategory', $category->id);

            $modelCategory->delete($category);

            return $controller->redirect('/plugins/admin/snaphair-view-admin-sample-listSampleCategoryAdmin?error=requestDeleteSuccess');
        }
    }
    // } else {
    //     return $controller->redirect('/');
    // }
}

?>
