<?php 

global $urlDomainFindFace;
global $userFindFace;
global $passFindFace;

//$urlDomainFindFace = 'http://14.225.17.218:8705/';
$urlDomainFindFace = 'https://timanh.phoenixtech.vn/';
$userFindFace = 'manhtran';
$passFindFace = '123456aA@';

function getTokenFindFace()
{
    global $urlDomainFindFace;
    global $modelOptions;
    global $userFindFace;
    global $passFindFace;

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

    $data = ['username'=>$userFindFace, 'password'=>$passFindFace];

    $token = sendDataConnectMantan($url, $data, $header, 'raw');

    $token = json_decode($token, true);

    if(!empty($token['access_token'])){
        $tokenFindFace->key_word = 'tokenFindFace';
        $tokenFindFace->value = json_encode(['token'=>$token['access_token'], 'deadline'=>time()+518400]);

        $modelOptions->save($tokenFindFace);

        return $token['access_token'];
    }
    
    

    return '';
}

function searchFaceImage($collection_name='', $limit = 100)
{
    global $urlDomainFindFace;

    $listImage = [];

    if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
        $user_id = 'guest';
        $name_input = 'image';
        $filenameImage = time().'-'.rand(10000,99999);

        $image = uploadImage($user_id, $name_input, $filenameImage);
      
        if(!empty($image['linkLocal'])){
            $linkLocal = __DIR__.'/../../'.$image['linkLocal'];

            $token = getTokenFindFace();

            if(!empty($token)){
                $url = $urlDomainFindFace.'api/v2/find-faces/?collection_name='.$collection_name.'&limit='.$limit;
                
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

function createAISearchImage($id_drive='', $collection_name='')
{
    global $urlDomainFindFace;
    
    if(!empty($id_drive) && !empty($collection_name)){
        $listFileDrive = getListFileDrive($id_drive);
        $listDownFile = [];

        if(!empty($listFileDrive)){
            foreach ($listFileDrive as $key => $value) {
                if(!empty($value['thumbnailLink'])){
                    $listDownFile[$value['originalFilename']] = $value['webContentLink'];
                }
            }
            
            if(!empty($listDownFile)){
                $token = getTokenFindFace();

                if(!empty($token)){
                    $filePath = __DIR__.'/../../upload/admin/files/'.$collection_name.'.json';

                    file_put_contents($filePath, json_encode($listDownFile));

                    $url = $urlDomainFindFace.'api/v1/upload-dataset/?bucket_name='.$collection_name.'&name_event='.$collection_name.'&collection_name='.$collection_name;

                    $header = ['Authorization: Bearer '.$token];

                    // chuyển yêu cầu tạo AI sang rabbitmq
                    $rabbitMQClient = new RabbitMQClient();

                    $requestMessage = json_encode([ 'url' => $url, 
                                                    'header' => $header,
                                                    'filePath' => $filePath,
                                                    'collection_name' => $collection_name
                                                ]);
                    
                    $rabbitMQClient->sendMessage('create_ai_search_image', $requestMessage);

                    return ['code'=>0, 'mess'=>'Tạo yêu cầu thành công'];
                }else{
                    return ['code'=>3, 'mess'=>'Lỗi token'];
                }
                
            }
        }else{
            return ['code'=>2, 'mess'=>'Drive không có ảnh hoặc chưa để chế độ công khai'];
        }
    }else{
        return ['code'=>1, 'mess'=>'Gửi thiếu dữ liệu'];
    }
}

function deleteAISearchImage($collection_name='')
{
    global $urlDomainFindFace;

    if(!empty($collection_name)){
        $token = getTokenFindFace();

        if(!empty($token)){
            $url = $urlDomainFindFace.'api/v1/delete-collection-and-bucket/?collection_name='.$collection_name.'&bucket_name='.$collection_name;
            
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
              CURLOPT_CUSTOMREQUEST => 'DELETE',
              CURLOPT_HTTPHEADER => $header,
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            
            return $response;
        }

    }
}

function createFileZipImage($imageUrls=[], $fileNameZip='image')
{
    if(!empty($imageUrls)){
        // Đường dẫn file ZIP được tạo
        $zipFilePath = __DIR__.'/../../upload/admin/files/'.$fileNameZip.'.zip';

        // Tạo file ZIP
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($imageUrls as $fileName => $imageUrl) {
                // Tải nội dung ảnh
                $imageContent = file_get_contents($imageUrl);
                
                if ($imageContent !== false) {
                    // Thêm ảnh vào ZIP
                    $zip->addFromString($fileName, $imageContent);
                } else {
                    return ['code'=>1, 'mess'=>'Không thể tải ảnh từ '.$imageUrl]; 
                }
            }
            $zip->close();

            return ['code'=>0, 'mess'=>'Tạo file ZIP thành công', 'zipFilePath'=>$zipFilePath];
        } else {
            return ['code'=>1, 'mess'=>'Không thể tạo file ZIP']; 
        }
    }
}

?>