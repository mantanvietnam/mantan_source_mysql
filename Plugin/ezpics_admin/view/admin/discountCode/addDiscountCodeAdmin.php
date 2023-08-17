<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-discountCode-listDiscountCodeAdmin.php">Mã giảm giá</a> /</span>
    Thông tin mã giảm giá
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin  mã giảm giá</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên mã giảm giá (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mã (*)</label>
                    <input type="text" required class="form-control" placeholder="" name="code" id="code" value="<?php echo @$data->code;?>" />
                  </div> 
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">kiểu mã </label>
                    <select name="type" id="type" class="form-select color-dropdown" required onchange="getDataOption();">
                      <option value="">Chọn kho mẫu</option>
                      <?php
                      global $typeDiscount;
                      if(!empty($typeDiscount)){
                        foreach ($typeDiscount as $key => $value) {
                          if(@$data->type !=$value){
                            echo '<option data-price="'.$value.'" data-date="'.$value.'" value="'.$value.'">'.$value.'</option>';
                          }else{
                            echo '<option data-price="'.$value.'" data-date="'.$value->date.'"  selected value="'.$value.'">'.$value.'</option>';
                          }
                        }
                      }
                      ?>
                    </select>
                  </div> 
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ngày hết hạn </label>
                    <input type="datetime-local"  class="form-control" placeholder="" name="deadline_at" id="deadline_at" value="<?php echo  str_replace('AM', 'SA',str_replace('PM', 'CH', @$data->deadline_at->format('d/m/Y h:i A')));?>" />
                  </div>         
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">phần trăm giảm giá (*)</label>
                    <input type="number" required autocomplete="off" class="form-control" placeholder="" name="discount" id="discount" value="<?php echo @$data->discount;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">nội dung</label>
                    <input type="text" class="form-control" placeholder="" name="note" id="note" value="<?php echo @$data->note;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số lượng (*)</label>
                    <input type="number"  class="form-control" placeholder="" name="number_user" id="number_user" value="<?php echo @$data->number_user;?>" />
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