<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Đại lý</h4>
  
  <p><a href="/plugins/admin/hethongdaily-view-admin-member-addMemberAdmin" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

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
              <option value="active" <?php if(!empty($_GET['status']) && $_GET['status']=='active') echo 'selected';?> >Kích hoạt</option>
              <option value="lock" <?php if(!empty($_GET['status']) && $_GET['status']=='lock') echo 'selected';?> >Khóa</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Hệ thống</label>
            <select name="id_system" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php 
              if(!empty($listSystem)){
                foreach ($listSystem as $key => $value) {
                  if(empty($_GET['id_system']) || $_GET['id_system']!=$value->id){
                    echo '<option value="'.$value->id.'" >'.$value->name.'</option>';
                  }else{
                    echo '<option selected value="'.$value->id.'" >'.$value->name.'</option>';
                  }
                }
              }
              ?>
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
        <h5 class="card-header">Danh sách đại lý</h5>
      </div>
    </div>

    <div class="card-body row">
      <p><?php echo @$mess;?></p>  
      <div id="desktop_view">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th>ID</th>
                <th>Ảnh đại diện</th>
                <th>Thông tin đại lý</th>
                <th>Tuyến trên</th>
                <th>Đăng nhập</th>
                <th>Trạng thái</th>
                <th>Sửa</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                if(!empty($listData)){
                  foreach ($listData as $item) {
                    $last_login = '';
                if(!empty($item->last_login)){
                   $last_login = date('H:i d/m/Y', @$item->last_login);
                }
                    $classActive = 'text-danger';
                    $verify = '<p class="text-danger">Chưa xác thực OTP</p>';
                    if($item->verify ==  'active'){
                      $classActive = 'text-success';
                      $verify = '<p class="text-success">Đã xác thực OTP</p>';
                    }

                    $status = '<p class="text-danger">Khóa</p>';
                    if($item->status ==  'active'){
                      $status = '<p class="text-success">Kích hoạt</p>';
                    }
                    
                    $theme_info = [];
                    $list_theme_info = explode(",", $item->list_theme_info);
                    if(!empty(listThemeInfo())){
                      foreach(listThemeInfo() as $key => $itemTheme){
                        if (in_array($itemTheme['id'], $list_theme_info)) {
                          $theme_info[] = $itemTheme['name'];
                        }
                      }
                    }

                    echo '<tr>
                            <td>'.$item->id.'</td>
                            <td><img src="'.$item->avatar.'" width="100" /></td>
                            <td>
                              <span class="'.$classActive.'">'.$item->name.'</span><br/>
                              '.$item->phone.'<br/>
                              '.$item->address.'<br/>
                              '.$item->email.'<br/>
                              Ngày hết hạn: '.date('d/m/Y', $item->deadline).'<br/>
                              Theme info: '.implode(', ', $theme_info).'<br/>
                              Số dư: '.number_format($item->coin).'<br/>

                              <br/><br/>
                              <a class="btn btn-danger " href="/plugins/admin/hethongdaily-view-admin-warehouse-listProductWarehouseMemberAdmin/?id_member='.$item->id.'">Xem tồn kho</a>
                              <a class="btn btn-primary" href="/plugins/admin/hethongdaily-view-admin-member-activateThemeMemberAdmin/?id_member='.$item->id.'">Kích hoạt theme</a>
                            </td>
                            <td>
                              <a href="/plugins/admin/hethongdaily-view-admin-member-listMemberAdmin/?id='.$item->id_father.'">'.@$item->father->name.'</a><br/>
                              '.@$item->father->phone.'
                            </td>
                            <td>'.$last_login.'</td>
                            <td>'.$status.$verify.'</td>
                            
                            <td align="center">
                              <a class="dropdown-item" href="/plugins/admin/hethongdaily-view-admin-member-addMemberAdmin/?id='.$item->id.'">
                                <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                              </a>
                            </td>

                            <td align="center">
                              <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/hethongdaily-view-admin-member-deleteMemberAdmin/?id='.$item->id.'">
                                <i class="bx bx-trash me-1"></i>
                              </a>
                            </td>
                            
                          </tr>';
                  }
                }else{
                  echo '<tr>
                          <td colspan="10" align="center">Chưa có đại lý hệ thống</td>
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
  </div>
  <!--/ Responsive Table -->
</div>