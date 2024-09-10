<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cài đặt tài khoản ngân hàng</h4>

  <!-- Basic Layout -->
  <p><?php echo @$mess;?></p>
  <?= $this->Form->create(); ?>
  <div class="card mb-4">
    <div class="card-body row">
      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label">Họ tên chủ thẻ(*)</label>
          <input type="text" class="form-control phone-mask" name="bank_name" id="bank_name" value="<?php echo @$setting['bank_name'];?>"/>
        </div>
        <div class="mb-3">
          <label class="form-label">Số tài khoản ngân hàng</label>
          <input type="text" class="form-control phone-mask" name="bank_number" id="bank_number" value="<?php echo @$setting['bank_number'];?>"/>
        </div>
      </div>

      <div class="col-md-6">
       <div class="mb-3">
        <label class="form-label" for="basic-default-phones">Ngân hàng </label>
        <select class="form-select" name="bank_code" id="bank_code">
          <option value="">Chọn ngân hàng</option>
          <?php
          $listBank = listBank();
          foreach($listBank as $key => $item){
            $selected = '';
            if(@$setting['bank_code']==$item['code']){ 
              $selected = 'selected';
            }
            echo'<option value="'.$item['code'].'" '.$selected.' >'.$item['name'].' ('.$item['code'].')</option>';
          } ?>
        </select>
      </div>
    </div>

    <div class="mb-3 col-md-12">
      <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
    </div>
  </div>



</div>
<?= $this->Form->end() ?>
</div>
