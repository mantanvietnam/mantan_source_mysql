<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-contact-listDesignRegistrationAdmin.php">Đăng ký design</a> /</span>
    Thông tin đăng ký design
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin đăng ký design</h5>
          </div>
        <!--   <?php   debug($data);
      debug($member);
       ?> -->
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                   <p><label class="form-label" for="basic-default-phone">Tên khách hàng:</label>
                      <?php echo $member->name; ?></p> 
                  </div>
                  <div class="mb-3">
                   <p><label class="form-label" for="basic-default-phone">Số điện thoạt:</label>
                      <?php echo $member->phone; ?></p> 
                  </div>
                  <div class="mb-3">
                   <p><label class="form-label" for="basic-default-phone">Email:</label>
                      <?php echo $member->email; ?></p> 
                  </div>
                  <div class="mb-3">
                   <p><label class="form-label" for="basic-default-phone">Nội dung:</label>
                      <?php echo $data->content; ?></p> 
                  </div>
                  <div class="mb-3">
                    <p> <label  class="form-label" for="basic-default-phone">Trạng thái:</label>&ensp;
                                <input type="radio" name="status" class="" id="status" value="1" <?php if(@ $data['status']==1) echo 'checked="checked"';   ?> > Duyệt&ensp;
                                <input type="radio" name="status" class="" id="status" value="0" <?php if(@ $data['status']==0) echo 'checked="checked"';   ?> > Chưa Duyệt &ensp;
                                <input type="radio" name="status" class="" id="status" value="2" <?php if(@ $data['status']==2) echo 'checked="checked"';   ?> > Từ chối</p>
                  </div>

                 
                </div>

                <div class="col-md-6">

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Portfolio</label>
                    <div class="input-group input-group-merge">
                      <img src="<?php echo @$data->meta; ?>">
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