<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Warm Theme - Cài đặt trang chủ</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <!-- Khối banner -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối đầu trang</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tên nút bấm</label>
                  <input type="text" class="form-control" name="name_button_sub" value="<?php echo @$setting['name_button_sub'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Link nút bấm</label>
                  <input type="text" class="form-control" name="link_button_sub" value="<?php echo @$setting['link_button_sub'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ID banner trang chủ </label>
                  <input type="text" class="form-control" name="id_slide" value="<?php echo @$setting['id_slide'];?>" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

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

        <!-- Section 1 -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối mục 1</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1</label>
                  <input type="text" class="form-control" name="title_section_1" value="<?php echo @$setting['title_section_1'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề nội dung</label>
                  <input type="text" class="form-control" name="title_content_section_1" value="<?php echo @$setting['title_content_section_1'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề phụ nội dung</label>
                  <input type="text" class="form-control" name="title_sub_section_1" value="<?php echo @$setting['title_sub_section_1'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Link video</label>
                  <input type="text" class="form-control" name="link_video_section_1" value="<?php echo @$setting['link_video_section_1'];?>" />
                </div>
              </div>
              
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung</label>
                  <?php showEditorInput('content_section_1', 'content_section_1', @$setting['content_section_1']);?>
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

         <!-- Section 2 -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối mục 2</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề mục 2</label>
                  <input type="text" class="form-control" name="title_section_2" value="<?php echo @$setting['title_section_2'];?>" />
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
              <h5 class="mb-0">Khối mục 3</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề mục 3</label>
                  <input type="text" class="form-control" name="title_section_3" value="<?php echo @$setting['title_section_3'];?>" />
                </div>
              </div>

              <!-- Nôi dung 1 -->
              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề nội dung 1</label>
                  <input type="text" class="form-control" name="title_content_1_section_3" value="<?php echo @$setting['title_content_1_section_3'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 1</label>
                  <input type="text" class="form-control" name="content_1_section_3" value="<?php echo @$setting['content_1_section_3'];?>" />
                </div>
              </div>

              <!-- Nôi dung 2 -->
              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề nội dung 2</label>
                  <input type="text" class="form-control" name="title_content_2_section_3" value="<?php echo @$setting['title_content_2_section_3'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 2</label>
                  <input type="text" class="form-control" name="content_2_section_3" value="<?php echo @$setting['content_2_section_3'];?>" />
                </div>
              </div>

              <!-- Nôi dung 3 -->
              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề nội dung 3</label>
                  <input type="text" class="form-control" name="title_content_3_section_3" value="<?php echo @$setting['title_content_3_section_3'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 3</label>
                  <input type="text" class="form-control" name="content_3_section_3" value="<?php echo @$setting['content_3_section_3'];?>" />
                </div>
              </div>

              <!-- Nôi dung 4 -->
              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề nội dung 4</label>
                  <input type="text" class="form-control" name="title_content_4_section_3" value="<?php echo @$setting['title_content_4_section_3'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 4</label>
                  <input type="text" class="form-control" name="content_4_section_3" value="<?php echo @$setting['content_4_section_3'];?>" />
                </div>
              </div>

              


              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Section 4 -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối mục 4</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề mục 4</label>
                  <input type="text" class="form-control" name="title_section_4" value="<?php echo @$setting['title_section_4'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

         <!-- Chân trang-->
         <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Chân trang</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề mục 1</label>
                  <input type="text" class="form-control" name="title_1_section_footer" value="<?php echo @$setting['title_1_section_footer'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Địa chỉ 1</label>
                  <input type="text" class="form-control" name="address_section_footer" value="<?php echo @$setting['address_section_footer'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tel 1</label>
                  <input type="text" class="form-control" name="tel_section_footer" value="<?php echo @$setting['tel_section_footer'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề mục 2</label>
                  <input type="text" class="form-control" name="title_2_section_footer" value="<?php echo @$setting['title_2_section_footer'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Địa chỉ 2</label>
                  <input type="text" class="form-control" name="address_2_section_footer" value="<?php echo @$setting['address_2_section_footer'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Địa chỉ 2-2</label>
                  <input type="text" class="form-control" name="address_2_2_section_footer" value="<?php echo @$setting['address_2_2_section_footer'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tel 2</label>
                  <input type="text" class="form-control" name="tel_2_section_footer" value="<?php echo @$setting['tel_2_section_footer'];?>" />
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