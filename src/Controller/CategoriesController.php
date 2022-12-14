<?php
namespace App\Controller;
use App\Controller\AppController;

class CategoriesController extends AppController{
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

	public function post(){
        $modelCategories = $this->Categories;

        if ($this->request->is('post')) {
            $dataSend = $this->request->getData();

            // tính ID category
            if(!empty($dataSend['idCategoryEdit'])){
            	$infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
            }else{
                $infoCategory = $modelCategories->newEmptyEntity();
            }

            // tạo dữ liệu save
            $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $infoCategory->slug = createSlugMantan($infoCategory->name);
            $infoCategory->parent = (int) $dataSend['parent'];
            $infoCategory->image = $dataSend['image'];
            $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
            $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
            $infoCategory->type = 'post';

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'post');
        $category_post = $modelCategories->find()->where($conditions)->all()->toList();

        $this->set('category_post', $category_post);
    }

    public function album(){
        $modelCategories = $this->Categories;

        if ($this->request->is('post')) {
            $dataSend = $this->request->getData();

            // tính ID category
            if(!empty($dataSend['idCategoryEdit'])){
            	$infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
            }else{
                $infoCategory = $modelCategories->newEmptyEntity();
            }

            // tạo dữ liệu save
            $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $infoCategory->slug = createSlugMantan($infoCategory->name);
            $infoCategory->parent = (int) $dataSend['parent'];
            $infoCategory->image = $dataSend['image'];
            $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
            $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
            $infoCategory->type = 'album';

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'album');
        $category_post = $modelCategories->find()->where($conditions)->all()->toList();

        $this->set('category_post', $category_post);
    }

    public function video(){
        $modelCategories = $this->Categories;

        if ($this->request->is('post')) {
            $dataSend = $this->request->getData();

            // tính ID category
            if(!empty($dataSend['idCategoryEdit'])){
            	$infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
            }else{
                $infoCategory = $modelCategories->newEmptyEntity();
            }

            // tạo dữ liệu save
            $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $infoCategory->slug = createSlugMantan($infoCategory->name);
            $infoCategory->parent = (int) $dataSend['parent'];
            $infoCategory->image = $dataSend['image'];
            $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
            $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
            $infoCategory->type = 'video';

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'video');
        $category_post = $modelCategories->find()->where($conditions)->all()->toList();

        $this->set('category_post', $category_post);
    }

    public function delete(){
		$modelCategories = $this->Categories;
		
		if(!empty($_GET['id'])){
			$data = $modelCategories->get($_GET['id']);
			
			if($data){
	         	$modelCategories->delete($data);
	         	return $this->redirect('/categories/'.$data->type);
	        }
		}

		return $this->redirect('/admins');
	}

}
?>