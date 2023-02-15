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