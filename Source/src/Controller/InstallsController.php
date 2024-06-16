<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

class InstallsController extends AppController{
	public function index(){
		
	}

	public function updateDatabase(){
		global $sqlUpdateDatabase;
		global $sqlFixDatabase;
		global $metaTitleMantan;

		$metaTitleMantan = 'Cập nhập cơ sở dữ liệu';
		$modelOptions = $this->Options;

		// lấy danh sách gói mở rộng trong thư mục plugins
        $listFile= list_files(__DIR__.'/../../plugins');

        $listFileShow= array();

        // lấy danh sách plugin được kích hoạt
        $conditions = array('key_word' => 'plugins_site');
        $plugins_site = $modelOptions->find()->where($conditions)->first();
        if(empty($plugins_site)){
            $plugins_site = $modelOptions->newEmptyEntity();
        }

        $plugins_site_value = array();
        if(!empty($plugins_site->value)){
            $plugins_site_value = json_decode($plugins_site->value, true);
        }

        // tạo kết nối với database
        $connection = ConnectionManager::get('default');

        foreach($listFile as $file){
        	if(in_array($file, $plugins_site_value)){
                $filename = __DIR__.'/../../plugins/'.$file."/install.php";
                
                if(file_exists($filename)){
                	include_once($filename);

                	if(!empty($sqlUpdateDatabase) && is_array($sqlUpdateDatabase)){
                		foreach ($sqlUpdateDatabase as $table => $value) {
                			$sqlQuery = "SHOW TABLES LIKE '".$table."';";
                			$results = $connection->execute($sqlQuery)->fetchAll('assoc');

                			if(!empty($results)){
	                			$sqlQuery = "DESCRIBE ".$table.";";
	                            $results = $connection->execute($sqlQuery)->fetchAll('assoc');

	                            if(!empty($results)){
	                            	foreach ($results as $field) {
	                            		if(isset($value[$field['Field']])){
	                            			unset($value[$field['Field']]);
	                            		}
	                            	}

	                            	if(!empty($value)){
	                            		debug($value);

	                            		foreach ($value as $sqlQuery) {
	                            			$connection->execute($sqlQuery)->fetchAll('assoc');
	                            		}
	                            	}
	                            }

	                            unset($sqlUpdateDatabase[$table]);
	                        }
                		}

                		if(!empty($sqlUpdateDatabase)){
                			foreach ($sqlUpdateDatabase as $table => $value) {
                				$sqlQuery = "CREATE TABLE `".$table."` (
											  `id` int(11) NOT NULL AUTO_INCREMENT,
											  PRIMARY KEY (`id`)
											) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

								$connection->execute($sqlQuery)->fetchAll('assoc');

								foreach ($value as $field=>$sqlQuery) {
									if($field != 'id'){
                        				$connection->execute($sqlQuery)->fetchAll('assoc');
                        			}
                        		}
                			}
                		}
                	}else{
                		debug($file);
                		debug($sqlUpdateDatabase);
                	}

                	if(!empty($sqlFixDatabase)){
                        $connection->execute($sqlFixDatabase)->fetchAll('assoc');
                	}
                }
            }
        }

        echo 1;die;
	}

	public function createDatabase(){
		$sql = '';	
		
		// tạo bảng CSDL
		$sql .= "CREATE TABLE `admins` ( `id` INT NOT NULL AUTO_INCREMENT , `user` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `fullName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

		$sql .= "CREATE TABLE `options` ( `id` INT NOT NULL AUTO_INCREMENT , `key_word` VARCHAR(255) NOT NULL , `value` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `version` INT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

		$sql .= "CREATE TABLE `categories` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `parent` INT NOT NULL DEFAULT '0' , `image` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL , `keyword` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL , `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL , `slug` TEXT NOT NULL , `type` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

		$sql .= "CREATE TABLE `posts` ( `id` INT NOT NULL AUTO_INCREMENT , `title` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `keyword` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `slug` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `pin` BOOLEAN NOT NULL , `time` INT NOT NULL , `author` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `image` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `idCategory` INT NOT NULL , `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `content` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `view` INT NOT NULL DEFAULT '0' , `type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL ,PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

		$sql .= "CREATE TABLE `slugs` ( `id` INT NOT NULL AUTO_INCREMENT , `slug` VARCHAR(255) NOT NULL , `controller` VARCHAR(255) NOT NULL , `action` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

		$sql .= "CREATE TABLE `menus` ( `id` INT NOT NULL AUTO_INCREMENT , `id_menu` INT NOT NULL , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `link` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `description` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `id_parent` INT NOT NULL , `weighty` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

		$sql .= "CREATE TABLE `albums` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `id_category` INT NOT NULL , `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `time_create` INT NOT NULL , `status` VARCHAR(255) NOT NULL , `slug` VARCHAR(255) NOT NULL , `author` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

		$sql .= "CREATE TABLE `albuminfos` ( `id` INT NOT NULL AUTO_INCREMENT , `id_album` INT NOT NULL , `image` VARCHAR(255) NOT NULL , `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `link` VARCHAR(255) NOT NULL , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";

		$sql .= "CREATE TABLE `videos` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `id_category` INT NOT NULL , `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `time_create` INT NOT NULL , `status` VARCHAR(255) NOT NULL , `slug` VARCHAR(255) NOT NULL , `author` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `description` TEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , `youtube_code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ";



		// chèn dữ liệu mẫu
		$sql .= "INSERT INTO `admins` (`id`, `user`, `password`, `fullName`, `email`) VALUES (NULL, 'admin', '0c909a141f1f2c0a1cb602b0b2d7d050', 'Trần Mạnh', 'tranmanhbk179@gmail.com'); ";

		$sql .= "INSERT INTO `options` (`id`, `key_word`, `value`, `version`) VALUES (NULL, 'theme_active_site', 'toptop', NULL); ";

		$sql .= "INSERT INTO `options` (`id`, `key_word`, `value`, `version`) VALUES (NULL, 'plugin_installed', '[]', NULL);";

		$sql .= "INSERT INTO `options` (`id`, `key_word`, `value`, `version`) VALUES (NULL, 'theme_installed', '[]', NULL);";
	}
}
?>