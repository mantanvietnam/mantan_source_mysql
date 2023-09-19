<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php">Người dùng</a> /</span>
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
                    <label class="form-label" for="basic-default-phone"><?php if($_GET['type']=='plus') {
                    echo 'Số tiền Cộng cho tài khoản '.@$data->name.' - '.@$data->phone.' - '.number_format($data->account_balance).'đ';
                  }else{
                    echo 'Số tiền Trừ cho tài khoản '.@$data->name.' - '.@$data->phone.' - '.number_format($data->account_balance).'đ';
                  } ?>  (*)</label>
                    <input required type="number" class="form-control phone-mask" name="coin" id="coin" value="" />
                  </div>
                  <div class="mb-3">
                    <?php if($_GET['type']=='plus'){ ?>
                    <label class="form-label" for="basic-default-fullname">Lý do cộng (*)</label>
                    <select  name="note" class="form-select color-dropdown" id="note" >
                      <?php global $noteplusMoney; 
                            foreach($noteplusMoney as $key => $value){?>
                              <option value="<?php echo $value; ?>"><?php echo $value; ?></option>

                            <?php } ?>
                    </select>
                   <?php }else{ ?>
                   <label class="form-label" for="basic-default-fullname">Lý do trừ (*)</label>
                    <input type="text" required class="form-control" placeholder="" name="note" id="note" value="" />
                 <?php   } ?>
                  </div>

                  <?php if($_GET['type']=='plus') {?>
                    <div class="mb-3 form-group col-sm-6">
                                <label class="form-label" for="basic-default-phone">Trạng thái:</label>&ensp;
                                <input type="radio" name="payment_kind" class="" id="payment_kind" value="0" > Tiền thưởng&ensp;&ensp;&ensp;
                                <input type="radio" name="payment_kind" class="" id="payment_kind" value="1"> Tiền thật
                            </div>
                    
                  <?php }?>
                  
                </div>

               
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>