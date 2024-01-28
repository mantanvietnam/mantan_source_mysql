<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">2TOP CRM - BÀI THI</h4>
  <p><a href="/plugins/admin/2top_crm_training-view-admin-test-addTestCRM.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Bài thi</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Tên bài thi</th>
            <th>Thời gian thi</th>
            <th>Số câu hỏi</th>
            <th>Trạng thái</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $minute = $item->time_test%60;
                $hour = ($item->time_test - $minute)/60;

                $time_test = '';
                if($hour>0){
                  $time_test .= $hour.' giờ ';
                }

                if($minute>0){
                  $time_test .= $minute.' phút';
                }

                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td><a href="/test/'.$item->slug.'.html">'.$item->title.'</a></td>
                        <td>'.$time_test.'</td>
                        <td><a href="/plugins/admin/2top_crm_training-view-admin-question-listQuestionCRM.php/?id_test='.$item->id.'">'.$item->question.' câu hỏi</a></td>
                        <td>'.$item->status.'</td>
                        <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/2top_crm_training-view-admin-test-addTestCRM.php/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/2top_crm_training-view-admin-test-deleteTestCRM.php/?id='.$item->id.'">
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