<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="/plugins/admin/snaphair-view-admin-collaborator-listCollaboratorAdmin">Cộng tác viên</a> /
        </span>
        Thông tin cộng tác viên
    </h4>
    
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin cộng tác viên</h5>
                </div>

                <div class="card-body">
                    <p><?php echo $mess ?? ''; ?></p>
                    <?= $this->Form->create(); ?>

                    <div class="row">
                        <!-- Tên cộng tác viên -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Tên cộng tác viên (*)</label>
                            <input required type="text" class="form-control" name="name" id="name" value="<?php echo @$data->name; ?>" />
                        </div>

                        <!-- Số điện thoại -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="phone">Số điện thoại (*)</label>
                            <input required type="text" class="form-control" name="phone" id="phone" value="<?php echo @$data->phone; ?>" />
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="email">Email (*)</label>
                            <input required type="email" class="form-control" name="email" id="email" value="<?php echo @$data->email; ?>" />
                        </div>

                        <!-- Trạng thái -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trạng thái</label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" name="status" id="status">
                                    <option value="1" <?php if (!empty($data->status) && $data->status == '1') echo 'selected'; ?>>Hoạt động</option>
                                    <option value="0" <?php if (!empty($data->status) && $data->status == '0') echo 'selected'; ?>>Ngừng hoạt động</option>
                                </select>
                            </div>
                        </div>

                        <!-- Hình ảnh -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hình ảnh đại diện</label>
                            <?php showUploadFile('image', 'image', @$data->image, 0); ?>
                            <?php if (!empty($data->image)): ?>
                                <img src="<?php echo $data->image; ?>" width="80px" height="80px" class="mt-2 rounded-circle">
                            <?php endif; ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
