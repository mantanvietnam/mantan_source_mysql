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
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php if(!empty($_GET['email'])) echo $_GET['email'];?>">
          </div>
           <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="" <?php if(isset($_GET['status']) && $_GET['status']=='') echo 'selected';?> >Tất cả</option>
              <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0') echo 'selected';?> >Chưa xác nhận </option>
              <option value="1" <?php if(!empty($_GET['status']) && $_GET['status']=='1') echo 'selected';?> >Xác nhận</option>
              <option value="2" <?php if(!empty($_GET['status']) && $_GET['status']=='2') echo 'selected';?> >Không đến</option>
              <option value="3" <?php if(!empty($_GET['status']) && $_GET['status']=='3') echo 'selected';?> >Hủy</option>
              <option value="4" <?php if(!empty($_GET['status']) && $_GET['status']=='4') echo 'selected';?> >Đã đến</option>
              <option value="5" <?php if(!empty($_GET['status']) && $_GET['status']=='5') echo 'selected';?> >Đặt online</option>
            </select>
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
    <h5 class="card-header">Danh sách Đặt lịch hẹn</h5>
    <div class="table-responsive">
      <table class="table table-bBooked">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Thông tin Khách hàng</th>
            <th>Dịch vụ</th>
            <th>thời gian</th>
            <th>Trạnh thái</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $arr = explode(',', @$item->type);
                $type = '';
                if(in_array(0, $arr)){
                  $type .= 'Mặc định,';
                }
                if(in_array(1, $arr)){
                  $type .= ' Lịch chăm sóc,';
                }
                if(in_array(2, $arr)){
                  $type .= 'Lịch liệu trình,';
                }
                if(in_array(3, $arr)){
                  $type .= 'Lịch điều trị,';
                }

                if($item->status==0){
                  $status= 'Chưa xác nhận';
                }elseif($item->status==1){
                  $status= 'Xác nhận';
                }elseif($item->status==2){
                  $status= 'Không đến';
                }elseif($item->status==3){
                  $status= 'Hủy';
                }elseif($item->status==4){
                  $status= 'Đã đến';
                }elseif($item->status==5){
                  $status= 'Đặt online';
                }
                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->name.'<br/>
                            '.$item->phone.'<br/>
                            '.$item->email.'
                          </td>
                        <td>'.$item->Service->name.'<br/>'.$type.'</td>
                        <td>'.date("d/m/Y H:i", @$data['created_book']).'</td>
                        <td>'.$status.'</td>
                        <td align="center">
                          <a class="dropdown-item" href="/addBook/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa khách hàng không?\');" href="/deleteBook/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
                      </tr>';
              }
            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có khách hàng</td>
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
  <!--/ Responsive Table -->
</div>
<?php include(__DIR__.'/../footer.php'); ?>