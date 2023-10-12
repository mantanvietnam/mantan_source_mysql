<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Cài đặt trang Media </h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <!-- Section 1 -->
        <div class="col-12 col-xs-12 col-sm-12 ">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối mục 1</h5>
            </div>
            <div class="card-body row">
               <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1</label>
                  <input type="text" class="form-control" name="title" value="<?php echo @$setting['title'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">MÔ TẢ NGẮN</label>
                  <input type="text" class="form-control" name="description" value="<?php echo @$setting['description'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề phụ nội dung</label>
                  <input type="text" class="form-control" name="title_sub_section_1" value="<?php echo @$setting['title_sub_section_1'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">MÃ YOUTUBE </label>
                  <input type="text" class="form-control" name="video" value="<?php echo @$setting['video'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Id Album ảnh </label>
                  <input type="text" class="form-control" name="id_album" value="<?php echo @$setting['id_album'];?>" />
                </div>
              </div>
              
              <div class="col-12 col-xs-12 col-sm-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung</label>
                  <?php showEditorInput('content', 'content', @$setting['content']);?>
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>


      </div>
    <?= $this->Form->end() ?>
  </div>