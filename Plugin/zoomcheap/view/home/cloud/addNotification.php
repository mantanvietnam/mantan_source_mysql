<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    Đăng ký nhận thông báo
  </h4>
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin đăng ký</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <!-- <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"> -->
                        <label>
                            <input type="checkbox" name="email_nofitication" value="1" 
                                <?php echo (isset($infoUser) && $infoUser->email_nofitication == 1) ? 'checked' : ''; ?>>
                                Nhận thông báo khi số lượng phòng sắp hết
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>


        </div>
      </div>

    </div>
</div>
<?php include(__DIR__.'/../footer.php'); ?>