<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/phongtruyenthong-view-admin-config-configRoom3DAdmin">Phòng 3D</a> /</span>
    Cấu hình hiển thị
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cấu hình hiển thị phòng 3D</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-12">
                  <div class="nav-align-top mb-4">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-phone">Mã màu</label>
                          <input type="text" class="form-control phone-mask" name="color" id="color" value="<?php echo @$data['color'];?>" />
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-phone">Video TVC trên tường</label>
                          <select name="video_tvc" class="form-control">
                            <option value="on">Hiển thị</option>
                            <option value="off" <?php if(!empty($data['video_tvc']) && $data['video_tvc']=='off') echo 'selected';?> >Tắt hiển thị</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-phone">Video MC giới thiệu</label>
                          <select name="video_mc" class="form-control">
                            <option value="on">Hiển thị</option>
                            <option value="off" <?php if(!empty($data['video_mc']) && $data['video_mc']=='off') echo 'selected';?> >Tắt hiển thị</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-phone">Trụ xoay giữa phòng</label>
                          <select name="pillar_logo" class="form-control">
                            <option value="on">Hiển thị</option>
                            <option value="off" <?php if(!empty($data['pillar_logo']) && $data['pillar_logo']=='off') echo 'selected';?> >Tắt hiển thị</option>
                          </select>
                        </div>
                      </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>