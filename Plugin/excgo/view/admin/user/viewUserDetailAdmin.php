<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/excgo-view-admin-user-listUserAdmin.php">Thành viên</a> /</span>
        Thông tin thành viên
    </h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin thành viên</h5>
                </div>

                <div class="card-body">
                    <p><?php echo $mess ?? '';?></p>
                    <?= $this->Form->create(); ?>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <img src="<?php echo @$data->avatar ?>" width="200px" height="200px" class="mb-3">
                      </div>

                      <div class="col-md-6 mb-3">
                        <?php if (isset($isRequestUpgrade)): ?>
                          <p>Người dùng yêu cầu nâng cấp tài khoản thành tài xế</p>
                          <a class=" btn btn-primary"  title="Kích hoạt tài khoản"
                             onclick="return confirm('Bạn có chắc chắn muốn chấp nhận yêu cầu của thành viên này không?');"
                             href=<?php echo "/plugins/admin/excgo-view-admin-user-acceptUpgradeToDriverAdmin.php/?id=$isRequestUpgrade->user_id" ?>
                          >
                            Chấp nhận
                          </a>
                        <?php endif; ?>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 ">
                            <label class="form-label" for="basic-default-phone">Tài khoản (*)</label>
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
                            <label class="form-label" for="basic-default-phone">Email (*)</label>
                            <input required type="text" class="form-control phone-mask" name="email" id="email" value="<?php echo @$data->email;?>" />
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label" for="basic-default-phone">Số điện thoại (*)</label>
                            <input required type="text" class="form-control phone-mask" name="phone_number" id="phone_number" value="<?php echo @$data->phone_number;?>" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                            <input required type="text" class="form-control phone-mask" name="address" id="address" value="<?php echo @$data->address;?>" />
                        </div>

                        <div class="col-md-6 mb-3">
                          <label class="form-label">Loại tài khoản</label>
                          <div class="input-group input-group-merge">
                              <select class="form-select" name="type" id="type">
                                  <option value="0" <?php if (!empty($data->type) && $data->type == '0') echo 'selected'; ?> >Người dùng</option>
                                  <option value="1" <?php if (!empty($data->type) && $data->type == '1') echo 'selected'; ?> >Tài xế</option>
                              </select>
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-phone">Hình ảnh (*)</label>
                            <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                          <label class="form-label" for="basic-default-phone">Số dư tài khoản (*)</label>
                          <input required type="text" class="form-control phone-mask" name="total_coin" id="total_coin" value="<?php echo @$data->total_coin;?>" />
                        </div>

                        <div class="col-md-6 mb-3">
                          <label class="form-label" for="basic-default-phone">Số dư khả dụng (*)</label>
                          <input required type="text" class="form-control phone-mask" name="available_coin" id="available_coin" value="<?php echo @$data->available_coin;?>" />
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Ảnh CCCD mặt trước</label>
                        <div class="text-center">
                          <img src="<?php if (isset($idCardFront)) echo $idCardFront->path; else echo 'https://apis.exc-go.vn/plugins/excgo/view/image/default-image.jpg'; ?>" width="450px" height="300px">
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label class="form-label">Ảnh CCCD mặt sau</label>
                        <div class="text-center">
                          <img src="<?php if (isset($idCardBack)) echo $idCardBack->path; else echo 'https://apis.exc-go.vn/plugins/excgo/view/image/default-image.jpg'; ?>"
                               width="450px" height="300px"
                          >
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <label class="form-label">Hình ảnh xe</label>
                        <?php if (isset($car) && count($car)):
                          foreach ($car as $item):
                        ?>
                            <div class="col-md-6 mb-3 text-center">
                              <img src="<?php echo $item->path ?>" width="450px" height="300px" class="mb-3">
                            </div>
                        <?php endforeach;
                          else: ?>
                          <p> Chưa có hình ảnh </p>
                        <? endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

    </div>
</div><?php
