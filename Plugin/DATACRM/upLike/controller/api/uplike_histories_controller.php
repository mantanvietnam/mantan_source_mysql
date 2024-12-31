<?php
function getUidAPI($input)
{
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $uid = [];

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	if(!empty($dataSend['uid'])){
            if(empty($dataSend['type'])){
                $dataSend['type'] = 'uid';
            }

            if(empty($dataSend['type_prority'])){
                $dataSend['type_prority'] = 'reel';
            }
            
    		$uid = getUIDFacebook($dataSend['uid'], $dataSend['type'],$dataSend['type_prority']);
    	}
    }

    return $uid;
}

function litsUpOngTrumAPI(){
    return getListPriceOngTrum();
}

function listServerSmmAPI(){
    return listServerSmm();
}

function getUpOngTrumByTypeAPI($input){
    global $modelOptions;
    global $isRequestPost;

    $listPrice = getListPriceOngTrum();
     $multiplier = 1;
    $conditions = array('key_word' => 'settingUpLikeAdmin');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    if(!empty($data_value['multiplier'])){
        $multiplier = $data_value['multiplier'];
    }
    $data = array('multiplier'=>$multiplier);
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['social_network'])){

            $data['price'] = $listPrice['data'][$dataSend['social_network']][$dataSend['type_parent']][$dataSend['type_sub']];

        }
    }
    return $data;

}
?>