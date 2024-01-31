<?php 
$menus= array();
$menus[0]['title']= 'Sản phẩm';
$menus[0]['sub'][0]= array(	'title'=>'Sản phẩm',
							'url'=>'/plugins/admin/product-view-admin-product-listProduct',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listProduct'
						);

$menus[0]['sub'][1]= array(	'title'=>'Đơn hàng',
							'url'=>'/plugins/admin/product-view-admin-order-listOrderAdmin',
							'classIcon'=>'bx bx-cart-add',
							'permission'=>'listOrderAdmin'
						);

$menus[0]['sub'][10]= array('title'=>'Cài đặt',
							'url'=>'/',
							'classIcon'=>'bx bx-cog',
							'permission'=>'settingsProducts',
							'sub'=> array(  array('title'=>'Danh mục sản phẩm',
												'url'=>'/plugins/admin/product-view-admin-category-listCategoryProduct',
												'classIcon'=>'bx bx-category',
												'permission'=>'listCategoryProduct',
											),
                      array('title'=>'Nhà sản xuất',
                          'url'=>'/plugins/admin/product-view-admin-manufacturer-listManufacturerProduct',
                          'classIcon'=>'bx bx-category',
                          'permission'=>'listManufacturerProduct',
                      ),
                     /* array('title'=>'Gửi thông báo',
                          'url'=>'/plugins/admin/product-view-admin-smaxbot-settingSmaxbotAdmin',
                          'classIcon'=>'bx bx-category',
                          'permission'=>'settingSmaxbotAdmin',
                      ),*/
                      array('title'=>'Mã giảm giá ',
                          'url'=>'/plugins/admin/product-view-admin-discountCode-listDiscountCodeAdmin',
                          'classIcon'=>'bx bx-category',
                          'permission'=>'listDiscountCodeAdmin',
                      ),
									)
						);
$menus[0]['sub'][11]= array( 'title'=>'Review sản phẩm',
              'url'=>'/plugins/admin/product-view-admin-product-listReview',
              'classIcon'=>'bx bx-cart-add',
              'permission'=>'listReview'
            );


addMenuAdminMantan($menus);

global $modelCategories;

$conditions = array('type' => 'category_product');
$productCategory = $modelCategories->find()->where($conditions)->all()->toList();

if(isset($productCategory)){
	$category[0]['title'] = 'Danh mục sản phẩm';
	$category[0]['sub'] = [];

    foreach ($productCategory as $key => $value) {
    	$category[0]['sub'][] = [	'url' => '/category/'.$value->slug.'.html',
                                  	'name' => $value->name
                              	];
    }
}

$category[1]['title'] = 'Sản phẩm';
$category[1]['sub'] = array(array (	'url' => '/products',
                                    'name' => 'Tất cả sản phẩm'
                                    ),
                                    
                            array (
                              'url' => '/cart',
                              'name' => 'Giỏ hàng'
                            ),
                            
                            array (
                              'url' => '/search',
                              'name' => 'Tìm kiếm sản phẩm'
                            ),
                        );


addMenusAppearance($category);


function categoryDiscountCode(){
      return array(
          1=>'voucher freeship',
          2=>'BUMAS hi',
          3=>'Foryou',
      );
}

function getContentEmailOrderSuccess($fullName='',$email='',$phone='',$address='',$note='',$listTypeMoney=array(),$discountCode=array(), $order=array()){

  if(!empty($email)){
    $to[]= trim($email);

    $cc = array();
    $bcc = array();
    $subject = '[BUMAS] Bạn đặt hàng trên web BUMAS thành công ';

    $content='<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông tin đơn hàng </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .bao{background: #fafafa;margin: 40px;padding: 20px 20px 40px;}
    .logo{

    }
    .logo img{height: 115px;margin:  0 auto;display:  block;margin-bottom: 15px;}
    .nd{background: white;margin: 0 auto;border-radius: 12px;overflow:  hidden;border: 2px solid #e6e2e2;line-height: 2;}
    .head{background: #3fb901; color:white;text-align: center;padding: 15px 10px;font-size: 17px;text-transform: uppercase;}
    .main{padding: 10px 20px;}
    .thong_tin{padding: 0 20px 20px;}
    .line{position: relative;height: 2px;}
    .line1{position: absolute;top: 0;left: 0;width: 100%;height: 100%;background-image: linear-gradient(to right, transparent 50%, #737373 50%);background-size: 26px 100%;}
    .cty{text-align:  center;margin: 20px 0 30px;}
    .main .fa{color:green;}
    table{margin:auto;}
    @media screen and (max-width: 768px){
      .bao{margin:0;}
    }
    @media screen and (max-width: 767px){
      .bao{padding:6px; }
      .nd{text-align: inherit;}
    }
    .table thead th , .table-bordered th , td{
      vertical-align: bottom;
      border: 1px solid #dee2e6;
    }
    </style>
    </head>
    <body>
    <div class="bao">
    <div class="nd">
    <div class="main" style=" font-size: 16px;">
    <h2 style=" text-align: center; font-size: 27px; ">Thông tin đơn hàng </h2>
    <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
    <p>
    Email: '.$email.'<br/>
    Điện thoại: '.$phone.'<br/>
    Địa chỉ: '.$address.'<br/>
    Chú ý: '.nl2br($note).'<br/><br/> <p>

    <h4 class="text-align"> Chi tiết đơn hàng </h4>
    <table class="table table-bordered" style=" width: 85%;">
    <thead>
    <tr>
    <th scope="col">Ảnh </th>
    <th scope="col">Tên sản phẩm</th>
    <th scope="col">Đơn giá </th>
    <th scope="col">Số lượng</th>
    <th scope="col">Thành tiền</th>
    </tr>
    </thead>
    <tbody>';
    if(!empty($listTypeMoney)){
      foreach($listTypeMoney as $key => $item){

        $content .= '<tr>
        <td scope="row"> <img src="'.$item->image.'" width="100" alt=""></td>
        <td>'.$item->title.'<br/>';
        if(!empty($item->present)){
          $content .='Quà tặng<br/>';
          foreach($item->present as $k => $value){
            $content .= $value->title.'
            <img src="'.$value->image.'" width="80" alt=""><br/>';
          }
        }
        $content .='</td>
        <td>'.number_format($item->price).'đ</td>
        <td>'.number_format($item->numberOrder).'</td>
        <td>'.number_format($item->price*$item->numberOrder).'</td>
        </tr>';
      } 
    }
    $content .=  '<tr>  <td colspan="10">
    Tổng tiền: '.number_format($order->money).'đ<br/>
    Giá vận chuyển : 30.000đ<br/>';
    if(!empty($discountCode['code1']) && !empty($discountCode['discount_price1'])){
      $content .=  '            <div class="cart-price-code-discount">
      <div class="cart-price-item">
      <div class="cart-price-item-title"> '. $discountCode['code1'] .': -'.number_format($discountCode['discount_price1']).'đ
      </div>
      </div>
      </div>';
    }  
    if(!empty($discountCode['code2']) && !empty($discountCode['discount_price2'])){
      $content .=  '            <div class="cart-price-code-discount">
      <div class="cart-price-item">
      <div class="cart-price-item-title"> '. $discountCode['code2'] .': -'.number_format($discountCode['discount_price2']).'đ
      </div>
      </div>
      </div>';
    }  
    if(!empty($discountCode['code3']) && !empty($discountCode['discount_price3'])){
      $content .=  '              <div class="cart-price-code-discount">
      <div class="cart-price-item">
      <div class="cart-price-item-title"> '. $discountCode['code3'] .': -'.number_format($discountCode['discount_price3']).'đ
      </div>
      </div>';  
    }
     if(!empty($discountCode['code4']) && !empty($discountCode['discount_price4'])){
      $content .=  '              <div class="cart-price-code-discount">
      <div class="cart-price-item">
      <div class="cart-price-item-title"> '. $discountCode['code4'] .': -'.number_format($discountCode['discount_price4']).'đ
      </div>
      </div>';  
    }
    $content .=  ' Thành tiền: '.number_format($order->total).'đ<br/>
    </td></tr>
    </tbody>
    </table>
    <br>
    Trân trọng ./
    <div style="white: 50%">
    <br/><img src="https://bumas.2top.vn/themes/shopbanhang/asset/image/logophong.png" alt="" jslog="138226; u014N:xr6bB; 53:WzAsMF0."> <br/>
    <strong>© 2023 Công Ty TNHH BUMAS</strong> <br/>
    <a href="https://bumas.vn">https://bumas.vn/</a> <br/>
    Địa chỉ: Tòa nhà Diamond Complex, Ô 20-21 Lô A, Khu Đô thị mới Đại Kim, Hoàng Mai, Hà Nội 100000, Việt Nam <br/>
    Điện thoại : 090.7174.789, <br/>
    Email: info@bumas.vn <br/>

    </div>
    </div>


    </div>
    </div>
    </body>
    </html>';

    sendEmail($to, $cc, $bcc, $subject, $content);
  }
}


function getContentEmailAdmin($fullName='',$email='',$phone='',$address='',$note='',$listTypeMoney=array(),$discountCode=array(), $order=array()){
  global $modelOptions;
   $conditions = array('key_word' => 'contact_site');
    $data = $modelOptions->find()->where($conditions)->first();

    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

  if(!empty($data_value['email'])){
    $to[]= trim($data_value['email']);

    $cc = array();
    $bcc = array();
    $subject = '[BUMAS] Xác thực hàng mới ';

    $content='<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông tin đơn hàng </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .bao{background: #fafafa;margin: 40px;padding: 20px 20px 40px;}
    .logo{

    }
    .logo img{height: 115px;margin:  0 auto;display:  block;margin-bottom: 15px;}
    .nd{background: white;margin: 0 auto;border-radius: 12px;overflow:  hidden;border: 2px solid #e6e2e2;line-height: 2;}
    .head{background: #3fb901; color:white;text-align: center;padding: 15px 10px;font-size: 17px;text-transform: uppercase;}
    .main{padding: 10px 20px;}
    .thong_tin{padding: 0 20px 20px;}
    .line{position: relative;height: 2px;}
    .line1{position: absolute;top: 0;left: 0;width: 100%;height: 100%;background-image: linear-gradient(to right, transparent 50%, #737373 50%);background-size: 26px 100%;}
    .cty{text-align:  center;margin: 20px 0 30px;}
    .main .fa{color:green;}
    table{margin:auto;}
    @media screen and (max-width: 768px){
      .bao{margin:0;}
    }
    @media screen and (max-width: 767px){
      .bao{padding:6px; }
      .nd{text-align: inherit;}
    }
    .table thead th , .table-bordered th , td{
      vertical-align: bottom;
      border: 1px solid #dee2e6;
    }
    </style>
    </head>
    <body>
    <div class="bao">
    <div class="nd">
    <div class="main" style=" font-size: 16px;">
    <h2 style=" text-align: center; font-size: 27px; ">Thông tin đơn hàng </h2>
    <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào BUMAS </em> 
    <p>
    tên khách hàng: '.$fullName.'<br/>
    Email: '.$email.'<br/>
    Điện thoại: '.$phone.'<br/>
    Địa chỉ: '.$address.'<br/>
    Chú ý: '.nl2br($note).'<br/><br/> <p>

    <h4 class="text-align">Chi tiết đơn hàng</h4>
    <table class="table table-bordered" style=" width: 85%;">
    <thead>
    <tr>
    <th scope="col">Ảnh </th>
    <th scope="col">Tên sản phẩm</th>
    <th scope="col">Đơn giá </th>
    <th scope="col">Số lượng</th>
    <th scope="col">Thành tiền</th>
    </tr>
    </thead>
    <tbody>';
    if(!empty($listTypeMoney)){
      foreach($listTypeMoney as $key => $item){

        $content .= '<tr>
        <td scope="row"> <img src="'.$item->image.'" width="100" alt=""></td>
        <td>'.$item->title.'<br/>';
        if(!empty($item->present)){
          $content .='<strong>Quà tặng</strong><br/>';
          foreach($item->present as $k => $value){
            $content .= $value->title.'
            <img src="'.$value->image.'" width="80" alt=""><br/>';
          }
        }
        $content .='</td>
        <td>'.number_format($item->price).'đ</td>
        <td>'.number_format($item->numberOrder).'</td>
        <td>'.number_format($item->price*$item->numberOrder).'</td>
        </tr>';
      } 
    }
    $content .=  '<tr>  <td colspan="10">
    Tổng tiền: '.number_format($order->money).'đ<br/>
     Giá vận chuyển : 30.000đ<br/>';
    if(!empty($discountCode['code1']) && !empty($discountCode['discount_price1'])){
      $content .=  '            <div class="cart-price-code-discount">
      <div class="cart-price-item">
      <div class="cart-price-item-title"> '. $discountCode['code1'] .': -'.number_format($discountCode['discount_price1']).'đ
      </div>
      </div>
      </div>';
    }  
    if(!empty($discountCode['code2']) && !empty($discountCode['discount_price2'])){
      $content .=  '            <div class="cart-price-code-discount">
      <div class="cart-price-item">
      <div class="cart-price-item-title"> '. $discountCode['code2'] .': -'.number_format($discountCode['discount_price2']).'đ
      </div>
      </div>
      </div>';
    }  
    if(!empty($discountCode['code3']) && !empty($discountCode['discount_price3'])){
      $content .=  '              <div class="cart-price-code-discount">
      <div class="cart-price-item">
      <div class="cart-price-item-title"> '. $discountCode['code3'] .': -'.number_format($discountCode['discount_price3']).'đ
      </div>
      </div>';  
    }
     if(!empty($discountCode['code4']) && !empty($discountCode['discount_price4'])){
      $content .=  '              <div class="cart-price-code-discount">
      <div class="cart-price-item">
      <div class="cart-price-item-title"> '. $discountCode['code4'] .': -'.number_format($discountCode['discount_price4']).'đ
      </div>
      </div>';  
    }
    $content .=  ' Thành tiền: '.number_format($order->total).'đ<br/>
    </td></tr>
    </tbody>
    </table>
    <br>
    Trân trọng ./
    <div style="white: 50%">
    <br/><img src="https://bumas.2top.vn/themes/shopbanhang/asset/image/logophong.png" alt="" jslog="138226; u014N:xr6bB; 53:WzAsMF0."> <br/>
    <strong>© 2023 Công Ty TNHH BUMAS</strong> <br/>
    <a href="https://bumas.vn">https://bumas.vn/</a> <br/>
    Địa chỉ: Tòa nhà Diamond Complex, Ô 20-21 Lô A, Khu Đô thị mới Đại Kim, Hoàng Mai, Hà Nội 100000, Việt Nam <br/>
    Điện thoại : 090.7174.789, <br/>
    Email: info@bumas.vn <br/>

    </div>
    </div>


    </div>
    </div>
    </body>
    </html>';

    sendEmail($to, $cc, $bcc, $subject, $content);
  }
}

function getAllProductActive()
{
  global $controller;

  $modelProduct = $controller->loadModel('Products');

  return $modelProduct->find()->where(['status'=>'active'])->order(['id_category'=>'asc'])->all()->toList();
}

function getAllCategoryProduct()
{
  global $modelCategories;
  
  $conditions = array('type' => 'category_product');
  
  return $modelCategories->find()->where($conditions)->all()->toList();
}
?> 