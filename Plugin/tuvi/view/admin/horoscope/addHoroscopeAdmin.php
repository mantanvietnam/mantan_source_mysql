<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="/plugins/admin/tuvi-view-admin-horoscope-listHoroscopeAdmin">Danh sách</a> /
        </span>
        Thêm/Sửa
    </h4>

    <div class="card">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin cộng tác viên</h5>
                </div>
                <div class="card-body">
                    <p><?php echo $mess ?? ''; ?></p>
                    <?= $this->Form->create(); ?>
                    <div class="row">
                        <!-- Cột trái -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Năm sinh</label>
                                <input type="number" class="form-control" name="year" value="<?php echo @$data->year; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Giới tính</label>
                                <select name="gender" class="form-select">
                                    <option value="Nam" <?php if (@$data->gender == 'Nam') echo 'selected'; ?>>Nam</option>
                                    <option value="Nữ" <?php if (@$data->gender == 'Nữ') echo 'selected'; ?>>Nữ</option>
                                </select>
                            </div>
                        </div>

                        <!-- Cột phải -->
                        <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Giá</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="price" name="price" value="<?php echo number_format(@$data->price, 0, ',', '.'); ?>" required oninput="formatPrice(this)">
                                <span class="input-group-text">VNĐ</span>
                            </div>
                        </div>

                            <div class="mb-3">
                                <label class="form-label">Hình ảnh</label>
                                <?php showUploadFile('image', 'image', @$data->image, 0); ?>
                                <?php if (!empty($data->image)): ?>
                                    <img src="<?php echo $data->image; ?>" width="80px" height="80px" class="mt-2 rounded-circle">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#tab-overview">
                                Bản lược
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab-description">
                                Mô tả ngắn
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab-direction">
                                Hướng
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab-elements">
                                Ngũ hành
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab-mascot">
                                Linh vật
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab-name-age">
                                Đặt tên theo tuổi
                            </button>
                        </li>
                    </ul>

                    <!-- Nội dung Tabs -->
                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="tab-overview" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Bản lược</label>
                                <?php showEditorInput('overview', 'overview', @$data->overview); ?>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-description" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Mô tả ngắn</label>
                                <?php showEditorInput('description', 'description', @$data->description); ?>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-direction" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Hướng</label>
                                <?php showEditorInput('direction', 'direction', @$data->direction); ?>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-elements" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Thuộc tính ngũ hành</label>
                                <?php showEditorInput('five_elements', 'five_elements', @$data->five_elements); ?>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-mascot" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Linh vật</label>
                                <?php showEditorInput('mascot', 'mascot', @$data->mascot); ?>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-name-age" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Đặt tên theo tuổi</label>
                                <?php showEditorInput('name_by_age', 'name_by_age', @$data->name_by_age); ?>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
                    <a href="/plugins/admin/tuvi-view-admin-horoscope-listHoroscopeAdmin" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function formatPrice(input) {
    // Loại bỏ ký tự không phải số
    let value = input.value.replace(/\D/g, '');

    // Format thành dạng tiền tệ có dấu chấm ngăn cách
    input.value = new Intl.NumberFormat('vi-VN').format(value);
}
</script>