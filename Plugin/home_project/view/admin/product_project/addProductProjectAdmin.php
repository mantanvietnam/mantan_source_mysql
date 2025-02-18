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
          <p><?php echo $mess;?></p>
          <?= $this->Form->create(); ?>
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
                          <input required type="text" class="form-control" name="name" id="name" value="<?php echo @$data->name;?>" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Danh mục (*)</label>
                            <select class="form-control" name="id_kind" id="id_kind">
                              <option value="">Chọn danh mục</option>
                              <?php
                              function showCategoryOptions($categories, $parent = 0, $prefix = '', $selectedId = 0) {
                                  foreach ($categories as $category) {
                                      if ($category->parent == $parent) {
                                          $selected = ($category->id == $selectedId) ? 'selected' : '';
                                          echo '<option value="'.$category->id.'" '.$selected.'>'.$prefix.$category->name.'</option>';
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
                              <select class="form-select" name="id_apart_type" id="id_apart_type" >
                                <option value="">Mô hình</option>
                                <?php 
                                if(!empty($listType)){
                                  foreach ($listType as $key => $item) {
                                    if(empty($data->id_apart_type) || $data->id_apart_type!=$item->id){
                                      echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                    }else{
                                      echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                                    }
                                  }}
                              
                                ?>
                              </select>
                            </div>
                            </div>

                        <div class="mb-3">
                          <label class="form-label">Địa chỉ (*)</label>
                          <input type="text" class="form-control" name="address" id="address" value="<?php echo @$data->address;?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Trạng thái</label>
                          <div class="input-group input-group-merge">
                            <select class="form-select" name="status" id="status">
                              <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                              <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Chủ đầu tư</label>
                          <input type="text" class="form-control" name="investor" value="<?php echo @$data->investor; ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Mô tả</label>
                          <?php showEditorInput('description', 'description', @$data->description);?>
                        </div>
                      </div>

                      <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Diện tích</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="acreage" id="acreage" value="<?php echo @$data->acreage;?>" />
                          <span class="input-group-text">m²</span>
                        </div>
                      </div>
                        <div class="mb-3">
                          <label class="form-label">Hướng</label>
                          <input type="text" class="form-control" name="direction" id="direction" value="<?php echo @$data->direction;?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Hình thức sở hữu</label>
                          <input type="text" class="form-control" name="ownership_type" id="ownership_type" value="<?php echo @$data->ownership_type;?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Giá</label>
                          <?php showEditorInput('price', 'price', @$data->price);?>
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
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình minh họa</label>
                          <?php showUploadFile('image','image',@$data->image,0);?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình 1</label>
                          <?php showUploadFile('image1','images[1]',@$data->images[1],1);?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình 2</label>
                          <?php showUploadFile('image2','images[2]',@$data->images[2],2);?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình 3</label>
                          <?php showUploadFile('image3','images[3]',@$data->images[3],3);?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình 4</label>
                          <?php showUploadFile('image4','images[4]',@$data->images[4],4);?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình 5</label>
                          <?php showUploadFile('image5','images[5]',@$data->images[5],5);?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình 6</label>
                          <?php showUploadFile('image6','images[6]',@$data->images[6],6);?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình 7</label>
                          <?php showUploadFile('image7','images[7]',@$data->images[7],7);?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình 8</label>
                          <?php showUploadFile('image8','images[8]',@$data->images[8],8);?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình Tổng Quát Về Map</label>
                          <?php showUploadFile('imageMap','images[map]',@$data->images['map'],9);?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label class="form-label">Hình Tổng Quát Về Mặt Bằng</label>
                          <?php showUploadFile('imagePremises','images[premises]',@$data->images['premises'],10);?>
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
</script>