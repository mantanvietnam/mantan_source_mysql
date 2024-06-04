<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCustomerHistoriesAgency">Chăm sóc khách hàng</a> /</span>
    Thông tin chăm sóc
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin chăm sóc</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">ID khách hàng (*)</label>
                    <input required type="text" class="form-control phone-mask" name="id_customer" id="id_customer" value="<?php if(!empty($data->id_customer)){ 
                                    echo $data->id_customer; 
                                  } elseif(!empty($_GET['id_customer'])){ 
                                    echo (int) $_GET['id_customer'];
                                  }?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Hành động chăm sóc (*)</label>
                    <div class="input-group input-group-merge">
                      <select required class="form-select" name="action_now" id="action_now">
                        <option value="">Chọn hành động</option>
                        <option value="call" <?php if(!empty($data->status) && $data->status=='call') echo 'selected'; ?> >Gọi điện</option>
                        <option value="message" <?php if(isset($data->status) && $data->status=='message') echo 'selected'; ?> >Nhắn tin</option>
                        <option value="go_meet" <?php if(isset($data->status) && $data->status=='go_meet') echo 'selected'; ?> >Đi gặp</option>
                        <option value="online_meeting" <?php if(isset($data->status) && $data->status=='online_meeting') echo 'selected'; ?> >Họp online</option>
                      </select>
                    </div>
                  </div>
                  
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Thời gian chăm sóc (*)</label>
                    <input type="text" required class="form-control phone-mask datetimepicker" name="time_now" id="time_now" value="<?php if(!empty($data->time_now)) echo date('H:i d/m/Y', $data->time_now);?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="new" <?php if(!empty($data->status) && $data->status=='new') echo 'selected'; ?> >Chưa thực hiện</option>
                        <option value="done" <?php if(isset($data->status) && $data->status=='done') echo 'selected'; ?> >Đã hoàn thành</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Nội dung chăm sóc (*)</label>
                    <textarea required class="form-control phone-mask" name="note_now" id="note_now" ><?php echo @$data->note_now;?></textarea>
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

<?php include(__DIR__.'/../footer.php'); ?>