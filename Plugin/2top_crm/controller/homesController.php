<?php 
function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'Đăng nhập tài khoản';

    $modelCustomer = $controller->loadModel('Customers');

    if(empty($session->read('infoUser'))){
    	$mess = '';

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	if(!empty($dataSend['email']) && !empty($dataSend['pass'])){
	    		$conditions = array('email'=>$dataSend['email'], 'pass'=>md5($dataSend['pass']));
	    		$info_customer = $modelCustomer->find()->where($conditions)->first();

	    		if(empty($info_customer )){
	    			$conditions = array('phone'=>$dataSend['email'], 'pass'=>md5($dataSend['pass']));
	    			$info_customer = $modelCustomer->find()->where($conditions)->first();
	    		}

	    		if($info_customer){
	    			$session->write('infoUser', $info_customer);
	    			
					return $controller->redirect('/');
	    		}else{
	    			$mess= '<p class="text-danger">Sai tài khoản hoặc mật khẩu</p>';
	    		}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/');
	}
}

function register($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'Đăng ký tài khoản';



    $modelCustomer = $controller->loadModel('Customers');

    if(empty($session->read('infoUser'))){
    	$mess = '';

	    if($isRequestPost){

	    	$dataSend = $input['request']->getData();

	    	if(	!empty($dataSend['full_name']) && 
	    		!empty($dataSend['phone']) &&
	    		!empty($dataSend['email']) &&
	    		!empty($dataSend['pass']) &&
	    		!empty($dataSend['passAgain']) 
	    	){
	    		if($dataSend['pass'] == $dataSend['passAgain']){
		    		$data = $modelCustomer->newEmptyEntity();

		    		$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
		        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		        	$conditions = array();
			        $conditions['phone'] = $dataSend['phone'];
			        $checkCustomer = $modelCustomer->find()->where($conditions)->first();

			        if(empty($checkCustomer)){
				        // tạo dữ liệu save
				        $data->full_name = $dataSend['full_name'];
				        $data->phone = $dataSend['phone'];
				        $data->email = $dataSend['email'];
				        $data->address = (!empty($dataSend['address']))?$dataSend['address']:'';
				        $data->sex = (int) @$dataSend['sex'];
				        $data->id_city = (int) @$dataSend['id_city'];
				        $data->id_messenger = (!empty($dataSend['id_messenger']))?$dataSend['id_messenger']:'';
				        $data->avatar = '/plugins/2top_crm/view/admin/img/user-placeholder.png';
				        $data->status = 'active';
				        $data->id_parent = (int) @$dataSend['id_parent'];
				        $data->id_level = (int) @$dataSend['id_level'];
				        $data->pass = md5($dataSend['pass']);

				        if(empty($dataSend['birthday'])) $dataSend['birthday']='0/0/0';
						$birthday_date = 0;
						$birthday_month = 0;
						$birthday_year = 0;

						$birthday = explode('/', trim($dataSend['birthday']));
						if(count($birthday)==3){
							$birthday_date = (int) $birthday[0];
							$birthday_month = (int) $birthday[1];
							$birthday_year = (int) $birthday[2];
						}

						$data->birthday_date = (int) @$birthday_date;
						$data->birthday_month = (int) @$birthday_month;
						$data->birthday_year = (int) @$birthday_year;

				        $modelCustomer->save($data);

			    		$conditions = array('phone'=>$dataSend['phone'], 'pass'=>md5($dataSend['pass']));
			    		$info_customer = $modelCustomer->find()->where($conditions)->first();

			    		if($info_customer){
			    			$session->write('infoUser', $info_customer);
			    			
							return $controller->redirect('/');
			    		}else{
			    			$mess= '<p class="text-danger">Đăng ký thất bại do lỗi hệ thống</p>';
			    		}
			    	}else{
			    		$mess= '<p class="text-danger">Số điện thoại đã được đăng ký</p>';
			    	}
		    	}else{
		    		$mess= '<p class="text-danger">Mật khẩu nhập lại chưa đúng</p>';
		    	}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/');
	}
}

function logout($input)
{	
	global $session;
	global $controller;

	$session->destroy();

	return $controller->redirect('/');
}
?>