<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-4">Quản lý Tử Vi</h4>

    <p><a href="/plugins/admin/tuvi-view-admin-horoscope-addHoroscopeAdmin" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p>

    <!-- Form Search -->
    <form method="get" action="">
        <div class="card mb-4">
            <h5 class="card-header">Tìm kiếm Tử Vi</h5>
            <div class="card-body">
                <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-2">
                        <label class="form-label">Năm sinh</label>
                        <input type="number" class="form-control" name="year" value="<?php echo @$_GET['year']; ?>">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Giới tính</label>
                        <select name="gender" class="form-select">
                            <option value="">Tất cả</option>
                            <option value="Nam" <?php if (@$_GET['gender'] == 'Nam') echo 'selected'; ?>>Nam</option>
                            <option value="Nữ" <?php if (@$_GET['gender'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Ngũ hành</label>
                        <input type="text" class="form-control" name="five_elements" value="<?php echo @$_GET['five_elements']; ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Linh vật</label>
                        <input type="text" class="form-control" name="mascot" value="<?php echo @$_GET['mascot']; ?>">
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
        <h5 class="card-header">Danh sách Tử Vi - <span class="text-danger"><?php echo number_format(@$totalData); ?> bản ghi</span></h5>
        <?php echo @$mess; ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Năm sinh</th>
                        <th>Giới tính</th>
                        <th>Hình ảnh</th>
                        <th>Ngũ hành</th>
                        <th>Linh vật</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($listData)) {
                        foreach ($listData as $item) {
                            echo '<tr>
                                <td>'.$item->id.'</td>
                                <td>'.$item->year.'</td>
                                <td>'.$item->gender.'</td>
                                <td><img src="'.$item->image.'" alt="'.$item->year.'" width="80"></td>
                                <td>'.$item->five_elements.'</td>
                                <td>'.$item->mascot.'</td>
                                <td align="center">
                                    <a class="dropdown-item" href="/plugins/admin/tuvi-view-admin-horoscope-addHoroscopeAdmin/?id='.$item->id.'">
                                        <i class="bx bx-edit-alt me-1"></i>
                                    </a>
                                </td>
                                <td align="center">
                                    <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteHoroscopeAdmin/?id='.$item->id.'">
                                        <i class="bx bx-trash me-1"></i>
                                    </a>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo '<tr>
                            <td colspan="8" align="center">Chưa có dữ liệu</td>
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
                        echo '<li class="page-item first">
                            <a class="page-link" href="'.$urlPage.'1">
                                <i class="tf-icon bx bx-chevrons-left"></i>
                            </a>
                        </li>';

                        for ($i = max(1, $page - 5); $i <= min($totalPage, $page + 5); $i++) {
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
        <!--/ Phân trang -->
    </div>
    <!--/ Responsive Table -->
</div>
