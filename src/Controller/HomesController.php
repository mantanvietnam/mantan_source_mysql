<?php
namespace App\Controller;
use App\Controller\AppController;

class HomesController extends AppController{
	public function beforeFilter(\Cake\Event\EventInterface $event){
        
    }

	public function index(){
        global $themeActive;

        $url= '/themes/'.$themeActive.'/index.php';
        
        if(function_exists('indexTheme')){
            $input= array('fileProcess'=>$url,'request'=>$this->request);
            indexTheme($input);
        }
	}
}
?>