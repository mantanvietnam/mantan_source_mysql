<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Quản lý Zalo OA</h4>
  <p><a href="/plugins/admin/zalo_zns-view-admin-addZaloOAAdmin" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a> <button onclick="$('#addMoneyModal').modal('show');" type="button" class="btn btn-danger"><i class='bx bx-dollar'></i> Nạp tiền Zalo OA</button></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-2">
            <label class="form-label">ID Zalo OA</label>
            <input type="text" class="form-control" name="id_oa" value="<?php if(!empty($_GET['id_oa'])) echo $_GET['id_oa'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">ID App</label>
            <input type="text" class="form-control" name="id_app" value="<?php if(!empty($_GET['id_app'])) echo $_GET['id_app'];?>">
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
    <h5 class="card-header">Danh sách Zalo OA</h5>
    
    <div class="card-body row">
      <p>Link callback: <?php echo $urlHomes;?>callbackZalo</p>
      <p>Số dư tài khoản: <?php echo number_format($money_zalo_zns);?>đ</p>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>ID OA</th>
              <th>ID APP</th>
              <th>Khóa bảo mật</th>
              <th>Deadline</th>
              <th>Sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  
                  if(empty($item->access_token)){
                    $access_token = '<a target="_blank" href="https://developers.zalo.me/app/'.$item->id_app.'/oa/settings" class="btn btn-primary">Cấp quyền</a>';
                  }else{
                    $access_token = date('H:i d/m/Y', $item->deadline);
                  }

                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.$item->id_oa.'</td>
                          <td>'.$item->id_app.'</td>
                          <td>'.$item->secret_key.'</td>
                          <td>'.$access_token.'</td>

                          <td align="center">
                            <a class="dropdown-item" href="/plugins/admin/zalo_zns-view-admin-addZaloOAAdmin/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>

                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/zalo_zns-view-admin-deleteZaloOAAdmin/?id='.$item->id.'">
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

<div class="modal fade" id="addMoneyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quét mã QR để nạp tiền</h5>
      </div>
      <div class="modal-body">
        <img src="https://img.vietqr.io/image/TPB-06931228686-compact2.png?amount=500000&addInfo=ZALO <?php echo $_SERVER['HTTP_HOST'];?>&accountName=Tran Ngoc Manh" class="img-fluid">
      </div>
    </div>
  </div>
</div>