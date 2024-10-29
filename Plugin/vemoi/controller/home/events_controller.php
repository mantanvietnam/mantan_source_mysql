<?php 
function createevent($input)
{

    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelOptions;
    global $session;
    global $urlHomes;
    $info = $session->read('infoUser');
    $metaTitleMantan = 'Tạo sự kiến';

    $modelevent = $controller->loadModel('events');
    $mess = '';
    if ($isRequestPost) {

        $dataSend = $input['request']->getData();

        $data = $modelevent->newEmptyEntity();

        if(!empty($dataSend['name'])){
            $data->address = @$dataSend['address'];
            $data->name = @$dataSend['name'];

            $data->banner = @$dataSend['banner'];
            $data->time_start = (new DateTime($dataSend['time_start']))->getTimestamp();
            $data->id_member = @$dataSend['id_member'];

            if(isset($_FILES['banner']) && empty($_FILES['banner']["error"])){
                if(!empty($data->id)){
                    $fileName = 'banner_event'.$data->id;
                }else{
                    $fileName = 'banner_event'.time().rand(0,1000000);
                }

                $banner = uploadImage($info->id, 'banner', $fileName);
            }
            if(!empty($banner['linkOnline'])){
                $data->banner = $banner['linkOnline'].'?time='.time();
            }else{
                if(empty($data->banner)){
                    $data->banner = $urlHomes.'/plugins/vemoi/view/home/assets/img/default-thumb.jpg';
                }
            }


            $data->status = @$dataSend['status'];
            $data->outfits = @$dataSend['outfits'];
            $data->plan = @$dataSend['plan'];
            $data->rule = @$dataSend['rule'];
            $data->info = @$dataSend['info'];
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modelevent->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;
            $modelevent->save($data);
            $mess = '<p class="text-success">Tạo sự kiện thành công</p>';
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }
        
    }

    setVariable('mess', $mess);
}
function detailevent($input){
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;
    global $metaImageMantan;
    global $session;

    $metaTitleMantan = 'Chi tiết sự kiện';
    $modelevents = $controller->loadModel('events');
    $order = array('id'=>'desc');
    $listDataevent= $modelevents->find()->where(['show_on_homepage' => 1])->order($order)->all()->toList();
    $modelevents = $controller->loadModel('events');
    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug);
        }


        
        $events = $modelevents->find()->where($conditions)->first();
        setVariable('listDataevent', $listDataevent);
        setVariable('events', $events);

    }else{
        return $controller->redirect('/');
    }
}
?>