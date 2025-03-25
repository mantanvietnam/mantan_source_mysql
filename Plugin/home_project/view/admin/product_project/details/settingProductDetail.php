<?php
if(!empty($mess)){
    echo $mess;
}
?>
<style>
   .custom-dropdown {
    min-width: 250px; /* Tăng độ rộng dropdown */
    padding: 10px; /* Tăng padding */
}

.menu-img {
    width: 200px; /* Tăng kích thước ảnh */
    height: auto;
    border-radius: 5px; /* Bo góc */
}

.dropdown-item {
    padding: 10px 15px; /* Tăng khoảng cách giữa các mục */
}

.dropdown-divider {
    border-top: 1px solid #ddd; /* Đường ngăn cách */
    margin: 5px 0;
}

</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="/plugins/admin/home_project-view-admin-product_project-listProductProjectAdmin">Dự án</a> /
        </span>
        Cài đặt chi tiết dự án <?php echo !empty($productInfo) ? ' - '.$productInfo->name : ''; ?>
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Chi tiết dự án</h3>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="addItemDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-plus me-1"></i> Thêm chi tiết dự án
                        </button>
                        <ul class="dropdown-menu custom-dropdown" aria-labelledby="addItemDropdown">
                            <li>
                                <a class="dropdown-item" href="/plugins/admin/home_project-view-admin-product_project-details-addProductDetailView3?id_product=<?php echo $id_product; ?>">
                                    <i class="bx bx-edit-alt me-1"></i> View mặc định
                                </a>
                            </li>
                            <li class="dropdown-divider"></li> <!-- Thêm ngăn cách -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/plugins/admin/home_project-view-admin-product_project-details-addProductDetailView1?id_product=<?php echo $id_product; ?>">
                                    <img src="../../../viewImage/view1.png" alt="View 1" class="menu-img me-2">
                                    View 1
                                </a>
                            </li>
                            <li class="dropdown-divider"></li> <!-- Thêm ngăn cách -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/plugins/admin/home_project-view-admin-product_project-details-addProductDetailView2?id_product=<?php echo $id_product; ?>">
                                    <img src="../../../viewImage/view2.png" alt="View 2" class="menu-img me-2">
                                    View 2
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Thứ tự hiển thị</th>
                                    <th>Tiêu đề</th>
                                    <th>Loại view</th>
                                    <th>Hình ảnh</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($commerceData)) {
                                    foreach ($commerceData as $item) {
                                        echo '<tr>';
                                        echo '<td>' . $item->main_view_id . '</td>';
                                        echo '<td>' . $item->main_title . '</td>';
                                        echo '<td>' . $item->view_type . '</td>';
                                        echo '<td>';
                                        if (!empty($item->main_image)) {
                                            echo '<img src="' . $item->main_image . '" width="100" />';
                                        } else {
                                            echo 'Không có hình ảnh';
                                        }
                                        echo '</td>';
                                        echo '<td align="center">';
                                        if ($item->view_type == 1) {
                                            echo '<a href="/plugins/admin/home_project-view-admin-product_project-details-addProductDetailView1?id=' . $item->id . '&id_product=' . $id_product . '" class="btn btn-sm btn-primary"><i class="bx bx-edit-alt me-1"></i> View 1</a>';
                                        } elseif ($item->view_type == 2) {
                                            echo '<a href="/plugins/admin/home_project-view-admin-product_project-details-addProductDetailView2?id=' . $item->id . '&id_product=' . $id_product . '" class="btn btn-sm btn-success"><i class="bx bx-edit-alt me-1"></i> View 2</a>';
                                        } elseif ($item->view_type >= 3 && $item->view_type <= 8) {
                                            echo '<a href="/plugins/admin/home_project-view-admin-product_project-details-addProductDetailView3?id=' . $item->id . '&id_product=' . $id_product . '" class="btn btn-sm btn-warning"><i class="bx bx-edit-alt me-1"></i> View mặc định</a>';
                                        } else {
                                            echo '<span class="text-danger">Loại view không hợp lệ</span>';
                                        }
                                        echo '</td>';
                                        echo '<td align="center">';
                                        echo '<a class="btn btn-sm btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteProductItemAdmin/?id=' . $item->id . '&id_product=' . $id_product . '"><i class="bx bx-trash me-1"></i></a>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="6" align="center">Chưa có mục mô tả nào.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>