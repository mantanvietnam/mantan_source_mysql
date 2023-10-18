<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Khách hàng</h4>
  <p><a href="/addCustomer" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm khách hàng</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Họ tên</label>
            <input type="text" class="form-control" name="full_name" value="<?php if(!empty($_GET['full_name'])) echo $_GET['full_name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php if(!empty($_GET['email'])) echo $_GET['email'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">NV phụ trách</label>
            <select name="id_staff" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php 
                if(!empty($listStaff)){
                  foreach ($listStaff as $key => $value) {
                    if(empty($_GET['id_staff']) || $_GET['id_staff']!=$value->id){
                      echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                    }else{
                      echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                    }
                  }
                }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
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
              <th>Khách hàng</th>
              <th>Điện thoại</th>
              <th>Điểm</th>
              <th>Địa chỉ</th>
              <th>NV phụ trách</th>
              <th>dùng thẻ trả trước</th>
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
                          <td>'.$item->name.'</td>
                          <td>'.$item->phone.'</td>
                          <td>'.number_format($item->point).'</td>
                          <td>'.$item->address.'</td>
                          <td>'.@$listStaff[$item->id_staff]->name.'</td>
                          <td><a href="/listCustomerPrepayCard?id_customer='.$item->id.'">'.$item->Prepaycard.'</a></td>
                          <td align="center">
                            <a class="dropdown-item" href="/addCustomer/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa khách hàng không?\');" href="/deleteCustomer/?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có khách hàng</td>
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