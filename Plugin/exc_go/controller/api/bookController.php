<?php 
function bookCarAPI($input){
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
			$book->customer_id = $infoUser->id;
			$book->time_book = @$dataSend['time_book'];
			$book->first_point = @$dataSend['first_point'];
			$book->destination = @$dataSend['destination'];
			$book->long_first_point = @$dataSend['long_first_point'];
			$book->long_destination = @$dataSend['long_destination'];
			$book->lat_first_point = @$dataSend['lat_first_point'];
			$book->lat_destination = @$dataSend['lat_destination'];
			$book->distance = @$dataSend['distance'];
			$book->price = @$dataSend['price'];
			$book->status = 0;
			$book->note = @$dataSend['note'];
			$book->discount = @$dataSend['discount'];
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

function receiveVisitorAPI($input){
 	global $isRequestPost;
	global $controller;
	global $session;

	$modelBookCar = $controller->loadModel('BookCars');
	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token'], 'type'=>1))->first();
		if(!empty($infoUser)){
			$book = $modelBookCar->find()->where(array('id'=>$dataSend['idBook']))->first();
			if(!empty($book)){
				$book->driver_id = $infoUser->id;
				$book->status = 1;
				$book->updated_at =  date('Y-m-d H:i:s');

				$modelBookCar->save($book);
				$customer = $modelMember->find()->where(array('id'=>$book->customer_id))->first();
				if(!empty($book)){
					$book->customer = $customer;
				}
				$return= array('code'=>1,
								'data'=> $book,
								'mess' => 'bạn nhận quốc xe thành công',
							);
			}else{
				$return = array('code'=>3, 'mess'=>'idBook bị sai');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}
	}
	return $return;
}

function listBookAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelBookCar = $controller->loadModel('BookCars');

	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$infoUser = $modelMember->find()->where(array('token'=>$dataSend['token'], 'type'=>1))->first();
		if(!empty($infoUser)){
			$book = $modelBookCar->find()->where(array('id'=>$dataSend['idBook']))->all()->toList();
			if(!empty($book)){
				
				$return= array('code'=>1,
								'data'=> $book,
								'mess' => 'bạn lấy data thành công',
							);
			}else{
				$return = array('code'=>3, 'mess'=>'chưa có data');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}
	}
	return $return;
}



?>
