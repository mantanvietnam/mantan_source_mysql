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

            $checkSlug = $modelSlugs->find()->where(['slug'=>$slugNew])->first();
            if(empty($infoCategory->slug) || $infoCategory->slug!=$slugNew || empty($checkSlug)){
                do{
                    $conditions = array('slug'=>$slugNew);
                    $listData = $modelSlugs->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                    if(!empty($listData)){
                        $number++;
                        $slugNew = $slug.'-'.$number;
                    }
                }while (!empty($listData));

                // lưu url slug
                saveSlugURL($slugNew,'homes','category_post');
                if(!empty($infoCategory->slug)){
                    deleteSlugURL($infoCategory->slug);
                }
            }

            $infoCategory->slug = $slugNew;

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'post');
        $category_post = $modelCategories->find()->where($conditions)->order(['parent'=>'asc', 'id'=>'asc'])->all()->toList();

        $categories = [];
        if(!empty($category_post)){
            foreach ($category_post as $key => $value) {
                if($value->parent == 0){
                    $categories[$value->id]['name'] = $value->name;
                    $categories[$value->id]['parent'] = $value->parent;
                    $categories[$value->id]['image'] = $value->image;
                    $categories[$value->id]['keyword'] = $value->keyword;
                    $categories[$value->id]['description'] = $value->description;
                    $categories[$value->id]['type'] = $value->type;
                    $categories[$value->id]['slug'] = $value->slug;
                }else{
                    foreach ($categories as $key1 => $value1) {
                        if($key1 == $value->parent){
                            $categories[$key1]['sub'][$value->id]['name'] = $value->name;
                            $categories[$key1]['sub'][$value->id]['parent'] = $value->parent;
                            $categories[$key1]['sub'][$value->id]['image'] = $value->image;
                            $categories[$key1]['sub'][$value->id]['keyword'] = $value->keyword;
                            $categories[$key1]['sub'][$value->id]['description'] = $value->description;
                            $categories[$key1]['sub'][$value->id]['type'] = $value->type;
                            $categories[$key1]['sub'][$value->id]['slug'] = $value->slug;
                        }elseif(!empty($categories[$key1]['sub'])){
                            foreach ($categories[$key1]['sub'] as $key2 => $value2) {
                                if($key2 == $value->parent){
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['name'] = $value->name;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['parent'] = $value->parent;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['image'] = $value->image;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['keyword'] = $value->keyword;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['description'] = $value->description;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['type'] = $value->type;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['slug'] = $value->slug;
                                }elseif(!empty($categories[$key1]['sub'][$key2]['sub'])){
                                    foreach ($categories[$key1]['sub'][$key2]['sub'] as $key3 => $value3) {
                                        if($key3 == $value->parent){
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['name'] = $value->name;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['parent'] = $value->parent;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['image'] = $value->image;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['keyword'] = $value->keyword;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['description'] = $value->description;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['type'] = $value->type;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['slug'] = $value->slug;
                                        }elseif(!empty($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'])){
                                            foreach ($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'] as $key4 => $value4) {
                                                if($key4 == $value->parent){
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['name'] = $value->name;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['parent'] = $value->parent;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['image'] = $value->image;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['keyword'] = $value->keyword;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['description'] = $value->description;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['type'] = $value->type;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['slug'] = $value->slug;
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

        $this->set('category_post', $categories);
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
            
            $checkSlug = $modelSlugs->find()->where(['slug'=>$slugNew])->first();
            if(empty($infoCategory->slug) || $infoCategory->slug!=$slugNew || empty($checkSlug)){
                do{
                    $conditions = array('slug'=>$slugNew);
                    $listData = $modelSlugs->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                    if(!empty($listData)){
                        $number++;
                        $slugNew = $slug.'-'.$number;
                    }
                }while (!empty($listData));

                // lưu url slug
                saveSlugURL($slugNew,'homes','category_album');
                if(!empty($infoCategory->slug)){
                    deleteSlugURL($infoCategory->slug);
                }
            }

            $infoCategory->slug = $slugNew;

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'album');
        $category_post = $modelCategories->find()->where($conditions)->order(['parent'=>'asc', 'id'=>'asc'])->all()->toList();

        $categories = [];
        if(!empty($category_post)){
            foreach ($category_post as $key => $value) {
                if($value->parent == 0){
                    $categories[$value->id]['name'] = $value->name;
                    $categories[$value->id]['parent'] = $value->parent;
                    $categories[$value->id]['image'] = $value->image;
                    $categories[$value->id]['keyword'] = $value->keyword;
                    $categories[$value->id]['description'] = $value->description;
                    $categories[$value->id]['type'] = $value->type;
                    $categories[$value->id]['slug'] = $value->slug;
                }else{
                    foreach ($categories as $key1 => $value1) {
                        if($key1 == $value->parent){
                            $categories[$key1]['sub'][$value->id]['name'] = $value->name;
                            $categories[$key1]['sub'][$value->id]['parent'] = $value->parent;
                            $categories[$key1]['sub'][$value->id]['image'] = $value->image;
                            $categories[$key1]['sub'][$value->id]['keyword'] = $value->keyword;
                            $categories[$key1]['sub'][$value->id]['description'] = $value->description;
                            $categories[$key1]['sub'][$value->id]['type'] = $value->type;
                            $categories[$key1]['sub'][$value->id]['slug'] = $value->slug;
                        }elseif(!empty($categories[$key1]['sub'])){
                            foreach ($categories[$key1]['sub'] as $key2 => $value2) {
                                if($key2 == $value->parent){
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['name'] = $value->name;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['parent'] = $value->parent;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['image'] = $value->image;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['keyword'] = $value->keyword;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['description'] = $value->description;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['type'] = $value->type;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['slug'] = $value->slug;
                                }elseif(!empty($categories[$key1]['sub'][$key2]['sub'])){
                                    foreach ($categories[$key1]['sub'][$key2]['sub'] as $key3 => $value3) {
                                        if($key3 == $value->parent){
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['name'] = $value->name;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['parent'] = $value->parent;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['image'] = $value->image;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['keyword'] = $value->keyword;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['description'] = $value->description;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['type'] = $value->type;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['slug'] = $value->slug;
                                        }elseif(!empty($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'])){
                                            foreach ($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'] as $key4 => $value4) {
                                                if($key4 == $value->parent){
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['name'] = $value->name;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['parent'] = $value->parent;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['image'] = $value->image;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['keyword'] = $value->keyword;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['description'] = $value->description;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['type'] = $value->type;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['slug'] = $value->slug;
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

        $this->set('category_post', $categories);
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
            
            $checkSlug = $modelSlugs->find()->where(['slug'=>$slugNew])->first();
            if(empty($infoCategory->slug) || $infoCategory->slug!=$slugNew || empty($checkSlug)){
                do{
                    $conditions = array('slug'=>$slugNew);
                    $listData = $modelSlugs->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                    if(!empty($listData)){
                        $number++;
                        $slugNew = $slug.'-'.$number;
                    }
                }while (!empty($listData));

                // lưu url slug
                saveSlugURL($slugNew,'homes','category_video');
                if(!empty($infoCategory->slug)){
                    deleteSlugURL($infoCategory->slug);
                }
            }

            $infoCategory->slug = $slugNew;

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'video');
        $category_post = $modelCategories->find()->where($conditions)->order(['parent'=>'asc', 'id'=>'asc'])->all()->toList();

        $categories = [];
        if(!empty($category_post)){
            foreach ($category_post as $key => $value) {
                if($value->parent == 0){
                    $categories[$value->id]['name'] = $value->name;
                    $categories[$value->id]['parent'] = $value->parent;
                    $categories[$value->id]['image'] = $value->image;
                    $categories[$value->id]['keyword'] = $value->keyword;
                    $categories[$value->id]['description'] = $value->description;
                    $categories[$value->id]['type'] = $value->type;
                    $categories[$value->id]['slug'] = $value->slug;
                }else{
                    foreach ($categories as $key1 => $value1) {
                        if($key1 == $value->parent){
                            $categories[$key1]['sub'][$value->id]['name'] = $value->name;
                            $categories[$key1]['sub'][$value->id]['parent'] = $value->parent;
                            $categories[$key1]['sub'][$value->id]['image'] = $value->image;
                            $categories[$key1]['sub'][$value->id]['keyword'] = $value->keyword;
                            $categories[$key1]['sub'][$value->id]['description'] = $value->description;
                            $categories[$key1]['sub'][$value->id]['type'] = $value->type;
                            $categories[$key1]['sub'][$value->id]['slug'] = $value->slug;
                        }elseif(!empty($categories[$key1]['sub'])){
                            foreach ($categories[$key1]['sub'] as $key2 => $value2) {
                                if($key2 == $value->parent){
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['name'] = $value->name;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['parent'] = $value->parent;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['image'] = $value->image;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['keyword'] = $value->keyword;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['description'] = $value->description;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['type'] = $value->type;
                                    $categories[$key1]['sub'][$key2]['sub'][$value->id]['slug'] = $value->slug;
                                }elseif(!empty($categories[$key1]['sub'][$key2]['sub'])){
                                    foreach ($categories[$key1]['sub'][$key2]['sub'] as $key3 => $value3) {
                                        if($key3 == $value->parent){
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['name'] = $value->name;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['parent'] = $value->parent;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['image'] = $value->image;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['keyword'] = $value->keyword;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['description'] = $value->description;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['type'] = $value->type;
                                            $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['slug'] = $value->slug;
                                        }elseif(!empty($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'])){
                                            foreach ($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'] as $key4 => $value4) {
                                                if($key4 == $value->parent){
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['name'] = $value->name;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['parent'] = $value->parent;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['image'] = $value->image;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['keyword'] = $value->keyword;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['description'] = $value->description;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['type'] = $value->type;
                                                    $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['slug'] = $value->slug;
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

        $this->set('category_post', $categories);
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