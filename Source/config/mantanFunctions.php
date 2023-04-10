<?php 
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;

/**********************************************************
 *  Các file đã sửa
 *  1. /src/Controller/AppController.php sửa trong hàm initialize
 *  2. /config/bootstrap.php include file mantanFunctions.php
 *  3. /.htacess bổ sung thêm RewriteCond
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
global $modelOptions;
global $modelPosts;
global $modelMenus;

global $urlCurrent;
global $urlThemeActive;

global $metaTitleMantan;
global $metaKeywordsMantan;
global $metaDescriptionMantan;

global $routesPlugin;
global $routesTheme;

global $session;

global $infoSite;
global $contactSite;
global $smtpSite;

$variableGlobal= array('hookMenuAdminMantan', 'hookMenusAppearanceMantan', 'tmpVariable', 'themeActive', 'isRequestPost', 'modelCategories', 'modelOptions', 'urlCurrent', 'urlThemeActive', 'metaTitleMantan', 'metaKeywordsMantan', 'metaDescriptionMantan', 'routesPlugin', 'routesTheme', 'session', 'infoSite', 'contactSite', 'smtpSite', 'csrfToken', 'modelPosts','modelMenus');


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
					$this->removeDirectory("$dir/$item");
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
				CKEDITOR.replace( "'.$idEditor.'"); 
			</script>
			';
}

function showUploadFile($idInput='',$nameInput='',$value='',$number='')
{ 
	echo '	<script type="text/javascript">
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

			<div class="row">
				<div class="col-8 col-xs-8 col-sm-8">
					<input class="form-control" type="text" name="'.$nameInput.'" id="'.$idInput.'" value="'.$value.'" />
				</div>
				<div class="col-2 col-xs-2 col-sm-2">
					<input type="button" class="btn btn-secondary" value="Upload" onclick="BrowseServerImage'.$number.'();" />
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

	$checkMantanHeader= true;
	$infoMantanSource['verName']= 'v2.0';
	
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
		  	<meta itemprop="image" content="'.@$infoSite['image_share'].'">
		    
		    <!-- Facebook Meta Tags -->
			<meta property="og:title" content="'.$metaTitleMantan.'"/>
			<meta property="og:type" content="website"/>
			<meta property="og:description" content="'.$metaDescriptionMantan.'"/>
			<meta property="og:url" content="https://manmo.vn/"/>
			<meta property="og:site_name" content="'.$metaTitleMantan.'"/>
			<meta property="og:image" content="'.@$infoSite['image_share'].'" />
			<meta property="og:image:alt" content="Hình ảnh '.$metaTitleMantan.'" />
			<meta property="fb:admins" content="" />
			<meta property="fb:app_id" content="1695746487308818" /> 
			<meta property="og:image:width" content="900" />
			<meta property="og:image:height" content="603" />

		    <!-- Twitter Meta Tags -->
		    <meta name="twitter:card" content="summary_large_image">
		    <meta name="twitter:title" content="'.$metaTitleMantan.'">
		    <meta name="twitter:description" content="'.$metaDescriptionMantan.'">
		    <meta name="twitter:image" content="'.@$infoSite['image_share'].'">
				
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
        
    if($data){
   		$stringSend= '';
   		if($typeData=='form'){
   			$stringSend= array();
	   		foreach($data as $key=>$value){
	   			$stringSend[]= $key.'='.$value;
	   		}
	   		

	   		$stringSend= implode('&', $stringSend);
	   	}elseif($typeData=='raw'){
	   		$stringSend= json_encode($data);
	   	}
   		
		$ch = curl_init();

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

		$server_output = curl_exec ($ch);

		curl_close ($ch);

		return $server_output;
    }else{
    	$opts = array(
			'http'=>array(
			    'method'=>"GET",
			    'header'=>""
			)
		);

		if(!empty($header)){
			$opts['http']['header'].= implode('&', $header);
		}

		$context = stream_context_create($opts);
	   	return file_get_contents($url, false, $context);
    }
}

function uploadImage($user_id='', $name_input='', $filenameImage='')
{
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

            // Verify file size - 5MB maximum
            $maxsize = 1024 * 1024 * 5;
            if($filesize > $maxsize){
            	$return = ['code'=>3, 'mess'=>'File ảnh vượt quá giới hạn cho phép 5Mb'];
            }

            // Verify MYME type of the file
            if(in_array($filetype, $allowed)){
            	if(empty($$filenameImage)){
	            	$filenameImage = $user_id.'_'.date('Y_m_d_H_i_s').'_'.rand(0,10000).'.'.$ext;
	            }else{
	            	$filenameImage = createSlugMantan($filenameImage).'.'.$ext;
	            }
                // Check whether file exists before uploading it
                move_uploaded_file($_FILES[$name_input]["tmp_name"], __DIR__.'/../upload/admin/images/'.$user_id.'/'.$filenameImage);

                $return = ['code'=>0, 'mess'=>'Upload thành công', 'linkOnline'=>'https://apis.ezpics.vn/upload/admin/images/'.$user_id.'/'.$filenameImage, 'linkLocal'=>'upload/admin/images/'.$user_id.'/'.$filenameImage];
                
            } else{
                $return = ['code'=>2, 'mess'=>'File upload không đúng định dạng ảnh'];
            }
        }
	}

	return $return;
}

function removeFile($url='')
{
	if(!empty($url)){
		unlink(__DIR__.'/../'.$url) ;
	}
}

function sendEmail($to=array(),$cc=array(),$bcc=array(),$subject='',$content='',$typeConfig='default')
{
	global $contactSite;
	global $smtpSite;

	if(!empty($to) && !empty($subject)){
		$from = [$contactSite['email'] => $smtpSite['display_name']];
		
		$mailer = new Mailer($typeConfig);
		$mailer->setTransport($typeConfig)
                    ->setFrom($from)
                    ->setTo($to)
                    ->setEmailFormat('html')
                    ->setSubject($subject)
                    ->deliver($content);   
		    
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

?>