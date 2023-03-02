<?php
namespace App\Controller;
use App\Controller\AppController;

class HomesController extends AppController{
	public function beforeFilter(\Cake\Event\EventInterface $event){
        $this->loadModel('Posts');
    }

	public function index()
    {
        global $themeActive;

        $url= '/themes/'.$themeActive.'/index.php';
        
        if(function_exists('indexTheme')){
            $input= array('fileProcess'=>$url,'request'=>$this->request);
            indexTheme($input);
        }
	}

    public function infoPage()
    {
        global $themeActive;
        global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $modelPosts = $this->Posts;

        $slug= $_SERVER['REQUEST_URI'];
       
        if(!empty($slug)){
            $slug = str_replace('.html', '', $slug);
            $slug = str_replace('/', '', $slug);

            $conditions = array('slug'=>$slug);

            $data = $modelPosts->find()->where($conditions)->first();
        
            if($data){
                if(function_exists('postTheme')){
                    $url= '/themes/'.$themeActive.'/post.php';

                    $input= array('fileProcess'=>$url,'request'=>$this->request);
                    postTheme($input);
                }

                // lấy danh sách tin tức khác
                $conditions = array('type'=>'post', 'id !='=>$data->id, 'type'=>$data->type);
                $limit = 3;
                $page = 1;
                $order = array('id'=>'desc');
                
                $otherPosts = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                $metaTitleMantan = $data->title;
                $metaKeywordsMantan = $data->keyword;
                $metaDescriptionMantan = $data->description;

                $this->set('post', $data);
                $this->set('otherPosts', $otherPosts);
            } else {
                return $this->redirect('/');
            }
        } else {
            return $this->redirect('/');
        }
    }

    public function search()
    {
        global $themeActive;
        global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;
        global $urlCurrent;
        global $infoSite;

        $modelPosts = $this->Posts;

        $conditions = array();
        if(!empty($_GET['key'])){
            $conditions['title LIKE'] = '%'.$_GET['key'].'%';
        }

        $limit = (!empty($infoSite['number_post']))?$infoSite['number_post']:12;
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

        if(function_exists('searchTheme')){
            $url= '/themes/'.$themeActive.'/search.php';

            $input= array('fileProcess'=>$url,'request'=>$this->request);
            searchTheme($input);
        }

        $metaTitleMantan = 'Tìm kiếm từ khóa '.@$_GET['key'];
        $metaKeywordsMantan = @$_GET['key'];
        $metaDescriptionMantan = 'Kết quả tìm kiếm các bài viết có liên quan đến từ khóa '.@$_GET['key'].' trang '.$page;

        $this->set('page', $page);
        $this->set('totalPage', $totalPage);
        $this->set('back', $back);
        $this->set('next', $next);
        $this->set('urlPage', $urlPage);

        $this->set('listPosts', $listData);
    }

    public function categoryPost()
    {
        global $themeActive;
        global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;
        global $urlCurrent;
        global $modelCategories;
        global $infoSite;

        $modelPosts = $this->Posts;

        $slug= $_SERVER['REQUEST_URI'];
        $conditions = ['type'=>'post'];
        $category = $modelCategories->newEmptyEntity();

        if(!empty($slug)){
            $slug = str_replace('.html', '', $slug);
            $slug = str_replace('/', '', $slug);

            $conditions = array('slug'=>$slug);

            $category = $modelCategories->find()->where($conditions)->first();

            if(!empty($category)){
                $conditions = array('idCategory'=>$category->id);
            }else{
                $category = $modelCategories->newEmptyEntity();
                $conditions = ['type'=>'post'];
            }
        }

        $limit = (!empty($infoSite['number_post']))?$infoSite['number_post']:12;
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

        if(function_exists('categoryPostTheme')){
            $url= '/themes/'.$themeActive.'/category_post.php';

            $input= array('fileProcess'=>$url,'request'=>$this->request);
            categoryPostTheme($input);
        }

        if(empty($category->name)) $category->name = 'Tin tức';
        if(empty($category->keyword)) $category->keyword = 'Tin tức';
        if(empty($category->description)) $category->description = 'Danh sách các bài viết thuộc chuyên mục '.$category->name.' trang '.$page;

        $metaTitleMantan = $category->name;
        $metaKeywordsMantan = $category->keyword;
        $metaDescriptionMantan = $category->description;

        $this->set('page', $page);
        $this->set('totalPage', $totalPage);
        $this->set('back', $back);
        $this->set('next', $next);
        $this->set('urlPage', $urlPage);

        $this->set('listPosts', $listData);
        $this->set('category', $category);
    }
}
?>