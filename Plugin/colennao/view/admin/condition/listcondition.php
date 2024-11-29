<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Điều kiện bài tập</h4>
  <p><a href="/plugins/admin/colennao-view-admin-condition-addcondition" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Form Search -->
  <!-- <form method="get" action="">
    <div class="card mb-4"> -->
      <!-- <h5 class="card-header">Tìm kiếm dữ liệu</h5> -->
      <!-- <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center"> -->
          <!-- <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div> -->

          <!-- <div class="col-md-3">
            <label class="form-label">Tên condition</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>           -->
          <!-- <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div> -->
        <!-- </div>
      </div>
    </div>
  </form> -->
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách điều kiện bài tập yoga</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>Tên nhóm bài tập</th>
            <th>Tên câu hỏi</th>
            <th>Đáp án</th>
            <th>Trạng thái bài tập</th>
            <th>xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($groupconditiondata as $item => $question): ?>
              <tr>
                  <!-- <td align="center"><?php echo $question['id']; ?></td> -->
                  <td align="center"><?php echo $question['name']; ?></td>
                  <?php 
                      $idGroupFile = [];
                      $questions = [];
                      $answers = [];
                      $abc = [];
                      
                      foreach ($question['data'] as $detail) {
                          $questions[] = $detail['question']; 
                          $answers[] = $detail['answer'];   
                          $abc[] = $detail['status']; 
                          $idGroupFile[] = $detail['id_groupfile'];
                      }

                   
                      $uniqueIdGroupFiles = array_unique($idGroupFile); 
                      $idGroupFiledetail = reset($uniqueIdGroupFiles);
                     
                      $uniqueStatuses = array_unique($abc);
                   
                      $statusString = (count($uniqueStatuses) === 1) ? $uniqueStatuses[0] : implode('; ', $uniqueStatuses);
                      $questionsString = implode('<br>', $questions);
                      $answersString = implode(';', $answers);
                  ?>
                  <td>
                    <p><?php echo $questionsString; ?></p>
                  </td>
                 
                  <td>
                  <p><?php echo $answersString; ?></p>
                  </td>
                  <td>
                      <?php 
                      if ($statusString === 'inactive') {
                          echo 'không phải mặc định';
                      } elseif ($statusString === 'active') {
                          echo 'mặc định';
                      }
                    ?>
                  </td>
                  <td align="center">
                      <a class="dropdown-item" 
                        onclick="return confirm('Bạn có chắc chắn muốn xóa tất cả bản ghi trong nhóm này không?');" 
                        href="/plugins/admin/colennao-view-admin-deletecondition/?id=<?php echo urlencode($idGroupFiledetail); ?>">
                          <i class="bx bx-trash me-1"></i> Xóa nhóm
                      </a>
                  </td>

              </tr>
          <?php endforeach; ?>
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