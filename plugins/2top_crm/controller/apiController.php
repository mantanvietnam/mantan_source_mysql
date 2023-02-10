<?php 
function saveCustomerAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$return = array('code'=>1,'set_attributes'=>array('id_customer'=>0));
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);

		if(!empty($dataSend['full_name']) && !empty($dataSend['phone'])){
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
    						);
    		$id_customer = addCustomer($dataCustomer);
    		
    		$return = array('code'=>0, 'set_attributes'=>array('id_customer'=>$id_customer));
		}
	}

	return $return;
}
?>