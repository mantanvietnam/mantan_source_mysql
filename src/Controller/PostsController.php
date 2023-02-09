<?php
namespace App\Controller;
use App\Controller\AppController;

class PostsController extends AppController{
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

	public function list(){
		$modelPosts = $this->Posts;

        $conditions = array('type'=>'post');
        $listData = $modelPosts->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        $this->set('listData', $listData);
	}

	public function add(){
		$modelPosts = $this->Posts;
		
		$infoPost = array();
		$mess = '';

        if ($this->request->is('post')) {
        	$dataSend = $this->request->getData();

        	if(!empty($dataSend['title'])){
	         
	            if(!empty($dataSend['idEdit'])){
	            	$infoPost = $modelPosts->get( (int) $dataSend['idEdit']);
	            }else{
	                $infoPost = $modelPosts->newEmptyEntity();
	            }

	            // xử lý thời gian đăng
	            $today= getdate();
	            $datePost = explode('-', $dataSend['date']);
	            
	            if(!empty($datePost))
	            {
		              $time= mktime($today['hours'], $today['minutes'], $today['seconds'], $datePost[1], $datePost[2], $datePost[0]);
	            }

	            if(empty($dataSend['idCategory'])){
	            	$dataSend['idCategory'] = 0;
	            }

	            // tạo dữ liệu save
	            $infoPost->title = str_replace(array('"', "'"), '’', $dataSend['title']);
	            $infoPost->slug = createSlugMantan($infoPost->title);
	            $infoPost->author = $dataSend['author'];
	            $infoPost->pin = (int) $dataSend['pin'];
	            $infoPost->time = $time;
	            $infoPost->image = $dataSend['image'];
	            $infoPost->idCategory = (int) $dataSend['idCategory'];
	            $infoPost->keyword = $dataSend['keyword'];
	            $infoPost->description = $dataSend['description'];
	            $infoPost->content = $dataSend['content'];
	            $infoPost->type = 'post';

	            $modelPosts->save($infoPost);
	            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	        }else{
	        	$mess= '<p class="text-danger">Nhập thiếu dữ liệu</p>';
	        }
        }

        $this->set('infoPost', $infoPost);
        $this->set('mess', $mess);
	}

	public function delete(){
		$modelPosts = $this->Posts;
		
		if(!empty($_GET['id'])){
			$data = $modelPosts->get($_GET['id']);
			
			if($data){
	         	$modelPosts->delete($data);
	         	return $this->redirect('/posts/list');
	        }
		}

		return $this->redirect('/admins');
	}

	public function listPage(){
		$modelPosts = $this->Posts;

        $conditions = array('type'=>'page');
        $listData = $modelPosts->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        $this->set('listData', $listData);
	}

	public function addPage(){
		$modelPosts = $this->Posts;
		
		$infoPost = array();
		$mess = '';

        if ($this->request->is('post')) {
        	$dataSend = $this->request->getData();

        	if(!empty($dataSend['title'])){
	         
	            if(!empty($dataSend['idEdit'])){
	            	$infoPost = $modelPosts->get( (int) $dataSend['idEdit']);
	            }else{
	                $infoPost = $modelPosts->newEmptyEntity();
	            }

	            // xử lý thời gian đăng
	            $today = getdate();
	            $datePost = explode('-', $dataSend['date']);
	            
	            if(!empty($datePost))
	            {
		              $time= mktime($today['hours'], $today['minutes'], $today['seconds'], $datePost[1], $datePost[2], $datePost[0]);
	            }

	            // tạo dữ liệu save
	            $infoPost->title = str_replace(array('"', "'"), '’', $dataSend['title']);
	            $infoPost->slug = createSlugMantan($infoPost->title);
	            $infoPost->author = $dataSend['author'];
	            $infoPost->pin = (int) $dataSend['pin'];
	            $infoPost->time = $time;
	            $infoPost->image = $dataSend['image'];
	            $infoPost->idCategory = 0;
	            $infoPost->keyword = $dataSend['keyword'];
	            $infoPost->description = $dataSend['description'];
	            $infoPost->content = $dataSend['content'];
	            $infoPost->type = 'page';

	            $modelPosts->save($infoPost);
	            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	        }else{
	        	$mess= '<p class="text-danger">Nhập thiếu dữ liệu</p>';
	        }
        }

        $this->set('infoPost', $infoPost);
        $this->set('mess', $mess);
	}

	public function deletePage(){
		$modelPosts = $this->Posts;
		
		if(!empty($_GET['id'])){
			$data = $modelPosts->get($_GET['id']);
			
			if($data){
	         	$modelPosts->delete($data);
	         	return $this->redirect('/pages/list');
	        }
		}

		return $this->redirect('/admins');
	}
}
?>