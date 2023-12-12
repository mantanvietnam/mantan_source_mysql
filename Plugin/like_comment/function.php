<?php
	$menus= array();
	$menus[0]['title']= 'Like comment';
   $menus[0]['sub'][0]= array('title'=>'Danh sách bình luận','classIcon'=>'bx bx-list-ul','url'=>'/plugins/admin/like_comment-admin-listCommentAdmin.php','permission'=>'listCommentAdmin',);
    // $menus[0]['sub'][1]= array('title'=>'Nhóm liên kết','classIcon'=>'fa-users','url'=>'/plugins/admin/linkWeb-admin-listLinkWebCategoryAdmin.php','permission'=>'groupLinkWeb',);
    
    addMenuAdminMantan($menus); 



    function saveLike($idcustomer,$idobject, $type){
    	global $modelOption;
    	global $controller;
    	$modelLike = $controller->loadModel('Likes');

    	 $data->idcustomer = @$idcustomer;
    	 $data->idobject = @$idobject;
    	 $data->type = @$type;
    	 $data->created = getdate()[0];
            $modelLike->save($data);
    	return $data;
    }
    

    function getLike($idcustomer='',$idobject='', $type=''){
    	global $modelOption;
    	global $controller;
    	$modelLike = $controller->loadModel('Likes');
    	$conditions= array();
    	$conditions['idcustomer']= $idcustomer;
    	$conditions['idobject']= $idobject;
    	$conditions['type']= $type;

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

    function getComment($idobject, $type){
    	global $modelOption;
    	global $controller;
    	$modelComment = $controller->loadModel('Comments');
    	$conditions= array();
    	$conditions['idobject']= $idobject;
    	$conditions['type']= $type;
      $order = array('id'=>'desc');

    	$data =	$modelComment->find()->limit(10)->page(1)->where($conditions)->order($order)->all()->toList();

    	
    	return $data;
    }


	
?>