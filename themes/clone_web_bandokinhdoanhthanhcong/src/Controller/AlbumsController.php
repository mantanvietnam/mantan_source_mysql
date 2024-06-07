<?php
namespace App\Controller;
use App\Controller\AppController;

class AlbumsController extends AppController{
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

		$modelAlbums = $this->Albums;
		$modelAlbuminfos = $this->loadModel('Albuminfos');
		$modelCategories = $this->loadModel('Categories');

        $conditions = array();
        $limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;

		if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['title'])){
            $conditions['title LIKE'] = '%'.$_GET['title'].'%';
        }

        if(!empty($_GET['idCategory'])){
            $conditions['id_category'] = (int) $_GET['idCategory'];
        }

        $listData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        if(!empty($listData)){
        	foreach ($listData as $key => $value) {
        		$conditionsImg = array('id_album'=>$value->id);
        		$image = $modelAlbuminfos->find()->where($conditionsImg)->all()->toList();
        		$listData[$key]->number_image = count($image);
        	}
        }

        $totalData = $modelAlbums->find()->where($conditions)->all()->toList();
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

    	// lấy danh sách danh mục
        $conditions = array('type' => 'album');
    	$listCategory = $modelCategories->find()->where($conditions)->order(['parent'=>'asc', 'id'=>'asc'])->all()->toList();

    	$categories = [];
    	if(!empty($listCategory)){
    		foreach ($listCategory as $key => $value) {
    			if($value->parent == 0){
    				$categories[$value->id]['name'] = $value->name;
    			}else{
    				foreach ($categories as $key1 => $value1) {
    					if($key1 == $value->parent){
    						$categories[$key1]['sub'][$value->id]['name'] = $value->name;
    					}elseif(!empty($categories[$key1]['sub'])){
    						foreach ($categories[$key1]['sub'] as $key2 => $value2) {
    							if($key2 == $value->parent){
		    						$categories[$key1]['sub'][$key2]['sub'][$value->id]['name'] = $value->name;
		    					}elseif(!empty($categories[$key1]['sub'][$key2]['sub'])){
		    						foreach ($categories[$key1]['sub'][$key2]['sub'] as $key3 => $value3) {
		    							if($key3 == $value->parent){
				    						$categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['name'] = $value->name;
				    					}elseif(!empty($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'])){
				    						foreach ($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'] as $key4 => $value4) {
				    							if($key4 == $value->parent){
						    						$categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['name'] = $value->name;
						    					}
				    						}
				    					}
		    						}
		    					}
    						}
    					}
    				}
    			}
    		}
    	}

	    $this->set('page', $page);
	    $this->set('totalPage', $totalPage);
	    $this->set('back', $back);
	    $this->set('next', $next);
	    $this->set('urlPage', $urlPage);

        $this->set('listData', $listData);
        $this->set('listCategory', $categories);
	}

	public function add(){
		$modelAlbums = $this->Albums;
		$modelCategories = $this->loadModel('Categories');
		$modelSlugs = $this->loadModel('Slugs');
		$modelCategoryConnects = $this->loadModel('CategoryConnects');
		
		$mess = '';

		// lấy data edit
	    if(!empty($_GET['id'])){
	        $infoPost = $modelAlbums->get( (int) $_GET['id']);

	        if(!empty($infoPost)){
	        	$categories = $modelCategoryConnects->find()->where(['keyword'=>'album', 'id_parent'=>(int) $_GET['id']])->all()->toList();
	        	$infoPost->categories = [];

	        	if(!empty($categories)){
	        		foreach ($categories as $key => $value) {
	        			$infoPost->categories[] = $value->id_category;
	        		}
	        	}
	    	}
	    }else{
	        $infoPost = $modelAlbums->newEmptyEntity();
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
	            	$dataSend['idCategory'] = [];
	            }

	            // tạo dữ liệu save
	            $infoPost->title = str_replace(array('"', "'"), '’', $dataSend['title']);
	            $infoPost->id_category = (int) @$dataSend['idCategory'][0];
	            $infoPost->image = $dataSend['image'];
	            $infoPost->time_create = $time;
	            $infoPost->status = $dataSend['status'];
	            $infoPost->author = $dataSend['author'];
	            $infoPost->description = $dataSend['description'];

	            // tạo slug
	            $slug = createSlugMantan($infoPost->title);
	            $slugNew = $slug;
	            $number = 0;

	            $checkSlug = $modelSlugs->find()->where(['slug'=>$slugNew])->first();
	            if(empty($infoPost->slug) || $infoPost->slug!=$slugNew || empty($checkSlug)){
		            do{
		            	$conditions = array('slug'=>$slugNew);
	        			$listData = $modelSlugs->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

	        			if(!empty($listData)){
	        				$number++;
	        				$slugNew = $slug.'-'.$number;
	        			}
		            }while (!empty($listData));
		        
		            // lưu url slug
		            saveSlugURL($slugNew, 'homes', 'info_album');
		            if(!empty($infoPost->slug)){
		            	deleteSlugURL($infoPost->slug);
		            }
		        }
	            
	            $infoPost->slug = $slugNew;

	            $modelAlbums->save($infoPost);

	            // tạo dữ liệu bảng chuyên mục
	            $modelCategoryConnects->deleteAll(['id_parent'=>$infoPost->id, 'keyword'=>'album']);

	            if(!empty($dataSend['idCategory'])){
	            	foreach ($dataSend['idCategory'] as $idCategory) {
	            		$categoryConnects = $modelCategoryConnects->newEmptyEntity();

		        		$categoryConnects->keyword = 'album';
		        		$categoryConnects->id_parent = $infoPost->id;
		        		$categoryConnects->id_category = $idCategory;

		        		$modelCategoryConnects->save($categoryConnects);
	            	}
	            }

	            $infoPost->categories = $dataSend['idCategory'];

	            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	        }else{
	        	$mess= '<p class="text-danger">Nhập thiếu dữ liệu</p>';
	        }
        }

    	$conditions = array('type' => 'album');
    	$listCategory = $modelCategories->find()->where($conditions)->order(['parent'=>'asc', 'id'=>'asc'])->all()->toList();

    	$categories = [];
    	if(!empty($listCategory)){
    		foreach ($listCategory as $key => $value) {
    			if($value->parent == 0){
    				$categories[$value->id]['name'] = $value->name;
    			}else{
    				foreach ($categories as $key1 => $value1) {
    					if($key1 == $value->parent){
    						$categories[$key1]['sub'][$value->id]['name'] = $value->name;
    					}elseif(!empty($categories[$key1]['sub'])){
    						foreach ($categories[$key1]['sub'] as $key2 => $value2) {
    							if($key2 == $value->parent){
		    						$categories[$key1]['sub'][$key2]['sub'][$value->id]['name'] = $value->name;
		    					}elseif(!empty($categories[$key1]['sub'][$key2]['sub'])){
		    						foreach ($categories[$key1]['sub'][$key2]['sub'] as $key3 => $value3) {
		    							if($key3 == $value->parent){
				    						$categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['name'] = $value->name;
				    					}elseif(!empty($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'])){
				    						foreach ($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'] as $key4 => $value4) {
				    							if($key4 == $value->parent){
						    						$categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['name'] = $value->name;
						    					}
				    						}
				    					}
		    						}
		    					}
    						}
    					}
    				}
    			}
    		}
    	}

        $this->set('infoPost', $infoPost);
        $this->set('mess', $mess);
        $this->set('listCategory', $categories);
	}

	public function delete(){
		$modelAlbums = $this->Albums;
		
		if(!empty($_GET['id'])){
			$data = $modelAlbums->get($_GET['id']);
			
			if($data){
	         	$modelAlbums->delete($data);
	         	
	         	deleteSlugURL($data->slug);

	         	return $this->redirect('/albums/list');
	        }
		}

		return $this->redirect('/admins');
	}
}
?>