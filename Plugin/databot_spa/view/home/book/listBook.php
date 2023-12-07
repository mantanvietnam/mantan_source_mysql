<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Đặt lịch hẹn</h4>
  <p><a href="/addBook" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Họ tên</label>
            <input type="text" class="form-control" name="full_name" value="<?php if(!empty($_GET['full_name'])) echo $_GET['full_name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>
          
          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0') echo 'selected';?> >Chưa xác nhận </option>
              <option value="1" <?php if(!empty($_GET['status']) && $_GET['status']=='1') echo 'selected';?> >Xác nhận</option>
              <option value="2" <?php if(!empty($_GET['status']) && $_GET['status']=='2') echo 'selected';?> >Không đến</option>
              <option value="3" <?php if(!empty($_GET['status']) && $_GET['status']=='3') echo 'selected';?> >Hủy lịch</option>
              <option value="4" <?php if(!empty($_GET['status']) && $_GET['status']=='4') echo 'selected';?> >Đã đến</option>
              <option value="5" <?php if(!empty($_GET['status']) && $_GET['status']=='5') echo 'selected';?> >Đặt online</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Kiểu đặt</label>
            <select name="type" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="type1" <?php if(isset($_GET['type']) && $_GET['type']=='type1') echo 'selected';?> >Lịch tư vấn </option>
              <option value="type2" <?php if(isset($_GET['type']) && $_GET['type']=='type2') echo 'selected';?> >Lịch chăm sóc </option>
              <option value="type3" <?php if(isset($_GET['type']) && $_GET['type']=='type3') echo 'selected';?> >Lịch liệu trình </option>
              <option value="type4" <?php if(isset($_GET['type']) && $_GET['type']=='type4') echo 'selected';?> >Lịch điều trị </option>
            </select>
          </div>

          <div class="col-md-2">
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

          <div class="col-md-2">
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

          <div class="col-md-2">
            <label class="form-label">Đặt từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-2">
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
    <h5 class="card-header">
      <a href="/listBookCalendar" class="btn btn-danger">Xem dạng lịch</a>
    </h5>
    
    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Thời gian</th>
              <th>Khách hàng</th>
              <th>Dịch vụ</th>
              <th>Kiểu đặt</th>
              <th>Trạng thái</th>
              <th>Sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $arr = explode(',', @$item->type);
                  $type = [];
                  if(!empty($item->type1)){
                    $type[] = 'Lịch tư vấn';
                  }

                  if(!empty($item->type2)){
                    $type[] = 'Lịch chăm sóc';
                  }

                  if(!empty($item->type3)){
                    $type[] = 'Lịch liệu trình';
                  }

                  if(!empty($item->type4)){
                    $type[] = 'Lịch điều trị';
                  }

                  if($item->status==0){
                    $status= 'Chưa xác nhận';
                  }elseif($item->status==1){
                    $status= 'Xác nhận';
                  }elseif($item->status==2){
                    $status= 'Không đến';
                  }elseif($item->status==3){
                    $status= 'Hủy lịch';
                  }elseif($item->status==4){
                    $status= 'Đã đến';
                  }elseif($item->status==5){
                    $status= 'Đặt online';
                  }

                  $repeat_book = [date("d/m/Y H:i", $item->time_book)];
                  if(!empty($item->repeat_book)){
                    $time_book = $item->time_book;
                    for($i=1;$i<$item->apt_times;$i++){
                      $time_book += $item->apt_step*24*60*60;
                      $repeat_book[] = date("d/m/Y H:i", $time_book);
                    }
                  }

                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.implode('<br/>', $repeat_book).'</td>
                          <td>'.$item->name.'<br/>
                              '.$item->phone.'
                            </td>
                          <td>'.$item->service->name.'</td>
                          <td>'.implode('<br/>', $type).'</td>
                          <td>'.$status.'</td>

                          <td align="center">
                            <a class="dropdown-item" href="/addBook/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>

                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa lịch hẹn không?\');" href="/deleteBook/?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có lịch hẹn</td>
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