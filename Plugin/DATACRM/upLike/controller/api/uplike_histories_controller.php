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
            
    		$uid = getUIDFacebook($dataSend['uid'], $dataSend['type']);
    	}
    }

    return $uid;
}