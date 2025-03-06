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
                                <input type="text" name="commerce[main-title]" class="form-control"
                                    value="<?php echo isset($data->commerce['main-title']) ? htmlspecialchars($data->commerce['main-title'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                            </div>
                        </div>

                        <!-- Chọn loại View -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Chọn loại view</label>
                                <select name="commerce[id]" class="form-control" id="commerceViewSelect">
                                    <option value="1" <?php echo (!empty($data->commerce['id']) && $data->commerce['id'] == 1) ? 'selected' : ''; ?>>View 1</option>
                                    <option value="2" <?php echo (!empty($data->commerce['id']) && $data->commerce['id'] == 2) ? 'selected' : ''; ?>>View 2</option>
                                </select>
                            </div>
                        </div>

                        <!-- Mô tả chính -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Mô tả chính</label>
                                <?php 
                                    $mainDescription = (!empty($data->commerce) && is_array($data->commerce) && isset($data->commerce['main-description'])) 
                                        ? $data->commerce['main-description'] 
                                        : ''; 
                                    showEditorInput('commerce[main-description]', 'commerce[main-description]', htmlspecialchars($mainDescription, ENT_QUOTES, 'UTF-8')); 
                                ?>
                            </div>
                        </div>

                        <!-- Nội dung View 1: Mặt bằng tổng thể -->
                        <div id="view1" class="commerce-content" style="display: none;">
                            <div class="col-md-12 mb-3">
                                <h3 class="text-primary">Mặt bằng tổng thể</h3>
                            </div>

                            <?php for ($i = 1; $i <= 3; $i++) : ?>
                                <div class="card p-3 mb-3">
                                    <h5 class="text-secondary">Thông tin <?= $i ?></h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Tiêu đề <?= $i ?></label>
                                            <input type="text" name="commerce[title<?= $i ?>]" class="form-control"
                                                value="<?php echo !empty($data->commerce["title$i"]) ? htmlspecialchars($data->commerce["title$i"], ENT_QUOTES, 'UTF-8') : ''; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Hình ảnh <?= $i ?></label>
                                            <input type="file" name="commerce[image<?= $i ?>]" class="form-control">
                                            <?php if (!empty($data->commerce["image$i"])): ?>
                                                <div class="mt-2">
                                                    <img src="<?php echo htmlspecialchars($data->commerce["image$i"], ENT_QUOTES, 'UTF-8'); ?>" 
                                                        alt="Hình ảnh <?= $i ?>" 
                                                        style="max-width: 100px; height: auto;">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <label class="form-label mt-3">Mô tả <?= $i ?></label>
                                    <?php 
                                        $descriptionKey = "description$i";
                                        $descriptionValue = !empty($data->commerce[$descriptionKey]) ? $data->commerce[$descriptionKey] : '';
                                        showEditorInput("commerce[$descriptionKey]", "commerce[$descriptionKey]", htmlspecialchars($descriptionValue, ENT_QUOTES, 'UTF-8'));
                                    ?>
                                </div>
                            <?php endfor; ?>
                        </div>

                        <!-- Nội dung View 2: Dịch vụ tiện ích -->
                        <div id="view2" class="commerce-content" style="display: none;">
                            <div class="col-md-12 mb-3">
                                <h3 class="text-primary">View 2</h3>
                            </div>

                            <!-- Container chứa các nhóm trường động -->
                            <div id="dynamic-fields">
                                <div class="card p-3 mb-3 field-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Tiêu đề</label>
                                            <input type="text" name="commerce[title][]" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Hình ảnh</label>
                                            <input type="file" name="commerce[image][]" class="form-control">
                                        </div>
                                        <div class="col-md-10">
                                            <label class="form-label">Mô tả</label>
                                            <?php showEditorInput('commerce[description][]', 'commerce[description][]', ''); ?>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger remove-field">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Nút thêm nhóm mới -->
                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-success add-field">
                                    <i class="fas fa-plus"></i> Thêm mới
                                </button>
                            </div>

                            <!-- Mẫu ẩn để JavaScript clone khi thêm nhóm mới -->
                            <div id="field-template" class="d-none">
                                <div class="card p-3 mb-3 field-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Tiêu đề</label>
                                            <input type="text" name="commerce[title][]" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Hình ảnh</label>
                                            <input type="file" name="commerce[image][]" class="form-control">
                                        </div>
                                        <div class="col-md-10">
                                            <label class="form-label">Mô tả</label>
                                            <?php showEditorInput('commerce[description][]', 'commerce[description][]', ''); ?>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger remove-field">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#id_kind').select2({
      placeholder: "Chọn danh mục",
      allowClear: true
    });
  });

document.addEventListener("DOMContentLoaded", function () {
    let select = document.getElementById("commerceViewSelect");
    let view1 = document.getElementById("view1");
    let view2 = document.getElementById("view2");

    function toggleViews() {
        view1.style.display = select.value == "1" ? "block" : "none";
        view2.style.display = select.value == "2" ? "block" : "none";
    }

    toggleViews();
    select.addEventListener("change", toggleViews);

    // Xử lý thêm/xóa nhóm trường động trong View 2
    let container = document.getElementById("dynamic-fields");
    let template = document.getElementById("field-template");
    let addButton = document.querySelector(".add-field");

    function addField() {
        if (template) {
            let newField = template.cloneNode(true);
            newField.classList.remove("d-none");
            newField.removeAttribute("id");

            // Cập nhật name cho phần mô tả để tránh trùng ID
            let editor = newField.querySelector("textarea");
            if (editor) {
                let uniqueId = "editor_" + Date.now();
                editor.setAttribute("name", "commerce[description][]");
                editor.setAttribute("id", uniqueId);
            }

            container.appendChild(newField);

            // Gắn sự kiện xóa cho nút mới thêm vào
            newField.querySelector(".remove-field").addEventListener("click", function () {
                newField.remove();
            });
        }
    }

    if (addButton) {
        addButton.addEventListener("click", addField);
    }

    // Gắn sự kiện xóa cho các phần tử sẵn có
    document.querySelectorAll(".remove-field").forEach(btn => {
        btn.addEventListener("click", function () {
            btn.closest(".field-group").remove();
        });
    });
});

</script>