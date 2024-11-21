<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cài đặt Payos</h4>

  <!-- Basic Layout -->
  <p><?php echo @$mess;?></p>
  <?= $this->Form->create(); ?>
    <div class="card mb-4">
      <div class="card-body row">
          <div class="mb-3 col-md-6">
            <label class="form-label">API Key Dify(*)</label>
            <input type="text" class="form-control phone-mask" name="api_key_dify" id="api_key_dify" value="<?php echo @$setting['api_key_dify'];?>"/>
          </div>
          
          <div class="mb-3 col-md-12">
            <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
          </div>
      </div>
    </div>
  <?= $this->Form->end() ?>
</div>
