<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Danh sách liên kết</h4>
  <p>
      <a href="/addLink" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a> &nbsp;&nbsp;&nbsp;
      <a href="/addMoney" class="btn btn-danger"><i class='bx bx-plus'></i> Nạp tiền (<?php echo number_format($session->read('infoUser')->coin);?>đ)</a>
  </p>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách link cố định</h5>

    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Tên liên kết</th>
              <th>Link cố định</th>
              <th>Link đích</th>
              <th>Sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {

                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.$item->title.'</td>
                          <td>'.'https://vaozoom.us/'.$item->code.'</td>
                          <td>'.$item->goto.'</td>
                          <td align="center">
                            <a class="dropdown-item" href="/addLink/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteLink/?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có link cố định nào</td>
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
                  ?>
                    <div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                      <p><b><?php echo $item->title; ?></b></p>
                      <p><b>ID:</b> <?php echo $item->id; ?></p>
                      <p><b>Link:</b> <?php echo 'https://vaozoom.us/'.$item->code; ?></p>
                      <p><b>Đích:</b> <?php echo $item->goto; ?></p>

                      <p>
                        <a class="btn btn-primary" href="/addLink/?id=<?php echo $item->id; ?>">
                          <i class="bx bx-edit-alt me-1"></i>
                        </a> &nbsp;&nbsp;&nbsp;

                        <a class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" href="/deleteLink/?id=<?php echo $item->id; ?>">
                          <i class="bx bx-trash me-1"></i>
                        </a>
                      </p>

                    </div>
             <?php   }
        }else{
          echo '<div class="col-sm-12 item">
                  <p class="text-danger">Chưa có link cố định nào</p>
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