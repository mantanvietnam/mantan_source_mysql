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
                                <label class="form-label">nội dung dưới image1</label>
                                <input  type="text" class="form-control phone-mask" name="content3" id="content3" value="<?php echo @$data->content3;?>" />
                              </div>   
                              <div class="mb-3">
                                <label class="form-label">nội dung thứ 1</label>
                                <input  type="text" class="form-control phone-mask" name="content1" id="content1" value="<?php echo @$data->content1;?>" />
                              </div>                          
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">image 2</label>
                                <?php showUploadFile('image2','image2',@$data->image2,2);?>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">nội dung dưới image2</label>
                                <input  type="text" class="form-control phone-mask" name="content4" id="content4" value="<?php echo @$data->content4;?>" />
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">image 3</label>
                                <?php showUploadFile('image3','image3',@$data->image3,3);?>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">image 4</label>
                                <?php showUploadFile('image4','image4',@$data->image4,4);?>
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