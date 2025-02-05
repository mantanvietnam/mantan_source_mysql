<!-- Helpers -->

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">	 Theme - Home Setting</h4>
  <!-- Basic Layout -->
  <p><?php echo @$mess;?></p>
  <?= $this->Form->create(); ?>
  <div class="row">

    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Khối banner</h5>
        </div>
        <div class="card-body row">
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">Logo</label>
            <?php showUploadFile('image_logo','image_logo', @$setting['image_logo'],1);?>
          </div>
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">Link ảnh 360</label>
            <input type="text" class="form-control" name="link_image360" value="<?php echo @$setting['link_image360'];?>" />
          </div>
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">tiêu đền bannar</label>
            <input type="text" class="form-control" name="title1" value="<?php echo @$setting['title1'];?>" />
          </div>
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">chữ nhỏ bannar</label>
            <input type="text" class="form-control" name="text_1" value="<?php echo @$setting['text_1'];?>" />
          </div>
          <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
        </div>
      </div>
    </div>

    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Khối điểm đến Văn hóa</h5>
        </div>
        <div class="card-body row">
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">tiêu đề</label>
            <input type="text" class="form-control" name="title2" value="<?php echo @$setting['title2'];?>" />
          </div>
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">chữ nhỏ</label>
            <input type="text" class="form-control" name="text_2" value="<?php echo @$setting['text_2'];?>" />
          </div>
          <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
        </div>
      </div>
    </div>

    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Khối tin tức</h5>
        </div>
        <div class="card-body row">
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">tiêu đề</label>
            <input type="text" class="form-control" name="title3" value="<?php echo @$setting['title3'];?>" />
          </div>
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">chữ nhỏ</label>
            <input type="text" class="form-control" name="text_3" value="<?php echo @$setting['text_3'];?>" />
          </div>
          <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
        </div>
      </div>
    </div>
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Khối sự kện </h5>
        </div>
        <div class="card-body row">
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">tiêu đề</label>
            <input type="text" class="form-control" name="title6" value="<?php echo @$setting['title6'];?>" />
          </div>
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">ảnh banne chưa có sự kiện</label>
            <?php showUploadFile('image_6','image_6', @$setting['image_6'],6);?>
          </div>
          <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
        </div>
      </div>
    </div>

    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Khối Bản đồ</h5>
        </div>
        <div class="card-body row">
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">tiêu đề</label>
            <input type="text" class="form-control" name="title4" value="<?php echo @$setting['title4'];?>" />
          </div>
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">chữ nhỏ</label>
            <input type="text" class="form-control" name="text_4" value="<?php echo @$setting['text_4'];?>" />
          </div>
          <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
        </div>
      </div>
    </div>

    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Khối  ảnh 360</h5>
        </div>
        <div class="card-body row">
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">tiêu đề</label>
            <input type="text" class="form-control" name="title5" value="<?php echo @$setting['title5'];?>" />
          </div>
          <div class="mb-3 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="basic-default-fullname">chữ nhỏ</label>
            <input type="text" class="form-control" name="text_5" value="<?php echo @$setting['text_5'];?>" />
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
              <label class="form-label" for="basic-default-fullname">Id nhóm link liên kết chân trang</label>
              <input type="text" class="form-control" name="idlink" value="<?php echo @$setting['idlink'];?>" />
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
              <label class="form-label" for="basic-default-fullname">chữ dưới cùng</label>
              <input type="text" class="form-control" name="text_footer" value="<?php echo @$setting['text_footer'];?>" />
            </div>                  
          </div>
          <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
        </div>
      </div>
    </div>
  </div>
  <?= $this->Form->end() ?>
</div>