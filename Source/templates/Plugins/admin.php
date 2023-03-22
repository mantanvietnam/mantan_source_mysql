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

if(file_exists(__DIR__.'/../../plugins/'.$urlFileProcess)){
	include_once(__DIR__.'/../../plugins/'.$urlFileProcess);
}elseif(file_exists(__DIR__.'/../../themes/'.$urlFileProcess)){
	include_once(__DIR__.'/../../themes/'.$urlFileProcess);
}

?>