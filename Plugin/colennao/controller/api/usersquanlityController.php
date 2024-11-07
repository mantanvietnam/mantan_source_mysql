<?php 

function updatequanlityusersAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $urlHomes;

    $metaTitleMantan = 'Danh sách thách thức';
    $modeluserquanlity = $controller->loadModel('usersquanlity');
    $modelUser = $controller->loadModel('Users');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();	
    	 if(!empty($dataSend['token'])){
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {
		    	$dataSend = $input['request']->getData();
                if(!empty($dataSend['day'])){
                    $date = $dataSend['day'];
                    $day =  $date;

                }
                $checkdate = $modeluserquanlity->find()->where(['id_users'=>$user->id,'day'=>$day])->first();
                if(empty($checkdate)){
                    $checkdate = $modeluserquanlity->newEmptyEntity(); 
                    $checkdate->id_users = $user->id;
                    $checkdate->day = $day;
                    $checkdate->water = 0;
                    $checkdate->workout = 0;
                    $checkdate->meal = 0;
                }
                if (isset($dataSend['water'])) {
                    $checkdate->water += (int) $dataSend['water'];
                }
        
                 if (isset($dataSend['meal'])) {
                    $checkdate->meal += (int) $dataSend['meal'];
                }
                 if (isset($dataSend['workout'])) {
                    $checkdate->workout += (int) $dataSend['workout'];
                }
                $modeluserquanlity->save($checkdate);
                return apiResponse(0, 'Tạo yêu câu thành công ', $checkdate);
			   
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
function getquanlityusersAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $urlHomes;

    $metaTitleMantan = 'Danh sách thách thức';
    $modeluserquanlity = $controller->loadModel('usersquanlity');
    $modelUser = $controller->loadModel('Users');

    if($isRequestPost){
    	$dataSend = $input['request']->getData();	
    	 if(!empty($dataSend['token'])){
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {
		    	$dataSend = $input['request']->getData();
                if(!empty($dataSend['day'])){
                    $date = $dataSend['day'];
                    $day =  $date;
                }
                if(!empty($checkdate = $modeluserquanlity->find()->where(['id_users'=>$user->id,'day'=>$day])->first())){
                    $checkdate = $modeluserquanlity->find()->where(['id_users'=>$user->id,'day'=>$day])->first();
                }else{
                    $checkdate = [
                        "data" => [
                            "id_users" => $user->id,
                            "day" => $day,
                            "water" => 0,
                            "meal" => 0,
                            "workout" => 0
                        ]
                    ];
                }
              
                return apiResponse(0, 'Tạo yêu câu thành công ', $checkdate);
			   
			}
			 return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
		} 
		return apiResponse(2, 'Gửi thiếu dữ liệu');  
	}
	 return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
?>