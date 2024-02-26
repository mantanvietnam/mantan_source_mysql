<?php
function settingHomeTheme($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();
       

        $value = array( 'image_logo' => @$dataSend['image_logo'],
                        'hotline' => @$dataSend['hotline'],
                        'banner1' => @$dataSend['banner1'],
                        'title1' => @$dataSend['title1'],
                        'link1' => @$dataSend['link1'],
                        'content1' => @$dataSend['content1'],
                        'image1' => @$dataSend['image1'],
                        'id_album' => @$dataSend['id_album'],
                        'title2' => @$dataSend['title2'],
                        'id_service' => @$dataSend['id_service'],
                        'content2' => @$dataSend['content2'],
                        'id_post' => @$dataSend['id_post'],
                        'title3' => @$dataSend['title3'],
                        'banner2' => @$dataSend['banner2'],
                        'banner3' => @$dataSend['banner3'],
                        'content3' => @$dataSend['content3'],
                        'company' => @$dataSend['company'],
                        'address' => @$dataSend['address'],
                        'email' => @$dataSend['email'],
                        'facebook' => @$dataSend['facebook'],
                        'link_facebook' => @$dataSend['link_facebook'],
                        'id_linkweb' => @$dataSend['id_linkweb'],
                        'textfooter' => @$dataSend['textfooter'],
                        'map' => @$dataSend['map'],
                        

                    );

    

        $data->key_word = 'settingHomeTheme';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('setting', $data_value);
    setVariable('mess', $mess);
}

function indexTheme($input){
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelOptions;
    global $modelNotices;
    global $modelPosts;
    global $controller;
    global $modelCategories;

    $modelProduct = $controller->loadModel('Products');

    $modelCategorieProduct = $controller->loadModel('CategorieProducts');

    $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    $order = array('id'=>'desc');

    $album = $modelAlbums->find()->where(array('id'=>@$data_value['id_album']))->first();

    if(!empty($album)){
        $album->data = $modelAlbuminfos->find()->where(array('id_album'=>$album->id))->all()->toList();
    }

    $listService= $modelPosts->find()->limit(10)->where(array('idCategory'=>@$data_value['id_service']))->order($order)->all()->toList();

    $conditionCategorieProduct = array('type' => 'category_product','status'=>'active');
    $categorieProduct = $modelCategories->find()->limit(3)->where($conditionCategorieProduct)->all()->toList();

    if(!empty($categorieProduct)){
        foreach($categorieProduct as $key => $item){
            $category_product = $modelCategorieProduct->find()->where(array('id_category'=>$item->id))->all()->toList();
            $product = array();
            if(!empty($category_product)){
                foreach($category_product as $kc => $value){
                    $pro = $modelProduct->find()->where(array('id'=>@$value->id_product))->first();  
                    if(!empty($pro)){
                       $product[] = $pro;
                    }
                }
            }
            $categorieProduct[$key]->product = $product;
        }
    }

    $listpost= $modelPosts->find()->limit(10)->where(array('idCategory'=>@$data_value['id_post']))->order($order)->all()->toList();

   

    setVariable('setting', $data_value);
    setVariable('listService', $listService);
    setVariable('album',$album);
    setVariable('categorieProduct',$categorieProduct);
    setVariable('listpost',$listpost);
}
?>