<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Lịch sử nhập kho</h4>
    <p><a href="/plugins/admin/go_draw-view-admin-warehouse_histories-addProductWarehouseAdmin/?product_id=<?php if(!empty($_GET['product_id'])) echo $_GET['product_id'];?>" class="btn btn-primary"><i class='bx bx-plus'></i> Tạo phiếu nhập kho mới</a></p>

    <!-- Form Search -->
    <form method="get" action="">
        <div class="card mb-4">
            <h5 class="card-header">Tìm kiếm dữ liệu</h5>
            <div class="card-body">
                <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-3">
                        <label class="form-label">ID sản phẩm</label>
                        <select required class="form-select color-dropdown" name="product_id">
                            <option value="">Chọn sản phẩm</option>

                            <?php 
                            if(!empty($list_product)){
                                foreach ($list_product as $key => $value) {
                                    if(empty($_GET['product_id']) || $_GET['product_id']!=$value->id){
                                        echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                                    }else{
                                        echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Từ ngày</label>
                        <input type="text" class="form-control datepicker" name="from_date" value="<?php if(!empty($_GET['from_date'])) echo $_GET['from_date'];?>">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Tới ngày</label>
                        <input type="text" class="form-control datepicker" name="to_date" value="<?php if(!empty($_GET['to_date'])) echo $_GET['to_date'];?>">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Kiểu nhập kho</label>
                        <select name="type" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <option value="minus" <?php if(isset($_GET['type']) && $_GET['type'] == 'minus') echo 'selected';?> >Xuất kho</option>
                            <option value="plus" <?php if(isset($_GET['type']) && $_GET['type'] == 'plus') echo 'selected';?> >Nhập kho</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary d-block" style="width: 100%">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--/ Form Search -->

    <!-- Responsive Table -->
    <div class="card row">
        <h5 class="card-header">Lịch sử nhập kho</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr class="">
                    <th>Thời gian</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Giá trung bình</th>
                    <th>Ghi chú</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($listData)){
                    foreach ($listData as $item) {
                        if ($item->type == 'minus') {
                            $type = '<p class="text-danger">Xuất kho</p>';
                        } else {
                            $type = '<p class="text-success">Nhập kho</p>';
                        }

                        echo '  <tr>
                                    <td>'.date_format($item->updated_at, "H:i:s d/m/Y").'</td>
                                    <td>'.@$item->name_product.'</td>
                                    <td>'.number_format($item->amount).'<br/>'.$type.'</td>
                                    <td>'.number_format($item->total_price).'đ</td>
                                    <td>'.number_format($item->price_average).'đ</td>
                                    <td>'.@$item->note.'</td>
                                </tr>';
                    }
                }else{
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
        <!--/ Basic Pagination -->
    </div>
    <!--/ Responsive Table -->
</div>
