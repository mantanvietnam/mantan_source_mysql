<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/course-view-admin-listcourse">khóa học</a> /</span>
    Thông tin khóa học
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin khóa học</h5>
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
                          Mô tả khóa học
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-content" aria-controls="navs-top-content" aria-selected="false">
                          Thông tin khóa học
                        </button>
                      </li>
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
                              <label class="form-label">Tên khóa học (*)</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Địa chỉ (*)</label>
                              <input  type="text" class="form-control phone-mask" name="address" id="address" value="<?php echo @$data->address;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">thông tin chung (*)</label>
                              <input  type="text" class="form-control phone-mask" name="generalim" id="generalim" value="<?php echo @$data->generalim;?>" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Thời gian</label>
                                <input  type="text" class="form-control phone-mask datepicker" name="time_create" id="time_create" value="<?php echo @$data->time_create;?>" />
                              </div>
                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn</label>
                              <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                            </div>
                          </div>

                          <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Tiêu đề card 1</label>
                                <input  type="text" class="form-control phone-mask" name="title1" id="title1" value="<?php echo @$data->title1;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">nội dung card 1</label>
                                <input  type="text" class="form-control phone-mask" name="contenttiele1" id="contenttiele1" value="<?php echo @$data->contenttiele1;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Tiêu đề card 2</label>
                                <input  type="text" class="form-control phone-mask" name="title2" id="title2" value="<?php echo @$data->title2;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">nội dung card 2</label>
                                <input  type="text" class="form-control phone-mask" name="contenttiele2" id="contenttiele2" value="<?php echo @$data->contenttiele2;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Tiêu đề card 3</label>
                                <input  type="text" class="form-control phone-mask" name="title3" id="title3" value="<?php echo @$data->title3;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">nội dung card 3</label>
                                <input  type="text" class="form-control phone-mask" name="contenttiele3" id="contenttiele3" value="<?php echo @$data->contenttiele3;?>" />
                              </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-content" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Thông tin mô tả về khóa học</label>
                              <?php showEditorInput('content', 'content', @$data->content);?>
                            </div>
                          </div>
                        </div>
                      </div>

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