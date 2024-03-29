<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Khách hàng</h4>
  <p><a href="/addMedicalHistories/?id_customer=<?php echo @$dataCustomer->id ?>" class="btn btn-primary" ><i class='bx bx-plus'></i> Thêm mới tiến án khám bện</a> </p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">thông tin khách hàng</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-6">
            <label class="form-label">Họ tên: </label><span>&emsp; <?php echo @$dataCustomer->name ?></span>
          </div>
          <div class="col-md-6">
            <label class="form-label">Điện thoại: </label><span>&emsp; <?php echo @$dataCustomer->phone ?></span>
          </div>
          <div class="col-md-6">
            <label class="form-label">địa chỉ: </label><span>&emsp; <?php echo @$dataCustomer->address ?></span>
          </div>
            <div class="col-md-6">
            <label class="form-label">Email: </label><span>&emsp; <?php echo @$dataCustomer->email ?></span>
          </div>
         
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách khách hàng</h5>
    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Ảnh đại điện</th>
              <th>Khách hàng</th>
              <th>Email</th>
              <th>Điểm</th>
              <th>NV phụ trách</th>
              <th>Thẻ thành viên</th>
              <th>Sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
    </div>


    <!-- Phân trang -->
    <div class="demo-inline-spacing">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <?php
            if(@$totalPage>0){
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