	<?php

	function settingHomeTheme($input)
	{
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
				'image'=> @$dataSend['image'],
				'textSlide'=> @$dataSend['textSlide'],
				'textSlide1'=> @$dataSend['textSlide1'],
				'avatar'=> @$dataSend['avatar'],
				'avatar2'=> @$dataSend['avatar2'],
				'avatar4'=> @$dataSend['avatar4'],
				'textSlides' => @$dataSend['textSlides'],
				'fullName'=> @$dataSend['fullName'],
				'personIntroduction'=> @$dataSend['personIntroduction'],
				'background1'=> @$dataSend['background1'],
				'nameStatic1'=> @$dataSend['nameStatic1'],
				'numberStatic1'=> @$dataSend['numberStatic1'],
				'nameStatic2'=> @$dataSend['nameStatic2'],

				'numberStatic2'=> @$dataSend['numberStatic2'],
				'nameStatic3'=> @$dataSend['nameStatic3'],
				'numberStatic3'=> @$dataSend['numberStatic3'],

				'imageLearn1'=> @$dataSend['imageLearn1'],
				'textvideo'=> @$dataSend['textvideo'],
				'video'=> @$dataSend['video'],
				'background2'=> @$dataSend['background2'],

				'imageLearn2'=> @$dataSend['imageLearn2'],
				'imageLearn3'=> @$dataSend['imageLearn3'],
				'imageLearn4'=> @$dataSend['imageLearn4'],

				'imageLearn5'=> @$dataSend['imageLearn5'],
                'video0'=> @$dataSend['video0'],
                'video1'=> @$dataSend['video1'],
                'video2'=> @$dataSend['video2'],
                'video3'=> @$dataSend['video3'],

                'imageLearn12'=> @$dataSend['imageLearn12'],
                'titleLearn1'=> @$dataSend['titleLearn1'],
                'decsLearn1'=> @$dataSend['decsLearn1'],
                'imageLearn13'=> @$dataSend['imageLearn13'],

                'titleLearn2'=> @$dataSend['titleLearn2'],
                'decsLearn2'=> @$dataSend['decsLearn2'],
                'imageLearn14'=> @$dataSend['imageLearn14'],
                'titleLearn3'=> @$dataSend['titleLearn3'],

                'decsLearn4'=> @$dataSend['decsLearn4'],
                'imageLearn15'=> @$dataSend['imageLearn15'],

                'titleLearn6'=> @$dataSend['titleLearn6'],
                'decsLearn5'=> @$dataSend['decsLearn5'],
                'baivietmannhat'=> @$dataSend['baivietmannhat'],
                'chuyenthongbaochi'=> @$dataSend['chuyenthongbaochi'],

                'link1'=> @$dataSend['link1'],
                'link2'=> @$dataSend['link2'],
                'link3'=> @$dataSend['link3'],
                'link4'=> @$dataSend['link4'],

                'facebook'=> @$dataSend['facebook'],
                'youtube'=> @$dataSend['youtube'],

                'instagram'=> @$dataSend['instagram'],


                'imageLearn1000'=> @$dataSend['imageLearn1000'],
                'nameThamMy'=> @$dataSend['nameThamMy'],
                'hotline'=> @$dataSend['hotline'],
                'linkMail'=> @$dataSend['linkMail'],
                'address'=> @$dataSend['address'],
               /* 'numberStatic4'=> @$dataSend['numberStatic4'],
                
                'map'=> @$dataSend['map'],
                'messenger'=> @$dataSend['messenger'],*/
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
/*function cauchuyencuatoi($dataSend)
	{
		global $modelOption;
		global $isRequestPost;
		global $urlHomes;

		if(checkAdminLogin()){
			$data= $modelOption->getOption('cauchuyencuatoi');
			$mess= '';
			
			if($isRequestPost){

				$data['Option']['value'=> @$dataSend['content'],

				
				$modelOption->saveOption('cauchuyencuatoi', $data['Option']['value']);
				$mess= 'Lưu dữ liệu thành công';
			}

			setVariable('mess',$mess);
			setVariable('data',$data);
		}else{
			$modelOption->redirect($urlHomes);
		}
}*/


		

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