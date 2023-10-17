<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Sản phẩm</h4>
    <p><a href="/plugins/admin/go_draw-view-admin-product-addProductAdmin.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

    <!-- Form Search -->
    <form method="get" action="">
        <div class="card mb-4">
            <h5 class="card-header">Tìm kiếm dữ liệu</h5>
            <div class="card-body">
                <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-2">
                        <label class="form-label">ID</label>
                        <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
                    </div>

                    <div class="col-md-5">
                      <label class="form-label">Mã sản phẩm</label>
                      <input type="text" class="form-control" name="code" value="<?php if(!empty($_GET['code'])) echo $_GET['code'];?>">
                    </div>
                </div>

                <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-4">
                        <label class="form-label">Danh mục</label>
                        <select name="category_id" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <?php
                            if(!empty($categoryList)){
                                foreach($categoryList as $item){
                                    if(empty($_GET['category_id']) || $_GET['category_id']!=$item->id){
                                        echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                    }else{
                                        echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Combo</label>
                        <select name="combo_id" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <?php
                            if(!empty($comboList)){
                                foreach($comboList as $item){
                                    if(empty($_GET['combo_id']) || $_GET['combo_id']!=$item->id){
                                        echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                    }else{
                                        echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select color-dropdown">
                            <option value="">Tất cả</option>
                            <option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == 0) echo 'selected';?> >Kích hoạt</option>
                            <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == 1) echo 'selected';?> >Khóa</option>
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
        <h5 class="card-header">Danh sách sản phẩm</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr class="">
                    <th>ID</th>
                    <th>Hình minh họa</th>
                    <th>Danh mục</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($productList)){
                    foreach ($productList as $item) {
                        if ($item->status) {
                            $status = 'On-sale';
                        } else {
                            $status = 'Khóa';
                        }
                        echo '<tr>
                        <td class="text-center">'.$item->id.'</td>
                        <td class="text-center"><img src="'.$item->image.'" width="100" /></td>
                        <td>'.$item->Categories['name'].'</td>
                        <td>'.$item->name.'</td>
                        <td>'.number_format($item->price).'đ</td>
                        <td class="text-center">'.$status.'</td>
                        <td align="center">
                          <a class="btn btn-primary" href="/plugins/admin/go_draw-view-admin-product-addProductAdmin.php/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/go_draw-view-admin-product-deleteProductAdmin.php/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
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
