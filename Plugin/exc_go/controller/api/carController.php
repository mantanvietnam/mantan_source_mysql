<?php 
function saveRegisterCarAPI($input){
 	global $isRequestPost;
	global $controller;
	global $session;

	$modelBookCar = $controller->loadModel('BookCars');
	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
		if(!empty($infoUser)){
			$book = $modelBookCar->newEmptyEntity();
			$book->id_member = $infoUser->id;
			$book->name_car = @$dataSend['name_car'];
			$book->license_plates = @$dataSend['license_plates'];
			$book->image = @$dataSend['image'];
			$book->type_car = @$dataSend['type_car'];
			$book->type_book = @$dataSend['type_book'];
			$book->price_min = @$dataSend['price_min'];
			$book->price_max = @$dataSend['price_max'];
			$book->status = @$dataSend['status'];
			$book->status = 0;
			$book->note = @$dataSend['note'];
			
			$book->created_at =  date('Y-m-d H:i:s');
			$book->updated_at =  date('Y-m-d H:i:s');

			$modelBookCar->save($book);
			$return= array('code'=>1,
							'book_code'=> $book->id,
							'mess' => 'bạn đặt xe thành công',
						);

		}else{
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}
	}
	return $return;
}


 ?>