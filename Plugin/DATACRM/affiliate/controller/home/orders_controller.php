<?php 
function bookOnline($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $metaImageMantan;
    global $metaDescriptionMantan;
    global $session;
    global $urlHomes;

    $modelAffiliaters = $controller->loadModel('Affiliaters');
    $modelMembers = $controller->loadModel('Members');
    $session->write('infoUser', []);

    if(!empty($_GET['aff'])){
        $_GET['aff'] = trim(str_replace(array(' ','.','-'), '', $_GET['aff']));
        $_GET['aff'] = str_replace('+84','0',$_GET['aff']);

        $info = $modelAffiliaters->find()->where(['phone'=> $_GET['aff']])->first();

        if(!empty($info)){
            $metaTitleMantan = $info->name;
            $metaImageMantan = (!empty($info->banner))?$info->banner:$info->avatar;
            $metaDescriptionMantan = strip_tags($info->description);

            // tăng lượt xem
            $info->view ++;
            $modelAffiliaters->save($info);
            $info->view += 1000;

            $system = $modelCategories->find()->where(array('id'=>$info->id_system ))->first();
                
            $info->name_system = @$system->name;
            $info->image_system = @$system->image;

            $members = $modelMembers->find()->where(array('id'=>@$info->id_member))->first();

            if(function_exists('getAllProductActive') && !empty($members)){
                // lấy sản phẩm trong kho
                $conditions = array('id_member'=>$members->id);
                $warehouseProduct = $modelWarehouseProducts->find()->where($conditions)->all()->toList();
                if($members->product_distribution=='allPoduct'){
                    $allProduct = getAllProductActive();
                }else{
                    $allProduct = [];
                    if(!empty($warehouseProduct)){
                        foreach ($warehouseProduct as $product) {
                            if($product->quantity > 0){
                                $infoProduct = getProduct($product->id_product);

                                if(!empty($infoProduct)){
                                    $allProduct[] = $infoProduct;
                                }
                            }
                        }
                    }
                }



                $allCategoryProduct = getAllCategoryProduct();
                $listProduct = [];

                if(!empty($allCategoryProduct)){
                    foreach ($allCategoryProduct as $category) {
                        $listProduct[$category->id]['category'] = $category;
                    }
                }

                if(!empty($allProduct)){
                    foreach ($allProduct as $product) {
                        $listProduct[$product->id_category]['product'][$product->id] = $product;
                    }
                }
                
                setVariable('listProduct', $listProduct);
            }

            $system = $modelCategories->find()->where(array('id'=>$members->id_system ))->first();
                
            $members->name_position = @$position->name;
            $members->name_system = @$system->name;
            $members->image_system = @$system->image;
        
            setVariable('info', $info);
            setVariable('members', $members);
        }else{
            return $controller->redirect('/');
        }
    }else{
        return $controller->redirect('/');
    }
}
?>