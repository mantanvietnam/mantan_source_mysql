<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Địa chỉ</h4>
    <p><a href="/plugins/admin/2top_crm-view-admin-address-addAddress.php/?id_customer=<?php echo (int)$_GET['id_customer']?>" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới địa chỉ</a></p>

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

                    <div class="col-md-3">
                        <label class="form-label">Tên địa chỉ</label>
                        <input type="text" class="form-control" name="address_name" value="<?php if (!empty($_GET['address_name']))
                            echo $_GET['address_name']; ?>">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Trạng thái</label>
                        <select name="address_type" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <option value="Mặc định" <?php if (!empty($_GET['address_type']) && $_GET['address_type'] == '1')
                                echo 'selected'; ?>>
                                Kích hoạt</option>
                            <option value="Khóa" <?php if (!empty($_GET['address_type']) && $_GET['address_type'] == '0')
                                echo 'selected'; ?>>
                                Khóa
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">ID khách hàng</label>
                        <input readonly type="text" class="form-control" name="id_customer" value="<?php 
                            echo $_GET['id_customer']; ?>">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Responsive Table -->
    <div class="card row">
        <h4 class="card-header">Danh sách địa chỉ</h4>
        <h5 class="card-header" >Khách hàng:
            <?php echo $customer->full_name  ?> 
        </h5>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="">
                        <th>ID</th>
                        <th>Địa chỉ nhận hàng</th>
                        <th>Trạng thái</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($listData)) {
                        foreach ($listData as $item) {
                            if ($item->address_type == 1) {
                                $address_status = "Kích hoạt";
                            } else {
                                $address_status = "Khóa";
                            }
                            echo '<tr>
                        <td>' . $item->id . '</td>
                        <td>' . $item->address_name . '</td>
                        <td>' . $address_status . '</td>
                        <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/2top_crm-view-admin-address-addAddress.php/?id=' . $item->id . '&id_customer='.$item->id_customer.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa địa chỉ nhận hàng không?\');" 
                            href="/plugins/admin/2top_crm-view-admin-address-deleteAddress.php/?id=' . $item->id . '">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
                      </tr>';
                        }
                    } else {
                        echo '<tr>
                      <td colspan="10" align="center">Chưa có khách hàng</td>
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