<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Thông tin chung</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Cài đặt SEO</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tên website</label>
                  <input type="text" class="form-control" name="title" value="<?php echo @$seo_site_value['title'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Từ khóa</label>
                  <input type="text" class="form-control" name="keyword" value="<?php echo @$seo_site_value['keyword'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Mô tả ngắn</label>
                  <input type="text" class="form-control" name="description" value="<?php echo @$seo_site_value['description'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Số bài viết trên 1 trang</label>
                  <input type="text" class="form-control" name="number_post" value="<?php echo @$seo_site_value['number_post'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-icon-default-message">Mã nhúng script</label>
                  <div class="input-group input-group-merge">
                    <textarea
                      class="form-control"
                      name="code_script"
                      rows=5
                    ><?php echo @$seo_site_value['code_script'];?></textarea>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Thông tin liên hệ</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Số điện thoại</label>
                  <input
                    type="text"
                    class="form-control phone-mask"
                    name="phone"
                    value="<?php echo @$contact_site_value['phone'];?>"
                  />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-email">Email</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="text"
                      class="form-control"
                      name="email"
                      value="<?php echo @$contact_site_value['email'];?>"
                    />
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                  <input type="text" class="form-control" placeholder="" name="address" value="<?php echo @$contact_site_value['address'];?>" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Cài đặt SMTP gửi email</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tài khoản email</label>
                  <input type="text" class="form-control" name="smtp_email" value="<?php echo @$smtp_site_value['email'];?>" />
                </div>

                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="basic-default-fullname">Mật khẩu email</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="smtp_pass"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      value="<?php echo @$smtp_site_value['pass'];?>"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tên hiển thị</label>
                  <input type="text" class="form-control" name="smtp_display_name" value="<?php echo @$smtp_site_value['display_name'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Máy chủ</label>
                  <input type="text" class="form-control" name="smtp_server" placeholder="ssl://smtp.gmail.com" value="<?php echo @$smtp_site_value['server'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Cổng kết nối</label>
                  <input type="text" class="form-control" placeholder="465" name="smtp_port" value="<?php echo @$smtp_site_value['port'];?>" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Hình ảnh</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Logo</label>
                  <?php showUploadFile('logo','logo', @$seo_site_value['logo'],1);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Ành minh họa khi chia sẻ</label>
                  <?php showUploadFile('image_share','image_share', @$seo_site_value['image_share'],2);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Favicon</label>
                  <?php showUploadFile('favicon','favicon', @$seo_site_value['favicon'],3);?>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

      </div>
    <?= $this->Form->end() ?>
  </div>