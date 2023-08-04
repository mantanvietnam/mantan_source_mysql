<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Giao dịch</h4>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Lịch sử giao dịch</h5>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Thời gian</th>
              <th>Số tiền</th>
              <th>Kiểu</th>
              <th>Nội dung</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  if($item->type == 'minus'){
                    $type = '<p class="text-danger">Trừ tiền</p>';
                  }else{
                    $type = '<p class="text-success">Cộng tiền</p>';
                  }


                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.date('H:i d/m/Y', $item->time).'</td>
                          <td>'.number_format($item->numberCoin).'đ</td>
                          <td>'.$type.'</td>
                          <td>'.$item->note.'</td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có giao dịch nào</td>
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
                  if($item->type == 'minus'){
                    $type = '<span class="text-danger">Trừ tiền</span>';
                  }else{
                    $type = '<span class="text-success">Cộng tiền</span>';
                  }
                  ?>
                    <div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                      <p><b>ID giao dịch:</b> <?php echo @$item->id; ?></p>
                      <p><b>Thời gian:</b> <?php echo date('H:i d/m/Y', $item->time); ?></p>
                      <p><b>Số tiền:</b> <?php echo number_format($item->numberCoin);?>đ</p>
                      <p><b>Kiểu:</b> <?php echo $type;?></p>
                      <p><?php echo $item->note;?></p>
                      
                    </div>
             <?php   }
        }else{
          echo '<div class="col-sm-12 item">
                  <p class="text-danger">Chưa có giao dịch nào</p>
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

<?php include(__DIR__.'/../footer.php'); ?>