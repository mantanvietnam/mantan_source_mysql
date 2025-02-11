
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin khách</h4>
  &nbsp;&nbsp;&nbsp;
  <script src="/path/to/bootstrap.bundle.min.js"></script>
  <!-- Responsive Table -->
  <form action="" method="GET">
    <table class="table table-bordered" style="border: 1px solid #ddd!important; margin-top: 10px;">  
      <tbody>
        <tr>
          <td>
            <label>Tên khách hàng </label>
            <input type="text" name="name" class="form-control" placeholder="Tên khách hàng" value="">
          </td>
          <td>
            <label>ID</label>
            <input type="text" name="id" class="form-control" placeholder="id" value="<?php echo htmlspecialchars(@$_GET['id'], ENT_QUOTES, 'UTF-8'); ?>">
          </td>
          <td>
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" value="<?php echo htmlspecialchars(@$_GET['phone'], ENT_QUOTES, 'UTF-8'); ?>">
          </td>
            <td>
                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo htmlspecialchars(@$_GET['email'], ENT_QUOTES, 'UTF-8'); ?>">
          <td>
            <br>
            <input type="submit" name="" style="margin-top: 7px;" value="Tìm kiếm">
          </td>
        </tr>
      </tbody>
    </table>
  </form>
  <div class="card">
    <h5 class="card-header">Danh sách Thông tin Khách Hàng</h5>
    <p><?php echo $mess; ?></p>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Họ Tên</th>
            <th>Ngày Sinh</th>
            <th>Giờ Sinh</th>
            <th>Múi Giờ</th>
            <th>Giới Tính</th>
            <th>Tháng Xem</th>
            <th>Kiểu Lịch</th>
            <th>Email</th>
            <th>Số Điện Thoại</th>
          
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              global $controller;
              // đây là data  `id` INT AUTO_INCREMENT PRIMARY KEY,
   // `full_name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    //`birth_date` DATE NOT NULL,
    //`birth_time` TIME NOT NULL,
    //`timezone` VARCHAR(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'GMT+7',
    //`gender` ENUM('Nam', 'Nữ') COLLATE utf8mb4_unicode_ci NOT NULL,
    //`view_year` INT NOT NULL,
    //`view_month` INT NOT NULL,
    //`calendar_type` ENUM('Dương', 'Âm') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dương',
   // `email` VARCHAR(255) COLLATE utf8mb4_unicode_ci UNIQUE NOT NULL,
    //`phone_number` VARCHAR(15) COLLATE utf8mb4_unicode_ci UNIQUE NOT NULL,
              foreach ($listData as $item) {
                echo '<tr>
                        <td>'.htmlspecialchars($item->id, ENT_QUOTES, 'UTF-8').'</td>
                        <td>'.htmlspecialchars($item->full_name, ENT_QUOTES, 'UTF-8').'</td>
                        <td>'.htmlspecialchars($item->birth_date, ENT_QUOTES, 'UTF-8').'</td>
                        <td>'.htmlspecialchars($item->birth_time, ENT_QUOTES, 'UTF-8').'</td>
                        <td>'.htmlspecialchars($item->timezone, ENT_QUOTES, 'UTF-8').'</td>
                        <td>'.htmlspecialchars($item->gender, ENT_QUOTES, 'UTF-8').'</td>
                        <td>'.htmlspecialchars($item->view_month, ENT_QUOTES, 'UTF-8').'</td>
                        <td>'.htmlspecialchars($item->calendar_type, ENT_QUOTES, 'UTF-8').'</td>
                        <td>'.htmlspecialchars($item->email, ENT_QUOTES, 'UTF-8').'</td>
                        <td>'.htmlspecialchars($item->phone_number, ENT_QUOTES, 'UTF-8').'</td>
                      </tr>';
              }
            } else {
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
            if($totalPage > 0){
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
                        <a class="page-link" href="'.htmlspecialchars($urlPage.'1', ENT_QUOTES, 'UTF-8').'">
                          <i class="tf-icon bx bx-chevrons-left"></i>
                        </a>
                      </li>';
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $active = ($page == $i) ? 'active' : '';

                    echo '<li class="page-item '.$active.'">
                            <a class="page-link" href="'.htmlspecialchars($urlPage.$i, ENT_QUOTES, 'UTF-8').'">'.$i.'</a>
                          </li>';
                }

                echo '<li class="page-item last">
                        <a class="page-link" href="'.htmlspecialchars($urlPage.$totalPage, ENT_QUOTES, 'UTF-8').'">
                          <i class="tf-icon bx bx-chevrons-right"></i>
                        </a>
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