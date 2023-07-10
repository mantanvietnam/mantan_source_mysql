<script language="javascript" type="text/javascript" src="/plugins/ezpics_admin/view/admin/js/ezpics_admin.js"></script>
<link rel="stylesheet" href="/plugins/ezpics_admin/view/admin/css/ezpics_admin.css" />
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Giao dịch</h4>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-2">
            <label class="form-label">Mã giao dịch</label>
            <input type="text" class="form-control" name="code" value="<?php if(!empty($_GET['code'])) echo $_GET['code'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">SĐT người dùng</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="1" <?php if(!empty($_GET['status']) && $_GET['status']=='1') echo 'selected';?> >Chưa xử lý</option>
              <option value="2" <?php if(!empty($_GET['status']) && $_GET['status']=='2') echo 'selected';?> >Đã xử lý</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Tạo từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Đến ngày</label>
            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
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
        <h5 class="card-header">Giao dịch bán kho mẫu thiết kế - <b class="text-danger"><?php echo number_format($totalData);?></b> giao dịch</h5>
      </div>
      <div class="col-md-6">
        <h5 class="card-header" style="float: right;">Tổng số tiền là   <b class="text-danger"><?php echo number_format($totalMoney);?></b> đ</h5>
      </div>
    </div>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Thời gian</th>
              <th>Mã giao dịch</th>
              <th>Số tiền</th>
              <th>Người bán</th>
              <th>Kho mẫu thiết kế</th>
              <th>Nội dung</th>
              <th>Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $status = '<span class="text-danger">Chưa xử lý</span>';
                  if($item->status==2){
                    $status = '<span class="text-success">Đã xử lý</span>';
                  }

                  $warehouses = '';
                  if(!empty($item->warehouses)){
                    $warehouses = '<img src="'.$item->warehouses->thumbnail.'"  style= "width: 100%"  /><br/>ID: '.$item->warehouses->id.'<br/>Tên kho: '.$item->warehouses->name;
                  }

                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.date('H:i d/m/Y', strtotime($item->created_at)).'</td>
                          <td>'.$item->code.'</td>
                          <td>'.number_format($item->total).'</td>
                          
                          <td>
                            '.$item->member->name.'<br/>
                            '.$item->member->phone.'<br/>
                            '.$item->member->email.'
                          </td>
                          
                          <td>'.$warehouses.'</td>
                          <td>'.$item->note.'</td>

                          <td>'.$status.'</td>
                          
                          
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có giao dịch</td>
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
              $status = '<span class="text-danger">Chưa xử lý</span>';
              if($item->status==2){
                $status = '<span class="text-success">Đã xử lý</span>';
              }
              $warehouses = '';
                if(!empty($item->warehouses)){
                  $warehouses = '<img src="'.$item->warehouses->thumbnail.'" style="width:100%;" /><br/>ID: '.$item->warehouses->id;
                }



              echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                          <p><b>ID: </b>'.$item->id.'</p>
                          <p><b>Thời gian: </b>'.date('H:i d/m/Y', strtotime($item->created_at)).'</p>
                          <p><b>Mã giao dịch: </b>'.$item->code.'</p>
                          <p><b>Số tiền: </b>'.number_format($item->total).'</p>
                          
                          <p><b>Người bán:</b><br/>
                            '.$item->member->name.'<br/>
                            '.$item->member->phone.'<br/>
                            '.$item->member->email.'
                          </p>
                           <p><b>Kho</b><br/>
                            '.$warehouses.'
                           </p>
                          <p><b>Nội dung: </b>'.$item->note.'</p>
                          <p><b>Trạng thái: </b>'.$status.'</p>
                          
                          
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