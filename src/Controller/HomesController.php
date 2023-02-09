<?php
namespace App\Controller;
use App\Controller\AppController;

class HomesController extends AppController{
	public function beforeFilter(\Cake\Event\EventInterface $event){
        $this->loadModel('Posts');
    }

	public function index(){
        global $themeActive;

        $url= '/themes/'.$themeActive.'/index.php';
        
        if(function_exists('indexTheme')){
            $input= array('fileProcess'=>$url,'request'=>$this->request);
            indexTheme($input);
        }
	}

    public function infoPage($slug){
        $modelPosts = $this->Posts;

        if(!empty($slug)){
            $slug = explode('-', $slug);

            $n = count($slug) - 1;
            $slug = explode('.', $slug[$n]);

            if(count($slug) == 2 && $slug[1]=='html'){
                $data = $modelPosts->get($slug[0]);
            
                if($data){
                    $this->set('infoNotice', $data);
                } else {
                    return $this->redirect('/');
                }
            } else {
                return $this->redirect('/');
            }
        } else {
            return $this->redirect('/');
        }
    }
}
?>