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
        $modelSlugs = $this->loadModel('Slugs');

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
            $infoCategory->parent = (int) $dataSend['parent'];
            $infoCategory->image = $dataSend['image'];
            $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
            $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
            $infoCategory->type = 'post';

            // tạo slug
            $slug = createSlugMantan($infoCategory->name);
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
            saveSlugURL($slugNew,'posts','category');

            $infoCategory->slug = $slugNew;

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'post');
        $category_post = $modelCategories->find()->where($conditions)->all()->toList();

        $this->set('category_post', $category_post);
    }

    public function album(){
        $modelCategories = $this->Categories;
        $modelSlugs = $this->loadModel('Slugs');

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
            $infoCategory->parent = (int) $dataSend['parent'];
            $infoCategory->image = $dataSend['image'];
            $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
            $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
            $infoCategory->type = 'album';

            // tạo slug
            $slug = createSlugMantan($infoCategory->name);
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
            saveSlugURL($slugNew,'albums','category');

            $infoCategory->slug = $slugNew;

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'album');
        $category_post = $modelCategories->find()->where($conditions)->all()->toList();

        $this->set('category_post', $category_post);
    }

    public function video(){
        $modelCategories = $this->Categories;
        $modelSlugs = $this->loadModel('Slugs');

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
            $infoCategory->parent = (int) $dataSend['parent'];
            $infoCategory->image = $dataSend['image'];
            $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
            $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
            $infoCategory->type = 'video';

            // tạo slug
            $slug = createSlugMantan($infoCategory->name);
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
            saveSlugURL($slugNew,'videos','category');

            $infoCategory->slug = $slugNew;

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

                deleteSlugURL($data->slug);

	         	return $this->redirect('/categories/'.$data->type);
	        }
		}

		return $this->redirect('/admins');
	}

}
?>