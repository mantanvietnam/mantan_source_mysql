<script language="javascript" type="text/javascript" src="/plugins/ezpics_admin/view/admin/js/ezpics_admin.js"></script>
<link rel="stylesheet" href="/plugins/ezpics_admin/view/admin/css/ezpics_admin.css" />
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Người dùng sắp hết hạn Pro</h4>
  <p><a href="/plugins/admin/ezpics_admin-view-admin-member-NotificationDeadlineProAdmin" class="btn btn-primary"><i class='bx bx-bell'></i> Thông báo hết hạn Pro</a></p>

  <!-- Form Search -->
<!--   <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Họ tên</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php if(!empty($_GET['email'])) echo $_GET['email'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="1" <?php if(!empty($_GET['status']) && $_GET['status']=='1') echo 'selected';?> >Kích hoạt</option>
              <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0') echo 'selected';?> >Khóa</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Loại tài khoản</label>
            <select name="type" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="0" <?php if(!empty($_GET['type']) && $_GET['type']=='0') echo 'selected';?> >Người dùng</option>
              <option value="1" <?php if(!empty($_GET['type']) && $_GET['type']=='1') echo 'selected';?> >Designer</option>
            </select>
          </div>
          <div class="col-md-2">
            <label class="form-label">Sắp xếp </label>
            <select name="order" class="form-select color-dropdown">
              <option value="">Mới nhất</option>
              <option value="1" <?php if(!empty($_GET['order']) && $_GET['order']=='1') echo 'selected';?> >Hoạt động gần đây</option>
            </select>
          </div>
          <div class="col-md-2">
            <label class="form-label">phiên bản</label>
            <select name="pro" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="1" <?php if(isset($_GET['pro']) && $_GET['pro']=='1') echo 'selected';?> >bản Pro</option>
              <option value="0" <?php if(isset($_GET['pro']) && $_GET['pro']=='0') echo 'selected';?> >bản thường</option>
            </select>
          </div>
          
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div>
        </div>
      </div>
    </div>
  </form> -->
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Danh sách người dùng sắp hết hạn Pro - <b class="text-danger"><?php echo number_format($totalData);?></b> người dùng</h5>
      </div>
      
    </div>
    <p><?php echo @$mess;?></p>  
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Ảnh đại diện</th>
              <th>Khách hàng</th>
              <th>Thống kê</th>
              <th>Loại tài khoản</th>
              <th>Sửa</th>
              <th>Khóa</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $type = 'Người dùng';
                  if($item->type==1){
                    $type = 'Designer <br/>CK: '.$item->commission;
                  }

                  if($item->member_pro==1){
                    $pro = 'Bản: PRO <br/>ngày hết hạn: '.date('H:i d/m/Y', strtotime($item->deadline_pro));
                  }else{
                    $pro = 'Bản: thường  <a  style="color: red; cursor: pointer;" title="Nâng cấp lên bản Pro" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">Nâng cấp lên bản Pro
                              <i class="bx bxs-chevrons-up" style="font-size: 22px;"></i>
                            </a>';
                  }
                   $sellingMoney = 0;
                  if(!empty($item->sellingMoney)){
                      $sellingMoney = $item->sellingMoney;
                  }

                  $buyingMoney = 0;
                  if(!empty($item->buyingMoney)){
                      $buyingMoney = $item->buyingMoney;
                  }

                  $status = '<span style="color: #60bc2f;">Kích hoạt</span> <br/>
                   <a class="dropdown-item"  title="khóa tài khoản" onclick="return confirm(\'Bạn có chắc chắn muốn khóa người dùng không?\');" href="/plugins/admin/ezpics_admin-view-admin-member-lockMemberAdmin/?id='.$item->id.'&status=1">
                              <i class="bx bx-lock-alt me-1" style="font-size: 22px;"></i>
                            </a>';
                  if($item->status==0){
                    $status = '<span style="color: red;">Khóa</span> <br/>
                   <a class="dropdown-item"  title="Kích hoạt tài khoản" onclick="return confirm(\'Bạn có chắc chắn muốn Kích hoạt người dùng không?\');" href="/plugins/admin/ezpics_admin-view-admin-member-lockMemberAdmin/?id='.$item->id.'&status=2">
                              <i class="bx bx-lock-open-alt me-1" style="font-size: 22px;"></i>
                            </a>';
                  }

                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td><img src="'.$item->avatar.'" width="100" /></td>
                          <td>
                            '.$item->name.'<br/>
                            '.$item->phone.'<br/>
                            '.$item->email.'<br/>
                            Đăng ký: '.date('H:i d/m/Y', strtotime($item->created_at)).'<br/>
                            Đăng nhập lần cuối lúc: '.date('H:i d/m/Y', strtotime($item->last_login)).'<br/>
                            '.$pro.'<br/><br/>
                            <a class="btn btn-success" href="/plugins/admin/ezpics_admin-view-admin-member-addMoneyManager/?type=plus&id='.$item->id.'">
                             Cộng tiền 
                            </a>
                            <a class="btn btn-danger" href="/plugins/admin/ezpics_admin-view-admin-member-addMoneyManager/?type=minus&id='.$item->id.'">
                             Trừ tiền 
                            </a>
                          </td>
                          <td style="width: 16%;">Số dư: '.number_format(@$item->account_balance).'đ <br/>
                              số tiền bán: '. number_format(@$sellingMoney).'đ<br/>
                              Số tiền nạp: '.number_format(@$buyingMoney).'đ<br/>
                              SL mẫu được duyệt: '.number_format($item->totaProducts).'<br/>
                              SL kho: '.number_format($item->totaWarehouse).'<br/>
                              SL theo dõi : '.number_format($item->totaFollowDesigner).'
                          </td>
                          <td>'.$type.'</td>
                         
                          
                           <td align="center">
                            <a class="dropdown-item" href="/plugins/admin/ezpics_admin-view-admin-member-addMemberAdmin/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                            </a>
                          </td>
                          <td align="center">'.$status.'</td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có người dùng</td>
                      </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div id="mobile_view">
      <?php 
         if(!empty($listData)){
                foreach ($listData as $item) {
                  $type = 'Người dùng';
                  if($item->type==1){
                    $type = 'Designer  &nbsp;&nbsp;&nbsp;&nbsp; CK: '.$item->commission;
                  }

                   $sellingMoney = 0;
                  if(!empty($item->sellingMoney)){
                      $sellingMoney = $item->sellingMoney;
                  }

                  $buyingMoney = 0;
                  if(!empty($item->buyingMoney)){
                      $buyingMoney = $item->buyingMoney;
                  }

                  if($item->member_pro==1){
                    $pro = 'Bản: PRO <br/>ngày hết hạn: '.date('H:i d/m/Y', strtotime($item->deadline_pro));
                  }else{
                    $pro = 'Bản: thường <a style="color: red; cursor: pointer;" title="Nâng cấp lên bản Pro" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'"> Nâng cấp lên bản Pro
                              <i class="bx bxs-chevrons-up" style="font-size: 22px;"></i>
                            </a>';
                  }

                  $status = '
                   <a class=" btn btn-danger"  title="khóa tài khoản" onclick="return confirm(\'Bạn có chắc chắn muốn khóa người dùng không?\');" href="/plugins/admin/ezpics_admin-view-admin-member-lockMemberAdmin/?id='.$item->id.'&status=1">
                              <i class="bx bx-lock-alt me-1" style="font-size: 22px;"></i>
                            </a><br/> Kích hoạt ';
                  if($item->status==0){
                    $status = '
                   <a class="btn btn-success"  title="Kích hoạt tài khoản" onclick="return confirm(\'Bạn có chắc chắn muốn Kích hoạt người dùng không?\');" href="/plugins/admin/ezpics_admin-view-admin-member-lockMemberAdmin/?id='.$item->id.'&status=2">
                              <i class="bx bx-lock-open-alt me-1" style="font-size: 22px;"></i>
                            </a><br/>Khóa ';
                  }

            echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                     <p><b>Người dùng '.$item->id.':</b> '.$item->name.'</p>
                          <p><img src="'.$item->avatar.'" width="100" /></p>
                          <p>
                            '.$item->phone.'<br/>
                            '.$item->email.'<br/>
                            Đăng ký: '.date('H:i d/m/Y', strtotime($item->created_at)).'<br/>
                            Đăng nhập lần cuối lúc: '.date('H:i d/m/Y', strtotime($item->last_login)).'<br/>
                            '.$pro.'
                          </p>
                          <p><b>Thống kê:</b> <br/>
                          Số dư: '.number_format($item->account_balance).'đ <br/>
                              số tiền bán: '.number_format(@$sellingMoney).'đ<br/>
                              Số tiền nạp: '.number_format(@$buyingMoney).'đ<br/>
                              SL mẫu được duyệt: '.number_format($item->totaProducts).'<br/>
                              SL kho: '.number_format($item->totaWarehouse).'<br/>
                              SL theo dõi : '.number_format($item->totaFollowDesigner).'
                          </p>
                          <p><b>Loại tài khoản: </b>'.$type.'</p>
                         
                          <p align="center">
                            <a class="btn btn-success" href="/plugins/admin/ezpics_admin-view-admin-member-addMoneyManager/?type=plus&id='.$item->id.'">
                              <i class="bx bx-shield-plus me-1" style="font-size: 22px;"></i>
                            </a>
                           &nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-danger" href="/plugins/admin/ezpics_admin-view-admin-member-addMoneyManager/?type=minus&id='.$item->id.'">
                              <i class="bx bx-shield-minus me-1" style="font-size: 22px;"></i>
                            </a>
                          </p>
                           <p align="center">
                            <a class="btn btn-success" href="/plugins/admin/ezpics_admin-view-admin-member-addMemberAdmin/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                            </a>
                             &nbsp;&nbsp;&nbsp;&nbsp;
                          '.$status.'</p>
                  </div>';
          }
         
        }else{
          echo '<div class="col-sm-12 item">
                  <p class="text-danger">Chưa có dữ liệu</p>
                </div>';
        }
      ?>
    </div>

    <!-- Phân trang -->
    <div class="demo-inline-spacing">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <?php
            if($totalPage>0){
                if ($page > 5) {
                    $startPage = $page - 5;
                } else {
                    $startPage = 1;
                }

                if ($totalPage > $page + 5) {
                    $endPage = $page + 5;
                } else {
                    $endPage = $totalPage;
                }
                
                echo '<li class="page-item first">
                        <a class="page-link" href="'.$urlPage.'1"
                          ><i class="tf-icon bx bx-chevrons-left"></i
                        ></a>
                      </li>';
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $active= ($page==$i)?'active':'';

                    echo '<li class="page-item '.$active.'">
                            <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                          </li>';
                }

                echo '<li class="page-item last">
                        <a class="page-link" href="'.$urlPage.$totalPage.'"
                          ><i class="tf-icon bx bx-chevrons-right"></i
                        ></a>
                      </li>';
            }
          ?>
        </ul>
      </nav>
    </div>
    <!--/ Basic Pagination -->
    <?php  if(!empty($listData)){
              foreach ($listData as $items) { ?>
                        <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Nâng cấp bản Pro cho ID : <?php echo $items->id; ?></h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                             <form action="/plugins/admin/ezpics_admin-view-admin-member-memberBuyProAdmin" method="GET">
                               <div class="modal-footer">
                                <input type="hidden" value="<?php echo $items->id; ?>"  name="id">
                                <input type="hidden" value="0"  name="status">
                                <input type="hidden" value="<?php echo @$_GET['page']; ?>"  name="page">
                                <div class="card-body">
                                  <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md-12">
                                      <label class="form-label">Giá Nâng cấp</label>
                                      <input type="number" value="0" class="form-control" placeholder="Mặc định là 0đ" name="price">
                                    </div>
                                    <div class="col-md-12">
                                      <label class="form-label">Số ngày gia hạn</label>
                                      <input type="number" value="365" class="form-control" placeholder="Mặc định là 1 năm" name="date_use">
                                    </div>
                                  </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Nâng cấp</button>
                              </div>
                             </form>
                              
                            </div>
                          </div>
                        </div>
                      <?php }} ?>
  </div>
  <!--/ Responsive Table -->
</div>