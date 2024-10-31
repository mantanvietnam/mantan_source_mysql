<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/phongtruyenthong-view-admin-school-infoSchoolAdmin">Trường học</a> /</span>
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
                          Thông tin trường
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-timeline" aria-controls="navs-top-timeline" aria-selected="false">
                          Lịch sử hình thành
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-achievement" aria-controls="navs-top-achievement" aria-selected="false">
                          Thành tích nhà trường
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-activities" aria-controls="navs-top-activities" aria-selected="false">
                          Hoạt động nhà trường
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
                              <label class="form-label" for="basic-default-fullname">Ảnh thumbnail khi chia sẻ</label>
                              <?php showUploadFile('image','image',@$data['image'],0);?>
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Logo nhà trường</label>
                              <?php showUploadFile('logo','logo',@$data['logo'],1);?>
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Link youtube video giới thiệu trường</label>
                              <input type="text" class="form-control" placeholder="" name="video" id="video" value="<?php echo @$data['video'];?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Link video giới thiệu nhà trường</label>
                              <?php showUploadFile('video_local','video_local',@$data['video_local'],2);?>
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

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Nhạc nền</label>
                              <?php showUploadFile('audio_background','audio_background',@$data['audio_background'],11);?>
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Link video MC</label>
                              <?php showUploadFile('video_mc','video_mc',@$data['video_mc'],3);?>
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
                              <label class="form-label" for="basic-default-fullname">Album ảnh sự kiện lịch sử</label>
                              <select name="id_album_event" class="form-select color-dropdown">
                                <option value="">Chọn album ảnh</option>
                                <?php
                                  if(!empty($listAlbum)){
                                    foreach($listAlbum as $item){
                                      if(empty($data['id_album_event']) || $data['id_album_event']!=$item->id){
                                        echo '<option value="'.$item->id.'">'.$item->title.'</option>';
                                      }else{
                                        echo '<option selected value="'.$item->id.'">'.$item->title.'</option>';
                                      }
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-achievement" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Album ảnh thành tích nhà trường</label>
                              <select name="id_album_achievement" class="form-select color-dropdown">
                                <option value="">Chọn album ảnh</option>
                                <?php
                                  if(!empty($listAlbum)){
                                    foreach($listAlbum as $item){
                                      if(empty($data['id_album_achievement']) || $data['id_album_achievement']!=$item->id){
                                        echo '<option value="'.$item->id.'">'.$item->title.'</option>';
                                      }else{
                                        echo '<option selected value="'.$item->id.'">'.$item->title.'</option>';
                                      }
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-activities" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Chuyên mục ảnh hoạt động nhà trường</label>
                              <select name="id_category_activities" class="form-select color-dropdown">
                                <option value="">Chọn chủ đề album ảnh</option>
                                <?php
                                  if(!empty($listCategoryAlbum)){
                                    foreach($listCategoryAlbum as $item){
                                      if(empty($data['id_category_activities']) || $data['id_category_activities']!=$item->id){
                                        echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                      }else{
                                        echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                                      }
                                    }
                                  }
                                ?>
                              </select>
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