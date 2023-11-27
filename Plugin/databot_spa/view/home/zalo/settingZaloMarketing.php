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
                          Zalo OA
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Zalo cá nhân
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">ID Zalo APP (*)</label>
                              <input required type="text" class="form-control phone-mask" name="id_app_zalo" id="id_app_zalo" value="<?php echo @$infoUser->id_app_zalo;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Mã bảo mật APP Zalo (*)</label>
                              <input required type="text" class="form-control phone-mask" name="secret_app_zalo" id="secret_app_zalo" value="<?php echo @$infoUser->secret_app_zalo;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">ID Zalo OA (*)</label>
                              <input required type="text" class="form-control phone-mask" name="id_oa_zalo" id="id_oa_zalo" value="<?php echo @$infoUser->id_oa_zalo;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Access token Zalo OA</label>
                              <input disabled type="text" class="form-control phone-mask" name="access_token_zalo_oa" id="access_token_zalo_oa" value="<?php echo @$infoUser->access_token_zalo_oa;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Thời gian hết hiệu lực token Zalo OA</label>
                              <input disabled type="text" class="form-control phone-mask" name="deadline_token_zalo_oa" id="deadline_token_zalo_oa" value="<?php if(!empty($infoUser->deadline_token_zalo_oa)) echo date('H:i d/m/Y', $infoUser->deadline_token_zalo_oa);?>" />
                            </div>

                            <div class="mb-3">
                              <?php 
                              if(empty($infoUser->access_token_zalo_oa)){
                                  global $urlHomes;

                                  $linkSettingZaloApp = 'https://developers.zalo.me/app/'.$infoUser->id_app_zalo.'/oa/settings';
                                  $linkCallbackOA = $urlHomes.'callbackZaloOA';
                                  $linkLoginOA = 'https://oauth.zaloapp.com/v4/oa/permission?app_id='.$infoUser->id_app_zalo.'&redirect_uri='.urlencode($linkCallbackOA);

                                  echo '<p><a class="btn btn-danger" href="'.$linkLoginOA.'">Cấp quyền Zalo OA</a><p>
                                        
                                        <p>Link calkback Zalo OA: '.$linkCallbackOA.'</p>
                                        <p>Link cài đặt Zalo OA: <a href="'.$linkSettingZaloApp.'" target="_blank">'.$linkSettingZaloApp.'</a></p>
                                    ';
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
                              <?php 
                              if(empty($infoUser->id_app_zalo) || empty($infoUser->secret_app_zalo)){
                                echo '<p class="text-danger">Vui lòng nhập ID Zalo APP và Mã bảo mật APP Zalo để thực hiện cấp quyền cho tài khoản Zalo</p>';
                              }else{
                                if(!empty($loginUrl)){
                                  global $urlHomes;

                                  $linkSettingZaloApp = 'https://developers.zalo.me/app/'.$infoUser->id_app_zalo.'/login';

                                  echo '<p><a class="btn btn-danger" href="'.$loginUrl.'">Cấp quyền Zalo cá nhân</a><p>
                                        
                                        <p>Link calkback Zalo cá nhân: '.$urlHomes.'callbackZalo</p>
                                        <p>Link cài đặt Zalo cá nhân: <a href="'.$linkSettingZaloApp.'" target="_blank">'.$linkSettingZaloApp.'</a></p>
                                    ';
                                }else{
                                  echo '<p class="text-danger">Đã kết nối Zalo cá nhân thành công</p>';
                                }
                              }
                              ?>
                              
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