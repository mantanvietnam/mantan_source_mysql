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
    return litsUpOngTrum();
}
?>