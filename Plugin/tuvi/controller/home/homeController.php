<?php
function register_form($input)
{
    global $controller;
    global $metaTitleMantan;
    $metaTitleMantan = 'Đăng ký tài khoản';
    $modelCustomer = $controller->loadModel('Customer');    
    $conditions= array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
//đây là database CREATE TABLE customers (
 //   id INT AUTO_INCREMENT PRIMARY KEY,
// full_name VARCHAR(255) NOT NULL,
//    birth_date DATE NOT NULL,
 //   birth_time TIME NOT NULL,
 //   timezone VARCHAR(10) NOT NULL DEFAULT 'GMT+7',
 //   gender ENUM('Nam', 'Nữ') NOT NULL,
 //   view_year INT NOT NULL,
 //   view_month INT NOT NULL,
 //   calendar_type ENUM('Dương', 'Âm') NOT NULL DEFAULT 'Dương',
 //   email VARCHAR(255) UNIQUE NOT NULL,
 //   phone_number VARCHAR(15) UNIQUE NOT NULL,
 //   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] = $_GET['id'];
    }
    if (!empty($_GET['full_name'])) {
        $conditions['full_name LIKE'] = '%' . $_GET['full_name'] . '%';
    }

    if (!empty($_GET['phone_number'])) {
        $conditions['phone_number LIKE'] = '%' . $_GET['phone_number'] . '%';
    }

    if (!empty($_GET['email'])) {
        $conditions['email LIKE'] = '%' . $_GET['email'] . '%';
    }
 if (!empty($_GET['birth_date'])) {
        $conditions['birth_date LIKE'] = '%' . $_GET['birth_date'] . '%';
    }

    if (!empty($_GET['birth_time'])) {
        $conditions['birth_time LIKE'] = '%' . $_GET['birth_time'] . '%';
    }
    if (!empty($_GET['timezone'])) {
        $conditions['timezone LIKE'] = '%' . $_GET['timezone'] . '%';
    }

    if(!empty($_GET['excel']) && $_GET['excel']=='Excel'){
        $listData = $modelCustomer->find()->where($conditions)->order(['id' => 'desc'])->all()->toList();
        $titleExcel =   [
            ['name'=>'ID', 'type'=>'text', 'width'=>10],
            ['name'=>'Thời gian tạo', 'type'=>'text', 'width'=>25],
            ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
            ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
            ['name'=>'Email', 'type'=>'text', 'width'=>25],  
            ['name'=>'Ngày sinh', 'type'=>'text', 'width'=>25],  
            ['name'=>'Giờ sinh', 'type'=>'text', 'width'=>25],  
            ['name'=>'Múi giờ', 'type'=>'text', 'width'=>25],  
            ['name'=>'Giới tính', 'type'=>'text', 'width'=>25],  
            ['name'=>'Năm sinh', 'type'=>'text', 'width'=>25],  
            ['name'=>'Tháng sinh', 'type'=>'text', 'width'=>25],  
            ['name'=>'Loại lịch', 'type'=>'text', 'width'=>25],  
        ];
        $dataExcel = [];
        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $dataExcel[] = [
                    @$value->id,
                    date('H:i d-m-Y', $value->created_at), 
                    @$value->full_name,
                    @$value->phone_number,
                    @$value->email,
                    @$value->birth_date,
                    @$value->birth_time,
                    @$value->timezone, ];

    


          } 
        } export_excel($titleExcel, $dataExcel, 'Danh_sach_khach_hang');}
        $listData = $modelCustomer->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();
        $totalCustomer= $modelCustomer->find()->where($conditions)->all()->toList();
        $pagination = createPaginationMetaData(count($totalCustomer), $limit, $page);

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $listData[$key]->created_at = date('H:i d-m-Y', $value->created_at);
            }
        }
    }