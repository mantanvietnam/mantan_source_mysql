<?php 
function updateBankingAPI($input)
{
	global $modelOptions;
	$return['messages']= array(array('text'=>''));

	if(!empty($_POST['message']) && !empty($_POST['key'])){

	 	$keyApp = strtoupper($_POST['key']);
		$message = strtoupper($_POST['message']);

		$description = explode('ND: ', $message);
		$description = trim($description[1]);
		$description = str_replace(array('IBFT ','THANH TOAN QR ','QR - '), '', $description);

		$money = explode('PS:+', $message);
		$money = explode('SD:', $money[1]);
		$money = (int) str_replace(array('.','VND'), '', $money[0]);

		if($money>0 && strlen(strstr($description, $keyApp)) > 0){
			// xóa dấu chấm
			$removeDot = explode('.', $description);
			if(count($removeDot)>1){
				for($i=0;$i<count($removeDot);$i++){
					if(strlen(strstr($removeDot[$i], $keyApp)) > 0){
						$description = $removeDot[$i];
						break;
					}
				}
			}

			// xóa dấu chấm phẩy
			$removeDot = explode(';', $description);
			if(count($removeDot)>1){
				for($i=0;$i<count($removeDot);$i++){
					if(strlen(strstr($removeDot[$i], $keyApp)) > 0){
						$description = $removeDot[$i];
						break;
					}
				}
			}

			// xóa dấu gạch ngang
			$removeDot = explode('-', $description);
			if(count($removeDot)>1){
				for($i=0;$i<count($removeDot);$i++){
					if(strlen(strstr($removeDot[$i], $keyApp)) > 0){
						$description = $removeDot[$i];
						break;
					}
				}
			}


			$removeSpace = explode(' ', trim($description));
			$phone = $removeSpace[1];

			$mess = process_add_money($money, $phone);
			
			$return['messages']= array(array('text'=>$mess));
		} else {
			$return['messages']= array(array('text'=>'Sai cú pháp hoặc số tiền không đủ'));
		}
   	 	
	}else{
		$return['messages']= array(array('text'=>'Gửi thiếu nội dung SMS'));
	}

	return $return;
}
?>