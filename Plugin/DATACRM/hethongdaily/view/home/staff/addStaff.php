<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listStaff">Hệ thống nhân viên</a> /</span>
    Thông tin nhân viên
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin nhân viên</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Họ tên (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text" required  class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                    <input type="file" class="form-control phone-mask" name="avatar" id="avatar" value=""/>
                    <?php
                    if(!empty($data->avatar)){
                      echo '<br/><img src="'.$data->avatar.'" width="80" />';
                    }
                    ?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <!--
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mật khẩu tài khoản</label>
                    <input type="password" autocomplete="off" class="form-control" placeholder="" name="password" id="password" value="" />
                  </div>
                  -->
                   <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Ngày sinh</label>
                    <input autocomplete="off" type="text" class="form-control datepicker" name="birthday" id="name" value="<?php echo date('d/m/Y',@$data->birthday);?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input autocomplete="off" type="text" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                    <input type="text" class="form-control phone-mask" name="address" id="name" value="<?php echo @$data->address;?>" />
                  </div>
                  
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Giới thiệu bản thân</label>
                    <?php showEditorInput('description', 'description', @$data->description);?>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>