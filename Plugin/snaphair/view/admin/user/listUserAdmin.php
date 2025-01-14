<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thành viên</h4>
  <!-- <p><a href="/plugins/admin/zoomcheap-view-admin-manager-addManagerExcel" class="btn btn-primary"><i class='bx bx-plus'></i> Nhập excel</a></p> -->
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

          <div class="col-md-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="<?php if(!empty($_GET['email'])) echo $_GET['email'];?>">
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
    <?php echo @$mess; ?>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>avatar</th>
            <th>Họ và tên</th>
            <th>Liên hệ</th>
            <th>Số dư</th>
            <th>sưa</th>
            <th colspan="2">trạnh thái</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $status = '<span style="color: #60bc2f;">Kích hoạt</span> <br/>
                   <a class="dropdown-item"  title="khóa tài khoản" onclick="return confirm(\'Bạn có chắc chắn muốn khóa người dùng không?\');" href="updateStatusUserAdmin?id='.$item->id.'&status=lock">
                              <i class="bx bx-lock-alt me-1" style="font-size: 22px;"></i>
                            </a>';
                  if($item->status=='lock'){
                    $status = '<span style="color: red;">Khóa</span> <br/>
                   <a class="dropdown-item"  title="Kích hoạt tài khoản" onclick="return confirm(\'Bạn có chắc chắn muốn Kích hoạt người dùng không?\');" href="updateStatusUserAdmin?id='.$item->id.'&status=active">
                              <i class="bx bx-lock-open-alt me-1" style="font-size: 22px;"></i>
                            </a>';
                  }

                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td><img class="img_avatar" src="'.$item->avatar.'" width="80" height="80" /></td>
                        <td>'.$item->full_name.'</td>
                        <td>
                          '.$item->phone.' 
                          </br>
                          '.$item->email.' 
                        </td>
                        <td>'.number_format($item->coin).'</td>
                        <td align="center"><a class="dropdown-item"  title="Kích hoạt tài khoản" href="/plugins/admin/snaphair-view-admin-user-editUserAdmin?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                            </a></td>
                        <td align="center">'.$status.'</td>
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