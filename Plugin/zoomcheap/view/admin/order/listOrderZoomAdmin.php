<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin Đơn hàng thuê Zoom</h4> 

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
    <h5 class="card-header">Danh sách Đơn hàng thuê Zoom</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Loại Zoom</th>
            <th>Thời gian thuê</th>
            <th>Khách hàng</th>
            <th>Tài khoản Zoom</th>
            <th>Phòng họp</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){

              foreach ($listData as $item) {
              echo  '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->type.'</td>
                        <td>
                          <p>'.date("Y-m-d H:i:s",$item->dateStart).'</p>
                          <p>'.date("Y-m-d H:i:s",$item->dateEnd).'</p>
                        </td>
                        <td>
                          '.$item->infoManager->fullname.'
                          </br>
                          '.$item->infoManager->phone.'
                          </br>
                          '.$item->infoManager->email.'
                          </br>
                          '.number_format($item->infoManager->coin).' đ
                        </td>
                        <td>
                          <p>Tài khoản: '.@$item->infoZoom->user.'</p>
                          <p>Mật khẩu: '.@$item->infoZoom->pass.'</p>
                          <p>Key host: '.@$item->infoZoom->key_host.'</p>
                        </td>
                        <td>
                          <p>ID: '.@$item->infoRoom->info['id'].'</p>
                          <p>Mật khẩu: '.@$item->infoRoom->info['password'].'</p>
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