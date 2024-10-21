<?php
function listDataAIAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách AI trợ lý ảo';
    $mess = '';

	$modelMembers = $controller->loadModel('Members');
	$modelDataAis = $controller->loadModel('DataAis');
	
	$conditions = array();
	$limit = 20;


	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['phone'])){
		$member = $modelMembers->find()->where(['phone'=>$_GET['phone']])->first();

		if(!empty($member)){
			$conditions['id_member'] = (int) $member->id;
		}
	}

	if(!empty($_GET['create_ai'])){
		$conditions['create_ai'] = $_GET['create_ai'];
	}

    $listData = $modelDataAis->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $listData[$key]->info_member = $modelMembers->find()->where(['id'=>$value->id_member])->first();
        }
    }

    $totalData = $modelDataAis->find()->where($conditions)->all()->toList();
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
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('mess', $mess);
    
    setVariable('listData', $listData);
}

function exportDataAIAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    if(!empty($_GET['id'])){
        $modelDataAis = $controller->loadModel('DataAis');

        $data = $modelDataAis->find()->where(['id'=>(int) $_GET['id']])->first();

        if($data){
            $data_value = array();
            if(!empty($data->data)){
                $data_value = json_decode($data->data, true);
            }

            if(!empty($data_value['company_name'])){
                $slug = createSlugMantan($data_value['company_name']).'-'.rand(10,99);
            }else{
                $slug = 'data-ai-'.rand(10,99);
            }

            $fileTxt = __DIR__.'/'.$slug.'.txt';

            // chuẩn hóa dữ liệu
            $string =   'Câu chuyện bản thân của chủ hệ thống (giám đốc công ty):'.PHP_EOL.$data_value['personal_story'].PHP_EOL.PHP_EOL.
                        'Thành tựu đạt được của chủ hệ thống (giám đốc công ty):'.PHP_EOL.$data_value['personal_achievements'].PHP_EOL.PHP_EOL.
                        
                        'Tên công ty:'.PHP_EOL.$data_value['company_name'].PHP_EOL.PHP_EOL.
                        'Địa chỉ công ty:'.PHP_EOL.$data_value['company_address'].PHP_EOL.PHP_EOL.
                        'Số điện thoại công ty:'.PHP_EOL.$data_value['company_phone'].PHP_EOL.PHP_EOL.
                        'Mã số thuế công ty:'.PHP_EOL.$data_value['company_tax_code'].PHP_EOL.PHP_EOL.
                        'Tầm nhìn:'.PHP_EOL.$data_value['company_vision'].PHP_EOL.PHP_EOL.
                        'Sứ mệnh:'.PHP_EOL.$data_value['company_mission'].PHP_EOL.PHP_EOL.
                        'Giá trị cốt lõi:'.PHP_EOL.$data_value['company_core_value'].PHP_EOL.PHP_EOL.
                        'Văn hóa doanh nghiệp:'.PHP_EOL.$data_value['company_culture'].PHP_EOL.PHP_EOL.
                        'Nội quy công ty:'.PHP_EOL.$data_value['company_rule'].PHP_EOL.PHP_EOL.
                        
                        'Kịch bản tuyển sỉ:'.PHP_EOL.$data_value['agency_script'].PHP_EOL.PHP_EOL.
                        'Xử lý từ chối tuyển sỉ:'.PHP_EOL.$data_value['agency_reject'].PHP_EOL.PHP_EOL.
                        'Câu chuyện hệ thống:'.PHP_EOL.$data_value['agency_story'].PHP_EOL.PHP_EOL.
                        'Kế hoạch content tuyển sỉ:'.PHP_EOL.$data_value['agency_plan_content'].PHP_EOL.PHP_EOL.

                        'Kịch bản bán hàng:'.PHP_EOL.$data_value['sell_script'].PHP_EOL.PHP_EOL.
                        'Xử lý từ chối bán hàng:'.PHP_EOL.$data_value['sell_reject'].PHP_EOL.PHP_EOL.
                        'Chăm sóc khách hàng:'.PHP_EOL.$data_value['sell_care_customer'].PHP_EOL.PHP_EOL.
                        'Mẫu content đăng bài bán hàng:'.PHP_EOL.$data_value['sell_content'].PHP_EOL.PHP_EOL.

                        'Chiến lược thu hút khách hàng tiềm năng:'.PHP_EOL.$data_value['business_potential_customers'].PHP_EOL.PHP_EOL.
                        'Chiến lược tăng doanh số:'.PHP_EOL.$data_value['business_increase_sales'].PHP_EOL.PHP_EOL.
                        'Chiến lược kéo khách hàng quay lại:'.PHP_EOL.$data_value['business_returning_customers'].PHP_EOL.PHP_EOL.

                        'Quy trình các bước dành cho người mới:'.PHP_EOL.$data_value['newperson_plan'].PHP_EOL.PHP_EOL.
                        'Chiến lược ra đơn trong 10 ngày:'.PHP_EOL.$data_value['newperson_order'].PHP_EOL.PHP_EOL.
                        'Lộ trình học tập, phát triển:'.PHP_EOL.$data_value['newperson_training'].PHP_EOL.PHP_EOL.

                        'Đào tạo bán hàng:'.PHP_EOL.$data_value['training_sell'].PHP_EOL.PHP_EOL.
                        'Đào tạo văn hóa:'.PHP_EOL.$data_value['training_culture'].PHP_EOL.PHP_EOL.
                        'Đào tạo tuyển sỉ:'.PHP_EOL.$data_value['training_agency'].PHP_EOL.PHP_EOL.
                        'Đào tạo thương hiệu cá nhân:'.PHP_EOL.$data_value['training_brand'].PHP_EOL.PHP_EOL.
                        'Đào tạo về mục tiêu và kế hoạch kinh doanh:'.PHP_EOL.$data_value['training_plan'].PHP_EOL.PHP_EOL.
                        'Đào tạo chiến lược kinh doanh:'.PHP_EOL.$data_value['training_business'].PHP_EOL.PHP_EOL.

                        'Quy trình nghiên cứu đối thủ:'.PHP_EOL.$data_value['competitor_research'].PHP_EOL.PHP_EOL.
                        'So sánh với đối thủ:'.PHP_EOL.$data_value['competitor_compare'].PHP_EOL.PHP_EOL.


                        '';

            if(!empty($data_value['product'])){
                foreach ($data_value['product'] as $key => $value) {
                    $string .= 'Sản phẩm '.$value['name'].PHP_EOL;
                    $string .= 'Thành phần: '.$value['component'].PHP_EOL;
                    $string .= 'Công dụng: '.$value['effect'].PHP_EOL;
                    $string .= 'Cách sử dụng: '.$value['how_to_use'].PHP_EOL;
                    $string .= 'Thông tin khác: '.$value['other'].PHP_EOL.PHP_EOL;
                }
            }

            // Tạo file và ghi dữ liệu vào
            file_put_contents($fileTxt, $string);

            // Cấu hình header để tải file
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$slug.'.txt"');
            header('Content-Length: ' . filesize($fileTxt));

            // Đọc file và gửi cho người dùng
            readfile($fileTxt);

            // Xóa file sau khi đã tải
            unlink($fileTxt);

            die;
        }else{
            return $controller->redirect('/plugins/admin/phoenix_ai-view-admin-dataai-listDataAIAdmin');
        }
    }else{
        return $controller->redirect('/plugins/admin/phoenix_ai-view-admin-dataai-listDataAIAdmin');
    }
}

function updateDataAIAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelCategories;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin khách hàng hệ thống';

    $modelDataAis = $controller->loadModel('DataAis');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelDataAis->find()->where(['id'=>(int) $_GET['id']])->first();
    

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['link_ai']) && !empty($dataSend['embed_code_ai']) && !empty($dataSend['id_ai_dify'])){
                
                // tạo dữ liệu save
                $data->link_ai = $dataSend['link_ai'];
                $data->embed_code_ai = $dataSend['embed_code_ai'];
                $data->id_ai_dify = $dataSend['id_ai_dify'];
                $data->create_ai = 'done';

                $modelDataAis->save($data);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
               
            }else{
                $mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
            }
        }

        setVariable('data', $data);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/plugins/admin/phoenix_ai-view-admin-dataai-listDataAIAdmin');
    }
}
?>