<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Thông tin mua bán điểm</h4>
    <h4 class="fw-bold py-3 mb-4"></h4>
    <!-- Form Search -->
    <form method="get" action="">
        <div class="card mb-4">
            <h5 class="card-header">Tìm kiếm</h5>

            <div class="card-body">
                <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-4">
                      <label class="form-label">Id cuốc xe</label>
                      <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == '0') echo 'selected';?> >đơn Mới </option>
                            <option value="2" <?php if(isset($_GET['status']) && $_GET['status'] == '2') echo 'selected';?> >Đã xong</option>
                            <option value="3" <?php if(isset($_GET['status']) && $_GET['status'] == '3') echo 'selected';?> >Đã hủy</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Số điện thoại người bán</label>
                        <input type="text" class="form-control" name="phone_sell" value="<?php if(!empty($_GET['phone_sell'])) echo $_GET['phone_sell'];?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Số điện thoại người mua</label>
                        <input type="text" class="form-control" name="phone_buy" value="<?php if(!empty($_GET['phone_buy'])) echo $_GET['phone_buy'];?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Kiểu đăng</label>
                        <select name="type" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <option value="1" <?php if(isset($_GET['type']) && $_GET['type'] == '1') echo 'selected';?> >Bán</option>
                            <option value="2" <?php if(isset($_GET['type']) && $_GET['type'] == '2') echo 'selected';?> >Mua</option>
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
        <h5 class="card-header">Danh sách mua bán điểm</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr class="">
                    <th>ID</th>
                    <th>Điểm</th>
                    <th>tiền</th>
                    <th>Người bán</th>
                    <th>Người mua</th>
                    <th>Ngày giao dịch</th>
                    <th>Trạng thái</th>
                    <th>Kiểu</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($listData)):
                    foreach ($listData as $item):
                        if ($item->status === 0) {
                            $status = 'Mới';
                        } else if ($item->status === 2) {
                            $status = 'Đã xong';
                        } else if ($item->status === 3) {
                            $status = 'Đã hủy';
                        } else {
                            $status = '';
                        }

                        $type = 'Mua';
                        if($item->type==1){
                            $type = 'bán';
                        }
                ?>
                    <tr>
                        <td><?php echo $item->id ?></td>
                        <td><?php echo $item->point ?> điểm</td>
                        <td><?php echo number_format($item->total) ?> EXC-xu</td>
                        
                        <td>
                            <a href="<?php echo "/plugins/admin/excgo-view-admin-user-viewUserDetailAdmin/?id=" . @$item->infoUser_sell->id; ?>">
                                <?php echo @$item->infoUser_sell->name; ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo "/plugins/admin/excgo-view-admin-user-viewUserDetailAdmin/?id=" . @$item->infoUser_buy->id; ?>">
                                <?php echo @$item->infoUser_buy->name; ?>
                            </a>
                        </td>
                        <td class="text-center"><?php echo $item->created_at->format('d-m-Y') ?></td>
                        <td class="text-center"><?php echo $status ?></td>
                        <td class="text-center"><?php echo $type ?></td>
                        
                    </tr>
                <?php
                    endforeach;
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
