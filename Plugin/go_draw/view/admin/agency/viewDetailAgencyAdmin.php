<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/go_draw-view-admin-agency-listAgencyAdmin.php">Đại lý</a> /</span>
        Thông tin đại lý
    </h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin đại lý</h5>
                </div>

                <div class="card-body">
                    <p id="alert-message"><?php echo $mess ?? '';?></p>
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-home" aria-selected="true">
                          Thông tin chung
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-account" aria-controls="navs-top-image" aria-selected="false">
                          Tài khoản
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-product" aria-controls="navs-top-image" aria-selected="false">
                          Sản phẩm
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-info" role="tabpanel">
                        <?= $this->Form->create(); ?>
                        <input type="hidden" name="agency_id" value="<?php echo @$data->id; ?>">
                          <div class="row">
                            <div class="col-md-6 mb-3 ">
                              <label class="form-label" for="basic-default-phone">Tên đại lý (*)</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                            </div>

                            <div class="col-md-6 mb-3 ">
                              <label class="form-label">Trạng thái</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="status" id="status">
                                  <option value="1" <?php if (!empty($data->status) && $data->status == '1') echo 'selected'; ?> >Kích hoạt</option>
                                  <option value="0" <?php if (!empty($data->status) && $data->status == '0') echo 'selected'; ?> >Khóa</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6 mb-3 ">
                              <label class="form-label" for="basic-default-phone">Địa chỉ (*)</label>
                              <input required type="text" class="form-control phone-mask" name="address" id="address" value="<?php echo @$data->address;?>" />
                            </div>

                            <div class="col-md-6 mb-3 ">
                              <label class="form-label" for="basic-default-phone">Tỉnh thành (*)</label>
                              <div class="input-group input-group-merge">
                                <select onchange="selectCity();" class="form-select" name="province_id" id="province_id" required>
                                    <option value="">Chọn tỉnh thành</option>
                                    <?php 
                                    if(!empty($listCity)){
                                        foreach ($listCity as $key => $value) {
                                            if(empty($data->province_id) || $data->province_id!=$value->province_id){
                                                echo '<option value="'.$value->province_id.'">'.$value->name.'</option>';
                                            }else{
                                                echo '<option selected value="'.$value->province_id.'">'.$value->name.'</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6 mb-3 ">
                              <label class="form-label" for="basic-default-phone">Quận huyện (*)</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="district_id" id="district_id" required onchange="selectDistrict();">
                                    <option value="">Chọn quận huyện</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6 mb-3 ">
                              <label class="form-label" for="basic-default-phone">Xã phường (*)</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="ward_id" id="ward_id" required>
                                    <option value="">Chọn xã phường</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6 mb-3 ">
                              <label class="form-label" for="basic-default-phone">Số điện thoại (*)</label>
                              <input required type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                            </div>

                            <div class="col-md-6 mb-3 ">
                              <label class="form-label" for="basic-default-phone">Email (*)</label>
                              <input required type="email" class="form-control phone-mask" name="email" id="email" value="<?php echo @$data->email;?>" />
                            </div>

                            <div class="col-md-6 mb-3 ">
                              <label class="form-label" for="basic-default-phone">Latitude GPS (*)</label>
                              <input required type="text" class="form-control phone-mask" name="lat_gps" id="lat_gps" value="<?php echo @$data->lat_gps;?>" />
                            </div>

                            <div class="col-md-6 mb-3 ">
                              <label class="form-label" for="basic-default-phone">Longitude GPS (*)</label>
                              <input required type="text" class="form-control phone-mask" name="long_gps" id="long_gps" value="<?php echo @$data->long_gps;?>" />
                            </div>

                            <div class="col-md-6 mb-3 ">
                              <label class="form-label" for="basic-default-phone">Hình ảnh cửa hàng (*)</label>
                              <?php 
                              showUploadFile('image','image',@$data->image,0);
                              ?>
                            </div>
                            
                          </div>

                          <div id="master-account" class="mb-3">
                            <h5>Chủ đại lý</h5>
                            <div class="row">
                              <input type="hidden" name="master_account_id" value="<?php echo @$masterAccount->id;?>">
                              <div class="col-md-6 mb-3">
                                <label class="form-label" for="username">Tên đăng nhập (*)</label>
                                <input type="text" class="form-control phone-mask" name="master_account_name" id="master_account_name" value="<?php echo @$masterAccount->name;?>" />
                              </div>

                              <div class="col-md-6 mb-3 ">
                                <label class="form-label">Loại tài khoản</label>
                                <div class="input-group input-group-merge">
                                  <select class="form-select" name="master_account_type" id="master_account_type" disabled>
                                    <option value="1" selected>Chủ đại lý</option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label class="form-label" for="username">Mã bảo mật (*)</label>
                                <input type="text" class="form-control phone-mask" name="master_account_code_pin" id="master_account_code_pin" value="<?php echo @$masterAccount->code_pin;?>" />
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <label class="form-label" for="password">Mật khẩu (*)</label>
                                <div class="input-group input-group-merge">
                                  <input type="password" class="form-control phone-mask" name="master_account_password" id="master_account_password"
                                         value="" placeholder="*******"
                                      <?php if (@$masterAccount->password) echo 'disabled'?>
                                  />
                                  <span class="input-group-text cursor-pointer hide-pass"
                                    data-target="master_account_password"
                                  ><i class="bx bx-hide"></i></span>
                                </div>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label class="form-label" for="password_confirmation">Nhập lại mật khẩu (*)</label>
                                <div class="input-group input-group-merge">
                                  <input type="password" class="form-control phone-mask" name="master_account_password_confirmation" id="master_account_password_confirmation"
                                         value="" placeholder="*******"
                                      <?php if (@$masterAccount->password) echo 'disabled'?>
                                  />
                                  <span class="input-group-text cursor-pointer hide-confirm-pass"
                                    data-target="master_account_password_confirmation"
                                  ><i class="bx bx-hide"></i></span>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-2">
                              <button class="btn btn-secondary btn-change-pass" type="button"
                                      data-password="master_account_password" data-password-confirm="master_account_password_confirmation"
                              >Đổi mật khẩu</button>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary">Lưu</button>
                        <?= $this->Form->end() ?>
                      </div>
                      <div class="tab-pane fade" id="navs-top-account" role="tabpanel">
                          <div id="staff-account">
                              <h5>Nhân viên đại lý</h5>
                              <?php
                                if (isset($listStaffAccount) && count($listStaffAccount)):
                                  foreach ($listStaffAccount as $key => $value):
                              ?>
                                  <div id="<?php echo 'staff-account-'.$key; ?>" class="staff-account" style="margin-top: 20px">
                                      <h6>Nhân viên</h6>
                                      <div class="row">
                                          <input type="hidden" name="master_account_id" value="<?php echo @$value->id;?>">
                                          <div class="col-md-6 mb-3">
                                              <label class="form-label" for="username">Tên đăng nhập (*)</label>
                                              <input type="text" class="form-control phone-mask" name="<?php echo 'staff_account_name['.$key.']'; ?>"
                                                     id="<?php echo 'staff_account_name['.$key.']'; ?>" value="<?php echo @$value->name;?>" />
                                          </div>

                                          <div class="col-md-6 mb-3 ">
                                              <label class="form-label">Loại tài khoản</label>
                                              <div class="input-group input-group-merge">
                                                  <select class="form-select" name="<?php echo 'staff_account_type['.$key.']'; ?>"
                                                          id="<?php echo 'staff_account_type['.$key.']'; ?>" disabled>
                                                      <option value="1">Chủ đại lý</option>
                                                      <option value="2" selected>Nhân viên đại lý</option>
                                                  </select>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-md-6 mb-3">
                                              <label class="form-label" for="password">Mật khẩu (*)</label>
                                              <div class="input-group input-group-merge">
                                                  <input type="password" class="form-control phone-mask" name="<?php echo 'staff_account_password['.$key.']'; ?>"
                                                         id="<?php echo 'staff_account_password['.$key.']'; ?>" value="" placeholder="*******"
                                                      <?php if (@$value->password) echo 'disabled';?>
                                                  />
                                                  <span class="input-group-text cursor-pointer hide-pass"
                                                    data-target="<?php echo 'staff_account_password['.$key.']'; ?>"
                                                  ><i class="bx bx-hide"></i></span>
                                              </div>
                                          </div>
                                          <div class="col-md-6 mb-3">
                                              <label class="form-label" for="password_confirmation">Nhập lại mật khẩu (*)</label>
                                              <div class="input-group input-group-merge">
                                                  <input type="password" class="form-control phone-mask" name="<?php echo 'staff_account_password_confirmation['.$key.']'; ?>"
                                                         id="<?php echo 'staff_account_password_confirmation['.$key.']'; ?>"  value="" placeholder="*******"
                                                      <?php if (@$value->password) echo 'disabled';?>
                                                  />
                                                  <span class="input-group-text cursor-pointer hide-confirm-pass"
                                                        data-target="<?php echo 'staff_account_password_confirmation['.$key.']'; ?>"
                                                  ><i class="bx bx-hide"></i></span>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-md-6">
                                              <button class="btn btn-secondary btn-change-pass" type="button" id="<?php echo 'btn-change-pass-'.$key; ?>"
                                                      data-password="<?php echo 'staff_account_password['.$key.']'; ?>"
                                                      data-password-confirm="<?php echo 'staff_account_password_confirmation['.$key.']'; ?>"
                                              >Đổi mật khẩu</button>
                                          </div>
                                          <div class="col-md-6 justify-content-end d-flex">
                                              <button class="btn btn-primary btn-save-account" type="button" style="margin: 0 5px"
                                                      data-target="<?php echo $value->id;?>"
                                                      data-input-number="<?php echo $key; ?>"
                                              >Lưu</button>
                                              <button class="btn btn-danger btn-delete-account" type="button" style="margin: 0 5px"
                                                      data-target="<?php echo $value->id;?>"
                                                      data-remove="<?php echo 'staff-account-'.$key; ?>"
                                              >Xóa</button>
                                          </div>
                                      </div>
                                  </div>
                              <?php
                                  endforeach;
                                else:
                                    echo '<h6 id="no-account">Chưa có tài khoản nhân viên</h6>';
                                endif;
                              ?>
                              <div id="start-ref"></div>
                          </div>

                          <div class="d-flex justify-content-end">
                              <button class="btn btn-primary justify-content-end d-flex" id="btn-add-account" type="button" style="margin-top: 30px">
                                  Thêm tài khoản
                              </button>
                          </div>
                      </div>

                      <div class="tab-pane fade" id="navs-top-product" role="tabpanel">
                        <div class="row">
                            <h5>Sản phẩm<h5>
                            <p> Chưa có sản phẩm </p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    global $csrfToken;
?>
<script>
  let numberOfAccount = Number("<?php echo isset($listStaffAccount) ? count($listStaffAccount) : 0 ?>");
  $(document).on('click', '.hide-confirm-pass', function () {
    const child = $(this).children('i')[0];
    const target = $(this).data('target');
    console.log(target)
    if ($(child).hasClass('bx-hide')) {
      $(document.getElementById(`${target}`)).attr('type', 'text');
      $(child).removeClass('bx-hide');
      $(child).addClass('bx-show');
    } else {
      $(document.getElementById(`${target}`)).attr('type', 'password');
      $(child).removeClass('bx-show');
      $(child).addClass('bx-hide');
    }
  });

  $(document).on('click', '.hide-pass', function () {
    const child = $(this).children('i')[0];
    const target = $(this).data('target');
    if ($(child).hasClass('bx-hide')) {
      $(document.getElementById(`${target}`)).attr('type', 'text');
      $(child).removeClass('bx-hide');
      $(child).addClass('bx-show');
    } else {
      $(document.getElementById(`${target}`)).attr('type', 'password');
      $(child).removeClass('bx-show');
      $(child).addClass('bx-hide');
    }
  });

  $(document).on('click', '.btn-change-pass', function () {
      confirm('Bạn có chắc chắn muốn đổi mật khẩu không?');
      const password = $(this).data('password');
      const passwordConfirm = $(this).data('password-confirm');
      $(document.getElementById(password)).prop('disabled', false);
      $(document.getElementById(passwordConfirm)).prop('disabled', false);
      $(this).prop('disabled', true);
  });

  $(document).on('click', '.btn-delete-account', function () {
      const token = "<?php echo $csrfToken;?>";
      const accountId = $(this).data('target');
      const remove = $(this).data('remove');
      if (accountId) {
          confirm('Bạn có chắc chắn muốn xóa tài khoản này không?');
          $.ajax({
              method: "POST",
              url: '/apis/adminDeleteAccountApi',
              headers: {'X-CSRF-Token': token},
              data: {
                  id: accountId
              },
              success: function (result) {
                  let message = '';
                  if (!result.code) {
                      message = `<p class="text-success">${result.messages}</p>`;
                  } else {
                      message = `<p class="text-danger">${result.messages}</p>`;
                  }
                  $('#alert-message').empty();
                  $('#alert-message').append(message);
                  $(document.getElementById(remove)).remove();
              },
              error: function () {
                  $('#alert-message').empty();
                  $('#alert-message').append(`<p class="text-danger">Đã xảy ra lỗi</p>`);
              },
              complete: function () {
                  setTimeout(function () {
                      $('#alert-message').empty();
                  }, 3000);
              }
          });
      } else {
          $(document.getElementById(remove)).remove();
      }
  });

  $(document).on('click', '#btn-add-account', function () {
      let lastElement = $('#start-ref');
      lastElement.before(`
          <div id="staff-account-${numberOfAccount}" class="staff-account" style="margin-top: 20px">
          <h6>Nhân viên</h6>
          <div class="row">
              <input type="hidden" name="staff-account-id-${numberOfAccount}" value="">
              <div class="col-md-6 mb-3">
                  <label class="form-label" for="username">Tên đăng nhập (*)</label>
                  <input type="text" class="form-control phone-mask" name="staff_account_name[${numberOfAccount}]"
                         id="staff_account_name[${numberOfAccount}]" value="" />
              </div>

              <div class="col-md-6 mb-3 ">
                  <label class="form-label">Loại tài khoản</label>
                  <div class="input-group input-group-merge">
                      <select class="form-select" name="staff_account_type[${numberOfAccount}]"
                              id="staff_account_type[${numberOfAccount}]" disabled>
                          <option value="1">Chủ đại lý</option>
                          <option value="2" selected>Nhân viên đại lý</option>
                      </select>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-md-6 mb-3">
                  <label class="form-label" for="password">Mật khẩu (*)</label>
                  <div class="input-group input-group-merge">
                      <input type="password" class="form-control phone-mask" name="staff_account_password[${numberOfAccount}]"
                             id="staff_account_password[${numberOfAccount}]" value="" placeholder="*******"
                      />
                      <span class="input-group-text cursor-pointer hide-pass"><i class="bx bx-hide"></i></span>
                  </div>
              </div>
              <div class="col-md-6 mb-3">
                  <label class="form-label" for="password_confirmation">Nhập lại mật khẩu (*)</label>
                  <div class="input-group input-group-merge">
                      <input type="password" class="form-control phone-mask" name="staff_account_password_confirmation[${numberOfAccount}]"
                             id="staff_account_password_confirmation[${numberOfAccount}]" value="" placeholder="*******"
                      />
                      <span class="input-group-text cursor-pointer hide-confirm-pass"><i class="bx bx-hide"></i></span>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-6 justify-content-end d-flex">
                  <button class="btn btn-primary btn-save-account" type="button" style="margin: 0 5px"
                          data-target=""
                          data-input-number="${numberOfAccount}"
                  >Lưu</button>
                  <button class="btn btn-danger btn-delete-account" type="button" style="margin: 0 5px"
                          data-target=""
                          data-remove="staff-account-${numberOfAccount}"
                  >Xóa</button>
              </div>
          </div>
      </div>
      `);
      $('#no-account').remove();
      numberOfAccount++;
  });

  $(document).on('click', '.btn-save-account', function () {
      confirm('Bạn có chắc chắn muốn cập nhật tài khoản này không?');
      const number = $(this).data('input-number');
      const id = $(this).data('target');
      const agency_id = $('input[name=agency_id]').val();
      const name = $(document.getElementById(`staff_account_name[${number}]`)).val();
      const password = $(document.getElementById(`staff_account_password[${number}]`)).val();
      const password_confirmation = $(document.getElementById(`staff_account_password_confirmation[${number}]`)).val();
      const token = "<?php echo $csrfToken;?>";
      $.ajax({
          method: "POST",
          url: '/apis/adminUpdateStaffAccountApi',
          headers: {'X-CSRF-Token': token},
          data: {name, password, password_confirmation, id, agency_id},
          success: function (result) {
              let message = '';
              if (!result.code) {
                  message = `<p class="text-success">${result.messages}</p>`;
              } else {
                  message = `<p class="text-danger">${result.messages}</p>`;
              }
              $('#alert-message').empty();
              $('#alert-message').append(message);
              $(document.getElementById(`btn-change-pass-${number}`)).prop('disabled', false);
              $(document.getElementById(`staff_account_password[${number}]`)).prop('disabled', true);
              $(document.getElementById(`staff_account_password_confirmation[${number}]`)).prop('disabled', true);
          },
          error: function () {
              $('#alert-message').empty();
              $('#alert-message').append(`<p class="text-danger">Đã xảy ra lỗi</p>`);
          },
          complete: function () {
              setTimeout(function () {
                  $('#alert-message').empty();
              }, 3000);
          }
      });
  })
</script>

<script type="text/javascript">
    var district_id = "<?php echo @$data->district_id;?>";
    var ward_id = "<?php echo @$data->ward_id;?>";
    
    function selectDistrict()
    {
        var district_select = $('#district_id').val();

        var ward_option = '<option value="">Chọn xã phường</option>';
        var i;

        if(district_select != ""){
            $.ajax({
              method: "POST",
              url: "/apis/getWardAPI",
              data: { district_id: district_select }
            })
            .done(function( msg ) {
                if(msg.length>0){
                    for(i=0;i<msg.length;i++){
                        if(msg[i].wards_id != ward_id){
                            ward_option += '<option value="'+msg[i].wards_id+'">'+msg[i].name+'</option>';
                        }else{
                            ward_option += '<option selected value="'+msg[i].wards_id+'">'+msg[i].name+'</option>';
                        }
                    }
                }

                $('#ward_id').html(ward_option);
            });
        }else{
          $('#ward_id').html(ward_option);
        }
    }

    function selectCity()
    {
        var province_id = $('#province_id').val();
        var district_option = '<option value="">Chọn quận huyện</option>';
        var i;

        if(province_id != ""){
            $.ajax({
              method: "POST",
              url: "/apis/getDistrictAPI",
              data: { province_id: province_id }
            })
            .done(function( msg ) {
                if(msg.length>0){
                    for(i=0;i<msg.length;i++){
                        if(msg[i].district_id != district_id){
                            district_option += '<option value="'+msg[i].district_id+'">'+msg[i].name+'</option>';
                        }else{
                            district_option += '<option selected value="'+msg[i].district_id+'">'+msg[i].name+'</option>';
                        }
                    }
                }

                $('#district_id').html(district_option);

                selectDistrict();
            });
        }else{
            $('#district_id').html(district_option);

            selectDistrict();
        }
    }

    

    selectCity();

</script>