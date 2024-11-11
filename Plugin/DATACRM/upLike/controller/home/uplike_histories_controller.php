<?php
function historyUpLike($input)
{
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('historyUpLike');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $metaTitleMantan = 'Lịch sử tăng tương tác';

		$modelMembers = $controller->loadModel('Members');
    	$modelUplikeHistories = $controller->loadModel('UplikeHistories');


    	$conditions = array('id_member'=>$user->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

        
        $listData = $modelUplikeHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

      
        // phân trang
        $totalData = $modelUplikeHistories->find()->where($conditions)->all()->toList();

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

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('mess', $mess);        
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);


    }else{
        return $controller->redirect('/login');
    }
}

function upLikePageFacebook($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $modelOptions;

    $user = checklogin('upLikePageFacebook');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $metaTitleMantan = 'Tăng like Fanpage Facebook';
        $mess ='';

        $modelMembers = $controller->loadModel('Members');
        $modelUplikeHistories = $controller->loadModel('UplikeHistories');
        $modelTransactionHistories = $controller->loadModel('TransactionHistories');

        // kiểm tra cái đặt token
        $multiplier = 1;
        $conditions = array('key_word' => 'settingUpLikeAdmin');
        $data = $modelOptions->find()->where($conditions)->first();

        $data_value = array();
        if(!empty($data->value)){
            $data_value = json_decode($data->value, true);
        }

        if(!empty($data_value['multiplier'])){
            $multiplier = $data_value['multiplier'];
        }else{
            return $controller->redirect('/chooseUpLike/?error=tokenEmpty');
        }

        $user = $modelMembers->get($user->id);
        $type_api = 'facebook.buff.likepage';

        if($isRequestPost){
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['id_page']) && !empty($dataSend['chanel']) && !empty($dataSend['number_up']) && !empty($dataSend['url_page'])){
                if($user->coin >= $dataSend['total_pay']){
                    // gửi yêu cầu sang hệ thống tăng like
                    $sendOngTrum = sendRequestBuffOngTrum($type_api, $dataSend['id_page'], $dataSend['chanel'], $dataSend['number_up'], $dataSend['url_page'], $user->id);

                    if($sendOngTrum['code']==200){
                        $mess= '<p class="text-success">Tạo yêu cầu thành công</p>';

                        // trừ tiền tài khoản
                        $user->coin -= $dataSend['total_pay'];
                        $modelMembers->save($user);

                        // tạo lịch sử giao dịch
                        $histories = $modelTransactionHistories->newEmptyEntity();

                        $histories->id_member = $user->id;
                        $histories->id_system = $user->id_system;
                        $histories->coin = $dataSend['total_pay'];
                        $histories->type = 'minus';
                        $histories->note = 'Trừ tiền dịch vụ tăng '.number_format($dataSend['number_up']).' like cho fanpage Facebook (ID Page '.$dataSend['id_page'].'), số dư tài khoản sau giao dịch là '.number_format($user->coin).'đ';
                        $histories->create_at = time();
                        
                        $modelTransactionHistories->save($histories);

                        // lưu yêu cầu
                        $saveRequest = $modelUplikeHistories->newEmptyEntity();

                        $saveRequest->id_member = $user->id;
                        $saveRequest->id_system = $user->id_system;
                        $saveRequest->id_page = $dataSend['id_page'];
                        $saveRequest->type_page = $type_api;
                        $saveRequest->money = $dataSend['total_pay'];
                        $saveRequest->number_up = $dataSend['number_up'];
                        $saveRequest->chanel = $dataSend['chanel'];
                        $saveRequest->url_page = $dataSend['url_page'];
                        $saveRequest->price = $dataSend['price'];
                        $saveRequest->create_at = time();
                        $saveRequest->status = 'Running';
                        $saveRequest->run = 0;
                        $saveRequest->id_request_buff = $sendOngTrum['id'];
                        $saveRequest->note_buff = json_encode($sendOngTrum);

                        $modelUplikeHistories->save($saveRequest);
                    }else{
                        $mess= '<p class="text-danger">'.$sendOngTrum['message'].'</p>';
                    }
                }else{
                    $mess= '<p class="text-danger">Số dư tài khoản của bạn không đủ, vui lòng <a href="/listTransactionHistories">NẠP TIỀN</a></p>';
                }
            }else{
                $mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
            }
        }


        $conditions = array('id_member'=>$user->id, 'type_page'=>$type_api);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

        
        $listData = $modelUplikeHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        
        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                if($value->status == 'Running'){
                    $checkStatus = checkRequestOngTrum($value->id_request_buff, $type_api);

                    if($checkStatus['code'] == 200){
                        if($checkStatus['data']['status'] != 'Running'){
                            $listData[$key]->status = $checkStatus['data']['status'];
                        }

                        $listData[$key]->run = (int) $checkStatus['data']['run'];

                        $modelUplikeHistories->save($listData[$key]);
                    }
                }
            }
        }
      
        // phân trang
        $totalData = $modelUplikeHistories->find()->where($conditions)->all()->toList();

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

        
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        $listPrice = getListPriceOngTrum();

     
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('mess', $mess);        
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);
        setVariable('listPrice', $listPrice);
        setVariable('mess', $mess);
        setVariable('member', $user);
        setVariable('multiplier', $multiplier);
    }else{
        return $controller->redirect('/login');
    }
}

function upViewLiveFacebook($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $modelOptions;

    $user = checklogin('upViewLiveFacebook');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $metaTitleMantan = 'Tăng mắt live Facebook';
        $mess ='';

        $modelMembers = $controller->loadModel('Members');
        $modelUplikeHistories = $controller->loadModel('UplikeHistories');
        $modelTransactionHistories = $controller->loadModel('TransactionHistories');

        // kiểm tra cái đặt token
        $multiplier = 1;
        $conditions = array('key_word' => 'settingUpLikeAdmin');
        $data = $modelOptions->find()->where($conditions)->first();

        $data_value = array();
        if(!empty($data->value)){
            $data_value = json_decode($data->value, true);
        }

        if(!empty($data_value['multiplier'])){
            $multiplier = $data_value['multiplier'];
        }else{
            return $controller->redirect('/chooseUpLike/?error=tokenEmpty');
        }

        $user = $modelMembers->get($user->id);
        $type_api = 'facebook.buff.live';

        if($isRequestPost){
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['id_page']) && !empty($dataSend['chanel']) && !empty($dataSend['number_up']) && !empty($dataSend['url_page']) && !empty($dataSend['minute'])){
                if($dataSend['minute']>=30){
                    if($user->coin >=(int) $dataSend['total_pay']){
                        // gửi yêu cầu sang hệ thống tăng like
                        $sendOngTrum = sendRequestBuffOngTrum($type_api, $dataSend['id_page'], $dataSend['chanel'], $dataSend['number_up'], $dataSend['url_page'], $user->id, $dataSend['minute']);

                        if($sendOngTrum['code']==200){
                            $mess= '<p class="text-success">Tạo yêu cầu thành công</p>';

                            // trừ tiền tài khoản
                            $user->coin -= $dataSend['total_pay'];
                            $modelMembers->save($user);

                            // tạo lịch sử giao dịch
                            $histories = $modelTransactionHistories->newEmptyEntity();

                            $histories->id_member = $user->id;
                            $histories->id_system = $user->id_system;
                            $histories->coin = $dataSend['total_pay'];
                            $histories->type = 'minus';
                            $histories->note = 'Trừ tiền dịch vụ tăng '.number_format($dataSend['number_up']).' lượt xem trong '.number_format($dataSend['minute']).' phút cho livestream Facebook (ID live '.$dataSend['id_page'].'), số dư tài khoản sau giao dịch là '.number_format($user->coin).'đ';
                            $histories->create_at = time();
                            
                            $modelTransactionHistories->save($histories);

                            // lưu yêu cầu
                            $saveRequest = $modelUplikeHistories->newEmptyEntity();

                            $saveRequest->id_member = $user->id;
                            $saveRequest->id_system = $user->id_system;
                            $saveRequest->id_page = $dataSend['id_page'];
                            $saveRequest->type_page = $type_api;
                            $saveRequest->money = $dataSend['total_pay'];
                            $saveRequest->number_up = $dataSend['number_up'];
                            $saveRequest->chanel = $dataSend['chanel'];
                            $saveRequest->url_page = $dataSend['url_page'];
                            $saveRequest->price = $dataSend['price'];
                            $saveRequest->create_at = time();
                            $saveRequest->status = 'Running';
                            $saveRequest->run = 0;
                            $saveRequest->id_request_buff = $sendOngTrum['id'];
                            $saveRequest->note_buff = json_encode($sendOngTrum);
                            $saveRequest->minute = (int) $dataSend['minute'];

                            $modelUplikeHistories->save($saveRequest);
                        }else{
                            $mess= '<p class="text-danger">'.$sendOngTrum['message'].'</p>';
                        }
                    }else{
                        $mess= '<p class="text-danger">Số dư tài khoản của bạn không đủ, vui lòng <a href="/listTransactionHistories">NẠP TIỀN</a></p>';
                    }
                }else{
                    $mess= '<p class="text-danger">Thời gian tối thiểu xem video là 30 phút</p>';
                }
            }else{
                $mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
            }
        }


        $conditions = array('id_member'=>$user->id, 'type_page'=>$type_api);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

        
        $listData = $modelUplikeHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        
        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                if($value->status == 'Running'){
                    $checkStatus = checkRequestOngTrum($value->id_request_buff, $type_api);

                    if($checkStatus['code'] == 200){
                        if($checkStatus['data']['status'] != 'Running'){
                            $listData[$key]->status = $checkStatus['data']['status'];
                        }

                        $listData[$key]->run = (int) $checkStatus['data']['run'];

                        $modelUplikeHistories->save($listData[$key]);
                    }
                }
            }
        }
      
        // phân trang
        $totalData = $modelUplikeHistories->find()->where($conditions)->all()->toList();

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

        
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        $listPrice = getListPriceOngTrum();

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('mess', $mess);        
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);
        setVariable('listPrice', $listPrice);
        setVariable('mess', $mess);
        setVariable('member', $user);
        setVariable('multiplier', $multiplier);
    }else{
        return $controller->redirect('/login');
    }
}

function upFollowPageFacebook($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $modelOptions;
    
    $user = checklogin('upFollowPageFacebook');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $metaTitleMantan = 'Tăng theo dõi fanpage Facebook';
        $mess ='';

        $modelMembers = $controller->loadModel('Members');
        $modelUplikeHistories = $controller->loadModel('UplikeHistories');
        $modelTransactionHistories = $controller->loadModel('TransactionHistories');

        // kiểm tra cái đặt token
        $multiplier = 1;
        $conditions = array('key_word' => 'settingUpLikeAdmin');
        $data = $modelOptions->find()->where($conditions)->first();

        $data_value = array();
        if(!empty($data->value)){
            $data_value = json_decode($data->value, true);
        }

        if(!empty($data_value['multiplier'])){
            $multiplier = $data_value['multiplier'];
        }else{
            return $controller->redirect('/chooseUpLike/?error=tokenEmpty');
        }

        $user = $modelMembers->get($user->id);
        $type_api = 'facebook.buff.subpage';

        if($isRequestPost){
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['id_page']) && !empty($dataSend['chanel']) && !empty($dataSend['number_up']) && !empty($dataSend['url_page'])){
              
                if($user->coin >=(int) $dataSend['total_pay']){
                    // gửi yêu cầu sang hệ thống tăng like
                    $sendOngTrum = sendRequestBuffOngTrum($type_api, $dataSend['id_page'], $dataSend['chanel'], $dataSend['number_up'], $dataSend['url_page'], $user->id);

                    if($sendOngTrum['code']==200){
                        $mess= '<p class="text-success">Tạo yêu cầu thành công</p>';

                        // trừ tiền tài khoản
                        $user->coin -= $dataSend['total_pay'];
                        $modelMembers->save($user);

                        // tạo lịch sử giao dịch
                        $histories = $modelTransactionHistories->newEmptyEntity();

                        $histories->id_member = $user->id;
                        $histories->id_system = $user->id_system;
                        $histories->coin = $dataSend['total_pay'];
                        $histories->type = 'minus';
                        $histories->note = 'Trừ tiền dịch vụ tăng '.number_format($dataSend['number_up']).' lượt theo dõi cho fanpage Facebook (ID Page '.$dataSend['id_page'].'), số dư tài khoản sau giao dịch là '.number_format($user->coin).'đ';
                        $histories->create_at = time();
                        
                        $modelTransactionHistories->save($histories);

                        // lưu yêu cầu
                        $saveRequest = $modelUplikeHistories->newEmptyEntity();

                        $saveRequest->id_member = $user->id;
                        $saveRequest->id_system = $user->id_system;
                        $saveRequest->id_page = $dataSend['id_page'];
                        $saveRequest->type_page = $type_api;
                        $saveRequest->money = $dataSend['total_pay'];
                        $saveRequest->number_up = $dataSend['number_up'];
                        $saveRequest->chanel = $dataSend['chanel'];
                        $saveRequest->url_page = $dataSend['url_page'];
                        $saveRequest->price = $dataSend['price'];
                        $saveRequest->create_at = time();
                        $saveRequest->status = 'Running';
                        $saveRequest->run = 0;
                        $saveRequest->id_request_buff = $sendOngTrum['id'];
                        $saveRequest->note_buff = json_encode($sendOngTrum);

                        $modelUplikeHistories->save($saveRequest);
                    }else{
                        $mess= '<p class="text-danger">'.$sendOngTrum['message'].'</p>';
                    }
                }else{
                    $mess= '<p class="text-danger">Số dư tài khoản của bạn không đủ, vui lòng <a href="/listTransactionHistories">NẠP TIỀN</a></p>';
                }
            }else{
                $mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
            }
        }


        $conditions = array('id_member'=>$user->id, 'type_page'=>$type_api);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

        
        $listData = $modelUplikeHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        
        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                if($value->status == 'Running'){
                    $checkStatus = checkRequestOngTrum($value->id_request_buff, $type_api);

                    if($checkStatus['code'] == 200){
                        if($checkStatus['data']['status'] != 'Running'){
                            $listData[$key]->status = $checkStatus['data']['status'];
                        }

                        $listData[$key]->run = (int) $checkStatus['data']['run'];

                        $modelUplikeHistories->save($listData[$key]);
                    }
                }
            }
        }
      
        // phân trang
        $totalData = $modelUplikeHistories->find()->where($conditions)->all()->toList();

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

        
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        $listPrice = getListPriceOngTrum();

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('mess', $mess);        
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);
        setVariable('listPrice', $listPrice);
        setVariable('mess', $mess);
        setVariable('member', $user);
        setVariable('multiplier', $multiplier);
    }else{
        return $controller->redirect('/login');
    }
}

function chooseUpLike($input)
{
    
}