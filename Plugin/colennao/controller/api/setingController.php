<?php 
function getAboutAPI($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelAlbuminfos;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'setingAbout');
    $data = $modelOptions->find()->where($conditions)->first();
    
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    if(!empty($data_value['id_album'])){
    	$list_slider = $modelAlbuminfos->find()->where(['id_album'=>(int)$data_value['id_album']])->all()->toList();
    	if(!empty($data_value['id_album'])){
    		foreach($list_slider as $key => $item){
    			$list_slider[$key]->year = $item->link;

    			$item->link = '';
    		}
    		$data_value['list_slider']=@$list_slider;
    	}

    }
    

    return $data_value;
}
function getProductAPI(){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelAlbuminfos;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'settingproduct');
    $data = $modelOptions->find()->where($conditions)->first();
    
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }    
    if(!empty($data_value['id_slide_product'])){
    	$list_slider = $modelAlbuminfos->find()->where(['id_album'=>(int)$data_value['id_slide_product']])->all()->toList();
    	if(!empty($data_value['id_slide_product'])){
    		foreach($list_slider as $key => $item){
    			$list_slider[$key]->year = $item->link;

    			$item->link = '';
    		}
    		$data_value['list_slider']=@$list_slider;
    	}

    }

    return $data_value;
}
function getbusinessAPI($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelAlbuminfos;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'settingbusiness');
    $data = $modelOptions->find()->where($conditions)->first();
    
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    if(!empty($data_value['id_slide_price'])){
    	$list_slider = $modelAlbuminfos->find()->where(['id_album'=>(int)$data_value['id_slide_price']])->all()->toList();
    	if(!empty($data_value['id_slide_price'])){
    		foreach($list_slider as $key => $item){
    			$list_slider[$key]->year = $item->link;

    			$item->link = '';
    		}
    		$data_value['list_slider']=@$list_slider;
    	}

    }
    

    return $data_value;
}
function gethomepageAPI($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelAlbuminfos;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'setinghomepage');
    $data = $modelOptions->find()->where($conditions)->first();
    
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    if(!empty($data_value['slide_home_page'])){
    	$list_slider = $modelAlbuminfos->find()->where(['id_album'=>(int)$data_value['slide_home_page']])->all()->toList();
    	if(!empty($data_value['slide_home_page'])){
    		foreach($list_slider as $key => $item){
    			$list_slider[$key]->year = $item->link;

    			$item->link = '';
    		}
    		$data_value['list_slider']=@$list_slider;
    	}

    }
    

    return $data_value;
}
 ?>