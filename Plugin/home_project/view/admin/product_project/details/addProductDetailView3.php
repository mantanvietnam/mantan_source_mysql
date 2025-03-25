<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/home_project-view-admin-product_project-details-settingProductDetail/?id=<?php echo $id_product; ?>">Thông tin dự án</a> /</span>
        Chi tiết dự án
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                    <p><?php echo @$mess; ?></p>
                    <?= $this->Form->create(null, ['type' => 'file']); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tiêu đề</label>
                                <input type="text" name="main_title" class="form-control"
                                       value="<?php echo isset($commerceData->main_title) ? htmlspecialchars($commerceData->main_title, ENT_QUOTES, 'UTF-8') : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh (2000*1000px)</label>
                                <input type="file" name="main_image" class="form-control">
                                <?php if (!empty($commerceData->main_image)): ?>
                                    <img src="<?= $commerceData->main_image ?>" alt="Hình minh họa" class="img-preview" style="max-width: 150px;">
                                <?php endif; ?>
                            </div>
                            <div class="mb-3" id="settingViewContainer" style="display: none;">
                                <label class="form-label">Hiển thị ảnh</label>
                                <select class="form-control" name="setting_view" id="setting_view" required>
                                    <option value="1" <?php echo (isset($commerceData->setting_view) && $commerceData->setting_view == 1) ? 'selected' : ''; ?>>
                                        Trái
                                    </option>
                                    <option value="2" <?php echo (isset($commerceData->setting_view) && $commerceData->setting_view == 2) ? 'selected' : ''; ?>>
                                        Phải
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Thứ tự hiển thị</label>
                                <input type="number" class="form-control" name="main_view_id" id="view_id" value="<?php echo isset($commerceData->main_view_id) ? $commerceData->main_view_id : ''; ?>" min="1" placeholder="Nhập số thứ tự hiển thị" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Loại View</label>
                                <select class="form-control" name="view_type" id="viewTypeSelect" onchange="updateImagePreview()">
                                    <option value="3" data-img="../../viewImage/view3.png" <?php if (isset($commerceData->view_type) && $commerceData->view_type == 3) echo 'selected'; ?>>View 3</option>
                                    <option value="4" data-img="../../viewImage/view4.png" <?php if (isset($commerceData->view_type) && $commerceData->view_type == 4) echo 'selected'; ?>>View 4</option>
                                    <option value="5" data-img="../../viewImage/view5.png" <?php if (isset($commerceData->view_type) && $commerceData->view_type == 5) echo 'selected'; ?>>View 5</option>
                                    <option value="6" data-img="../../viewImage/view6.png" <?php if (isset($commerceData->view_type) && $commerceData->view_type == 6) echo 'selected'; ?>>View 6</option>
                                    <option value="7" data-img="../../viewImage/view7.png" <?php if (isset($commerceData->view_type) && $commerceData->view_type == 7) echo 'selected'; ?>>View 7</option>
                                    <option value="8" data-img="../../viewImage/view8.png" <?php if (isset($commerceData->view_type) && $commerceData->view_type == 8) echo 'selected'; ?>>View 8</option>
                                </select>
                                <div id="imagePreviewContainer">
                                    <img id="viewImagePreview" src="" alt="Ảnh xem trước" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Mô tả chính</label>
                                <?php
                                $mainDescription = isset($commerceData->main_description) ? $commerceData->main_description : '';
                                showEditorInput('main_description', 'main_description', htmlspecialchars($mainDescription, ENT_QUOTES, 'UTF-8'));
                                ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updateImagePreview() {
        const select = document.getElementById('viewTypeSelect');
        const selectedOption = select.options[select.selectedIndex];
        const imageUrl = selectedOption.getAttribute('data-img');
        const imgElement = document.getElementById('viewImagePreview');

        imgElement.src = imageUrl;
        imgElement.style.width = "500px";
        imgElement.style.height = "auto";

        updateSettingViewVisibility(); 
        toggleImageUpload();
    }

    function updateSettingViewVisibility() {
        const select = document.getElementById('viewTypeSelect');
        const settingViewDiv = document.getElementById('settingViewContainer');
        const selectedValue = parseInt(select.value);

        if (selectedValue === 4 || selectedValue === 6 || selectedValue === 3) {
            settingViewDiv.style.display = "block";
        } else {
            settingViewDiv.style.display = "none";
        }
    }

    function toggleImageUpload() {
        const select = document.getElementById('viewTypeSelect');
        const imageUploadField = document.querySelector('input[name="main_image"]').closest('.mb-3');
        const selectedValue = parseInt(select.value);

        if (selectedValue === 7 || selectedValue === 8) {
            imageUploadField.style.display = "none"; 
        } else {
            imageUploadField.style.display = "block"; 
        }
    }

    window.onload = function() {
        updateImagePreview();
    };
</script>

