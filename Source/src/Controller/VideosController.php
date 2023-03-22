<?php
namespace App\Controller;
use App\Controller\AppController;

class VideosController extends AppController{
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

		$modelVideos = $this->Videos;

        $conditions = array();
        $limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;

        $listData = $modelVideos->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        $totalData = $modelVideos->find()->where($conditions)->all()->toList();
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
		$modelVideos = $this->Videos;
		$modelCategories = $this->loadModel('Categories');
		$modelSlugs = $this->loadModel('Slugs');
		
		$mess = '';

		// lấy data edit
	    if(!empty($_GET['id'])){
	        $infoPost = $modelVideos->get( (int) $_GET['id']);
	    }else{
	        $infoPost = $modelVideos->newEmptyEntity();
	    }

        if ($this->request->is('post')) {
        	$dataSend = $this->request->getData();

        	if(!empty($dataSend['title'])){
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

	            if(empty($dataSend['image'])){
	            	if(!empty($dataSend['youtube_code'])){
	            		$dataSend['image'] = 'http://img.youtube.com/vi/'.$dataSend['youtube_code'].'/0.jpg';
	            	}
	            }

	            // tạo dữ liệu save
	            $infoPost->title = str_replace(array('"', "'"), '’', $dataSend['title']);
	            $infoPost->id_category = (int) $dataSend['idCategory'];
	            $infoPost->image = $dataSend['image'];
	            $infoPost->time_create = $time;
	            $infoPost->status = $dataSend['status'];
	            $infoPost->author = $dataSend['author'];
	            $infoPost->description = $dataSend['description'];
	            $infoPost->youtube_code = $dataSend['youtube_code'];

	            // tạo slug
	            $slug = createSlugMantan($infoPost->title);
	            $slugNew = $slug;
	            $number = 0;

	            if(empty($infoPost->slug) || $infoPost->slug!=$slugNew){
		            do{
		            	$conditions = array('slug'=>$slugNew);
	        			$listData = $modelSlugs->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

	        			if(!empty($listData)){
	        				$number++;
	        				$slugNew = $slug.'-'.$number;
	        			}
		            }while (!empty($listData));
		        
		            // lưu url slug
		            saveSlugURL($slugNew, 'homes', 'info_video');
		            if(!empty($infoPost->slug)){
		            	deleteSlugURL($infoPost->slug);
		            }
		        }
	            
	            $infoPost->slug = $slugNew;

	            $modelVideos->save($infoPost);
	            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	        }else{
	        	$mess= '<p class="text-danger">Nhập thiếu dữ liệu</p>';
	        }
        }

        $conditions = array('type' => 'video');
    	$listCategory = $modelCategories->find()->where($conditions)->all()->toList();

        $this->set('infoPost', $infoPost);
        $this->set('mess', $mess);
        $this->set('listCategory', $listCategory);
	}

	public function delete(){
		$modelVideos = $this->Videos;
		
		if(!empty($_GET['id'])){
			$data = $modelVideos->get($_GET['id']);
			
			if($data){
	         	$modelVideos->delete($data);
	         	
	         	deleteSlugURL($data->slug);

	         	return $this->redirect('/videos/list');
	        }
		}

		return $this->redirect('/admins');
	}
}
?>