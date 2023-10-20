<?php include(__DIR__ . '/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Sản phẩm</h4>
  <p><a href="/addProduct" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a> <a
      href="/addProductWarehouse" class="btn btn-danger"><i class='bx bx-plus'></i>Nhập hàng vào kho </a></p>
  <?php echo $mess; ?>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-2">
            <label class="form-label">Mã sản phẩm</label>
            <input type="text" class="form-control" name="code"
              value="<?php if (!empty($_GET['code']))
                echo $_GET['code']; ?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" name="name"
              value="<?php if (!empty($_GET['name']))
                echo $_GET['name']; ?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Danh mục</label>
            <select name="id_category" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php
              if (!empty($listCategory)) {
                foreach ($listCategory as $key => $value) {
                  if (empty($_GET['id_category']) || $_GET['id_category'] != $value->id) {
                    echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                  } else {
                    echo '<option selected value="' . $value->id . '">' . $value->name . '</option>';
                  }
                }
              }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="active" <?php if (!empty($_GET['status']) && $_GET['status'] == 'active')
                echo 'selected'; ?>>
                Hiển thị </option>
              <option value="lock" <?php if (!empty($_GET['status']) && $_GET['status'] == 'lock')
                echo 'selected'; ?>>Khóa
              </option>
            </select>
          </div>



          <div class="col-md-2">
            <label class="form-label">Nhãn hiệu</label>
            <select name="id_trademark" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php
              if (!empty($listTrademar)) {
                foreach ($listTrademar as $key => $value) {
                  if (empty($_GET['id_trademark']) || $_GET['id_trademark'] != $value->id) {
                    echo '<option value="' . $value->id . '">' . $value->name . '</option>';
                  } else {
                    echo '<option selected value="' . $value->id . '">' . $value->name . '</option>';
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
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách Sản phẩm</h5>

    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="" style="text-align: center;">
              <th>Mã sản phẩm</th>
              <th>Ảnh </th>
              <th>Tên sản phẩm</th>
              <th>Số lượng</th>
              <th>Giá bán</th>
              <th>Hoa hồng</th>
              <th>Trạng thái</th>
              <th>Sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($listData)) {
              foreach ($listData as $item) {


                if ($item->status == 'active') {
                  $status = 'Hiển thị';
                } elseif ($item->status == 'lock') {
                  $status = '<span class="text-danger">Khóa</span>';
                }

                if (!empty($item->commission_staff_fix)) {
                  $staff = '<p>Nhân viên: ' . number_format($item->commission_staff_fix) . 'đ</p>';
                } else {
                  $staff = '<p>Nhân viên: ' . $item->commission_staff_percent . '%</p>';
                }

                if (!empty($item->commission_affiliate_fix)) {
                  $affiliate = '<p>Giới thiệu: ' . number_format($item->commission_affiliate_fix) . 'đ</p>';
                } else {
                  $affiliate = '<p>Giới thiệu: ' . $item->commission_affiliate_percent . '%</p>';
                }

                echo '<tr>
                          <td>
                                 ' . $item->code . '<br/>
                          </td>
                          <td>
                            <img src="' . $item->image . '" width="100" />
                          </td>
                         
                          <td>' . $item->name . '<br/></td>

                          <td>
                            ' . number_format($item->quantity) . '
                          </td>

                          <td>
                            ' . number_format($item->price) . 'đ
                          </td>
                          <td>
                            ' . $staff . '
                            ' . $affiliate . '
                          </td>
                          <td>' . $status . '</td>
                          
                          <td align="center">
                             <a  class="dropdown-item" href="/addProduct?id=' . $item->id . '" title="">
                              <i class="bx bx bx-edit-alt me-1"></i>
                            </a>
                          </td>

                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa sản phẩm không?\');" href="/deleteProduct/?id=' . $item->id . '">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </td>
                        </tr>';
              }
            } else {
              echo '<tr>
                        <td colspan="10" align="center">Chưa có sản phẩm nào</td>
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
          if ($totalPage > 0) {
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
                        <a class="page-link" href="' . $urlPage . '1"
                          ><i class="tf-icon bx bx-chevrons-left"></i
                        ></a>
                      </li>';

            for ($i = $startPage; $i <= $endPage; $i++) {
              $active = ($page == $i) ? 'active' : '';

              echo '<li class="page-item ' . $active . '">
                            <a class="page-link" href="' . $urlPage . $i . '">' . $i . '</a>
                          </li>';
            }

            echo '<li class="page-item last">
                        <a class="page-link" href="' . $urlPage . $totalPage . '"
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
<?php include(__DIR__ . '/../footer.php'); ?>