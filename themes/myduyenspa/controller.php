<?php
function settingHomeTheme($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }
		if($isRequestPost){
			$dataSend = $input['request']->getData();

			 $value = array('logo'=> @$dataSend['logo'],
				'video'=> @$dataSend['video'],
				'textSlide'=> @$dataSend['textSlide'],
				'avatar'=> @$dataSend['avatar'],
				'fullName'=> @$dataSend['fullName'],
				'slogan'=> @$dataSend['slogan'],
				'personIntroduction'=> @$dataSend['personIntroduction'],
				'facebook'=> @$dataSend['facebook'],
				'youtube'=> @$dataSend['youtube'],
				'instagram'=> @$dataSend['instagram'],

				'imageLearn1'=> @$dataSend['imageLearn1'],
				'titleLearn1'=> @$dataSend['titleLearn1'],
				'decsLearn1'=> @$dataSend['decsLearn1'],
				'Link_kh1'=> @$dataSend['Link_kh1'],

				'imageLearn2'=> @$dataSend['imageLearn2'],
				'titleLearn2'=> @$dataSend['titleLearn2'],
				'decsLearn2'=> @$dataSend['decsLearn2'],
				'Link_kh2'=> @$dataSend['Link_kh2'],


				'imageLearn3'=> @$dataSend['imageLearn3'],
				'titleLearn3'=> @$dataSend['titleLearn3'],
				'decsLearn3'=> @$dataSend['decsLearn3'],
				'Link_kh3'=> @$dataSend['Link_kh3'],


				'imageProgram1'=> @$dataSend['imageProgram1'],
                'timeProgram1'=> @$dataSend['timeProgram1'],
                'titleProgram1'=> @$dataSend['titleProgram1'],
                'decsProgram1'=> @$dataSend['decsProgram1'],
				'Link_ct1'=> @$dataSend['Link_ct1'],                	
                'imageProgram2'=> @$dataSend['imageProgram2'],
                'timeProgram2'=> @$dataSend['timeProgram2'],
                'titleProgram2'=> @$dataSend['titleProgram2'],
                'decsProgram2'=> @$dataSend['decsProgram2'],
				'Link_ct2'=> @$dataSend['Link_ct2'],	
                'imageProgram3'=> @$dataSend['imageProgram3'],
                'timeProgram3'=> @$dataSend['timeProgram3'],
                'titleProgram3'=> @$dataSend['titleProgram3'],
                'decsProgram3'=> @$dataSend['decsProgram3'],
				'Link_ct3'=> @$dataSend['Link_ct3'],
                'imageStatic'=> @$dataSend['imageStatic'],
                
                'nameStatic1'=> @$dataSend['nameStatic1'],
                'numberStatic1'=> @$dataSend['numberStatic1'],

                'nameStatic2'=> @$dataSend['nameStatic2'],
                'numberStatic2'=> @$dataSend['numberStatic2'],

                'nameStatic3'=> @$dataSend['nameStatic3'],
                'numberStatic3'=> @$dataSend['numberStatic3'],

                'nameStatic4'=> @$dataSend['nameStatic4'],
                'numberStatic4'=> @$dataSend['numberStatic4'],
                
                'map'=> @$dataSend['map'],
                'messenger'=> @$dataSend['messenger'],
                'nameThamMy'=> @$dataSend['nameThamMy'],
                'hotline'=> @$dataSend['hotline'],
                'linkMail'=> @$dataSend['linkMail'],
                'address'=> @$dataSend['address'],
                'textfooter'=> @$dataSend['textfooter'],

			 );

    

        $data->key_word = 'settingHomeTheme';
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

	// function editIndex($dataSend)
	// {
	// 	global $modelOption;
	// 	global $isRequestPost;
	// 	global $urlHomes;
	// 	global $themeSettings;

	// 	if(checkAdminLogin()){
	// 		$data= $modelOption->getOption('myduyenspaThemeSettings');
	// 		$mess= '';
			
	// 		if($isRequestPost){
	// 			if(!empty($dataSend['nameItem'])){
	// 				$dataSend['nameItem']=> @$dataSend['content'],
	// 			}elseif(!empty($dataSend['nameItemMeida'])){
	// 				$dataSend['nameItemMeida']=> @$dataSend['contentMedia'],
	// 			}elseif(!empty($dataSend['nameItemEditer'])){
	// 				$dataSend['nameItemEditer']=> @$dataSend['contentEditer'],
	// 			}elseif(!empty($dataSend['nameItemTextarea'])){
	// 				$dataSend['nameItemTextarea']=> @$dataSend['contentTextarea'],
	// 			}
				
	// 			$modelOption->saveOption('myduyenspaThemeSettings', $data['Option']['value']);
	// 			$mess= 'Lưu dữ liệu thành công';
	// 		}

	// 		$themeSettings= $data;
	// 	}else{
	// 		$modelOption->redirect($urlHomes);
	// 	}
	// }

	function indexTheme()
	{
	  global $modelAlbums;
	  global $modelOptions;
	  global $modelNotices;
	  global $modelPosts;

	   $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    $order = array('id'=>'desc');

    $listDataNew= $modelPosts->find()->limit(4)->where(array('type'=>'post'))->order($order)->all()->toList();

    setVariable('setting', $data_value);
    setVariable('listDataNew', $listDataNew);

	}
?>