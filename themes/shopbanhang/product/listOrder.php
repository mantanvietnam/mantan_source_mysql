<?php
global $session;
$info = $session->read('infoUser');
getHeader();
debug($listData);

?>
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<main>
    <div id="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div id="profile-user">
                        <div class="title-profile">
                            <h3>Xin chào!</h3>
                            <h4>
                                <?= $info->full_name ?>
                            </h4>
                        </div>
                        <div class="my-account">
                            <nav class="navbar navbar-expand-lg">
                                <div class="container">
                                    <div class="collapse navbar-collapse show" id="navbarNav">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item sp-sale">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#super-sale">Siêu
                                                    sale 9.9</a>
                                            </li>

                                            <li class="nav-item accordion" id="accordionExample">
                                                <a class="nav-link accordion-button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne" href="#" role="button">Tài khoản của
                                                    tôi</a>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    data-bs-parent="#accordionExample">
                                                    <a class="dropdown-item" data-bs-toggle="tab" href="#super-sale">Hồ
                                                        sơ</a>
                                                    <a class="dropdown-item" href="/editInfoUser">Chỉnh sửa thông
                                                        tin</a>
                                                    <a class="dropdown-item" href="deliveryAddress">Địa
                                                        chỉ giao hàng</a>
                                                    <a class="dropdown-item" href="/changepassword">Đổi mật khẩu</a>
                                                </div>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#my-order">Đơn mua</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#my-product">Sản phẩm</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#my-voucher">Voucher</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="tab-content" style="height:100%">
                        <div id="super-sale" class="tab-pane active" style="border:1px solid #ccc">
                             <div class="title-viewed-product">
                                    <p>Sản phẩm đã xem</p>
                                </div>
                                <div class="group-viewed-product">
                                    <div class="row list-viewed-product">
                                        <table class="table table-bordered">
                                            <thead>
                                              <tr class="">
                                                <th>ID</th>
                                                <th>địa chỉ nhận hàng </th>
                                                <th>Số tiền</th>
                                                <th>Thời gian tạo</th>
                                                <th>Trạng thái</th>
                                                <th>Xử lý</th>
                                                <th>Xóa</th>
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
                                                    }elseif($item->status=='deilvery'){
                                                         $status= 'Đang giao';
                                                    }elseif($item->status=='done'){
                                                       $status= 'Đã xong';
                                                    }else{
                                                       $status= 'Đã hủy';
                                                    }
                                                    echo '<tr>
                                                            <td>'.$item->id.'</td>
                                                            <td>
                                                              '.$item->address.'
                                                            </td>
                                                            <td>'.number_format($item->total).'đ</td>
                                                            <td>'.date('H:i d/m/Y', $item->create_at).'</td>
                                                            <td align="center">'.$status.'</td>
                                                            <td align="center">
                                                              <a class="dropdown-item" href="/plugins/admin/product-view-admin-order-viewOrderAdmin.php/?id='.$item->id.'">
                                                                <i class="bx bx-edit-alt me-1"></i>
                                                              </a>
                                                            </td>
                                                            <td align="center">
                                                              <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/product-view-admin-order-deleteOrderAdmin.php/?id='.$item->id.'">
                                                                <i class="bx bx-trash me-1"></i>
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