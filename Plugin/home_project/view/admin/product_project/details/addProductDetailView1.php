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
                                <label class="form-label">Hình ảnh</label>
                                <input type="file" name="main_image" class="form-control">
                                <?php if (!empty($commerceData->main_image)): ?>
                                    <img src="<?= $commerceData->main_image ?>" alt="Hình minh họa" class="img-preview" style="max-width: 150px;">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Thứ tự hiển thị</label>
                                <input type="number" class="form-control" name="main_view_id" id="view_id" value="<?php echo isset($commerceData->main_view_id) ? $commerceData->main_view_id : ''; ?>" min="1" placeholder="Nhập số thứ tự hiển thị" required />
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
                    <div class="commerce-content">
                        <div class="col-md-12 mb-3">
                            <h3 class="text-primary">View bé</h3>
                        </div>
                        <?php foreach($commerceItems as $index => $item): ?>
                            <div class="card p-3 mb-3">
                                <h5 class="text-secondary">Thông tin item <?php echo $index + 1; ?></h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Tiêu đề</label>
                                        <input type="text" name="title[<?php echo $index; ?>]" class="form-control"
                                            value="<?php echo htmlspecialchars($item->title ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Hình ảnh</label>
                                        <input type="file" name="detail_image[<?php echo $index; ?>]" class="form-control">
                                        <?php if (!empty($item->detail_image)): ?>
                                            <div class="mt-2">
                                                <img src="<?php echo htmlspecialchars($item->detail_image, ENT_QUOTES, 'UTF-8'); ?>"
                                                    alt="Hình ảnh"
                                                    style="max-width: 100px; height: auto;">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mô tả</label>
                                    <?php
                                    $description = isset($item->description) ? $item->description : '';
                                    showEditorInput('description['.$index.']', 'description_'.$index, htmlspecialchars($description, ENT_QUOTES, 'UTF-8'));
                                    ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
