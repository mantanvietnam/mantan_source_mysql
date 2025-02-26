<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">Quản lý Cộng Tác Viên</h4>

  <p><a href="/plugins/admin/tuvi-view-admin-collaborator-editCollaboratorAdmin" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm Cộng Tác Viên</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-2">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if (!empty($_GET['id'])) echo $_GET['id']; ?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Tên CTV</label>
            <input type="text" class="form-control" name="name" value="<?php if (!empty($_GET['name'])) echo $_GET['name']; ?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if (!empty($_GET['phone'])) echo $_GET['phone']; ?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="<?php if (!empty($_GET['email'])) echo $_GET['email']; ?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select">
              <option value="">Tất cả</option>
              <option value="1" <?php if (!empty($_GET['status']) && $_GET['status'] == '1') echo 'selected'; ?>>Hoạt động</option>
              <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0') echo 'selected'; ?>>Không hoạt động</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>

          <!-- <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div> -->
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách Cộng Tác Viên</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Hình ảnh</th>
            <th>Thông tin</th>
            <th>Hoạt động</th>
            <th>Thống kê</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if (!empty($listData)) {
            foreach ($listData as $item) {
              $link_tuvi = "/registerform/?ref=".$item->phone;
              $bac_ctv = ($item->level == 2) ? 'Bậc 2' : 'Bậc 1';
              $nguoi_gioi_thieu = ($item->level == 2 && !empty($item->referrer_name)) ? '<br/><strong>Người giới thiệu:</strong> ' . $item->referrer_name : '';

              echo '<tr>
              <td>'.$item->id.'</td>

              <td><img src="'.$item->image.'" alt="'.$item->name.'" width="80"></td>

              <td>
                <strong>'.$item->name.'</strong><br/>
                '.$item->phone.'<br/>
                '.$item->email.'<br/>
                <span class="badge bg-info">'.$bac_ctv.'</span> '.$nguoi_gioi_thieu.'<br/>
                <a target="_blank" href="'.$link_tuvi.'" class="text-primary">Link đăng ký tử vi</a>
              </td>

              <td>'.(($item->status == 1) ? '<span class="text-success">Hoạt động</span>' : '<span class="text-danger">Không hoạt động</span>').'</td>

              <td>
                <a href="/plugins/admin/order-listOrderAdmin/?id_ctv='.$item->id.'">Đã bán được '.number_format($item->number_order).' đơn hàng</a>
                <br/>
                <a href="/plugins/admin/customer-listCustomerAdmin/?id_ctv='.$item->id.'">Đã giới thiệu '.number_format($item->number_customer).' khách hàng</a>
              </td>

              <td align="center">
                <a class="dropdown-item" href="/plugins/admin/tuvi-view-admin-collaborator-editCollaboratorAdmin/?id='.$item->id.'">
                  <i class="bx bx-edit-alt me-1"></i>
                </a>
              </td>

              <td align="center">
                <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteCollaboratorAdmin/?id='.$item->id.'">
                  <i class="bx bx-trash me-1"></i>
                </a>
              </td>
              </tr>';
            }
          } else {
            echo '<tr>
            <td colspan="7" align="center">Chưa có dữ liệu</td>
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
          if (@$totalPage > 0) {
            if ($page > 5) {
              $startPage = $page - 5;
            } else {
              $startPage = 1;
            }

            if (@$totalPage > $page + 5) {
              $endPage = $page + 5;
            } else {
              $endPage = $totalPage;
            }

            echo '<li class="page-item first">
            <a class="page-link" href="'.$urlPage.'1">
              <i class="tf-icon bx bx-chevrons-left"></i>
            </a>
            </li>';

            for ($i = $startPage; $i <= $endPage; $i++) {
              $active = ($page == $i) ? 'active' : '';
              echo '<li class="page-item '.$active.'">
              <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
              </li>';
            }

            echo '<li class="page-item last">
            <a class="page-link" href="'.$urlPage.$totalPage.'">
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
