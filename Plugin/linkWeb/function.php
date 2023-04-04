<?php
	$menus= array();
	$menus[0]['title']= 'Link web';
    $menus[0]['sub'][0]= array('title'=>'Liên kết web','classIcon'=>'fa-link','url'=>'/plugins/admin/linkWeb-admin-listLinkWebAdmin.php','permission'=>'listLinkWeb',);
    $menus[0]['sub'][1]= array('title'=>'Nhóm liên kết','classIcon'=>'fa-users','url'=>'/plugins/admin/linkWeb-admin-listLinkWebCategoryAdmin.php','permission'=>'groupLinkWeb',);
    
    addMenuAdminMantan($menus); 



    function getLinkWebCategory()
    {
    	global $modelOption;
    	global $controller;
    	$modelLinkWebCategory = $controller->loadModel('Linkwebcategorys');
    	$LinkWebCategory= $modelLinkWebCategory->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();

    	return $LinkWebCategory;
    }
    
	function showListLink()
	{
		global $modelOption;
		global $controller;
		$modelListLink = $controller->loadModel('linkwebs');
		$dem= 0;
		$demRow= 0;
		$class= '';

		$listData= $modelListLink->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();
		
		foreach($listData as $components)
		{
			if($components['image'])
			{
				$dem++;
				if($dem%4==1)
				{
					$demRow++;
					if($demRow==1) $class= 'active';
					else $class= '';
					echo '<div class="item '.$class.'">';
				} 
				echo '  <div class="col-sm-3">
							<figure>
								<a target="_blank" href="'.$components['link'].'">
									<img src="'.$components['image'].'" alt="'.$components['name'].'">
									<figcaption>
										<h4>'.$components['name'].'</h4>
									</figcaption>
								</a>							
							</figure>	
						</div>';
				if($dem%4==0) echo '</div> <!-- /.active /.item -->';
			}
			
		}
		if($dem%4!=0) echo '</div> <!-- /.active /.item -->';
	}
	
	function getListLinkWeb($idCategory='')
	{
		global $modelOption;
		global $controller;
		$modelListLink = $controller->loadModel('linkwebs');
	
		$conditions = array();
		$conditions['idCategory'] =$idCategory;

		$list= $modelListLink->find()->limit(200)->page(1)->where($conditions)->order(array())->all()->toList();
		
		
		

		return $list;
	}
?>