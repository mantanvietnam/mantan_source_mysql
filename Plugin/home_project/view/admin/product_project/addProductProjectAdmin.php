<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/home_project-view-admin-product_project-listProductProjectAdmin">Dự án</a> /</span>
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
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          Mô tả dự án
                        </button>
                      </li>
                      <!-- <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Thông tin dự án
                        </button>
                      </li> -->
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                          Hình ảnh
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Tên dự án (*)</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Địa chỉ (*)</label>
                              <input  type="text" class="form-control phone-mask" name="address" id="address" value="<?php echo @$data->address;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn</label>
                              <textarea  rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
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
                              <label class="form-label">Tiện ích cảnh quan</label>
                              <textarea  rows="5" class="form-control" name="landscape" id="landscape"><?php echo @$data->landscape;?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="color">Màu sắc</label>
                                <select class="form-control" name="color" id="color">
                                    <option value="" <?= empty($data->color) ? 'selected' : '' ?>>Chọn màu</option>
                                    <option value="rgb(224 68 68 / var(--tw-bg-opacity, 1))" <?= @$data->color == 'rgb(224 68 68 / var(--tw-bg-opacity, 1))' ? 'selected' : '' ?>>Đỏ</option>
                                    <option value="linear-gradient(90deg, #182c77 0%, #6274bb 100%);" <?= @$data->color == 'linear-gradient(90deg, #182c77 0%, #6274bb 100%);' ? 'selected' : '' ?>>Xanh đậm</option>
                                    <option value="rgb(35 154 61 / var(--tw-bg-opacity, 1))" <?= @$data->color == 'rgb(35 154 61 / var(--tw-bg-opacity, 1))' ? 'selected' : '' ?>>Xanh lá</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="outstanding">Dự án nổi bật</label>
                                <input type="checkbox" class="form-check-input" name="outstanding" id="outstanding" value="1" 
                                    <?= !empty($data->outstanding) ? 'checked' : '' ?>>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="keypoint">Dự án trọng điểm</label>
                                <input type="checkbox" class="form-check-input" name="keypoint" id="keypoint" value="1" 
                                    <?= !empty($data->keypoint) ? 'checked' : '' ?>>
                            </div>

                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Diện tích</label>
                              <input  type="text" class="form-control phone-mask" name="acreage" id="acreage" value="<?php echo @$data->acreage;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Hiện trạng</label>
                              <input  type="text" class="form-control phone-mask" name="info" id="info" value="<?php echo @$data->info;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Mặt bằng</label>
                              <textarea  rows="5" class="form-control" name="premises" id="premises"><?php echo @$data->premises;?></textarea>
                            </div>
                         
                            <div class="mb-3">
                            <label class="form-label">Danh mục (*)</label>
                            <div class="input-group input-group-merge">
                              <select class="form-select" name="id_kind" id="id_kind" >
                                <option value="">Chọn danh mục</option>
                                <?php 
                                if(!empty($listKind)){
                                  foreach ($listKind as $key => $item) {
                                    if(empty($data->id_kind) || $data->id_kind!=$item->id){
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
                              <label class="form-label">Tổng quan phân khu</label>
                              <textarea  rows="5" class="form-control" name="subdivision" id="subdivision"><?php echo @$data->subdivision;?></textarea>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Map</label>
                              <input  type="text" class="form-control phone-mask" name="map" id="map" value="<?php echo @$data->map;?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Thông tin mô tả về dự án</label>
                              <?php showEditorInput('info', 'info', @$data->info);?>
                            </div>
                          </div>
                        </div>
                      </div> -->

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