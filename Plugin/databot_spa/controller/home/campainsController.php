<?php 
function listCampain(){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Danh sách chiến dịch';
    
    if(!empty($session->read('infoUser'))){

        $mess= '';

        $modelMembers = $controller->loadModel('Members');
        $modelCampains = $controller->loadModel('Campains');
        $modelCampainCustomers = $controller->loadModel('CampainCustomers');
        
        $user = $session->read('infoUser');

        $conditions = array('idMember'=>$user->id_member, 'idSpa'=>$session->read('id_spa'));
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }

       
        $listData = $modelCampains->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $listData[$key]->number_reg = 0;
                $listData[$key]->number_checkin = 0;
                $listData[$key]->number_banking = 0;

                $user_reg = $modelCampainCustomers->find()->where(['id_campain'=>$value->id])->all()->toList();
                $listData[$key]->number_reg = count($user_reg);
            }
        }

        $totalData = $modelCampains->find()->where($conditions)->all()->toList();
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
        
        setVariable('listData', $listData);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function addCampain($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin chiến dịch';
    
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
        $modelCampains = $controller->loadModel('Campains');

        $infoUser = $session->read('infoUser');
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelCampains->get( (int) $_GET['id']);

            if(!empty($data->status)) $data->status = json_decode($data->status, true);
            if(!empty($data->nameTicket)) $data->nameTicket = json_decode($data->nameTicket, true);
            if(!empty($data->priceTicket)) $data->priceTicket = json_decode($data->priceTicket, true);
            if(!empty($data->nameLocation)) $data->nameLocation = json_decode($data->nameLocation, true);

        }else{
            $data = $modelCampains->newEmptyEntity();
            $data->created_at = time();
            $data->codeUser = 999;
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name'])){
                if(empty($dataSend['backgroundSpin'])) $dataSend['backgroundSpin'] = $urlHomes.'/plugins/databot_spa/view/home/assets/img/background-spin.png';
                if(empty($dataSend['logoSpin'])) $dataSend['logoSpin'] = $urlHomes.'/plugins/databot_spa/view/home/assets/img/logo-spin.png';
                if(empty($dataSend['colorTextSpin'])) $dataSend['colorTextSpin'] = '#000';
                if(empty($dataSend['status'])) $dataSend['status'] = [];
                if(empty($dataSend['nameTicket'])) $dataSend['nameTicket'] = [];
                if(empty($dataSend['priceTicket'])) $dataSend['priceTicket'] = [];
                if(empty($dataSend['nameLocation'])) $dataSend['nameLocation'] = [];

                // tạo dữ liệu save
                $data->name = $dataSend['name'];
                $data->slug = createSlugMantan(trim($dataSend['name'])).'-'.time();
                $data->codeSecurity = $dataSend['codeSecurity'];
                $data->numberPersonWinSpin = (!empty($dataSend['numberPersonWinSpin']))?(int) $dataSend['numberPersonWinSpin']:1;
                $data->typeUserWin = $dataSend['typeUserWin'];
                $data->note = $dataSend['note'];
                $data->noteCheckin = $dataSend['noteCheckin'];
                
                $data->status = json_encode($dataSend['status']);
                $data->nameTicket = json_encode($dataSend['nameTicket']);
                $data->priceTicket = json_encode($dataSend['priceTicket']);
                $data->nameLocation = json_encode($dataSend['nameLocation']);

                $data->smsRegister = $dataSend['smsRegister'];
                $data->sendSMS =(int) $dataSend['sendSMS'];
                $data->idMember = (int) $infoUser->id_member;
                $data->idSpa = (int) $session->read('id_spa');

                $data->idBotBanking = $dataSend['idBotBanking'];
                $data->tokenBotBanking = $dataSend['tokenBotBanking'];
                $data->idBlockSuccessfulTransaction = $dataSend['idBlockSuccessfulTransaction'];

                $data->backgroundSpin = $dataSend['backgroundSpin'];
                $data->logoSpin = $dataSend['logoSpin'];
                $data->colorTextSpin = $dataSend['colorTextSpin'];
                
                $modelCampains->save($data);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

                $data->status = json_decode($data->status, true);
                $data->nameTicket = json_decode($data->nameTicket, true);
                $data->priceTicket = json_decode($data->priceTicket, true);
                $data->nameLocation = json_decode($data->nameLocation, true);
                
            }else{
                $mess= '<p class="text-danger">Bạn chưa nhập tên chiến dịch</p>';
            }
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteCampain($input)
{
    global $controller;
    global $session;
    
    $modelCampains = $controller->loadModel('Campains');
    
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        if(!empty($_GET['id'])){
            $data = $modelCampains->get($_GET['id']);
            
            if($data){
                $modelCampains->delete($data);
            }
        }

        return $controller->redirect('/listCampain');
    }else{
        return $controller->redirect('/login');
    }
}
?>