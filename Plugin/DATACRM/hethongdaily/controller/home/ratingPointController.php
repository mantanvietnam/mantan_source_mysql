<?php 
function listRatingPoint($input){
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách xếp hạng thành viên';
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        $mess = '';
        // Tạo subquery để tìm giá trị point_min cao nhất
        $subquery = $modelRatingPointCustomer->find();
        $subquery->select(['max_point_min' => $subquery->func()->max('point_min')]);

       

        if ($isRequestPost) {
            if(!empty($user->id_father)){
                return $controller->redirect('/listRatingPoint');
            }
            $dataSend = $input['request']->getData();
            
            // tính ID category
            if(!empty($dataSend['idEdit'])){
                $infoCategory = $modelRatingPointCustomer->get( (int) $dataSend['idEdit']);

                // tạo dữ liệu save
                $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                $infoCategory->point_min = (int) $dataSend['point_min'];
                $infoCategory->status = 'active';
                $infoCategory->note = @$dataSend['note'];
                $modelRatingPointCustomer->save($infoCategory);
                 $mess = '<p class="text-success">sưa thành công</p>';
            }else{
                 // Tìm bản ghi có giá trị point_min cao nhất
                $query = $modelRatingPointCustomer->find()->where(['point_min' => $subquery])->first();
                if($query->point_min < (int)$dataSend['point_min']){
                    $infoCategory = $modelRatingPointCustomer->newEmptyEntity();
                    $infoCategory->created_at = time(); 
                    // tạo dữ liệu save
                    $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                    $infoCategory->point_min = (int) $dataSend['point_min'];
                    $infoCategory->status = 'active';
                    $infoCategory->note = @$dataSend['note'];
                    $modelRatingPointCustomer->save($infoCategory);

                  $mess = '<p class="text-success">Thêm thành công</p>';
                }else{
                    $mess = '<p class="text-danger">Điểm phải lơn hơn hạng trước</p>';
                }
                
            }
        }
        $conditions =array('status'=>'active');
        $listData = $modelRatingPointCustomer->find()->where($conditions)->all()->toList();


        setVariable('listData', $listData);
        setVariable('user', $user);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteRatingPoint($input){
    global $controller;
    global $session;
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    if(!empty($session->read('infoUser'))){
        if(!empty($_GET['id'])){
            $data = $modelRatingPointCustomer->get($_GET['id']);
            
            if($data){
                $data->status = 'lock';
                $modelRatingPointCustomer->save($data);
                //deleteSlugURL($data->slug);
            }
        }

    // return $controller->redirect('/listProductAgency');

    }else{
        return $controller->redirect('/login');
    }
}
 ?>