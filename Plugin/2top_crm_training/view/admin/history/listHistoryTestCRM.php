<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">LỊCH SỬ THI</h4>
  
  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Sắp xếp theo</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-3">
            <label class="form-label">Điểm số</label>
            <select name="order_by_point" class="form-select color-dropdown">
              <option value="">Không sắp xếp</option>
              <option value="point_z_a" <?php if(!empty($_GET['order_by_point']) && $_GET['order_by_point']=='point_z_a') echo 'selected';?> >Điểm cao đến thấp</option>
              <option value="point_a_z" <?php if(!empty($_GET['order_by_point']) && $_GET['order_by_point']=='point_a_z') echo 'selected';?> >Điểm thấp đến cao</option>
            </select> 
          </div>

          <div class="col-md-3">
            <label class="form-label">Thời gian nộp bài</label>
            <select name="order_by_time_end" class="form-select color-dropdown">
              <option value="">Không sắp xếp</option>
              <option value="time_end_a_z" <?php if(!empty($_GET['order_by_time_end']) && $_GET['order_by_time_end']=='time_end_a_z') echo 'selected';?> >Sớm nhất</option>
              <option value="time_end_z_a" <?php if(!empty($_GET['order_by_time_end']) && $_GET['order_by_time_end']=='time_end_z_a') echo 'selected';?> >Muộn nhất</option>
            </select> 
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
    <h5 class="card-header">Danh sách lịch sử thi</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Bài thi</th>
            <th>Người thi</th>
            <th>Số điểm</th>
            <th>Thời gian thi</th>
            <th>Kết quả</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $name_level = '';
                switch ($item->customer->id_level) {
                  case '1': $name_level = 'Dưới 25tr';break;
                  case '2': $name_level = 'Từ 25 - 130tr';break;
                  case '3': $name_level = 'Từ 130 - 350tr';break;
                  case '4': $name_level = 'Trên 350tr';break;
                }

                $name_parent = '';
                if(!empty($item->customer->name_parent)){
                  $name_parent = 'CEO '.$item->customer->name_parent.'<br/>';
                }

                $status = '<span class="text-danger">Trượt</span>';

                if($item->status == 'pass'){
                  $status = '<span class="text-success">Đỗ</span>';
                }


                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->name_test.'</td>
                        <td>
                          <a href="/plugins/admin/2top_crm-view-admin-customer-addCustomerCRM.php/?id='.$item->customer->id.'">'.$item->customer->full_name.'</a><br/>
                          '.$item->customer->phone.'<br/>
                          '.$item->customer->email.'<br/><br/>

                          '.$name_parent.'
                          '.$name_level.'
                        </td>
                        <td>'.$item->point.'</td>
                        <td>'.date('H:i', $item->time_start).' đến '.date('H:i', $item->time_end).'</td>
                        <td>'.$status.'</td>
                        
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/2top_crm_training-view-admin-history-deleteHistoryTestCRM.php/?id='.$item->id.'">
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
  <!--/ Responsive Table -->
</div>