<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="/plugins/admin/snaphair-view-admin-sample-listSamplePhotoAdmin">Ảnh mẫu</a> /
        </span>
        Thông tin ảnh mẫu
    </h4>
    
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin ảnh mẫu</h5>
                </div>

                <div class="card-body">
                    <p><?php echo $mess ?? ''; ?></p>
                    <?= $this->Form->create(); ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Tên ảnh mẫu (*)</label>
                            <input required type="text" class="form-control" name="name" id="name" value="<?php echo @$data->name; ?>" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Danh mục</label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" name="id_sample_cate" id="id_sample_cate">
                                    <option value="0">Chọn danh mục</option>
                                    <?php 
                                    if (!empty($sampleCategories)) {
                                        foreach ($sampleCategories as $category) {
                                            $selected = (@$data->id_sample_cate == $category->id) ? 'selected' : '';
                                            echo '<option value="'.$category->id.'" '.$selected.'>'.$category->name.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giới tính</label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" name="sex" id="sex">
                                    <option value="1" <?php if (!empty($data->sex) && $data->sex == '1') echo 'selected'; ?>>Nam</option>
                                    <option value="2" <?php if (!empty($data->sex) && $data->sex == '2') echo 'selected'; ?>>Nữ</option>
                                    <option value="3" <?php if (!empty($data->sex) && $data->sex == '3') echo 'selected'; ?>>Unisex</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Màu sắc</label>
                            <input type="text" class="form-control" name="color" id="color" value="<?php echo @$data->color; ?>" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hình ảnh (*)</label>
                            <?php showUploadFile('image', 'image', @$data->image, 0); ?>
                            <?php if (!empty($data->image)): ?>
                                <img src="<?php echo $data->image; ?>" width="80px" height="80px" class="mt-2">
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mẫu Hot (Ghim lên đầu)</label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" name="hot" id="hot">
                                    <option value="0" <?php if (empty($data->hot) || $data->hot == '0') echo 'selected'; ?>>Không</option>
                                    <option value="1" <?php if (!empty($data->hot) && $data->hot == '1') echo 'selected'; ?>>Có</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
