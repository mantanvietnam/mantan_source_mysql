<?php 
function saveReportCompeteAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$return = array('code'=>1,
					'set_attributes'=>array(),
					'messages'=>array('text'=>'')
				);
	
	if($isRequestPost){
		$modelReport = $controller->loadModel('Reports');
	    $modelTarget = $controller->loadModel('Targets');
	    $modelCompete = $controller->loadModel('Competes');
	    $modelCustomer = $controller->loadModel('Customers');

		$dataSend = $input['request']->getData();

        if(!empty($dataSend['id_customer']) && !empty($dataSend['id_target'])){
            $info_target = $modelTarget->get((int) $dataSend['id_target']);
            
            if(!empty($info_target) && $info_target->type == 'one'){
                $conditionsReport = array('id_customer'=>$dataSend['id_customer'], 'id_target'=>$dataSend['id_target']);
                $data = $modelReport->find()->where($conditionsReport)->first();

                if(empty($data)){
                    $data = $modelReport->newEmptyEntity();
                }
            }else{
            	$data = $modelReport->newEmptyEntity();
            }

            
	        // lưu dữ liệu
	        $data->id_customer = $dataSend['id_customer'];
	        $data->id_target = $dataSend['id_target'];
            $data->id_compete = $info_target->id_compete;
            $data->image = (string) @$dataSend['image'];
            $data->note = (string) @$dataSend['note'];
            $data->point = (!empty($dataSend['point']))?(int) $dataSend['point'] : (int) $info_target->point;
            $data->time_report = time();

	        $modelReport->save($data);

	        // tính tổng điểm thi đua
	        $point_compete = 0;
	        $conditionsReport = array('id_customer'=>$dataSend['id_customer'], 'id_compete'=>$info_target->id_compete);
            $checkReport = $modelReport->find()->where($conditionsReport)->all()->toList();

            if(!empty($checkReport)){
            	foreach ($checkReport as $key => $report) {
            		$point_compete += $report->point;
            	}
            }
            
	        $return = array('code'=>0, 	
						'set_attributes'=>array('point_compete'=>$point_compete),
						'messages'=>array('text'=>'Lưu thông tin thành công')
					);
            
	    }else{
	    	$return = array('code'=>2, 	
    						'set_attributes'=>array(),
    						'messages'=>array('text'=>'Gửi thiếu dữ liệu')
    					);
	    }
	}
	
	return $return;
}
?>