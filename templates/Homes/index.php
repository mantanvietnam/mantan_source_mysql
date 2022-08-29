<?php 
global $tmpVariable;
global $themeActive;

if(!empty($tmpVariable)){
	foreach($tmpVariable as $key=>$value){
		$$key= $value;
	}
}

include_once(__DIR__.'/../../themes/'.$themeActive.'/index.php');
?>