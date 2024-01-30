<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Lịch sử thi</h4>

  <!-- Responsive Table -->
  <div class="card">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Lịch sử thi</h5>
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
                <th>Bài thi</th>
                <th>Điểm</th>
                <th>Số câu đúng</th>
                <th>Số câu hỏi</th>
                <th>Thời gian thi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                if(!empty($listData)){
                  foreach ($listData as $item) {

                    echo '<tr>
                            <td>'.$item->id.'</td>
                            <td>'.$item->name_test.'</td>
                            <td>'.$item->point.'</td>
                            <td>'.$item->total_true.'</td>
                            <td>'.$item->number_question.'</td>
                            <td>'.date('H:i d/m/Y', $item->time_start).'</td>
                            
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

<?php include(__DIR__.'/../footer.php'); ?>