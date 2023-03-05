<?php
namespace App\Controller;
use App\Controller\AppController;

class AlbuminfosController extends AppController{
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

		$modelAlbuminfos = $this->Albuminfos;
		$modelAlbums = $this->loadModel('Albums');

		if(!empty($_GET['id'])){
			$infoAlbum = $modelAlbums->get((int) $_GET['id']);
		}

		if(!empty($infoAlbum)){
	        $conditions = array('id_album'=>(int) $_GET['id']);
	        $limit = 20;
			$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
			if($page<1) $page = 1;

	        $listData = $modelAlbuminfos->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'DESC'])->all()->toList();

	        $totalData = $modelAlbuminfos->find()->where($conditions)->all()->toList();
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
	        $this->set('infoAlbum', $infoAlbum);
	    }else{
	    	return $this->redirect('/albums/list');
	    }
	}

	public function add(){
		$modelAlbuminfos = $this->Albuminfos;
		$modelAlbums = $this->loadModel('Albums');
		
		$mess = '';

		if(!empty($_GET['id_album'])){
			$infoAlbum = $modelAlbums->get((int) $_GET['id_album']);
		}

		if(!empty($infoAlbum)){
			// lấy data edit
		    if(!empty($_GET['id'])){
		        $infoPost = $modelAlbuminfos->get( (int) $_GET['id']);
		    }else{
		        $infoPost = $modelAlbuminfos->newEmptyEntity();
		    }

	        if ($this->request->is('post')) {
	        	$dataSend = $this->request->getData();

	        	if(!empty($dataSend['image'])){
		            // tạo dữ liệu save
		            $infoPost->title = str_replace(array('"', "'"), '’', $dataSend['title']);
		            $infoPost->id_album = (int) $_GET['id_album'];
		            $infoPost->image = $dataSend['image'];
		            $infoPost->description = $dataSend['description'];
		            $infoPost->link = $dataSend['link'];

		            $modelAlbuminfos->save($infoPost);
		            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		        }else{
		        	$mess= '<p class="text-danger">Nhập thiếu dữ liệu</p>';
		        }
	        }

	        $this->set('infoPost', $infoPost);
	        $this->set('mess', $mess);
	        $this->set('infoAlbum', $infoAlbum);
	    }else{
	    	return $this->redirect('/albums/list');
	    }
	}

	public function delete(){
		$modelAlbuminfos = $this->Albuminfos;
		
		if(!empty($_GET['id'])){
			$data = $modelAlbuminfos->get($_GET['id']);
			
			if($data){
	         	$modelAlbuminfos->delete($data);

	         	return $this->redirect('/albuminfos/list/?id='.$data->id_album);
	        }
		}

		return $this->redirect('/admins');
	}
}
?>