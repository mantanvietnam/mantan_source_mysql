<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/field-view-admin-listfield">Lĩnh vực</a> /</span>
    Thông tin lĩnh vực
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin lĩnh vực</h5>
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
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Thông tin dự án 1
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info2" aria-controls="navs-top-info2" aria-selected="false">
                          Thông tin dự án 2 
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info3" aria-controls="navs-top-info3" aria-selected="false">
                          Thông tin dự án 3
                        </button>
                      </li>
                      <!-- <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                          Hình ảnh
                        </button>
                      </li> -->
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">icon</label>
                              <?php showUploadFile('icon','icon',@$data->icon,5);?>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Banner</label>
                              <?php showUploadFile('imagebanner','imagebanner',@$data->imagebanner,0);?>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Tên lĩnh vực </label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Tiêu đề lớn</label>
                              <input  type="text" class="form-control phone-mask" name="title1" id="title1" value="<?php echo @$data->title1;?>" />
                            </div>
                                                  
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">image 1</label>
                                <?php showUploadFile('image1','image1',@$data->image1,1);?>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">nội dung bên phải image1</label>
                                <input  type="text" class="form-control phone-mask" name="content2" id="content2" value="<?php echo @$data->content2;?>" />
                              </div> 
             
                              <div class="mb-3">
                                <label class="form-label">image 3</label>
                                <?php showUploadFile('image3','image3',@$data->image3,3);?>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">image 4</label>
                                <?php showUploadFile('image4','image4',@$data->image4,4);?>
                              </div>
                                              
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">image 2</label>
                                <?php showUploadFile('image2','image2',@$data->image2,2);?>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-info">
                          <div class="row">
                              <div class="col-md-12">
                                <div class="mb-3">
                                  <label class="form-label">Thông tin mô tả về dự án 1</label>
                                  <?php showEditorInput('content1', 'content1', @$data->content1);?>
                                </div> 
                              </div>
                          </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-info2">
                          <div class="row">
                              <div class="col-md-12">
                                <div class="mb-3">
                                  <label class="form-label">Thông tin mô tả về dự án 2</label>
                                  <?php showEditorInput('content3', 'content3', @$data->content3);?>
                                </div> 
                              </div>
                          </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-info3">
                          <div class="row">
                              <div class="col-md-12">
                                <div class="mb-3">
                                  <label class="form-label">Thông tin mô tả về dự án 3</label>
                                  <?php showEditorInput('content4', 'content4', @$data->content4);?>
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