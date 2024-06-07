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
        global $isHome;

        $isHome = true;

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
        global $isPost;
        global $isPage;
        global $postDetail;
        global $modelCategories;

        $modelPosts = $this->Posts;

        $slug= $_SERVER['REQUEST_URI'];
       
        if(!empty($slug)){
            $slug = explode('.html', $slug);
            $slug = $slug[0];
            $slug = str_replace('/', '', $slug);

            $conditions = array('slug'=>$slug);

            $data = $modelPosts->find()->where($conditions)->first();
        
            if($data){
                $data->view ++;
                $modelPosts->save($data);

                if(function_exists('postTheme')){
                    $url= '/themes/'.$themeActive.'/post.php';

                    $input= array('fileProcess'=>$url,'request'=>$this->request);
                    postTheme($input);
                }

                if($data->type == 'post'){
                    $isPost = true;
                }else{
                    $isPage = true;
                }

                $category = [];
                if($data->idCategory > 0){
                    $category = $modelCategories->find()->where(['id'=>$data->idCategory])->first();
                }

                // lấy danh sách tin tức khác
                $conditions = array('id !='=>$data->id, 'type'=>$data->type);
                $limit = 3;
                $page = 1;
                $order = array('id'=>'desc');

                if(!empty($data->idCategory)){
                    $conditions['idCategory'] = $data->idCategory;
                }
                
                $otherPosts = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                $metaTitleMantan = $data->title;
                $metaKeywordsMantan = $data->keyword;
                $metaDescriptionMantan = $data->description;
                $postDetail = $data;

                $this->set('post', $data);
                $this->set('otherPosts', $otherPosts);
                $this->set('category', $category);
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
        global $modelCategoryConnects;
        global $infoSite;
        global $isCategory;
        global $categoryDetail;

        $isCategory = true;

        $modelPosts = $this->Posts;

        $slug= $_SERVER['REQUEST_URI'];
        $conditions = ['Posts.type'=>'post'];
        $category = $modelCategories->newEmptyEntity();

        if(!empty($slug)){
            $slug = explode('.html', $slug);
            $slug = $slug[0];
            $slug = str_replace('/', '', $slug);

            $conditionsCate = array('slug'=>$slug);

            $category = $modelCategories->find()->where($conditionsCate)->first();

            if(!empty($category)){
                $conditions['CategoryConnects.id_category'] = $category->id;
                $conditions['CategoryConnects.keyword'] = 'post';
            }else{
                $category = $modelCategories->newEmptyEntity();
            }
        }
        
        $limit = (!empty($infoSite['number_post']))?$infoSite['number_post']:12;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $join = [
                    [
                        'table' => 'category_connects',
                        'alias' => 'CategoryConnects',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Posts.id = CategoryConnects.id_parent',
                            'CategoryConnects.keyword = "post"',
                        ],
                    ]
                ];

        $select = ['Posts.id', 'Posts.title', 'Posts.keyword', 'Posts.pin', 'Posts.author', 'Posts.image', 'Posts.description', 'Posts.content', 'Posts.slug', 'Posts.time', 'Posts.view', 'Posts.type'];

        $listData = $modelPosts->find()->join($join)->select($select)->limit($limit)->page($page)->where($conditions)->order(['Posts.id' => 'DESC'])->all()->toList();

        $totalData = $modelPosts->find()->join($join)->where($conditions)->all()->toList();
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
        $categoryDetail = $category;

        $this->set('page', $page);
        $this->set('totalPage', $totalPage);
        $this->set('back', $back);
        $this->set('next', $next);
        $this->set('urlPage', $urlPage);

        $this->set('listPosts', $listData);
        $this->set('category', $category);
    }

    public function infoAlbum()
    {
        global $themeActive;
        global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $modelAlbums = $this->loadModel('Albums');
        $modelAlbuminfos = $this->loadModel('Albuminfos');

        $slug= $_SERVER['REQUEST_URI'];
       
        if(!empty($slug)){
            $slug = explode('.html', $slug);
            $slug = $slug[0];
            $slug = str_replace('/', '', $slug);

            $conditions = array('slug'=>$slug);

            $data = $modelAlbums->find()->where($conditions)->first();
        
            if($data){
                // lấy danh sách ảnh trong album
                $conditions = array('id_album'=>$data->id);
                $data->listImages = $modelAlbuminfos->find()->where($conditions)->all()->toList();

                if(function_exists('albumTheme')){
                    $url= '/themes/'.$themeActive.'/album.php';

                    $input= array('fileProcess'=>$url,'request'=>$this->request);
                    albumTheme($input);
                }

                // lấy danh sách album khác
                $conditions = array('id !='=>$data->id);
                $limit = 3;
                $page = 1;
                $order = array('id'=>'desc');
                
                $otherData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                $metaTitleMantan = $data->title;
                $metaDescriptionMantan = $data->description;

                $this->set('album', $data);
                $this->set('otherAlbums', $otherData);
            } else {
                return $this->redirect('/');
            }
        } else {
            return $this->redirect('/');
        }
    }

    public function categoryAlbum()
    {
        global $themeActive;
        global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;
        global $urlCurrent;
        global $modelCategories;
        global $modelCategoryConnects;
        global $infoSite;

        $modelAlbums = $this->loadModel('Albums');

        $slug= $_SERVER['REQUEST_URI'];
        $conditions = [];
        $category = $modelCategories->newEmptyEntity();

        if(!empty($slug)){
            $slug = explode('.html', $slug);
            $slug = $slug[0];
            $slug = str_replace('/', '', $slug);

            $conditions = array('slug'=>$slug);

            $category = $modelCategories->find()->where($conditions)->first();

            if(!empty($category)){
                $conditions['CategoryConnects.id_category'] = $category->id;
                $conditions['CategoryConnects.keyword'] = 'album';
            }else{
                $category = $modelCategories->newEmptyEntity();
            }
        }

        $limit = (!empty($infoSite['number_post']))?$infoSite['number_post']:12;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $join = [
                    [
                        'table' => 'category_connects',
                        'alias' => 'CategoryConnects',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Albums.id = CategoryConnects.id_parent',
                            'CategoryConnects.keyword = "album"',
                        ],
                    ]
                ];

        $select = ['Albums.id', 'Albums.title', 'Albums.id_category', 'Albums.image', 'Albums.time_create', 'Albums.status', 'Albums.slug', 'Albums.author', 'Albums.description'];

        $listData = $modelAlbums->find()->join($join)->select($select)->limit($limit)->page($page)->where($conditions)->order(['Albums.id' => 'DESC'])->all()->toList();

        $totalData = $modelAlbums->find()->join($join)->where($conditions)->all()->toList();
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

        if(function_exists('categoryAlbumTheme')){
            $url= '/themes/'.$themeActive.'/category_album.php';

            $input= array('fileProcess'=>$url,'request'=>$this->request);
            categoryAlbumTheme($input);
        }

        if(empty($category->name)) $category->name = 'Album hình ảnh';
        if(empty($category->keyword)) $category->keyword = 'thư viện hình ảnh';
        if(empty($category->description)) $category->description = 'Danh sách các album hình ảnh thuộc chuyên mục '.$category->name.' trang '.$page;

        $metaTitleMantan = $category->name;
        $metaKeywordsMantan = $category->keyword;
        $metaDescriptionMantan = $category->description;

        $this->set('page', $page);
        $this->set('totalPage', $totalPage);
        $this->set('back', $back);
        $this->set('next', $next);
        $this->set('urlPage', $urlPage);

        $this->set('listAlbums', $listData);
        $this->set('category', $category);
    }

    public function infoVideo()
    {
        global $themeActive;
        global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $modelVideos = $this->loadModel('Videos');

        $slug= $_SERVER['REQUEST_URI'];
       
        if(!empty($slug)){
            $slug = explode('.html', $slug);
            $slug = $slug[0];
            $slug = str_replace('/', '', $slug);

            $conditions = array('slug'=>$slug);

            $data = $modelVideos->find()->where($conditions)->first();
        
            if($data){
                if(function_exists('videoTheme')){
                    $url= '/themes/'.$themeActive.'/video.php';

                    $input= array('fileProcess'=>$url,'request'=>$this->request);
                    videoTheme($input);
                }

                // lấy danh sách album khác
                $conditions = array('id !='=>$data->id);
                $limit = 3;
                $page = 1;
                $order = array('id'=>'desc');
                
                $otherData = $modelVideos->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                $metaTitleMantan = $data->title;
                $metaDescriptionMantan = $data->description;

                $this->set('video', $data);
                $this->set('otherVideos', $otherData);
            } else {
                return $this->redirect('/');
            }
        } else {
            return $this->redirect('/');
        }
    }

    public function categoryVideo()
    {
        global $themeActive;
        global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;
        global $urlCurrent;
        global $modelCategories;
        global $modelCategoryConnects;
        global $infoSite;

        $modelVideos = $this->loadModel('Videos');

        $slug= $_SERVER['REQUEST_URI'];
        $conditions = [];
        $category = $modelCategories->newEmptyEntity();

        if(!empty($slug)){
            $slug = explode('.html', $slug);
            $slug = $slug[0];
            $slug = str_replace('/', '', $slug);

            $conditions = array('slug'=>$slug);

            $category = $modelCategories->find()->where($conditions)->first();

            if(!empty($category)){
                $conditions['CategoryConnects.id_category'] = $category->id;
                $conditions['CategoryConnects.keyword'] = 'video';
            }else{
                $category = $modelCategories->newEmptyEntity();
            }
        }

        $limit = (!empty($infoSite['number_post']))?$infoSite['number_post']:12;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $join = [
                    [
                        'table' => 'category_connects',
                        'alias' => 'CategoryConnects',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Videos.id = CategoryConnects.id_parent',
                            'CategoryConnects.keyword = "video"',
                        ],
                    ]
                ];

        $select = ['Videos.id', 'Videos.title', 'Videos.id_category', 'Videos.image', 'Videos.time_create', 'Videos.status', 'Videos.slug', 'Videos.author', 'Videos.description', 'Videos.youtube_code'];

        $listData = $modelVideos->find()->join($join)->select($select)->limit($limit)->page($page)->where($conditions)->order(['Videos.id' => 'DESC'])->all()->toList();

        $totalData = $modelVideos->find()->join($join)->where($conditions)->all()->toList();
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

        if(function_exists('categoryAlbumTheme')){
            $url= '/themes/'.$themeActive.'/category_album.php';

            $input= array('fileProcess'=>$url,'request'=>$this->request);
            categoryAlbumTheme($input);
        }

        if(empty($category->name)) $category->name = 'Videos';
        if(empty($category->keyword)) $category->keyword = 'thư viện video';
        if(empty($category->description)) $category->description = 'Danh sách các video thuộc chuyên mục '.$category->name.' trang '.$page;

        $metaTitleMantan = $category->name;
        $metaKeywordsMantan = $category->keyword;
        $metaDescriptionMantan = $category->description;

        $this->set('page', $page);
        $this->set('totalPage', $totalPage);
        $this->set('back', $back);
        $this->set('next', $next);
        $this->set('urlPage', $urlPage);

        $this->set('listVideos', $listData);
        $this->set('category', $category);
    }
}
?>