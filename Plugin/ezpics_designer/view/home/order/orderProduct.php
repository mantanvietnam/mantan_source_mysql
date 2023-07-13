<?php include(__DIR__.'/../header.php'); ?> 


 <!-- Responsive Table -->
 <div class="card m-4">
    <h5 class="card-header">Lịch sử giao dịch mua hàng - <b class="text-danger"><?php echo number_format($totalData);?></b></h5>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>Code</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
              <!-- <th>Hình thức thanh toán</th> -->
              <th>Thanh toán</th>
              <th>Loại giao dịch</th>
              <th>Ngày giao dịch</th>
              <th>Ghi chú</th>
              <th>Chi tiết</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {

                  $status = '<span class="text-warning">Chưa xử lý</span>';
                  $type = '<span class="text-warning">Mua hàng</span>';
                  
                  if($item->status==2){
                      $status = '<span class="text-success">Đã xử lý</span>';
                  }
                  if($item->type==1){
                      $type = '<span class="text-success">Nạp tiền</span>';
                  }
                  if($item->type==2){
                      $type = '<span class="text-success">Rút tiền</span>';
                  }
                  if($item->type==3){
                      $type = '<span class="text-success">Bán hàng</span>';
                  }
                  if($item->type==4){
                      $type = '<span class="text-success">Xóa ảnh nền</span>';
                  }
                  echo '<tr>
                          <td>
                            '.$item->code.'
                          </td>
                          <td>
                            '.number_format($item->total).' đ
                          </td> 
                          
                          <td>'.$status.'</td>
                          
                          <td align="center">
                            '.$item->meta_payment.'
                          </td>

                          <td align="center">
                          '.$type.'
                          </td>
                          <td>'.date('d/m/Y', strtotime($item->created_at)).'</td>
                          <td>
                            '.$item->note.'
                          </td>
                          <td align="center">
                          <a href="/detailOrder?id='.$item ->id.'"><i class="bx bx-show-alt"></i></a>
                          </td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có lịch sử giao dịch!</td>
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
                   $status = '<span class="text-warning">Chưa xử lý</span>';
                  $type = '<span class="text-warning">Mua hàng</span>';
                  
                  if($item->status==2){
                      $status = '<span class="text-success">Đã xử lý</span>';
                  }
                  if($item->type==1){
                      $type = '<span class="text-success">Nạp tiền</span>';
                  }
                  if($item->type==2){
                      $type = '<span class="text-success">Rút tiền</span>';
                  }
                  if($item->type==3){
                      $type = '<span class="text-success">Bán hàng</span>';
                  }
                  if($item->type==4){
                      $type = '<span class="text-success">Xóa ảnh nền</span>';
                  }
                  echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                          <p><b>Code: </b>
                            '.$item->code.'
                          </p>
                          <p><b>Tổng tiền:</b>
                            '.number_format($item->total).' đ
                          </p> 
                          
                          <p><b>trạng thái: </b>'.$status.'</p>
                          
                          <p><b>Thanh toán: </b>
                            '.$item->meta_payment.'
                          </p>

                          <p><b>Loại giao dịch: </b>
                          '.$type.'
                          </p>
                          <p><b>Ngày giao dịch: </b>'.date('d/m/Y', strtotime($item->created_at)).'</p>
                          <p><bGhi chú:</b>
                            '.$item->note.'
                          </p>
                          <p> 
                          <a style="width:60%;" class="dropdown-item btn btn-primary d-block" href="/detailOrder?id='.$item ->id.'"><i class="bx bx-show-alt"></i>Xem chi tiết</a>
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