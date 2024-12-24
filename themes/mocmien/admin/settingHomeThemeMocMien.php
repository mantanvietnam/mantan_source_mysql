<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">MocMien Theme - Cài đặt trang chủ</h4>

    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
    <div class="row">
        <!-- Khối Logo -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Logo</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Logo</label>
                        <?php showUploadFile('image_logo','image_logo', @$setting['image_logo'],1);?>
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>
        <!-- Slide -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Slide</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Id Slide trang chủ</label>
                        <input type="text" class="form-control" name="id_slide" value="<?php echo @$setting['id_slide'];?>" />
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>
        <!-- Khối Giới thiệu -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Thông tin chung</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Hotline</label>
                        <input type="text" class="form-control" name="title_main" value="<?php echo @$setting['title_main'];?>" />
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>

        <!-- Khối chính sách -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Chính sách</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Logo 1</label>
                        <?php showUploadFile('images_1','images_1', @$setting['images_1'],1);?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Tiêu đề 1</label>
                        <input type="text" class="form-control" name="delivery_title_1" value="<?php echo @$setting['delivery_title_1'];?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Nội dung 1</label>
                        <input type="text" class="form-control" name="delivery_content_1" value="<?php echo @$setting['delivery_content_1'];?>" />
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Logo 2</label>
                        <?php showUploadFile('images_2','images_2', @$setting['images_2'],2);?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Tiêu đề 2</label>
                        <input type="text" class="form-control" name="delivery_title_2" value="<?php echo @$setting['delivery_title_2'];?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Nội dung 2</label>
                        <input type="text" class="form-control" name="delivery_content_2" value="<?php echo @$setting['delivery_content_2'];?>" />
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Logo 3</label>
                        <?php showUploadFile('images_3','images_3', @$setting['images_3'],3);?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Tiêu đề 3</label>
                        <input type="text" class="form-control" name="delivery_title_3" value="<?php echo @$setting['delivery_title_3'];?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Nội dung 3</label>
                        <input type="text" class="form-control" name="delivery_content_3" value="<?php echo @$setting['delivery_content_3'];?>" />
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>

        <!-- Khối Chân trang -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Liên Hệ</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Địa Chỉ</label>
                        <input type="text" class="form-control" name="footer_address" value="<?php echo @$setting['footer_address'];?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Email</label>
                        <input type="text" class="form-control" name="footer_email" value="<?php echo @$setting['footer_email'];?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Số điện thoại</label>
                        <input type="text" class="form-control" name="footer_phone_number" value="<?php echo @$setting['footer_phone_number'];?>" />
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>
        <!-- Khối liên kết -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Đường Link</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Instagram</label>
                        <input type="text" class="form-control" name="instagram_link" value="<?php echo @$setting['instagram_link'];?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Facebook</label>
                        <input type="text" class="form-control" name="facebook_link" value="<?php echo @$setting['facebook_link'];?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Linkedin</label>
                        <input type="text" class="form-control" name="linkedin_link" value="<?php echo @$setting['linkedin_link'];?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Youtube</label>
                        <input type="text" class="form-control" name="youtube_link" value="<?php echo @$setting['youtube_link'];?>" />
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
