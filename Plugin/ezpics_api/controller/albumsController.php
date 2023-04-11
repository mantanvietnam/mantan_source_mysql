<?php 
function getSlideHomeAPI($input)
{
	global $modelAlbums;
	global $modelAlbuminfos;

	$album = $modelAlbums->find()->where(['id'=>1])->first();

	if(!empty($album)){
		$infoAlbum = $modelAlbuminfos->find()->where(['id_album'=>$album->id])->all()->toList();

		return $infoAlbum;
	}

	return [];
}
?>