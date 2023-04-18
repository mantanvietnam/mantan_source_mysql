<?php 
/*Danh lam */
function listHistoricalsiteAPI($input){
    
     header('Access-Control-Allow-Methods: *');
     global $controller;
    $modelHistoricalsite = $controller->loadModel('Historicalsites');
    $dataSend = $input['request']->getData();
        
        $conditions = array();
          if(!empty($dataSend['name'])){
             $key=createSlugMantan($dataSend['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }
        $conditions['status']= 1;
        $order= array('created'=>'desc');

        $totalData= $modelHistoricalsite->find()->where($conditions)->all()->toList();

        //debug($totalData);

        $return= array('code'=>1,'listData'=>$totalData);

    //echo json_encode($return);
        return $return;
}

function detailHistoricalsiteAPI($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $modelHistoricalsite = $controller->loadModel('Historicalsites');
    $dataSend =$input['request']->getData();       

    if ( $data=$modelHistoricalsite->get( (int) $dataSend['id'])) {
       

       	$modelArtifact = $controller->loadModel('Artifacts');

        $cond=array();
       
        $cond['status']=1;
        $cond['idHistoricalsite']= $data->id;
        $artifact = $modelArtifact->find()->where($cond)->all();


             $return= array('code'=>1,'data'=>$data,'artifact'=>$artifact);
        }else{
        	  $return= array('code'=>0,'data'=>null,'artifact'=>null);
        }




   // echo json_encode($return);
    return $return;
}

function detailArtifactAPI($input){
    
    header('Access-Control-Allow-Methods: *');
    $return= array('code'=>0);
    global $controller;
    $dataSend =$input['request']->getData();
    $modelArtifact = $controller->loadModel('Artifacts');

    if($data=$modelArtifact->get( (int) $dataSend['id'])) {

             $return= array('code'=>1,'data'=>$data);
        }else{
        	  $return= array('code'=>0,'data'=>null);
        }

   // echo json_encode($return);
    return $return;
}
 ?>