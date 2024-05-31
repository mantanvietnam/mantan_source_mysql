<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thành viên</h4>
  <?php if(checkPermission('exportarexcel')){ ?>
  <p><a href="#" class="btn btn-primary"><i class='bx bx-plus'></i> Nhập excel</a></p>
<?php } ?>
  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-3">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id"
                   value="<?php if (!empty($_GET['id'])) echo $_GET['id']; ?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên thành viên</label>
            <input type="text" class="form-control" name="name"
                   value="<?php if (!empty($_GET['name'])) echo $_GET['name']; ?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" name="phone_number"
                   value="<?php if (!empty($_GET['phone_number'])) echo $_GET['phone_number']; ?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="email"
                   value="<?php if (!empty($_GET['email'])) echo $_GET['email']; ?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Loại tài khoản</label>
            <select name="type" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="0" <?php if (isset($_GET['type']) && $_GET['type'] == '0') echo 'selected'; ?> >Người dùng
              </option>
              <option value="1" <?php if (isset($_GET['type']) && $_GET['type'] == '1') echo 'selected'; ?> >Tài xế
              </option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') echo 'selected'; ?> >Kích hoạt
              </option>
              <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0') echo 'selected'; ?> >Khóa
              </option>
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
  <div class="card row">
    <h5 class="card-header">Danh sách khách hàng</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
        <tr class="">
          <?php if(checkPermission('idadmin')){ echo '<th>ID</th>';} 
                if(checkPermission('avatar')){ echo '<th>Avatar</th>';} 
                if(checkPermission('fullname')){ echo '<th>Họ và tên</th>';} 
                if(checkPermission('info')){ echo '<th>Thông tin</th>';} 
                if(checkPermission('type')){ echo '<th>Loại tài khoản</th>';} 
                if(checkPermission('coin')){ echo '<th>Cộng/Trừ coin</th>';} 
                if(checkPermission('edit')){ echo '<th>Sửa</th>';} 
                if(checkPermission('status')){ echo '<th>Trạng thái</th>';} ?>
        </tr>
        </thead>
        <tbody>
        <?php

        
        
        if (!empty($listData)) {
            foreach ($listData as $item) {
                if ($item->type == 0) {
                    $type = 'Người dùng';
                } else {
                    $type = 'Tài xế';
                }

                if ($item->status == 1) {
                    $status = '
                  <a class="btn btn-success"  title="Khóa tài khoản" 
                    onclick="return confirm(\'Bạn có chắc chắn muốn khóa người dùng không?\');"
                    href="/plugins/admin/excgo-view-admin-user-updateStatusUserAdmin/?id=' . $item->id . '&status=0"
                  >
                           <i class="bx bx-lock-open-alt me-1" style="font-size: 22px;"></i>
                  </a><br/>Đã kích hoạt ';
                } else {
                    $status = '
                  <a class=" btn btn-danger"  title="Kích hoạt tài khoản" 
                    onclick="return confirm(\'Bạn có chắc chắn muốn kích hoạt người dùng không?\');" 
                    href="/plugins/admin/excgo-view-admin-user-updateStatusUserAdmin/?id=' . $item->id . '&status=1"
                  >
                           <i class="bx bx-lock-alt me-1" style="font-size: 22px;"></i>
                  </a><br/> Đã khóa ';
                }

              echo '<tr>';
                if(checkPermission('idadmin')){
                  echo '<td align="center">' . $item->id . '</td>';
                }
                if(checkPermission('avatar')){
                  echo  '<td align="center"><img src="' . $item->avatar . '" width="100" /></td>';
                }

                if(checkPermission('fullname')){
                  echo '<td>'.$item->name . '
                  </br>'. $item->phone_number . ' 
                  </br>' . $item->email.'
                  </td>';
                }

                if(checkPermission('info')){
                  echo '<td>
                  Số dư: ' . number_format($item->total_coin) . ' đ
                  <br>
                  Địa chỉ: ' . $item->address . '
                  <br>
                  Sl chuyến xe có thể nhận: ' . $item->maximum_trip . '
                  </td>';
                }

                if(checkPermission('type')){
                 echo '
                 <td align="center">
                 ' . $type . '
                 </br> 
                 <a class="btn btn-success" href="/plugins/admin/excgo-view-admin-user-blockUserProvince/?id='.$item->id.'">
                 Block khu vực
                 </a>
                 </td>';
               }

               if(checkPermission('coin')){
                 echo '
                 <td>
                 <a class="btn btn-success" href="/plugins/admin/excgo-view-admin-user-updateUserCoinAdmin/?type=plus&id='.$item->id.'">
                 Cộng coin 
                 </a>
                 <a class="btn btn-danger" href="/plugins/admin/excgo-view-admin-user-updateUserCoinAdmin/?type=minus&id='.$item->id.'">
                 Trừ coin 
                 </a>
                 </td>';
               }
             
               if(checkPermission('edit')){
                 echo '
                 <td> 
                 <p align="center">
                 <a class="btn btn-primary" 
                 href="/plugins/admin/excgo-view-admin-user-viewUserDetailAdmin/?id=' . $item->id . '"
                 >
                 <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                 </a>
                 </p>
                 </td>';
               }

               if(checkPermission('status')){
                 echo '<td align="center">' . $status . '</td>';
               } 

             echo '</tr>';
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

    <!-- Phân trang -->
    <div class="demo-inline-spacing">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php
            if (isset($totalPage) && isset($page) && isset($urlPage)) {
                if ($totalPage > 0) {
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
            }
            ?>
        </ul>
      </nav>
    </div>
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>