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
		$this->response = $this->response->withHeader('Access-Control-Allow-Origin', '*');
		$this->response = $this->response->withHeader('Access-Control-Allow-Headers', '*');
		$this->response = $this->response->withHeader('Access-Control-Allow-Methods', '*');

		return $this->response;
	}

	public function updateLinkMenu()
	{
		$modelMenus = $this->loadModel('Menus');

        if ($this->request->is('post')) {
            $dataSend = $this->request->getData();

            if(!empty($dataSend['idLinkSelect']) && !empty($dataSend['idLinkEnd'])){
            	$linkStart = $modelMenus->get((int) $dataSend['idLinkSelect']);
            	$linkEnd = $modelMenus->get((int) $dataSend['idLinkEnd']);

            	if($linkStart->weighty > $linkEnd->weighty){
            		//debug('kéo từ dưới lên');
            		// kéo từ dưới lên
            		$conditions = array('weighty >=' => $linkEnd->weighty, 'weighty <' => $linkStart->weighty, 'id_parent'=>$linkStart->id_parent);
            		$listLinks = $modelMenus->find()->where($conditions)->all()->toList();

            		if(!empty($listLinks)){
            			foreach ($listLinks as $key => $value) {
            				$value->weighty ++;
            				$modelMenus->save($value);
            			}
            		}

            		$linkStart->weighty = $linkEnd->weighty;
            		$modelMenus->save($linkStart);

            	}elseif($linkStart->weighty < $linkEnd->weighty){
            		//debug('kéo từ trên xuống');
            		// kéo từ trên xuống
            		$conditions = array('weighty >' => $linkEnd->weighty, 'id_parent'=>$linkStart->id_parent);
            		$listLinks = $modelMenus->find()->where($conditions)->all()->toList();

            		if(!empty($listLinks)){
            			foreach ($listLinks as $key => $value) {
            				$value->weighty ++;
            				$modelMenus->save($value);
            			}
            		}

            		$linkStart->weighty = $linkEnd->weighty+1;
            		$modelMenus->save($linkStart);
            	}
            }
        }

        $return = array('code'=>1);

        $this->response = $this->response->withStringBody(json_encode($return));
		$this->response = $this->response->withType('json');

		return $this->response;
	}
}