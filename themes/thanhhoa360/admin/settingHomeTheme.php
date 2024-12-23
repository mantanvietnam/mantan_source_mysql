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
                <button type="submit" class="btn btn-primary">Lưu</button>

            </div>

          </div>

        </div>


        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Tiêu đề ở ảnh 360</h5>
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
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Content</label>
                  <input type="text" class="form-control" name="content_welcome" value="<?php echo @$setting['content_welcome'];?>" />
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        

        



        <div class="col-12 col-xs-12 ">

          <div class="card mb-4">

            <div class="card-header d-flex justify-content-between align-items-center">

              <h5 class="mb-0">Chân trang</h5>

            </div>

            <div class="card-body row">

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

                <div class="mb-3 ">

                  <label class="form-label" for="basic-default-fullname">Tiên đề</label>

                  <input type="text" class="form-control" name="title_footer" value="<?php echo @$setting['title_footer'];?>" />

                </div>

                <div class="mb-3 ">

                  <label class="form-label" for="basic-default-fullname">Cơ quan chủ quản:</label>

                  <input type="text" class="form-control" name="agency" value="<?php echo @$setting['agency'];?>" />

                </div>

                <div class="mb-3 ">

                  <label class="form-label" for="basic-default-fullname">Địa chỉ</label>

                  <input type="text" class="form-control" name="address" value="<?php echo @$setting['address'];?>" />

                </div>

                <div class="mb-3 ">

                    <label class="form-label" for="basic-default-fullname">Instagram</label>

                    <input type="text" class="form-control" name="zalo" value="<?php echo @$setting['zalo'];?>" />

                  </div>

                  <div class="mb-3 ">

                    <label class="form-label" for="basic-default-fullname">Facebook</label>

                    <input type="text" class="form-control" name="facebook" value="<?php echo @$setting['facebook'];?>" />

                  </div>

                  <div class="mb-3 ">

                    <label class="form-label" for="basic-default-fullname">Youtube</label>

                    <input type="text" class="form-control" name="youtube" value="<?php echo @$setting['youtube'];?>" />

                  </div>

                </div>

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

                  <div class="mb-3 ">

                  

                    <label class="form-label" for="basic-default-fullname">Chịu trách nhiệm chính</label>

                    <input type="text" class="form-control" name="responsibility" value="<?php echo @$setting['responsibility'];?>" />

                  </div>

                  <div class="mb-3 ">

                  <label class="form-label" for="basic-default-fullname">Điện thoại</label>

                  <input type="text" class="form-control" name="phone" value="<?php echo @$setting['phone'];?>" />

                </div>

                  <div class="mb-3 ">

                    <label class="form-label" for="basic-default-fullname">Email</label>

                    <input type="text" class="form-control" name="responsibilityemail" value="<?php echo @$setting['responsibilityemail'];?>" />

                  </div>

                  <div class="mb-3 ">

                    <label class="form-label" for="basic-default-fullname">Theo dõi chúng tôi qua</label>

                    <input type="text" class="form-control" name="follow" value="<?php echo @$setting['follow'];?>" />

                  </div>

                   <div class="mb-3 ">

                    <label class="form-label" for="basic-default-fullname">Id nhóm link liên kết chân trang</label>

                    <input type="text" class="form-control" name="idlink" value="<?php echo @$setting['idlink'];?>" />

                  </div>

                  

                  <div class="mb-3 ">

                    <label class="form-label" for="basic-default-fullname">Tiktok</label>

                    <input type="text" class="form-control" name="tiktok" value="<?php echo @$setting['tiktok'];?>" />

                  </div>

                  

                </div>



                <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>

            </div>



          </div>

        </div>



       

      </div>

    <?= $this->Form->end() ?>

  </div>