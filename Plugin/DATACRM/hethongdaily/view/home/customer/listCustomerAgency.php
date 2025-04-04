<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
<style>
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content label {
  display: block;
  margin: 10px;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown2 {
  position: relative;
  display: inline-block;
}

.dropdown-content2 {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content2 label {
  display: block;
  margin: 10px;
}

.dropdown2:hover .dropdown-content2 {
  display: block;
}
</style>
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCustomerAgency">Khách hàng</a> /</span>
    Danh sách khách hàng
  </h4>

  <p><a href="/editCustomerAgency" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a>  <a href="/addDataCustomerAgency" class="btn btn-danger" ><i class='bx bx-plus'></i> Thêm mới bằng Excel</a></p>

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

          <div class="col-md-2 dropdown">
            <label class="form-label">Nhóm khách hàng</label>
            <button class="form-select color-dropdown" >chọn nhóm </button>
            <!-- <select name="id_group[]" class="form-select color-dropdown">
              <option value="">Tất cả</option> -->
              <div class="dropdown-content">
                <label><input type="checkbox" name="id_group[]" onclick="checkboxAll(this,'checkAll');" value="'.$value->id.'">&nbsp; Chọn tất cả </label>
              <?php 
              if(!empty($listGroup)){
                foreach ($listGroup as $key => $value) {
                  if(empty($_GET['id_group']) || (is_array($_GET['id_group']) && in_array($value->id, $_GET['id_group'])) ){
                    // echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                    echo '<label><input type="checkbox" class="checkAll" name="id_group[]" checked value="'.$value->id.'"> &nbsp; '.$value->name.'</label>';
                  }else{
                    // echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                    echo '<label><input type="checkbox" class="checkAll" name="id_group[]"  value="'.$value->id.'"> &nbsp; '.$value->name.'</label>';
                  }
                }
              }
              ?>
            </div>
            <!-- </select> -->
          </div>

          <div class="col-md-2 dropdown2">
            <label class="form-label">Chiến dịch</label>
            <button class="form-select color-dropdown2" >chọn chiến dịch </button>
            <!-- <select name="id_group[]" class="form-select color-dropdown">
              <option value="">Tất cả</option> -->
              <div class="dropdown-content2">
                <label><input type="checkbox" name="id_campaign[]" onclick="checkboxAll(this,'checkAllcampaign');" value="'.$value->id.'">&nbsp; Chọn tất cả</label>
              <?php 
              if(!empty($listCampaign)){
                foreach ($listCampaign as $key => $value) {
                  if(empty($_GET['id_campaign']) || in_array($value->id, $_GET['id_campaign'])){
                    // echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                    echo '<label><input type="checkbox" class="checkAllcampaign" name="id_campaign[]" checked value="'.$value->id.'"> &nbsp; '.$value->name.'</label>';
                  }else{
                    // echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                    echo '<label><input type="checkbox" class="checkAllcampaign" name="id_campaign[]"  value="'.$value->id.'"> &nbsp; '.$value->name.'</label>';
                  }
                }
              }
              ?>
            </div>
            <!-- </select> -->
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="active" <?php if(!empty($_GET['status']) && $_GET['status']=='active') echo 'selected';?> >Kích hoạt</option>
              <option value="lock" <?php if(!empty($_GET['status']) && $_GET['status']=='lock') echo 'selected';?> >Khóa</option>
            </select>
          </div>
          <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Ngày sinh</label>
                    
                    <div class="row">
                      <div class="mb-3 col-md-4">
                        <select name="birthday_date" class="form-select color-dropdown">
                          <option value="0">Ngày</option>
                          <?php
                          for ($i=1; $i <= 31 ; $i++) { 
                            if(!empty($_GET['birthday_date']) && $_GET['birthday_date']==$i){
                              echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            }else{
                              echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>

                      <div class="mb-3 col-md-4">
                        <select name="birthday_month" class="form-select color-dropdown">
                          <option value="0">Tháng</option>
                          <?php
                          for ($i=1; $i <= 12 ; $i++) { 
                            if(!empty($_GET['birthday_month']) && $_GET['birthday_month']==$i){
                              echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            }else{
                              echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>

                      <div class="mb-3 col-md-4">
                        <select name="birthday_year" class="form-select color-dropdown">
                          <option value="0">Năm</option>
                          <?php
                          for ($i = date("Y"); $i >= 1950; $i--) { 
                            if(!empty($_GET['birthday_year']) && $_GET['birthday_year']==$i){
                              echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            }else{
                              echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
          
          <div class="col-md-2">
            <!-- s<label class="form-label">&nbsp;</label> -->
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          
          <div class="col-md-1">
            <!-- s<label class="form-label">&nbsp;</label> -->
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách khách hàng - <span class="text-danger"><?php echo number_format($totalData);?> khách hàng</span></h5>
    <div id="desktop_view">
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
              <th>Xoá</th>
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

                <td align="center">
                <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/lockCustomerAgency/?id='.$item->id.'">
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
    <div id="mobile_view">
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
                if(!empty($item->facebook)) $infoCustomer .= '<br/><a href="'.@$item->facebook.'" target="_blank"><i class="bx bxl-facebook-circle"></i></a>';
                  
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <center><img class="img_avatar" src="'.$item->avatar.'" style=" width:50%" /></center><br/>
                        <p><strong> Khách hàng: </strong>: '.$item->full_name.' (ID: '.$item->id.')</p>
                        <p><strong> Điện thoại: </strong>: '.$item->phone.'</p>
                        <p><strong> Địa chỉ: </strong>: '.$item->address.'</p>
                        <p><strong> Nhóm: </strong>'.$item->groups.'</p>
                        <p><strong> Ngày sinh: </strong><a href="/downloadMMTC/?id_customer='.$item->id.'" target="_blank">'.$birthday.'</a></p>

                        <p><a href="/orderCustomerAgency/?id_user='.$item->id.'">Đã mua '.number_format($item->number_order).' đơn</a></p>

                        <p><strong>Chăm sóc: </strong>'.$history.'</p>
                        
                        <p class="text-center mt-3">
                          <a title="Thêm chăm sóc" href="/addCustomerHistoriesAgency/?id_customer='.$item->id.'" class="btn btn-primary"><i class="bx bx-plus-medical"></i></a> 
                          <a title="Lịch sử chăm sóc" href="/listCustomerHistoriesAgency/?id_customer='.$item->id.'" class="btn btn-info"><i class="bx bx-list-ul" ></i></a>
                        </p>

                        <p  class="text-center mt-3">
                          <a title="Sửa" class="btn btn-success" href="/editCustomerAgency/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a> 

                          <a title="Xóa" class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/lockCustomerAgency/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </p>

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
</div>
<!--/ Responsive Table -->
</div>

<script>

  function checkboxAll(source, className) {
    const checkboxes = document.getElementsByClassName(className);
    for(let i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = source.checked;
    }
  }
                                  
</script>

<?php include(__DIR__.'/../footer.php'); ?>