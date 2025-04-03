<?php include(__DIR__ . '/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Bảng tính lương nhân viên </h4>
  <!-- <p><a href="/addStaff" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p> -->

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-3 ">
            <label class="form-label">Nhân viên thu</label>
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
          <div class="col-md-2">
            <label class="form-label" for="basic-default-phone">Tháng</label>
            <select name="month" class="form-select color-dropdown">
              <option value="0">Tháng</option>
              <?php
              for ($i=1; $i <= 12 ; $i++) { 
                if($thang==$i){
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                }else{
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label" for="basic-default-phone">năm</label>
            <select name="year" class="form-select color-dropdown">
              <option value="0">Năm</option>
              <?php
              for ($i = date("Y"); $i >= 2020; $i--) { 
                if($nam==$i){
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                }else{
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
              ?>
            </select>  
          </div>
          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select class="form-select" name="status" id="status">
              <option value="">Tất cả</option>
              <option value="new" <?php if (!empty($_GET['status']) && $_GET['status'] == 'new')echo 'selected'; ?>>Chờ duyện</option>
              <option value="browse" <?php if (!empty($_GET['status']) && $_GET['status'] == 'browse')echo 'selected'; ?>>Duyệt</option>
               <option value="not_browse" <?php if (!empty($_GET['status']) && $_GET['status'] == 'not_browse')echo 'selected'; ?>>Không duyện</option>
               <option value="done" <?php if (!empty($_GET['status']) && $_GET['status'] == 'done')echo 'selected'; ?>>Dã thanh toán</option>
               <option value="cancel" <?php if (!empty($_GET['status']) && $_GET['status'] == 'cancel')echo 'selected'; ?>>hủy</option>
            </select>
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
  <div class="card">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Danh sách lương nhân viên</h5>
      </div>
      <p>
        <?php echo @$mess; ?>
      </p>
    </div>

    <div class="card-body row" style="padding-top: 0;">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr  align="center">
              <th>ID</th>
              <th>Thông tin nhân viên</th>
             
              <th>Thông tin lương </th>
              <th>lương Thanh thoán</th>
              <th>Tháng</th>
              <th>Ý khiến của xếp </th>
              <th>phiêu duyện  </th>
              
              
            </tr>
          </thead>
          <tbody>
            <?php

            // debug($user);
            if (!empty($listData)) {
              foreach ($listData as $item) {
               // debug($item);
               $code_bank = '';
               $pay = '';
               $status = '<p class="text-primary">chờ duyệt</p>';
               if($item->status=='browse'){
                $status = '<p class="text-secondary">Đã đông ý </p>';
                $pay ='<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#basicpay'.$item->id.'">
                <i class="bx bxl-paypal"></i></a>';
              }elseif($item->status=='not_browse'){
                $status = '<p class="text-success">Chưa đông ý </p>';
              }elseif($item->status=='done'){
                $status = '<p class="text-success">Đã thanh toán</p>';
              }
              foreach($listBank as $key => $value){

                if(@$item->infoStaff->code_bank==$value['code']){ 
                  $code_bank = $value['name'];
                }
              }
              $pheduyen = '';
              if($user->type==1 && $item->status!='done'){
               $pheduyen ='<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">
               <i class="bx bx-calendar-check"></i></a>';
             }

             echo '<tr>
             <td>' . $item->id . '</td>
             <td>Tên: ' . $item->infoStaff->name . ' </br>
             SĐT: ' . $item->infoStaff->phone . '</br>
             Email:  ' . $item->infoStaff->email . '</br>
             STK:  ' . $item->infoStaff->account_bank . '</br>
             Ngân hàng:  ' . $code_bank . '</td>
             <td>Lương cứng: ' . number_format($item->fixed_salary). ' đ</br>
             Công: ' . $item->working_day.'/'.$item->work.'</br>
             Phục cấp: ' . number_format($item->allowance). 'đ</br>
             Hoa hồng: ' . number_format($item->commission). 'đ</br>
             Thưởng: ' . number_format($item->bonus). 'đ</br>
             Phạt: ' . number_format($item->fine). 'đ</br>
             Bảo hiểm : ' . number_format($item->insurance). 'đ</br>
             </td>
             <td>' . number_format($item->salary). 'đ
             <a title="xem chi tiết "class="dropdown-item" href="/payrollstaff?month='.$item->month.'&year='.$item->yer.'&id_staff='.$item->id_staff.'">
             <i class="bx bxs-show"></i>
             </a>
             </td>
             <td>'.$item->month.'/'.$item->yer.'</td>
             <td>'.$item->note_boss.'</td>

             <th>'.$status.'</br>
             '.$pheduyen.'</br>
             '.$pay.'
             </th>                          
             </tr>';
              }
            } else {
              echo '<tr>
                        <td colspan="10" align="center">Chưa có dữ liệu</td>
                      </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Phân trang -->
    <div class="demo-inline-spacing">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <?php
          if (@$totalPage > 0) {
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
                        <a class="page-link" href="' . $urlPage . '1"
                          ><i class="tf-icon bx bx-chevrons-left"></i
                        ></a>
                      </li>';

            for ($i = $startPage; $i <= $endPage; $i++) {
              $active = ($page == $i) ? 'active' : '';

              echo '<li class="page-item ' . $active . '">
                            <a class="page-link" href="' . $urlPage . $i . '">' . $i . '</a>
                          </li>';
            }

            echo '<li class="page-item last">
                        <a class="page-link" href="' . $urlPage . $totalPage . '"
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
  <!--/ Responsive Table -->
</div>
<?php 
  if (!empty($listData)) {
    foreach ($listData as $item) {
      $code_bank = '';
      foreach($listBank as $key => $value){                 
        if(@$item->infoStaff->code_bank==$value['code']){ 
          $code_bank = $value['name'];
        }
  }
    $link = 'https://img.vietqr.io/image/'.$item->infoStaff->code_bank.'-'.$item->infoStaff->account_bank.'-compact2.png?accountName='.@$item->infoStaff->name.'&amount='.$item->salary;
       ?>
   <div class="modal fade" id="basicModal<?php echo $item->id; ?>"  name="id">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header form-label border-bottom">
          <h5 class="modal-title" id="exampleModalLabel1">Thông tin bảng lương nhân viên </h5>
          <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/salaryVerification" method="GET">
         <div class="modal-footer">
          <input type="hidden" value="<?php echo $item->id; ?>"  name="id">
          <div class="card-body">
            <div class="row gx-3 gy-2 align-items-center">
              <div class="col-md-12">
                <span><label class="form-label">Tên:</label> <?php echo $item->infoStaff->name; ?></span></br>
               <!--  <span><label class="form-label">SĐT:</label> <?php echo $item->infoStaff->phone; ?></span></br>
                <span><label class="form-label">Email:</label> <?php echo $item->infoStaff->email; ?></span></br>
                <span><label class="form-label">STK:</label> <?php echo $item->infoStaff->account_bank; ?></span></br>
                <span><label class="form-label">Ngân hàng:</label> <?php echo $code_bank; ?></span></br> -->
                <span><label class="form-label">Lương cứng:</label> <?php echo number_format($item->fixed_salary); ?> đ</span></br>
                <span><label class="form-label"> Công:</label> <?php echo  $item->working_day.'/'.$item->work; ?></span></br>
                <span><label class="form-label"> Phục cấp:</label> <?php echo number_format($item->allowance); ?>đ</span></br>
                <span><label class="form-label"> Hoa hồng:</label> <?php echo number_format($item->commission); ?>đ</span></br>
                <span><label class="form-label"> Thưởng:</label> <?php echo number_format($item->bonus); ?>đ</span></br>
                <span><label class="form-label">Phạt:</label> <?php echo number_format($item->fine); ?>đ</span></br>
                <span><label class="form-label"> Bảo hiểm:</label> <?php echo number_format($item->insurance); ?>đ</span></br>
                <span><label class="form-label">Lương thanh toán:</label> <b class="text-danger"><?php echo number_format($item->salary); ?>đ</b></span></br>
                <span><label class="form-label">Tháng :</label> <?php echo $item->month.'/'.$item->yer; ?></span>
              </div>
              <div class="col-md-12">
                <label class="form-label">Phê duyệt</label>
                <select name="status" class="form-select color-dropdown" required>
                  <option value="">Chọn phê duyệt </option>
                  <option value="browse">Duyệt</option>
                  <option value="not_browse">Chưa duyệt </option>
                </select>
              </div>
              <div class="col-md-12">
                <label class="form-label">Ý kiến</label>
                <textarea  class="form-control" rows="5" name="note_boss"></textarea>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Xác nhận</button>
        </div>
      </form>

    </div>
  </div>
</div>

 <div class="modal fade" id="basicpay<?php echo $item->id; ?>"  name="id">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header form-label border-bottom">
          <h5 class="modal-title" id="exampleModalLabel1">Thông tin thanh toán lương cho nhân viên </h5>
          <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/salaryPayment" method="GET">
         <div class="modal-footer">
          <input type="hidden" value="<?php echo $item->id; ?>"  name="id">
          <div class="card-body">
            <div class="row gx-3 gy-2 align-items-center">
              <div class="col-md-6">
                <span><label class="form-label">Tên:</label> <?php echo $item->infoStaff->name; ?></span></br>
                 <span><label class="form-label">SĐT:</label> <?php echo $item->infoStaff->phone; ?></span></br>
                <span><label class="form-label">Email:</label> <?php echo $item->infoStaff->email; ?></span></br>
                <span><label class="form-label">STK:</label> <?php echo $item->infoStaff->account_bank; ?></span></br>
                <span><label class="form-label">Ngân hàng:</label> <?php echo $code_bank; ?></span></br>
                <span><label class="form-label">Lương cứng:</label> <?php echo number_format($item->fixed_salary); ?> đ</span></br>
                <span><label class="form-label"> Công:</label> <?php echo  $item->working_day.'/'.$item->work; ?></span></br>
                <span><label class="form-label"> Phục cấp:</label> <?php echo number_format($item->allowance); ?>đ</span></br>
                <span><label class="form-label"> Hoa hồng:</label> <?php echo number_format($item->commission); ?>đ</span></br>
                <span><label class="form-label"> Thưởng:</label> <?php echo number_format($item->bonus); ?>đ</span></br>
                <span><label class="form-label">Phạt:</label> <?php echo number_format($item->fine); ?>đ</span></br>
                <span><label class="form-label"> Bảo hiểm:</label> <?php echo number_format($item->insurance); ?>đ</span></br>
                <span><label class="form-label">Lương thanh toán:</label> <b class="text-danger"><?php echo number_format($item->salary); ?>đ</b></span></br>
                <span><label class="form-label">Tháng :</label> <?php echo $item->month.'/'.$item->yer; ?></span>
              </div>
              <div class="col-md-6">
                <div class=" footer " style="padding-top: 5px; text-align: center;">
                            <h5>Mã QR thanh toán</h5>
                            <img src="<?php echo $link; ?>" style="width: 100%;">
                    </div>
              </div>

              <div class="col-md-12">
                <label class="form-label">Chọn hình thức thanh toán</label>
                <select name="type_collection_bill" class="form-select color-dropdown" required>
                  <option value="">Chọn hình thức thanh toán</option>
                  <?php
                  foreach ($type_collection_bill as $key => $value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                  }
                  ?>
                </select>
              </div>
               <div class="col-md-12">
                 <button type="submit" class="btn btn-primary">Xác nhận</button>
                <!-- <a class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn muốn thanh toán lương cho nhận viên <?php echo $item->infoStaff->name; ?>  không?');"   href="/salaryPayment?id=<?php echo $item->id; ?>">Xác nhận</a> -->
            </div>
          </div>

         
        </div>
      </form>

    </div>
  </div>
</div>
<?php }} ?>

<?php include(__DIR__ . '/../footer.php'); ?>