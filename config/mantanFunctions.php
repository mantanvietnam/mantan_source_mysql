<?php 
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
global $tmpVariable;
global $themeActive;
global $isRequestPost;

global $modelCategories;
global $modelOptions;

global $urlCurrent;
global $urlThemeActive;

global $metaTitleMantan;
global $metaKeywordsMantan;
global $metaDescriptionMantan;

global $routesPlugin;
global $routesTheme;

global $session;


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

function getFileTheme($file)
{	
	global $themeActive;
	global $tmpVariable;

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
	echo '<textarea class="form-control" id="'.$idEditor.'" name="'.$nameEditor.'" style="height: 500px;">'.$content.'</textarea>

		<script type="text/javascript">
		  bkLib.onDomLoaded(function() {
		    new nicEditor({maxHeight : 500}).panelInstance("'.$idEditor.'");
		  });
		</script>
	';
}

?>