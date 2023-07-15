<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thống kê nhanh</h4>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-2">
            <label class="form-label">Tạo từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Đến ngày</label>
            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
          </div>
          
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Thống kê nhanh</h5>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>Tiêu chí</th>
            <th>Số lượng thống kê</th>
           <!--  <th>Số tiền</th>
            <th>Người dùng</th>
            <th>Nội dung</th>
            <th>Trạng thái</th> -->
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Người dùng </td>
            <td><?php echo @$totaUser; ?> Người dùng</td>
          </tr>
          <tr>
            <td>Người dùng đăng nhập trong vòng 7 ngày gần đây </td>
            <td><?php echo @$totaUserlastlogin; ?> Người dùng</td>
          </tr>
          <tr>
            <td>Designer được duyệt  </td>
            <td><?php echo @$totaDesignerApproved ?> Designer</td>
          </tr>
          <tr>
            <td>Designer đăng ký mới  </td>
            <td><?php echo @$totaDesignerNew; ?> Designer</td>
          </tr>
          <tr>
            <td>Nạp tiền chuyển khoản ngân hàng  </td>
            <td><?php echo number_format(@$OrderBanking) ?> VNĐ</td>
          </tr>
          <tr>
            <td>Nạp tiền Apple pay  </td>
            <td><?php echo number_format(@$OrderApple) ?> VNĐ</td>
          </tr>
          <tr>
            <td>Mẫu thiết kế được duyệt</td>
            <td><?php echo @$totalDataProduct ?> Mẫu</td>
          </tr>
          <tr>
            <td>Mẫu thiết kế chưa được duyệt  </td>
            <td><?php echo @$totalDataProductPen ?> Mẫu</td>
          </tr>
          <tr>
            <td>Số lượng kho</td>
            <td><?php echo @$totalDataWarehouse ?> kho</td>
          </tr>
          
        </tbody>
      </table>
    </div>
    <!-- Phân trang -->
   <!--  <div class="demo-inline-spacing">
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
    </div> -->
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>