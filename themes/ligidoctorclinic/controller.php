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
       

        $value = array( 'image_logo' => @$dataSend['image_logo'],
                        'hotline' => @$dataSend['hotline'],
                        'banner1' => @$dataSend['banner1'],
                        'title1' => @$dataSend['title1'],
                        'link1' => @$dataSend['link1'],
                        'content1' => @$dataSend['content1'],
                        'image1' => @$dataSend['image1'],
                        'id_album' => @$dataSend['id_album'],
                        'title2' => @$dataSend['title2'],
                        'id_service' => @$dataSend['id_service'],
                        'content2' => @$dataSend['content2'],
                        'id_post' => @$dataSend['id_post'],
                        'title3' => @$dataSend['title3'],
                        'banner2' => @$dataSend['banner2'],
                        'banner3' => @$dataSend['banner3'],
                        'content3' => @$dataSend['content3'],
                        'company' => @$dataSend['company'],
                        'address' => @$dataSend['address'],
                        'email' => @$dataSend['email'],
                        'facebook' => @$dataSend['facebook'],
                        'link_facebook' => @$dataSend['link_facebook'],
                        'id_linkweb' => @$dataSend['id_linkweb'],
                        'textfooter' => @$dataSend['textfooter'],
                        'map' => @$dataSend['map'],
                        

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

    setVariable('setting', $data_value);
    setVariable('mess', $mess);
}





	function indexTheme()
	{
		global $modelAlbum;
		global $modelOption;
		global $modelNotice;
		global $themeSetting;

		global $urlHomes;
		global $urlNow;
		global $contactSite;

		$conditions = array();
		$listNoticeNew = $modelNotice->getOtherNotice(array((int)  $themeSetting['Option']['value']['idCateNotice']),10);

		$listBestSellingProduct= getTopBestSellingProduct(8);
		$listNewProduct= getListProduct(8);
		$listCategory= getListCategory();


		
		

		setVariable('listNoticeNew',$listNoticeNew);
		setVariable('listBestSellingProduct',$listBestSellingProduct);
		setVariable('listNewProduct',$listNewProduct);
		setVariable('listCategory',$listCategory);
		
		

		// debug($listCategory);


		// setVariable('albumSlide',$albumSlide);

	}

	
	
?>