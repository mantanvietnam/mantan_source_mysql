<style>
  .img-preview {
    width: 100px;
    height: 100px;
    object-fit: cover;
    margin-top: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
  }

  .image-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }

  .img-container {
    position: relative;
    display: inline-block;
  }

  .remove-btn {
    position: absolute;
    top: -5px;
    right: -5px;
    background: red;
    color: white;
    width: 20px;
    height: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    cursor: pointer;
    font-size: 12px;
  }

  .field-group {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    background: #f9f9f9;
  }

  .add-field,
  .remove-field {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  #nav-commerce .table td {
        padding: 8px;
    }

    #nav-commerce .table tbody tr:hover {
        background-color: #f5f5f5;
    }

    .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
    }

    .btn-primary {
        padding: 10px 20px;
    }

    #nav-commerce.active ~ #saveButton {
        display: none;
    }

    .custom-description-header {
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .custom-description-header h5 {
        margin-right: 15px;
    }

    .custom-description-header {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .custom-description-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    #imagePreviewContainer {
        margin-top: 10px;
    }
    #viewImagePreview {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        display: none;
    }

</style>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">
      <a href="/plugins/admin/home_project-view-admin-product_project-listProductProjectAdmin">Dự án</a> /
    </span>
    Thông tin Dự án
  </h4>

  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-12">
          <?= $this->Form->create(null, ['type' => 'file']); ?>
          <div class="row">
            <div class="col-12">
              <div class="nav-align-top mb-4">
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home">
                      Mô tả dự án
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image">
                      Hình ảnh
                    </button>
                  </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                  <!-- Tab Mô tả dự án -->
                  <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Thứ tự hiển thị</label>
                            <input type="number" class="form-control" name="view_id" id="view_id" value="<?php echo @$data->view_id; ?>" min="1" placeholder="Nhập số thứ tự hiển thị" required />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Tên dự án (*)</label>
                          <input required type="text" class="form-control" name="name" id="name" value="<?php echo @$data->name; ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Danh mục (*)</label>
                          <select class="form-control" name="id_kind" id="id_kind">
                            <option value="">Chọn danh mục</option>
                            <?php
                            function showCategoryOptions($categories, $parent = 0, $prefix = '', $selectedId = 0)
                            {
                              foreach ($categories as $category) {
                                if ($category->parent == $parent) {
                                  $selected = ($category->id == $selectedId) ? 'selected' : '';
                                  echo '<option value="' . $category->id . '" ' . $selected . '>' . $prefix . $category->name . '</option>';
                                  showCategoryOptions($categories, $category->id, $prefix . '&nbsp;&nbsp;&nbsp;&nbsp;', $selectedId);
                                }
                              }
                            }

                            if (!empty($listKind)) {
                              showCategoryOptions($listKind, 0, '', @$data->id_kind);
                            }
                            ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label"></label>
                          <div class="input-group input-group-merge">
                            <select class="form-select" name="id_apart_type" id="id_apart_type">
                              <option value="">Mô hình</option>
                              <?php
                              if (!empty($listType)) {
                                foreach ($listType as $key => $item) {
                                  if (empty($data->id_apart_type) || $data->id_apart_type != $item->id) {
                                    echo '<option value="' . $item->id . '">' . $item->name . '</option>';
                                  } else {
                                    echo '<option selected value="' . $item->id . '">' . $item->name . '</option>';
                                  }
                                }
                              }

                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Địa chỉ (*)</label>
                          <input type="text" class="form-control" name="address" id="address" value="<?php echo @$data->address; ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Trạng thái</label>
                          <div class="input-group input-group-merge">
                            <select class="form-select" name="status" id="status">
                              <option value="active" <?php if (!empty($data->status) && $data->status == 'active') echo 'selected'; ?>>Kích hoạt</option>
                              <option value="lock" <?php if (!empty($data->status) && $data->status == 'lock') echo 'selected'; ?>>Khóa</option>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Chủ đầu tư</label>
                          <input type="text" class="form-control" name="investor" value="<?php echo @$data->investor; ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tiện ích nổi bật</label>
                            <textarea class="form-control" name="key_amenities" rows="4"><?php echo @$data->key_amenities; ?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Diện tích</label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="acreage" id="acreage" value="<?php echo @$data->acreage; ?>" />
                            <span class="input-group-text">m²</span>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Hướng</label>
                          <input type="text" class="form-control" name="direction" id="direction" value="<?php echo @$data->direction; ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Hình thức sở hữu</label>
                          <input type="text" class="form-control" name="ownership_type" id="ownership_type" value="<?php echo @$data->ownership_type; ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Chính sách ưu đãi</label>
                          <input type="text" class="form-control" name="preferential_policy" id="preferential_policy" value="<?php echo @$data->preferential_policy; ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Mật độ xây dựng</label>
                          <input type="text" class="form-control" name="construction_density" id="construction_density" value="<?php echo @$data->construction_density; ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Thời gian khởi công</label>
                          <input type="number" class="form-control" name="construction_date" id="construction_date" value="<?php echo @$data->construction_date; ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Bố cục căn hộ</label>
                          <input type="text" class="form-control" name="studio_apartment" id="studio_apartment" value="<?php echo @$data->studio_apartment; ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Google Map</label>
                          <?php showEditorInput('map', 'map', @$data->map); ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Tab Hình ảnh -->
                  <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
                    <div class="row">
                      <!-- Hình minh họa -->
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình minh họa</label>
                          <input type="file" name="image" class="form-control">
                          <?php if (!empty($data->image)): ?>
                            <img src="<?= $data->image ?>" alt="Hình minh họa" class="img-preview">
                          <?php endif; ?>
                        </div>
                      </div>

                      <!-- Hình Tổng Quát Về Mặt Bằng -->
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình Tổng Quát Về Mặt Bằng</label>
                          <input type="file" name="img_premises" class="form-control">
                          <?php if (!empty($data->images['img_premises'])): ?>
                            <img src="<?= $data->images['img_premises']?>" alt="Hình Mặt Bằng" class="img-preview">
                          <?php endif; ?>
                        </div>
                      </div>

                      <!-- Upload nhiều hình từ 1 đến 8 -->
                      <div class="col-md-12">
                        <div class="mb-3">
                          <label class="form-label">Chọn nhiều hình ảnh (Hình 1 -> Hình 8)</label>
                          <input type="file" name="images[]" class="form-control" multiple>
                          <div class="image-list">
                            <?php if (!empty($data->images)): ?>
                              <?php foreach ($data->images as $key => $img): ?>
                                <?php if (is_numeric($key) && $key >= 1 && $key <= 8): ?>
                                  <div class="img-container">
                                    <img src="<?= $img ?>" class="img-preview">
                                  </div>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary" id="saveButton">Lưu</button>
          <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function () {
    if ($.fn.select2) {
        const kindSelect = $('#id_kind');
        if (kindSelect.length) {
            kindSelect.select2({
                placeholder: "Chọn danh mục",
                allowClear: true
            });
        }
    } else {
        console.error("⚠️ Lỗi: Select2 chưa được tải!");
    }

    document.getElementById('saveButton').addEventListener('click', function(event) {
        event.preventDefault();
        for (let instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
        const form = document.querySelector('form');
        const formData = new FormData(form);
        const urlParams = new URLSearchParams(window.location.search);
        const projectId = urlParams.get('id');

        if (projectId) {
            formData.append('id', projectId);
        }
        for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }


        $.ajax({
            method: "POST",
            url: "/apis/addProductProjectAPI",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success === true) {
                    alert('Dữ liệu đã được lưu thành công!');
                    if (projectId) {
                        window.location.reload();
                    } else {
                        window.location.href = '/plugins/admin/home_project-view-admin-product_project-addProductProjectAdmin/' + response.projectId;
                    }
                } else {
                    alert('Lỗi: ' + response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
            }
        });
    });
});
</script>