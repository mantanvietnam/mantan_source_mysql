<?php 
function getSlideAPI($input)
{
    global $modelAlbums;
    global $modelAlbuminfos;

    if(empty($_GET['id'])) $_GET['id'] = 1;

    $album = $modelAlbums->find()->where(['id'=>$_GET['id']])->first();

    if(!empty($album)){
        $infoAlbum = $modelAlbuminfos->find()->where(['id_album'=>$album->id])->all()->toList();

        return $infoAlbum;
    }

    return [];
}
?>