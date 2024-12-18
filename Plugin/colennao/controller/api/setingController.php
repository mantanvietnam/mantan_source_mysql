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
 ?>