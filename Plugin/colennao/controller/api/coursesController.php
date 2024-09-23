<?php 
function listCoursesAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách khóa học';

    $modelLesson = $controller->loadModel('Lessons');
    $modelCourses = $controller->loadModel('Courses');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
	    $conditions= array('public'=>0);
	    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	    $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');

	    if(!empty($dataSend['title'])){
			$key=createSlugMantan($dataSend['title']);
			$conditions['slug LIKE']= '%'.$key.'%';
		}
	    $listData = $modelCourses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    // if(!empty($listData)){
	    //     foreach ($listData as $key => $value) {
	    //         if(!empty($value->id_category) && empty($category[$value->id_category])){
	    //             $category[$value->id_category] = $modelCategories->find()->where(['id' => (int) $value->id_category])->first();
	    //         }

	    //         $listData[$key]->name_category = (!empty($category[$value->id_category]->name))?$category[$value->id_category]->name:'';
	    //         $lessons = $modelLesson->find()->where(['id_course'=>$value->id])->all()->toList();
	    //         $listData[$key]->number_lesson = count($lessons);
	    //     }
	    // }
	    // phân trang
	    $totalData = $modelCourses->find()->where($conditions)->all()->toList();
	    $totalData = count($totalData);
		
		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
	        
	}else{
	    $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
	}

    return $return;

	
}
function getCoursesAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['id'])){
            	$modelLesson = $controller->loadModel('Lessons');
            	$modelCourses = $controller->loadModel('Courses');
            	$conditions = array('id'=>(int)$dataSend['id']);	
            	$data = $modelCourses->find()->where($conditions)->first();
            	if(!empty($data)){
            		$category = $modelCategories->find()->where(['id' => (int) $data->id_category])->first();    
            		$data->name_category = @$category->name;
            		$data->view ++;
            		$modelCourses->save($data);
            		$conditions = array('id !='=>$data->id);
            		$limit = 4;
            		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            		if($page<1) $page = 1;
            		$order = array('id'=>'desc');
            		$otherData = $modelCourses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            		if(!empty($otherData)){
            			$category = [];
            			foreach ($otherData as $key => $value) {
            				if(!empty($value->id_category) && empty($category[$value->id_category])){
            					$category[$value->id_category] = $modelCategories->find()->where(['id' => (int) $value->id_category])->first();
            				}
            				$otherData[$key]->name_category = (!empty($category[$value->id_category]->name))?$category[$value->id_category]->name:'';
            				$lessons = $modelLesson->find()->where(['id_course'=>$value->id])->all()->toList();
            				$otherData[$key]->number_lesson = count($lessons);
            			}
            		}
            		$data->otherData = $otherData;
	            // lấy số bài học
            		$conditions = array('id_course'=>$data->id);
            		$order = array('id'=>'desc');
            		$lesson = $modelLesson->find()->where($conditions)->order($order)->all()->toList();
            		$data->lesson = $lesson;

            		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$data);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
function getlessonAPI($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;

    $modelLesson = $controller->loadModel('Lessons');
	$modelTest = $controller->loadModel('Tests');

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $inforuser = getUserByToken($dataSend['token']);

            if(!empty($inforuser)){

		        $conditions = array('id'=>(int)$dataSend['id']);
		        $data = $modelLesson->find()->where($conditions)->first();
		        if(!empty($data)){

		            $metaTitleMantan = $data->title;

		            // tăng lượt xem
		            $data->view ++;
		            $modelLesson->save($data);

		            $conditions = array('id !='=>$data->id);
		            $limit = 4;
		            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		            if($page<1) $page = 1;
		            $order = array('id'=>'desc');

		            $otherData = $modelLesson->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		            $data->otherData =$otherData;

					$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$data);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
			}else{
		        $return = array('code'=>3, 'mess'=>'Sai mã token');
		    }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}


function paymentCourseAPI($input){
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $transactionKey;

    $modelCourses = $controller->loadModel('Courses');
    $modelUserCourse = $controller->loadModel('UserCourses');
    $modelTransactions = $controller->loadModel('Transactions');

    $modelTipChallenges = $controller->loadModel('TipChallenges');

    if($isRequestPost){
        $dataSend = $input['request']->getData();
         if (!empty($dataSend['token']) && !empty($dataSend['id_course'])) {
            $user = getUserByToken($dataSend['token']);

            
            if (!empty($user)) {
            $conditions = array('id'=>(int) $dataSend['id_course'],'status'=>'active');
            
            $data = $modelCourses->find()->where($conditions)->first();

            $checkCourse = $modelUserCourse ->find()->where(array('id_course'=>(int) $dataSend['id_course'],'id_user'=>$user->id))->first();
            if(!empty($checkCourse)){
                return apiResponse(4, 'bạn mua khóa học này rồi');
            }

            if(!empty($data)){
                $checkTransaction = $modelTransactions->find()->where(['id_course'=>$data->id,'id_user'=>$user->id])->first();
                if(empty($checkTransaction)){
                    $checkTransaction = $modelTransactions->newEmptyEntity();
                    $checkTransaction->id_user = $user->id;
                    $checkTransaction->name = $data->title;
                    $checkTransaction->total = $data->price;
                    $checkTransaction->id_course = $data->id;
                    $checkTransaction->id_challenge = 0;
                    $checkTransaction->status = 1;
                    $checkTransaction->type = 1;
                    $checkTransaction->created_at = time();
                    $checkTransaction->updated_at = time();
                    $checkTransaction->code = time().$user->id.rand(0,10000);

                    $modelTransactions->save($checkTransaction);

                }
                $bank = getBankAccount();

                $sms = $checkTransaction->id.' '.$transactionKey;

                $link_qr_bank = 'https://img.vietqr.io/image/'.$bank['bank_code'].'-'.$bank['bank_number'].'-compact2.png?amount='.$data->price.'&addInfo='.$sms.'&accountName='.$bank['bank_name'];
                $data->infoQR =   array('name_bank'=>$bank['bank_code'],
                                'account_holders_bank'=>$bank['bank_name'],
                                'link_qr_bank'=>$link_qr_bank,
                                'money'=>$bank['bank_number'],
                                'content'=>$sms,
                                'money'=>$data->price
                            );

  
            }
       
            
            return apiResponse(0, 'Tạo yêu câu thành công công', $data);
            }
            return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        } 
        return apiResponse(2, 'Gửi thiếu dữ liệu');  
    }
    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}


function listUserCourseAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

     $modelCourses = $controller->loadModel('Courses');
    $modelUserCourse = $controller->loadModel('UserCourses');
    $modelTransactions = $controller->loadModel('Transactions');

    $modelTipChallenges = $controller->loadModel('TipChallenges');

    if($isRequestPost){
        $dataSend = $input['request']->getData();   
         if(!empty($dataSend['token'])){
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {
                $dataSend = $input['request']->getData();
                $conditions = array('id_user'=> $user->id);
                $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
                $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
                if ($page < 1) $page = 1;
                if (!empty($dataSend['id']) && is_numeric($dataSend['id'])) {
                    $conditions['id'] = $dataSend['id'];
                }

                if (!empty($dataSend['title'])) {
                    $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
                }

                
                $data = $modelUserCourse->find()->where($conditions)->order(['id' => 'desc'])->all()->toList();

                $listData = array();
                if(!empty($data)){
                    foreach ($data as $key => $value) {
                        $Challenge = $modelCourses->find()->where(array('id'=> $value->id_course))->first();
                        if(!empty($Challenge)){
                            $lessons = json_decode($value->status_lesson, true);
                            $Challenge->total_lesson = count($lessons);
                            $total_lesson_view = 0;
                            foreach($lessons as $key => $item){
                                if($item['status']=='done'){
                                    $total_lesson_view++;
                                }
                            }
                            $Challenge->total_lesson_done = $total_lesson_view;

                            $listData[]=  $Challenge;
                        }
                    }
                }

                    
                return apiResponse(0, 'lấy dữ liệu thành công', $listData);
            }
             return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        } 
        return apiResponse(2, 'Gửi thiếu dữ liệu');  
    }
     return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getUserCourseAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $modelCourses = $controller->loadModel('Courses');
    $modelUserCourse = $controller->loadModel('UserCourses');
    $modelTransactions = $controller->loadModel('Transactions');
    $modelLesson = $controller->loadModel('Lessons');
    $modelTipChallenges = $controller->loadModel('TipChallenges');

    if($isRequestPost){
        $dataSend = $input['request']->getData();   
         if(!empty($dataSend['token']) && !empty($dataSend['id_course'])){
            $user = getUserByToken($dataSend['token']);
            if(!empty($user)){
                $conditions = array('id_user'=> $user->id);
              
                $conditions['id_course'] = (int) $dataSend['id_course'];

                if (!empty($dataSend['title'])) {
                    $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
                }

                
                $data = $modelUserCourse->find()->where($conditions)->first();

                if(!empty($data)){
                    $course = $modelCourses->find()->where(array('id'=> $data->id_course))->first();
                    if(!empty($course)){

                        $lessons = json_decode($data->status_lesson, true);
                            $data->total_lesson = count($lessons);
                            $total_lesson_view = 0;
                        if(!empty($lessons)){
                             foreach($lessons as $key => $item){
                                if($item['status']=='done'){
                                    $total_lesson_view++;

                                }
                                $lesson = $modelLesson->find()->where(['id'=>(int)$item['id'],'id_course'=>$course->id])->first();

                                $lesson->status_lesson = $item['status'];

                                $lessons[$key] = $lesson;
                            }
                        }
                           
                        $data->total_lesson_done = $total_lesson_view;
                        
                        $data->lesson = $lessons;

                        $data->course =  $course;
                        
                        return apiResponse(0, 'lấy dữ liệu thành công', $data);
                    }
                    return apiResponse(4, 'Khóa học này không tồn tại');
                    
                }
                return apiResponse(5, 'bạn chưa mua khóa học này');
                
            }
             return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        } 
        return apiResponse(2, 'Gửi thiếu dữ liệu');  
    }
     return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getLessonUserCourseAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $modelCourses = $controller->loadModel('Courses');
    $modelUserCourse = $controller->loadModel('UserCourses');
    $modelLesson = $controller->loadModel('Lessons');

    if($isRequestPost){
        $dataSend = $input['request']->getData();   
         if(!empty($dataSend['token']) && !empty($dataSend['id_course']) && !empty($dataSend['id_lesson'])){
            $user = getUserByToken($dataSend['token']);
            if(!empty($user)){
                $conditions = array('id_user'=> $user->id);
              
                $conditions['id_course'] = (int) $dataSend['id_course'];

                if (!empty($dataSend['title'])) {
                    $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
                }

                
                $data = $modelUserCourse->find()->where($conditions)->first();

                if(!empty($data)){
                    $course = $modelCourses->find()->where(array('id'=> $data->id_course))->first();
                    if(!empty($course)){
                        if(!empty($data->status_lesson)){
                            $status_lesson = json_decode($data->status_lesson, true);
                            foreach($status_lesson as $key => $item){
                                if($item['id']==$dataSend['id_lesson']){
                                     $lesson = $modelLesson->find()->where(['id'=>(int)$item['id'],'id_course'=>$course->id])->first();

                                $lesson->status_lesson = $item['status'];

                                $data->lesson = $lesson;
                                }
                            }
                        }
                        
                        return apiResponse(0, 'lấy dữ liệu thành công', $data);
                    }
                    return apiResponse(4, 'khóa học này không tồn tại');
                    
                }
                return apiResponse(4, 'bạn chưa mua khóa học này');
                
            }
             return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        } 
        return apiResponse(2, 'Gửi thiếu dữ liệu');  
    }
     return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function updateStatusLessonUserCourseAPI($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $modelCourses = $controller->loadModel('Courses');
    $modelUserCourse = $controller->loadModel('UserCourses');
    $modelLesson = $controller->loadModel('Lessons');


    if($isRequestPost){
        $dataSend = $input['request']->getData();   
         if(!empty($dataSend['token']) && !empty($dataSend['id_course']) && !empty($dataSend['id_lesson']) && !empty($dataSend['status'])){
            $user = getUserByToken($dataSend['token']);
            if(!empty($user)){
                $conditions = array('id_user'=> $user->id);
              
                $conditions['id_course'] = (int) $dataSend['id_course'];

                if (!empty($dataSend['title'])) {
                    $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
                }

                
                $data = $modelUserCourse->find()->where($conditions)->first();
                $Lessons = array();
                if(!empty($data)){
                    $course = $modelCourses->find()->where(array('id'=> $data->id_course))->first();
                    if(!empty($course)){
                        if(!empty($data->status_lesson)){

                            $Lesson = json_decode($data->status_lesson, true);
                            foreach($Lesson as $key => $item){
                                if($item['id']==$dataSend['id_lesson']){
                                    $item['status'] = $dataSend['status'];

                                    $Lesson[$key] =  $item;

                                    $Lessons = $modelLesson->find()->where(['id'=>(int)$item['id'],'id_course'=>$course->id])->first();

                                    $Lessons->status_lesson = $item['status'];

                                    $Lessons = $Lessons;
                                }
                            }
                            $data->status_lesson = json_encode($Lesson);

                        }

                        $modelUserCourse->save($data);
                        $data->lesson = $Lessons; 
                        
                        return apiResponse(0, 'cập nhập dữ liệu thành công', $data);
                    }
                    return apiResponse(4, 'khóa học này không tồn tại');
                    
                }
                return apiResponse(4, 'bạn chưa mua khóa học này');
                
            }
             return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        } 
        return apiResponse(2, 'Gửi thiếu dữ liệu');  
    }
     return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}



?>