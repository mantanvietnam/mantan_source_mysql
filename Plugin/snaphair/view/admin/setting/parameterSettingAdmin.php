<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cài đặt thông số</h4>

  <!-- Basic Layout -->
  <p><?php echo @$mess;?></p>
  <?= $this->Form->create(); ?>
  <div class="card mb-4">
    <div class="card-body row">
     

      <div class="col-md-6 mb-3">
          <label class="form-label">Phí ghép ảnh </label>
          <input type="text" class="form-control phone-mask" name="transaction_fee" id="transaction_fee" value="<?php echo @$setting['transaction_fee'];?>"/>
      </div>
      

    <div class="mb-3 col-md-12">
      <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
    </div>
  </div>



</div>
<?= $this->Form->end() ?>
</div>
