<?php 

global $urlDomainFindFace;

$urlDomainFindFace = 'http://14.225.17.218:8705/';

function getTokenFindFace($username, $password)
{
    global $urlDomainFindFace;
    global $modelOptions;

    if(!empty($username) && !empty($password)){
        $conditions = array('key_word' => 'tokenFindFace');
        $tokenFindFace = $modelOptions->find()->where($conditions)->first();

        if(!empty($tokenFindFace->value)){
            $value = json_decode($tokenFindFace->value, true);

            if(!empty($value['deadline']) && $value['deadline'] > time()){
                return $value['token'];
            }
        }

        
        // lấy token mới
        if(empty($tokenFindFace)){
            $tokenFindFace = $modelOptions->newEmptyEntity();
        }

        $url = $urlDomainFindFace.'api/v1/authenticate';
        $header = ['Content-Type: application/json'];

        $data = ['username'=>$username, 'password'=>$password];

        $token = sendDataConnectMantan($url, $data, $header, 'raw');

        $token = json_decode($token, true);

        if(!empty($token['access_token'])){
            $tokenFindFace->key_word = 'tokenFindFace';
            $tokenFindFace->value = json_encode(['token'=>$token['access_token'], 'deadline'=>time()+518400]);

            $modelOptions->save($tokenFindFace);

            return $token['access_token'];
        }
    
    }

    return '';
}

function searchFaceImage($collection_name='')
{
    global $urlDomainFindFace;

    $listImage = [];

    if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
        $user_id = 'guest';
        $name_input = 'image';
        $filenameImage = rand(10000,99999);

        $image = uploadImage($user_id, $name_input, $filenameImage);
      
        if(!empty($image['linkLocal'])){
            $linkLocal = __DIR__.'/../../'.$image['linkLocal'];

            $token = getTokenFindFace('manhtran', '123456aA@');

            if(!empty($token)){
                $url = $urlDomainFindFace.'api/v2/find-faces/?collection_name='.$collection_name;
                
                $header = ['Authorization: Bearer '.$token];

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => $url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => array('image'=> new CURLFILE($linkLocal)),
                  CURLOPT_HTTPHEADER => $header,
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $response = json_decode($response, true);

                if(!empty($response['found_faces'])){
                    $listImage = ['code'=>1, 'listImage'=>$response['found_faces'], 'linkLocal'=>$linkLocal];
                }else{
                    $listImage = ['code'=>4, 'mess'=>'Không tìm thấy ảnh'];
                }

                unlink($linkLocal);
            }else{
                $listImage = ['code'=>3, 'mess'=>'Lỗi token'];
            }
        }else{
            $listImage = ['code'=>2, 'mess'=>'Lỗi upload'];
        }
    }else{
        $listImage = ['code'=>1, 'mess'=>'chưa gửi ảnh'];
    }

    return $listImage;
}

?>