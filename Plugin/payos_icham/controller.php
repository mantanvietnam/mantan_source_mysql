<?php
function addMoneyPayOSBankAPI($input)
{
    global $controller;
	$json = file_get_contents('php://input');

	$data = json_decode($json, true);
    $modelRequestDatacrms = $controller->loadModel('RequestDatacrms');

	if(!empty($data['data'])){
		$datas =$data['data'];
		$id_ransaction = explode(" ", $datas['description']);
        $total = count($id_ransaction);
        $ransaction = 0;
        if($total==2){
            $phoneboss = $id_ransaction[0];
            $id = $id_ransaction[1];
        }elseif($total==3){
            $phoneboss = $id_ransaction[1];
            $id = $id_ransaction[2];
        }

        if(!empty($datas['amount']) && !empty($phoneboss) && !empty($id)){
            $boss = $modelRequestDatacrms->find()->where(['boss_phone'=>$phoneboss])->first();

            if(!empty($boss->domain)){
                $check_id = explode("Y", $id);
                $check_total = count($check_id);
                if($check_total==1){
                    $dataPost= array('total'=>$datas['amount'], 'id'=>$check_id[0]);
                    $info = sendDataConnectMantan('https://'.$boss->domain.'/apis/addMoneyToIcham', $dataPost);
                    $info = str_replace('ï»¿', '', utf8_encode($info));
                    $info = json_decode($info, true);
                }elseif($check_total==2){
                    $dataPost= array('id'=>$check_id[0]);
                    $info = sendDataConnectMantan('https://'.$boss->domain.'/apis/getInfoMemberMyAPI', $dataPost);
                    $info = str_replace('ï»¿', '', utf8_encode($info));
                    $info = json_decode($info, true);
                    if(!empty($check_id[1])){
                        $year =0;
                        if($check_id[1]==1 && $datas['amount']==1000000){
                             $year =1;
                        }elseif($check_id[1]==3 && $datas['amount']==5000000){
                             $year =3;
                        }elseif($check_id[1]==5 && $datas['amount']==7000000){
                            $year =5;
                        }
                        if(!empty($year)){
                            $deadline = strtotime('+'.$year.' years', $info['data']['deadline']);
                            $date = date('d/m/Y',$deadline);
                            $dataPost= array('phone'=> $info['data']['phone'],'deadline'=>$date);
                            $info = sendDataConnectMantan('https://'.$boss->domain.'/apis/extendMemberAPI', $dataPost);
                            $info = str_replace('ï»¿', '', utf8_encode($info));
                            $info = json_decode($info, true);
                        }
                    }
                }
                return array('code'=>1, 'mess'=>'bạn giao dịch thành công');
            }
            return array('code'=>0, 'mess'=>'số điện thoạt không phải boss');

        }
        return array('code'=>0, 'mess'=>'nội dung giao giao dịch bị sai');

		// processAddMoney($datas['amount'], $ransaction);
		//return array('code'=>1, 'mess'=>'bạn giao dịch thành công');
	}
	return array('code'=>0, 'mess'=>'giao dịch không thành công');
}

function settingpayos($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $urlHomes;
    global $listBank;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'settingPayos');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'client_id' => @$dataSend['client_id'],
                        'api_key' => @$dataSend['api_key'],
                        'checksum_key' => @$dataSend['checksum_key'],
                        'code_bank' => @$dataSend['code_bank']
                       
                    );
        $data->key_word = 'settingPayos';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    $data_value['linkwebhok'] = $urlHomes.'apis/addMoneyPayOSBankAPI';

    setVariable('setting', $data_value);
    setVariable('mess', $mess);
    setVariable('listBank', $listBank);
}

function checkthangtoan(){
	debug(checkpayos());
	die;
}

function getinfobankAPI($input){
    global $isRequestPost;

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['amount']) && !empty($dataSend['description'])){
             return checkpayos($dataSend['amount'],$dataSend['description']);
        }
       
    }
     return array('mess'=>'lỗi hệ thống');
}
?>
