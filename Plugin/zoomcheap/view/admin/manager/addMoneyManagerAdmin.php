<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/zoomcheap-view-admin-manager-listManagerAdmin.php">Khách hàng</a> /</span>
    <?php if($_GET['type']=='plus') {
      echo 'Cộng tiền';
    }else{
      echo 'Trừ tiền';
    } ?>
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <!-- <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
            </h5>
          </div> -->
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">
                      <?php 
                        if($_GET['type']=='plus') {
                          echo 'Số tiền Cộng cho tài khoản '.@$data->fullname.' - '.@$data->phone.' - '.number_format($data->coin).'đ';
                        }else{
                          echo 'Số tiền Trừ cho tài khoản '.@$data->fullname.' - '.@$data->phone.' - '.number_format($data->coin).'đ';
                        } 
                      ?>  
                    (*)
                    </label>
                    <input required type="number" class="form-control phone-mask" name="coinChange" id="coinChange" value="" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><?php if($_GET['type']=='plus') {
                    echo 'Lý do cộng';
                  }else{
                    echo 'Lý do trừ';
                  } ?>  (*)</label>
                    <input type="text" required class="form-control" placeholder="" name="note" id="note" value="" />
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