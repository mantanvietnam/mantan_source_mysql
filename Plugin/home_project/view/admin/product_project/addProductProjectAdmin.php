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
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Thông tin Dự án</h5>
        </div>
        <div class="card-body">
          <p><?php echo $mess; ?></p>
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
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav-location">
                      Vị trí
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav-officially">
                      Chính thức mở bán
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav-ecological_space">
                      Không gian sinh thái
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav-utility_services">
                      Dịch vụ tiện ích
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav-commerce">
                      Thành phố thương mại
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
                          <label class="form-label">Mô tả</label>
                          <?php showEditorInput('description', 'description', @$data->description); ?>
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
                          <label class="form-label">Giá</label>
                          <?php showEditorInput('price', 'price', @$data->price); ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Tab vị trí -->
                  <div class="tab-pane fade" id="nav-location" role="tabpanel">
                    <div class="mb-3">
                      <label class="form-label">Google Map</label>
                      <?php showEditorInput('map', 'map', @$data->map); ?>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Thông tin về vị trí</label>
                      <?php showEditorInput('text_location', 'text_location', @$data->text_location); ?>
                    </div>
                  </div>

                  <!-- Tab chính thức mở bán -->
                  <div class="tab-pane fade" id="nav-officially" role="tabpanel">
                    <div class="row">
                      <!-- Tiêu đề -->
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Tiêu đề</label>
                          <input type="text" name="officially[title]" class="form-control"
                            value="<?php echo isset($data->officially['title']) ? $data->officially['title'] : ''; ?>">
                        </div>
                      </div>

                      <!-- Mô tả -->
                      <div class="mb-3">
                          <label class="form-label">Mô tả</label>
                          <?php 
                              $description = (!empty($data->officially) && is_array($data->officially) && isset($data->officially['description'])) 
                                  ? $data->officially['description'] 
                                  : ''; 
                                  
                              showEditorInput('officially[description]', 'officially[description]', $description); 
                          ?>
                      </div>
                    </div>
                  </div>

                  <!-- Tab thành phố thương mại -->
                  <div class="tab-pane fade" id="nav-commerce" role="tabpanel">
                    <div class="row">
                        <!-- Tiêu đề chính -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tiêu đề chính</label>
                                <input type="text" name="commerce_main_title" class="form-control"
                                    value="<?php echo isset($commerceData->main_title) ? htmlspecialchars($commerceData->main_title, ENT_QUOTES, 'UTF-8') : ''; ?>">
                            </div>
                        </div>

                        <!-- Chọn loại View -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Chọn loại view</label>
                                <select name="commerce_view_id" class="form-control" id="commerceViewSelect">
                                    <option value="1" <?php echo (!empty($commerceData->view_type) && $commerceData->view_type == 1) ? 'selected' : ''; ?>>View 1</option>
                                    <option value="2" <?php echo (!empty($commerceData->view_type) && $commerceData->view_type == 2) ? 'selected' : ''; ?>>View 2</option>
                                </select>
                            </div>
                        </div>

                        <!-- Mô tả chính -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Mô tả chính</label>
                                <?php 
                                    $mainDescription = $commerceData->main_description ?? ''; 
                                    showEditorInput('commerce_main_description', 'commerce_main_description', htmlspecialchars($mainDescription, ENT_QUOTES, 'UTF-8')); 
                                ?>
                            </div>
                        </div>

                        <!-- Nội dung View 1 -->
                        <div id="view1" class="commerce-content" style="display: none;">
                            <div class="col-md-12 mb-3">
                                <h3 class="text-primary">Mặt bằng tổng thể</h3>
                            </div>

                            <?php foreach ($commerceItems as $index => $item) : ?>
                                <div class="card p-3 mb-3">
                                    <h5 class="text-secondary">Thông tin <?= $index + 1 ?></h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Tiêu đề <?= $index + 1 ?></label>
                                            <input type="text" name="commerce_title_<?= $index + 1 ?>" class="form-control"
                                                value="<?php echo htmlspecialchars($item->title ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Hình ảnh <?= $index + 1 ?></label>
                                            <input type="file" name="commerce_image_<?= $index + 1 ?>" class="form-control">
                                            <?php if (!empty($item->image)): ?>
                                                <div class="mt-2">
                                                    <img src="<?php echo htmlspecialchars($item->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                                        alt="Hình ảnh <?= $index + 1 ?>" 
                                                        style="max-width: 100px; height: auto;">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <label class="form-label mt-3">Mô tả <?= $index + 1 ?></label>
                                    <?php 
                                      showEditorInput("commerce_description_" . ($index + 1), "commerce_description_" . ($index + 1), htmlspecialchars($item->description ?? '', ENT_QUOTES, 'UTF-8'));
                                    ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Nội dung View 2 -->
                        <div id="view2" class="commerce-content" style="display: none;">
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
                                                    <input type="text" name="commerce_title[]" class="form-control"
                                                        value="<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Hình ảnh</label>
                                                    <input type="file" name="commerce_image[]" class="form-control">
                                                    <?php if (!empty($item->image)) : ?>
                                                        <div class="mt-2">
                                                            <img src="<?php echo htmlspecialchars($item->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                                                alt="Hình ảnh" 
                                                                style="max-width: 100px; height: auto;">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-10">
                                                    <label class="form-label">Mô tả</label>
                                                    <textarea name="commerce_description[]" class="form-control editor"><?php echo htmlspecialchars($item->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
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
                                    <!-- Trường hợp chưa có dữ liệu -->
                                    <div class="card p-3 mb-3 field-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">Tiêu đề</label>
                                                <input type="text" name="commerce_title[]" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Hình ảnh</label>
                                                <input type="file" name="commerce_image[]" class="form-control">
                                            </div>
                                            <div class="col-md-10">
                                                <label class="form-label">Mô tả</label>
                                                <textarea name="commerce_description[]" class="form-control editor"></textarea>
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
                    </div>
                  </div>

                  <!-- Tab Không gian sinh thái -->
                  <div class="tab-pane fade" id="nav-ecological_space" role="tabpanel">
                    <div class="mb-3">
                      <label class="form-label">Không gian sinh thái</label>
                      <?php showEditorInput('ecological_space', 'ecological_space', @$data->ecological_space); ?>
                    </div>
                  </div>

                  <!-- Tab Dịch vụ tiện ích -->
                  <div class="tab-pane fade" id="nav-utility_services" role="tabpanel">
                    <div class="mb-3">
                      <label class="form-label">Dịch vụ tiện ích</label>
                      <?php showEditorInput('utility_services', 'utility_services', @$data->utility_services); ?>
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

                      <!-- Hình Tổng Quát Về Map -->
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình Tổng Quát Về Map</label>
                          <input type="file" name="img_map" class="form-control">
                          <?php if (!empty($data->images['img_map'])): ?>
                            <img src="<?= $data->images['img_map'] ?>" alt="Hình Map" class="img-preview">
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
                    </div>
                  </div>
                </div>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>

<script>
$(document).ready(function () {
    if ($.fn.select2) {
        $('#id_kind').select2({
            placeholder: "Chọn danh mục",
            allowClear: true
        });
    } else {
        console.error("⚠️ Lỗi: Select2 chưa được tải!");
    }

    let select = $("#commerceViewSelect");
    let view1 = $("#view1");
    let view2 = $("#view2");

    function toggleViews() {
        view1.toggle(select.val() === "1");
        view2.toggle(select.val() === "2");
    }

    toggleViews();
    select.on("change", toggleViews);

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
                        <input type="text" name="commerce_title[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Hình ảnh</label>
                        <input type="file" name="commerce_image[]" class="form-control">
                    </div>
                    <div class="col-md-10">
                        <label class="form-label">Mô tả</label>
                        <textarea id="${uniqueId}" name="commerce_description[]" class="form-control editor"></textarea>
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