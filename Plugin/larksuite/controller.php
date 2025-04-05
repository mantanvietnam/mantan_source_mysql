<?php
	function settingLarkSuite($input)
	{
		$today= getdate();
    	global $modelOptions;
    	global $metaTitleMantan;
    	global $isRequestPost;
		$conditions = array('key_word' => 'lark_suite');
    	$data = $modelOptions->find()->where($conditions)->first();
	    if(!empty($data->value)){
	    	$static = json_decode(@$data->value, true);
	    }else{
	    	 $data = $modelOptions->newEmptyEntity();
	    }
    	$mess = '';
    
		if($isRequestPost){
			$dataSend = $input['request']->getData();
			$static = array('get_access_token'=>$dataSend['get_access_token'],
							'app_id'=> $dataSend['app_id'],
							'secret'=> $dataSend['secret'],
							'table_id'=> $dataSend['table_id'],
							'base_id'=> $dataSend['base_id'],
							'app_token'=> $dataSend['app_token'],
						);

				
			$data->value = json_encode($static);
			$data->key_word = 'lark_suite';
		

        	$modelOptions->save($data);
		}
			
		setVariable('mess',@$mess);
		setVariable('data',@$static);
	}
?>