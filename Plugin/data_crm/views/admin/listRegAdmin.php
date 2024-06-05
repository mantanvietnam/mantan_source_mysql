<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Đăng ký Data CRM</h4>

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
            <label class="form-label">Tên hệ thống</label>
            <input type="text" class="form-control" name="system_name" value="<?php if(!empty($_GET['system_name'])) echo $_GET['system_name'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên người đăng ký</label>
            <input type="text" class="form-control" name="boss_name" value="<?php if(!empty($_GET['boss_name'])) echo $_GET['boss_name'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Điện thoại người đăng ký</label>
            <input type="text" class="form-control" name="boss_phone" value="<?php if(!empty($_GET['boss_phone'])) echo $_GET['boss_phone'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="new" <?php if(!empty($_GET['status']) && $_GET['status']=='new') echo 'selected';?> >Mới đăng ký</option>
              <option value="done" <?php if(!empty($_GET['status']) && $_GET['status']=='done') echo 'selected';?> >Đã tạo xong</option>
            </select>
          </div>
          
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>

          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <a href="/updateCodeCRM/?version=4" class="btn btn-danger d-block">Nâng cấp code</a>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách đăng ký</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Thời gian</th>
            <th>Người đăng ký</th>
            <th>Tên miền</th>
            <th>Database</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                if($item->status == 'done'){
                  $link = '<a href="https://'.$item->domain.'" target="_blank">'.$item->domain.'</a>';
                }else{
                  $link = $item->domain;
                }

                $status = $item->status;
                if($item->deadline < time()){
                  $status = '<p class="text-danger"><b>Hết hạn</b></p>';
                }
                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>
                          <p class="text-success">'.date('d/m/Y', $item->create_at).'</p>
                          <p class="text-danger">'.date('d/m/Y', $item->deadline).'</p>
                        </td>
                        <td>
                            '.$item->boss_name.'<br/>
                            '.$item->boss_phone.'<br/>
                            '.$item->boss_email.'
                        </td>
                        <td>'.$link.'</td>
                        <td>
                            '.$item->user_db.'<br/>
                            '.$item->pass_db.'
                        </td>
                        <td>'.$status.'</td>
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