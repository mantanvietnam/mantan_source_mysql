<?php   
function listStaffAPI($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

     $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){

                $modelStaff = $controller->loadModel('Staffs');
                
                $order = array('id'=>'desc');

                $conditions = array('id_member'=>$infoMember->id);
                $limit = 20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                
                if(!empty($dataSend['id'])){
                    $conditions['id'] = (int) $dataSend['id'];
                }


                if(!empty($dataSend['name'])){
                    $conditions['name LIKE'] = '%'.$dataSend['name'].'%';
                }

                if(!empty($dataSend['phone'])){
                    $conditions['phone'] = $dataSend['phone'];
                }

               

                if(!empty($dataSend['status'])){
                    $conditions['status'] = $dataSend['status'];
                }

                if(!empty($dataSend['email'])){
                    $conditions['email'] = $dataSend['email'];
                }

                $listData = $modelStaff->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
                

                // phân trang
                $totalData = $modelStaff->find()->where($conditions)->all()->toList();
                $totalData = count($totalData);
              
                $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>$totalData);

            }else{
                $return = array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function addStaffAPI($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['name']) && !empty($dataSend['phone'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){

                $modelStaff = $controller->loadModel('Staffs');

                $mess= '';

                $infoUser = $session->read('infoUser');

                // lấy data edit
                if(!empty($dataSend['id'])){
                    $data = $modelStaff->find()->where(['id'=>(int) $dataSend['id'], 'id_member'=>$infoMember->id])->first();
                }else{
                    $data = $modelStaff->newEmptyEntity();
                    $data->created_at = time();
                }

                $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                $conditions = ['phone'=>$dataSend['phone'],'id_member'=>$infoMember->id];
                $checkPhone = $modelStaff->find()->where($conditions)->first();

                if(empty($checkPhone) || (!empty($dataSend['id']) && $dataSend['id']==$checkPhone->id) ){
                  

                    if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                        if(!empty($data->id)){
                            $fileName = 'avatar_staff_'.$data->id;
                        }else{
                            $fileName = 'avatar_staff_'.time().rand(0,1000000);
                        }

                        $avatar = uploadImage($infoMember->id, 'avatar', $fileName);
                    }

                    if(!empty($avatar['linkOnline'])){
                        $data->avatar = $avatar['linkOnline'].'?time='.time();
                    }else{
                        if(empty($data->avatar)){
                            if(!empty($system->image)){
                                $data->avatar = $system->image;
                            }

                            if(empty($data->avatar)){
                                $data->avatar = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png';
                            }
                        }
                    }
                    
                    $data->name = $dataSend['name'];
                    $data->address = $dataSend['address'];
                    $data->phone = $dataSend['phone'];
                    $data->id_system = (int) $infoMember->id_system;
                    $data->id_member = (int) $infoMember->id;
                    $data->email = $dataSend['email'];
                    $data->linkedin = $dataSend['linkedin'];
                    $data->web = $dataSend['web'];
                    $data->instagram = $dataSend['instagram'];
                    $data->zalo = $dataSend['zalo'];
                    $data->twitter = $dataSend['twitter'];
                    $data->tiktok = $dataSend['tiktok'];
                    $data->youtube = $dataSend['youtube'];
                    $data->facebook = $dataSend['facebook'];
                    if(!empty($dataSend['birthday'])){
                        $birthday = explode('/', $dataSend['birthday']);
                         $data->birthday  = mktime(0,0,0,$birthday[1],$birthday[0],$birthday[2]);
                    }
                    $data->status = $dataSend['status']; 
                    $data->description = $dataSend['description']; 

                    if(empty($_GET['id'])){
                        if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
                        $data->password = md5($dataSend['password']);

                        $data->created_at = time();
                        $data->deadline = $infoUser->deadline; 
                         
                    }else{
                        if(!empty($dataSend['password'])){
                            $data->password = md5($dataSend['password']);
                        }
                    }

                    $modelStaff->save($data);
                     return array('code'=>1, 'mess'=>'Bạn lưu thành công');
                }else{
                     $return = array('code'=>3, 'mess'=>'Số điện thoại đã tồn tại');
                 }
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

function deleteStaffAPI($input){
      global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
        if(!empty($_GET['id']))
            $data = $modelStaff->find()->where(['id_member'=>$infoMember->id, 'id'=>(int) $dataSend['id']])->first();
            
            if($data){
                $modelStaff->delete($data);
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

 ?>