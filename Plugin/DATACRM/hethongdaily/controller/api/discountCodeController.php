<?php 
function searchDiscountCodeAgencyAPI($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $return = array('code'=>1);

    $modelDiscountCode = $controller->loadModel('DiscountCodes');
    
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
    }

    $conditions = array();
    
    if(!empty($_GET['code']) && !empty($_GET['id_member'])){
        $conditions['code'] = strtoupper($_GET['code']);
        $conditions['status'] = 1;
        $conditions['id_member'] = (int) $_GET['id_member'];
        
        $data = $modelDiscountCode->find()->where($conditions)->first();

        if(!empty($data)){
            $return = array('code'=>0, 'mess'=>'', 'data'=>$data);
        }else{
            $return = array('code'=>3, 'mess'=>'Không tồn tại mã khuyến mại này');
        }
    }else{
        $return = array('code'=>2, 'mess'=>'');
    }

    return $return;
} 

function listDiscountCodeAPI($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    $modelDiscountCode = $controller->loadModel('DiscountCodes');

    if ($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'listDiscountCodeAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
    
                $conditions = array('id_member'=>$infoMember->id);
               
                $limit = 20;
                $page = (!empty($infoMember['page']))?(int)$infoMember['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');
                
                $listData = $modelDiscountCode->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
                $totalData = count($modelDiscountCode->find()->where($conditions)->all()->toList());

                if(!empty($listData)){
                    foreach ($listData as $key => $value) {
                        $conditions_scan = array('id'=>$value->id);
                        $static = $modelDiscountCode->find()->where($conditions_scan)->all()->toList();
                        $listData[$key]->number_scan = count($static);
                    }
                }

                 $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công', 'listData'=>$listData, 'totalData'=>$totalData);
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai kiểu POST');

    }

    return $return;
}
function addDiscountCodeAPI($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin mã giảm giá';


    $modelDiscountCode = $controller->loadModel('DiscountCodes');
     if ($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'addDiscountCodeAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                if(!empty($dataSend['id'])){
                    $data = $modelDiscountCode->find()->where(array('id'=>(int) $dataSend['id'],'id_member'=>$infoMember->id))->first();

                }else{
                    $data = $modelDiscountCode->newEmptyEntity();
                    $data->created_at = date('Y-m-d H:i:s');
                }
                // tạo dữ liệu save
                $data->name = @$dataSend['name'];
                $data->id_member = $infoMember->id;
                $data->status = @$dataSend['status'];
                $data->code = strtoupper(@$dataSend['code']);
                $data->discount = (double) @$dataSend['discount'];
                $data->maximum_price_reduction = @$dataSend['maximum_price_reduction'];
                $data->number_user = @$dataSend['number_user'];
                $data->category = @$dataSend['category'];
                if(!empty($dataSend['deadline_at'])){
                    $data->deadline_at = DateTime::createFromFormat('d/m/Y', @$dataSend['deadline_at'])->format('Y-m-d 23:59:59');
                }
                
                $data->note = @$dataSend['note'];
                $data->applicable_price = @$dataSend['applicable_price'];
                $modelDiscountCode->save($data);

                if(!empty($dataSend['id'])){
                        $note = $infoMember->type_tv.' '. $infoMember->name.' sửa thông tin mã giảm giá'.$data->name.' có id là:'.$data->id;
                    }else{
                        $note = $infoMember->type_tv.' '. $infoMember->name.' thêm thông tin mã giảm giá'.$data->name.' có id là:'.$data->id;
                    }

                    addActivityHistory($infoMember,$note,'addDiscountCodeAgency',$data->id);

                $return = array('code'=>1, 'mess'=>'Lưu dữ liệu thành công','data'=>$data);
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

function deleteDiscountCodeAPI($input){
    global $controller;
    global $isRequestPost;
    $modelDiscountCode = $controller->loadModel('DiscountCodes');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token'],'deleteDiscountCodeAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                $data = $modelDiscountCode->find()->where(array('id'=>$dataSend['id'],'id_member'=>$infoMember->id))->first();
                    
                if(!empty($data)){
                    $note = $infoMember->type_tv.' '. $infoMember->name.' xóa thông tin mã giảm giảm  '.$data->code.' có id là:'.$data->id;
                    addActivityHistory($infoMember,$note,'deleteDiscountCodeAPI',$data->id);
                    $modelDiscountCode->delete($data);
                    $return = array('code'=>1, 'mess'=>'xóa dữ liệu thành công ');
                }else{
                     $return = array('code'=>4, 'mess'=>'Dữ liệu không tồn tại ');
                }
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

function getDiscountCodeByIdAPI($input){
    global $controller;
    global $isRequestPost;
    $modelDiscountCode = $controller->loadModel('DiscountCodes');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token'],'listDiscountCodeAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                $data = $modelDiscountCode->find()->where(array('id'=>$dataSend['id'],'id_member'=>$infoMember->id))->first();
                    
                if(!empty($data)){
                    
                    $return = array('code'=>1, 'mess'=>'lấy dữ liệu thành công','data'=> $data);
                }else{
                     $return = array('code'=>4, 'mess'=>'Dữ liệu không tồn tại ');
                }
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
 ?>