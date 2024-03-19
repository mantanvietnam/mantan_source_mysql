<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/clone_web-view-admin-website-listWebMemberAdmin">Website đại lý</a> /</span>
    Cài đặt website đại lý
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cài đặt website đại lý</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">ID đại lý (*)</label>
                    <input required type="text" class="form-control phone-mask" name="id_member" id="id_member" value="<?php echo @$data->id_member;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tên miền (*)</label>
                    <input type="text" required  class="form-control" placeholder="VD: tranmanh.zikii.vn" name="domain" id="domain" value="<?php echo @$data->domain;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Gói giao diện (*)</label>
                    <div class="input-group input-group-merge">
                      <select name="theme" id="theme" class="form-select" required>
                        <option value="">Chọn gói giao diện</option>
                        <?php 
                        if(!empty($listFolder)){
                          foreach ($listFolder as $key => $value) {
                            if(empty($data->theme) || $data->theme!=$value){
                              echo '<option value="'.$value.'" >'.$value.'</option>';
                            }else{
                              echo '<option selected value="'.$value.'" >'.$value.'</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="lock" <?php if(isset($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                      </select>
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