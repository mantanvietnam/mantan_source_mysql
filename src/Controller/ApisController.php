<?php
namespace App\Controller;
use App\Controller\AppController;

class ApisController extends AppController{
	public function beforeFilter(\Cake\Event\EventInterface $event){
		$this->viewBuilder()->setLayout('ajax');
	}

	public function index($url=''){
		global $routesPlugin;
		global $routesTheme;

		if(isset($routesPlugin[$url])){
			$url= $routesPlugin[$url];
		}elseif(isset($routesTheme[$url])){
			$url= $routesTheme[$url];
		}else{
			$url= str_replace('-', '/', $url);
		}

		$plugin= explode('/', $url);

		$count= count($plugin)-1;
        $plugin= explode('.', $plugin[$count]);
        
        $content= array();
        if(function_exists($plugin[0]))
        {
            $input= array('fileProcess'=>$url,'request'=>$this->request);
	        $content= $plugin[0]($input);
        }

        $this->response = $this->response->withStringBody(json_encode($content));
		$this->response = $this->response->withType('json');

		return $this->response;
	}
}