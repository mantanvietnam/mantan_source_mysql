<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listSendMessAPPMobile">Thông báo APP Mobile </a> /</span>
    Gửi thông báo
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Gửi thông báo trên app mobile (phí gửi 200đ/tin)</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <p>Số dư tài khoản: <b class="text-danger"><?php echo number_format($infoUser->coin);?>đ</b></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Đối tượng nhận tin</label>
                    <select class="form-select color-dropdown" name="type_user" id="type_user" onchange="selectTypeUser();">
                      <option value="">Gửi toàn hệ thống</option>
                      <option value="all_customer">Gửi tất cả khách hàng</option>
                      <option value="all_member">Gửi tất cả đại lý</option>
                      <option value="customer_campaign">Người dùng theo chiến dịch</option>
                      <option value="customer_group">Người dùng theo nhóm</option>
                      <option value="member_position">Đại lý theo chức danh</option>
                      <option value="test_member">Gửi test kiểm tra app đại lý</option>
                      <option value="test_customer">Gửi test kiểm tra app khách hàng</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label">quy ước hành động thông báo</label>
                    <select class="form-select color-dropdown" name="action" id="action" onchange="selectTypeUser();">
                      <option value="notificationAdmin">thông báo text</option>
                      <option value="news"> thông tin chi tiết bài viết</option>
                      <option value="courses">thông tin chi tiết khóa học</option>
                      <option value="campaign">thông tin chi tiết chiến dịch</option>
                      <option value="document">thông tin chi tiết tài liệu</option>
                    </select>
                  </div>
                </div>
                 <div class="col-md-2">
                  <div class="mb-3">
                    <label class="form-label">id đối tượng</label>
                  <input type="text" autocomplete="off" class="form-control" name="id_object" id="id_object" value="">
              
                  </div>
                </div>

                <div class="col-md-12" style="display: none;" id="selectCampaign">
                  <div class="mb-3">
                    <label class="form-label">Chiến dịch</label>
                    <select class="form-select color-dropdown" name="id_campaign" id="id_campaign">
                      <option value="">Tất cả chiến dịch</option>
                      <?php
                      if (!empty($listCampaign)) {
                          foreach ($listCampaign as $item) {
                              echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                          }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-12" style="display: none;" id="selectGroupCustomer">
                  <div class="mb-3">
                    <label class="form-label">Nhóm khách hàng</label>
                    <select class="form-select color-dropdown" name="id_group_customer" id="id_group_customer">
                      <option value="">Tất cả nhóm khách hàng</option>
                      <?php
                      if (!empty($listGroupCustomer)) {
                          foreach ($listGroupCustomer as $item) {
                              echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                          }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-12" style="display: none;" id="selectPosition">
                  <div class="mb-3">
                    <label class="form-label">Chức danh đại lý</label>
                    <select class="form-select color-dropdown" name="id_position" id="id_position">
                      <option value="">Tất cả chức danh</option>
                      <?php
                      if (!empty($listPositions)) {
                          foreach ($listPositions as $item) {
                              echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                          }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-12" style="display: none;" id="selectTestMember">
                  <div class="mb-3">
                    <label class="form-label">Nhập số điện thoại đại lý để test</label>
                    <input type="text" class="form-control" placeholder="" name="phone_test_member" id="phone_test_member" value="" />
                  </div>
                </div>

                <div class="col-md-12" style="display: none;" id="selectTestCustomer">
                  <div class="mb-3">
                    <label class="form-label">Nhập số điện thoại khách hàng để test</label>
                    <input type="text" class="form-control" placeholder="" name="phone_test_customer" id="phone_test_customer" value="" />
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Tiêu đề (*)</label>
                    <input type="text" name="title" class="form-control phone-mask" required value="" />
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Nội dung thông báo (*)</label>
                    <textarea class="form-control phone-mask" name="content" rows="5"></textarea>
                  </div>
                </div>
                
              </div>

              <button type="submit" class="btn btn-primary">Gửi thông báo</button> 
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
  function selectTypeUser()
  {
    var type_user = $('#type_user').val();

    $('#selectCampaign').hide();
    $('#selectGroupCustomer').hide();
    $('#selectPosition').hide();
    $('#selectTestMember').hide();
    $('#selectTestCustomer').hide();

    if(type_user == 'customer_campaign'){
      $('#selectCampaign').show();
    }else if(type_user == 'customer_group'){
      $('#selectGroupCustomer').show();
    }else if(type_user == 'member_position'){
      $('#selectPosition').show();
    }else if(type_user == 'test_member'){
      $('#selectTestMember').show();
    }else if(type_user == 'test_customer'){
      $('#selectTestCustomer').show();
    }
  }
</script>

<?php include(__DIR__.'/../footer.php'); ?>