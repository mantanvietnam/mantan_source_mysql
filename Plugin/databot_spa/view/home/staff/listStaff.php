<?php include(__DIR__ . '/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Nhân viên</h4>
  <p><a href="/addStaff" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if (!empty($_GET['id']))
              echo $_GET['id']; ?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Họ tên</label>
            <input type="text" class="form-control" name="name" value="<?php if (!empty($_GET['name']))
              echo $_GET['name']; ?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if (!empty($_GET['phone']))
              echo $_GET['phone']; ?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php if (!empty($_GET['email']))
              echo $_GET['email']; ?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Nhóm nhân viên</label>
            <select name="id_group" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php
              if (!empty($listCategory)) {
                foreach ($listCategory as $key => $value) {
                  if (empty($_GET['id_group']) || $_GET['id_group'] != $value->id) {
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
            <select class="form-select" name="status" id="status">
              <option value="">Tất cả</option>
              <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1')
                echo 'selected'; ?>>Kích hoạt
              </option>
              <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0')
                echo 'selected'; ?>>Khóa
              </option>
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
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Danh sách nhân viên</h5>
      </div>
      <p>
        <?php echo @$mess; ?>
      </p>
    </div>

    <div class="card-body row" style="padding-top: 0;">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Tên nhân viên</th>
              <th>Số điện thoại</th>
              <th>Email</th>
              <th>Nhóm nhân viên</th>
              <th>Trạng thái</th>
              <th>Đổi mật khẩu</th>
              <th>Sửa</th>
              <th>Khóa</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($listData)) {
              foreach ($listData as $item) {
                $group = $modelCategories->get($item->id_group);
                $status = 'Kích hoạt <br/>';
                $button = '<a class="dropdown-item" title="Khóa"  onclick="return confirm(\'Bạn có chắc chắn muốn khóa nhân viên này không?\');" href="/lockStaff?id=' . $item->id . '&status=0">
                              <i class="bx bx-lock-open"></i> </a>';
                if ($item->status == 0) {
                  $status = 'Khóa';
                  $button = '<a class="dropdown-item" title="Kích hoạt" onclick="return confirm(\'Bạn có chắc chắn muốn Kích hoạt nhân viên này không?\');" href="/lockStaff?id=' . $item->id . '&status=1">
                              <i class="bx bx-lock"></i> </a>';

                }

                echo '<tr>
                          <td>' . $item->id . '</td>
                          <td>' . $item->name . ' </td>
                          <td>' . $item->phone . '</td>
                          <td>' . $item->email . '</td>
                          <td>' . @$group->name . '</td>
                          <td>' . $status . '</td>
                         
                          <td align="center">
                            <a class="dropdown-item" href="/changePassStaff?id=' . $item->id . '">
                              <i class="bx bx-transfer"></i>
                            </a>
                          </td>

                          <td align="center">
                            <a class="dropdown-item" href="/addStaff?id=' . $item->id . '">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>

                          <td align="center">' . $button . '</td>
                        </tr>';
              }
            } else {
              echo '<tr>
                        <td colspan="10" align="center">Chưa có nhân viên</td>
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
          if (@$totalPage > 0) {
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