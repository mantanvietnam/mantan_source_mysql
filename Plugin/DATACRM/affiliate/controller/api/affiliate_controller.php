<?php 
function searchAffiliateAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $modelCategories;

    $return= array();
    $modelAffiliaters = $controller->loadModel('Affiliaters');
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');

        $dataSend = $_REQUEST;
            
        $conditions = ['id_member'=>$user->id];

        
        if(!empty($dataSend['term'])){
            $conditions['or'] = [['name LIKE' => '%'.$dataSend['term'].'%'], ['phone LIKE' => '%'.$dataSend['term'].'%']];
        }

        if(!empty($dataSend['id'])){
            $conditions['id'] = (int) $dataSend['id'];
        }

        if(!empty($dataSend['phone'])){
            $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
            $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

            $conditions['phone LIKE'] = '%'.$dataSend['phone'].'%';
        }

        if(!empty($dataSend['email'])){
            $conditions['email'] = $dataSend['email'];
        }

        if(!empty($dataSend['id_father'])){
            $conditions['id_father'] = (int) $dataSend['id_father'];
        }

        $listData= $modelAffiliaters->find()->where($conditions)->all()->toList();
        
        if($listData){
            foreach($listData as $data){
                $return[]= array(   'id'=>$data->id,
                                    'label'=>$data->name.' '.$data->phone,
                                    'value'=>$data->id,
                                    'name'=>$data->name,
                                    'avatar'=>$data->avatar,
                                    'phone'=>$data->phone,
                                    'id_father'=>$data->id_father,
                                    'email'=>$data->email,
                                    'created_at'=>$data->created_at,
                                    'address'=>$data->address,
                                );
            }
        }else{
            $return= array(array(   'id'=>0, 
                                    'label'=>'Không tìm được CTV, hãy tạo thông tin cho CTV mới', 
                                    'value'=>'', 
                                )
                    );
        }

        return $return;
    }else{
        return $controller->redirect('/login');
    }
}

function saveInfoAffiliaterAPI($input){
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelCategories;
    global $urlHomes;
    global $session;
 
    if($isRequestPost){

        $modelAffiliaters = $controller->loadModel('Affiliaters');
        $modelMembers = $controller->loadModel('Members');
        $modelCustomers = $controller->loadModel('Customers');

     
        $data = $modelAffiliaters->newEmptyEntity();
        $data->created_at = time();

        $dataSend = $input['request']->getData();
      
        if($dataSend['password']!=$dataSend['password_confirmation']){

            return array('code'=>2, 'mess'=>'Mật khẩu nhập lại Không dúng ');
        }

        if(!empty($dataSend['full_name']) && !empty($dataSend['phone']) && !empty($dataSend['password'])){
            $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
            $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

            $conditions = ['phone'=>$dataSend['phone']];
            $checkPhone = $modelAffiliaters->find()->where($conditions)->first();
            if(empty($checkPhone)){
              
                if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                    $avatar = uploadImage($dataSend['id_member'], 'avatar', 'avatar_'.$dataSend['phone']);
                    if(!empty($avatar['linkOnline'])){
                        $data->avatar = $avatar['linkOnline'];
                    }
                }

                if(empty($data->avatar)){
                        $data->avatar = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-ezpics.png';
                    
                }

                // tạo dữ liệu save
                $data->name = @$dataSend['full_name'];
                $data->address = @$dataSend['address'];
                $data->portrait = @$dataSend['portrait'];
                $data->phone = @$dataSend['phone'];
                $data->email = @$dataSend['email'];
                $data->description = @$dataSend['description'];
                    
                $data->linkedin = @$dataSend['linkedin'];
                $data->web = @$dataSend['web'];
                $data->instagram = @$dataSend['instagram'];
                $data->zalo = @$dataSend['zalo'];
                $data->facebook = @$dataSend['facebook'];
                $data->twitter = @$dataSend['twitter'];
                $data->tiktok = @$dataSend['tiktok'];
                $data->youtube = @$dataSend['youtube'];

                $data->id_father =0;
                $data->id_system =1;

                $data->id_customer = 0;
                $data->id_member = $dataSend['id_member'];

                if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
                $data->password = md5($dataSend['password']);
                $modelAffiliaters->save($data);
                
                return array('code'=>1, 'mess'=>'Bạn đăng ký thành công', 'data'=>$data);

                if(!empty($data->id_member) && function_exists('sendNotification')){
                    $modelTokenDevices = $controller->loadModel('TokenDevices');
                    $modelMembers = $controller->loadModel('Members');

                    $infoMember = $modelMembers->find()->where(['id'=>$data->id_member])->first();

                    if(!empty($infoMember->noti_new_order)){
                        $dataSendNotification= array('title'=>'Có cộng tác viên mới','time'=>date('H:i d/m/Y'),'content'=>$data->name.' đã trở thành cộng tác viên mới của bạn','action'=>'createAffiliater','id_aff'=>$data->id);
                        $token_device = [];

                        $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMember->id])->all()->toList();

                        $id_member = [];
                        if(!empty($listTokenDevice)){
                            foreach ($listTokenDevice as $tokenDevice) {
                                if(!empty($tokenDevice->token_device)){
                                    $token_device[] = $tokenDevice->token_device;
                                    if(!empty($tokenDevice->id_member) && !in_array($tokenDevice->id_member, $id_member)){
                                        $id_member[] =  $tokenDevice->id_member;
                                    }
                                }
                            }

                            if(!empty($token_device)){
                                $return = sendNotification($dataSendNotification, $token_device);

                                if(!empty($id_member)){
                                    saveNotification($dataSendNotification, $id_member, @$data->id, 'member');
                                }
                            }
                        }
                    }

                    /*if(!empty($infoMember->email)){
                        getContentEmailAdmin(@$dataSend['full_name'],@$dataSend['email'],@$dataSend['phone'],@$dataSend['address'],@$dataSend['note_user'],$listproduct, $pay, $data, $infoMember->email);
                    }*/
                }

            }else{
                if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
                $checkPhone->password = md5($dataSend['password']);

                $modelAffiliaters->save($checkPhone);
            }

            return array('code'=>1, 'mess'=>'Số điện thoại đã tồn tại', 'data'=>$checkPhone);
        }
        return array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
    }
    return array('code'=>0, 'mess'=>'gửi sai kiểu POST');
}
?>