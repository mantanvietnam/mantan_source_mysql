<?php 
global $variableGlobal;
	
foreach($variableGlobal as $variable){
	global $$variable;
}

if(!empty($tmpVariable)){
	foreach($tmpVariable as $key=>$value){
		$$key= $value;
	}
}

include_once(__DIR__.'/../../themes/'.$themeActive.'/category_video.php');
?>