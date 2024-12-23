<?php 
$menus= array();
$menus[0]['title']= 'Ngày hội xanh';
$menus[0]['sub'][0]= array(	'title'=>'Địa điểm',
							'url'=>'/plugins/admin/ngayhoixanh-view-admin-location-listLocationAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listLocationAdmin'
						);

addMenuAdminMantan($menus);

function getVietnamProvinces() {
    return [
        1 => "An Giang", 2 => "Bà Rịa - Vũng Tàu", 3 => "Bạc Liêu", 4 => "Bắc Kạn", 5 => "Bắc Giang",
        6 => "Bắc Ninh", 7 => "Bến Tre", 8 => "Bình Dương", 9 => "Bình Định", 10 => "Bình Phước",
        11 => "Bình Thuận", 12 => "Cà Mau", 13 => "Cao Bằng", 14 => "Cần Thơ", 15 => "Đà Nẵng",
        16 => "Đắk Lắk", 17 => "Đắk Nông", 18 => "Điện Biên", 19 => "Đồng Nai", 20 => "Đồng Tháp",
        21 => "Gia Lai", 22 => "Hà Giang", 23 => "Hà Nam", 24 => "Hà Nội", 25 => "Hà Tĩnh",
        26 => "Hải Dương", 27 => "Hải Phòng", 28 => "Hậu Giang", 29 => "Hòa Bình", 30 => "Hưng Yên",
        31 => "Khánh Hòa", 32 => "Kiên Giang", 33 => "Kon Tum", 34 => "Lai Châu", 35 => "Lâm Đồng",
        36 => "Lạng Sơn", 37 => "Lào Cai", 38 => "Long An", 39 => "Nam Định", 40 => "Nghệ An",
        41 => "Ninh Bình", 42 => "Ninh Thuận", 43 => "Phú Thọ", 44 => "Phú Yên", 45 => "Quảng Bình",
        46 => "Quảng Nam", 47 => "Quảng Ngãi", 48 => "Quảng Ninh", 49 => "Quảng Trị", 50 => "Sóc Trăng",
        51 => "Sơn La", 52 => "Tây Ninh", 53 => "Thái Bình", 54 => "Thái Nguyên", 55 => "Thanh Hóa",
        56 => "Thừa Thiên Huế", 57 => "Tiền Giang", 58 => "TP Hồ Chí Minh", 59 => "Trà Vinh", 
        60 => "Tuyên Quang", 61 => "Vĩnh Long", 62 => "Vĩnh Phúc", 63 => "Yên Bái"
    ];
}