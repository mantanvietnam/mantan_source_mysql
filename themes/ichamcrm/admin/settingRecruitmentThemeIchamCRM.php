<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Icham CRM Theme - Cài đặt trang Tuyển Dụng</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Tiêu Đề</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 1</label>
                  <input type="text" class="form-control" name="banner_title_1" value="<?php echo @$setting['banner_title_1'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 1</label>
                  <textarea class="form-control" name="banner_content_1"><?php echo @$setting['banner_content_1'];?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>
        <!-- Khối Tuyển Dụng -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Tuyển Dụng</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 2</label>
                  <textarea class="form-control" name="banner_title_2"><?php echo @$setting['banner_title_2'];?></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 2</label>
                  <textarea class="form-control" name="banner_content_2"><?php echo @$setting['banner_content_2'];?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>
        <!-- Khối Chiêu Mộ -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Chiêu Mộ</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 3</label>
                  <input type="text" class="form-control" name="banner_title_3" value="<?php echo @$setting['banner_title_3'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 3</label>
                  <textarea class="form-control" name="banner_content_3"><?php echo @$setting['banner_content_3'];?></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Link chi tiết</label>
                  <textarea class="form-control" name="link_content"><?php echo @$setting['link_content'];?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>
        <!-- Khối Văn Hoá -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Văn Hoá</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu Đề</label>
                  <input type="text" class="form-control" name="culture_title" value="<?php echo @$setting['culture_title'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung</label>
                  <textarea class="form-control" name="culture_content"><?php echo @$setting['culture_content'];?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>
        <!-- Khối Trang Trí -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Trang Trí</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu Đề</label>
                  <input type="text" class="form-control" name="decoration_title" value="<?php echo @$setting['decoration_title'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung</label>
                  <textarea class="form-control" name="decoration_content"><?php echo @$setting['decoration_content'];?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>
      </div>
    <?= $this->Form->end() ?>
  </div>