<?php
function settinghomebandothanhcong($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';
	
    $conditions = array('key_word' => 'settinghomebandothanhcong');
    $data = $modelOptions->find()->where($conditions)->first();
    
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }
		if($isRequestPost){
			$dataSend = $input['request']->getData();
			
			$value = array(
                // khối 1
                'leftheader1'=> @$dataSend['leftheader1'],
				'leftheader2'=> @$dataSend['leftheader2'],
                'leftheader3'=> @$dataSend['leftheader3'],
                'hour'=> @$dataSend['hour'],
                'minutes'=> @$dataSend['minutes'],
                'seconds'=> @$dataSend['seconds'],
                'button1'=> @$dataSend['button1'],

                // Khối 2

                'backgound'=> @$dataSend['backgound'],
                'image1'=> @$dataSend['image1'],
                'image2'=> @$dataSend['image2'],
                'image3'=> @$dataSend['image3'],
                'image4'=> @$dataSend['image4'],
                'image5'=> @$dataSend['image5'],
                'image6'=> @$dataSend['image6'],
                'image7'=> @$dataSend['image7'],
                'image8'=> @$dataSend['image8'],
                // khối 3
                'title1'=> @$dataSend['title1'],
                'noidung1'=> @$dataSend['noidung1'],
                'noidung2'=> @$dataSend['noidung2'],
                'noidung3'=> @$dataSend['noidung3'],
                'backgound2'=> @$dataSend['backgound2'],
                // khối 4

                'image9'=> @$dataSend['image9'],
                'title2'=> @$dataSend['title2'],
                'title3'=> @$dataSend['title3'],
                'noidungbuoc1'=> @$dataSend['noidungbuoc1'],
                'noidungbuoc2'=> @$dataSend['noidungbuoc2'],
                'noidungbuoc3'=> @$dataSend['noidungbuoc3'],
                'noidungbuoc4'=> @$dataSend['noidungbuoc4'],
                'noidungbuoc5'=> @$dataSend['noidungbuoc5'],
                'button3'=> @$dataSend['button3'],

                // khoi 5
                'backgound3' => @$dataSend['backgound3'],
                'button4'=> @$dataSend['button4'],
                'noidung4'=> @$dataSend['noidung4'],
                'noidung5'=> @$dataSend['noidung5'],
                'title4'=> @$dataSend['title4'],
                'title5'=> @$dataSend['title5'],
                'step1'=> @$dataSend['step1'],
                'step2'=> @$dataSend['step2'],
                'step3'=> @$dataSend['step3'],
                'step4'=> @$dataSend['step4'],
                'step5'=> @$dataSend['step5'],
                'step6'=> @$dataSend['step6'],
                'step7'=> @$dataSend['step7'],
                'step8'=> @$dataSend['step8'],
                'step9'=> @$dataSend['step9'],
                'step10'=> @$dataSend['step10'],
                'step11'=> @$dataSend['step11'],
                'step12'=> @$dataSend['step12'],
                'step13'=> @$dataSend['step13'],
                'image10'=> @$dataSend['image10'],
                'title6'=> @$dataSend['title6'],
                'ih1'=> @$dataSend['ih1'],
                'ih2'=> @$dataSend['ih2'],
                'ih3'=> @$dataSend['ih3'],
                'button7'=> @$dataSend['button7'],
                'image11'=> @$dataSend['image11'],
                'chuvang'=> @$dataSend['chuvang'],
                'noidungkhoi71'=> @$dataSend['noidungkhoi71'],
                'noidungkhoi72'=> @$dataSend['noidungkhoi72'],
                'noidungkhoi73'=> @$dataSend['noidungkhoi73'],
                'tieudevang'=> @$dataSend['tieudevang'],
                'tieudetrang'=> @$dataSend['tieudetrang'],
                'priceleft'=> @$dataSend['priceleft'],
                'tieudegia'=> @$dataSend['tieudegia'],
                'dsdautien'=> @$dataSend['dsdautien'],
                'dsdauhai'=> @$dataSend['dsdauhai'],
                'dsdauba'=> @$dataSend['dsdauba'],
                'dsdautu'=> @$dataSend['dsdautu'],
                'dsdaunam'=> @$dataSend['dsdaunam'],
                'priceright'=> @$dataSend['priceright'],
                'tieudegiavip'=> @$dataSend['tieudegiavip'],
                'dsdautienp'=> @$dataSend['dsdautienp'],
                'dsdauhaip'=> @$dataSend['dsdauhaip'],
                'dsdaubap'=> @$dataSend['dsdaubap'],
                'dsdautup'=> @$dataSend['dsdautup'],
                'dsdaunamp'=> @$dataSend['dsdaunamp'],
                'dsdausaup'=> @$dataSend['dsdausaup'],
                'noidungnho1'=> @$dataSend['noidungnho1'],
                'noidungnho2'=> @$dataSend['noidungnho2'],
                'btchung'=> @$dataSend['btchung'],
                
                // khối 9
                'titlevangk9'=> @$dataSend['titlevangk9'],
                'tieudetrangk9'=> @$dataSend['tieudetrangk9'],
                'tieudevangtrang'=> @$dataSend['tieudevangtrang'],
                'diadiem'=> @$dataSend['diadiem'],
                'thoigian'=> @$dataSend['thoigian'],
                'phithamdu'=> @$dataSend['phithamdu'],
                'pricethamdu'=> @$dataSend['pricethamdu'],
                'uudaigia'=> @$dataSend['uudaigia'],
                'timedownngay'=> @$dataSend['timedownngay'],
                'timedowngio'=> @$dataSend['timedowngio'],
                'timedownphut'=> @$dataSend['timedownphut'],
                'timedowngiay'=> @$dataSend['timedowngiay'],
                'checkboxleftdd'=> @$dataSend['checkboxleftdd'],
                'checkboxrightdd'=> @$dataSend['checkboxrightdd'],
                'checkboxleftprice'=> @$dataSend['checkboxleftprice'],
                'checkboxrightprice'=> @$dataSend['checkboxrightprice'],
                
                // khối 10
                'titlek10'=> @$dataSend['titlek10'],
                'titleb10'=> @$dataSend['titleb10'],
                'titleb11'=> @$dataSend['titleb11'],
                'titlek10bd'=> @$dataSend['titlek10bd'],

                // khối 11
                'titlefooter'=> $dataSend['titlefooter'],
                'footerlogo'=> @$dataSend['footerlogo'],
                'address'=> @$dataSend['address'],
                'sdt'=> @$dataSend['sdt'],
                'email'=> @$dataSend['email'],
                

			);
	
	$data->key_word = 'settinghomebandothanhcong';
	$data->value = json_encode($value);
	$modelOptions->save($data);
	$mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('data', $data_value);
    setVariable('mess', $mess);
}
function indexTheme($input){
	
    global $controller;

    $modelFeedback = $controller->loadModel('Feedbacks');

    $listFeedback= $modelFeedback->find()->limit(10)->page(1)->where()->all()->toList();
    setVariable('listFeedback', $listFeedback);

  
	
}
