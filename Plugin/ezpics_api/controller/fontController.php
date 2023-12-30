<?php 
function listFontAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách font chữ';

    $modelFont = $controller->loadModel('Font');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelFont->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelFont->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelFont->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function addFontAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin font chữ';


    $modelFont = $controller->loadModel('Font');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelFont->get( (int) $_GET['id']);

    }else{
        $data = $modelFont->newEmptyEntity();
        $data->created_at = date('Y-m-d H:i:s');
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();


        if(!empty($dataSend['name'])){
            $conditionsCheck = ['name'=>$dataSend['name']];

            if(!empty($_GET['id'])){
                $conditionsCheck['id !='] = (int) $_GET['id'];
            }

            $checkName = $modelFont->find()->where($conditionsCheck)->first();

            if(empty($checkName)){
                // tạo dữ liệu save
                $data->name = @$dataSend['name'];
                $data->font = @$dataSend['font'];
                $data->font_woff2 = @$dataSend['font_woff2'];
                $data->font_ttf = @$dataSend['font_ttf'];
                $data->font_otf = @$dataSend['font_otf'];
                
                $data->style = @$dataSend['style'];
                $data->weight = @$dataSend['weight'];
                $data->updated_at = date('Y-m-d H:i:s');

                if(empty($_GET['id'])){
                    $data->created_at = date('Y-m-d H:i:s');
                }

                $modelFont->save($data);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

                 if(!empty($_GET['id'])){
                    return $controller->redirect('/plugins/admin/ezpics_api-view-admin-font-listFontAdmin?status=2');
                }else{
                  
                    return $controller->redirect('/plugins/admin/ezpics_api-view-admin-font-listFontAdmin?status=1');
                }
            }else{
                $mess= '<p class="text-danger">Tên font đã tồn tại</p>';
            }
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteFontAdmin($input){
    global $controller;
    $modelFont = $controller->loadModel('Font');
    if(!empty($_GET['id'])){
        $data = $modelFont->get($_GET['id']);
        
        if($data){
            $modelFont->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/ezpics_api-view-admin-font-listFontAdmin?status=3');
}
 ?>