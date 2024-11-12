<?php 
function addMoneyToIcham($input){
	global $controller;

	global $isRequestPost;
	$modelMembers = $controller->loadModel('Members');
	$modelTransactionHistories = $controller->loadModel('TransactionHistories');

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['total'])){
			$conditions = array();
			if(!empty($dataSend['phone'])){
				$conditions['phone'] = $dataSend['phone'];
			}elseif(!empty($dataSend['id'])){
				$conditions['id'] = $dataSend['id'];
			}else{
				return ['code'=> 0, 'mess'=>'<p class="text-danger"> Thiếu dữ liệu</p>'];
			}
			$user = $modelMembers->find()->where($conditions)->first();

			if(!empty($user)){
				$user->coin  +=  (int) $dataSend['total'];
				$modelMembers->save($user);

				// tạo lịch sử giao dịch
				$histories = $modelTransactionHistories->newEmptyEntity();

				$histories->id_member = $user->id;
				$histories->id_system = $user->id_system;
				$histories->coin = (int) $dataSend['total'];
				$histories->type = 'plus';
				$histories->note = 'Nạp số tiền là : '.number_format($histories->coin).'đ vào tài khoản, số dư tài khoản sau giao dịch là '.number_format($user->coin).'đ';
				$histories->create_at = time();

				$modelTransactionHistories->save($histories);



				return ['code'=> 1, 'mess'=>'<p class="text-success">Tài khoản này nạp tiền thành công</p>', 'data'=> $user];
			}
			return ['code'=> 0, 'mess'=>'<p class="text-danger"> số điện thoại này không tồn tại</p>'];
		}
		return ['code'=> 0, 'mess'=>'<p class="text-danger"> Thiếu dữ liệu</p>'];
	}

	return ['code'=> 0, 'mess'=>'<p class="text-danger"> chuyền phương thức POST</p>'];

}
 ?>
