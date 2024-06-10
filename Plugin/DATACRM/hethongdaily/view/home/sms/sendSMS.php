<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/sendSMS">SMS </a> /</span>
    Gửi tin nhắn SMS
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Gửi tin nhắn SMS (phí gửi 700đ/tin)</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <p>Số dư tài khoản: <b class="text-danger"><?php echo number_format($infoUser->coin);?>đ</b></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Đối tượng nhận tin (*)</label>
                    <select class="form-select color-dropdown" name="type_user" id="type_user" required onchange="selectTypeUser();">
                      <option value="">Chọn đối tượng</option>
                      <option value="customer_campaign">Người dùng theo chiến dịch</option>
                      <option value="customer_group">Người dùng theo nhóm</option>
                      <option value="member_position">Đại lý theo chức danh</option>
                      <option value="test">Gửi test kiểm tra</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Hình thức thông báo</label><br/>
                    <input type="radio" checked value="sms" name="type"> Gửi tin nhắn 
                    <input type="radio" value="voice" name="type"> Gọi điện
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

                <div class="col-md-12" style="display: none;" id="selectTest">
                  <div class="mb-3">
                    <label class="form-label">Nhập số điện thoại test</label>
                    <input type="text" class="form-control" placeholder="" name="phone_test" id="phone_test" value="" />
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Nội dung tin nhắn (*)</label>
                    <textarea required class="form-control phone-mask" name="mess" rows="5"></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <b>Chú ý:</b> <br>
                  - Chỉ nhắn tin chăm sóc khách hàng, không nhắn tin spam, vi phạm sẽ bị khóa tài khoản vĩnh viễn. Hệ thống chỉ cho phép gửi tin nhắn tiếng việt không dấu. <br>
                  - Mỗi tin nhắn dài tối đa 160 ký tự.<br>
                  - Không dùng các ký tự nháy đơn, nháy kép, &amp; . Có thể sử dụng các ký tự sau để thay thế cho thông tin của từng người dùng:<br>

                  <ul>
                      <li>%name% : họ tên người dùng</li>
                      <li>%id_user% : mã ID của người dùng</li>
                      <li>%rand% : mã ngẫu nhiên hệ thống tự tạo ra để giảm tỷ lệ spam</li>
                      <li class="text-danger">Nên sử dụng thêm spin dạng {hi|chào|alo} để nội dung tin nhắn khác nhau mỗi lần gửi</li>
                  </ul>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Gửi tin nhắn</button> 
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
  var id_template = '<?php echo @$_GET['id_template'];?>';

  $('#id_template').val(id_template);

  var listTemplateZalo = {};
  <?php
  if (!empty($listTemplateZNS)) {
      foreach ($listTemplateZNS as $item) {
          echo '  listTemplateZalo["'.$item->id.'"] = {};
                  listTemplateZalo["'.$item->id.'"]["idZNS"] = "'.$item->id_zns.'";
                  listTemplateZalo["'.$item->id.'"]["variable"] = {};
                  listTemplateZalo["'.$item->id.'"]["value"] = {};
          ';

          $item->content = json_decode($item->content, true);
          for ($i=1; $i <= 10 ; $i++) { 
              echo '  listTemplateZalo["'.$item->id.'"]["variable"]["'.$i.'"] = "'.@$item->content[$i]['variable'].'";

                      listTemplateZalo["'.$item->id.'"]["value"]["'.$i.'"] = "'.@$item->content[$i]['value'].'";
              ';
          }
      }
  }
  ?>

  function selectTemplateZalo()
  {
      var templateID = $('#id_template').val();

      if(templateID != ''){
        $('#id_zns').val(listTemplateZalo[templateID]['idZNS']);

        for (var i = 1; i <= 10; i++) {
            $('#variable'+i).val(listTemplateZalo[templateID]['variable'][i]);
            $('#value'+i).val(listTemplateZalo[templateID]['value'][i]);
        }
      }else{
        $('#id_zns').val('');

        for (var i = 1; i <= 10; i++) {
            $('#variable'+i).val('');
            $('#value'+i).val('');
        }
      }
  }

  function selectTypeUser()
  {
    var type_user = $('#type_user').val();

    $('#selectCampaign').hide();
    $('#selectGroupCustomer').hide();
    $('#selectPosition').hide();
    $('#selectTest').hide();

    if(type_user == 'customer_campaign'){
      $('#selectCampaign').show();
    }else if(type_user == 'customer_group'){
      $('#selectGroupCustomer').show();
    }else if(type_user == 'member_position'){
      $('#selectPosition').show();
    }else if(type_user == 'test'){
      $('#selectTest').show();
    }
  }

  if(id_template != ''){
    selectTemplateZalo();
  }
</script>

<?php include(__DIR__.'/../footer.php'); ?>