<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thống kê lượng khách sử dụng dịch vụ</h4>

  <p><a href="/userServicestatistical/#revenueStatistical" class="btn btn-primary"><i class='bx bx-line-chart'></i> Xem biểu đồ</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-3">
            <label class="form-label">Khách hàng</label>
            <input type="text" class="form-control" name="name_customer" value="<?php if(!empty($_GET['name_customer'])) echo $_GET['name_customer'];?>">
            <input type="hidden" class="form-control" name="id_customer" value="<?php if(!empty($_GET['id_customer'])) echo $_GET['id_customer'];?>">
          </div>
          
          <div class="col-md-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="1" <?php if(!empty($_GET['status']) && $_GET['status']=='1') echo 'selected';?> >Đang sử dụng</option>
              <option value="2" <?php if(!empty($_GET['status']) && $_GET['status']=='2') echo 'selected';?> >Đã xong</option>
              <option value="3" <?php if(!empty($_GET['status']) && $_GET['status']=='3') echo 'selected';?> >Hủy</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">NV chăm sóc</label>
            <select name="id_staff" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php 
              if(!empty($listStaffs)){
                foreach ($listStaffs as $key => $value) {
                  if(empty($_GET['id_staff']) || $_GET['id_staff']!=$value->id){
                    echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                  }else{
                    echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                  }
                }
              }
              ?>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Dịch vụ</label>
            <select name="id_service" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php 
              if(!empty($listService)){
                foreach ($listService as $key => $value) {
                  if(empty($_GET['id_service']) || $_GET['id_service']!=$value->id){
                    echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                  }else{
                    echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                  }
                }
              }
              ?>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Đặt từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Đến ngày</label>
            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
          </div>

          

          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Tổng lượt sử dụng dịch vụ - <b class="text-danger"><?php echo number_format($totalData);?></b></h5>
      </div>
      <div class="col-md-6">
        <h5 class="card-header" style="float: right;">Số khách ngày hôm nay - <b class="text-danger"><?php echo number_format($totaltoday);?></b></h5>
      </div>
    </div>
    
    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>check in</th>
              <th>check out</th>
              <th>Khách hàng</th>
              <th>Dịch vụ</th>
              <th>nhân viên</th>
              <th>hinh thức</th>
              <th>Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){

                foreach ($listData as $item) {
                  

                 if($item->status==1){
                    $status= '<span class="text-success">Đang sử dụng </span>';
                  }elseif($item->status==2){
                    $status= '<span class="text-info">Đã xong </span>';
                  }elseif($item->status==3){
                    $status= '<span class="text-danger">Đã hủy </span>';
                  }
                  $created_at ='';
                  if(!empty($item->created_at)){
                    $created_at = date("H:i d/m/Y", $item->created_at);
                  }
                  $check_out ='';
                  if(!empty($item->check_out)){
                    $check_out = date("H:i d/m/Y", $item->check_out);
                  }

                  $type = "";
                  if(@$item->order->type=="combo"){
                     $type = '<span class="text-success">combo liệu trình</span>';
                  }elseif(@$item->order->type=="service"){
                    if(@$item->bill->type_card==1){
                      $type = '<span class="text-info">Dùng thẻ</span>';
                    }else{
                      $type = '<span class="text-danger">trả tiền thật</span>';
                    }
                  }

                  echo '<tr>
                          <td>'.$created_at.'</td>
                          <td>'.$check_out.'</td>
                          <td>'.$item->customer->name.'</td>
                          <td>'.$item->service->name.'</td>
                          <td>'.$item->staff->name.'</td>
                          <td>'.$type.'</td>
                          <td>'.$status.'</td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có dữ liệu nào</td>
                      </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Phân trang -->
      <div class="demo-inline-spacing">
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <?php
              if(@$totalPage>0){
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
    </div>
  </div>
  <!--/ Responsive Table -->
</div>
<?php include(__DIR__.'/../footer.php'); ?>