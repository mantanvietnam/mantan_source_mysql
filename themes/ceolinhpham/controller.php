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
			
			$value = array('titleNav'=> @$dataSend['titleNav'],
				'sloganNav'=> @$dataSend['sloganNav'],
				
				'videoBanner'=> @$dataSend['videoBanner'],
				'sloganBanner1'=> @$dataSend['sloganBanner1'],
				'sloganBanner2'=> @$dataSend['sloganBanner2'],
				'iconBanner'=> @$dataSend['iconBanner'],
				'sloganBanner3'=>@$dataSend['sloganBanner3'],
				'linkBanner'=> @$dataSend['linkBanner'],
				'imageBanner'=> @$dataSend['imageBanner'],

				'imageIntro'=>  @$dataSend['imageIntro'],
				'fullName'=> @$dataSend['fullName'],
				'contentIntro'=> @$dataSend['contentIntro'],
				'facebook'=> @$dataSend['facebook'],
				'youtube'=> @$dataSend['youtube'],
				'instagram'=> @$dataSend['instagram'],

				'imageBgEvent'=> @$dataSend['imageBgEvent'],
				'imageEvent1'=> @$dataSend['imageEvent1'],
				'titleEvent1'=> @$dataSend['titleEvent1'],
				'iconEvent1'=> @$dataSend['iconEvent1'],
				'imageEventHover1'=> @$dataSend['imageEventHover1'],
				'linkEvent1'=> @$dataSend['linkEvent1'],
				
				'imageEvent2'=> @$dataSend['imageEvent2'],
				'titleEvent2'=> @$dataSend['titleEvent2'],
				'iconEvent2'=> @$dataSend['iconEvent2'],
				'imageEventHover2'=> @$dataSend['imageEventHover2'],
				'linkEvent2'=> @$dataSend['linkEvent2'],
				
				'imageEvent3'=> @$dataSend['imageEvent3'],
				'titleEvent3'=> @$dataSend['titleEvent3'],
				'iconEvent3'=> @$dataSend['iconEvent3'],
				'imageEventHover3'=> @$dataSend['imageEventHover3'],
				'linkEvent3'=> @$dataSend['linkEvent3'],

				'imageBgNewpaper'=> @$dataSend['imageBgNewpaper'],
				'imageNewspaper1'=> @$dataSend['imageNewspaper1'],
				'titleNewspaper1'=> @$dataSend['titleNewspaper1'],
				'textNewspaper1'=> @$dataSend['textNewspaper1'],
				'linkNewspaper1'=> @$dataSend['linkNewspaper1'],

				'imageNewspaper2'=> @$dataSend['imageNewspaper2'],
				'titleNewspaper2'=> @$dataSend['titleNewspaper2'],
				'textNewspaper2'=> @$dataSend['textNewspaper2'],
				'linkNewspaper2'=> @$dataSend['linkNewspaper2'],
				
				'imageNewspaper3'=> @$dataSend['imageNewspaper3'],
				'titleNewspaper3'=> @$dataSend['titleNewspaper3'],
				'textNewspaper3'=> @$dataSend['textNewspaper3'],
				'linkNewspaper3'=> @$dataSend['linkNewspaper3'],

				'map'=>@$dataSend['map'],
				'messenger'=>@$dataSend['messenger'],
				'nameThamMy'=> @$dataSend['nameThamMy'],
                'hotline'=> @$dataSend['hotline'],
                'linkMail'=> @$dataSend['linkMail'],
                'address'=> @$dataSend['address'],
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
// 	{
// 		global $modelOption;
// 		global $isRequestPost;
// 		global $urlHomes;
// 		global $themeSettings;

// 		if(checkAdminLogin()){
// 			$data= $modelOption->getOption('CeoLinhPhamThemeSettings');
// 			$mess= '';
			
// 			if($isRequestPost){
// 				if(!empty(@$dataSend['nameItem'])){
// 					$data['Option']['value'][@$dataSend['nameItem']]= @@$dataSend['content'],
// 				}elseif(!empty(@$dataSend['nameItemMeida'])){
// 					$data['Option']['value'][@$dataSend['nameItemMeida']]= @@$dataSend['contentMedia'],
// 				}elseif(!empty(@$dataSend['nameItemEditer'])){
// 					$data['Option']['value'][@$dataSend['nameItemEditer']]= @@$dataSend['contentEditer'],
// 				}elseif(!empty(@$dataSend['nameItemTextarea'])){
// 					$data['Option']['value'][@$dataSend['nameItemTextarea']]= @@$dataSend['contentTextarea'],
// 				}
				
// 				$modelOption->saveOption('CeoLinhPhamThemeSettings', $data['Option']['value']);
// 				$mess= 'Lưu dữ liệu thành công';
// 			}

// 			$themeSettings= $data;
// 		}else{
// 			$modelOption->redirect($urlHomes);
// 		}
// 	}

// 	// function indexTheme()
// 	// {
// 	//   global $modelAlbum;
// 	//   global $modelOption;
// 	//   global $modelNotice;

// 	//   $themeData = $modelOption->getOption('CeoLinhPhamThemeSettings');

// 	// }

function indexTheme(){
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