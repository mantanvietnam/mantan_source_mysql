<?php 
function createMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $urlHomes;

	$modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelWarehouse = $controller->loadModel('Warehouses');
	$mess = '';
	$return = ['code'=>0, 'mess'=>''];
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		$dataSend['password'] = $dataSend['phone'];

		if(!empty($dataSend['name_spa']) && !empty($dataSend['phone'])){
			
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(empty($checkPhone)){
				// tạo người dùng mới
				$data = $modelMember->newEmptyEntity();

				$data->name = $dataSend['name_spa'].' (chủ)';
				$data->avatar = 'https://phanmem.quanlyspa.pro/plugins/databot_spa/view/home/assets/img/avatar-default.png';
				$data->phone = $dataSend['phone'];
				$data->email = @$dataSend['email'];
				$data->password = md5($dataSend['password']);
				$data->status = 1; //1: kích hoạt, 0: khóa
				$data->type = 1; // 0: nhân viên, 1: chủ spa
				$data->id_member = 0;
				$data->created_at = date('Y-m-d H:i:s');
				$data->updated_at = date('Y-m-d H:i:s');
				$data->last_login = date('Y-m-d H:i:s');
				$data->dateline_at = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). '30 days'));
				$data->number_spa = 1;
				$data->address = $dataSend['address'];
				$data->code_otp = rand(100000, 999999);

				$modelMember->save($data);

				// tạo cơ sở spa mới
				$dataSpa = $modelSpas->newEmptyEntity();

				$dataSpa->name = $dataSend['name_spa'];
				$dataSpa->phone = $dataSend['phone'];
				$dataSpa->email = @$dataSend['email'];
				$dataSpa->id_member = $data->id;
				$dataSpa->address = @$dataSend['address'];
				$dataSpa->slug = createSlugMantan($dataSpa->name).'-'.time();
				$dataSpa->created_at = date('Y-m-d H:i:s');
				$dataSpa->updated_at = date('Y-m-d H:i:s');
				$dataSpa->image = $urlHomes.'/plugins/databot_spa/view/home/assets/img/default-thumbnail.jpg';
				$dataSpa->facebook = '';
				$dataSpa->website = '';
				$dataSpa->zalo = $dataSend['phone'];

				$modelSpas->save($dataSpa);

				// tạo kho mới
				$dataWarehouse = $modelWarehouse->newEmptyEntity();
				
				$dataWarehouse->name = $dataSpa->address;
				$dataWarehouse->credit = 1;
				$dataWarehouse->id_member = $data->id;
				$dataWarehouse->id_spa = $dataSpa->id;
				$dataWarehouse->created_at = date('Y-m-d H:i:s');
				
				$modelWarehouse->save($dataWarehouse);

				// gửi email thông báo tài khoản
				sendEmailRegAcc($data->email, $data->name, $data->phone, $dataSend['phone']);

				$return = ['code'=>0, 'mess'=>'Đăng ký phần mền quản lý SPA thành công'];
			}else{
				$return = ['code'=>2, 'mess'=>'Số điện thoại đã tồn tại'];
			}
		}else{
			$return = ['code'=>1, 'mess'=>'Gửi thiếu dữ liệu'];
		}
	}else{
		$return = ['code'=>1, 'mess'=>'Gửi thiếu dữ liệu'];
	}
	
	return $return;
}
?>