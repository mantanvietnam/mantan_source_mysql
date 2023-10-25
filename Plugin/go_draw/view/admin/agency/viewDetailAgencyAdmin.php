<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/go_draw-view-admin-agency-listAgencyAdmin.php">Đại lý</a> /</span>
        Thông tin đại lý
    </h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin đại lý</h5>
                </div>

                <div class="card-body">
                    <p><?php echo $mess ?? '';?></p>
                    <?= $this->Form->create(); ?>
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-home" aria-selected="true">
                          Thông tin chung
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-account" aria-controls="navs-top-image" aria-selected="false">
                          Tài khoản
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-product" aria-controls="navs-top-image" aria-selected="false">
                          Sản phẩm
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-info" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 mb-3 ">
                                <label class="form-label" for="basic-default-phone">Tên đại lý (*)</label>
                                <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                            </div>

                            <div class="col-md-6 mb-3 ">
                                <label class="form-label">Trạng thái</label>
                                <div class="input-group input-group-merge">
                                    <select class="form-select" name="status" id="status">
                                        <option value="1" <?php if (!empty($data->status) && $data->status == '1') echo 'selected'; ?> >Kích hoạt</option>
                                        <option value="0" <?php if (!empty($data->status) && $data->status == '0') echo 'selected'; ?> >Khóa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 ">
                                <label class="form-label" for="basic-default-phone">Đại chỉ (*)</label>
                                <input required type="text" class="form-control phone-mask" name="address" id="address" value="<?php echo @$data->address;?>" />
                            </div>

                            <div class="col-md-6 mb-3 ">
                                <label class="form-label" for="basic-default-phone">Số điện thoại (*)</label>
                                <input required type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                            </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-account" role="tabpanel">
                          <div class="row">
                            <input type="hidden" name="master_account_id" value="<?php echo @$masterAccount->id;?>">
                            <div class="col-md-6 mb-3">
                              <label class="form-label" for="username">Tên đăng nhập (*)</label>
                              <input type="text" class="form-control phone-mask" name="master_account_name" id="master_account_name" value="<?php echo @$masterAccount->name;?>" />
                            </div>

                            <div class="col-md-6 mb-3 ">
                              <label class="form-label">Loại tài khoản</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="master_account_type" id="master_account_type" disabled>
                                  <option value="1" selected>Chủ đại lý</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label class="form-label" for="password">Mật khẩu (*)</label>
                              <div class="input-group input-group-merge">
                                <input type="password" class="form-control phone-mask" name="master_account_password" id="master_account_password"
                                       value="" placeholder="*******"
                                       <?php if (@$masterAccount->password) echo 'disabled'?>
                                />
                                <span class="input-group-text cursor-pointer hide-pass"><i class="bx bx-hide"></i></span>
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label class="form-label" for="password_confirmation">Nhập lại mật khẩu (*)</label>
                              <div class="input-group input-group-merge">
                                <input type="password" class="form-control phone-mask" name="master_account_password_confirmation" id="master_account_password_confirmation"
                                       value="" placeholder="*******"
                                    <?php if (@$masterAccount->password) echo 'disabled'?>
                                />
                                <span class="input-group-text cursor-pointer hide-confirm-pass"><i class="bx bx-hide"></i></span>
                              </div>
                            </div>
                          </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-product" role="tabpanel">
                        <div class="row">
                            <label class="form-label">Sản phẩm</label>
                            <p> Chưa có sản phẩm </p>
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
<script>
  $(document).on('click', '.hide-confirm-pass', function () {
    const child = $(this).children('i')[0];
    if ($(child).hasClass('bx-hide')) {
      $('input[name=master_account_password_confirmation]').attr('type', 'text');
      $(child).removeClass('bx-hide');
      $(child).addClass('bx-show');
    } else {
      $('input[name=master_account_password_confirmation]').attr('type', 'password');
      $(child).removeClass('bx-show');
      $(child).addClass('bx-hide');
    }
  });

  $(document).on('click', '.hide-pass', function () {
    const child = $(this).children('i')[0];
    if ($(child).hasClass('bx-hide')) {
      $('input[name=master_account_password]').attr('type', 'text');
      $(child).removeClass('bx-hide');
      $(child).addClass('bx-show');
    } else {
      $('input[name=master_account_password]').attr('type', 'password');
      $(child).removeClass('bx-show');
      $(child).addClass('bx-hide');
    }
  });
</script>
