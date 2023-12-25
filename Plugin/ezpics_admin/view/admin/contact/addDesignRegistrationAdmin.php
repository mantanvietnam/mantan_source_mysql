<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-contact-listDesignRegistrationAdmin">Đăng ký designer</a> /</span>
    Thông tin đăng ký designer
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin đăng ký designer</h5>
          </div>
       
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
                   <p><label class="form-label" for="basic-default-phone">Số điện thoại:</label>
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
                  <?php 
                         if($data->status==1){
                        $status = 'Đã xử lý';
                    }elseif($data->status==2){
                        $status = 'Từ chối';
                    }else{
                        $status = 'Chưa xử lý';
                    } 
                   ?>
                   <div class="mb-3">
                   <p><label class="form-label" for="basic-default-phone">Trạng thái:</label>
                      <?php echo $status; ?></p> 
                  </div>
                  <?php if($data->status==0){ ?>
                  <div class="mb-3">
                     <p> <label  class="form-label" for="basic-default-phone">Lý do từ chối:</label>&ensp;
                         <textarea name="content" id="content" onkeyup="" class="form-control" rows="5"></textarea>
                       </p>
                  </div>
                  <div class="mb-3 row">
                    <div class="col-md-6">
                      <input type="submit" name="status" class="btn btn-primary d-block" value="Duyệt">
                    </div>
                    <div class="col-md-6">
                        <input type="submit" name="status" class="btn btn-danger d-block" value="Từ chối">
                    </div>
                  </div>
                 <?php }else{ ?>
                  <a href="/plugins/admin/ezpics_admin-view-admin-contact-listDesignRegistrationAdmin" style="width: 101px;" class="btn btn-primary d-block">Quay lại</a>

                 <?php } ?>
                </div>

                <div class="col-md-6">

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Portfolio</label>
                    <div class="input-group input-group-merge">
                      <img style="width: 100%; height: auto;" src="<?php echo @$data->meta; ?>">
                    </div>
                  </div>
                </div>
              </div>
               
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>