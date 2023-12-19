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
        if(!empty($dataSend['targetTime'])){
            $time = explode(' ', $dataSend['targetTime']);
            $date = explode('/', $time[1]);
            $hour = explode(':', $time[0]);
            $targetTime = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
        }

        $value = array( 'image_logo' => @$dataSend['image_logo'],
                        'id_slide' => @$dataSend['id_slide'],
                        'id_bc' => @$dataSend['id_bc'],
                        'image1' => @$dataSend['image1'],
                        'image3' => @$dataSend['image3'],
                        'image2' => @$dataSend['image2'],
                        'image4' => @$dataSend['image4'],
                        'image5' => @$dataSend['image5'],
                        'image6' => @$dataSend['image6'],
                        'image7' => @$dataSend['image7'],
                        'link_image1' => @$dataSend['link_image1'],
                        'link_image2' => @$dataSend['link_image2'],
                        'link_image3' => @$dataSend['link_image3'],
                        'link_image4' => @$dataSend['link_image4'],
                        'company' => @$dataSend['company'],
                        'address' => @$dataSend['address'],
                        'phone' => @$dataSend['phone'],
                        'business' => @$dataSend['business'],
                        'side_plan' => @$dataSend['side_plan'],
                        'call_buy' => @$dataSend['call_buy'],
                        'complain' => @$dataSend['complain'],
                        'id_category' => @$dataSend['id_category'],
                        'id_service' => @$dataSend['id_service'],
                        'facebook' => @$dataSend['facebook'],
                        'youtube' => @$dataSend['youtube'],
                        'instagram' => @$dataSend['instagram'],
                        'email' => @$dataSend['email'],
                        'fax' => @$dataSend['fax'],
                        'menu_image1' => @$dataSend['menu_image1'],
                        'menu_title1' => @$dataSend['menu_title1'],
                        'menu_link1' => @$dataSend['menu_link1'],
                        'menu_image2' => @$dataSend['menu_image2'],
                        'menu_title2' => @$dataSend['menu_title2'],
                        'menu_link2' => @$dataSend['menu_link2'],
                        'menu_image3' => @$dataSend['menu_image3'],
                        'menu_title3' => @$dataSend['menu_title3'],
                        'menu_link3' => @$dataSend['menu_link3'],
                        'menu_image4' => @$dataSend['menu_image4'],
                        'menu_title4' => @$dataSend['menu_title4'],
                        'menu_link4' => @$dataSend['menu_link4'],
                       
                        'sela_title1' => @$dataSend['sela_title1'],
                        'baner_sele' => @$dataSend['baner_sele'],
                        'sela_title2' => @$dataSend['sela_title2'],
                        'sela_title3' => @$dataSend['sela_title3'],
                        'background_sele' => @$dataSend['background_sele'],
                        'baner_product' => @$dataSend['baner_product'],
                        'link_nho1' => @$dataSend['link_nho1'],
                        'link_nho2' => @$dataSend['link_nho2'],
                        'link_nho3' => @$dataSend['link_nho3'],
                        'text_mobile' => @$dataSend['text_mobile'],
                        'text_mobile_ofsale' => @$dataSend['text_mobile_ofsale'],
                        'link_mobile' => @$dataSend['link_mobile'],
                        'link_mobile_ofsale' => @$dataSend['link_mobile_ofsale'],
                        'menu' => @$dataSend['menu'],

                       'targetTime' => @$targetTime,

                       'image-mobile' => @$dataSend['image-mobile'],

                    //    Bo sung
                    'contact-zalo-link' => @$dataSend['contact-zalo-link'],
                    'contact-phone-link' => @$dataSend['contact-phone-link'],

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

function sttingGuaranteeTheme($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'sttingGuaranteeTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'content' => @$dataSend['content'],
                        'code_video' => @$dataSend['code_video'],                    
                        'title' => @$dataSend['title'],                    
                        'title_video' => @$dataSend['title_video'],                    
                    );

    

        $data->key_word = 'sttingGuaranteeTheme';
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

function sttingReviewTheme($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện Review';
    $mess= '';

    $conditions = array('key_word' => 'sttingReviewTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        
        $value = array( 'id_album' => @$dataSend['id_album'],
                        'name_product1' => @$dataSend['name_product1'],
                        'name_video_11' => @$dataSend['name_video_11'],
                        'imagevideo11' => @$dataSend['imagevideo11'],
                        'embedded11' => @$dataSend['embedded11'],
                        'name_video_12' => @$dataSend['name_video_12'],
                        'imagevideo12' => @$dataSend['imagevideo12'],
                        'embedded12' => @$dataSend['embedded12'],
                        'name_product2' => @$dataSend['name_product2'],
                        'name_video_21' => @$dataSend['name_video_21'],
                        'imagevideo21' => @$dataSend['imagevideo21'],
                        'embedded21' => @$dataSend['embedded21'],
                        'name_video_22' => @$dataSend['name_video_22'],
                        'imagevideo22' => @$dataSend['imagevideo22'],
                        'embedded22' => @$dataSend['embedded22'],
                        'name_product3' => @$dataSend['name_product3'],
                        'name_video_31' => @$dataSend['name_video_31'],
                        'imagevideo31' => @$dataSend['imagevideo31'],
                        'embedded31' => @$dataSend['embedded31'],
                        'name_video_32' => @$dataSend['name_video_32'],
                        'imagevideo32' => @$dataSend['imagevideo32'],
                        'embedded32' => @$dataSend['embedded32'],
                        'name_product4' => @$dataSend['name_product4'],
                        'name_video_41' => @$dataSend['name_video_41'],
                        'imagevideo41' => @$dataSend['imagevideo41'],
                        'embedded41' => @$dataSend['embedded41'],
                        'name_video_42' => @$dataSend['name_video_42'],
                        'imagevideo42' => @$dataSend['imagevideo42'],
                        'embedded42' => @$dataSend['embedded42'],
                        
                    );

        $data->key_word = 'sttingReviewTheme';
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

function settingAboutusTheme($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện Review';
    $mess= '';

    $conditions = array('key_word' => 'settingAboutusTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();
       

        
        $value = array( 'image_banner' => @$dataSend['image_banner'],
                        'content' => @$dataSend['content'],
                        'image_left' => @$dataSend['image_left'],
                        'content_right' => @$dataSend['content_right'],
                        'content_left' => @$dataSend['content_left'],
                        'image_right' => @$dataSend['image_right'],
                        'mission' => @$dataSend['mission'],
                        'image_core1' => @$dataSend['image_core1'],
                        'name_core1' => @$dataSend['name_core1'],
                        'image_core2' => @$dataSend['image_core2'],
                        'name_core2' => @$dataSend['name_core2'],
                        'image_core3' => @$dataSend['image_core3'],
                        'name_core3' => @$dataSend['name_core3'],
                        'image_core4' => @$dataSend['image_core4'],
                        'name_core4' => @$dataSend['name_core4'],
                        'image_core5' => @$dataSend['image_core5'],
                        'name_core5' => @$dataSend['name_core5'],
                        'image_impression1' => @$dataSend['image_impression1'],
                        'name_impression1' => @$dataSend['name_impression1'],
                        'image_impression2' => @$dataSend['image_impression2'],
                        'name_impression2' => @$dataSend['name_impression2'],
                        'image_impression3' => @$dataSend['image_impression3'],
                        'name_impression3' => @$dataSend['name_impression3'],
                        'image_impression4' => @$dataSend['image_impression4'],
                        'name_impression4' => @$dataSend['name_impression4'],
                        'image_impression5' => @$dataSend['image_impression5'],
                        'name_impression5' => @$dataSend['name_impression5'],
                        'image' => @$dataSend['image'],
                        'content_below' => @$dataSend['content_below'],

                        'image_mission1' => @$dataSend['image_mission1'],
                        'image_mission2' => @$dataSend['image_mission2'],

                    );

        $data->key_word = 'settingAboutusTheme';
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

function aboutus(){
    global $controller;
    global $modelOptions;
     global $metaTitleMantan;
    $metaTitleMantan = 'Câu chuyện về bumas';

    $conditions = array('key_word' => 'settingAboutusTheme');
    $data = $modelOptions->find()->where($conditions)->first();

     $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }


    setVariable('setting', $data_value);


}

function indexTheme($input){
    global $modelAlbums;
    global $modelAlbuminfos;
    global $controller; 
    global $modelCategories;
    global $modelOptions;
    global $modelPosts;

    $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    $modelEvaluate = $controller->loadModel('Evaluates');
    $modelProduct = $controller->loadModel('Products');

    

     $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }


    $slide_home = $modelAlbums->find()->where(['id'=>(int)$data_value['id_slide']])->first();

    if(!empty($slide_home)){
        $slide_home->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$slide_home->id])->order(['id'=>'desc'])->all()->toList();
    }

     $news = $modelAlbums->find()->where(['id'=>(int)$data_value['id_bc']])->first();

    if(!empty($news)){
        $news->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$news->id])->all()->toList();
    }

    $product_flasl = $modelProduct->find()->limit(4)->where(['flash_sale'=>1,'status'=>'active'])->all()->toList();

    if(!empty($product_flasl)){
        foreach($product_flasl as $key => $item){
            $product_flasl[$key]->evaluatecount = count($modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList());
            $product_flasl[$key]->evaluate = $modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList();

            $point = 0;
            if(!empty($product_flasl[$key]->evaluate)){
                foreach($product_flasl[$key]->evaluate as $k => $s){
                    $point += $s->point;
                }
            }

            if(!empty($product_flasl[$key]->evaluatecount)){

                $product_flasl[$key]->point = $point/$product_flasl[$key]->evaluatecount;
            }
        }
    }
    $product_sold = $modelProduct->find()->limit(4)->where(['sold >='=>1])->order(array('sold'=>'desc'))->all()->toList();

    if(!empty($product_sold)){
        foreach($product_sold as $key => $item){
            $product_sold[$key]->evaluatecount = count($modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList());
            $product_sold[$key]->evaluate = $modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList();

            $point = 0;
            if(!empty($product_sold[$key]->evaluate)){
                foreach($product_sold[$key]->evaluate as $k => $s){
                    $point += $s->point;
                }
            }

            if(!empty($product_sold[$key]->evaluatecount)){

                $product_sold[$key]->point = $point/$product_sold[$key]->evaluatecount;
            }
        }
    }
    $product_search = $modelProduct->find()->limit(4)->where(['hot'=>1])->all()->toList();

    $listDataPost = $modelPosts->find()->limit(3)->where(array('pin'=>1))->all()->toList();

    setVariable('setting', $data_value);
    setVariable('product_flasl', $product_flasl);
    setVariable('product_sold', $product_sold);
    setVariable('product_search', $product_search);
    setVariable('slide_home', $slide_home);
    setVariable('news', $news);
    setVariable('listDataPost', $listDataPost);

}

function news(){
    global $modelPosts;
    global $controller;
    global $modelCategories;
    global $modelAlbums;
    global $modelAlbuminfos;
    global $metaTitleMantan;
    $metaTitleMantan = 'Tin tức';

    $order = array('id'=>'desc');

    $listDatatop= $modelPosts->find()->limit(1)->where(array('pin'=>1, 'type'=>'post'))->order($order)->all()->toList();
    $listDataView= $modelPosts->find()->limit(4)->where(array('view >'=>1, 'type'=>'post'))->order(array('view'=>'desc'))->all()->toList();
    $listDataNew= $modelPosts->find()->limit(4)->where(array('type'=>'post'))->order($order)->all()->toList();
    $listDataCategory1= $modelPosts->find()->limit(3)->where(array('idCategory'=>4, 'type'=>'post'))->order($order)->all()->toList();
    $listDataCategory2= $modelPosts->find()->limit(3)->where(array('idCategory'=>9, 'type'=>'post'))->order($order)->all()->toList();
    $listDataPost= $modelPosts->find()->limit(12)->where(array('type'=>'post'))->order($order)->all()->toList();

    $Category1 = $modelCategories->find()->where(array('id'=>4))->first()->name;
    $Category2 = $modelCategories->find()->where(array('id'=>9))->first()->name;

    $slide_news = $modelAlbums->find()->where(['id'=>'4'])->first();
    if(!empty($slide_news)){
        $slide_news->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$slide_news->id])->all()->toList();
    }

    setVariable('listDataPost', $listDataPost);
    setVariable('listDatatop', $listDatatop);
    setVariable('listDataNew', $listDataNew);
    setVariable('listDataCategory1', $listDataCategory1);
    setVariable('listDataCategory2', $listDataCategory2);
    setVariable('Category1', $Category1);
    setVariable('Category2', $Category2);
    setVariable('listDataView', $listDataView);
    setVariable('slide_news', $slide_news);


}

function guarantee(){
    global $modelOptions;
    global $metaTitleMantan;
    $metaTitleMantan = 'Chính sách bảo hành';

    $conditions = array('key_word' => 'sttingGuaranteeTheme');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
   
    setVariable('setting', $data_value);    

}

function instruction(){
    global $modelOptions;
     global $metaTitleMantan;
    $metaTitleMantan = 'Hướng dẫn kích hoạt bảo hành';
    $conditions = array('key_word' => 'sttingGuaranteeTheme');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
   
    setVariable('setting', $data_value);
}

function review(){
    global $modelAlbums;
    global $modelAlbuminfos;
    global $controller; 
    global $modelCategories;
    global $modelOptions;

    $conditions = array('key_word' => 'sttingReviewTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    $modelProduct = $controller->loadModel('Products');
    $modelEvaluate = $controller->loadModel('Evaluates');
    $modelReview = $controller->loadModel('Reviews');
    $modelCustomer = $controller->loadModel('Customers');
    $order = array('id'=>'desc');

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

     $slide_home = $modelAlbums->find()->where(['id'=>(int)$data_value['id_album']])->first();

    if(!empty($slide_home)){
        $slide_home->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$slide_home->id])->all()->toList();
    }

    $conditions = array();
    $conditions['status'] = 'active';

    $list_product = $modelProduct->find()->where($conditions)->order($order)->all()->toList();



    if(!empty($list_product)){
        foreach($list_product as $key => $item){
            $list_product[$key]->evaluate = $modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList();
            $review = $modelReview->find()->where(['id_product'=>$item->id])->all()->toList();
            foreach($review as $k => $value){
                $review[$k]->user = $modelCustomer->find()->where(['id'=>$value->id_user])->first();
            }
            $list_product[$key]->review = $review;
        }
    }

    


    setVariable('setting', $data_value);
    setVariable('list_product', $list_product);
    setVariable('slide_home', $slide_home);
}

function reviewkol(){
    global $modelAlbums;
    global $modelAlbuminfos;
    global $controller; 
    global $modelCategories;
    global $modelOptions;
    global $metaTitleMantan;
    $metaTitleMantan = 'Nhận xét từ các KOL, KOC';
    $conditions = array('key_word' => 'sttingReviewTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    $modelProduct = $controller->loadModel('Products');
    $modelEvaluate = $controller->loadModel('Evaluates');
    $modelReview = $controller->loadModel('Reviews');
    $modelCustomer = $controller->loadModel('Customers');
    $order = array('id'=>'desc');

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
     $slide_home = $modelAlbums->find()->where(['id'=>(int)$data_value['id_album']])->first();

    if(!empty($slide_home)){
        $slide_home->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$slide_home->id])->all()->toList();
    }

    $conditions = array();
    $conditions['status'] = 'active';

    $list_product = $modelProduct->find()->where($conditions)->order($order)->all()->toList();



    if(!empty($list_product)){
        foreach($list_product as $key => $item){
            $list_product[$key]->evaluate = $modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList();
            $review = $modelReview->find()->where(['id_product'=>$item->id])->all()->toList();
            foreach($review as $k => $value){
                $review[$k]->user = $modelCustomer->find()->where(['id'=>$value->id_user])->first();
            }
            $list_product[$key]->review = $review;
        }
    }

    


    setVariable('setting', $data_value);
    setVariable('list_product', $list_product);
    setVariable('slide_home', $slide_home);
}

function reviewBeatbox(){
    global $modelAlbums;
    global $modelAlbuminfos;
    global $controller; 
    global $modelCategories;
    global $modelOptions;
    global $metaTitleMantan;
    $metaTitleMantan = 'Khách hàng đập hộp';
    $conditions = array('key_word' => 'sttingReviewTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    $modelProduct = $controller->loadModel('Products');
    $modelEvaluate = $controller->loadModel('Evaluates');
    $modelReview = $controller->loadModel('Reviews');
    $modelCustomer = $controller->loadModel('Customers');
    $order = array('id'=>'desc');

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

     $slide_home = $modelAlbums->find()->where(['id'=>(int)$data_value['id_album']])->first();

    if(!empty($slide_home)){
        $slide_home->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$slide_home->id])->all()->toList();
    }
    $conditions = array();
    $conditions['status'] = 'active';

    $list_product = $modelProduct->find()->where($conditions)->order($order)->all()->toList();

    $conditionsreview = array();
    if(!empty($_GET['code'])){
        $conditionsreview['id_product'] = $_GET['code'];
    }

    $review = $modelReview->find()->where($conditionsreview)->all()->toList();
  
    foreach($review as $k => $value){
        if(!empty($value->id_product)){
            $review[$k]->product = $modelProduct->find()->where(['code'=>$value->id_product])->first();
        }

        $review[$k]->user = $modelCustomer->find()->where(['id'=>$value->id_user])->first();
    }

    setVariable('setting', $data_value);
    setVariable('list_product', $list_product);
    setVariable('review', $review);
    setVariable('slide_home', $slide_home);
}

function reviewProduct(){
    global $modelAlbums;
    global $modelAlbuminfos;
    global $controller; 
    global $modelCategories;
    global $modelOptions;
    global $metaTitleMantan;
    $metaTitleMantan = 'Review sản phẩm';
    $conditions = array('key_word' => 'sttingReviewTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    $modelProduct = $controller->loadModel('Products');
    $modelEvaluate = $controller->loadModel('Evaluates');
    $modelReview = $controller->loadModel('Reviews');
    $modelCustomer = $controller->loadModel('Customers');
    $order = array('id'=>'desc');

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

     $slide_home = $modelAlbums->find()->where(['id'=>(int)$data_value['id_album']])->first();

    if(!empty($slide_home)){
        $slide_home->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$slide_home->id])->all()->toList();
    }

    $conditions = array();
    $conditions['status'] = 'active';

    $list_product = $modelProduct->find()->where($conditions)->order($order)->all()->toList();

    $conditionsEvaluat = array();
    if(!empty($_GET['id_product'])){
        $conditionsEvaluat['id_product'] = $_GET['id_product'];
    }

    if(!empty($_GET['point'])){
        $conditionsEvaluat['point'] = $_GET['point'];
    }

    if(!empty($_GET['image'])){
        $conditionsEvaluat['image !='] = $_GET['image'];
    }
    $evaluate = $modelEvaluate->find()->where($conditionsEvaluat)->order($order)->all()->toList();



   
            foreach($evaluate as $k => $value){
                $evaluate[$k]->product = $modelProduct->find()->where(['id'=>$value->id_product])->first();
            }

    


    setVariable('setting', $data_value);
    setVariable('list_product', $list_product);
    setVariable('evaluate', $evaluate);
    setVariable('slide_home', $slide_home);
}

 ?>
