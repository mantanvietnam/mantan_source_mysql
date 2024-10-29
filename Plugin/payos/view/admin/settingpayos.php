<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cài đặt Payos</h4>

  <!-- Basic Layout -->
  <p><?php echo @$mess;?></p>
  <?= $this->Form->create(); ?>
  <div class="card mb-4">
    <div class="card-body row">
        <div class="mb-3 col-md-6">
          <label class="form-label">Client ID(*)</label>
          <input type="text" class="form-control phone-mask" name="client_id" id="client_id" value="<?php echo @$setting['client_id'];?>"/>
        </div>
        <div class="mb-3 col-md-6">
          <label class="form-label">Api Key</label>
          <input type="text" class="form-control phone-mask" name="api_key" id="api_key" value="<?php echo @$setting['api_key'];?>"/>
        </div>

       <div class="mb-3 col-md-6">
        <label class="form-label" for="basic-default-phones">Checksum Key</label>
        <input type="text" class="form-control phone-mask" name="checksum_key" id="checksum_key" value="<?php echo @$setting['checksum_key'];?>"/>
      </div>
      

    <div class="mb-3 col-md-12">
      <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
    </div>
  </div>



</div>
<?= $this->Form->end() ?>
</div>
