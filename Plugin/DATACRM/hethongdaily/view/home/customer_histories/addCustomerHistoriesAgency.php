<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/calendarCustomerHistoriesAgency">Chăm sóc khách hàng</a> /</span>
    Thông tin chăm sóc
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin chăm sóc <a href="javascript:void(0);" onclick="showAddCustom();" title="Thêm khách hàng mới" class="btn btn-primary"><i class="bx bx-plus"></i></a></h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên khách hàng (*) </label>
                    <input type="text" required class="form-control" name="customer_buy" id="customer_buy" value="" />
                    <input required type="hidden" class="form-control phone-mask" name="id_customer" id="id_customer" value="<?php if(!empty($data->id_customer)){ 
                                    echo $data->id_customer; 
                                  } elseif(!empty($_GET['id_customer'])){ 
                                    echo (int) $_GET['id_customer'];
                                  }?>" />

                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Hành động chăm sóc (*)</label>
                    <div class="input-group input-group-merge">
                      <select required class="form-select" name="action_now" id="action_now">
                        <option value="">Chọn hành động</option>
                        <option value="call" <?php if(!empty($data->status) && $data->status=='call') echo 'selected'; ?> >Gọi điện</option>
                        <option value="message" <?php if(isset($data->status) && $data->status=='message') echo 'selected'; ?> >Nhắn tin</option>
                        <option value="go_meet" <?php if(isset($data->status) && $data->status=='go_meet') echo 'selected'; ?> >Đi gặp</option>
                        <option value="online_meeting" <?php if(isset($data->status) && $data->status=='online_meeting') echo 'selected'; ?> >Họp online</option>
                      </select>
                    </div>
                  </div>
                  
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Thời gian chăm sóc (*)</label>
                    <input type="text" required class="form-control phone-mask datetimepicker" name="time_now" id="time_now" value="<?php if(!empty($data->time_now)) echo date('H:i d/m/Y', $data->time_now);?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="new" <?php if(!empty($data->status) && $data->status=='new') echo 'selected'; ?> >Chưa thực hiện</option>
                        <option value="done" <?php if(isset($data->status) && $data->status=='done') echo 'selected'; ?> >Đã hoàn thành</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Nội dung chăm sóc (*)</label>
                    <textarea required class="form-control phone-mask" name="note_now" id="note_now" ><?php echo @$data->note_now;?></textarea>
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
<div id="addCustomer"  class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm thông tin khách hàng mới</h4>
                
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <div class="data-content card-body">
                <div id="messAddCustom"></div>
                <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Họ tên (*)</label>
                        <input required type="text" class="form-control phone-mask" name="full_name" id="full_name" value="" />
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                        <input type="text" class="form-control" placeholder="" name="phone" id="phone" value="" />
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Email</label>
                        <input type="email" class="form-control" placeholder="" name="email" id="email" value="" />
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                        <input type="text" class="form-control phone-mask" name="address" id="address" value="" />
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Giới tính</label>
                        <select name="sex" id='sex' class="form-select color-dropdown">
                          <option value="0">Nữ</option>
                          <option value="1" >Nam</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                        <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Ngày sinh</label>
                        
                        <div class="row">
                          <div class="mb-3 col-md-4">
                            <select name="birthday_date" id="birthday_date" class="form-select color-dropdown">
                              <option value="0">Ngày</option>
                              <?php
                              for ($i=1; $i <= 31 ; $i++) {
                                  echo '<option value="'.$i.'">'.$i.'</option>';
                              }
                              ?>
                            </select>
                          </div>

                          <div class="mb-3 col-md-4">
                            <select name="birthday_month" id="birthday_month" class="form-select color-dropdown">
                              <option value="0">Tháng</option>
                              <?php
                              for ($i=1; $i <= 12 ; $i++) { 
                                  echo '<option value="'.$i.'">'.$i.'</option>';
                              }
                              ?>
                            </select>
                          </div>

                          <div class="mb-3 col-md-4">
                            <select name="birthday_year" id="birthday_year" class="form-select color-dropdown">
                              <option value="0">Năm</option>
                              <?php
                              for ($i=1950; $i <= 2024 ; $i++) { 
                                  echo '<option value="'.$i.'">'.$i.'</option>';
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Nhóm khách hàng</label>
                        <ul class="list-inline">
                          <?php
                            if(!empty($listGroupCustomer)){
                              foreach ($listGroupCustomer as $key => $value) {
                                        // $stt = $key+1;
                                echo '<li>
                                        <input  type="checkbox" value="'.$value->id.'" name="id_group[]" class="id_group" /> '.$value->name.'
                                      </li>';
                              }
                            }
                          ?>
                        </ul>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Facebook</label>
                        <input type="text" class="form-control phone-mask" name="facebook" id="facebook" value="<?php echo @$data->facebook;?>" />
                      </div>
                    </div>
                </div>
                <div class="row">

                    <div class="text-center col-sm-12" style="padding-bottom: 30px;">
                        <button type="button" class="btn btn-primary" onclick="addCustomer();">Lưu thông tin</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }

    function extractLast( term ) {
      return split( term ).pop();
    }

    $( "#customer_buy" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
          if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
            event.preventDefault();
          }
        })
        .autocomplete({
          source: function( request, response ) {
            $.getJSON( "/apis/searchCustomerAPI", {
              term: extractLast( request.term )
            }, response );
          },
          search: function() {
                // custom minLength
                var term = extractLast( this.value );

                if ( term.length < 2 ) {
                  return false;
                }
              },
              focus: function() {
                // prevent value inserted on focus
                return false;
              },
              select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );
                
                $( "#customer_buy" ).val(ui.item.full_name);
                $( "#id_customer" ).val(ui.item.id);

                return false;
              }
            });
      });

  function showAddCustom()
  {
    $('#addCustomer').modal('show');
  }

  function addCustomer()
  {

    var full_name= $('#full_name').val();
    var email= $('#email').val();
    var phone= $('#phone').val();
    var address= $('#address').val();
    var avatar= $('#avatar').val();
    var birthday_date= $('#birthday_date').val();
    var birthday_month= $('#birthday_month').val();
    var birthday_year= $('#birthday_year').val();
    var facebook= $('#facebook').val();
    var checkboxes = document.querySelectorAll('.id_group');
    var values = [];
    checkboxes.forEach(function(checkbox) {
      if (checkbox.checked) {
        values.push(checkbox.value);
      }
    });

    var id_group = values.join(',');
    
    $.ajax({
      method: "POST",
      url: "/apis/saveInfoCustomerAjax",
      data: { 
        full_name: full_name,
        email: email, 
        phone: phone, 
        address: address, 
        avatar: avatar, 
        birthday_date: birthday_date, 
        birthday_month: birthday_month, 
        birthday_year: birthday_year, 
        id_group: id_group, 
        facebook: facebook,
      }
    })
    .done(function( msg ) {
      console.log(msg);

            // var obj = jQuery.parseJSON(msg);
             // console.log(obj);
             if(msg.code==1){
              $('#id_customer').val(msg.idCus);
              $('#customer_buy').val(msg.cus_name);
              $('#addCustomer').modal('hide');
            }else{
              console.log(msg.mess);
              $('#messAddCustom').html(msg.mess);
              
            }


          }) 
    
  }
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<?php include(__DIR__.'/../footer.php'); ?>