<?php
function createPhotoAIHairAPI($input)
{
	global $controller;
    global $isRequestPost;

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
    }

    $path = __DIR__.'/../../view/image/default-avatar.png';
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$data = file_get_contents($path);
	$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    return ['image1'=>$base64, 'image2'=>$base64, 'image3'=>$base64];
}
?>