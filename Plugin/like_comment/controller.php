<?php
	/*Link*/
function addlike ($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    global $session;
    $infoUser = $session->read('infoUser');
        $modelLike = $controller->loadModel('Likes');
        $data = $modelLike->newEmptyEntity();
       

        if(!empty($_POST)){
            $data->created = getdate()[0];
            $data->idobject=$_POST['idobject'];
            $data->tiype=$_POST['tiype'];
            $data->idcustomer=$_POST['idcustomer'];

            $modelLike->save($data);
             }
        return $data;
}

function delelelike ($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    global $session;
    $mess ="ok";
    $infoUser = $session->read('infoUser');
        $modelLike = $controller->loadModel('Likes');
        if(!empty($_POST)){
            $conditions['idobject']=$_POST['idobject'];
            $conditions['tiype']=$_POST['tiype'];
            $conditions['idcustomer']=$_POST['idcustomer'];


            $data = $modelLike->find()->where($conditions)->first();

           $modelLike->delete($data);
             }
      return $mess;
        
}

 function addComment ($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    global $session;
    $infoUser = $session->read('infoUser');
        $modelComment = $controller->loadModel('Comments');
        $data = $modelLike->newEmptyEntity();
       

        if(!empty($_POST)){
            $data->created = getdate()[0];
            $data->idobject=$_POST['idobject'];
            $data->tiype=$_POST['tiype'];
            $data->idcustomer=$_POST['idcustomer'];
            $data->comment=$_POST['comment'];

            $modelComment->save($data);
             }
        return $data;
}

?>