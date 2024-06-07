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

	if($urlFilePlugin)
	{
		if($routesType=='Plugin'){
			if(file_exists(__DIR__.'/../../plugins/'.$urlFilePlugin)){
				include(__DIR__.'/../../plugins/'.$urlFilePlugin);
			}
		}elseif($routesType=='Theme'){
			if(file_exists(__DIR__.'/../../themes/'.$urlFilePlugin)){
				include(__DIR__.'/../../themes/'.$urlFilePlugin);
			}
		}

	}
?>