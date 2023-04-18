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
                  <label class="form-label" for="basic-default-fullname">Điện thoại</label>
                  <input type="text" class="form-control" name="phone" value="<?php echo @$setting['phone'];?>" />
                </div>
                <div class="mb-3 ">
                  <label class="form-label" for="basic-default-fullname">Email</label>
                  <input type="text" class="form-control" name="email" value="<?php echo @$setting['email'];?>" />
                </div>
                <div class="mb-3 ">
                    <label class="form-label" for="basic-default-fullname">Zalo</label>
                    <input type="text" class="form-control" name="zalo" value="<?php echo @$setting['zalo'];?>" />
                  </div>
                  <div class="mb-3 ">
                    <label class="form-label" for="basic-default-fullname">Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="<?php echo @$setting['facebook'];?>" />
                  </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3 ">
                  
                    <label class="form-label" for="basic-default-fullname">Chịu trách nhiệm chính</label>
                    <input type="text" class="form-control" name="responsibility" value="<?php echo @$setting['responsibility'];?>" />
                  </div>
                  <div class="mb-3 ">
                    <label class="form-label" for="basic-default-fullname">Điện thoại:</label>
                    <input type="text" class="form-control" name="responsibilityphone" value="<?php echo @$setting['responsibilityphone'];?>" />
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
                    <label class="form-label" for="basic-default-fullname">Youtube</label>
                    <input type="text" class="form-control" name="youtube" value="<?php echo @$setting['youtube'];?>" />
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

  text-welcome