<?php 
    $menus= array();
    $menus[0]['title']= 'Static';
    $menus[0]['sub'][0]= array( 'title'=>'Static Setting',
                            'url'=>'/plugins/admin/static-settingStatic.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'settingStatic'
                        );
 addMenuAdminMantan($menus);

    
function getStatic(){
    $today= getdate();
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'Static');
    $data = $modelOptions->find()->where($conditions)->first();
         if(!empty($data->value)){
        $static = json_decode(@$data->value, true);
    }else{
         $data = $modelOptions->newEmptyEntity();
    }
        $static = json_decode(@$data->value, true);
        if(isset($static['oldMon']) && $today['mon']== $static['oldMon'])
        {

          $static['mon'] += 1;

        }
        else
        {

          $static['oldMon']= $today['mon'];

          $static['mon'] = 1;

        }



        if(isset($static['oldMday']) && $today['mday']== $static['oldMday'])

        {

          $static['mday'] += 1;

        }

        else

        {

          $static['oldMday']= $today['mday'];

          $static['mday'] = 1;

        }


        if(isset($static['total'])){
            $static['total'] += 1;
        }else{
            $static['total'] = 1;
        }

        $data->value = json_encode($static);
        $data->key_word = 'Static';
        $modelOptions->save($data);
        
        return $static;
}
    
function showStatic()
{
    $today= getdate();
    global $modelOptions;
    global $infoSite;
    global $urlHomes;
    
    $conditions = array('key_word' => 'Static');
    $data = $modelOptions->find()->where($conditions)->first();
    $static = json_decode($data->value, true);

    $urlPluginStatic= $urlHomes.'/app/Plugin/static/';
    
    if(isset($static['oldMon']) && $today['mon']== $static['oldMon']){
        $static['mon'] += 1;
    }else{
        $static['oldMon']= $today['mon'];
        $static['mon'] = 1;
    }


    if(isset($static['oldMday']) && $today['mday']== $static['oldMday']){
        $static['mday'] += 1;
    }else{
        $static['oldMday']= $today['mday'];
        $static['mday'] = 1;
    }


    if(isset($static['total'])){
        $static['total'] += 1;
    }else{
        $static['total'] = 1;
    }

    $data->value = json_encode($static);
    $data->key_word = 'Static';
    $modelOptions->save($data);

        
    echo '<ul>
              <li>
                
                Đang truy cập : <strong>'.rand(1,$static['mday']).'</strong>
              </li>
          
              <li>
                Hôm nay : <strong>'.number_format($static['mday']).'</strong>
              </li>
        
              <li>
                Tháng hiện tại : <strong>'.number_format($static['mon']).'</strong>
              </li>
        
              <li>
                Tổng lượt truy cập : <strong>'.number_format($static['total']).'</strong>
              </li>

        </ul>';
}

function toStatic(){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'Static');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }
    $data->value = (int)$data->value + 1;

    $data->key_word = 'Static';
        
    $modelOptions->save($data);
    

   return $data->value;
}

 ?>