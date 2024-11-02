<?php
function aiSearchImageEvent($input)
{
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $mess = '';
   
    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'AI tìm kiếm ảnh sự kiện';

        $modelSearchImageEvents = $controller->loadModel('SearchImageEvents');
        $modelMembers = $controller->loadModel('Members');

        //$member = $modelMembers->get($session->read('infoUser')->id);
        $member = $session->read('infoUser');
        
        $conditions = array('id_member'=>$member->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }

        
        $listData = $modelSearchImageEvents->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

        // phân trang
        $totalData = $modelSearchImageEvents->find()->where($conditions)->all()->toList();
        $totalData = count($totalData);

        $balance = $totalData % $limit;
        $totalPage = ($totalData - $balance) / $limit;
        if ($balance > 0)
            $totalPage+=1;

        $back = $page - 1;
        $next = $page + 1;
        if ($back <= 0)
            $back = 1;
        if ($next >= $totalPage)
            $next = $totalPage;

        if (isset($_GET['page'])) {
            $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
            $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
        } else {
            $urlPage = $urlCurrent;
        }
        if (strpos($urlPage, '?') !== false) {
            if (count($_GET) >= 1) {
                $urlPage = $urlPage . '&page=';
            } else {
                $urlPage = $urlPage . 'page=';
            }
        } else {
            $urlPage = $urlPage . '?page=';
        }


        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('mess', $mess);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);
        setVariable('member', $member);
    }else{
        return $controller->redirect('/login');
    }
}

function addSearchImageEvent($input)
{
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $mess = '';
   
    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'AI tìm kiếm ảnh sự kiện';

        $modelSearchImageEvents = $controller->loadModel('SearchImageEvents');
        $modelMembers = $controller->loadModel('Members');

        if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['name']) && !empty($dataSend['id_drive'])){
                $slug = createSlugMantan($dataSend['name']);

                if(!empty($dataSend['id'])){
                    $data = $modelSearchImageEvents->find()->where(['id'=>(int) $dataSend['id']])->first();
                }

                if(empty($data)){
                    $data = $modelSearchImageEvents->newEmptyEntity();

                    $data->collection_ai = $slug.'-'.time();
                    $data->create_at = time();
                    $data->view = 0;
                }
				
				
				$id_drive = explode('folders/', $dataSend['id_drive']);
				if(count($id_drive)>1){
					$id_drive = $id_drive[1];
				}else{
					$id_drive = $id_drive[0];
				}

				$id_drive = explode('?', $id_drive);

				$data->id_member = $session->read('infoUser')->id;
				$data->id_drive = $id_drive[0];
				$data->name = $dataSend['name'];
				$data->slug = $slug;
				$data->status = 'lock';
				

				$modelSearchImageEvents->save($data);

				// báo AI nạp dữ liệu
				createAISearchImage($data->id_drive, $data->collection_ai);

				return $controller->redirect('/ai-search-image-event/?error=addDone');
			}else{
				return $controller->redirect('/ai-search-image-event/?error=emptyData');
			}
		}else{
			return $controller->redirect('/ai-search-image-event');
		}
    }else{
        return $controller->redirect('/login');
    }
}

function deleteSearchImageEvent($input)
{
    global $controller;
    global $session;

    $modelSearchImageEvents = $controller->loadModel('SearchImageEvents');
    
    if(!empty($session->read('infoUser'))){
        if(!empty($_GET['id'])){
            $data = $modelSearchImageEvents->get($_GET['id']);
            
            if($data){
                deleteAISearchImage($data->collection_ai);

                $modelSearchImageEvents->delete($data);
            }
        }

        return $controller->redirect('/ai-search-image-event');
    }else{
        return $controller->redirect('/login');
    }
}