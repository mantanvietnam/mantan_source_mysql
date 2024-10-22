<?php 
function searchImageAPI($input)
{
	global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelCategories;
    global $urlHomes;

    $listFileDrive = getListFileDrive('1caR-VYFTTtXicUedwr3PMoxToKbu5Zdh');
    $listThumbFile = [];
    $listDownFile = [];

    if(!empty($listFileDrive)){
        foreach ($listFileDrive as $key => $value) {
            $listThumbFile[$value['originalFilename']] = $value['thumbnailLink'];
            $listDownFile[$value['originalFilename']] = $value['downloadUrl'];
        }
    }

    if($isRequestPost){
        $listImage = searchFaceImage('tests-20242110');

        $listReturn = [];

        if(!empty($listImage['listImage'])){
            foreach ($listImage['listImage'] as $key => $value) {
                $listReturn[$value] = ['thumb'=>$listThumbFile[$value], 'download'=>$listDownFile[$value]];
            }
        }
    }

    return $listReturn;
}
?>