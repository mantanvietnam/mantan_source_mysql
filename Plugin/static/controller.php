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
    
		if($isRequestPost){
			$dataSend = $input['request']->getData();
			 $static = array('mday'=> (int) $dataSend['mday'],
			'mon'=> (int) $dataSend['mon'],
			'total'=> (int) $dataSend['total']);

				
			$data->value = json_encode($static);
			$data->key_word = 'Static';
		

        	$modelOptions->save($data);
		}
			
			setVariable('mess',@$mess);
			setVariable('data',$static);
	}
?>