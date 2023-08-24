<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listPartner">Đối tác</a> /</span>
    Thông tin đối tác
  </h4>

  <!-- Basic Layout -->
  <?= $this->Form->create(); ?>
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin đối tác</h5>
          </div>
          <div class="card-body">
              <p><?php echo $mess;?></p>
            
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên đối tác (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text" required class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="" name="address" id="address" value="<?php echo @$data->address;?>" />
                  </div>
                </div>
                <div class="mb-3 col-md-12">
                  <label class="form-label" for="basic-default-fullname">Thông tin thêm</label>
                  <textarea placeholder="Thông tin thêm về đồi tác " class="form-control" rows="5" name="note"><?php echo @$data->note;?></textarea>
                </div>
                
              </div>
              
              <button type="submit" style=" width: 70px; " class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  <?= $this->Form->end() ?>
</div>

<?php include(__DIR__.'/../footer.php'); ?>