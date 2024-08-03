<?php 
// danh sách khóa học
function listCoursesCustomerAPI($input)
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
    $conditions= array('public'=>1);

    $limit = 12;
    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    $listData = $modelCourses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            if(!empty($value->id_category) && empty($category[$value->id_category])){
                $category[$value->id_category] = $modelCategories->find()->where(['id' => (int) $value->id_category])->first();
            }

            $listData[$key]->name_category = (!empty($category[$value->id_category]->name))?$category[$value->id_category]->name:'';
            $lessons = $modelLesson->find()->where(['id_course'=>$value->id])->all()->toList();
            $listData[$key]->number_lesson = count($lessons);
        }
    }

    // phân trang

    $totalData = $modelCourses->find()->where($conditions)->all()->toList();
    $totalData = count($totalData);
		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
        
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;

}


function getCoursesCustomerAPI($input)
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
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoCustomer = getCustomerByToken($dataSend['token']);

            if(!empty($infoCustomer)){

            	$modelLesson = $controller->loadModel('Lessons');
            	$modelCourses = $controller->loadModel('Courses');
            	$modelTests = $controller->loadModel('Tests');

            	$conditions = array('id'=>(int)$dataSend['id'],'public'=>1);
            		
            	


            	$data = $modelCourses->find()->where($conditions)->first();

            	if(!empty($data)){
            		$category = $modelCategories->find()->where(['id' => (int) $data->id_category])->first();    
            		$data->name_category = @$category->name;
	            // tăng lượt xem
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

	            // lấy số bài thi

            		$conditions = array('id_course'=>$data->id, 'id_lesson'=>0);

            		$order = array('id'=>'desc');



            		$tests = $modelTests->find()->where($conditions)->order($order)->all()->toList();

            		$data->tests = $tests;

            		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$data);
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

function getlessonCustomerAPI($input)
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
            $infoCustomer = getCustomerByToken($dataSend['token']);

            if(!empty($infoCustomer)){

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

		            // lấy số bài thi
		            $conditions = array('id_lesson'=>$data->id);
		            $order = array('id'=>'desc');
		            $tests = $modelTest->find()->where($conditions)->order($order)->all()->toList();

		            $data->test =$tests;
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

function gettTestCustomerAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;

    $modelTests = $controller->loadModel('Tests');
    $modelQuestions = $controller->loadModel('Questions');
    $modelHistoryTests = $controller->loadModel('Historytests');
    $modelCustomers = $controller->loadModel('Members');

     if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoCustomer = getCustomerByToken($dataSend['token']);

            if(!empty($infoCustomer)){

           		$conditions = array('id'=>(int)$dataSend['id']);
        		$data = $modelTests->find()->where($conditions)->order(['id' => 'DESC'])->first();



		        if(!empty($data)){

		            $conditionsSetting = array('key_word' => 'settingTraining2TOPCRM');
		            $settingTraining2TOPCRM = $modelOptions->find()->where($conditionsSetting)->first();
		            if(empty($settingTraining2TOPCRM)){

		                $settingTraining2TOPCRM = $modelOptions->newEmptyEntity();

		            }

		            $setting_value = array();
		            if(!empty($settingTraining2TOPCRM->value)){
		                $setting_value = json_decode($settingTraining2TOPCRM->value, true);
		            }

		            $conditionsQuestion = array('id_test'=>(int) $data->id);
		            $questions = $modelQuestions->find()->where($conditionsQuestion)->all()->toList();

		         
		            $point = 0;
		            $number_question = count($questions);
		            $answer_true= [];



		            if(!empty($questions)){
		                // đảo ngẫu nhiên câu hỏi
		                shuffle($questions);
		                foreach ($questions as $key => $value) {
		                    $answer_true[$value->id] = $value->option_true;
		                }
		            }

		            $data->questions = $questions;
		            $data->number_question = $number_question;
		            $data->setting_value = $setting_value;
       				$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$data);

            	}else{
            		$return = array('code'=>3, 'mess'=>'bai Kiểm tra không tồn tại');
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

function resultTestCustomerAPI($input){
	global $controller;
	global $isRequestPost;
	global $modelOptions;

	$modelTests = $controller->loadModel('Tests');
	$modelQuestions = $controller->loadModel('Questions');
	$modelHistoryTests = $controller->loadModel('Historytests');
	$modelCustomers = $controller->loadModel('Members');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id']) && !empty($dataSend['answer']) && !empty($dataSend['time_start'])){
			$infoCustomer = getCustomerByToken($dataSend['token']);
			$answer = json_decode($dataSend['answer'], true);
		
			
			if(!empty($infoCustomer)){
				$conditions = array('id'=>(int)$dataSend['id']);
        		$data = $modelTests->find()->where($conditions)->order(['id' => 'DESC'])->first();

		        if(!empty($data)){
					$conditionsQuestion = array('id_test'=>(int) $data->id);
	            	$questions = $modelQuestions->find()->where($conditionsQuestion)->all()->toList();
	            	$number_question = count($questions);
					$answer_true= [];

		            if(!empty($questions)){
		                // đảo ngẫu nhiên câu hỏi
		                shuffle($questions);
		                foreach ($questions as $key => $value) {
		                    $answer_true[$value->id] = $value->option_true;
		                }

		            }
					$submit = true;
					$point = 0;
					$total_true = 0;
					if(!empty($answer)){
						foreach ($answer as $idQuestion => $option_choose) {
							if($option_choose == $answer_true[(int)$idQuestion]){
								$total_true++;
							}
						}
					}

					$point = $total_true * 10/$number_question;

					

	                // lưu lịch sử thi
					$history = $modelHistoryTests->newEmptyEntity();
					$history->id_customer = @$infoCustomer->id;
					$history->id_test = $data->id;
					$history->point = $point;
					$history->total_true = $total_true;
					$history->number_question = $number_question;
					$history->time_start =  (int)strtotime(@$dataSend['time_start']);
					$history->time_end = time();
					if($point >= $data->point_min){
						$history->status = 'pass';
					}else{
						$history->status = 'fail';
					}
					// debug($history);
					// die;
					$modelHistoryTests->save($history);
					

	                // gửi thông báo cho smax.bot
					/*$idMessenger = @$_GET['idMessenger'];
					if(!empty($setting_value['idBot']) && !empty($setting_value['tokenBot']) && !empty($setting_value['idBlock']) && !empty($idMessenger) ){
						$attributesSmax['point_true'] = $total_true;
						$attributesSmax['point_total'] = $number_question;
						$attributesSmax['point'] = $point*10;
						$urlSmax = 'https://api.smax.bot/bots/' . $setting_value['idBot'] . '/users/' . $idMessenger . '/send?bot_token=' . $setting_value['tokenBot'] . '&block_id=' . $setting_value['idBlock'] . '&messaging_tag="CONFIRMED_EVENT_UPDATE"';
						$sendSmax = sendDataConnectMantan($urlSmax, $attributesSmax);
					}
					setVariable('answer', $dataSend['answer']);
					setVariable('answer_true', $answer_true);*/

					 $data->questions = $questions;
					 $data->answer = $answer;
		            $data->number_question = $number_question;
		            // $data->setting_value = $setting_value;
		            $data->history = $history;
       				$return = array('code'=>1, 'mess'=>'Kiểm tra thành công ', 'data'=>$data);
				}else{
            		$return = array('code'=>3, 'mess'=>'bai Kiểm tra không tồn tại');
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


 ?>
