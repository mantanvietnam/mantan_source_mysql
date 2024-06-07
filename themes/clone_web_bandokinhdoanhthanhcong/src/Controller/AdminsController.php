<?php
namespace App\Controller;
use App\Controller\AppController;

class AdminsController extends AppController{
    public function beforeFilter(\Cake\Event\EventInterface $event){
        $session = $this->request->getSession();

        $infoAdmin = $session->read('infoAdmin');

        if(!empty($infoAdmin)){
            $this->set('infoAdmin', $infoAdmin);
            $this->viewBuilder()->setLayout('admin');
        }else{
            if (strlen(strstr($_SERVER['REQUEST_URI'], '/admins/login')) == 0) {
                return $this->redirect('/admins/login');
            }
        }
    }

    public function index(){

    }

    public function changePass(){
        $mess= '';
        $modelAdmins = $this->Admins;
        $session = $this->request->getSession();

        if ($this->request->is('post')) {
            $dataSend = $this->request->getData();
            $infoAdmin = $modelAdmins->find()->where(['id'=>$session->read('infoAdmin')->id])->first();

            if(!empty($infoAdmin)){
                if($infoAdmin->password == md5($dataSend['passOld'])){
                    if(!empty($dataSend['passNew']) && !empty($dataSend['passAgain']) && $dataSend['passNew']==$dataSend['passAgain']){
                        $infoAdmin->password = md5($dataSend['passNew']);

                        $modelAdmins->save($infoAdmin);

                        $mess= '<p class="text-success">Đổi mật khẩu thành công</p>';
                    }else{
                        $mess= '<p class="text-danger">Nhập sai mật khẩu nhập lại</p>';
                    }
                }else{
                    $mess= '<p class="text-danger">Nhập sai mật khẩu cũ</p>';
                }
            }else{
                $mess= '<p class="text-danger">Tài khoản không còn tồn tại</p>';
            }
        }

        $this->set('mess', $mess);
    }

    public function profile(){
        $mess= '';
        $modelAdmins = $this->Admins;
        $session = $this->request->getSession();

        $infoAdmin = $modelAdmins->find()->where(['id'=>$session->read('infoAdmin')->id])->first();

        if ($this->request->is('post')) {
            $dataSend = $this->request->getData();

            if(!empty($dataSend['fullName'])){
                $infoAdmin->fullName = $dataSend['fullName'];
                $infoAdmin->email = $dataSend['email'];

                $modelAdmins->save($infoAdmin);

                $infoAdmin->permission = json_decode($infoAdmin->permission, true);

                $session->write('infoAdmin', $infoAdmin);

                $mess= '<p class="text-success">Đổi thông tin thành công</p>';
            }else{
                $mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
            }
        }

        $this->set('infoAdmin', $infoAdmin);
        $this->set('mess', $mess);
    }

    public function listAdmin(){
        global $urlCurrent;

        $modelAdmins = $this->Admins;

        $conditions = array();
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['fullName'])){
            $conditions['fullName LIKE'] = '%'.$_GET['fullName'].'%';
        }

        if(!empty($_GET['email'])){
            $conditions['email'] = $_GET['email'];
        }

        $listData = $modelAdmins->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        $totalData = $modelAdmins->find()->where($conditions)->all()->toList();
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

        $this->set('page', $page);
        $this->set('totalPage', $totalPage);
        $this->set('back', $back);
        $this->set('next', $next);
        $this->set('urlPage', $urlPage);

        $this->set('listData', $listData);
    }

    public function addAdmin(){
        global $hookMenuAdminMantan;

        $modelAdmins = $this->Admins;
        $session = $this->request->getSession();
        
        $mess = '';
        $permissions = [
                        ['name'=>'Cài đặt website', 'permission'=>'infoSite'],
                        ['name'=>'Quản lý tin tức', 'permission'=>'posts'],
                        ['name'=>'Quản lý thư viện hình ảnh', 'permission'=>'albums'],
                        ['name'=>'Quản lý thư viện video', 'permission'=>'videos'],
                        ['name'=>'Quản lý giao diện', 'permission'=>'themes'],
                        ['name'=>'Quản lý trình đơn menu', 'permission'=>'menus'],
                        ['name'=>'Quản lý cài đặt mở rộng', 'permission'=>'plugins'],
                        ['name'=>'Quản lý tài khoản quản trị', 'permission'=>'admins'],
        ];

        if(!empty($hookMenuAdminMantan)){
            foreach ($hookMenuAdminMantan as $menu) {
                if(!empty($menu)){
                    if(!empty($menu['sub'])){
                        foreach ($menu['sub'] as $sub) {
                            if(empty($sub['sub'])){
                                if(!empty($sub['permission'])){
                                    $permissions[] = ['name'=>$sub['title'], 'permission'=>$sub['permission']];
                                }
                            }else{
                                foreach ($sub['sub'] as $itemSub) {
                                    if(!empty($sub['permission'])){
                                        $permissions[] = ['name'=>$itemSub['title'], 'permission'=>$itemSub['permission']];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        // lấy data edit
        if(!empty($_GET['id'])){
            $infoAccAdmin = $modelAdmins->get( (int) $_GET['id']);

            $infoAccAdmin->permission = json_decode($infoAccAdmin->permission, true);
        }else{
            $infoAccAdmin = $modelAdmins->newEmptyEntity();

            $infoAccAdmin->permission = [];
        }

        if ($this->request->is('post')) {
            $dataSend = $this->request->getData();

            if(!empty($dataSend['fullName'])){
                $check = true;
                if(empty($dataSend['permission'])){
                    $dataSend['permission'] = [];
                }

                // tạo dữ liệu save
                $infoAccAdmin->fullName = $dataSend['fullName'];
                $infoAccAdmin->email = $dataSend['email'];
                $infoAccAdmin->type = $dataSend['type'];
                $infoAccAdmin->permission = json_encode($dataSend['permission']);

                if(empty($_GET['id'])){
                    if(!empty($dataSend['user']) && !empty($dataSend['password'])){
                        $checkAcc = $modelAdmins->find()->where(['user'=>$dataSend['user']])->first();

                        if(empty($checkAcc)){
                            $infoAccAdmin->user = $dataSend['user'];
                            $infoAccAdmin->password = md5($dataSend['password']);
                        }else{
                            $check = false;
                            $mess= '<p class="text-danger">Tài khoản đã tồn tại</p>';
                        }
                    }else{
                        $check = false;
                        $mess= '<p class="text-danger">Nhập thiếu dữ liệu</p>';
                    }
                }

                if($check){
                    $modelAdmins->save($infoAccAdmin);

                    $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

                    if($infoAccAdmin->id == $session->read('infoAdmin')->id){
                        $infoAccAdmin->permission = json_decode($infoAccAdmin->permission, true);

                        $session->write('infoAdmin', $infoAccAdmin);
                    }
                }

                if(!is_array($infoAccAdmin->permission)){
                    $infoAccAdmin->permission = json_decode($infoAccAdmin->permission, true);
                }
                
            }else{
                $mess= '<p class="text-danger">Nhập thiếu dữ liệu</p>';
            }
        }

        $this->set('mess', $mess);
        $this->set('infoAccAdmin', $infoAccAdmin);
        $this->set('permissions', $permissions);
    }

    public function deleteAdmin(){
        $modelAdmins = $this->Admins;
        
        if(!empty($_GET['id'])){
            $data = $modelAdmins->get($_GET['id']);
            $allData = $modelAdmins->find()->where()->all()->toList();
            $countData = count($allData);
            
            if($data && $countData>1){
                $modelAdmins->delete($data);
            }

            return $this->redirect('/admins/listAdmin');
        }

        return $this->redirect('/admins');
    }

    public function login(){
        // Set the layout.
        $this->viewBuilder()->setLayout('ajax');

        $mess= '';
        $modelAdmins = $this->Admins;
        $session = $this->request->getSession();

        if(empty($session->read('infoAdmin'))){
            if ($this->request->is('post')) {
                $dataSend = $this->request->getData();

                if(!empty($dataSend['username']) && !empty($dataSend['password'])){
                    $conditions = array('user' => $dataSend['username'],'password' => md5($dataSend['password']));
                    
                    $infoAdmin = $modelAdmins->find()->where($conditions)->first();

                    if($infoAdmin){
                        $infoAdmin->permission = json_decode($infoAdmin->permission, true);

                        $session->write('infoAdmin', $infoAdmin);
                        $session->write('CheckAuthentication', true);
                        $session->write('urlBaseUpload', '/upload/'.$infoAdmin->user.'/');


                        return $this->redirect('/admins');
                    }else{
                        $mess= '<p class="text-danger">Sai tài khoản hoặc mật khẩu</p>';
                    }
                }else{
                    $mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
                }
            }

            $this->set('mess', $mess);
        }else{
            return $this->redirect('/admins');
        }
    }

    public function logout(){
        $session = $this->request->getSession();
        $session->destroy();
        return $this->redirect('/admins/login');
    }
}
?>