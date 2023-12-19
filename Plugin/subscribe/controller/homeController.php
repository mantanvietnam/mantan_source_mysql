<?php
	function addSubscribe($input)
	{
		global $isRequestPost;
		global $urlHomes;
		global $controller;
		
		$mess= '';

		$modelSubscribes = $controller->loadModel('Subscribes');

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['email'])){
				$checkEmail = $modelSubscribes->find()->where(['email'=>$dataSend['email']])->first();

				if(empty($checkEmail)){
					$data = $modelSubscribes->newEmptyEntity();

			        $data->email = $dataSend['email'];

			        $modelSubscribes->save($data);

					$mess= '<p class="text-success">Đăng ký nhận tin thành công</p>';
				}else{
					$mess= '<p class="text-danger">Địa chỉ email này đã được đăng ký</p>';
				}
			}else{
				$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
			}
			
		}

		setVariable('mess',$mess);
	}

	function addSubscribeAPI($input)
	{
		global $isRequestPost;
		global $urlHomes;
		global $controller;
		
		$mess= '';

		$modelSubscribes = $controller->loadModel('Subscribes');

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['email'])){
				$checkEmail = $modelSubscribes->find()->where(['email'=>$dataSend['email']])->first();

				if(empty($checkEmail)){
					$data = $modelSubscribes->newEmptyEntity();

			        $data->email = $dataSend['email'];

			        $modelSubscribes->save($data);

					$return = array('code'=> 1, 'mess'=>'Đăng ký nhận tin thành công');
				}else{
					$return = array('code'=> 0, 'mess'=>'Địa chỉ email này đã được đăng ký');
				}
			}else{
				$return = array('code'=> 0, 'mess'=>'Bạn chưa nhập dữ liệu bắt buộc');
			}
			
		}

		return $return;
	}
?>