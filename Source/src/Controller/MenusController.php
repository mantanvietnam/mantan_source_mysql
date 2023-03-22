<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

class MenusController extends AppController{
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

    public function delete(){
        $modelMenus = $this->Menus;
        
        if(!empty($_GET['id'])){
            $data = $modelMenus->get($_GET['id']);
            
            if($data){
                $modelMenus->delete($data);
                $modelMenus->deleteAll(['id_parent' => $data->id]);

                return $this->redirect('/options/menus/?id='.$data->id_menu);
            }
        }

        return $this->redirect('/admins');
    }
}
?>