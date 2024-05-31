<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listAppointmentAgency">Lịch hẹn</a> /</span>
    Thông tin đặt lịch hẹn
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin đặt lịch hẹn</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Họ tên Khách hàng (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                    <input required type="hidden" class="form-control phone-mask" name="id_customer" id="id_customer" value="<?php echo @$data->id_customer;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text" class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Thời gian hẹn </label>
                    <input required type="text" name="time" class="form-control  " id="time"  min="<?php echo date('d/m/Y H:i'); ?>" value="<?php echo (!empty($data->time))?  @$data->time->format('Y-m-d H:i') : date('Y-m-d H:i', time()); ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Trạng thái</label>
                  <select name="status" class="form-select color-dropdown">
                    <option value="0" <?php if(isset($data->status) && $data->status=='0') echo 'selected';?> >Chưa xác nhận </option>
                    <option value="1" <?php if(!empty($data->status) && $data->status=='1') echo 'selected';?> >Xác nhận</option>
                    <option value="2" <?php if(!empty($data->status) && $data->status=='2') echo 'selected';?> >Không đến</option>
                    <option value="3" <?php if(!empty($data->status) && $data->status=='3') echo 'selected';?> >Đã đến</option>
                    <option value="4" <?php if(!empty($data->status) && $data->status=='4') echo 'selected';?> >Hủy lịch</option>
                </select>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung hẹn</label>
                    <textarea class="form-control"name="note"><?php echo @$data->note; ?></textarea>
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
<script type="text/javascript">
   $(document).ready(function(){
    $('#time').datetimepicker({
      format: 'Y-m-d H:i',
      step: 15,
      minDate: new Date(),
});

        });

    // tìm khách hàng s
    $(function() {
       function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $( "#name" )
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
                
                $( "#name" ).val(ui.item.full_name);
                $( "#id_customer" ).val(ui.item.id);
                $( "#phone" ).val(ui.item.phone);
                $( "#email" ).val(ui.item.email);

                return false;
            }
        });

         $( "#phone" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchCustomerAPI", {
                    phone: extractLast( request.term )
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
                
                $( "#name" ).val(ui.item.full_name);
                $( "#id_customer" ).val(ui.item.id);
                $( "#phone" ).val(ui.item.phone);
                $( "#email" ).val(ui.item.email);

                return false;
            }
        });

        $( "#email" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchCustomerAPI", {
                    email: extractLast( request.term )
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
                
                $( "#name" ).val(ui.item.full_name);
                $( "#id_customer" ).val(ui.item.id);
                $( "#phone" ).val(ui.item.phone);
                $( "#email" ).val(ui.item.email);

                return false;
            }
        });

    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<?php include(__DIR__.'/../footer.php'); ?>
