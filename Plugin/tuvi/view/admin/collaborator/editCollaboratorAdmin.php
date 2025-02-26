
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="/plugins/admin/tuvi-view-admin-collaborator-listCollaboratorAdmin">Cộng tác viên</a> /
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

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="password">Mật khẩu (*)</label>
                            <div class="input-group">
                                <input 
                                    type="password" 
                                    class="form-control" 
                                    name="password" 
                                    id="password" 
                                    value="<?php echo (!empty($data->id)) ? '********' : ''; ?>" 
                                    autocomplete="new-password"
                                />
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="parent">Cộng tác viên cha</label>
                            <select class="form-control select2" name="parent" id="parent">
                                <option value="0">Cộng tác viên gốc</option>
                                <?php
                                function showCollaboratorOptions($collaborators, $parent = 0, $prefix = '', $selectedId = 0) {
                                    foreach ($collaborators as $collaborator) {
                                        if ($collaborator->parent == $parent) {
                                            $selected = ($collaborator->id == $selectedId) ? 'selected' : '';
                                            echo '<option value="'.$collaborator->id.'" '.$selected.'>'.$prefix.$collaborator->name.'</option>';
                                            showCollaboratorOptions($collaborators, $collaborator->id, $prefix . '— ', $selectedId);
                                        }
                                    }
                                }

                                if (!empty($listCollaborators)) {
                                    showCollaboratorOptions($listCollaborators, 0, '', @$data->parent);
                                   
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Thư viện Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    document.getElementById("togglePassword").addEventListener("click", function() {
        let passwordField = document.getElementById("password");
        let icon = this.querySelector("i");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });

    document.getElementById("password").addEventListener("focus", function() {
        if (this.value === "********") {
            this.value = "";
        }
    });

    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            placeholder: "Chọn cộng tác viên cha",
            allowClear: true
        });
    });
</script>