<?php
function templateZaloZNS($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

     $user = checklogin('templateZaloZNS');   
    if(!empty($user)){
        if(empty($user->grant_permission) && !empty($user->id_father)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Danh sách mẫu tin ZNS';

        $modelZaloTemplates = $controller->loadModel('ZaloTemplates');

        $conditions = array('id_system'=>$session->read('infoUser')->id_system);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id_zns'])){
            $conditions['id_zns'] = (int) $_GET['id_zns'];
        }

        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }

        $listData = $modelZaloTemplates->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        // phân trang
        $totalData = $modelZaloTemplates->find()->where($conditions)->all()->toList();
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
        
        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}

function addTemplateZaloZNS($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $urlHomes;

    $user = checklogin('addTemplateZaloZNS');   
    if(!empty($user)){
        if(empty($user->grant_permission) && !empty($user->id_father)){
            return $controller->redirect('/templateZaloZNS');
        }
        $metaTitleMantan = 'Cài đặt mẫu tin nhắn ZNS';

        $modelZaloTemplates = $controller->loadModel('ZaloTemplates');

        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelZaloTemplates->find()->where(['id'=>(int) $_GET['id'], 'id_system'=>$user->id_system])->first();
        }else{
            $data = $modelZaloTemplates->newEmptyEntity();

            $data->content = '[]';
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name']) && !empty($dataSend['id_zns'])){
                // tạo dữ liệu save
                $data->name = $dataSend['name'];
                $data->id_system = $session->read('infoUser')->id_system;
                $data->id_zns = (int) $dataSend['id_zns'];
                $data->content_example = $dataSend['content_example'];

                $content = [];
                for($i=1;$i<=10;$i++){
                    if(!empty($dataSend['variable'][$i])){
                        $content[$i]['variable'] = $dataSend['variable'][$i];
                        $content[$i]['value'] = @$dataSend['value'][$i];
                    }
                }

                $data->content = json_encode($content);
                
                $modelZaloTemplates->save($data);

                if(!empty($_GET['id'])){
                        $note = $user->type_tv.' '. $user->name.' sửa thông tin mẫu tin nhắn ZNS'.$data->name.' có id là:'.$data->id;
                    }else{
                        $note = $user->type_tv.' '. $user->name.' thêm thông tin mẫu tin nhắn ZNS '.$data->name.' có id là:'.$data->id;
                    }

                 addActivityHistory($user,$note,'addTemplateZaloZNS',$data->id);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }else{
                $mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
            }
        }

        $data->content = json_decode($data->content, true);

        setVariable('data', $data);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteTemplateZaloZNS($input){
    global $controller;
    global $session;

    $modelZaloTemplates = $controller->loadModel('ZaloTemplates');
    $user = checklogin('addTemplateZaloZNS');   
    if(!empty($user)){
        if(empty($user->grant_permission) && !empty($user->id_father)){
            return $controller->redirect('/templateZaloZNS');
        }
        if(!empty($_GET['id'])){
            $data = $modelZaloTemplates->find()->where(['id'=>(int) $_GET['id'], 'id_system'=>$user->id_system])->first();

            $note = $user->type_tv.' '. $user->name.' xóa thông tin mẫu tin nhắn ZNS '.$data->name.' có id là:'.$data->id;
                

            addActivityHistory($user,$note,'deleteTemplateZaloZNS',$data->id);
            
            if($data){
                $modelZaloTemplates->delete($data);
            }
        }

        return $controller->redirect('/templateZaloZNS');
    }else{
        return $controller->redirect('/login');
    }
}
?>