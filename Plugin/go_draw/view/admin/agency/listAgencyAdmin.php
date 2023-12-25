<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Đại lý</h4>
    <p><a href="/plugins/admin/go_draw-view-admin-agency-viewDetailAgencyAdmin" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

    <!-- Form Search -->
    <form method="get" action="">
        <div class="card mb-4">
            <h5 class="card-header">Tìm kiếm dữ liệu</h5>
            <div class="card-body">
                <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-1">
                        <label class="form-label">ID</label>
                        <input type="text" class="form-control" name="id"
                               value="<?php if (!empty($_GET['id'])) echo $_GET['id']; ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tên đại lý</label>
                        <input type="text" class="form-control" name="name"
                               value="<?php if (!empty($_GET['name'])) echo $_GET['name']; ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone"
                               value="<?php if (!empty($_GET['phone'])) echo $_GET['phone']; ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" name="address"
                               value="<?php if (!empty($_GET['address'])) echo $_GET['address']; ?>">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') echo 'selected'; ?> >Kích hoạt
                            </option>
                            <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0') echo 'selected'; ?> >Khóa
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--/ Form Search -->

    <!-- Responsive Table -->
    <div class="card row">
        <h5 class="card-header">Danh sách đại lý</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr class="">
                    <th>ID</th>
                    <th>Tên đại lý</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Sửa</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($listData)) {
                    foreach ($listData as $item) {
                        if ($item->status == 1) {
                            $status = '
                  <a class="btn btn-success"  title="Khóa tài khoản" 
                    onclick="return confirm(\'Bạn có chắc chắn muốn khóa đại lý không?\');"
                    href="/plugins/admin/go_draw-view-admin-agency-updateStatusAgencyAdmin/?id=' . $item->id . '&status=0"
                  >
                           <i class="bx bx-lock-open-alt me-1" style="font-size: 22px;"></i>
                  </a><br/>Đã kích hoạt ';
                        } else {
                            $status = '
                  <a class=" btn btn-danger"  title="Kích hoạt tài khoản" 
                    onclick="return confirm(\'Bạn có chắc chắn muốn kích hoạt đại lý không?\');" 
                    href="/plugins/admin/go_draw-view-admin-agency-updateStatusAgencyAdmin/?id=' . $item->id . '&status=1"
                  >
                           <i class="bx bx-lock-alt me-1" style="font-size: 22px;"></i>
                  </a><br/> Đã khóa ';
                        }

                        echo '<tr>
                        <td align="center">' . $item->id . '</td>
                        <td>' . $item->name . '</td>
                        <td>
                          ' . $item->address . '
                        </td>
                        <td>
                          ' . $item->phone . '
                        </td>
                        <td> 
                        <p align="center">
                        <a class="btn btn-primary" 
                          href="/plugins/admin/go_draw-view-admin-agency-viewDetailAgencyAdmin/?id=' . $item->id . '"
                        >
                          <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                        </a>
                        </p>

                        <td align="center">' . $status . '</td>
                        
                      </td>

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
                    if (isset($totalPage) && isset($page) && isset($urlPage)) {
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
                    }
                    ?>
                </ul>
            </nav>
        </div>
        <!--/ Basic Pagination -->
    </div>
    <!--/ Responsive Table -->
</div>