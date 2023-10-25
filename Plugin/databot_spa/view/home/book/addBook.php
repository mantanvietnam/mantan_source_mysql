<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listBook">Lịch hẹn</a> /</span>
    Thông tin lịch hẹn
  </h4>

  <p><a href="/addCustomer" target="_blank" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm khách hàng mới</a></p>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin lịch hẹn</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="basic-default-phone">Tên khách hàng (*)</label>
                      <input required type="text" placeholder="Vui lòng nhập tên hoặc sđt khách hàng" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" >
                      <input type="hidden" name="id_customer" id="id_customer" value="<?php echo (int) @$data->id_customer;?>">
                    </div>
                    <div class="mb-3 form-group col-md-6">
                         <label class="form-label" for="basic-default-fullname">Ngày đặt:</label>
                        <input type="text" name="time_book" class="form-control hasDatepicker datetimepicker" id="time_book" value="<?php echo (!empty($data['time_book']))?  date("d/m/Y H:i", @$data['time_book']) : " " ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                      <input type="text" required class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                    </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Email</label>
                        <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                      </div>
                  
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="basic-default-email">Nhân viên phụ trách</label>
                      <div class="input-group input-group-merge">
                        <select class="form-select" name="id_staff" id="id_staff">
                          <?php foreach($dataMember as $key => $item){ ?>
                            <option value="<?php echo $item->id ?>" <?php if(isset($data->id_staff) && $data->id_staff==$item->id ) echo 'selected'; ?> ><?php echo $item->name ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="basic-default-fullname">Dịch vụ (*)</label>
                      <select class="form-select" name="id_service" id="id_service" required>
                        <option value="" >Chọn dịch vụ</option>
                        <?php foreach($dataService as $key => $item){ ?>
                          <option value="<?php echo $item->id ?>" <?php if(isset($data->id_service) && $data->id_service== $item->id) echo 'selected'; ?> ><?php echo $item->name ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="mb-3 col-md-1">
                        <label class="form-label" for="basic-default-fullname">Lặp</label>
                        <div class="form-check form-switch mb-2">
                          <input onclick="repeatBook();" class="form-check-input" type="checkbox" id="repeat_book" name="repeat_book" value="1" style="width: 40px;height: 20px;" <?php if(!empty($data->repeat_book)) echo 'checked';?> >
                        </div>
                    </div>

                    <div class="mb-3 col-md-2">
                        <label class="form-label" for="basic-default-fullname">Cách ngày</label>
                        <input disabled type="number" class="form-control" placeholder="" name="apt_step" id="apt_step" value="<?php echo @$data->apt_step;?>" required />
                    </div>
                    
                    <div class="mb-3 col-md-3">
                        <label class="form-label" for="basic-default-fullname">Tổng số lần</label>
                        <input disabled type="number" class="form-control" placeholder="" name="apt_times" id="apt_times" value="<?php echo @$data->apt_times;?>" required />
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label" for="basic-default-fullname">Trạng thái</label>
                        <select name="status" class="form-select">
                          <option value="0">Chưa xác nhận</option>
                          <option value="1" <?php if(!empty($data->status) && $data->status==1) echo 'selected';?>>Xác nhận</option>
                          <option value="2" <?php if(!empty($data->status) && $data->status==2) echo 'selected';?>>Không đến</option>
                          <option value="3" <?php if(!empty($data->status) && $data->status==3) echo 'selected';?>>Đã đến</option>
                          <option value="4" <?php if(!empty($data->status) && $data->status==4) echo 'selected';?>>Hủy lịch</option>
                          <option value="5" <?php if(!empty($data->status) && $data->status==5) echo 'selected';?>>Đặt online</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="form-label" for="basic-default-fullname">Giường & phòng </label>
                        <select  name="id_bed" id="id_bed"  class="form-select color-dropdown"> 
                            <option value="">Chọn giường</option>
                            <?php if(!empty($listRoom))
                                        foreach ($listRoom as $room) { 
                                            echo '<optgroup label="'.$room->name.'">';
                                            if(!empty($room->bed)){
                                                foreach($room->bed as $bed){
                                                   if(!empty($data->id_bed) && $data->id_bed==$bed->id){
                                                        $selected = 'selected';
                                                   }
                                                                   
                                                    echo '<option data-unit="'.@$bed->id.'"  value="'.$bed->id.'" '.$selected.'>'.$bed->name.'</option>';
                                               }
                                            }
                                            echo '</optgroup>';
                                        }?>
                        </select>
                    </div>




                    <div class="mb-3 col-md-12">
                       <label class="form-label" for="basic-default-fullname">Kiểu đặt</label>
                      <div class="form-group d-flex justify-content-around">
                          <label class="i-checks i-checks-sm">
                              <input type="checkbox" name="type1"  class="staffcheck"  <?php if(!empty($data->type1)) echo 'checked ';  ?> value="1">
                              
                              <span>&nbsp;&nbsp;&nbsp;&nbsp; Lịch tư vấn</span>
                          </label>
                          
                          <label class="i-checks i-checks-sm">

                              <input type="checkbox" name="type2" class="staffcheck"  <?php if(!empty($data->type2)) echo 'checked ';  ?> value="1">
                              
                              <span>&nbsp;&nbsp;&nbsp;&nbsp; Lịch chăm sóc</span>
                          </label>

                          <label class="i-checks i-checks-sm">

                              <input type="checkbox" name="type3" class="staffcheck"  <?php if(!empty($data->type3)) echo 'checked ';  ?> value="1">
                              
                              <span>&nbsp;&nbsp;&nbsp;&nbsp; Lịch liệu trình</span>
                          </label>
                          
                          <label class="i-checks i-checks-sm">

                              <input type="checkbox" name="type4" class="staffcheck"  <?php if(!empty($data->type4)) echo 'checked ';  ?> value="1">
                              
                              <span>&nbsp;&nbsp;&nbsp;&nbsp; Lịch điều trị</span>
                          </label> 
                      </div>
                    </div>
                    <div class="mb-3 col-md-12">
                      <label class="form-label" for="basic-default-fullname">Thông tin thêm</label>
                      <textarea class="form-control" rows="5" name="note"><?php echo @$data->note;?></textarea>
                    </div>
                    
                    <div class="mb-3 col-md-12">
                      <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                  </div>
                </div>
              </div>

             
            <?= $this->Form->end() ?>
          
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
  function repeatBook() {
    if($('#repeat_book').is(":checked")){
      $('#apt_step').prop("disabled", false);
      $('#apt_times').prop("disabled", false);
    }else{
      $('#apt_step').prop("disabled", true);
      $('#apt_times').prop("disabled", true);
    }
  }

  repeatBook();
</script>
<script type="text/javascript">
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $("#name")
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#id_customer').val(0);
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchCustomerApi", {
                    key: extractLast( request.term )
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
               
                $('#name').val(ui.item.name);
                $('#id_customer').val(ui.item.id);
                $('#phone').val(ui.item.phone);
                $('#email').val(ui.item.email);
          
                return false;
            }
        });

        $("#phone")
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#id_customer').val(0);
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchCustomerApi", {
                    key: extractLast( request.term )
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
               
                $('#name').val(ui.item.name);
                $('#id_customer').val(ui.item.id);
                $('#phone').val(ui.item.phone);
                $('#email').val(ui.item.email);
          
                return false;
            }
        });

        $("#email")
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#id_customer').val(0);
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchCustomerApi", {
                    key: extractLast( request.term )
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
               
                $('#name').val(ui.item.name);
                $('#id_customer').val(ui.item.id);
                $('#phone').val(ui.item.phone);
                $('#email').val(ui.item.email);
          
                return false;
            }
        });
    });
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<?php include(__DIR__.'/../footer.php'); ?>