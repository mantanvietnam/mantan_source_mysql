<?php 
global $tmpVariable;

if(!empty($tmpVariable)){
	foreach($tmpVariable as $key=>$value){
		$$key= $value;
	}
}

if(file_exists(__DIR__.'/../../plugins/'.$urlFileProcess)){
	include_once(__DIR__.'/../../plugins/'.$urlFileProcess);
}

?>