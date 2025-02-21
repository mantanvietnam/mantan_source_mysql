<?php 
function addalbuminfos($input){
    global $controller;
    global $isRequestPost;
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thông tin tin tức';
    $modeltablepost = $controller->loadModel('tablepost');
    $modelcategorypost = $controller->loadModel('categorypost');
    
    if(!empty($_GET['id_album'])){
            $infoAlbum = $modelAlbums->get((int) $_GET['id_album']);
        }

        if(!empty($infoAlbum)){
            // lấy data edit
            if(!empty($_GET['id'])){
                $infoPost = $modelAlbuminfos->get( (int) $_GET['id']);
            }else{
                $infoPost = $modelAlbuminfos->newEmptyEntity();
            }

            if($isRequestPost) {
                $dataSend = $input['request']->getData();

                if(!empty($dataSend['image'])){
                    // tạo dữ liệu save
                    $infoPost->title = str_replace(array('"', "'"), '’', $dataSend['title']);
                    $infoPost->title_en = str_replace(array('"', "'"), '’', $dataSend['title_en']);
                    $infoPost->id_album = (int) $_GET['id_album'];
                    $infoPost->image = $dataSend['image'];
                    $infoPost->image_mobile = $dataSend['image_mobile'];
                    if(!empty($dataSend['image_en'])){
                         $infoPost->image_en = $dataSend['image_en'];
                    }else{
                         $infoPost->image_en = $dataSend['image'];
                    }
                    if(!empty($dataSend['image_en_mobile'])){
                         $infoPost->image_en_mobile = $dataSend['image_en_mobile'];
                    }else{
                         $infoPost->image_en_mobile = $dataSend['image_mobile'];
                    }
                    $infoPost->description = $dataSend['description'];
                    $infoPost->description_en = $dataSend['description_en'];
                    $infoPost->link = $dataSend['link'];
                    $infoPost->link_en = $dataSend['link_en'];

                    $modelAlbuminfos->save($infoPost);
                    $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
                }else{
                    $mess= '<p class="text-danger">Nhập thiếu dữ liệu</p>';
                }
            }

            setVariable('infoPost', @$infoPost);
            setVariable('mess', @$mess);
            setVariable('infoAlbum', @$infoAlbum);
        }else{
            return $controller->redirect('/albums/list');
        }
}
 ?>