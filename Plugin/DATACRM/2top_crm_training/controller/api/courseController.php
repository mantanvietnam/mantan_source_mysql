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
    global $modelCategoryConnects;

    $metaTitleMantan = 'Danh sách khóa học';

    $modelLesson = $controller->loadModel('Lessons');
    $modelCourses = $controller->loadModel('Courses');


	if($isRequestPost){
		$dataSend = $input['request']->getData();
		
	    $conditions= array('public'=>1);

	    if(!empty($dataSend['token'])){
	    	$infoCustomer = getCustomerByToken($dataSend['token']);
	    }

	    if(empty($infoCustomer)){
	    	$conditions['id_group_customer'] = 0;
	    }else{
	    	$listGroupCustomer = $modelCategoryConnects->find()->where(['keyword'=>'group_customers', 'id_parent'=>(int) $infoCustomer->id])->all()->toList();
	    	$listGroups = [0];

            if(!empty($listGroupCustomer)){
                foreach ($listGroupCustomer as $key => $value) {
                    $listGroups[] = $value->id_category;
                }
            }

	    	$conditions['id_group_customer IN']= $listGroups; 
	    }

	    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	    $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');

	    if(!empty($dataSend['name'])){
			$key=createSlugMantan($dataSend['name']);
			$conditions['slug LIKE']= '%'.$key.'%';
		}
		
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

function listCoursesPrivateCustomerAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategoryConnects;

    $metaTitleMantan = 'Danh sách khóa học';

    $modelLesson = $controller->loadModel('Lessons');
    $modelCourses = $controller->loadModel('Courses');


	  if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoCustomer = getCustomerByToken($dataSend['token']);

            if(!empty($infoCustomer)){
			    $conditions=  array();
			    $conditions['OR'][]= array('Courses.public'=>1); 

			    $conditions['OR'][]= array('Courses.public'=>2,'categoryConnects.id_parent'=>(int)$infoCustomer->id,'categoryConnects.keyword'=>'group_customers');
			   

			    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
			    $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
			    if($page<1) $page = 1;
			    $order = array('Courses.id'=>'desc');

			    if(!empty($dataSend['name'])){
					$key=createSlugMantan($dataSend['name']);
					$conditions['slug LIKE']= '%'.$key.'%';
				}

				 $join = [
                [
                    'table' => 'category_connects',
                    'alias' => 'categoryConnects',
                    'type' => 'LEFT',
                    'conditions' => [
                        'Courses.id_group_customer = categoryConnects.id_category'
                    ],
                ]
            ];

            $select = ['Courses.id','Courses.title','Courses.image','Courses.description','Courses.slug','Courses.view','Courses.youtube_code','Courses.id_category','Courses.status','Courses.content','Courses.id_group_customer','Courses.public'];

        

            $listData = $modelCourses->find()->join($join)->select($select)->limit($limit)->page($page)->where($conditions)->all()->toList();

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
			    $totalData = $modelCourses->find()->join($join)->where($conditions)->all()->toList();
			    $totalData = count($totalData);
				
				$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);       
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


function getCoursesCustomerAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $modelCategoryConnects;

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['id'])){
            // $infoCustomer = getCustomerByToken($dataSend['token']);

            // if(!empty($infoCustomer)){

            	$modelLesson = $controller->loadModel('Lessons');
            	$modelCourses = $controller->loadModel('Courses');
            	$modelTests = $controller->loadModel('Tests');
            	$conditions = array('id'=>(int)$dataSend['id'],'public >'=>0);
            	$data = $modelCourses->find()->where($conditions)->first();

            	if(!empty($data)){
            		/*if($data->public==2 ){
            			// if(!empty($data->id_group_customer)){
            				$checkUserCourses = $modelCategoryConnects->find()->where(['id_category'=>$data->id_group_customer,'keyword'=>'group_customers'])->all()->toList();
            				if(empty($checkUserCourses)){
            					return array('code'=>4, 'mess'=>'bạn không xem được Khóa học này');
            				}
            			// }else{
            				// return array('code'=>4, 'mess'=>'bạn không xem được Khóa học này');
            			// }
            		}*/
            		$category = $modelCategories->find()->where(['id' => (int) $data->id_category])->first();    
            		$data->name_category = @$category->name;
	            // tăng lượt xem
            		$data->view ++;
            		$modelCourses->save($data);
            		$conditions = array('id !='=>$data->id ,'public'=>1);
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

            		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$data);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
        	/*}else{
		        $return = array('code'=>3, 'mess'=>'Sai mã token');
		    }*/
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
	$modelHistoryLesson = $controller->loadModel('HistoryLessons');

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

		            $data->history_lesson = $modelHistoryLesson->find()->where(['id_lesson'=>$data->id, 'id_customer'=>$infoCustomer->id])->first();

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

function getTestCustomerAPI($input)
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
					$history->type = 'customer';
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

					if($history->status == 'pass'){
						$point = listPonint();
        				$note = 'bạn được công '.$point['point_complete_quiz'].'điểm khi hoàn thành bài thi trắc nghiệm ';
        				accumulatePoint($infoUser->id,$point['point_complete_quiz'],$note);
					}
					
					

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
		            $data->result = $history;
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


function historyTestCustomerAPI($input)
{
    global $controller;
    global $isRequestPost;


   $return = array('code'=>0);
    if($isRequestPost){

		$dataSend = $input['request']->getData();


		if(!empty($dataSend['token'])){
			$infoCustomer = getCustomerByToken($dataSend['token']);

			if(!empty($infoCustomer)){

		        $modelHistoryTests = $controller->loadModel('Historytests');
		        $modelTests = $controller->loadModel('Tests');
		        $conditions= array('id_customer'=> $infoCustomer->id, 'type'=>'customer');

		        $limit = 20;

		        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;

		        if($page<1) $page = 1;

		        $order = array('id'=>'desc');
		     
		        $listData = $modelHistoryTests->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		        if(!empty($listData)){
		            foreach ($listData as $key => $value) {
		                if(!empty($value->id_test) && empty($category[$value->id_test])){

		                    $category[$value->id_test] = $modelTests->find()->where(['id' => (int) $value->id_test])->first();

		                }
		                $listData[$key]->name_test = (!empty($category[$value->id_test]->title))?$category[$value->id_test]->title:'';

		            }

		        }
		        
		        // phân trang

		        $totalData = $modelHistoryTests->find()->where($conditions)->all()->toList();

		        $totalData = count($totalData);
		        $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
		    }else{
				$return = array('code'=>3, 'mess'=>'Sai mã token');
			}
		}else{
			$return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		}
	}else{
		$return = array('code'=>0, 'mess'=>' gửi sai kiểu POST');
	}

	return $return;
}

function saveHistoryLesson($input){
	global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategoryConnects;

    $metaTitleMantan = 'Danh sách khóa học';

    $modelLesson = $controller->loadModel('Lessons');
    $modelHistoryLesson = $controller->loadModel('HistoryLessons');


	if($isRequestPost){
		$dataSend = $input['request']->getData();

	    if(!empty($dataSend['token']) && !empty($dataSend['id']) && !empty($dataSend['minute'])){
	    	$infoCustomer = getCustomerByToken($dataSend['token']);
	    	if(!empty($infoCustomer)){
	    		$conditions = array('id_lesson'=>(int)$dataSend['id'], 'id_customer'=>$infoCustomer->id);
	    		$data = $modelHistoryLesson->find()->where($conditions)->first();
	    		if(empty($data)){
	    			$data = $modelHistoryLesson->newEmptyEntity();
	    			$data->id_lesson = (int)$dataSend['id'];
	    			$data->id_customer = $infoCustomer->id;
	    		}

	    		$data->minute = $dataSend['minute'];
				$data->created_at = time();
				$modelHistoryLesson->save($data);


	    		return array('code'=>1, 'mess'=>'lưu dữ liệu thành công ', 'data'=>$data);
		    }
			return  array('code'=>3, 'mess'=>'Sai mã token');
			
		}
		return array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
	}
	return array('code'=>0, 'mess'=>' gửi sai kiểu POST');
}




 ?>
