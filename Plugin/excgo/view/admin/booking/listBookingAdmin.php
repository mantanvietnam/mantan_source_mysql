<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Thông tin cuốc xe</h4>
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
                        <label class="form-label">Tên tỉnh đi</label>
                        <select name="departure_province_id" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <?php foreach ($listProvince ?? [] as $province): ?>
                                <option value="<?php echo $province->id ?>"
                                    <?php if(isset($_GET['departure_province_id']) && $_GET['departure_province_id'] == $province->id) echo 'selected';?>
                                ><?php echo $province->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tên tỉnh đến</label>
                        <select name="destination_province_id" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <?php foreach ($listProvince ?? [] as $province): ?>
                                <option value="<?php echo $province->id ?>"
                                    <?php if(isset($_GET['destination_province_id']) && $_GET['destination_province_id'] == $province->id) echo 'selected';?>
                                ><?php echo $province->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == '0') echo 'selected';?> >Chưa nhận</option>
                            <option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == '1') echo 'selected';?> >Đã nhận</option>
                            <option value="2" <?php if(isset($_GET['status']) && $_GET['status'] == '2') echo 'selected';?> >Đã hủy</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">id người đăng</label>
                        <input type="number" class="form-control" name="id_posted" value="<?php if(!empty($_GET['id_posted'])) echo $_GET['id_posted'];?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">id người nhận</label>
                        <input type="number" class="form-control" name="id_received" value="<?php if(!empty($_GET['id_received'])) echo $_GET['id_received'];?>">
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
        <h5 class="card-header">Danh sách cuốc xe</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr class="">
                    <th>ID</th>
                    <th>Địa điểm</th>
                    <th>Người đăng</th>
                    <th>Người nhận</th>
                    <th>Ngày đăng</th>
                    <th>Free</th>
                    <th>Trạng thái</th>
                    <th>Sửa</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($listBooking)):
                    foreach ($listBooking as $item):
                        if ($item->status === 0) {
                            $status = 'Chưa nhận';
                        } else if ($item->status === 1) {
                            $status = 'Đã nhận';
                        } else if ($item->status === 2) {
                            $status = 'Đã hủy';
                        } else {
                            $status = '';
                        }

                        if($item->status_free==1){
                            $free = 'Free';
                        }else{
                            $free = 'không Free';
                        }
                ?>
                    <tr>
                        <td><?php echo $item->id ?></td>
                        <td><?php echo $item->DepartureProvinces['name'] . ' - ' . $item->DestinationProvinces['name'] ?></td>
                        <td>
                            <a href="<?php echo "/plugins/admin/excgo-view-admin-user-viewUserDetailAdmin/?id=" . $item->PostedUsers['id'] ?>">
                                <?php echo $item->PostedUsers['name'] ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo "/plugins/admin/excgo-view-admin-user-viewUserDetailAdmin/?id=" . $item->ReceivedUsers['id'] ?>">
                                <?php echo $item->ReceivedUsers['name'] ?>
                            </a>
                        </td>
                        <td class="text-center"><?php echo $item->created_at->format('d-m-Y') ?></td>
                        <td class="text-center"><?php echo $free ?></td>
                        <td class="text-center"><?php echo $status ?></td>
                        <td>
                          <p align="center">
                              <a class="btn btn-primary"
                                 href="<?php echo "/plugins/admin/excgo-view-admin-booking-viewBookingDetailAdmin/?id=$item->id" ?>"
                              >
                                  <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                              </a>
                          </p>
                        </td>
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
