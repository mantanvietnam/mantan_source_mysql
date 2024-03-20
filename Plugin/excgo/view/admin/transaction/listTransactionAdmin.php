<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Danh sách yêu cầu</h4>
    <!-- Form Search -->
    <form method="get" action="">
        <div class="card mb-4">
            <h5 class="card-header">Tìm kiếm dữ liệu</h5>
            <div class="card-body">
                <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-2">
                        <label class="form-label">ID</label>
                        <input type="text" class="form-control" name="id"
                               value="<?php if (!empty($_GET['id'])) echo $_GET['id']; ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">User Id</label>
                        <input type="text" class="form-control" name="user_id"
                               value="<?php if (!empty($_GET['user_id'])) echo $_GET['user_id']; ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Id cuốc xe</label>
                        <input type="text" class="form-control" name="booking_id"
                               value="<?php if (!empty($_GET['booking_id'])) echo $_GET['booking_id']; ?>">
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
        <h5 class="card-header">Danh sách khách hàng</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr class="">
                    <th>ID</th>
                    <th>Tên giao dịch</th>
                    <th>Số Tiền</th>
                    <th>Nội dung</th>
                    <th>Thời gian</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($listData)) {
                    foreach ($listData as $item) {
                        $type = $item->type == 1 ? '+' : '-';

                        echo '<tr>
                        <td align="center">' . $item->id . '</td>
                        <td align="center">' . $item->name . '</td>
                        <td align="center">' . $type . $item->amount . '</td>
                        <td align="center">' . $item->description . '</td>
                        <td align="center">' . $item->created_at . '</td>
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
