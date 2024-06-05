<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/account">Tài khoản</a> /</span>
    Đổi thông tin
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Đổi thông tin</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Họ tên (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$user->name;?>"/>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Ảnh đại diện (*)</label>
                    <?php showUploadFile('avatar','avatar',@$user->avatar,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Ảnh banner chia sẻ</label>
                    <?php showUploadFile('banner','banner',@$user->banner,1);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Email (*)</label>
                    <input required type="text" class="form-control phone-mask" name="email" id="email" value="<?php echo @$user->email;?>"/>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Ngày sinh</label>
                    <input autocomplete="off" type="text" class="form-control datepicker" name="birthday" id="name" value="<?php echo @$user->birthday;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Twitter</label>
                    <input type="text" class="form-control phone-mask" name="twitter" id="twitter" value="<?php echo @$user->twitter;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Kênh Tiktok</label>
                    <input type="text" class="form-control phone-mask" name="tiktok" id="tiktok" value="<?php echo @$user->tiktok;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Kênh Youtube</label>
                    <input type="text" class="form-control phone-mask" name="youtube" id="youtube" value="<?php echo @$user->youtube;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Linkedin</label>
                    <input type="text" class="form-control phone-mask" name="linkedin" id="linkedin" value="<?php echo @$user->linkedin;?>" />
                  </div>

                  
                </div>
                
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Số điện thoại (*)</label>
                    <input disabled type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$user->phone;?>"/>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <input required type="text" class="form-control phone-mask" name="address" id="address" value="<?php echo @$user->address;?>"/>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Website</label>
                    <input type="text" class="form-control phone-mask" name="web" id="web" value="<?php echo @$user->web;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Facebook</label>
                    <input type="text" class="form-control phone-mask" name="facebook" id="facebook" value="<?php echo @$user->facebook;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Instagram</label>
                    <input type="text" class="form-control phone-mask" name="instagram" id="instagram" value="<?php echo @$user->instagram;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Zalo</label>
                    <input type="text" class="form-control phone-mask" name="zalo" id="zalo" value="<?php echo @$user->zalo;?>" />
                  </div>
                   <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Giao diện trang info</label>
                    <select required class="form-select" name="display_info" id="display_info">
                        <option value="">Chọn giao diện trang info</option>
                        <?php foreach($displayInfo as $key => $item){
                          $selected = '';
                          if($user->display_info==$key){ 
                            $selected = 'selected';
                          }
                          echo'<option value="'.$key.'" '.$selected.' >'.$item.'</option>';
                        } ?>
                      </select>
                  </div>
                   <div class="mb-3">
                    <label class="form-label">Ảnh mã QR thanh toán</label>
                    <?php showUploadFile('image_qr_pay','image_qr_pay',@$user->image_qr_pay,3);?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Mã QR của bạn</label><br/>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.'info/?id='.@$user->id;?>" width="100">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Giới thiệu bản thân</label>
                    <?php showEditorInput('description', 'description', @$user->description);?>
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