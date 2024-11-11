<?php 
function listRatingPoint($input){
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách xếp hạng thành viên';
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    $user = checklogin('listRatingPoint');  
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $mess = '';
        // Tạo subquery để tìm giá trị point_min cao nhất
        $subquery = $modelRatingPointCustomer->find();
        $subquery->select(['max_point_min' => $subquery->func()->max('point_min')]);

       

        if ($isRequestPost) {
            $edit = checklogin('addRatingPoint');
            if(!empty($edit->grant_permission)){
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
                     $mess = '<p class="text-success">Sửa thành công</p>';
                }else{
                     // Tìm bản ghi có giá trị point_min cao nhất
                    $query = $modelRatingPointCustomer->find()->where(['point_min' => $subquery])->first();
                    
                    if(empty($query) || $query->point_min < (int)$dataSend['point_min']){
                        $infoCategory = $modelRatingPointCustomer->newEmptyEntity();
                        
                        $infoCategory->created_at = time(); 
                        $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                        $infoCategory->point_min = (int) $dataSend['point_min'];
                        //$infoCategory->status = 'active';
                        $infoCategory->note = @$dataSend['note'];
                        
                        $modelRatingPointCustomer->save($infoCategory);

                      $mess = '<p class="text-success">Thêm thành công</p>';
                    }else{
                        $mess = '<p class="text-danger">Điểm phải lơn hơn hạng trước</p>';
                    }
                
                }

                if(!empty($dataSend['idEdit'])){
                    $note = $user->type_tv.' '. $user->name.' sửa thông tin xếp hạng '.$infoCategory->name.' có id là:'.$infoCategory->id;
                }else{
                    $note = $user->type_tv.' '. $user->name.' tạo mới thông tin xếp hạng '.$infoCategory->name.' có id là:'.$infoCategory->id;
                }

                addActivityHistory($user,$note,'addRatingPoint',$infoCategory->id);
            }else{
               $mess= '<p class="text-danger">Bạn không có quyền thêm sửa </p>'; 

            }
        }
        $conditions = [];
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
    $user = checklogin('deleteRatingPoint');  
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        if(!empty($_GET['id'])){
            $data = $modelRatingPointCustomer->get($_GET['id']);
            
            if($data){
                $data->status = 'lock';
                $modelRatingPointCustomer->save($data);
                //deleteSlugURL($data->slug);
                $note = $user->type_tv.' '. $user->name.' xóa thông tin xếp hạng '.$data->name.' có id là:'.$data->id;
                addActivityHistory($user,$note,'deleteRatingPoint',$data->id);
            }
        }

    // return $controller->redirect('/listProductAgency');

    }else{
        return $controller->redirect('/login');
    }
}
 ?>