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
		global $urlCurrent;

		$modelPosts = $this->Posts;

        $conditions = array('type'=>'post');
        $limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;

        $listData = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        $totalData = $modelPosts->find()->where($conditions)->all()->toList();
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

	public function add(){
		$modelPosts = $this->Posts;
		$modelSlugs = $this->loadModel('Slugs');
		
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
	            $datePost = explode('/', $dataSend['date']);
	            
	            if(!empty($datePost))
	            {
		            $time= mktime($today['hours'], $today['minutes'], $today['seconds'], $datePost[1], $datePost[0], $datePost[2]);
	            }

	            if(empty($dataSend['idCategory'])){
	            	$dataSend['idCategory'] = 0;
	            }

	            // tạo dữ liệu save
	            $infoPost->title = str_replace(array('"', "'"), '’', $dataSend['title']);
	            $infoPost->author = $dataSend['author'];
	            $infoPost->pin = (int) $dataSend['pin'];
	            $infoPost->time = $time;
	            $infoPost->image = $dataSend['image'];
	            $infoPost->idCategory = (int) $dataSend['idCategory'];
	            $infoPost->keyword = $dataSend['keyword'];
	            $infoPost->description = $dataSend['description'];
	            $infoPost->content = $dataSend['content'];
	            $infoPost->type = 'post';

	            // tạo slug
	            $slug = createSlugMantan($infoPost->title);
	            $slugNew = $slug;
	            $number = 0;
	            do{
	            	$conditions = array('slug'=>$slugNew);
        			$listData = $modelSlugs->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
	            }while (!empty($listData));

	            // lưu url slug
	            saveSlugURL($slugNew, 'posts', 'index');
	            
	            $infoPost->slug = $slugNew;

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
	         	
	         	deleteSlugURL($data->slug);

	         	return $this->redirect('/posts/list');
	        }
		}

		return $this->redirect('/admins');
	}

	public function listPage(){
		global $urlCurrent;

		$modelPosts = $this->Posts;

        $conditions = array('type'=>'page');
        $limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		
        $listData = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        $totalData = $modelPosts->find()->where($conditions)->all()->toList();
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

	public function addPage(){
		$modelPosts = $this->Posts;
		$modelSlugs = $this->loadModel('Slugs');
		
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
	            $datePost = explode('/', $dataSend['date']);
	            
	            if(!empty($datePost))
	            {
		              $time= mktime($today['hours'], $today['minutes'], $today['seconds'], $datePost[1], $datePost[0], $datePost[2]);
	            }

	            // tạo dữ liệu save
	            $infoPost->title = str_replace(array('"', "'"), '’', $dataSend['title']);
	            $infoPost->author = $dataSend['author'];
	            $infoPost->pin = (int) $dataSend['pin'];
	            $infoPost->time = $time;
	            $infoPost->image = $dataSend['image'];
	            $infoPost->idCategory = 0;
	            $infoPost->keyword = $dataSend['keyword'];
	            $infoPost->description = $dataSend['description'];
	            $infoPost->content = $dataSend['content'];
	            $infoPost->type = 'page';

	            // tạo slug
	            $slug = createSlugMantan($infoPost->title);
	            $slugNew = $slug;
	            $number = 0;
	            do{
	            	$conditions = array('slug'=>$slugNew);
        			$listData = $modelSlugs->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
	            }while (!empty($listData));

	            // lưu url slug
	            saveSlugURL($slugNew, 'posts', 'index');

	            $infoPost->slug = $slugNew;

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

	         	deleteSlugURL($data->slug);
	         	
	         	return $this->redirect('/pages/list');
	        }
		}

		return $this->redirect('/admins');
	}
}
?>