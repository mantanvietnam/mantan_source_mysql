<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cài đặt trang về sản phẩm</h4>

  <!-- Basic Layout -->
  <p><?php echo @$mess;?></p>
  <?= $this->Form->create(); ?>
    <div class="card-body tab-content card">
        <div class="card-body row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">Slide trang chủ</label>
              <input type="text" class="form-control phone-mask" name="slide_home_page" id="slide_home_page" value="<?php echo @$setting['slide_home_page'];?>"/>
            </div>
        </div>
        <div class="card-body">
            <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
        </div>
    </div>
   
  <?= $this->Form->end() ?>
</div>