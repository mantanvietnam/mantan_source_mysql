<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/product-view-admin-product-listProduct.php">Sản phẩm</a> /</span>
    Thông tin câu hỏi của sản phẩm thường giặp
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin câu hỏi của sản phẩm thường giặp</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-12">
                  <div class="nav-align-top mb-4">
                        <div class="row">
                          <div class="col-md-6 mb-3">
                             <label class="form-label">câu hỏi (*)</label>
                              <input required type="text" class="form-control phone-mask" name="question" id="question" value="<?php echo @$data->question;?>" />
                            </div>

                            <div class="col-md-6 mb-3">
                              <label class="form-label">Trả lời (*)</label>
                              <textarea name="answer" class="form-control phone-mask" required="" rows="5"><?php echo @$data->answer; ?></textarea>
                            </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>