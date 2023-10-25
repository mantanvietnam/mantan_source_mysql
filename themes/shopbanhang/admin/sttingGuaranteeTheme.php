<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">	 Theme - chích sách bảo mật Setting</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
            </div>
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                  <input type="text" class="form-control" name="title" value="<?php echo @$setting['title'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <label class="form-label" for="basic-default-fullname">Chính sách bảo hành</label>
                   <?php showEditorInput('content', 'content', @$setting['content']);?>
                </div>

                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề video</label>
                  <input type="text" class="form-control" name="title_video" value="<?php echo @$setting['title_video'];?>" />
                </div>
                 <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-5 col-lg-5 col-xl-5">
                  <label class="form-label" for="basic-default-fullname">code video youtube Hướng dẫn kích hoạt bảo hành</label>
                  <input type="text" class="form-control" name="code_video" value="<?php echo @$setting['code_video'];?>" />
                </div>
               
                
                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary" style="width:75px; height: 35px;">Lưu</button>
                </div>
            </div>
          </div>
        </div>

        
      </div>
    <?= $this->Form->end() ?>
  </div>

  text-welcome