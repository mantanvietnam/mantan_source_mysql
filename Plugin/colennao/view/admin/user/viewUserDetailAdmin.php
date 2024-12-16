<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-user-listUserAdmin">Thành viên</a> /</span>
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
                        <div class="col-md-6 mb-3 ">
                            <label class="form-label" for="basic-default-phone">Họ và tên(*)</label>
                            <input required type="text" class="form-control phone-mask" name="full_name" id="full_name" value="<?php echo @$data->full_name;?>" />
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label">Trạng thái</label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" name="status" id="status">
                                    <option value="active" <?php if (!empty($data->status) && $data->status == 'active') echo 'selected'; ?> >Kích hoạt</option>
                                    <option value="lock" <?php if (!empty($data->status) && $data->status == 'lock') echo 'selected'; ?> >Khóa</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 ">
                            <label class="form-label">Trạng thái</label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" name="sex" id="sex">
                                    <option value="1" <?php if (!empty($data->sex) && $data->sex == '1') echo 'selected'; ?> >Nam</option>
                                    <option value="2" <?php if (!empty($data->sex) && $data->sex == '2') echo 'selected'; ?> >Nữ</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="col-md-6 mb-3 ">
                            <label class="form-label" for="basic-default-phone">Email (*)</label>
                            <input required type="text" class="form-control phone-mask" name="email" id="email" value="<?php echo @$data->email;?>" />
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label" for="basic-default-phone">Số điện thoại (*)</label>
                            <input required type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                            <input  type="text" class="form-control phone-mask" name="address" id="address" value="<?php echo @$data->address;?>" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-phone">cân nặng hiện tại</label>
                            <input  type="text" class="form-control phone-mask" name="current_weight" id="current_weight" value="<?php echo @$data->current_weight;?>" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-phone">cân nặng mục tiêu</label>
                            <input  type="text" class="form-control phone-mask" name="target_weight" id="target_weight" value="<?php echo @$data->target_weight;?>" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-phone">chiêu cao</label>
                            <input  type="text" class="form-control phone-mask" name="height" id="height" value="<?php echo @$data->height;?>" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Nhóm bài luyên tập</label>
                            <select name="id_group_user" class="form-select color-dropdown" required>
                              <option value="">Chọn bài luyên tập</option>
                              <?php 
                              if(!empty($userpeople)){
                                foreach ($userpeople as $key => $value) {
                                  if(empty($data->id_group_user) || $data->id_group_user!=$value->id){
                                    echo '<option value="'.$value->id.'" >'.$value->name.'</option>';
                                  }else{
                                    echo '<option selected value="'.$value->id.'" >'.$value->name.'</option>';
                                  }
                                }
                              }
                              ?>
                            </select>
                          </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-phone">Hình ảnh (*)</label>
                            <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                            <img src="<?php echo @$data->avatar ?>" width="80px" height="80px" class="mb-3">
                        </div>
                        <div class="col-md-6 mb-3 ">
                            <label class="form-label">Kiểu thành viên</label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" name="type" id="type">
                                    <option value="default" <?php if (!empty($data->type) && $data->type == 'default') echo 'selected'; ?> >bình thường</option>
                                    <option value="ambassador" <?php if (!empty($data->type) && $data->type == 'ambassador') echo 'selected'; ?> >Đại sứ</option>
                                </select>
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