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
                <div class="col-12">
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          Thông tin chung
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-timeline" aria-controls="navs-top-timeline" aria-selected="false">
                          Cài đặt timeline
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-achievement" aria-controls="navs-top-achievement" aria-selected="false">
                          Thành tích nhà trường
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-principal" aria-controls="navs-top-principal" aria-selected="false">
                          Hiệu trưởng
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Cài đặt sảnh
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
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
                      </div>

                      <div class="tab-pane fade" id="navs-top-timeline" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Ảnh dòng thời gian (7000 x 2700)</label>
                              <?php showUploadFile('image_timeline','image_timeline',@$data['image_timeline'],5);?>
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Các cột mốc thời gian</label>
                              <textarea name="info_timeline" rows="10" class="form-control"><?php echo @$data['info_timeline'];?></textarea>
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">ID album ảnh sự kiện lịch sử</label>
                              <input type="text" class="form-control" placeholder="" name="id_album_event" id="id_album_event" value="<?php echo @$data['id_album_event'];?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-achievement" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Ảnh 1 (790 x 1150)</label>
                              <?php showUploadFile('image_achievement_1','image_achievement_1',@$data['image_achievement_1'],6);?>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Mô tả ảnh 1</label>
                              <textarea name="des_achievement_1" rows="5" class="form-control"><?php echo @$data['des_achievement_1'];?></textarea>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Ảnh 2 (790 x 1150)</label>
                              <?php showUploadFile('image_achievement_2','image_achievement_2',@$data['image_achievement_2'],7);?>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Mô tả ảnh 2</label>
                              <textarea name="des_achievement_2" rows="5" class="form-control"><?php echo @$data['des_achievement_2'];?></textarea>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Ảnh 3 (790 x 1150)</label>
                              <?php showUploadFile('image_achievement_3','image_achievement_3',@$data['image_achievement_3'],8);?>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Mô tả ảnh 3</label>
                              <textarea name="des_achievement_3" rows="5" class="form-control"><?php echo @$data['des_achievement_3'];?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-principal" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Ảnh 1 (1500 x 2000)</label>
                              <?php showUploadFile('image_principal_1','image_principal_1',@$data['image_principal_1'],9);?>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Mô tả ảnh 1</label>
                              <textarea name="des_principal_1" rows="10" class="form-control"><?php echo @$data['des_principal_1'];?></textarea>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Ảnh 2 (1500 x 2000)</label>
                              <?php showUploadFile('image_principal_2','image_principal_2',@$data['image_principal_2'],10);?>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Mô tả ảnh 2</label>
                              <textarea name="des_principal_2" rows="10" class="form-control"><?php echo @$data['des_principal_2'];?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Video giới thiệu trường</label>
                              <?php showUploadFile('video','video',@$data['video'],2);?>
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Ảnh backdrop (7000 x 3500)</label>
                              <?php showUploadFile('image_backdrop','image_backdrop',@$data['image_backdrop'],3);?>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Ảnh danh sách đóng góp quỹ (1500 x 2000)</label>
                              <?php showUploadFile('image_donate','image_donate',@$data['image_donate'],4);?>
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