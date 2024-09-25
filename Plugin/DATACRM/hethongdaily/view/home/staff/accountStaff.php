<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listStaff"><a href="/accountStaff">Tài khoản</a> /</span>
    Đổi thông tin</span>
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

                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Linkedin</label>
                    <input type="text" class="form-control phone-mask" name="linkedin" id="linkedin" value="<?php echo @$data->linkedin;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Website</label>
                    <input type="text" class="form-control phone-mask" name="web" id="web" value="<?php echo @$data->web;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Instagram</label>
                    <input type="text" class="form-control phone-mask" name="instagram" id="instagram" value="<?php echo @$data->instagram;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                   <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Ngày sinh</label>
                    <input autocomplete="off" type="text" class="form-control datepicker" name="birthday" id="name" value="<?php if(!empty($data->status)) echo  date('d/m/Y',@$data->birthday);?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input autocomplete="off" type="text" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                    <input type="text" class="form-control phone-mask" name="address" id="name" value="<?php echo @$data->address;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Facebook</label>
                    <input type="text" class="form-control phone-mask" name="facebook" id="facebook" value="<?php echo @$data->facebook;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Twitter</label>
                    <input type="text" class="form-control phone-mask" name="twitter" id="twitter" value="<?php echo @$data->twitter;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Kênh Tiktok</label>
                    <input type="text" class="form-control phone-mask" name="tiktok" id="tiktok" value="<?php echo @$data->tiktok;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Kênh Youtube</label>
                    <input type="text" class="form-control phone-mask" name="youtube" id="youtube" value="<?php echo @$data->youtube;?>" />
                  </div>
                   <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Zalo</label>
                    <input type="text" class="form-control phone-mask" name="zalo" id="zalo" value="<?php echo @$data->zalo;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Mã QR của bạn</label><br/>
                    <div class="row">
                      <div class="col-md-6">
                        <img class="mb-3" id="QRURLProfile" src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.'staff/?id='.@$data->id;?>" width="100">
                      </div>
                      <div class="col-md-6">
                        <button type="button" class="btn btn-primary mb-3" onclick="copyToClipboard('<?php echo $urlHomes.'staff/?id='.@$data->id;?>', 'Đã copy thành công link liên kết');"><i class='bx bx-link'></i> Sao chép liên kết</button>

                        <button type="button" class="btn btn-danger mb-3" onclick="downloadImageFromSrc('https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.'staff/?id='.@$data->id;?>', '<?php echo $data->phone;?>');"><i class='bx bx-cloud-download'></i> Tải mã QR</button>
                      </div>
                    </div>
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
<script type="text/javascript">
    function downloadImageFromSrc(url, phone){
      var fileName = 'QR_ICHAM_'+phone+'.jpg';
      var xhr = new XMLHttpRequest();
      xhr.open("GET", url, true);
      xhr.responseType = "blob";
      xhr.onload = function(){
          var urlCreator = window.URL || window.webkitURL;
          var imageUrl = urlCreator.createObjectURL(this.response);
          var tag = document.createElement('a');
          tag.href = imageUrl;
          tag.download = fileName;
          document.body.appendChild(tag);
          tag.click();
          document.body.removeChild(tag);
      }
      xhr.send();
  }
</script>

<?php include(__DIR__.'/../footer.php'); ?>