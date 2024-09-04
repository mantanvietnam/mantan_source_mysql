<?php include(__DIR__.'/../../../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">BÀI THI</h4>
  <p><a href="/addTestAgency" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

   <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">     
          <div class="col-md-3">
            <label class="form-label">Tên khóa học</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Danh mục</label>
            <select name="id_course" class="form-control">
              <option value="">Tất cả</option>
              <?php
                if(!empty($category)){
                  foreach($category as $item){
                    if(empty($_GET['id_course']) || $_GET['id_course']!=$item->id){
                      echo '<option value="'.$item->id.'">'.$item->title.'</option>';
                    }else{
                      echo '<option selected value="'.$item->id.'">'.$item->title.'</option>';
                    }
                  }
                }
              ?>
            </select>
          </div>

          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>

          <!-- <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div> -->
        </div>
      </div>
    </div>
  </form>
  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Bài thi</h5>
    <?php echo @$mess; ?>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Tên Khóa học</th>
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
                          <td>'.$item->name_course.'</td>
                          <td><a href="/test/'.$item->slug.'.html">'.$item->title.'</a></td>
                          <td>'.$time_test.'</td>
                          <td><a href="/listQuestionAgency/?id_test='.$item->id.'">'.$item->question.' câu hỏi</a></td>
                          <td>'.$item->status.'</td>
                          <td align="center">
                            <a class="dropdown-item" href="addTestAgency?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteTestAgency?id='.$item->id.'">
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
     </div>
    <div id="mobile_view" >
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
                  echo '<p><strong>ID:</strong> '.$item->id.'</p>
                          <p><strong>Khóa học:</strong> '.$item->name_course.'</p>
                          <p><strong>Tên bài học:</strong><a href="/test/'.$item->slug.'.html">'.$item->title.'</a></p>
                          <p><strong>Số câu hỏi:</strong> <a href="/listQuestionAgency/?id_test='.$item->id.'">'.$item->question.' câu hỏi</a></p>
                          <p><strong>Trạng thái:</strong> '.$item->status.'</p>
                          <p><strong>Thời gian:</strong> '.$time_test.'</p>
                          <p align="center">
                            <a class="btn btn-success" href="/addTestAgency/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                            <a class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteTestAgency?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </p>';
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
<?php include(__DIR__.'/../../../footer.php'); ?>