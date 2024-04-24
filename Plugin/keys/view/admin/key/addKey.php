<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/keys-view-admin-key-listKey">Quản lý khóa</a> /</span>
    Thông tin khóa
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin khóa</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Giá trị khóa (*)</label>
                    <input required type="text" class="form-control phone-mask" name="value" id="value" value="<?php echo @$data->value;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Ứng dụng (*)</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_category" id="id_category" required>
                        <option value="">Chọn ứng dụng</option>
                        <?php 
                        if(!empty($listCategory)){
                          foreach ($listCategory as $key => $item) {
                            if(empty($data->id_category) || $data->id_category!=$item->id){
                              echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                            }else{
                              echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
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
                    <label class="form-label" for="basic-default-fullname">Ngày tạo khóa</label>
                    <input type="text" class="form-control datepicker" placeholder="" name="create_at" id="create_at" value="<?php $create = getdate($data->create_at); echo $create['mday'].'/'.$create['mon'].'/'.$create['year'];?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số lần sử dụng</label>
                    <input disabled type="text" class="form-control" placeholder="" name="used" id="used" value="<?php echo number_format((int) @$data->used);?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tháng</label>
                    <input disabled type="text" class="form-control" placeholder="" name="month" id="month" value="<?php echo  (!empty($data->month))?$data->month:(int)date('m');?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tài khoản</label>
                    <input type="text" class="form-control phone-mask" name="user" id="user" value="<?php echo @$data->user;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Mật khẩu</label>
                    <input type="text" class="form-control phone-mask" name="pass" id="pass" value="<?php echo @$data->pass;?>" />
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