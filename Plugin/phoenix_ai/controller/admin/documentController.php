<?php 
function listdocument($input){
    global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	if(!empty($session->read('infoUser'))){
		$info = $session->read('infoUser');
		$listBostAi = listBostAi();
		$modelpersons = $controller->loadModel('persons');
		$modelContent = $controller->loadModel('ContentFacebookAis');
	    $modelHistoryChatAis = $controller->loadModel('HistoryChatAis');
		if (!empty($_GET['title'])) {
			$conditions['title LIKE'] = '%' . $_GET['title'] . '%';
		}
		$conditions['id_member'] = $info->id;
		$order = array('id' => 'desc');
		$limit = 10;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if(!empty($info->id)){
			$listdatacontent = $modelContent->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		}

		if(!empty($listdatacontent)){
			foreach($listdatacontent as $key => $item){
				foreach($listBostAi as $k => $value){
					if($value['type']== $item->type){
						$listdatacontent[$key]->link = $value['url'];
					}
				}
			}
		}
		$totalData = $modelContent->find()->where($conditions)->all()->toList();
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
		setvariable('listdatacontent', $listdatacontent);
	}else{

    	return $controller->redirect('/login');
	}

}
function setting($input){
	global $session;
	global $controller;
	global $metaTitleMantan;
	global $isRequestPost;
	global $modelCategories;
	global $urlHomes;
	global $displayInfo;

	$metaTitleMantan = 'Đổi thông tin tài khoản';

	$modelMembers = $controller->loadModel('Members');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		$user = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['name'])){
				if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
					$avatar = uploadImage($user->id, 'avatar', 'avatar_'.$user->id);
				}

				if(!empty($avatar['linkOnline'])){
					$user->avatar = $avatar['linkOnline'].'?time='.time();
				}else{
					if(empty($user->avatar)){
						$user->avatar = $urlHomes.'/plugins/vemoi/view/home/assets/img/avatar-default-crm.png';
					}
				}

				$user->name = $dataSend['name'];
				$user->email = $dataSend['email'];
				$user->address = $dataSend['address'];
				// $user->facebook = $dataSend['facebook'];

				$modelMembers->save($user);

				$session->write('infoUser', $user);

				$mess= '<p class="text-success">Đổi thông tin thành công</p>';
			}else{
				$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
			}
		}

		
		setVariable('mess', $mess);
		setVariable('user', $user);
	}else{
		return $controller->redirect('/login');
	}
}
function deletecontent($input){
	global $controller;

	$modelContent = $controller->loadModel('ContentFacebookAis');
    
    if(!empty($_GET['id'])){
        $data = $modelContent->get($_GET['id']);
        
        if($data){
            $modelContent->delete($data);
        }
    }

    return $controller->redirect('/listdocument');
}


?>