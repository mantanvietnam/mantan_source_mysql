<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/sendMessZaloZNS">Zalo ZNS </a> /</span>
    Gửi tin nhắn Zalo ZNS
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Gửi tin nhắn Zalo ZNS (phí gửi 500đ/tin)</h5>
          </div>
          <div class="card-body">
            <?php if($today['hours']<22 && $today['hours']>=6){ ?>
            <p><?php echo @$mess;?></p>
            <p>Số dư tài khoản: <b class="text-danger"><?php echo number_format($infoUser->coin);?>đ</b></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Mẫu tin ZNS</label>
                    <select class="form-select color-dropdown" name="" id="id_template" onchange="selectTemplateZalo()">
                      <option value="">Chọn mẫu tin có sẵn</option>
                      <?php
                      if (!empty($listTemplateZNS)) {
                          foreach ($listTemplateZNS as $item) {
                              echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                          }
                      }
                      ?>
                    </select>
                  </div>
                </div>

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
                    <label class="form-label">ID ZNS (*)</label>
                    <input type="text" class="form-control" placeholder="" name="id_zns" id="id_zns" value="" />
                  </div>
                </div>

                <?php 
                for($i=1;$i<=10;$i++){ 
                  echo '<div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tên biến '.$i.'</label>
                            <input type="text" class="form-control" placeholder="" id="variable'.$i.'" name="variable['.$i.']" value="'.@$data->content[$i]['variable'].'" />
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Giá trị biến '.$i.'</label>
                            <input maxlength="100" type="text" class="form-control" id="value'.$i.'" placeholder="" name="value['.$i.']" value="'.@$data->content[$i]['value'].'" />
                          </div>
                        </div>';

                } 
                ?>
                
              </div>

              <button type="submit" class="btn btn-primary">Gửi thông báo</button> 
            </form>
            <?php }else{
              echo '<p class="text-danger">Hệ thống Zalo không cho phép gửi tin từ 22h hôm trước đến 6h hôm sau</p>';
            }?>
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