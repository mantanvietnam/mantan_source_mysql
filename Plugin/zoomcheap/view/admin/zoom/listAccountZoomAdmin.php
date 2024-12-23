<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin tài khoản zoom</h4> 
  <p><a href="/plugins/admin/zoomcheap-view-admin-zoom-addZoom" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <label class="form-label">Tài khoản</label>
            <input type="text" class="form-control" name="user" value="<?php if(!empty($_GET['user'])) echo $_GET['user'];?>">
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
    <h5 class="card-header">Danh sách tài khoản zoom</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th colpan="2">ID</th>
            <th>Loại tài khoản</th>
            <th>Tài khoản</th>
            <th>Mật khẩu</th>
            <th>Key Host</th>
            <th>ID room</th>
            <th>Pass room</th>
            <th>Sửa</th>
            <th>Xóa</th>
            <th>Video</th>
          </tr>
        </thead>
        <tbody>
        <?php 
                if (!empty($listData)) {
                  foreach ($listData as $item) {
                     
                      
                      echo '<tr>
                              <td>'.$item->id.'</td>
                              <td>'.$item->type.'</td>
                              <td>
                                '.$item->user.'
                                </br>
                                '.$item->status.'
                              </td>
                              <td>'.$item->pass.'</td>
                              <td>'.$item->key_host.'</td>';
                              if (!empty($item->infoRoom->info['id'])) {
                                  echo '<td>'.$item->infoRoom->info['id'].'</td>';
                              }
                              else {
                                echo '<td></td>';
                              }
                              
                              if (!empty($item->infoRoom->info['password'])) {
                                  echo '<td>'.$item->infoRoom->info['password'].'</td>';
                              }  else {
                                echo '<td></td>';
                              }
                      
                      echo '<td align="center">
                              <a class="dropdown-item" href="/plugins/admin/zoomcheap-view-admin-zoom-addZoom/?id='.$item->id.'">
                                <i class="bx bx-edit-alt me-1"></i>
                              </a>
                            </td>
                            <td align="center">
                              <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteZoom/?id='.$item->id.'">
                                <i class="bx bx-trash me-1"></i>
                              </a>
                            </td>
                            <td align="center">
                              <a class="dropdown-item" href="/plugins/admin/zoomcheap-view-admin-zoom-listclound/?id='.$item->id.'">
                                <i class="bx bxs-video"></i>
                              </a>
                            </td>
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