<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Đơn hàng mua sản phẩm</h4>

    <form method="get" action="">
        <div class="card mb-4">
            <h5 class="card-header">Tìm kiếm dữ liệu</h5>

            <div class="card-body">
                <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-1">
                        <label class="form-label">ID</label>
                        <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Đại lý</label>
                        <select name="agency_id" class="form-select color-dropdown">
                            <option value="">Tất cả đại lý</option>
                            <?php foreach (@$listAgency as $agency): ?>
                                <option value="<?php echo $agency->id; ?>" <?php if (!empty($_GET['agency_id']) && $_GET['agency_id'] == $agency->id) echo 'selected'; ?>><?php echo $agency->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Từ ngày</label>
                        <input type="text" class="form-control datepicker" name="from_date" value="<?php if(!empty($_GET['from_date'])) echo $_GET['from_date'];?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tới ngày</label>
                        <input type="text" class="form-control datepicker" name="to_date" value="<?php if(!empty($_GET['to_date'])) echo $_GET['to_date'];?>">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == 0) echo 'selected';?> >Đơn hàng mới</option>
                            <option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == 1) echo 'selected';?> >Đã xuất kho</option>
                            <option value="2" <?php if(isset($_GET['status']) && $_GET['status'] == 2) echo 'selected';?> >Đã nhập kho</option>
                            <option value="3" <?php if(isset($_GET['status']) && $_GET['status'] == 3) echo 'selected';?> >Đã thanh toán</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mt-3">
                        <button type="submit" class="btn btn-primary d-block" style="width: 100%">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh mục</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="col-md-1">Id</th>
                                <th class="col-md-3">Đại lý</th>
                                <th class="col-md-2"> Tổng giá</th>
                                <th class="col-md-2"> Ngày tạo</th>
                                <th class="col-md-2"> Trạng thái</th>
                                <th class="text-center col-md-1">Sửa</th>
                                <th class="text-center col-md-1">Xóa</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            <?php
                            if(!empty($listData)){
                                foreach ($listData as $item) {
                                    switch ($item->status) {
                                        case 1:
                                            $status = 'Đã xuất kho';
                                            break;
                                        case 2:
                                            $status = 'Đã nhập kho';
                                            break;
                                        case 3:
                                            $status = 'Đã thanh toán';
                                            break;
                                        default:
                                            $status = 'Đơn hàng mới';
                                            break;
                                    }

                                    echo '<tr>
                                            <td align="center">'.$item->id.'</td>
                                            <td>'.$item->Agencies["name"].'</td>
                                            <td align="center">'.number_format($item->total_price).'đ</td>
                                            <td align="center">'.date_format($item->created_at, "H:i:s d/m/Y").'</td>
                                            <td align="center">'.$status.'</td>
                                            <td align="center">
                                              <a class="btn btn-primary" 
                                                href="/plugins/admin/go_draw-view-admin-agency_order_product-addAgencyOrderProductAdmin.php/?id='.$item->id .'"
                                              >
                                                <i class="bx bx-edit-alt me-1"></i>
                                              </a>
                                            </td>
                                            <td align="center">
                                              <a class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" 
                                                href="href=/plugins/admin/go_draw-view-admin-agency_order_product-deleteAgencyOrderProductAdmin.php/?id='.$item->id.'"
                                              >
                                                <i class="bx bx-trash me-1"></i>
                                              </a>
                                            </td>
                                          </tr>';
                                }
                            }else{
                                echo '<tr>
                                  <td colspan="7" align="center">Chưa có dữ liệu</td>
                                </tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Phân trang -->
            <div class="demo-inline-spacing">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php
                        if (isset($totalPage) && isset($page) && isset($urlPage)) {
                            if($totalPage>0){
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
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
