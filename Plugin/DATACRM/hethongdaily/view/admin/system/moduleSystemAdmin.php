<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/hethongdaily-view-admin-system-listSystemAdmin">Hệ thống</a> /</span>
    Module chức năng
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Module chức năng</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-3">
                  <div class="mb-3">
                    <input type="checkbox" name="crm_module[]" value="hethongdaily" <?php if(!empty($data_value) && in_array('hethongdaily', $data_value)) echo 'checked';?> > Hệ thống tuyến dưới
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="mb-3">
                    <input type="checkbox" name="crm_module[]" value="order_system" <?php if(!empty($data_value) && in_array('order_system', $data_value)) echo 'checked';?> > Đơn hàng hệ thống + Tồn kho
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="mb-3">
                    <input type="checkbox" name="crm_module[]" value="order_customer" <?php if(!empty($data_value) && in_array('order_customer', $data_value)) echo 'checked';?> > Đơn hàng khách lẻ + Khách hàng
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="mb-3">
                    <input type="checkbox" name="crm_module[]" value="zalo_zns" <?php if(!empty($data_value) && in_array('zalo_zns', $data_value)) echo 'checked';?> > Zalo OA + Bắn thông báo
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="mb-3">
                    <input type="checkbox" name="crm_module[]" value="training" <?php if(!empty($data_value) && in_array('training', $data_value)) echo 'checked';?> > Đào tạo + Thi trắc nghiệm
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="mb-3">
                    <input type="checkbox" name="crm_module[]" value="customer" <?php if(!empty($data_value) && in_array('customer', $data_value)) echo 'checked';?> > Khách hàng
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="mb-3">
                    <input type="checkbox" name="crm_module[]" value="campaign" <?php if(!empty($data_value) && in_array('campaign', $data_value)) echo 'checked';?> > Chiến dịch sự kiện
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="mb-3">
                    <input type="checkbox" name="crm_module[]" value="clone_web" <?php if(!empty($data_value) && in_array('clone_web', $data_value)) echo 'checked';?> > Nhân bản website
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="mb-3">
                    <input type="checkbox" name="crm_module[]" value="affiliate" <?php if(!empty($data_value) && in_array('affiliate', $data_value)) echo 'checked';?> > Tiếp thị liên kết (Cộng tác viên)
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <input type="checkbox" name="crm_module[]" value="document" <?php if(!empty($data_value) && in_array('document', $data_value)) echo 'checked';?> > Thư viện
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