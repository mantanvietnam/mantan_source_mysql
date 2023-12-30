
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/excgo-view-admin-booking-listBookingAdmin">Cuốc xe</a> /</span>
        Thông tin cuốc xe
    </h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin cuốc xe</h5>
                </div>

                <div class="card-body">
                    <p><?php echo $mess ?? '';?></p>
                    <?= $this->Form->create(); ?>
                    <div class="row">
                        <div class="col-md-9 mb-3">
                            <label class="form-label" for="name">Tên cuốc xe (*)</label>
                            <input required type="text" class="form-control" name="name" id="name" value="<?php echo @$data->name;?>" />
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="status">Trạng thái (*)</label>
                            <select name="status" class="form-select color-dropdown">
                                <option value="0" <?php if(@$data->status == 0) echo 'selected';?> >Chưa nhận</option>
                                <option value="1" <?php if(@$data->status == 1) echo 'selected';?> >Đã nhận</option>
                                <option value="2" <?php if(@$data->status == 2) echo 'selected';?> >Đã hủy</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 ">
                            <label class="form-label">Người đăng</label>
                            <a class="d-block"
                                href="<?php echo "/plugins/admin/excgo-view-admin-user-viewUserDetailAdmin/?id=" . @$data->PostedUsers['id'] ?>">
                                <?php echo @$data->PostedUsers['name'] ?>
                            </a>
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label">Người nhận</label>
                            <a class="d-block"
                                href="<?php echo "/plugins/admin/excgo-view-admin-user-viewUserDetailAdmin/?id=" . @$data->ReceivedUsers['id'] ?>">
                                <?php echo @$data->ReceivedUsers['name'] ?>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 ">
                            <label class="form-label" for="departure_province_id">Tỉnh đi (*)</label>
                            <select name="departure_province_id" id="departure_province_id" class="form-select color-dropdown">
                                <option value="">Tất cả</option>
                                <?php foreach ($listProvince ?? [] as $province): ?>
                                    <option value="<?php echo $province->id ?>"
                                        <?php if(@$data->DepartureProvinces['id'] == $province->id) echo 'selected';?>
                                    ><?php echo $province->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label" for="destination_province_id">Tỉnh đến (*)</label>
                            <select name="destination_province_id" id="destination_province_id" class="form-select color-dropdown">
                                <option value="">Tất cả</option>
                                <?php foreach ($listProvince ?? [] as $province): ?>
                                    <option value="<?php echo $province->id ?>"
                                        <?php if(@$data->DestinationProvinces['id'] == $province->id) echo 'selected';?>
                                    ><?php echo $province->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="departure">Địa chỉ đi (*)</label>
                            <input required type="text" class="form-control" name="departure" id="departure" value="<?php echo @$data->departure;?>" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="destination">Địa chỉ đến (*)</label>
                            <input required type="text" class="form-control" name="destination" id="destination" value="<?php echo @$data->destination;?>" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="start_time">Thời gian đi (*)</label>
                            <input required type="text" class="form-control datetimepicker" name="start_time" id="start_time"
                                   value="<?php echo date('H:i d/m/Y', strtotime(@$data->start_time));?>" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="finish_time">Thời gian đến (*)</label>
                            <input required type="text" class="form-control datetimepicker" name="finish_time" id="finish_time"
                                   value="<?php echo date('H:i d/m/Y', strtotime(@$data->finish_time));?>" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="price">Giá (*)</label>
                            <input required type="text" class="form-control" name="price" id="price" value="<?php echo @$data->price;?>" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="introduce_fee">Chiết khấu (*)</label>
                            <input required type="text" class="form-control" name="introduce_fee" id="introduce_fee" value="<?php echo @$data->introduce_fee;?>" />
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 mb-3">
                          <label class="form-label" for="description">Mô tả</label>
                          <textarea class="form-control" name="description" id="description" rows="3">
                              <?php echo @$data->description;?>
                          </textarea>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

    </div>
</div><?php
