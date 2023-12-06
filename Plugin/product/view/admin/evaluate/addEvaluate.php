<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/product-view-admin-product-listProduct.php">Sản phẩm</a> /</span>
    Thông tin đánh giá
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin đánh giá</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-12">
                  <div class="nav-align-top mb-4">
                        <div class="row">
                          <div class="col-md-6 mb-3">
                             <label class="form-label">Họ và tên (*)</label>
                              <input required type="text" class="form-control phone-mask" name="full_name" id="full_name" value="<?php echo @$data->full_name;?>" />
                          </div>
                          <div class="col-md-6 mb-3">
                             <label class="form-label">điểm(*)</label>
                              <input required type="number" min="0" max="5" class="form-control phone-mask" name="point" id="point" value="<?php echo @$data->point;?>" />
                          </div>
                          <div class="col-md-6 mb-3">
                             <label class="form-label">ảnh đại điện</label>
                              <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label class="form-label">ảnh đánh giá 1</label>
                              <?php showUploadFile('image1','image[1]',@$data->image[1],1);?>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label class="form-label">ảnh đánh giá 2</label>
                              <?php showUploadFile('image2','image[2]',@$data->image[2],2);?>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label class="form-label">ảnh đánh giá 3</label>
                              <?php showUploadFile('image3','image[3]',@$data->image[3],3);?>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label class="form-label">ảnh đánh giá 4</label>
                              <?php showUploadFile('image4','image[4]',@$data->image[4],4);?>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label class="form-label">ảnh đánh giá 5</label>
                              <?php showUploadFile('image5','image[5]',@$data->image[5],5);?>
                          </div>

                           <div class="col-md-6 mb-3">
                             <label class="form-label">ảnh video đánh giá</label>
                              <?php showUploadFile('image_video','image_video',@$data->image_video,6);?>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label class="form-label">video đánh giá </label>
                              <?php showUploadFile('video','video',@$data->video,7);?>
                          </div>

                            <div class="col-md-6 mb-3">
                              <label class="form-label">nội dung (*)</label>
                              <textarea name="content" class="form-control phone-mask" required="" rows="5"><?php echo @$data->content; ?></textarea>
                            </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>