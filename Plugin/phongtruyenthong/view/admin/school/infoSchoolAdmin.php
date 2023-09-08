<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/phongtruyenthong-view-admin-school-infoSchoolAdmin.php">Trường học</a> /</span>
    Thông tin trường học
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin trường học</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên trường (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data['name'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                    <?php showUploadFile('image','image',@$data['image'],0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Logo nhà trường</label>
                    <?php showUploadFile('logo','logo',@$data['logo'],1);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Video giới thiệu trường</label>
                    <?php showUploadFile('video','video',@$data['video'],2);?>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="" name="address" id="address" value="<?php echo @$data['address'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại</label>
                    <input type="text" class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data['phone'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data['email'];?>" />
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Giới thiệu trường</label>
                    <textarea name="info" rows="10" class="form-control"><?php echo @$data['info'];?></textarea>
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