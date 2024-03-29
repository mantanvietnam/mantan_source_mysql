<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><a href="/plugins/admin/utm-admin-chartUtmAdmin">Thống kê </a> / Thông tin nguồn khách vào</h4>
  <!--  -->
  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-3">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">utm_source</label>
            <input type="text" class="form-control" name="utm_source" value="<?php if(!empty($_GET['utm_source'])) echo $_GET['utm_source'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">utm_medium</label>
            <input type="text" class="form-control" name="utm_medium" value="<?php if(!empty($_GET['utm_medium'])) echo $_GET['utm_medium'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">utm_campaign</label>
            <input type="text" class="form-control" name="utm_campaign" value="<?php if(!empty($_GET['utm_campaign'])) echo $_GET['utm_campaign'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">utm_id</label>
            <input type="text" class="form-control" name="utm_id" value="<?php if(!empty($_GET['utm_id'])) echo $_GET['utm_id'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">utm_term</label>
            <input type="text" class="form-control" name="utm_term" value="<?php if(!empty($_GET['utm_term'])) echo $_GET['utm_term'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">utm_content</label>
            <input type="text" class="form-control" name="utm_content" value="<?php if(!empty($_GET['utm_content'])) echo $_GET['utm_content'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tạo từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Đến ngày</label>
            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
          </div>

         
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>
          <div class="col-md-3">
            <label class="form-label">&nbsp;</label>
            <p style="margin-bottom: 0px;"><a href="/plugins/admin/utm-admin-listUtmAdmin" class="btn btn-primary"> Xem Tất cả </a></p>
          </div>
          
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->
  <!-- Responsive Table -->
  <div class="card row">
    <div class="row">
      <div class="col-md-6">
       <h5 class="card-header">Danh sách Thông tin nguồn khách vào</h5>
      </div>
      <div class="col-md-6">
        <h5 class="card-header" style="float: right;">Số lượng <?php echo $totalData ?> lượng truy cập</h5>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
             <th>ID</th>
            <th>utm_source</th>
            <th>utm_medium</th>
            <th>utm_campaign</th>
            <th>utm_id</th>
            <th>utm_term</th>
            <th>utm_content</th>
            <th>ngày</th>
            <!-- <th>Sửa</th> -->
            <!-- <th>Xóa</th>  -->
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->utm_source.'</td>
                        <td>'.$item->utm_medium.'</td>
                        <td>'.$item->utm_campaign.'</td>
                        <td>'.$item->utm_id.'</td>
                        <td>'.$item->utm_term.'</td>
                        <td>'.$item->utm_content.'</td>
                        <td>'.$item->created_at->format('d/m/Y H:i').'</td>
                        
                        
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

<!-- <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/feedback-admin-addFeedbackAdmin/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/feedback-admin-deleteFeedbackAdmin/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td> -->