<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/excgo-view-admin-user-listUserAdmin">Thành viên</a> /</span>
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
                             href=<?php echo "/plugins/admin/excgo-view-admin-user-acceptUpgradeToDriverAdmin/?id=$isRequestUpgrade->user_id" ?>
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
                        

                        <div class="col-md-2 mb-3">
                          <label class="form-label">Loại tài khoản</label>
                          <div class="input-group input-group-merge">
                              <select class="form-select" name="type" id="type">
                                  <option value="1" <?php if (!empty($data->type) && $data->type == '1') echo 'selected'; ?> >Người dùng</option>
                                  <option value="2" <?php if (!empty($data->type) && $data->type == '2') echo 'selected'; ?> >Tài xế</option>
                              </select>
                          </div>
                        </div>
                         <div class="col-md-2 mb-3">
                            <label class="form-label" for="basic-default-phone">Chuyến nhận tối da</label>
                            <input required type="number" class="form-control phone-mask" name="maximum_trip" id="maximum_trip" value="<?php echo @$data->maximum_trip;?>" />
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label" for="basic-default-phone">chênh lệch Chuyến</label>
                            <input  type="number" class="form-control phone-mask" name="difference_booking" id="difference_booking" value="<?php echo @$data->difference_booking;?>" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 ">
                            <label class="form-label" for="basic-default-phone">Ngân hàng</label>
                            <input disabled type="text" class="form-control phone-mask" name="bank_account" id="bank_account" value="<?php echo @$data->bank_account;?>" />
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label" for="basic-default-phone">Số tài khoản ngân hàng</label>
                            <input disabled type="text" class="form-control phone-mask" name="account_number" id="account_number" value="<?php echo @$data->account_number;?>" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-phone">Hình ảnh (*)</label>
                            <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label class="form-label" for="basic-default-phone">Số dư tài khoản (*)</label>
                          <input disabled type="text" class="form-control phone-mask" name="total_coin" id="total_coin" value="<?php echo @$data->total_coin;?>" />
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Ảnh CCCD mặt trước</label>
                        <div class="text-center">
                          <img src="<?php if (isset($idCardFront)) echo $idCardFront->path; else echo 'https://apis.exc-go.vn/plugins/excgo/view/image/default-image.jpg'; ?>" width="450px" height="300px">
                           <?php showUploadFile('idCardFront','idCardFront',@$idCardFront->path,1);?>
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label class="form-label">Ảnh CCCD mặt sau</label>
                        <div class="text-center">
                          <img src="<?php if (isset($idCardBack)) echo $idCardBack->path; else echo 'https://apis.exc-go.vn/plugins/excgo/view/image/default-image.jpg'; ?>"
                               width="450px" height="300px"
                          >
                           <?php showUploadFile('idCardBack','idCardBack',@$idCardBack->path,2);?>
                        </div>
                      </div>
                    </div>

                   <!--  <div class="row">
                      <label class="form-label">Hình ảnh xe</label>
                        <?php 
                        if (isset($car) && count($car)){
                            foreach ($car as $key => $item){
                                echo '  <div class="col-md-6 mb-3 text-center">
                                          <img src="'.$item->path.'" width="450px" height="300px" class="mb-3">';
                                        showUploadFile('car'.$key,'car[]',@$item->path,4+$key);
                                     echo '   </div>';
                            }
                        } else {
                          echo '<p> Chưa có hình ảnh </p>';
                        }
                         echo '  <div class="col-md-6 mb-3 text-center">';
                            showUploadFile('car','car[]','',3);
                        echo '   </div>';
                        ?>
                    </div> -->

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

    </div>
</div>