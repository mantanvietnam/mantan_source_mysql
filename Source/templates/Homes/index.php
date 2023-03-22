<?php 
global $variableGlobal;
global $checkMantanHeader;
	
foreach($variableGlobal as $variable){
	global $$variable;
}

if(!empty($tmpVariable)){
	foreach($tmpVariable as $key=>$value){
		$$key= $value;
	}
}

include_once(__DIR__.'/../../themes/'.$themeActive.'/index.php');

if(!$checkMantanHeader){
	echo '<script type="text/javascript">alert(\'Hãy chèn hàm mantan_header() vào trước thẻ đóng </head> của bạn\');</script>';
}
?>