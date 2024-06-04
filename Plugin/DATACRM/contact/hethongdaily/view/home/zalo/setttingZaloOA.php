<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/setttingZaloOA">Zalo OA</a> /</span>
    Cài đặt
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cài đặt Zalo OA</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <p>Đường dẫn callback: <?php global $urlHomes;echo $urlHomes.'callbackZalo';?></p>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">ID Zalo OA (*)</label>
                    <input required type="text" class="form-control phone-mask" name="id_oa" id="id_oa" value="<?php echo @$data->id_oa;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">ID APP (*)</label>
                    <input required type="text" class="form-control phone-mask" name="id_app" id="id_app" value="<?php echo @$data->id_app;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Mã bảo mật ứng dụng (*)</label>
                    <input required type="text" class="form-control phone-mask" name="secret_key" id="secret_key" value="<?php echo @$data->secret_key;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">ID template OTP (*)</label>
                    <input required type="text" class="form-control phone-mask" name="template_otp" id="template_otp" value="<?php echo @$data->template_otp;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Mã code xác thực</label>
                    <input disabled type="text" class="form-control phone-mask" name="oauth_code" id="oauth_code" value="<?php echo @$data->oauth_code;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Mã access token</label>
                    <input disabled type="text" class="form-control phone-mask" name="access_token" id="access_token" value="<?php echo @$data->access_token;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Mã refresh token</label>
                    <input disabled type="text" class="form-control phone-mask" name="refresh_token" id="refresh_token" value="<?php echo @$data->refresh_token;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Thời gian hiệu lực</label>
                    <input disabled type="text" class="form-control phone-mask" name="deadline" id="deadline" value="<?php if(!empty($data->deadline)) echo date('H:i d/m/Y', $data->deadline);?>" />
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
              <?php 
              if(!empty($data->id_oa) && !empty($data->id_app) && !empty($data->secret_key)){
                echo '<a target="_blank" href="https://developers.zalo.me/app/'.$data->id_app.'/oa/settings" class="btn btn-danger">Lấy mã token</a>';
              }
              ?>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>