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
    		$uid = getUIDFacebook($dataSend['uid']);
    	}
    }

    return $uid;
}