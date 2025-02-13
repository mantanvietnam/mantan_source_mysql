<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cơ sở SPA</h4>

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
            <label class="form-label">Tên cơ sở</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
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
      <h5 class="card-header">Danh sách mẫu thiết kế - <b class="text-danger"><?php echo number_format($totalData);?></b> mẫu</h5>

      <div class="card-body row">
        <p><?php echo @$mess;?></p>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th>ID</th>
                <th>Tên cơ sở</th>
                <th>Chủ cơ sở</th> 
                <th>Ngày tạo</th> 
                <th>Xoá dữ liệu</th>
                <th>sửa</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                if(!empty($listData)){
                  foreach ($listData as $item) {
                     

                    echo '<tr>
                            <td>'.$item->id.'</td>
                            <td>'.$item->name.'</td>
                            <td>
                               '.$item->member->name.'<br/>
                              '.$item->member->phone.'<br/>
                              '.$item->member->email.'
                              
                            </td>
                            <td>'.date('d/m/Y', $item->created_at).'</td>
                            <td><a onclick="return confirm(\'Bạn có chắc chắn muốn xoá dữ liệu của cơ sở này không? Các dữ liệu cài đặt vẫn sẽ được giữ lại.\');" class="btn btn-danger" href="/plugins/admin/databot_spa-view-admin-spa-clearDataSpaAdmin/?id='.$item->id.'">Xoá</a></td>
                            <td align="center">
                              <a class="dropdown-item"  href="/plugins/admin/databot_spa-view-admin-spa-addSpaAdmin/?id='.$item->id.'">
                                <i class="bx bx-edit-alt me-1"></i>
                              </a>
                            </td>
                          </tr>';
                  }
                }else{
                  echo '<tr>
                          <td colspan="10" align="center">Chưa có mẫu thiết kế</td>
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
