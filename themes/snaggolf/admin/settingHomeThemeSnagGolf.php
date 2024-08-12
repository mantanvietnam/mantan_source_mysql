<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">SnagGolf Theme - Cài đặt trang chủ</h4>

    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
    <div class="row">
        <!-- Khối logo -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Logo</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Logo</label>
                  <?php showUploadFile('logo','logo', @$setting['logo'],1);?>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Khối Giới thiệu -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Giới Thiệu</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Tiêu đề chung</label>
                        <input type="text" class="form-control" name="welcome_title_main" value="<?php echo @$setting['welcome_title_main'];?>" />
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Tiêu đề 1</label>
                        <input type="text" class="form-control" name="welcome_title_1" value="<?php echo @$setting['welcome_title_1'];?>" />
                    </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Tiêu đề 2</label>
                        <input type="text" class="form-control" name="welcome_title_2" value="<?php echo @$setting['welcome_title_2'];?>" />
                    </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Tiêu đề 3</label>
                        <input type="text" class="form-control" name="welcome_title_3" value="<?php echo @$setting['welcome_title_3'];?>" />
                    </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Tiêu đề 4</label>
                        <input type="text" class="form-control" name="welcome_title_4" value="<?php echo @$setting['welcome_title_4'];?>" />
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>
        <!-- Khối Khoá Học -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Đăng ký Khoá Học</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Tiêu đề khoá học</label>
                        <textarea class="form-control" name="course_title"><?php echo @$setting['course_title'];?></textarea>
                    </div>
                </div>
                
            

               

                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>
        <!-- Khối Huấn luyện -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Huấn Luyện</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Nội Dung</label>
                        <textarea class="form-control" name="trainer_name"><?php echo @$setting['trainer_name'];?></textarea>
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>
        <!-- Khối Thông tin khoá học -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Thông tin khoá học</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Tiêu đề thông tin khoá học</label>
                        <textarea class="form-control" name="course_info_header"><?php echo @$setting['course_info_header'];?></textarea>
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>
        <!-- Khối Chân Trang -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Khối Chân Trang</h5>
                </div>
                <div class="card-body row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nội Dung</label>
                            <textarea class="form-control" name="footer_content"><?php echo @$setting['footer_content'];?></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>