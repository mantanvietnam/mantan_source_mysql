<?php
namespace App\Controller;
use App\Controller\AppController;

class PluginsController extends AppController{
	public function beforeFilter(\Cake\Event\EventInterface $event){
		
	}

	public function index($url=''){
		global $routesPlugin;
		global $routesTheme;

		if(isset($routesPlugin[$url])){
			$url= $routesPlugin[$url];
			$routesType= 'Plugin';
		}elseif(isset($routesTheme[$url])){
			$url= $routesTheme[$url];
			$routesType= 'Theme';
		}else{
			$url= str_replace('-', '/', $url);
			$routesType= '';
		}

		$plugin= explode('/', $url);

		$count= count($plugin)-1;
        $plugin= explode('.', $plugin[$count]);
        
        if(function_exists($plugin[0]))
        {
            $input= array('fileProcess'=>$url,'request'=>$this->request);
	        $plugin[0]($input);
        }

	    $this->set('urlFilePlugin', $url);
	    $this->set('routesType', $routesType);
	}

	public function admin($url=''){
		if(!empty($url)){
			global $isRequestPost;
			global $modelCategories;
			global $modelOptions;
			global $urlCurrent;
			
			$session = $this->request->getSession();

	        $infoAdmin = $session->read('infoAdmin');

	        if(!empty($infoAdmin)){
	            $this->set('infoAdmin', $infoAdmin);
	            $this->viewBuilder()->setLayout('admin');


	            // include controller của plugin
	            $url = str_replace('-', '/', $url);
	            $plugin= explode('/', $url);
				
				$count= count($plugin)-1;
	            $plugin= explode('.', $plugin[$count]);
	            if(function_exists($plugin[0]))
	            {
	            	$input= array('fileProcess'=>$url,'request'=>$this->request);
		            $plugin[0]($input);
		            
	            }elseif(!file_exists(__DIR__.'/../../plugins/'.$url)){
			        $this->redirect('/admins');
		        }

		        $this->set('urlFileProcess', $url);
	        }else{
	            return $this->redirect('/admins/login');
	        }
	    }else{
	    	return $this->redirect('/admins');
	    }
	}
}