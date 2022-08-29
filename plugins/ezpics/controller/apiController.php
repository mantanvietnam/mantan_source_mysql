<?php 
function saveUserRegisterAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$modelUsers = $controller->loadModel('Users');
		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);

		if(!empty($dataSend['full_name']) && !empty($dataSend['email']) && !empty($dataSend['phone']) && !empty($dataSend['pass'])){

			$conditions = array('phone' => $dataSend['phone']);
        	$checkUser = $modelUsers->find()->where($conditions)->first();

        	if(empty($checkUser)){
				$save = $modelUsers->newEmptyEntity();

		        // tạo dữ liệu save
		        $save->full_name = $dataSend['full_name'];
		        $save->email = $dataSend['email'];
		        $save->phone = $dataSend['phone'];
		        $save->pass = md5($dataSend['pass']);
		        $save->slugSearch = createSlugMantan($save->full_name.' '.$save->email.' '.$save->phone);
		        $save->avatar = 'https://ezpics.vn/plugins/ezpics/view/home/img/avatar.png';

		        if($modelUsers->save($save)){
		        	$session->write('infoUser', $save);

		        	$return = array('code'=>0);
		        }
		    }else{
		    	$return = array('code'=>2);
		    }
		}
	}

	return $return;
}

function checkLoginAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$modelUsers = $controller->loadModel('Users');
		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);

		if(!empty($dataSend['phone']) && !empty($dataSend['pass'])){

			$conditions = array('phone' => $dataSend['phone'], 'pass'=>md5($dataSend['pass']));
        	$checkUser = $modelUsers->find()->where($conditions)->first();

        	if(!empty($checkUser)){
				$session->write('infoUser', $checkUser);
				$return = array('code'=>0);
		    }else{
		    	$return = array('code'=>2);
		    }
		}
	}

	return $return;
}

function saveTemplateAPI($input)
{
	global $isRequestPost;
	global $session;
	global $controller;

	$return = array('code'=>1);
	$infoUser = $session->read('infoUser');

	if($isRequestPost && !empty($infoUser)){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['name'])){
			$modelTemplates = $controller->loadModel('Templates');

			if(!empty($dataSend['id'])){
				$infoTemplate = $modelTemplates->get($dataSend['id']);
			}else{
				$infoTemplate = $modelTemplates->newEmptyEntity();
			}

			$infoTemplate->name = $dataSend['name'];
			$infoTemplate->layouts = @$dataSend['layouts'];
			$infoTemplate->idUser = $infoUser->id;
			$infoTemplate->idCategory = @$dataSend['idCategory'];
			$infoTemplate->price = (int) @$dataSend['price'];
			

			if(empty($infoTemplate->numberBuy)){
				$infoTemplate->numberBuy = 0;
				$infoTemplate->status = 'draf';
			}

			if($modelTemplates->save($infoTemplate)){
				$return = array('code'=>0, 'idTemplate'=>$infoTemplate->id);
			}
		}
	}

	return $return;
}
?>