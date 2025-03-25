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
                            <!-- <div class="mb-3">
                                <label class="form-label">Hình ảnh</label>
                                <input type="file" name="main_image" class="form-control">
                                <?php if (!empty($commerceData->main_image)): ?>
                                    <img src="<?= $commerceData->main_image ?>" alt="Hình minh họa" class="img-preview" style="max-width: 150px;">
                                <?php endif; ?>
                            </div> -->
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
                            <h3 class="text-primary">View 2</h3>
                        </div>
                        <div id="dynamic-fields">
                            <?php if (!empty($commerceItems)) : ?>
                                <?php foreach ($commerceItems as $index => $item) : ?>
                                    <div class="card p-3 mb-3 field-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">Tiêu đề</label>
                                                <input type="text" name="title[]" class="form-control"
                                                       value="<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Hình ảnh (800*450px)</label>
                                                <input type="file" name="detail_image[]" class="form-control">
                                                <?php if (!empty($item->detail_image)) : ?>
                                                    <div class="mt-2">
                                                        <img src="<?php echo htmlspecialchars($item->detail_image, ENT_QUOTES, 'UTF-8'); ?>"
                                                             alt="Hình ảnh"
                                                             style="max-width: 100px; height: auto;">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-mb-4">
                                                <label class="form-label">Hiển thị ảnh</label>
                                                <select class="form-control" name="setting_view[]" id="setting_view" required>
                                                    <option value="1" <?php echo (isset($item->setting_view) && $item->setting_view == 1) ? 'selected' : ''; ?>>
                                                        Trái
                                                    </option>
                                                    <option value="2" <?php echo (isset($item->setting_view) && $item->setting_view == 2) ? 'selected' : ''; ?>>
                                                        Phải
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-10">
                                                <label class="form-label">Mô tả</label>
                                                <textarea name="description[]" class="form-control editor"><?php echo htmlspecialchars($item->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger remove-field">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="card p-3 mb-3 field-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Tiêu đề</label>
                                            <input type="text" name="title[]" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Hình ảnh</label>
                                            <input type="file" name="detail_image[]" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Hiển thị ảnh</label>
                                            <select name="setting_view[]" class="form-control">
                                                <option value="1">Trái</option>
                                                <option value="2">Phải</option>
                                            </select>
                                        </div>
                                        <div class="col-md-10">
                                            <label class="form-label">Mô tả</label>
                                            <textarea name="description[]" class="form-control editor"></textarea>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger remove-field">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-success add-field">
                                <i class="fas fa-plus"></i> Thêm mới
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
<script>
    $(document).ready(function () {
        function initTinyMCE(selector) {
            tinymce.init({
                selector: selector,
                height: 200,
                plugins: 'lists link image table',
                toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | numlist bullist | link image',
                menubar: false
            });
        }

        initTinyMCE('.editor');

        let container = $("#dynamic-fields");
        let addButton = $(".add-field");

        addButton.on("click", function () {
            let uniqueId = "editor_" + Date.now();

            let newField = $(`
                <div class="card p-3 mb-3 field-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Tiêu đề</label>
                            <input type="text" name="title[]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" name="detail_image[]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Hiển thị ảnh</label>
                            <select name="setting_view[]" class="form-control">
                                <option value="1">Trái</option>
                                <option value="2">Phải</option>
                            </select>
                        </div>
                        <div class="col-md-10">
                            <label class="form-label">Mô tả</label>
                            <textarea id="${uniqueId}" name="description[]" class="form-control editor"></textarea>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-field">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);

            container.append(newField);

            tinymce.remove(`#${uniqueId}`);
            setTimeout(() => {
                initTinyMCE(`#${uniqueId}`);
            }, 200);

            newField.find(".remove-field").on("click", function () {
                let field = $(this).closest(".field-group");
                let editorId = field.find("textarea").attr("id");

                if (editorId) {
                    tinymce.remove(`#${editorId}`);
                }

                field.remove();
            });
        });

        $(document).on("click", ".remove-field", function () {
            let field = $(this).closest(".field-group");
            let editorId = field.find("textarea").attr("id");

            if (editorId) {
                tinymce.remove(`#${editorId}`);
            }

            field.remove();
        });
    });

</script>