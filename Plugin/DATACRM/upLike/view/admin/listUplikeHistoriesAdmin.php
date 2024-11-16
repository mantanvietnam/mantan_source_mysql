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
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="Running" <?php if(!empty($_GET['status']) && $_GET['status']=='Running') echo 'selected';?> >Đang xử lý</option>
              <option value="Success" <?php if(!empty($_GET['status']) && $_GET['status']=='Success') echo 'selected';?> >Đã hoàn thành</option>
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
        <h5 class="card-header">Danh sách yêu cầu</h5>
      </div>
    </div>

    <div class="card-body row">
      <p><?php echo @$mess;?></p>  
      <div id="desktop_view">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th>Thời gian tạo</th>
                <th>ID trang</th>
                <th>Khách hàng</th>
                <th>Yêu cầu</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(!empty($listData)){
                foreach ($listData as $key => $value) {
                  echo '<tr>
                          <td>'.date('H:i d/m/Y', $value->create_at).'<br/>ID request<br/>'.$value->id_request_buff.'</td>
                          <td><a href="'.$value->url_page.'" target="_blank">'.$value->id_page.'</a></td>
                          <td>'.$value->info_member->phone.'</td>
                          <td>'.number_format($value->run).'/'.number_format($value->number_up).'</td>
                          <td>'.number_format($value->money).'đ</td>
                          <td>'.$value->status.'</td>
                        </tr>';
                }
              }else{
                echo '<tr><td colspan="10" align="center">Chưa có dữ liệu</td></tr>';
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