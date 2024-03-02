<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/matmathanhcong-view-admin-settingMMTCAPI">Mật mã thành công</a> /</span>
    Cài đặt
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cài đặt</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Tài khoản API</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Tài khoản ngân hàng</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Chatbot (Smax Bot)</button>
                </li>
              </ul>

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row">
                    <div class="col-md-12">
                      
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Tài khoản API (*)</label>
                        <input required type="text" class="form-control phone-mask" name="userAPI" id="userAPI" value="<?php echo @$data['userAPI'];?>" />
                      </div>

                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Mật khẩu API (*)</label>
                        <input required type="text" class="form-control phone-mask" name="passAPI" id="passAPI" value="<?php echo @$data['passAPI'];?>" />
                      </div>

                    </div>

                  </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="row">
                    <div class="col-md-12">

                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Giá mua bản đầy đủ</label>
                        <input type="text" class="form-control phone-mask" name="price" id="price" value="<?php echo (int) @$data['price'];?>" />
                      </div>

                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Ghi chú khi thanh toán</label>
                        <input type="text" class="form-control phone-mask" name="note_pay" id="note_pay" value="<?php echo @$data['note_pay'];?>" />
                      </div>

                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Số tài khoản ngân hàng TP Bank</label>
                        <input type="text" class="form-control phone-mask" name="number_bank" id="number_bank" value="<?php echo @$data['number_bank'];?>" />
                      </div>

                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Tên chủ tài khoản ngân hàng TP Bank (không dấu)</label>
                        <input type="text" class="form-control phone-mask" name="account_bank" id="account_bank" value="<?php echo @$data['account_bank'];?>" />
                      </div>

                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Khóa thanh toán</label>
                        <input type="text" class="form-control phone-mask" name="key_bank" id="key_bank" value="<?php echo @$data['key_bank'];?>" />
                      </div>

                    </div>

                  </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="row">
                    <div class="col-md-12">
                      
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">ID Bot</label>
                        <input type="text" class="form-control phone-mask" name="idBot" id="idBot" value="<?php echo @$data['idBot'];?>" />
                      </div>

                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Token Bot</label>
                        <input type="text" class="form-control phone-mask" name="tokenBot" id="tokenBot" value="<?php echo @$data['tokenBot'];?>" />
                      </div>

                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">ID block xác nhận thanh toán</label>
                        <input type="text" class="form-control phone-mask" name="idBlockConfirm" id="idBlockConfirm" value="<?php echo @$data['idBlockConfirm'];?>" />
                      </div>

                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">ID block tải bản full</label>
                        <input type="text" class="form-control phone-mask" name="idBlockDownload" id="idBlockDownload" value="<?php echo @$data['idBlockDownload'];?>" />
                      </div>

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