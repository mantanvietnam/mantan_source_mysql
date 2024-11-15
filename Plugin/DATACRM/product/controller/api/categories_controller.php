<?php 
function getCategoryProductAPI($input)
{
    global $modelCategories;
    
    $conditionCategorieProduct = array('type' => 'category_product', 'status'=>'active');
    
    return  $modelCategories->find()->where($conditionCategorieProduct)->order(['weighty'=>'asc'])->all()->toList();
}

function addCategoryProductAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['token']) && !empty($dataSend['name'])){
            $infoMember = getMemberByToken($dataSend['token'],'editCategoryCustomerAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>6, 'mess'=>'Bạn không có quyền');
                }

                if($infoMember->id_father==0){
                    // tính ID category
                    if(!empty($dataSend['id'])){
                        $infoCategory = $modelCategories->get( (int) $dataSend['id']);
                    }else{
                        $infoCategory = $modelCategories->newEmptyEntity();
                    }

                    // tạo dữ liệu save
                    $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                    $infoCategory->parent = 0;
                    
                    if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
                        if(!empty($data->id)){
                            $fileName = 'image_categorie_product_'.$data->id;
                        }else{
                            $fileName = 'image_categorie_product_'.time().rand(0,1000000);
                        }
                            $image = uploadImage($infoMember->id, 'image', $fileName);
                            $infoCategory->image = @$image['linkOnline'];
                    }
                
                    $infoCategory->status = 'active';
                    $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
                    $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
                    $infoCategory->type = 'category_product';

                    // tạo slug
                    $slug = createSlugMantan($infoCategory->name);
                    $slugNew = $slug;
                    $number = 0;
                    do{
                        $conditions = array('slug'=>$slugNew,'type'=>'category_product');
                        $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                        if(!empty($listData)){
                            $number++;
                            $slugNew = $slug.'-'.$number;
                        }
                    }while (!empty($listData));

                    $infoCategory->slug = $slugNew;

                    $modelCategories->save($infoCategory);

                    if(!empty($dataSend['id'])){
                            $note = $infoMember->type_tv.' '. $infoMember->name.' sửa thông tin nhóm sản phẩm '.$infoCategory->name.' có id là:'.$infoCategory->id;
                        
                    }else{
                        $note = $infoMember->type_tv.' '. $infoMember->name.' tạo mới thông tin nhóm sản phẩm '.$infoCategory->name.' có id là:'.$infoCategory->id;
                    }

                    addActivityHistory($infoMember,$note,'listCategoryProductAgency',$infoCategory->id);


                    $return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công ', 'data' =>$infoCategory );
                    
                }else{
                    $return = array('code'=>5, 'mess'=>'Tài khoản của bạn không phải boss');
                }
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
              $return = array('code'=>3, 'mess'=>'chưa nhập token');
        }
    }else{
        $return  = array('code'=>2,  'mess'=>'Truyền dữ liệu kiểu POST');
    }

    return $return;

}

function deleteCategoryProductAPI($input){
    global $controller;
    global $session;
    global $modelCategories;
    global $isRequestPost;
    $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token'],'deleteProductAgency');

            if(!empty($infoMember)){    
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }

                if($infoMember->id_father==0){
                    $data = $modelCategories->find()->where(['id'=>(int)$dataSend['id'],'type'=>'category_product'])->first();
                    if($data){
                        $data->status = 'lock';
                        $modelCategories->save($data);
                        $note = $infoMember->type_tv.' '. $infoMember->name.' xóa thông tin nhóm sản phẩm '.$data->name.' có id là:'.$data->id;
                         addActivityHistory($infoMember,$note,'deleteCategoryProductAgency',$data->id);
                        //deleteSlugURL($data->slug);
                        $return = array('code'=>0, 'mess'=>'Xóa danh mục sản phẩn thành công');
                    }else{
                        $return = array('code'=>4, 'mess'=>'Không tìm thấy sản phẩn');
                    }
                }else{
                    $return = array('code'=>5, 'mess'=>'bạn không phải là boss');
                }            
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function getCategoryProductByIdAPI($input){
    global $controller;
    global $session;
    global $modelCategories;
    global $isRequestPost;
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token']);
            
            if(!empty($infoMember)){    
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                    $data = $modelCategories->find()->where(['id'=>(int)$dataSend['id'],'type'=>'category_product'])->first();
                    if($data){
                    //deleteSlugURL($data->slug);
                     $return = array('code'=>0, 'mess'=>'Lấy dữ liệu thành công','data'=>$data);
                    }else{
                        $return = array('code'=>4, 'mess'=>'Không tìm thấy sản phẩn');
                    }
                            
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}
?>