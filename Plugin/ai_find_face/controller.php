<?php 
function searchImageAPI($input)
{
	global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelCategories;
    global $urlHomes;

    $idDrive = '1caR-VYFTTtXicUedwr3PMoxToKbu5Zdh';
    $idCollection = 'tests-20242110';
    $limit = 100;

    if(!empty($_POST['idDrive'])){
        $idDrive = $_POST['idDrive'];
    }

    if(!empty($_POST['idCollection'])){
        $idCollection = $_POST['idCollection'];
    }

    if(!empty($_POST['limit'])){
        $limit = (int) $_POST['limit'];
    }

    $listFileDrive = getListFileDrive($idDrive);
    $listThumbFile = [];
    $listDownFile = [];

    if(!empty($listFileDrive)){
        foreach ($listFileDrive as $key => $value) {
            if(!empty($value['thumbnailLink'])){
                $listThumbFile[$value['originalFilename']] = $value['thumbnailLink'];
                $listDownFile[$value['originalFilename']] = $value['downloadUrl'];
            }
        }
    }
   
    if($isRequestPost){
        $listImage = searchFaceImage($idCollection, $limit);

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