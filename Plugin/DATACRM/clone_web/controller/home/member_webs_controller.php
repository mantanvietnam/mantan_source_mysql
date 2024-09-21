<?php
function listWebMember($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách website đại lý';
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

        $modelMemberWebs = $controller->loadModel('MemberWebs');
        $modelMembers = $controller->loadModel('Members');
        $modelAffiliaters = $controller->loadModel('Affiliaters');

        $conditions = array();
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['theme'])){
            $conditions['theme'] = $_GET['theme'];
        }

        if(!empty($_GET['domain'])){
            $conditions['domain'] = $_GET['domain'];
        }

        if(!empty($_GET['id_member'])){
            $conditions['id_member'] = (int) $_GET['id_member'];
        }

        $listData = $modelMemberWebs->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                if($value->type == 'member'){
                    $listData[$key]->member = $modelMembers->find()->where(['id'=>$value->id_member])->first();
                }else{
                    $listData[$key]->member = $modelAffiliaters->find()->where(['id'=>$value->id_member])->first();
                }
            }
        }

        // phân trang
        $totalData = $modelMemberWebs->find()->where($conditions)->all()->toList();
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

function addWebMember($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelCategories;
    global $urlHomes;
    global $session;

    $metaTitleMantan = 'Cài đặt web đại lý hệ thống';

    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

        $modelMembers = $controller->loadModel('Members');
        $modelMemberWebs = $controller->loadModel('MemberWebs');
        $modelAffiliaters = $controller->loadModel('Affiliaters');

        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelMemberWebs->get( (int) $_GET['id']);
        }else{
            $data = $modelMemberWebs->newEmptyEntity();
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if((!empty($dataSend['id_member']) || !empty($dataSend['id_affiliate'])) && !empty($dataSend['domain']) && !empty($dataSend['theme'])){
                $conditions = ['domain'=>$dataSend['domain']];
                $checkDomain = $modelMemberWebs->find()->where($conditions)->first();
                
                if(empty($checkDomain) || (!empty($_GET['id']) && $_GET['id']==$checkDomain->id)){
                    // tạo dữ liệu save
                    $data->domain = $dataSend['domain'];
                    $data->theme = $dataSend['theme'];
                    $data->status = $dataSend['status'];
                    $data->type = $dataSend['type'];

                    if($dataSend['type'] == 'member'){
                        $data->id_member = (int) $dataSend['id_member'];
                    }else{
                        $data->id_member = (int) $dataSend['id_affiliate'];
                    }

                    $modelMemberWebs->save($data);

                    $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
                }else{
                    $mess= '<p class="text-danger">Tên miền đã tồn tại</p>';
                }
                
            }else{
                $mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
            }
        }

        $listFolder = list_files(__DIR__.'/../../../../themes');

        if(!empty($listFolder)){
            foreach ($listFolder as $key => $value) {
                if(strpos($value, 'clone_web') === false){
                    unset($listFolder[$key]);
                }
            }
        }

        $member = [];
        if(!empty($data->id_member)){
            if($data->type == 'member'){
                $member = $modelMembers->find()->where(['id'=>$data->id_member])->first();
            }else{
                $member = $modelAffiliaters->find()->where(['id'=>$data->id_member])->first();
            }
        }

        setVariable('listFolder', $listFolder);

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('member', $member);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteWebMember($input){
    global $controller;
    global $session;
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

        $modelMemberWebs = $controller->loadModel('MemberWebs');
    
        if(!empty($_GET['id'])){
            $data = $modelMemberWebs->get($_GET['id']);
            
            if($data){
                $modelMemberWebs->delete($data);
            }
        }

        return $controller->redirect('/plugins/admin/clone_web-view-admin-website-listWebMemberAdmin');

    }else{
        return $controller->redirect('/login');
    }
}
?>