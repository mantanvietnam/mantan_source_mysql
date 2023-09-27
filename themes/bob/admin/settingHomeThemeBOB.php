<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Warm Theme - Cài đặt trang chủ</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
   <!-- Tài khoản mạng xã hội -->
   <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Tài khoản mạng xã hội</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Facebook</label>
                  <input type="text" class="form-control" name="facebook" value="<?php echo @$setting['facebook'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Youtube</label>
                  <input type="text" class="form-control" name="youtube" value="<?php echo @$setting['youtube'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">TikTok</label>
                  <input type="text" class="form-control" name="tiktok" value="<?php echo @$setting['tiktok'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Instagram</label>
                  <input type="text" class="form-control" name="instagram" value="<?php echo @$setting['instagram'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Pinterest</label>
                  <input type="text" class="form-control" name="pinterest" value="<?php echo @$setting['pinterest'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Twitter</label>
                  <input type="text" class="form-control" name="twitter" value="<?php echo @$setting['twitter'];?>" />
                </div>
              </div>
               
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Khối banner -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Banner trang chủ</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ID banner trang chủ </label>
                  <input type="text" class="form-control" name="id_slide" value="<?php echo @$setting['id_slide'];?>" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Section 1 -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối 1</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề </label>
                            <input type="text" class="form-control" name="title_section1" value="<?php echo @$setting['title_section1'];?>" />
                        </div>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề phụ </label>
                            <input type="text" class="form-control" name="titlesub_section1" value="<?php echo @$setting['titlesub_section1'];?>" />
                        </div>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
          </div>
        </div>

        <!-- Section 2 -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối 2</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề </label>
                            <input type="text" class="form-control" name="title_section2" value="<?php echo @$setting['title_section2'];?>" />
                        </div>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề phụ </label>
                            <input type="text" class="form-control" name="titlesub_section2" value="<?php echo @$setting['titlesub_section2'];?>" />
                        </div>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
          </div>
        </div>

        <!-- Section 3 -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối 3</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề </label>
                            <input type="text" class="form-control" name="title_section3" value="<?php echo @$setting['title_section3'];?>" />
                        </div>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề phụ </label>
                            <input type="text" class="form-control" name="titlesub_section3" value="<?php echo @$setting['titlesub_section3'];?>" />
                        </div>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Ảnh </label>
                            <?php showUploadFile('image_section3','image_section3',  @$setting['image_section3'],0);?></div>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
          </div>
        </div>

         <!-- Chân trang -->
         <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Chân trang</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề 1</label>
                            <input type="text" class="form-control" name="title1_footer" value="<?php echo @$setting['title1_footer'];?>" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">ID menu 1</label>
                            <input type="text" class="form-control" name="id1_menu_footer" value="<?php echo @$setting['id1_menu_footer'];?>" />
                        </div>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề 2 </label>
                            <input type="text" class="form-control" name="title2_footer" value="<?php echo @$setting['title2_footer'];?>" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">ID menu 2</label>
                            <input type="text" class="form-control" name="id2_menu_footer" value="<?php echo @$setting['id2_menu_footer'];?>" />
                        </div>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tiêu đề 3 </label>
                            <input type="text" class="form-control" name="title3_footer" value="<?php echo @$setting['title3_footer'];?>" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Hotline </label>
                            <input type="text" class="form-control" name="hotline_footer" value="<?php echo @$setting['hotline_footer'];?>" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Link Hotline </label>
                            <input type="text" class="form-control" name="link_hotline_footer" value="<?php echo @$setting['link_hotline_footer'];?>" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Địa chỉ </label>
                            <input type="text" class="form-control" name="address_footer" value="<?php echo @$setting['address_footer'];?>" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Link Địa chỉ </label>
                            <input type="text" class="form-control" name="link_address_footer" value="<?php echo @$setting['link_address_footer'];?>" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Email </label>
                            <input type="text" class="form-control" name="email_footer" value="<?php echo @$setting['email_footer'];?>" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Link Email </label>
                            <input type="text" class="form-control" name="link_email_footer" value="<?php echo @$setting['link_email_footer'];?>" />
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
    <?= $this->Form->end() ?>
  </div>