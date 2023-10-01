<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Kế toán theme - Cài đặt trang chủ</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">

        <!-- Tài khoản mạng xã hội -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
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
                  <label class="form-label" for="basic-default-fullname">LinkedIn</label>
                  <input type="text" class="form-control" name="linkedIn" value="<?php echo @$setting['linkedIn'];?>" />
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

        <!-- Khối mục 1 -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối mục 1</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Khối mục 1</label>
                    <input type="text" class="form-control" name="title_section1" value="<?php echo @$setting['title_section1'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1-1</label>
                    <input type="text" class="form-control" name="content_title_section1_1" value="<?php echo @$setting['content_title_section1_1'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1-2</label>
                    <input type="text" class="form-control" name="content_title_section1_2" value="<?php echo @$setting['content_title_section1_2'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1-3</label>
                    <input type="text" class="form-control" name="content_title_section1_3" value="<?php echo @$setting['content_title_section1_3'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1-4</label>
                    <input type="text" class="form-control" name="content_title_section1_4" value="<?php echo @$setting['content_title_section1_4'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 1-1</label>
                    <input type="text" class="form-control" name="content_detail_section1_1" value="<?php echo @$setting['content_detail_section1_1'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 1-2</label>
                    <input type="text" class="form-control" name="content_detail_section1_2" value="<?php echo @$setting['content_detail_section1_2'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 1-3</label>
                    <input type="text" class="form-control" name="content_detail_section1_3" value="<?php echo @$setting['content_detail_section1_3'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 1-4</label>
                    <input type="text" class="form-control" name="content_detail_section1_4" value="<?php echo @$setting['content_detail_section1_4'];?>" />
                  </div>
                </div>
                
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>

        <!-- Khối mục 1 -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối mục 2</h5>
            </div>
            <div class="card-body row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Khối mục 2</label>
                    <input type="text" class="form-control" name="title_section2" value="<?php echo @$setting['title_section2'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 2-1</label>
                    <input type="text" class="form-control" name="content_title_section2_1" value="<?php echo @$setting['content_title_section2_1'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 2-2</label>
                    <input type="text" class="form-control" name="content_title_section2_2" value="<?php echo @$setting['content_title_section2_2'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề mục 2-3</label>
                    <input type="text" class="form-control" name="content_title_section2_3" value="<?php echo @$setting['content_title_section2_3'];?>" />
                  </div>
                </div>

                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 2-1</label>
                    <input type="text" class="form-control" name="content_detail_section2_1" value="<?php echo @$setting['content_detail_section2_1'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 2-2</label>
                    <input type="text" class="form-control" name="content_detail_section2_2" value="<?php echo @$setting['content_detail_section2_2'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mục 2-3</label>
                    <input type="text" class="form-control" name="content_detail_section2_3" value="<?php echo @$setting['content_detail_section2_3'];?>" />
                  </div>
                </div>
                
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
          </div>
        </div>

        <!-- Khối Khối chân trang -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối chân trang</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1</label>
                  <input type="text" class="form-control" name="title1_footer" value="<?php echo @$setting['title1_footer'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề mục 2</label>
                  <input type="text" class="form-control" name="title2_footer" value="<?php echo @$setting['title2_footer'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ID menu</label>
                  <input type="text" class="form-control" name="idMenu_footer" value="<?php echo @$setting['idMenu_footer'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Copyright</label>
                  <input type="text" class="form-control" name="copyright_footer" value="<?php echo @$setting['copyright_footer'];?>" />
                </div>
              </div>
                
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>



      </div>
    <?= $this->Form->end() ?>
  </div>