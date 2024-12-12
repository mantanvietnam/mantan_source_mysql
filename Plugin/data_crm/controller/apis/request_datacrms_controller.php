<?php
function saveRequestCreateDataCRMAPI($input)
{
	global $isRequestPost;
	global $controller ;

	$modelRequestDatacrms = $controller->loadModel('RequestDatacrms');

	$return['messages']= array(array('text'=>'Gửi sai kiểu POST'));

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['system_name']) && !empty($dataSend['boss_name']) && !empty($dataSend['boss_phone']) && !empty($dataSend['boss_email'])){
			$dataSend['system_name'] = substr($dataSend['system_name'], 0, 30);
			
			$system_slug = createSlugMantan(str_replace([' ',',','.','_','-'], '', $dataSend['system_name']));
			$system_slug_old = $system_slug;

			$checkSlug = $modelRequestDatacrms->find()->where(['system_slug'=>$system_slug])->first();

			if(!empty($dataSend['password']) && !empty($dataSend['password_again'])){
				if($dataSend['password']==$dataSend['password_again']){
					$password = md5($dataSend['password']);
				}else{
					return ['messages' => array(array('text'=>'Mật khẩu nhập lại chưa đúng!'))];
				}
			}else{
				$password = 'e10adc3949ba59abbe56e057f20f883e';
			}
			

			if(!empty($checkSlug)){
				$number = 0;
				do{
					$number ++;
					$system_slug = $system_slug_old.$number;

					$checkSlug = $modelRequestDatacrms->find()->where(['system_slug'=>$system_slug])->first();
				}while(!empty($checkSlug));
				
			}

			$data = $modelRequestDatacrms->newEmptyEntity();

			$data->status = 'new';
			$data->system_name = trim($dataSend['system_name']);
			$data->system_slug = $system_slug;
			$data->password = $password;
			$data->system_logo = 'https://crm.phoenixcamp.vn/upload/admin/files/Logo.png';
			$data->boss_name = $dataSend['boss_name'];
			$data->boss_phone = $dataSend['boss_phone'];
			$data->boss_email = $dataSend['boss_email'];
			$data->boss_id_messenger = @$dataSend['boss_id_messenger'];
			$data->boss_avatar = (!empty($dataSend['boss_avatar']))?$dataSend['boss_avatar']:'https://crm.phoenixcamp.vn/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png';
			$data->domain = $system_slug.'.icham.vn';
			$data->create_at = time();
			$data->deadline = $data->create_at + 30*24*60*60;
			$data->user_db = 'datacrm_'.$data->system_slug;
			$data->pass_db = createPass(15);
			

			$modelRequestDatacrms->save($data);

			// đưa yêu cầu tạo tài khoản lên rabbitmq
			$rabbitMQClient = new RabbitMQClient();

            $requestMessage = json_encode([ 'id_request' => $data->id ]);
            
            $rabbitMQClient->sendMessage('create_account_icham', $requestMessage);

			$return['messages']= array(array('text'=>'Hệ thống đang tạo tài khoản cho bạn, vui lòng đợi ít phút'));
		}else{
			$return['messages']= array(array('text'=>'Gửi thiếu dữ liệu'));
		}
	}

	return $return;
}

function createDataCRMAPI($input)
{
	global $isRequestPost;
	global $controller ;

	$modelRequestDatacrms = $controller->loadModel('RequestDatacrms');

	$data = $modelRequestDatacrms->find()->where(['status'=>'new'])->first();

	if(!empty($data)){
		// tạo tên miền
		$domain = $data->system_slug.'.icham.vn';
		echo createDomain($domain);

		// tải code zip
		echo downloadCode($domain);

		// tạo databse
		$db_password = $data->pass_db;
		echo createDatabase($domain, $data->system_slug, $db_password);

		// import database
		echo importData($domain, $data->user_db, $db_password, $data);

		// lưu lại trạng thái
		$data->status = 'done';
		$modelRequestDatacrms->save($data);

		// gửi thông báo Mess
		if(!empty($data->boss_id_messenger)){
			/*
			// page phoenix tech
			$idBot = '6633df29cec63d36a4ed6e16';
			$tokenBot = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2MzNkZjI5Y2VjNjNkMzZhNGVkNmUxNiIsIm5hbWUiOiJCTEFOSyBCT1QgLSBDb3B5IiwiaWF0IjoxNzE0Njc1NDk3LCJleHAiOjIwMzAwMzU0OTd9.3VULeYKNscvvpdTYZzab2QD_LoTSZvTfGn09QNlJXnM';
			$idBlockRegDataCRM = '664e6fa65129b0f1c1e41bfc';
			*/

			// page iCham
			$idBot = '6690d7fbd6f147a3339288fc';
			$tokenBot = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2OTBkN2ZiZDZmMTQ3YTMzMzkyODhmYyIsIm5hbWUiOiJCTEFOSyBCT1QgLSBDb3B5IiwiaWF0IjoxNzIwNzY4NTA3LCJleHAiOjIwMzYxMjg1MDd9.gWFU7cc8xjAZzctTwdKXsyLNlUMbUv32SF7TiEu3owA';
			$idBlockRegDataCRM = '6690d886bf4f95e96aab9d3f';

			$attributesSmax = [];
            $attributesSmax['linkDataCRM']= 'https://'.$domain;
            
            $urlSmax= 'https://api.smax.bot/bots/'.$idBot.'/users/'.$data->boss_id_messenger.'/send?bot_token='.$tokenBot.'&block_id='.$idBlockRegDataCRM.'&messaging_tag="CONFIRMED_EVENT_UPDATE"';
            
            $returnSmax= sendDataConnectMantan($urlSmax, $attributesSmax);
		}

		//return $controller->redirect('/createDataCRMAPI');
	}
	

	return [];
}

function getListSystemCRMAPI($input)
{
	global $isRequestPost;
	global $controller ;

	$modelRequestDatacrms = $controller->loadModel('RequestDatacrms');

	$listData = [];

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && $dataSend['token']=='2MzNkZjI5Y2VjNjNkMzZhNGVkNmUxNiIsIm5hbWUiOi'){
			$listData = $modelRequestDatacrms->find()->where(['deadline >'=>time(), 'status'=>'done'])->all()->toList();
		}
	}

	return $listData;
}

function extendMemberDeadlineAPI($input)
{
	global $isRequestPost;
	global $controller ;

	$modelRequestDatacrms = $controller->loadModel('RequestDatacrms');

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['id']) && !empty($dataSend['deadline'])){
			$data = $modelRequestDatacrms->find()->where(['id'=>(int) $dataSend['id']])->first();

			if(!empty($data) && $data->boss_phone == $dataSend['phone']){
				$deadline = explode('/', $dataSend['deadline']);

				$data->deadline = mktime(23, 59, 59, $deadline[1], $deadline[0], $deadline[2]);

				$modelRequestDatacrms->save($data);
			}
		}
	}

	return ['code'=>1];
}

function updateLastLoginBossAPI($input){
	global $isRequestPost;
	global $controller ;

	$modelRequestDatacrms = $controller->loadModel('RequestDatacrms');

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['boss_phone'])){
			$data = $modelRequestDatacrms->find()->where(['boss_phone'=>$dataSend['boss_phone']])->first();
			if(!empty($data)){
				$data->last_login = time();
				$modelRequestDatacrms->save($data);
			}
		}
	}

	return ['code'=>1];
}

function updatePHPVersionAPI($input)
{
	global $modelOptions;

	$conditions = array('key_word' => 'updatePHPVersion');
    $data = $modelOptions->find()->where($conditions)->first();
    
    $listFile = json_decode($data->value, true);
    $return = [];

    if(!empty($listFile)){
    	$dem = 0;
        foreach ($listFile as $key => $domain) {
        	$dem++;
            if($dem<=1){
                updatePHPVersion($domain, '2');
                $return[] = $domain;

                unset($listFile[$key]);
            }
        }

        $data->value = json_encode($listFile);

        $modelOptions->save($data);
    }

    return $return;
}
?>