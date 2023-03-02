<?php 
function saveDonateAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$return = array('code'=>1,
					'messages'=>array('text'=>'')
				);

	$modelCustomer = $controller->loadModel('Customers');
	$modelDonate = $controller->loadModel('Donates');
	$modelCharity = $controller->loadModel('Charities');
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(!empty($dataSend['full_name']) && !empty($dataSend['phone']) && !empty($dataSend['id_charity'])){
			$conditions = array('phone'=>$dataSend['phone']);
            $info_customer = $modelCustomer->find()->where($conditions)->first();

            if(empty($info_customer)){
            	if(!empty($dataSend['sex'])){
					$dataSend['sex'] = strtolower($dataSend['sex']);

					if($dataSend['sex']=='male') $dataSend['sex']=1;
					if($dataSend['sex']=='female') $dataSend['sex']=0;
				}

				if(empty($dataSend['id_city'])) $dataSend['id_city']=1;
				if(empty($dataSend['status'])) $dataSend['status']='active';
				if(empty($dataSend['pass'])) $dataSend['pass']= $dataSend['phone'];
				if(empty($dataSend['id_parent'])) $dataSend['id_parent']= 0;
				if(empty($dataSend['id_level'])) $dataSend['id_level']= 0;

				if(empty($dataSend['birthday'])) $dataSend['birthday']='0/0/0';
				$birthday_date = 0;
				$birthday_month = 0;
				$birthday_year = 0;

				$birthday = explode('/', trim($dataSend['birthday']));
				if(count($birthday)==3){
					$birthday_date = (int) $birthday[0];
					$birthday_month = (int) $birthday[1];
					$birthday_year = (int) $birthday[2];
				}

                $dataCustomer = array(	'full_name'=>$dataSend['full_name'],
	    								'phone'=>$dataSend['phone'],
	    								'email'=>@$dataSend['email'],
	    								'address'=>@$dataSend['address'],
	    								'sex'=>@$dataSend['sex'],
	    								'id_city'=>@$dataSend['id_city'],
	    								'id_messenger'=>@$dataSend['id_messenger'],
	    								'avatar'=>@$dataSend['avatar'],
	    								'status'=>@$dataSend['status'],
	    								'pass'=>@$dataSend['pass'],
	    								'id_parent'=>@$dataSend['id_parent'],
	    								'id_level'=>@$dataSend['id_level'],
	    								
	    								'birthday_date'=>(int) @$birthday_date,
	    								'birthday_month'=>(int) @$birthday_month,
	    								'birthday_year'=>(int) @$birthday_year,
	    						);
	    		$id_customer = addCustomer($dataCustomer);

	    		$info_customer = $modelCustomer->get($id_customer);
            }

			if(!empty($info_customer)){
				$dataDonate = $modelDonate->newEmptyEntity();

				// tạo dữ liệu save
		        $dataDonate->id_charity = $dataSend['id_charity'];
		        $dataDonate->coin = (int) @$dataSend['coin'];
		        $dataDonate->note = (string) @$dataSend['note'];
		        $dataDonate->image = (string) @$dataSend['image'];
		        
		        $dataDonate->full_name = $dataSend['full_name'];
		        $dataDonate->phone = $dataSend['phone'];
		        $dataDonate->email = (!empty($dataSend['email']))?$dataSend['email']:$info_customer->email;
		        $dataDonate->avatar = (!empty($dataSend['avatar']))?$dataSend['avatar']:$info_customer->avatar;
		        $dataDonate->id_customer = $info_customer->id;

		        $modelDonate->save($dataDonate);

		        // cập nhập lại số tiền của chương trình từ thiện
		        $infoCharity = $modelCharity->get( (int) $dataSend['id_charity']);
		        if(!empty($infoCharity)){
		        	$infoCharity->person_donate ++;
		        	$infoCharity->money_donate += $dataSend['coin'];

		        	$modelCharity->save($infoCharity);
		        }
			}
    		
    		$return = array('code'=>0, 
    						'set_attributes'=>array('id_customer'=>$info_customer->id),
    						'messages'=>array('text'=>'Lưu thông tin thành công')
    					);
		}else{
			$return = array('code'=>2,
					'set_attributes'=>array('id_customer'=>0),
					'messages'=>array('text'=>'Gửi thiếu dữ liệu')
				);
		}
	}

	return $return;
}
?>