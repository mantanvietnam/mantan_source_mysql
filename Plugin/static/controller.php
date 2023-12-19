<?php
	function settingStatic($input)
	{
		$today= getdate();
    	global $modelOptions;
    	global $metaTitleMantan;
    	global $isRequestPost;
		$conditions = array('key_word' => 'Static');
    	$data = $modelOptions->find()->where($conditions)->first();
	    if(!empty($data->value)){
	    	$static = json_decode(@$data->value, true);
	    }else{
	    	 $data = $modelOptions->newEmptyEntity();
	    }
    	$mess = '';
    
		if($isRequestPost){
			$dataSend = $input['request']->getData();
			$today= getdate();
			
			$static = array('mday'=> (int) $dataSend['mday'],
							'mon'=> (int) $dataSend['mon'],
							'total'=> (int) $dataSend['total'],
							'oldMon'=> $today['mon'],
							'oldMday'=> $today['mday'],
						);

				
			$data->value = json_encode($static);
			$data->key_word = 'Static';
		

        	$modelOptions->save($data);
		}
			
		setVariable('mess',@$mess);
		setVariable('data',$static);
	}
?>