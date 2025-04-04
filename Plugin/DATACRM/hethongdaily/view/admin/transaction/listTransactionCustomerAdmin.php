
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Giao dịch khách hàng</h4>

  <!-- Responsive Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Giao dịch khách hàng</h5>
      </div>
    </div>

    <div class="card-body row">
      <p><?php echo @$mess;?></p>  
      <div id="desktop_view">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th>ID</th>
                <th>Thông tin khách hàng</th>
                <th>tiền </th>
                <th>Nộ dung giao dịch </th>
                <th>Nội dung </th>
                <th>Kiểu giao dịch </th>
                <th>Phưng thức giao dich</th>
                <th>trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                if(!empty($listData)){
                  foreach ($listData as $item) {
                  // debug($item);

                    $status = '<span class="text-danger">Đã thanh toán </span>';
                    $info_customer = '';
                  if(!empty($item->info_customer)){
                    $info_customer = $item->info_customer->full_name.'</a><br/>
                  '.$item->info_customer->phone.'<br/>
                  '.$item->info_customer->address.'<br/>
                  '.$item->info_customer->email;
                  }
                    if($item->status == 'new'){
                      $status = '<span class="text-success">Chưa thanh toán</span>';
                    }

                    $type_histories = '';
                     if($item->type_histories == 'package'){
                      $type_histories = '<span class="text-success">Mua gói tập</span>';
                    }elseif($item->type_histories == 'up_like'){
                        $type_histories = '<span class="text-danger">Tăng tương tác</span>';
                    }

                    echo '<tr>
                            <td>'.$item->id.'
                            <br/>'.date('H:i d/m/Y', $item->time_start).'</td>
                            <td>'.$info_customer.'</td>
                            <td>'.$item->coin.'</td>
                            <td>'.$item->meta_payment.'</td>
                            <td>'.$item->note.'</td>
                            <td>'.$type_histories.'</td>
                            <td>'.$item->payment_type.'</td>
                            <td>'.$status.'</td>
                          </tr>';
                  }
                }else{
                  echo '<tr>
                          <td colspan="10" align="center">Chưa làm bài thi</td>
                        </tr>';
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
