<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="">Zalo</a> /</span>
    Cài đặt Zalo
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cài đặt Zalo</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess; ?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-12">
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                          Zalo cá nhân
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Zalo OA
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">ID Zalo APP</label>
                              <input type="text" class="form-control phone-mask" name="id_app_zalo" id="id_app_zalo" value="<?php echo @$infoUser->id_app_zalo;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mã bảo mật APP Zalo</label>
                              <input type="text" class="form-control phone-mask" name="secret_app_zalo" id="secret_app_zalo" value="<?php echo @$infoUser->secret_app_zalo;?>" />
                            </div>

                            <div class="mb-3">
                              <?php 
                              if(empty($infoUser->id_app_zalo) || empty($infoUser->secret_app_zalo)){
                                echo '<p class="text-danger">Vui lòng nhập ID Zalo APP và Mã bảo mật APP Zalo để thực hiện cấp quyền cho tài khoản Zalo</p>';
                              }else{
                                if(!empty($loginUrl)){
                                  global $urlHomes;

                                  $linkSettingZaloApp = 'https://developers.zalo.me/app/'.$infoUser->id_app_zalo.'/login';

                                  echo '<p><a class="btn btn-danger" href="'.$loginUrl.'">Cấp quyền Zalo</a><p>
                                        
                                        <p>Link calkback: '.$urlHomes.'callbackZalo</p>
                                        <p>Link cài đặt Zalo App: <a href="'.$linkSettingZaloApp.'" target="_blank">'.$linkSettingZaloApp.'</a></p>
                                    ';
                                }else{
                                  echo '<p class="text-danger">Đã kết nối Zalo thành công</p>';
                                }
                              }
                              ?>
                              
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">ID Zalo OA</label>
                              <input type="text" class="form-control phone-mask" name="id_oa_zalo" id="id_oa_zalo" value="<?php echo @$infoUser->id_oa_zalo;?>" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>