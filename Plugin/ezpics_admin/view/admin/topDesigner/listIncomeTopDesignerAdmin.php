<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin thu nhập cao nhất</h4>
  <!-- <p><a href="/plugins/admin/tayho360-admin-event-addEventAdmin" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p> -->
  <!-- Responsive Table -->
   <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-2">
            <label class="form-label">Từ ngày</label>
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
  <div class="card row">
    <h5 class="card-header">Thông tin thu nhập cao nhất</h5>
      <p><?php echo @$mess;?></p>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>ảnh</th>
            <th>Thông tin</th>
            <th>Số tiền</th> 
          </tr>
        </thead>

        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $Member = getMember($item->customer_id);
              if($item->status==1){
                  $status = 'đã xử lý';
              }elseif($item->status==2){
                  $status = 'từ chối';
              }else{
                  $status = 'chưa xử lý';
              }

                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td><img src="'.@$item->avatar.'" width="100" height="100" ></td>
                        <td>'.@$item->name.'<br>'.@$item->email.'<br>'.@$item->phone.'</td>
                        <td>'.number_format($item->sold).' đ</td>
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
   <!--  <div class="demo-inline-spacing">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <?php
            if(@$totalPage>0){
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
    </div> -->
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>