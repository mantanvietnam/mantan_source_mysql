<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/go_draw-view-admin-user-listUserAdmin">Thành viên</a> /</span>
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
                            <input required type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-phone">Coin (*)</label>
                            <input required type="text" class="form-control phone-mask" name="total_coin" id="total_coin" value="<?php echo @$data->total_coin;?>" />
                        </div>
                    </div>

                    <div class="row">
                        <label class="form-label">Galary</label>
                        <p> Chưa có hình ảnh </p>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

    </div>
</div><?php
