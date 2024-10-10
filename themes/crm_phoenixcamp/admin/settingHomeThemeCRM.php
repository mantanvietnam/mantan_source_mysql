<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">iCHAM CRM - Cài đặt trang chủ</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <!-- Khối banner -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối banner</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tên thương hiệu</label>
                  <input type="text" class="form-control" name="name_web" value="<?php echo @$setting['name_web'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Logo</label>
                  <?php showUploadFile('logo','logo',@$setting['logo'],0);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Mã màu chủ đạo</label>
                  <input type="text" class="form-control" name="background_color" value="<?php echo @$setting['background_color'];?>" />
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

        <!-- Khối tra cứu -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối tra cứu</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Ảnh nền</label>
                  <?php showUploadFile('background_image_1','background_image_1',@$setting['background_image_1'],1);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Ảnh minh họa 1</label>
                  <?php showUploadFile('image_product_1','image_product_1',@$setting['image_product_1'],2);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Ảnh minh họa 2</label>
                  <?php showUploadFile('image_product_2','image_product_2',@$setting['image_product_2'],3);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Ảnh minh họa 3</label>
                  <?php showUploadFile('image_product_3','image_product_3',@$setting['image_product_3'],4);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Ảnh minh họa 4</label>
                  <?php showUploadFile('image_product_4','image_product_4',@$setting['image_product_4'],5);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Ảnh minh họa 5</label>
                  <?php showUploadFile('image_product_5','image_product_5',@$setting['image_product_5'],6);?>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Khối Khối chân trang -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối chân trang</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Giới thiệu</label>
                  <textarea class="form-control" rows="3" name="content_footer"><?php echo @$setting['content_footer'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Ảnh nền 2</label>
                  <?php showUploadFile('background_image_2','background_image_2',@$setting['background_image_2'],7);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Ảnh nền 3</label>
                  <?php showUploadFile('background_image_3','background_image_3',@$setting['background_image_3'],8);?>
                </div>
              </div>
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

               <!-- Khối Khối chân trang -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối về chúng tôi</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">tiêu đề 1</label>
                  <input type="text" class="form-control" name="title_footer1" value="<?php echo @$setting['title_footer1'];?>" />
                  <label class="form-label" for="basic-default-fullname">Link 1</label>
                  <input type="text" class="form-control" name="link_footer1" value="<?php echo @$setting['link_footer1'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">tiêu đề 2</label>
                  <input type="text" class="form-control" name="title_footer2" value="<?php echo @$setting['title_footer2'];?>" />
                  <label class="form-label" for="basic-default-fullname">Link 2</label>
                  <input type="text" class="form-control" name="link_footer1" value="<?php echo @$setting['link_footer2'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">tiêu đề 3</label>
                  <input type="text" class="form-control" name="title_footer3" value="<?php echo @$setting['title_footer3'];?>" />
                  <label class="form-label" for="basic-default-fullname">Link 3</label>
                  <input type="text" class="form-control" name="link_footer3" value="<?php echo @$setting['link_footer3'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">tiêu đề 4</label>
                  <input type="text" class="form-control" name="title_footer4" value="<?php echo @$setting['title_footer4'];?>" />
                  <label class="form-label" for="basic-default-fullname">Link 4</label>
                  <input type="text" class="form-control" name="link_footer4" value="<?php echo @$setting['link_footer4'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">tiêu đề 5</label>
                  <input type="text" class="form-control" name="title_footer5" value="<?php echo @$setting['title_footer5'];?>" />
                  <label class="form-label" for="basic-default-fullname">Link 5</label>
                  <input type="text" class="form-control" name="link_footer5" value="<?php echo @$setting['link_footer5'];?>" />
                </div>
                 <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">tiêu đề 6</label>
                  <input type="text" class="form-control" name="title_footer6" value="<?php echo @$setting['title_footer6'];?>" />
                  <label class="form-label" for="basic-default-fullname">Link 6</label>
                  <input type="text" class="form-control" name="link_footer6" value="<?php echo @$setting['link_footer6'];?>" />
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