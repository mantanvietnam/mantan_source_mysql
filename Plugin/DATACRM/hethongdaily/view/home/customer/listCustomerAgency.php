<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/orderCustomerAgency">Khách hàng</a> /</span>
    Danh sách khách hàng
  </h4>

  <p><a href="/editCustomerAgency" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a>  <a href="/addDataCustomer" class="btn btn-primary" ><i class='bx bx-plus'></i> Thêm mới bằng Excel</a></p>

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
            <label class="form-label">Tên khách hàng</label>
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
            <label class="form-label">Nhóm khách hàng</label>
            <select name="id_group" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php 
              if(!empty($listGroup)){
                foreach ($listGroup as $key => $value) {
                  if(empty($_GET['id_group']) || $_GET['id_group']!=$value->id){
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
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="active" <?php if(!empty($_GET['status']) && $_GET['status']=='active') echo 'selected';?> >Kích hoạt</option>
              <option value="lock" <?php if(!empty($_GET['status']) && $_GET['status']=='lock') echo 'selected';?> >Khóa</option>
            </select>
          </div>
          
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách khách hàng</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Hình đại diện</th>
            <th>Khách hàng</th>
            <th>Nhóm khách hàng</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Đơn hàng</th>
            <th>Chăm sóc</th>
            <th>Sửa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
              $status= '<span class="text-danger">Khóa</span>';
              if($item->status=='active'){ 
                  $status= '<span class="text-success">Kích hoạt</span>';
              }

              $sex= 'Nữ';
              if($item->sex==1){ 
                  $sex= 'Nam';
              }

              $birthday = '';
              if(!empty($item->birthday_date) && !empty($item->birthday_month) && !empty($item->birthday_year)){
                  $birthday = $item->birthday_date.'/'.$item->birthday_month.'/'.$item->birthday_year;
              }

              $history = '';
              if(!empty($item->history)){
                $status_history = 'text-danger';

                if($item->history->status == 'done'){
                  $status_history = 'text-success';
                }

                $history = '<span class="'.$status_history.'">'.date('H:i d/m/Y', $item->history->time_now).'</span>: '.$item->history->note_now;
              }

              $infoCustomer = $item->full_name.'<br/>'.$item->phone;
              if(!empty($item->address)) $infoCustomer .= '<br/>'.$item->address;
              if(!empty($item->email)) $infoCustomer .= '<br/>'.$item->email;
              $infoCustomer .= '<br/>'.$status;
              if(!empty($item->facebook)) $infoCustomer .= '<br/><a href="'.@$item->facebook.'" target="_blank"><i class="bx bxl-facebook-circle"></i></a>';
              
              echo '<tr>
              <td>'.$item->id.'</td>
              <td><img class="img_avatar" src="'.$item->avatar.'" width="80" height="80" /></td>
              <td>'.$infoCustomer.'</td>
              <td>'.$item->groups.'</td>
              <td>'.$sex.'</td>
              <td><a href="/downloadMMTC/?id_customer='.$item->id.'" target="_blank">'.$birthday.'</a></td>

              <td><a href="/orderCustomerAgency/?id_user='.$item->id.'">Đã mua '.number_format($item->number_order).' đơn</a></td>

              <td>
                '.$history.'
                <p class="text-center mt-3">
                  <a href="/addCustomerHistoriesAgency/?id_customer='.$item->id.'" class="btn btn-primary"><i class="bx bx-plus-medical"></i></a> 
                  <a href="/listCustomerHistoriesAgency/?id_customer='.$item->id.'" class="btn btn-danger"><i class="bx bx-list-ul" ></i></a>
                </p>
              </td>

              <td width="5%" align="center">
                <a class="dropdown-item" href="/editCustomerAgency/?id='.$item->id.'">
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
</div>
<!--/ Responsive Table -->
</div>

<?php include(__DIR__.'/../footer.php'); ?>