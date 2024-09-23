<?php 
function listStaff($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách nhân viên';

        $modelStaff = $controller->loadModel('Staffs');
        
        $order = array('id'=>'desc');

        $conditions = array('id_member'=>$session->read('infoUser')->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        
        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }


        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }

        if(!empty($_GET['phone'])){
            $conditions['phone'] = $_GET['phone'];
        }

       

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['email'])){
            $conditions['email'] = $_GET['email'];
        }

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelStaff->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel =   [
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],
                ['name'=>'Email', 'type'=>'text', 'width'=>25],
                ['name'=>'Trạng thái', 'type'=>'text', 'width'=>25],
                ['name'=>'Ngày sinh', 'type'=>'text', 'width'=>25], 
            ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $status= 'Khóa';
                    if($value->status=='active'){ 
                        $status= 'Kích hoạt';
                    }

                    $birthday = '';
                    if(!empty($value->birthday)){
                        $birthday = date('d/m/Y',$value->birthday);
                    }

                    $dataExcel[] = [
                        $value->full,   
                        $value->phone,   
                        $value->address,   
                        $value->email,  
                        $status,
                        $birthday
                    ];
                }
            }
            export_excel($titleExcel,$dataExcel,'danh_sach_khach_hang');
        }else{
            $listData = $modelStaff->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        }

        // phân trang
        $totalData = $modelStaff->find()->where($conditions)->all()->toList();
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

        setVariable('mess', $mess);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        
        setVariable('listData', $listData);
       // / setVariable('listGroup', $listGroup);
    }else{
        return $controller->redirect('/login');
    }
}

function addStaff($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    if(!empty($session->read('infoUser'))){
        if($session->read('infoUser')->create_agency == 'lock'){
            return $controller->redirect('/listStaff');
        }

        $metaTitleMantan = 'Thông tin nhân viên';
        $modelStaff = $controller->loadModel('Staffs');

        $mess= '';

        $infoUser = $session->read('infoUser');

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelStaff->find()->where(['id'=>(int) $_GET['id'], 'id_member'=>$infoUser->id])->first();

            if(empty($data)){
                return $controller->redirect('/listMember');
            }
        }else{
            $data = $modelStaff->newEmptyEntity();
            $data->created_at = time();
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
                $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                $conditions = ['phone'=>$dataSend['phone'],'id_member'=>$infoUser->id];
                $checkPhone = $modelStaff->find()->where($conditions)->first();

                if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
                  

                    if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                        if(!empty($data->id)){
                            $fileName = 'avatar_staff_'.$data->id;
                        }else{
                            $fileName = 'avatar_staff_'.time().rand(0,1000000);
                        }

                        $avatar = uploadImage($infoUser->id, 'avatar', $fileName);
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
                    $data->id_system = (int) $infoUser->id_system;
                    $data->id_member = (int) $infoUser->id;
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
                     return $controller->redirect('/listStaff?mess=saveSuccess');
                }else{
                    $mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
                }
            
            }else{
                $mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
            }
        }
        
        setVariable('data', $data);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteStaff($input){
      global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;
    if(!empty($session->read('infoUser'))){
         $modelStaff = $controller->loadModel('Staffs');
        if(!empty($_GET['id'])){
            $data = $modelStaff->find()->where(['id_member'=>$session->read('infoUser')->id, 'id'=>(int) $_GET['id']])->first();
            
            if($data){
                $modelStaff->delete($data);
                 return $controller->redirect('/listStaff?mess=deleteSuccess');
            }
        }
         return $controller->redirect('/listStaff?mess=deleteError');
    }else{
        return $controller->redirect('/login');
    }
}

function timesheetStaff(){

    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Bản châm  nhân viên';

        $modelStaff = $controller->loadModel('Staffs');
        
        $order = array('id'=>'desc');

        $conditions = array('id_member'=>$session->read('infoUser')->id);

        // phân trang
        $listStaff = $modelStaff->find()->where($conditions)->all()->toList();
        // Thiết lập tháng và năm

        if(!empty($_GET['month'])){
            $thang = (int) $_GET['month'];
        }else{
            $thang = date('m');
        }

        if(!empty($_GET['year'])){
            $nam = (int) $_GET['year'];
        }else{
            $nam = date('Y');
        }

        // Lấy số ngày trong tháng
        $so_ngay_trong_thang = cal_days_in_month(CAL_GREGORIAN, $thang, $nam);

        $date = array();

        // Lặp qua các ngày trong tháng
        for ($ngay = 1; $ngay <= $so_ngay_trong_thang; $ngay++) {
            // Tạo chuỗi ngày định dạng Y-m-d
            $ngay_dang = sprintf("%04d-%02d-%02d", $nam, $thang, $ngay);
            
            // Lấy tên thứ bằng tiếng Anh và chuyển sang tiếng Việt
            $thu = thu_tieng_viet(date('l', strtotime($ngay_dang)));
            
            // In ra ngày và thứ
          //  echo $ngay_dang . " - " . $thu . "<br>";
            $date[$ngay] = array('thu'=>$thu, 'ngay'=>$ngay.'/'.$thang.'/'.$nam);

        }

 
    setVariable('date', $date);
    setVariable('thang', $thang);
    setVariable('nam', $nam);
    setVariable('listStaff', $listStaff);

    }else{
        return $controller->redirect('/login');
    }
}

function checktimesheet(){
     global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách nhân viên';

        $modelStaff = $controller->loadModel('Staffs');
        $modelStaffTimekeepers = $controller->loadModel('StaffTimekeepers');

        $conditions = array('id_member'=>$session->read('infoUser')->id, 'id'=>(int)$_GET['id_staff']);
        $staff = $modelStaff->find()->where($conditions)->first();
        // Thiết lập tháng và năm

         $date = explode('/', $_GET['date']);
        $date = mktime(0,0,0,$date[1],$date[0],$date[2]);
        
        $checkdate = $modelStaffTimekeepers->find()->where(['date'=>$date,'id_staff'=>$staff->id])->first();
        if(!empty($_GET['shift'])){
            if(empty($checkdate)){
                $checkdate = $modelStaffTimekeepers->newEmptyEntity();
                $checkdate->date = $date;
                $checkdate->id_staff = $staff->id;
            }

            $checkdate->shift = implode(', ', $_GET['shift']);


            $modelStaffTimekeepers->save($checkdate);
        }elseif(!empty($checkdate)){
            $modelStaffTimekeepers->delete($checkdate);
        }
        return $controller->redirect('/timesheetStaff');
        

    }else{
        return $controller->redirect('/login');
    }
}

function staff(){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $metaImageMantan;
    global $metaDescriptionMantan;
    global $session;
    global $urlHomes;

    $modelMembers = $controller->loadModel('Members');
    $modelStaff = $controller->loadModel('Staffs');

    $session->write('infoUser', []);

    if(!empty($_GET['id'])){
        $info = $modelStaff->find()->where(['id'=>(int) $_GET['id'], 'status'=>'active'])->first();

        if(!empty($info)){
            if(empty($info->token)){
                $info->token = createToken();
            }


            
            if(!empty($info->description)){
                $metaDescriptionMantan = strip_tags($info->description);
            }

            // tăng lượt xem
            $info->view ++;
            $modelStaff->save($info);
            $info->view += 1000;

            
        
            setVariable('info', $info);
        }else{
            return $controller->redirect('/');
        }
    }else{
        return $controller->redirect('/');
    }
}


 ?>