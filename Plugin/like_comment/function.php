<?php
	$menus= array();
	$menus[0]['title']= 'Like comment';
   $menus[0]['sub'][0]= array('title'=>'Danh sách bình luận','classIcon'=>'fa-link','url'=>'/plugins/admin/like_comment-listCommentAdmin.php','permission'=>'listLinkWeb',);
    // $menus[0]['sub'][1]= array('title'=>'Nhóm liên kết','classIcon'=>'fa-users','url'=>'/plugins/admin/linkWeb-admin-listLinkWebCategoryAdmin.php','permission'=>'groupLinkWeb',);
    
    addMenuAdminMantan($menus); 



    function saveLike($idcustomer,$idobject, $tiype){
    	global $modelOption;
    	global $controller;
    	$modelLike = $controller->loadModel('Likes');

    	 $data->idcustomer = @$idcustomer;
    	 $data->idobject = @$idobject;
    	 $data->tiype = @$tiype;
    	 $data->created = getdate()[0];
            $modelLike->save($data);
    	return $data;
    }
    

    function getLike($idcustomer,$idobject, $tiype){
    	global $modelOption;
    	global $controller;
    	$modelLike = $controller->loadModel('Likes');
    	$conditions= array();
    	$conditions['idcustomer']= $idcustomer;
    	$conditions['idobject']= $idobject;
    	$conditions['tiype']= $tiype;

    	$data =	$modelLike->find()->where($conditions)->first();
    	
    	return $data;
    }

     function getLikeCustomer($idcustomer){
        global $modelOption;
        global $controller;
        $modelLike = $controller->loadModel('Likes');
        $conditions= array();
        $conditions['idcustomer']= $idcustomer;

        $data = $modelLike->find()->where($conditions)->all();
        
        return $data;
    }

    function getComment($idobject, $tiype){
    	global $modelOption;
    	global $controller;
    	$modelComment = $controller->loadModel('Comments');
    	$conditions= array();
    	$conditions['idobject']= $idobject;
    	$conditions['tiype']= $tiype;

    	$data =	$modelComment->find()->where($conditions)->all();

    	
    	return $data;
    }


	
?>