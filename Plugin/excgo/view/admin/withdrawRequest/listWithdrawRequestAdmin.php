<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Danh sách yêu cầu</h4>
    <!-- Form Search -->
    <form method="get" action="">
        <div class="card mb-4">
            <h5 class="card-header">Tìm kiếm dữ liệu</h5>
            <div class="card-body">
                <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-1">
                        <label class="form-label">ID thành viên</label>
                        <input type="text" class="form-control" name="user_id"
                               value="<?php if (!empty($_GET['user_id'])) echo $_GET['user_id']; ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tên thành viên</label>
                        <input type="text" class="form-control" name="name"
                               value="<?php if (!empty($_GET['name'])) echo $_GET['name']; ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone_number"
                               value="<?php if (!empty($_GET['phone_number'])) echo $_GET['phone_number']; ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email"
                               value="<?php if (!empty($_GET['email'])) echo $_GET['email']; ?>">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') echo 'selected'; ?> >Đã hoàn thành
                            </option>
                            <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0') echo 'selected'; ?> >Chưa xử lý
                            </option>
                            <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == '2') echo 'selected'; ?> >Hủy
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
        <h5 class="card-header">Danh sách yêu cầu rút tiền</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr class="">
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Họ và tên</th>
                    <th>Thông tin tài khoản</th>
                    <th>Số tiền muốn rút</th>
                    <th>Thời gian tạo</th>
                    <th colspan="2" >Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($listData)):
                    foreach ($listData as $item):
                        if ($item->status == 1) {
                            $status = '<td colspan="2"  align="center">Đã hoàn thành</td>';
                        }elseif($item->status == 2) {
                           $status = '<td colspan="2"  align="center">Đã bị hủy</td>';
                        } else {
                            $status = '
                  <td align="center"><a class="btn btn-success"  title="Hoàn thành" 
                    onclick="return confirm(\'Bạn có chắc chắn muốn hoàn thành yêu cầu này không?\')"
                    href="/plugins/admin/excgo-view-admin-withdrawRequest-updateStatusWithdrawRequestAdmin/?id=' . $item->id . '&status=1"
                  >
                           <i class="bx bx-check-circle me-1" style="font-size: 22px;"></i>
                  </a></td>
                  <td align="center"><a class="btn btn-danger"  title="Hủy" 
                    onclick="return confirm(\'Bạn có chắc chắn muốn hủy yêu cầu này không?\')"
                    href="/plugins/admin/excgo-view-admin-withdrawRequest-updateStatusWithdrawRequestAdmin/?id=' . $item->id . '&status=2"
                  >
                           <i class="bx bxs-x-circle me-1" style="font-size: 22px;"></i>
                  </a></td>';
                        }


                ?>
                    <tr>
                        <td align="center"><?php echo $item->id; ?></td>
                        <td align="center"><img src="<?php echo $item->Users['avatar']; ?>" width="100" /></td>
                        <td>
                            <a class="text-decoration-none"
                               href="<?php echo "/plugins/admin/excgo-view-admin-user-viewUserDetailAdmin/?id=" . $item->Users['id'] ?>"
                            >
                                <?php echo $item->Users['name']; ?>
                            </a>
                            </br>
                            <?php echo $item->Users['phone_number']; ?>
                            </br>
                            <?php echo $item->Users['email']; ?>
                        </td>
                        <td>
                            Ngân hàng: <?php echo $item->Users['bank_account']; ?>
                            <br>
                            Số TK: <?php echo $item->Users['account_number']; ?>
                            <br>
                            Số dư: <?php echo number_format($item->Users['total_coin']); ?> đ
                        </td>
                        <td>
                            <?php echo number_format($item->amount); ?> đ
                        </td>
                        <td class="text-center">
                            <?php echo $item->created_at->format('H:i d-m-Y'); ?>
                        </td>
                       <?php echo $status;?>
                      </tr>
                <?php
                    endforeach;
                    else:
                        echo '<tr>
                                <td colspan="10" align="center">Chưa có dữ liệu</td>
                              </tr>';
                    endif;
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

