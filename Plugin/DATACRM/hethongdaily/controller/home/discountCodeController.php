<?php 
function listDiscountCodeAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách mã giảm giá';

    $modelDiscountCode = $controller->loadModel('DiscountCodes');
    $user = checklogin('listDiscountCodeAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
    
        $conditions = array('id_member'=>$user->id);
         if(!empty($_GET['name'])){
            $key=createSlugMantan($_GET['name']);

            $conditions['urlSlug LIKE']= '%'.$key.'%';
        }
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');
        
        $listData = $modelDiscountCode->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $conditions_scan = array('id'=>$value->id);
                $static = $modelDiscountCode->find()->where($conditions_scan)->all()->toList();
                $listData[$key]->number_scan = count($static);
            }
        }

        // phân trang
        $totalData = $modelDiscountCode->find()->where($conditions)->all()->toList();
        $totalData = count($totalData);

        $balance = $totalData % $limit;
        $totalPage = ($totalData - $balance) / $limit;
        if ($balance > 0)
            $totalPage+=1;

        $back = $page - 1;
        $next = $page + 1;
        if ($back <= 0)
            $back = 1;
        if ($next >= $totalPage)
            $next = $totalPage;

        if (isset($_GET['page'])) {
            $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
            $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
        } else {
            $urlPage = $urlCurrent;
        }
        if (strpos($urlPage, '?') !== false) {
            if (count($_GET) >= 1) {
                $urlPage = $urlPage . '&page=';
            } else {
                $urlPage = $urlPage . 'page=';
            }
        } else {
            $urlPage = $urlPage . '?page=';
        }
        
        $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        $conditions = array('type' => 'category_product');
        $categories = $modelCategories->find()->where($conditions)->all()->toList();
        $listCategory = [];
        if(!empty($categories)){
            foreach ($categories as $key => $value) {
                $listCategory[$value->id] = $value->name;
            }
        }

        setVariable('mess', @$mess);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);
        setVariable('listCategory', $listCategory);
    }else{
        return $controller->redirect('/login');
    }
}

function addDiscountCodeAgency($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin mã giảm giá';


    $modelDiscountCode = $controller->loadModel('DiscountCodes');
    $mess= '';
    $user = checklogin('addDiscountCodeAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelDiscountCode->find()->where(array('id'=>(int) $_GET['id'],'id_member'=>$user->id))->first();

        }else{
            $data = $modelDiscountCode->newEmptyEntity();
            $data->created_at = date('Y-m-d H:i:s');
        }


        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name'])){
                // tạo dữ liệu save
                $data->name = @$dataSend['name'];
                $data->id_member = $user->id;
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
                        $note = $user->type_tv.' '. $user->name.' sửa thông tin mã giảm giá'.$data->name.' có id là:'.$data->id;
                    }else{
                        $note = $user->type_tv.' '. $user->name.' thêm thông tin mã giảm giá'.$data->name.' có id là:'.$data->id;
                    }

                    addActivityHistory($user,$note,'addDiscountCodeAgency',$data->id);

                 return $controller->redirect('/listDiscountCodeAgency/mess=saveSuccess');
                $data = $modelDiscountCode->find()->where(array('id'=>(int) $data->id,'id_member'=>$user->id))->first();
               
                
            }else{
                $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
            }
        }


        setVariable('data', $data);
        setVariable('mess', $mess);

    }else{
        return $controller->redirect('/login');
    }

}

function deleteDiscountCodeAgency($input){
    global $session;
    global $controller;
   $user = checklogin('deleteDiscountCodeAgency');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        if(!empty($_GET['id'])){
            $data = $modelDiscountCode->find()->where(array('id'=>$_GET['id'],'id_member'=>$user->id))->first();
            
            if($data){
                $modelDiscountCode->delete($data);
                return $controller->redirect('/listDiscountCodeAgency/mess=deleteSuccess');
            }
        }
        return $controller->redirect('/listDiscountCodeAgency/mess=deleteError');

        return $controller->redirect('/listDiscountCodeAgency');
    }else{
        return $controller->redirect('/login');
    }
}
?>