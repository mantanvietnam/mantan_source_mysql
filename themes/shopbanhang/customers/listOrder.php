<?php
global $session;
$info = $session->read('infoUser');
getHeader();

?>
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<main>
    <div id="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                   <?php include('menu.php'); ?>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="tab-content" style="height:100%">
                        <div id="super-sale" class="tab-pane active" style="border:1px solid #ccc">
                             <div class="title-viewed-product">
                                    <p>Đơn hàng</p>
                                </div>
                                <div class="group-viewed-product">
                                    <div class="row list-viewed-product">
                                        <table class="table table-bordered">
                                            <thead>
                                              <tr class="">
                                                <th>địa chỉ nhận hàng </th>
                                                <th>Số tiền</th>
                                                <th>Thời gian tạo</th>
                                                <th>Trạng thái</th>
                                                <th>Xử lý</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php 
                                                if(!empty($listData)){
                                                  foreach ($listData as $item) {
                                                    $status= '';
                                                   if($item->status=='new'){ 
                                                     $status= 'Đơm mới';
                                                    }elseif($item->status=='browser'){
                                                       $status= 'Đã duyệt';
                                                    }elseif($item->status=='delivery'){
                                                         $status= 'Đang giao';
                                                    }elseif($item->status=='done'){
                                                       $status= 'Đã xong';
                                                    }else{
                                                       $status= 'Đã hủy';
                                                    }
                                                    echo '<tr>
                                                            <td>
                                                              '.$item->address.'
                                                            </td>
                                                            <td>'.number_format($item->total).'đ</td>
                                                            <td>'.date('H:i d/m/Y', $item->create_at).'</td>
                                                            <td align="center">'.$status.'</td>
                                                            <td align="center">
                                                              <a class="dropdown-item" href="/detailOrder?id='.$item->id.'">
                                                                <i class="bx bx-edit-alt me-1"></i>
                                                              </a>
                                                            </td>
                                                            
                                                          </tr>';
                                                  }
                                                }else{
                                                  echo '<tr>
                                                          <td colspan="10" align="center">Chưa có dữ liệu</td>
                                                        </tr>';
                                                }
                                              ?>
                                            </tbody>
                                          </table>
                                    </div>

                                </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?php
getFooter();
?>