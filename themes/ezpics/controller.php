<?php 
function settingHomeTheme($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('type' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'image_logo' => @$dataSend['image_logo'],
                        'id_slide' => $dataSend['id_slide'],
                
                    );

    

        $data->type = 'settingHomeTheme';
        $data->content = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->content, true);
    }

    setVariable('setting', $data_value);
    setVariable('mess', $mess);
}

function indexTheme($input){
    global $controller; 
    global $modelCategories;
    global $modelAlbuminfos;
    global $modelOptions;
    global $settingThemes;

    $modelPosts = $controller->loadModel('Posts');
    $modelProduct = $controller->loadModel('Products');
    $modelMember = $controller->loadModel('Members');
    $modelWarehouses = $controller->loadModel('Warehouses');

   // $data = $modelOptions->find()->where($conditions)->first();
     $order = array('id'=>'desc');


     // SLIDE HOME
    $slide_home = [];
    if(!empty($settingThemes['id_slide'])){
        $slide_home = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_slide']])->all()->toList();
    }
    

    // tin tức
    $listDataPost= $modelPosts->find()->limit(4)->page(1)->where()->order($order)->all()->toList();

    // mẫu xu hướng
    $listTrendProduct = $modelProduct->find()->where(array('trend' =>1, 'type'=>'user_create', 'status'=>2))->order($order)->all()->toList();

    if(!empty($listTrendProduct)){
        foreach ($listTrendProduct as $key => $value) {
            $infoUser = $modelMember->find()->where(['id'=>(int) $value->user_id])->first();

            $listTrendProduct[$key]->author = @$infoUser->name;

            if(empty($value->thumbnail)){
                $listTrendProduct[$key]->thumbnail = $value->image;
            }
        }
    }

    $listWarehouse = $modelWarehouses->find()->where(array('status'=>1, 'trend'=>1, 'number_product >'=>0))->order($order)->all()->toList();

    setVariable('listDataPost', $listDataPost);
    setVariable('listTrendProduct', $listTrendProduct);
    setVariable('listWarehouse', $listWarehouse);
    setVariable('slide_home', $slide_home);
}
 ?>