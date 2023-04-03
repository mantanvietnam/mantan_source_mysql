<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">	 Theme - Home Setting</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối banner</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Logo</label>
                   <?php showUploadFile('image_logo','image_logo', @$setting['image_logo'],1);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Link ảnh 360</label>
                  <input type="text" class="form-control" name="link_image360" value="<?php echo @$setting['link_image360'];?>" />
                </div>

               <!--  <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Link button</label>
                  <input type="text" class="form-control" name="link_button" value="<?php echo @$setting['link_button'];?>" />
                </div> -->

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Welcome</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 1</label>
                  <input type="text" class="form-control" name="welcome1" value="<?php echo @$setting['welcome1'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 2</label>
                  <input type="text" class="form-control" name="welcome2" value="<?php echo @$setting['welcome2'];?>" />
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">CẨM NANG DU LỊCH</h5>
            </div>
            <div  class="row card-body">
            <div class=" col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 1</label>
                  <input type="text" class="form-control" name="title_travel1" value="<?php echo @$setting['title_travel1'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ảnh 1</label>
                  <?php showUploadFile('image_travel1','image_travel1', @$setting['image_travel1'],2);?> 
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">link 1</label>
                  <input type="text" class="form-control" name="link_travel1" value="<?php echo @$setting['link_travel1'];?>" />
                </div>
             </div>
            <div class=" col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 2</label>
                  <input type="text" class="form-control" name="title_travel2" value="<?php echo @$setting['title_travel2'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ảnh 2</label>
                  <?php showUploadFile('image_travel2','image_travel2', @$setting['image_travel2'],3);?> 
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">link 2</label>
                  <input type="text" class="form-control" name="link_travel2" value="<?php echo @$setting['link_travel2'];?>" />
                </div>
            </div>
            <div class=" col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 3</label>
                  <input type="text" class="form-control" name="title_travel3" value="<?php echo @$setting['title_travel3'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ảnh 3</label>
                  <?php showUploadFile('image_travel3','image_travel3', @$setting['image_travel3'],4);?> 
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">link 3</label>
                  <input type="text" class="form-control" name="link_travel3" value="<?php echo @$setting['link_travel3'];?>" />
                </div>
            </div>
            <div class=" col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 4</label>
                  <input type="text" class="form-control" name="title_travel4" value="<?php echo @$setting['title_travel4'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ảnh 4</label>
                  <?php showUploadFile('image_travel4','image_travel4', @$setting['image_travel4'],5);?> 
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">link 4</label>
                  <input type="text" class="form-control" name="link_travel4" value="<?php echo @$setting['link_travel4'];?>" />
                </div>
            </div>

             <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
            </div>
               
           
          </div>
        </div>

 <!--       <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối chân trang</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tên thương hiệu</label>
                  <input type="text" class="form-control" name="brand_name" value="<?php echo @$setting['brand_name'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề khối đăng ký nhận thông báo</label>
                  <input type="text" class="form-control" name="title_subscribe" value="<?php echo @$setting['title_subscribe'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Mô tả khối đăng ký nhận thông báo</label>
                  <input type="text" class="form-control" name="description_subscribe" value="<?php echo @$setting['description_subscribe'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ID menu chân trang</label>
                  <input type="text" class="form-control" name="id_menu_footer" value="<?php echo @$setting['id_menu_footer'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Logo website</label>
                  <?php showUploadFile('logo','logo', @$setting['logo'],0);?>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Tài khoản mạng xã hội</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Facebook</label>
                  <input type="text" class="form-control" name="facebook" value="<?php echo @$setting['facebook'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Youtube</label>
                  <input type="text" class="form-control" name="youtube" value="<?php echo @$setting['youtube'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">TikTok</label>
                  <input type="text" class="form-control" name="tiktok" value="<?php echo @$setting['tiktok'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Instagram</label>
                  <input type="text" class="form-control" name="instagram" value="<?php echo @$setting['instagram'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">LinkedIn</label>
                  <input type="text" class="form-control" name="linkedIn" value="<?php echo @$setting['linkedIn'];?>" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div> -->

      </div>
    <?= $this->Form->end() ?>
  </div>

  text-welcome