<script language="javascript" type="text/javascript" src="/plugins/ezpics_admin/view/admin/js/ezpics_admin.js"></script>
<link rel="stylesheet" href="/plugins/ezpics_admin/view/admin/css/ezpics_admin.css" />
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Lịch sử nâng cấp Pro</h4>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
       

          <div class="col-md-2">
            <label class="form-label">SĐT người dùng</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
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
  <div class="card row">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Lịch sử nâng cấp Pro - <b class="text-danger"><?php echo number_format($totalData);?></b> giao dịch</h5>
      </div>
    </div>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Thời gian</th>
              <th>Người dùng</th>
              <th>Tiền</th>
              <th>Ecoin</th>
              <th>Kiểu</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $type = 'Tiền';
                  if($item->type==2){
                    $type= 'Ecoin';
                  }
                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.date('H:i d/m/Y', strtotime($item->created_at)).'</td>
                          
                          <td>
                            '.$item->member->name.'<br/>
                            '.$item->member->phone.'<br/>
                            '.$item->member->email.'
                          </td>
                          <td>'.number_format(@$item->price).'</td>
                          <td>'.number_format(@$item->ecoin).'</td>
                          <td>'.$type.'</td>
                          
                          
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

              echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                          <p><b>ID: </b>'.$item->id.'</p>
                          <p><b>Thời gian: </b>'.date('H:i d/m/Y', strtotime($item->created_at)).'</p>
                          
                          <p><b>Người bán:</b><br/>
                            '.$item->member->name.'<br/>
                            '.$item->member->phone.'<br/>
                            '.$item->member->email.'
                          </p>
                          
                          
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