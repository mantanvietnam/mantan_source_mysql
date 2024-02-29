<?php 
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\Message;
use Cake\Mailer\TransportFactory;
use Cake\Http\Response;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;
use PhpOffice\PhpSpreadsheet\Writer\Exception as WriterException;


/**********************************************************
 *  Các file đã sửa
 *  1. /src/Controller/AppController.php sửa trong hàm initialize
 *  2. /config/bootstrap.php include file mantanFunctions.php
 *  3. /.htacess bổ sung thêm RewriteCond
 *  4. Cần chạy PHP 8.0 trở lên và chèn extension=zip vào php.ini
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * **********************************************************/

global $hookMenuAdminMantan;
global $hookMenusAppearanceMantan;
global $variableGlobal;
global $tmpVariable;
global $themeActive;
global $isRequestPost;
global $csrfToken;

global $modelCategories;
global $modelCategoryConnects;
global $modelOptions;
global $modelPosts;
global $modelMenus;
global $modelAlbums;
global $modelAlbuminfos;
global $modelVideos;

global $urlCurrent;
global $urlThemeActive;
global $urlHomes;

global $metaTitleMantan;
global $metaKeywordsMantan;
global $metaDescriptionMantan;
global $metaImageMantan;

global $routesPlugin;
global $routesTheme;

global $session;

global $infoSite;
global $contactSite;
global $smtpSite;

global $isHome;
global $isCategory;
global $isPost;
global $isPage;
global $isPlugin;

global $isMobile;
global $isTable;
global $isDesktop;

$isHome = false;
$isCategory = false;
$isPost = false;
$isPage = false;
$isPlugin = false;

// kiểm tra thiết bị người dùng
$isMobile = false;
$isTable = false;
$isDesktop = false;

$userAgent = (!empty($_SERVER['HTTP_USER_AGENT']))?$_SERVER['HTTP_USER_AGENT']:'';
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false);
$isTablet = (strpos($userAgent, 'iPad') !== false || strpos($userAgent, 'Tablet') !== false);
$isDesktop = !$isMobile && !$isTablet;

if(isset($_SERVER['HTTPS'])){
    $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
}
else{
    $protocol = 'http';
}

$protocol = 'https';

$urlHomes = $protocol . "://" . @$_SERVER['HTTP_HOST'].'/';

$variableGlobal= array('hookMenuAdminMantan', 'hookMenusAppearanceMantan', 'tmpVariable', 'themeActive', 'isRequestPost', 'modelCategories', 'modelOptions', 'urlCurrent', 'urlHomes', 'urlThemeActive', 'metaTitleMantan', 'metaKeywordsMantan', 'metaDescriptionMantan', 'routesPlugin', 'routesTheme', 'session', 'infoSite', 'contactSite', 'smtpSite', 'csrfToken', 'modelPosts', 'modelMenus', 'modelAlbums', 'modelAlbuminfos', 'modelVideos', 'modelCategoryConnects', 'metaImageMantan', 'isHome', 'isCategory', 'isPost', 'isPage', 'isPlugin', 'isMobile', 'isTable', 'isDesktop');


$metaTitleMantan = 'Mantan Source';

function createSlugMantan($text)
{
	$marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
	"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
	,"ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
	,"ờ","ớ","ợ","ở","ỡ",
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	"ỳ","ý","ỵ","ỷ","ỹ",
	"đ",
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
	,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ",
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
	,"Ờ","Ớ","Ợ","Ở","Ỡ",
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	"Đ"," ","·","/","_",",",":",";",".","&","%","@","'",'"',"?","+","*","~","!","#","$","^","’");
	
	$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a"
	,"a","a","a","a","a","a",
	"e","e","e","e","e","e","e","e","e","e","e",
	"i","i","i","i","i",
	"o","o","o","o","o","o","o","o","o","o","o","o"
	,"o","o","o","o","o",
	"u","u","u","u","u","u","u","u","u","u","u",
	"y","y","y","y","y",
	"d",
	"A","A","A","A","A","A","A","A","A","A","A","A"
	,"A","A","A","A","A",
	"E","E","E","E","E","E","E","E","E","E","E",
	"I","I","I","I","I",
	"O","O","O","O","O","O","O","O","O","O","O","O"
	,"O","O","O","O","O",
	"U","U","U","U","U","U","U","U","U","U","U",
	"Y","Y","Y","Y","Y",
	"D","-","","","-","","","","","","","","","","","","","","","","","","");
	
	$text= str_replace('-',' ',$text);
	$text= preg_replace('/\s\s+/', ' ', trim($text));
	$text= str_replace($marTViet,$marKoDau,$text);

	if($text !== mb_convert_encoding( mb_convert_encoding($text, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') ) {
		$text = mb_convert_encoding($text, 'UTF-8', mb_detect_encoding($text));
	}

    $text = htmlentities($text, ENT_NOQUOTES, 'UTF-8');

    $text = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $text);

    $text = html_entity_decode($text, ENT_NOQUOTES, 'UTF-8');

    $text = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $text);

    $text = strtolower( trim($text, '-') );

	return strtolower($text);
}

function list_files($directory = '.')
{
	$listFile= array();
    if ($directory != '.')
    {
        $directory = rtrim($directory, '/') . '/';
    }
    
    if ($handle = opendir($directory))
    {
        while (false !== ($file = readdir($handle)))
        {
            if ($file != '.' && $file != '..')
            {
                array_push($listFile,  $file);
            }
        }
        
        closedir($handle);
    }
    return $listFile;
}

function removeDirectory($dir) 
{
	if ($handle = opendir("$dir")) 
	{
		while (false !== ($item = readdir($handle))) 
		{
			if ($item != "." && $item != "..") 
			{
				if (is_dir("$dir/$item")) 
				{
					removeDirectory("$dir/$item");
				} 
				else 
				{
					unlink("$dir/$item");
					//echo " removing $dir/$item<br>\n";
				}
			}
		}
		closedir($handle);
		rmdir($dir);
		//echo "removing $dir<br>\n";
	}
}

function addMenusAppearance($category)
{
	/* $category= array(array(  'title'=>'Product',
								'sub'=>array(
											    array (
											      'url' => $urlPlugins.'cat/car.html',
											      'name' => 'Car'
											    ), 
											    array (
											      'url' => $urlPlugins.'cat/moto.html',
											      'name' => 'Moto',
											      'sub' => array ('url' => $urlPlugins.'cat/honda.html',
															      'name' => 'Honda'
															     )
											    )
											)
								)
						);
	*/
	global $hookMenusAppearanceMantan;
	if(!is_array($hookMenusAppearanceMantan)) $hookMenusAppearanceMantan= array();
	
	$hookMenusAppearanceMantan= array_merge($hookMenusAppearanceMantan,$category);
}

function addMenuAdminMantan($menus= array())
{
	global $hookMenuAdminMantan;
	
	if(!is_array($hookMenuAdminMantan)) $hookMenuAdminMantan= array();
	$hookMenuAdminMantan= array_merge($hookMenuAdminMantan, $menus); 
}   

function setVariable($key,$value)
{
	global $tmpVariable;
	$tmpVariable[$key]= $value;
}

function getHeader()
{
	global $variableGlobal;
	
	foreach($variableGlobal as $variable){
		global $$variable;
	}

	if(!empty($tmpVariable))
	{
		foreach($tmpVariable as $key=>$value)
		{
			$$key= $value;
		}
	}

	include(__DIR__.'/../themes/'.$themeActive.'/header.php');
}

function getFooter()
{
	global $variableGlobal;
	
	foreach($variableGlobal as $variable){
		global $$variable;
	}

	if(!empty($tmpVariable))
	{
		foreach($tmpVariable as $key=>$value)
		{
			$$key= $value;
		}
	}

	include(__DIR__.'/../themes/'.$themeActive.'/footer.php');
}

function getSidebar()
{	
	global $variableGlobal;
	
	foreach($variableGlobal as $variable){
		global $$variable;
	}

	if(!empty($tmpVariable))
	{
		foreach($tmpVariable as $key=>$value)
		{
			$$key= $value;
		}
	}

	include(__DIR__.'/../themes/'.$themeActive.'/sidebar.php');
}

function getFileTheme($file)
{	
	global $variableGlobal;
	
	foreach($variableGlobal as $variable){
		global $$variable;
	}

	if(!empty($tmpVariable))
	{
		foreach($tmpVariable as $key=>$value)
		{
			$$key= $value;
		}
	}

	include(__DIR__.'/../themes/'.$themeActive.'/'.$file);
}

function showEditorInput($idEditor='',$nameEditor='',$content='')
{
	echo '	<textarea style="border: 1px solid #abadb3;height: auto;"  name="'.$nameEditor.'" id="'.$idEditor.'">'.$content.'</textarea>
			<script type="text/javascript">
				CKEDITOR.replace("'.$idEditor.'", {
				    allowedContent: true,
				});
			</script>
			';
}

function showUploadFile($idInput='',$nameInput='',$value='',$number='')
{ 
	echo '	<script type="text/javascript" src="/ckfinder/ckfinder.js"></script>
			<script type="text/javascript">
				function BrowseServerImage'.$number.'()
				{
					var finder = new CKFinder();
					finder.basePath = "../";	
					finder.selectActionFunction = SetFileFieldImage'.$number.';
					finder.popup();
				}

				function SetFileFieldImage'.$number.'( fileUrl )
				{
					document.getElementById("'.$idInput.'").value = fileUrl;
				}
			</script>

			<div class="input-group">
				<input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="btnGroupAddonUpload'.$number.'" name="'.$nameInput.'" id="'.$idInput.'" value="'.$value.'">

			    <div class="input-group-prepend">
			      <div class="btn btn-secondary input-group-text" onclick="BrowseServerImage'.$number.'();" id="btnGroupAddonUpload'.$number.'">Upload</div>
			    </div>
			    
			</div>';
}


function mantan_header()
{
	global $checkMantanHeader;
	global $infoMantanSource;
	global $infoSite;
	global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;
    global $metaImageMantan;
    global $urlHomes;
    global $urlCurrent;

	$checkMantanHeader= true;
	$infoMantanSource['verName']= 'v2.0';

	if(empty($metaImageMantan)){
		$metaImageMantan = @$infoSite['image_share'];
	}
	
	echo '  <meta name="generator" content="Mantan Source'.$infoMantanSource['verName'].'" />
			<meta name="application-name" content="Mantan Source '.$infoMantanSource['verName'].'">
			<meta name="Publisher" CONTENT="Mantan Source '.$infoMantanSource['verName'].'">

			<meta charset="UTF-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1.0">

			<title>'.$metaTitleMantan.'</title>
			<meta name="description" content="'.$metaDescriptionMantan.'" />
			<meta name="keywords" content="'.$metaKeywordsMantan.'" />

			<!-- Google / Search Engine Tags -->
		  	<meta itemprop="name" content="'.$metaTitleMantan.'">
		  	<meta itemprop="description" content="'.$metaDescriptionMantan.'">
		  	<meta itemprop="image" content="'.$metaImageMantan.'">
		    
		    <!-- Facebook Meta Tags -->
			<meta property="og:title" content="'.$metaTitleMantan.'"/>
			<meta property="og:type" content="website"/>
			<meta property="og:description" content="'.$metaDescriptionMantan.'"/>
			<meta property="og:url" content="'.$urlCurrent.'"/>
			<meta property="og:site_name" content="'.$metaTitleMantan.'"/>
			<meta property="og:image" content="'.$metaImageMantan.'" />
			<meta property="og:image:alt" content="Hình ảnh '.$metaTitleMantan.'" />
			<meta property="fb:admins" content="" />
			<meta property="fb:app_id" content="1695746487308818" /> 
			<meta property="og:image:width" content="900" />
			<meta property="og:image:height" content="603" />

		    <!-- Twitter Meta Tags -->
		    <meta name="twitter:card" content="summary_large_image">
		    <meta name="twitter:title" content="'.$metaTitleMantan.'">
		    <meta name="twitter:description" content="'.$metaDescriptionMantan.'">
		    <meta name="twitter:image" content="'.$metaImageMantan.'">
				
		    <!-- Favicon -->
    		<link rel="icon" type="image/x-icon" href="'.@$infoSite['favicon'].'" />

	'.@$infoSite['code_script'];
}	

function saveSlugURL($slug='', $controllerAction='', $action='')
{
	global $controller;

	if(!empty($slug) && !empty($controllerAction) && !empty($action)){
		$modelSlugs = $controller->loadModel('Slugs');

		$infoSlug = $modelSlugs->newEmptyEntity();

		$infoSlug->slug = $slug;
		$infoSlug->controller = $controllerAction;
		$infoSlug->action = $action;

		$modelSlugs->save($infoSlug);

		$dir = __DIR__.'/routes_slugs.php';
		$listData = $modelSlugs->find()->all()->toList();

		if(!empty($listData)){
			// write file routes_slugs.php
			$string= '<?php ';
			if(!empty($listData)){
				foreach($listData as $data){
					$string .= '$builder->connect("/'.$data->slug.'.html", ["controller" => "'.$data->controller.'", "action" => "'.$data->action.'"]);';
				}
			}
			$string.= ' ?>';
			$file = fopen($dir,'w');
			fwrite($file,$string);
			fclose($file);
		}
	}
}

function deleteSlugURL($slug='')
{
	global $controller;
	$modelSlugs = $controller->loadModel('Slugs');

	if(!empty($slug)){
		$conditions = array('slug' => $slug);
        $data = $modelSlugs->find()->where($conditions)->first();
			
		if(!empty($data)){
         	$modelSlugs->delete($data);
        }
	}
}

function sendDataConnectMantan($url,$data=null,$header=array(),$typeData='form', $typeSend= 'POST')
{
	/*
	$headers = array(
        'Authorization: key=' .self::$API_ACCESS_KEY,
        'Content-Type: application/json');
	*/
        
    if(!empty($data) && $typeSend!='GET'){
   		$stringSend= '';
   		if($typeData=='form'){
   			$stringSend= array();
	   		
	   		foreach($data as $key=>$value){
	   			$stringSend[]= $key.'='.$value;
	   		}

	   		$stringSend= implode('&', $stringSend);
	   	}elseif($typeData=='raw'){
	   		$stringSend= json_encode($data);
	   	}elseif($typeData=='x-www-form-urlencoded'){
	   		$stringSend= http_build_query($data); // Dữ liệu được chuyển dạng x-www-form-urlencoded
	   	}
   		
		$ch = curl_init($url);

		if(strtoupper($typeSend)=='PUT'){
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_PUT, 1);
			$header[]= 'Content-Length: '.strlen($stringSend);
			//$stringSend= http_build_query($data);
			//$stringSend= json_encode($data);
		}else{
			curl_setopt($ch, CURLOPT_POST, 1);
		}

		curl_setopt($ch, CURLOPT_URL,$url);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$stringSend);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//for debug only!
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$server_output = curl_exec ($ch);

		curl_close ($ch);

		return $server_output;
    }else{
    	$stringSend = '';
    	if(!empty($data)){
	    	if($typeData=='x-www-form-urlencoded'){
		   		$stringSend= http_build_query($data); // Dữ liệu được chuyển dạng x-www-form-urlencoded
		   	}
	   	}

    	// Khởi tạo một phiên cURL
		$curl = curl_init();

		// Cấu hình cURL để thiết lập URL và các tùy chọn khác
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_POSTFIELDS, $stringSend);

		// Thực hiện yêu cầu cURL
		$response = curl_exec($curl);

		// Đóng phiên cURL
		curl_close($curl);

		// Kiểm tra xem có lỗi không
		if ($response === false) {
		    return '';
		} else {
		    return $response;
		}
    }
}

function uploadImage($user_id='', $name_input='', $filenameImage='', $domain='')
{
	global $urlHomes;

	if(empty($domain)) $domain = $urlHomes;

	$return = ['code'=>1, 'mess'=>''];

	if(!empty($user_id) && !empty($name_input)){
		if (!file_exists(__DIR__.'/../upload/admin/images/'.$user_id )) {
	        mkdir(__DIR__.'/../upload/admin/images/'.$user_id, 0755, true);
	    }
	   
	    if(isset($_FILES[$name_input]) && empty($_FILES[$name_input]["error"])){
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES[$name_input]["name"];
            $filetype = $_FILES[$name_input]["type"];
            $filesize = $_FILES[$name_input]["size"];
            
            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)){
            	$return = ['code'=>2, 'mess'=>'File upload không đúng định dạng ảnh'];
            }

            // Verify file size - 15MB maximum
            $maxsize = 1024 * 1024 * 15;
            if($filesize > $maxsize){
            	$return = ['code'=>3, 'mess'=>'File ảnh vượt quá giới hạn cho phép 15Mb'];
            }

            // Verify MYME type of the file
            if(in_array($filetype, $allowed)){
            	if(empty($filenameImage)){
	            	$filenameImage = $user_id.'_'.date('Y_m_d_H_i_s').'_'.rand(0,10000).'.'.$ext;
	            }else{
	            	$filenameImage = createSlugMantan($filenameImage).'.'.$ext;
	            }
                // Check whether file exists before uploading it
                move_uploaded_file($_FILES[$name_input]["tmp_name"], __DIR__.'/../upload/admin/images/'.$user_id.'/'.$filenameImage);

                $return = ['code'=>0, 'mess'=>'Upload thành công', 'linkOnline'=>$domain.'/upload/admin/images/'.$user_id.'/'.$filenameImage, 'linkLocal'=>'upload/admin/images/'.$user_id.'/'.$filenameImage];
                
            } else{
                $return = ['code'=>2, 'mess'=>'File upload không đúng định dạng ảnh'];
            }
        }else{
        	$return = ['code'=>1, 'mess'=>'Ảnh gửi lên bị lỗi'];
        }
	}else{
		$return = ['code'=>1, 'mess'=>'Gửi thiếu dữ liệu'];
	}

	return $return;
}

function uploadImageFTP($userID=0, $name_input='', $ftp_server='', $ftp_username='', $ftp_password='', $domain='')
{ 
	global $urlHomes;

	if(empty($domain)) $domain = $urlHomes;

    if(!empty($userID) && !empty($name_input) && !empty($ftp_server) && !empty($ftp_username) && !empty($ftp_password) ){
	    $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");

	    $login = ftp_login($ftp_conn, $ftp_username, $ftp_password);
	    ftp_pasv($ftp_conn, true);

	    if (!$login) {
	        // die("Could not login");
	        return ['code'=>1, 'mess'=>'Không kết nối được với máy chủ lưu trữ ảnh'];
	    }

	    if(isset($_FILES[$name_input]) && empty($_FILES[$name_input]["error"])){
	        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
	        $filename = $_FILES[$name_input]["name"];
	        $filetype = $_FILES[$name_input]["type"];
	        $filesize = $_FILES[$name_input]["size"];
	        
	        // Verify file extension
	        $ext = pathinfo($filename, PATHINFO_EXTENSION);
	        if(!array_key_exists($ext, $allowed)){
	            return ['code'=>2, 'mess'=>'File upload không đúng định dạng ảnh'];
	        }

	        // Verify file size - 15MB maximum
	        $maxsize = 1024 * 1024 * 15;
	        if($filesize > $maxsize){
	            return ['code'=>3, 'mess'=>'File ảnh vượt quá giới hạn cho phép 15Mb'];
	        }

	        // Verify MYME type of the file
	        if(in_array($filetype, $allowed)){
	            if(empty($filenameImage)){
	                $filenameImage = $userID.'_'.date('Y_m_d_H_i_s').'_'.rand(0,10000).'.'.$ext;
	            }else{
	                $filenameImage = createSlugMantan($filenameImage).'.'.$ext;
	            }

	            // Check whether file exists before uploading it
	            $file = realpath($_FILES[$name_input]["tmp_name"]);

	            $remote_file = "/public_html/upload/admin/images/".$userID."/".$filenameImage;

	            $urlCall = 'ftp://'.$ftp_username.':'.$ftp_password.'@'.$ftp_server.'/'.$remote_file;

	            $ch = curl_init();
				$fp = fopen($file, 'r');
				curl_setopt($ch, CURLOPT_URL, $urlCall);
				curl_setopt($ch, CURLOPT_UPLOAD, 1);
				curl_setopt($ch, CURLOPT_INFILE, $fp);
				curl_setopt($ch, CURLOPT_INFILESIZE, filesize($file));
				curl_exec ($ch);
				$error_no = curl_errno($ch);
				curl_close ($ch);
				if ($error_no == 0) {
				    return ['code'=>0, 'linkOnline'=>$domain.'/upload/admin/images/'.$userID.'/'.$filenameImage, 'linkLocal'=>'upload/admin/images/'.$userID.'/'.$filenameImage];
				} else {
				    return ['code'=>4, 'mess'=>'Upload lỗi', 'error_no'=>$error_no, 'urlCall'=>$urlCall];
				}

	            
	            
	        } else{
	            return ['code'=>2, 'mess'=>'File upload không đúng định dạng ảnh'];
	        }
	    }
	}

    return ['code'=>5, 'mess'=>'Không có dữ liệu upload'];
}

function removeFileFTP($fileToDelete='', $server='', $username='', $password='')
{
	if(!empty($fileToDelete) && !empty($server) && !empty($username) && !empty($password)){
		// Kết nối đến máy chủ FTP
		$ftpConnection = ftp_connect($server);
		if (!$ftpConnection) {
		    //die("Không thể kết nối đến máy chủ FTP");
		}else{
			// Đăng nhập vào FTP
			$login = ftp_login($ftpConnection, $username, $password);
			if (!$login) {
			    //die("Không thể đăng nhập vào FTP");
			}else{
				// Xóa tệp tin
				if (ftp_delete($ftpConnection, $fileToDelete)) {
				    // echo "Đã xóa tệp tin thành công";
				} else {
				    // echo "Không thể xóa tệp tin";
				}
			}
		}
	}
}

function removeFile($url='')
{
	if(!empty($url)){
		unlink(__DIR__.'/../'.$url) ;
	}
}

function sendEmail($to=array(),$cc=array(),$bcc=array(),$subject='',$content='',$typeConfig='default', $attachments=[])
{
	global $contactSite;
	global $smtpSite;

	$type = [
				'image/jpeg'=>'jpg',
				'image/png'=>'png',
				'application/zip'=>'zip',
				'application/pdf'=>'pdf'
		];
	/*
		$attachments = [
							['type'=>'image/jpeg', 'link'=>'/path/to/image.jpg'],
							['type'=>'image/png', 'link'=>'/path/to/image.png'],
							['type'=>'application/zip', 'link'=>'/path/to/file.zip'],
							['type'=>'application/pdf', 'link'=>'/path/to/file.pdf'],
						];
	*/

	if(!empty($to) && !empty($subject)){
		$from = [$contactSite['email'] => $smtpSite['display_name']];

		$listAttachments = [];
		if(!empty($attachments)){
			foreach($attachments as $key=>$item){
				$ext = $type[$item['type']];
				$data_file = sendDataConnectMantan($item['link']);
				$file = __DIR__.'/../upload/'.time().'.'.$ext;
				file_put_contents($file, $data_file);

				$listAttachments['file_'.$key.'.'.$ext] = 	[
													            'file' => $file,
													            'mimetype' => $item['type'],
													            'contentId' => 'image'.$key.'_cid'
													        ];
			}
			
		}
		
		$mailer = new Mailer($typeConfig);
		$mailer->setTransport($typeConfig)
                    ->setFrom($from)
                    ->setTo($to)
                    ->setEmailFormat('html')
                    ->setAttachments($listAttachments)
                    ->setSubject($subject)
                    ->deliver($content);   
		
        if(!empty($listAttachments)){
        	foreach ($listAttachments as $value) {
        		unlink($value['file']);
        	}
        }
	}
}

function getMenusDefault($id=0)
{
	global $modelCategories;
	global $modelMenus;
	global $modelOptions;

	$conditions = array('key_word' => 'menuDefault');
    $menuDefault = $modelOptions->find()->where($conditions)->first();
    $links = [];
    
    if(!empty($menuDefault->value) && empty($id)){
    	$id = $menuDefault->value;
    }

    if(!empty($id)){
    	$conditions = array('key_word' => 'menu', 'id'=>$id);
    	$menu = $modelOptions->find()->where($conditions)->first();

    	if(!empty($menu)){
    		$conditions = array('id_menu' => (int) $id);
	        $listLinks = $modelMenus->find()->where($conditions)->order(['id_parent' => 'ASC', 'weighty'=>'ASC'])->all()->toList();

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

    	}
    }

    return $links;
}

function export_excel($title=[], $data=[], $name_file='')
{
	/*
		$title = [
					['name'=>'Họ tên', 'type'=>'text', 'width'=>15],
					['name'=>'Điện thoại', 'type'=>'number', 'width'=>15],
				];

		$data = [
					['Trần Mạnh', '0816560000'],
					['Trần Minh', '0816560002'],
				];
	*/

	require_once __DIR__ . '/../library/PhpOffice/vendor/autoload.php';

	global $controller;

	if(!empty($title)){
		if(empty($name_file)) $name_file = time();

		$name_colum = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'];
	    
	    // Tạo một đối tượng Spreadsheet
	    $spreadsheet = new Spreadsheet();

	    // Tạo một trang tính mới
	    $sheet = $spreadsheet->getActiveSheet();

	    foreach ($title as $key => $value) {
	    	if(empty($value['name'])) $value['name'] = '';
	    	if(empty($value['type'])) $value['type'] = 'text';
	    	if(empty($value['width'])) $value['width'] = 15;


	    	if($value['type'] == 'number'){
	    		$sheet->getStyle($name_colum[$key])->getNumberFormat()->setFormatCode('#,##0.00');
	    	}else{
	    		$sheet->getStyle($name_colum[$key])->getNumberFormat()->setFormatCode('@');
	    	}

	    	// Đặt tiêu đề cho cột
			$sheet->setCellValue($name_colum[$key].'1', $value['name']);

			// Bôi đậm tiêu đề
			$sheet->getStyle($name_colum[$key].'1')->getFont()->setBold(true);

			// Điều chỉnh độ rộng của cột
			$sheet->getColumnDimension($name_colum[$key])->setWidth($value['width']);
	    }

	    if(!empty($data)){
	    	$sheet->fromArray($data, null, 'A2');
		}

	    // Tạo một đối tượng Writer để ghi dữ liệu vào file Excel
	    $writer = new Xlsx($spreadsheet);

	    // Đặt header cho file Excel
	    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	    header('Content-Disposition: attachment;filename="'.$name_file.'.xlsx"');
	    header('Cache-Control: max-age=0');

	    // Ghi dữ liệu vào file Excel
	    $writer->save('php://output');

	    // Ngăn CakePHP tiếp tục xử lý layout và view
	    $controller->autoRender = false;
	}
}

function readExcelData($filePath='')
{
	global $controller;

	require_once __DIR__ . '/../library/PhpOffice/vendor/autoload.php';

	$data = [];

    if(!empty($filePath) && file_exists($filePath)){
	    // Tạo một đối tượng Spreadsheet từ tệp Excel
	    $spreadsheet = IOFactory::load($filePath);
	    
	    // Chọn trang tính (sheet) đầu tiên
	    $sheet = $spreadsheet->getActiveSheet();
	    
	    // Lấy dữ liệu từ các ô trong sheet
	    $data = [];
	    foreach ($sheet->getRowIterator() as $row) {
	        $rowData = [];
	        foreach ($row->getCellIterator() as $cell) {
	            $rowData[] = $cell->getValue();
	        }
	        $data[] = $rowData;
	    }
	}

	return $data;
}

function uploadAndReadExcelData($nameInput='file')
{
	global $controller;
	global $isRequestPost;

	require_once __DIR__ . '/../library/PhpOffice/vendor/autoload.php';

	$data = [];

    // Kiểm tra xem đã có tệp được tải lên chưa
    if ($isRequestPost && isset($_FILES[$nameInput]) && empty($_FILES[$nameInput]["error"])) {
        // Lấy thông tin về tệp được tải lên
        $uploadedFile = $_FILES[$nameInput];
        
        // Kiểm tra và xử lý lỗi tải lên nếu cần thiết
        
        // Tạo một đối tượng Spreadsheet từ tệp Excel được tải lên
        try {
            $spreadsheet = IOFactory::load($uploadedFile['tmp_name']);
            
            // Chọn trang tính (sheet) đầu tiên
            $sheet = $spreadsheet->getActiveSheet();
            
            // Lấy dữ liệu từ các ô trong sheet
            $data = [];
            foreach ($sheet->getRowIterator() as $row) {
                $rowData = [];
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                $data[] = $rowData;
            }
        } catch (ReaderException $e) {
            // Xử lý lỗi đọc tệp Excel
            echo 'Lỗi đọc tệp Excel: ' . $e->getMessage();
        }
    }

    return $data;
}


function createZipFromBase64Images($base64Images=[], $fileZip='zipImage')
{
	global $controller;
    
    // Tạo tệp ZIP
    $zip = new ZipArchive();
    $zipName = $fileZip.'_'.time().'.zip';
	$filename = './'.$zipName;

	if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
	    exit("cannot open <$filename>\n");
	}
    
    // Lặp qua danh sách mã Base64
    foreach ($base64Images as $index => $base64Image) {
    	$zip->addFromString($index.'.png', base64_decode($base64Image));
    }
    
    // Đóng tệp ZIP
    $zip->close();
    
    // Phản hồi tệp ZIP để người dùng tải xuống
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $zipName);
    header('Content-Length: ' . filesize($filename));
    readfile($filename);
    
    // Xóa tệp ZIP sau khi đã gửi phản hồi
    unlink($filename);
    
    // Dừng xử lý của CakePHP
    $controller->autoRender = false;
	   
}

?>