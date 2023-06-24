<?php 
function listDesignRegistrationAdmin($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin đăng kí design';

    $modelContact = $controller->loadModel('contact');
    
    $conditions = array();

     $conditions['type']= 1;


    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelContact->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    
    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelContact->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelContact->find()->where($conditions)->all()->toList();
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

function addDesignRegistrationAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;
    global $urlCreateImage;

    $metaTitleMantan = 'Thông tin đăng kí design';

    $modelmember = $controller->loadModel('members');
    $modelContact = $controller->loadModel('contact');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelContact->get( (int) $_GET['id']);
        $member = $modelmember->get($data->customer_id);

    	if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            if(@$dataSend['status']=='Duyệt'){
                $url = $urlCreateImage.'?width=2000&height=1413&url='.urlencode('https://apis.ezpics.vn/createImageFromTemplate/?id=1938&full_name='.$member->name.'&date='.date('d/m/Y'));

                $dataImage = sendDataConnectMantan($url);

                $member->certificate = 'https://apis.ezpics.vn/upload/admin/images/50/50_2023_06_08_15_55_58_6713.jpg';

                if(!empty($dataImage)){
                    $name = __DIR__.'/../../../upload/admin/images/'.$member->id.'/certificate_'.$member->id.'.png';

                    if (!file_exists(__DIR__.'/../../../upload/admin/images/'.$member->id )) {
                        mkdir(__DIR__.'/../../../upload/admin/images/'.$member->id, 0755, true);
                    }
                    
                    // unlink($name);

                    file_put_contents($name, base64_decode($dataImage));

                    $image = 'https://admin.ezpics.vn/upload/admin/images/'.$member->id.'/certificate_'.$member->id.'.png?time='.time();

                    $member->certificate = $image;
                }
                $member->description =  @$data->content;
                $member->file_cv =  @$data->meta;
                $member->type = 1;

                if(empty($member->link_open_app)){
                    // tạo deep link
                    $url_deep = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyC2G5JcjKx1Mw5ZndV4cfn2RzF1SmQZ_O0';
                    $data_deep = ['dynamicLinkInfo'=>[  'domainUriPrefix'=>'https://ezpics.page.link',
                                                        'link'=>'https://ezpics.page.link/detailProfile?id='.$member->id,
                                                        'androidInfo'=>['androidPackageName'=>'vn.ezpics'],
                                                        'iosInfo'=>['iosBundleId'=>'vn.ezpics.ezpics']
                                                ]
                                ];
                    $header_deep = ['Content-Type: application/json'];
                    $typeData='raw';
                    $deep_link = sendDataConnectMantan($url_deep,$data_deep,$header_deep,$typeData);
                    $deep_link = json_decode($deep_link);

                    $member->link_open_app = @$deep_link->shortLink;
                }
                
                $modelmember->save($member);

                $data->status = 1;
                $modelContact->save($data);
                
                $dataSendNotification= array('title'=>'Tài khoản của bạn đã trở thành Designer','time'=>date('H:i d/m/Y'),'content'=>'Chúc mừng bạn trở thành Designer của Ezpics ','action'=>'DesignRegistration','link'=>$member->certificate);
                
                sendNotification($dataSendNotification, $member->token_device);

                sendEmailsuccessfulDesigner($member->email, $member->name, $member->certificate);
            }else{
                $member->type = 0;
                $data->status = 2;
                $modelmember->save($member);
                $modelContact->save($data);
                $dataSendNotification= array('title'=>'Đơn đăng ký designer không được phê duyệt ','time'=>date('H:i d/m/Y'),'content'=>'Chúng tôi rất tiếc phải thông báo rằng đơn đăng ký designer của bạn đã bị từ chối. Lý do từ chối: '.$dataSend['content'],'action'=>'adminSendNotification');
                 sendNotification($dataSendNotification, $member->token_device);
                 sendEmailunsuccessfuldesigner($member->email, $member->name,$dataSend['content']);
            }
    		
    		return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-contact-listDesignRegistrationAdmin.php?status=2');

    		  
        }
    }else{
        return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-contact-listDesignRegistrationAdmin.php');
    }

    setVariable('data', $data);
    setVariable('member', $member);
    setVariable('mess', $mess);
}

function deleteDesignRegistrationAdmin($input){
	global $controller;

	$modelmember = $controller->loadModel('members');
    $modelContact = $controller->loadModel('contact');
	
	if(!empty($_GET['id'])){
		$data = $modelContact->get($_GET['id']);
		
		if($data){
         	$modelContact->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-contact-listDesignRegistrationAdmin.php?status=3');
}

function listOrderProductAdmin($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin đăng kí design';

    $modelContact = $controller->loadModel('contact');
    
    $conditions = array();

     $conditions['type']= 0;


    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelContact->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelContact->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelContact->find()->where($conditions)->all()->toList();
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

function addOrderProductAdmin($input){


	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin đăng kí design';

    $modelmember = $controller->loadModel('members');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelmember->get( (int) $_GET['id']);
    }else{
        $data = $modelmember->newEmptyEntity();
    }

     // debug($data);
     // die;

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
		        // tạo dữ liệu save
		$data->name = @$dataSend['name'];
		$data->email = @$dataSend['email'];
		$data->id_facebook = @$dataSend['id_facebook'];
		$data->avatar = @$dataSend['avatar'];
		$data->status = @$dataSend['status'];
		$data->updated_at = date('Y-m-d H:i:s');
		$data->id_google = @$dataSend['id_google'];
		$data->id_apple = @$dataSend['id_apple'];
		if(!empty($dataSend['pass'])){
			$data->password = md5($dataSend['pass']);
		}
		$modelmember->save($data);

		return $controller->redirect('/plugins/admin/ezpics_designer-view-admin-member-listMemberAdmin.php?status=2');

		  
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteOrderProductAdmin($input){
	global $controller;

	$modelContact = $controller->loadModel('contact');
	
	if(!empty($_GET['id'])){
		$data = $modelContact->get($_GET['id']);
		
		if($data){
         	$modelContact->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-contact-listOrderProductAdmin.php?status=3');
}

function listBaddesignAdmin($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin đăng kí design';

    $modelMembers = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');

    $modelContact = $controller->loadModel('contact');
    
    $conditions = array();

     $conditions['type']= 2;


    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelContact->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelContact->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
            $product = $modelProducts->find()->where(array('id'=>$value->meta))->first();
            if(!empty($product)){
                $listData[$key]->product = $product;
                $listData[$key]->user = $modelMembers->get($listData[$key]->product->user_id);
            }
            
        }
    }

    // phân trang
    $totalData = $modelContact->find()->where($conditions)->all()->toList();
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

function addBaddesignAdmin($input){


    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin đăng kí design';

    $modelmember = $controller->loadModel('members');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelmember->get( (int) $_GET['id']);
    }else{
        $data = $modelmember->newEmptyEntity();
    }

     // debug($data);
     // die;

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
                // tạo dữ liệu save
        $data->name = @$dataSend['name'];
        $data->email = @$dataSend['email'];
        $data->id_facebook = @$dataSend['id_facebook'];
        $data->avatar = @$dataSend['avatar'];
        $data->status = @$dataSend['status'];
        $data->updated_at = date('Y-m-d H:i:s');
        $data->id_google = @$dataSend['id_google'];
        $data->id_apple = @$dataSend['id_apple'];
        if(!empty($dataSend['pass'])){
            $data->password = md5($dataSend['pass']);
        }
        $modelmember->save($data);

        return $controller->redirect('/plugins/admin/ezpics_designer-view-admin-member-listMemberAdmin.php?status=2');

          
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteBaddesignAdmin($input){
    global $controller;

   $modelContact = $controller->loadModel('contact');
    
    if(!empty($_GET['id'])){
        $data = $modelContact->get($_GET['id']);
        
        if($data){
            $modelContact->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-contact-listBaddesignAdmin.php?status=3');
}
?>