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
			$book->location_first_point = @$dataSend['location_first_point'];
			$book->location_destination = @$dataSend['location_destination'];
			$book->distance = @$dataSend['distance'];
			$book->price = @$dataSend['price'];
			$book->status = 0;
			$book->note = @$dataSend['note'];
			$book->discount = @$dataSend['discount'];
			$book->created_at =  date('Y-m-d H:i:s');
			$book->updated_at =  date('Y-m-d H:i:s');

			$modelBookCar->save($book);
			$return= array('code'=>1;
							'book_code'=> $book->id;
							'mess' => 'bạn đặt xe thành công',
						);

		}else{
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}
	}
	return $return;
}
?>
