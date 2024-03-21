<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

class OptionsController extends AppController{
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

    public function infoSite(){
        global $metaTitleMantan;

        $metaTitleMantan = 'Cài đặt website';
        $modelOptions = $this->Options;
        $mess= '';

        $conditions = array('key_word' => 'contact_site');
        $contact_site = $modelOptions->find()->where($conditions)->first();
        if(empty($contact_site)){
            $contact_site = $modelOptions->newEmptyEntity();
        }

        $conditions = array('key_word' => 'smtp_site');
        $smtp_site = $modelOptions->find()->where($conditions)->first();
        if(empty($smtp_site)){
            $smtp_site = $modelOptions->newEmptyEntity();
        }

        $conditions = array('key_word' => 'seo_site');
        $seo_site = $modelOptions->find()->where($conditions)->first();
        if(empty($seo_site)){
            $seo_site = $modelOptions->newEmptyEntity();
        }

        if ($this->request->is('post')) {
            $dataSend = $this->request->getData();

            // lưu seo site
            if(empty($dataSend['number_post'])){
                $dataSend['number_post'] = 10;
            }

            $value = array( 'title' => $dataSend['title'],
                            'keyword' => $dataSend['keyword'],
                            'description' => $dataSend['description'],
                            'number_post' => $dataSend['number_post'],
                            'code_script' => $dataSend['code_script'],
                            'logo' => $dataSend['logo'],
                            'image_share' => $dataSend['image_share'],
                            'favicon' => $dataSend['favicon'],
                        );

            $seo_site->key_word = 'seo_site';
            $seo_site->value = json_encode($value);

            $modelOptions->save($seo_site);

            // lưu contact site
            $value = array( 'phone' => $dataSend['phone'],
                            'email' => $dataSend['email'],
                            'address' => $dataSend['address'],
                        );

            $contact_site->key_word = 'contact_site';
            $contact_site->value = json_encode($value);

            $modelOptions->save($contact_site);

            // lưu smtp site
            $value = array( 'email' => $dataSend['smtp_email'],
                            'pass' => $dataSend['smtp_pass'],
                            'display_name' => $dataSend['smtp_display_name'],
                            'server' => $dataSend['smtp_server'],
                            'port' => $dataSend['smtp_port'],
                        );

            $smtp_site->key_word = 'smtp_site';
            $smtp_site->value = json_encode($value);

            $modelOptions->save($smtp_site);

            // ghi file email.php
            $configEmail = '<?php 
                            $configMantanSource["EmailTransport"] = [
                                                            "default" => [
                                                                "host" => "'.$dataSend['smtp_server'].'",
                                                                "port" => '.$dataSend['smtp_port'].',
                                                                "username" => "'.$dataSend['smtp_email'].'",
                                                                "password" => "'.$dataSend['smtp_pass'].'",
                                                                "className" => "Smtp",
                                                                "tls" => false,
                                                                "client" => null,
                                                                "url" => env("EMAIL_TRANSPORT_DEFAULT_URL", null),
                                                            ],
                                                        ];
                            ?>';
            $file = fopen(__DIR__.'/../../config/email.php','w');
            fwrite($file,$configEmail);
            fclose($file);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }

        $seo_site_value = array();
        if(!empty($seo_site->value)){
            $seo_site_value = json_decode($seo_site->value, true);
        }

        $contact_site_value = array();
        if(!empty($contact_site->value)){
            $contact_site_value = json_decode($contact_site->value, true);
        }

        $smtp_site_value = array();
        if(!empty($smtp_site->value)){
            $smtp_site_value = json_decode($smtp_site->value, true);
        }

        $this->set('contact_site_value', $contact_site_value);
        $this->set('smtp_site_value', $smtp_site_value);
        $this->set('seo_site_value', $seo_site_value);
        
        $this->set('mess', $mess);
    }

    public function plugins(){
        global $metaTitleMantan;

        $metaTitleMantan = 'Cài đặt gói mở rộng';

        $modelOptions = $this->Options;
        $mess= '';

        $conditions = array('key_word' => 'plugins_site');
        $plugins_site = $modelOptions->find()->where($conditions)->first();
        if(empty($plugins_site)){
            $plugins_site = $modelOptions->newEmptyEntity();
        }

        $plugins_site_value = array();
        if(!empty($plugins_site->value)){
            $plugins_site_value = json_decode($plugins_site->value, true);
        }

        // lấy danh sách gói mở rộng trong thư mục plugins
        $listFile= list_files(__DIR__.'/../../plugins');

        $listFileShow= array();

        foreach($listFile as $file){
            if($file!='.gitkeep' && $file!='PhpExcel'){
                $filename = __DIR__.'/../../plugins/'.$file."/info.xml";
                $info= @simplexml_load_file($filename);
                
                if(empty($info)){
                    $info= (object) '';
                    $info->app= '';
                    $info->verName= '';
                    $info->des= '';
                    $info->author= '';
                    $info->email= '';
                    $info->web= '';
                    $info->request= '';
                }
            
                if(in_array($file, $plugins_site_value)){
                    $listFileShow[] = array('name'=>$file,'active'=>1,'info'=>$info);
                } else {
                    $listFileShow[] = array('name'=>$file,'active'=>0,'info'=>$info);
                }
            }
        }

        foreach($plugins_site_value as $file)
        {
            if(!in_array($file, $listFile))
            {
                $listFileShow[] = array('name'=>$file,'active'=>-1);
            }
        }

        $this->set('listFileShow', $listFileShow);
    }

    public function activePlugin()
    {
        global $sqlInstallDatabase;
        global $sqlDeleteDatabase;

        $modelOptions = $this->Options;

        if(!empty($_GET['name'])){
            $conditions = array('key_word' => 'plugins_site');
            $plugins_site = $modelOptions->find()->where($conditions)->first();
            if(empty($plugins_site)){
                $plugins_site = $modelOptions->newEmptyEntity();
            }

            $plugins_site_value = array();
            if(!empty($plugins_site->value)){
                $plugins_site_value = json_decode($plugins_site->value, true);
            }

            if(!in_array($_GET['name'], $plugins_site_value)){
                $plugins_site_value[] = $_GET['name'];

                $plugins_site->key_word = 'plugins_site';
                $plugins_site->value = json_encode($plugins_site_value);

                if($modelOptions->save($plugins_site)){
                    // lấy danh sách các plugin đã cài
                    $conditions = array('key_word' => 'plugin_installed');
                    $plugin_installed = $modelOptions->find()->where($conditions)->first();
                    if(empty($plugin_installed)){
                        $plugin_installed = $modelOptions->newEmptyEntity();
                    }

                    $plugin_installed_value = array();
                    if(!empty($plugin_installed->value)){
                        $plugin_installed_value = json_decode($plugin_installed->value, true);
                    }
                    
                    // chạy lệnh SQL tạo bảng
                    if(empty($plugin_installed_value) || !in_array($_GET['name'], $plugin_installed_value)){
                        $plugin_installed_value[] = $_GET['name'];
                        
                        $plugin_installed->key_word = 'plugin_installed';
                        $plugin_installed->value = json_encode($plugin_installed_value);
                        $modelOptions->save($plugin_installed);

                        $filename = __DIR__.'/../../plugins/'.$_GET['name'].'/install.php';
                        if (file_exists($filename))
                        {   
                            include_once($filename);

                            if(!empty($sqlInstallDatabase)){
                                $connection = ConnectionManager::get('default');
                                $results = $connection->execute($sqlInstallDatabase)->fetchAll('assoc');
                            }
                        }
                    }
                }
            }
        }

        return $this->redirect('/options/plugins');
    }

    public function deactivePlugin(){
        $modelOptions = $this->Options;
        
        if(!empty($_GET['name'])){
            $conditions = array('key_word' => 'plugins_site');
            $plugins_site = $modelOptions->find()->where($conditions)->first();
            if(empty($plugins_site)){
                $plugins_site = $modelOptions->newEmptyEntity();
            }

            $plugins_site_value = array();
            if(!empty($plugins_site->value)){
                $plugins_site_value = json_decode($plugins_site->value, true);
            }

            if(in_array($_GET['name'], $plugins_site_value)){
                $plugins_site_value = array_diff($plugins_site_value, [$_GET['name']]);

                $plugins_site->key_word = 'plugins_site';
                $plugins_site->value = json_encode($plugins_site_value);

                $modelOptions->save($plugins_site);
            }
        }

        return $this->redirect('/options/plugins');
    }

    public function deletePlugin(){
        global $sqlInstallDatabase;
        global $sqlDeleteDatabase;

        if(!empty($_GET['name'])){
            $filename = __DIR__.'/../../plugins/'.$_GET['name'].'/install.php';
            if (file_exists($filename))
            {   
                include_once($filename);

                if(!empty($sqlDeleteDatabase)){
                    $connection = ConnectionManager::get('default');
                    $results = $connection->execute($sqlDeleteDatabase)->fetchAll('assoc');
                }
            }

            removeDirectory(__DIR__.'/../../plugins/'.$_GET['name']) ;

            $this->deactivePlugin();
        }

        return $this->redirect('/options/plugins');
    }

    public function themes(){
        global $metaTitleMantan;

        $metaTitleMantan = 'Cài đặt gói giao diện';

        $modelOptions = $this->Options;
        $mess= '';

        $conditions = array('key_word' => 'theme_active_site');
        $theme_active_site = $modelOptions->find()->where($conditions)->first();
        if(empty($theme_active_site)){
            $theme_active_site = $modelOptions->newEmptyEntity();
        }

        // lấy danh sách gói mở rộng trong thư mục plugins
        $listFile= list_files(__DIR__.'/../../themes');

        $listFileShow= array();

        foreach($listFile as $file){
            $filename = __DIR__.'/../../themes/'.$file."/info.xml";
            $info= @simplexml_load_file($filename);
            
            if(empty($info)){
                $info= (object) '';
                $info->app= '';
                $info->verName= '';
                $info->des= '';
                $info->author= '';
                $info->email= '';
                $info->web= '';
            }
        
            if($file == $theme_active_site->value){
                $listFileShow[] = array('name'=>$file,'active'=>1,'info'=>$info);
            } else {
                $listFileShow[] = array('name'=>$file,'active'=>0,'info'=>$info);
            }
        }

        if(!in_array($theme_active_site->value, $listFile))
        {
            $listFileShow[] = array('name'=>$file,'active'=>-1);
        }

        $this->set('listFileShow', $listFileShow);
    }

    public function activeTheme(){
        global $sqlInstallDatabase;
        global $sqlDeleteDatabase;
        global $session;

        $modelOptions = $this->Options;

        if(!empty($_GET['name'])){
            $conditions = array('key_word' => 'theme_active_site');
            $theme_active_site = $modelOptions->find()->where($conditions)->first();
            if(empty($theme_active_site)){
                $theme_active_site = $modelOptions->newEmptyEntity();
            }

            if($_GET['name'] != $theme_active_site->value){
                $theme_active_site->key_word = 'theme_active_site';
                $theme_active_site->value = $_GET['name'];

                if($modelOptions->save($theme_active_site)){
                    // update session
                    $session->write('themeActive', $theme_active_site->value);

                    // lấy danh sách các plugin đã cài
                    $conditions = array('key_word' => 'theme_installed');
                    $theme_installed = $modelOptions->find()->where($conditions)->first();
                    if(empty($theme_installed)){
                        $theme_installed = $modelOptions->newEmptyEntity();
                    }

                    $theme_installed_value = array();
                    if(!empty($theme_installed->value)){
                        $theme_installed_value = json_decode($theme_installed->value, true);
                    }
                    
                    // chạy lệnh SQL tạo bảng
                    if(empty($theme_installed_value) || !in_array($_GET['name'], $theme_installed_value)){
                        $theme_installed_value[] = $_GET['name'];
                        
                        $theme_installed->key_word = 'theme_installed';
                        $theme_installed->value = json_encode($theme_installed_value);
                        $modelOptions->save($theme_installed);

                        $filename = __DIR__.'/../../themes/'.$_GET['name'].'/install.php';
                        if (file_exists($filename))
                        {   
                            include_once($filename);

                            if(!empty($sqlInstallDatabase)){
                                $connection = ConnectionManager::get('default');
                                $results = $connection->execute($sqlInstallDatabase)->fetchAll('assoc');
                            }
                        }
                    }
                }
            }
        }

        return $this->redirect('/options/themes');
    }

    public function deleteTheme(){
        global $sqlInstallDatabase;
        global $sqlDeleteDatabase;

        $modelOptions = $this->Options;
        
        if(!empty($_GET['name']) && $_GET['name']!='toptop'){
            $filename = __DIR__.'/../../themes/'.$_GET['name'].'/install.php';
            if (file_exists($filename))
            {   
                include_once($filename);

                if(!empty($sqlDeleteDatabase)){
                    $connection = ConnectionManager::get('default');
                    $results = $connection->execute($sqlDeleteDatabase)->fetchAll('assoc');
                }
            }

            removeDirectory(__DIR__.'/../../themes/'.$_GET['name']) ;

            $conditions = array('key_word' => 'theme_active_site');
            $theme_active_site = $modelOptions->find()->where($conditions)->first();
            if(empty($theme_active_site)){
                $theme_active_site = $modelOptions->newEmptyEntity();
            }

            if($_GET['name'] == $theme_active_site->value){
                $theme_active_site->key_word = 'theme_active_site';
                $theme_active_site->value = 'toptop';

                $modelOptions->save($theme_active_site);
            }
        }

        return $this->redirect('/options/themes');
    }

    public function menus(){
        global $metaTitleMantan;

        $metaTitleMantan = 'Cài đặt trình đơn';

        $modelOptions = $this->loadModel('Options');
        $modelCategories = $this->loadModel('Categories');
        $modelPosts = $this->loadModel('Posts');
        $modelMenus = $this->loadModel('Menus');

        $mess= '';

        if ($this->request->is('post')) {
            $dataSend = $this->request->getData();

            if(!empty($dataSend['action'])){
                if($dataSend['action']=='createMenu'){
                    if(!empty($dataSend['name'])){
                        $menu = $modelOptions->newEmptyEntity();

                        if(!empty($dataSend['idEdit'])){
                            $menu = $modelOptions->find()->where(['id'=>(int) $dataSend['idEdit']])->first();

                            if(empty($menu)){
                                $menu = $modelOptions->newEmptyEntity();
                            }
                        }

                        $menu->key_word = 'menu';
                        $menu->value = $dataSend['name'];
                        $modelOptions->save($menu);

                        if(!empty($dataSend['menuDefault'])){
                            $conditions = array('key_word' => 'menuDefault');
                            $menuDefault = $modelOptions->find()->where($conditions)->first();

                            if(empty($menuDefault)){
                                $menuDefault = $modelOptions->newEmptyEntity();
                            }

                            $menuDefault->key_word = 'menuDefault';
                            $menuDefault->value = $menu->id;
                            $modelOptions->save($menuDefault);
                        }

                        $mess= '<p class="text-success">Lưu trình đơn thành công</p>';
                    }else{
                        $mess= '<p class="text-danger">Bạn chưa nhập tên trình đơn</p>';
                    }
                }elseif($dataSend['action']=='addLink'){
                    if(!empty($dataSend['idMenu'])){
                        if(!empty($dataSend['nameLink'])){
                            if(!empty($dataSend['idLink'])){
                                $link = $modelMenus->find()->where(['id'=>(int) $dataSend['idLink']])->first();

                                if(empty($link)){
                                    $link = $modelMenus->newEmptyEntity();
                                }
                            }else{
                                $link = $modelMenus->newEmptyEntity();
                            }

                            $link->name = $dataSend['nameLink'];
                            $link->link = @$dataSend['link'];
                            $link->description = @$dataSend['desLink'];
                            $link->id_menu = $dataSend['idMenu'];
                            $link->id_parent = (int) @$dataSend['idParent'];
                            $link->weighty = (int) @$dataSend['weighty'];

                            $modelMenus->save($link);

                            $mess= '<p class="text-success">Lưu liên kết thành công</p>';
                        }else{
                            $mess= '<p class="text-danger">Bạn chưa nhập tên liên kết</p>';
                        }
                    }else{
                        $mess= '<p class="text-danger">Bạn cần Thêm mới trình đơn trước khi thêm liên kết</p>';
                    }
                }
            }
        }

        $conditions = array('key_word' => 'menu');
        $menus = $modelOptions->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();
        if(empty($menus)){
            $menus[0] = $modelOptions->newEmptyEntity();
        }
       
        if(empty($_GET['id']) && !empty($menus[0]->id)){
            return $this->redirect('/options/menus/?id='.$menus[0]->id);
        }

        if(!empty($_GET['id'])){
            $menu = $modelOptions->find()->where(['id'=>(int) @$_GET['id']])->first();
        }

        if(empty($menu)){
            $menu = $modelOptions->newEmptyEntity();
        }

        $conditions = array('type' => 'post');
        $category_post = $modelCategories->find()->where($conditions)->all()->toList();

        $conditions = array('type' => 'album');
        $category_album = $modelCategories->find()->where($conditions)->all()->toList();

        $conditions = array('type' => 'video');
        $category_video = $modelCategories->find()->where($conditions)->all()->toList();

        $conditions = array('type' => 'page');
        $pages = $modelPosts->find()->where($conditions)->all()->toList();

        $conditions = array('id_menu' => (int) @$_GET['id']);
        $listLinks = $modelMenus->find()->where($conditions)->order(['id_parent' => 'ASC', 'weighty'=>'ASC'])->all()->toList();

        $links = [];
        if(!empty($listLinks)){
            foreach ($listLinks as $value) {
                $check_parent = false;

                if($value->id_parent == 0){
                    $links[$value->id] = $value;
                    $check_parent = true;
                }else{
                    if(!empty($links[$value->id_parent])){
                        if(empty($links[$value->id_parent]->sub)){
                            $links[$value->id_parent]->sub = [];
                        }

                        $links[$value->id_parent]->sub[$value->id] = $value;
                        $check_parent = true;
                    }else{
                        if(!empty($links)){
                            foreach ($links as $key2=>$value2) {
                                if(!empty($value2->sub[$value->id_parent])){
                                    if(empty($links[$key2]->sub[$value->id_parent]->sub)){
                                        $links[$key2]->sub[$value->id_parent]->sub = [];
                                    }

                                    $links[$key2]->sub[$value->id_parent]->sub[$value->id] = $value;
                                    $check_parent = true;
                                }else{
                                    if(!empty($value2->sub)){
                                        foreach ($value2->sub as $key3 => $value3) {
                                            if(!empty($value3->sub[$value->id_parent])){
                                                if(empty($links[$key2]->sub[$key3]->sub[$value->id_parent]->sub)){
                                                    $links[$key2]->sub[$key3]->sub[$value->id_parent]->sub = [];
                                                }

                                                $links[$key2]->sub[$key3]->sub[$value->id_parent]->sub[$value->id] = $value;
                                                $check_parent = true;
                                            }else{
                                                if(!empty($value3->sub)){
                                                    foreach ($value3->sub as $key4 => $value4) {
                                                        if(!empty($value4->sub[$value->id_parent])){
                                                            if(empty($links[$key2]->sub[$key3]->sub[$key4]->sub[$value->id_parent]->sub)){
                                                                $links[$key2]->sub[$key3]->sub[$key4]->sub[$value->id_parent]->sub = [];
                                                            }

                                                            $links[$key2]->sub[$key3]->sub[$key4]->sub[$value->id_parent]->sub[$value->id] = $value;
                                                            $check_parent = true;
                                                        }else{
                                                            if(!empty($value4->sub)){
                                                                foreach ($value4->sub as $key5 => $value5) {
                                                                    if(!empty($value5->sub[$value->id_parent])){
                                                                        if(empty($links[$key2]->sub[$key3]->sub[$key4]->sub[$key5]->sub[$value->id_parent]->sub)){
                                                                            $links[$key2]->sub[$key3]->sub[$key4]->sub[$key5]->sub[$value->id_parent]->sub = [];
                                                                        }

                                                                        $links[$key2]->sub[$key3]->sub[$key4]->sub[$key5]->sub[$value->id_parent]->sub[$value->id] = $value;
                                                                        $check_parent = true;
                                                                    }else{
                                                                        if(!empty($value5->sub)){
                                                                            foreach ($value5->sub as $key6 => $value6) {
                                                                                // code...
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
                                }
                            }
                        }
                    }
                }

                if(!$check_parent){
                    $links[$value->id] = $value;
                }
            }
        }
        
        $conditions = array('key_word' => 'menuDefault');
        $menuDefault = $modelOptions->find()->where($conditions)->first();
        $menuDefault = (int) @$menuDefault->value;

        $this->set('menus', $menus);
        $this->set('menu', $menu);
        $this->set('mess', $mess);
        $this->set('category_post', $category_post);
        $this->set('category_album', $category_album);
        $this->set('category_video', $category_video);
        $this->set('pages', $pages);
        $this->set('links', $links);
        $this->set('menuDefault', $menuDefault);
    }
}
?>