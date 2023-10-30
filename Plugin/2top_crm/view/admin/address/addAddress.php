<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/2top_crm-view-admin-address-listAddressCustomer.php/?id_customer=<?php echo (int)$_GET['id_customer']?>">Địa chỉ</a> /</span>
    Thông tin địa chỉ
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin địa chỉ</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-address">Tên địa chỉ (*)</label>
                    <input required type="text" class="form-control phone-mask" name="address_name" id="address_name" value="<?php echo @$data->address_name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-status">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="address_type" id="address_type">
                        <option value="1" <?php if(!empty($data->address_type) && $data->address_type=='1') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="0" <?php if(isset($data->address_type) && $data->address_type=='0') echo 'selected'; ?> >Khóa</option>
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