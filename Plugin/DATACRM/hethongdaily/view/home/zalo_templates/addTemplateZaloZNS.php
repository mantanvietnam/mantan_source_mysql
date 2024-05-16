<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/templateZaloZNS">Zalo ZNS</a> /</span>
    Cài đặt mẫu tin ZNS
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin mẫu tin ZNS</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên mẫu (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">ID ZNS (*)</label>
                    <input type="text" required class="form-control" placeholder="" name="id_zns" id="id_zns" value="<?php echo @$data->id_zns;?>" />
                  </div>
                </div>

                <?php 
                for($i=1;$i<=10;$i++){ 
                  echo '<div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tên biến '.$i.'</label>
                            <input type="text" class="form-control" placeholder="" name="variable['.$i.']" value="'.@$data->content[$i]['variable'].'" />
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Giá trị biến '.$i.'</label>
                            <input maxlength="100" type="text" class="form-control" placeholder="" name="value['.$i.']" value="'.@$data->content[$i]['value'].'" />
                          </div>
                        </div>';

                } 
                ?>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung mẫu</label>
                    <?php showEditorInput('content_example', 'content_example', @$data->content_example);?>
                  </div>
                </div>

                
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>

            <br/>
            <b>Chú ý:</b> <br/>
            - Chỉ nhắn tin chăm sóc khách hàng, không nhắn tin spam, vi phạm sẽ bị khóa tài khoản vĩnh viễn. Hệ thống chỉ cho phép gửi tin nhắn theo mẫu được Zalo duyệt. <br/>
            - Giá trị dài tối đa 100 ký tự.<br/>
            - Có thể sử dụng các ký tự sau để thay thế cho thông tin của từng người dùng:<br/>

            <ul>
                <li>%name% : họ tên khách hàng</li>
                <li>%phone% : số điện thoại khách hàng</li>
                <li>%campaign_name% : tên chiến dịch khách đăng ký</li>
                <li>%group_name% : tên chiến dịch khách đăng ký</li>
                <li>%position_name% : tên chiến dịch khách đăng ký</li>
                <li>%id_user% : mã đăng ký của người dùng</li>
            </ul>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>