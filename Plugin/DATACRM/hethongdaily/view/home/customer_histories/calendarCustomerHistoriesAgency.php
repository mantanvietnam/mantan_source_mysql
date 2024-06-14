<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="/orderCustomerAgency">Khách hàng</a> /</span>Lịch sử chăm sóc khách hàng</h4>
  <p><a href="/addCustomerHistoriesAgency" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control" name="name_customer" id="name_customer" value="<?php if(!empty($_GET['name_customer'])) echo $_GET['name_customer'];?>">
            <input type="hidden" class="form-control" name="id_customer" id="idcustomer" value="<?php if(!empty($_GET['id_customer'])) echo $_GET['id_customer'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Hành động chăm sóc</label>
            <select name="action_now" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="call" <?php if(!empty($_GET['action_now']) && $_GET['action_now']=='call') echo 'selected';?> >Gọi điện</option>
              <option value="message" <?php if(!empty($_GET['action_now']) && $_GET['action_now']=='message') echo 'selected';?> >Nhắn tin</option>
              <option value="go_meet" <?php if(!empty($_GET['action_now']) && $_GET['action_now']=='go_meet') echo 'selected';?> >Đi gặp</option>
              <option value="online_meeting" <?php if(!empty($_GET['action_now']) && $_GET['action_now']=='online_meeting') echo 'selected';?> >Họp online</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="new" <?php if(!empty($_GET['status']) && $_GET['status']=='new') echo 'selected';?> >Chưa xử lý</option>
              <option value="done" <?php if(!empty($_GET['status']) && $_GET['status']=='done') echo 'selected';?> >Đã hoàn thành</option>
            </select>
          </div>
          
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">
      <a href="/listCustomerHistoriesAgency" class="btn btn-danger">Xem dạng danh sách</a>
    </h5>
    
    <div class="card-body row">
      <div class="col-md-12 mb-3">
        <span class="statistic"><label id="staticStatus0" class="number" style="background-color: Gold; padding: 0 7px; color: white;">0</label> Chưa xử lý</span>
        <span class="statistic"><label id="staticStatus1" class="number" style="background-color: Blue; padding: 0 7px; color: white;">0</label> Đã hoàn thành</span>
     
      </div>
      <div id='calendar'></div>
    </div>
  </div>
  <!--/ Responsive Table -->

 <!-- createBookModal -->
  <div class="modal fade" id="createBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <form class="no-margin" action="/addBook" method="POST">
         <input type="hidden" name="_csrfToken" id="csrfToken" value="<?php echo $csrfToken;?>">
         <div class="modal-body">
          <label><b>Thông tin khách đặt</b>  <a href="javascript:void(0);" onclick="showAddCustom();" title="Thêm khách hàng mới" class="btn btn-primary"><i class="bx bx-plus"></i></a></label>
          <div class="row">
            <div id="messAddBook"></div>
            <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên khách hàng (*) </label>
                    <input type="text" required class="form-control" name="customer_buy" id="customer_buy" value="" />
                    <input required type="hidden" class="form-control phone-mask" name="id_customer" id="id_customer" value="" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Hành động chăm sóc (*)</label>
                    <div class="input-group input-group-merge">
                      <select required class="form-select" name="action_now" id="action_now">
                        <option value="">Chọn hành động</option>
                        <option value="call">Gọi điện</option>
                        <option value="message">Nhắn tin</option>
                        <option value="go_meet">Đi gặp</option>
                        <option value="online_meeting" >Họp online</option>
                      </select>
                    </div>
                  </div>
                  
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Thời gian chăm sóc (*)</label>
                    <input type="text" required class="form-control phone-mask datetimepicker" name="time" id="time" value="" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="new">Chưa thực hiện</option>
                        <option value="done">Đã hoàn thành</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Nội dung chăm sóc (*)</label>
                    <textarea required class="form-control phone-mask" name="note_now" id="note_now" ></textarea>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="createBooking();" class="btn btn-primary" data-action="create"><i class="bx bx-save"></i> Tạo hẹn</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- addCustomer -->
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
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale-all.min.js'></script>

<script>
    var staticStatus0 = 0;
    var staticStatus1 = 0;
    // var staticStatus2 = 0;
    // var staticStatus3 = 0;
    // var staticStatus4 = 0;

    var listEvent = [];
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'vi',
      headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },

      events: [
        <?php
          $staticStatus0 = 0;
          $staticStatus1 = 0;
          $staticStatus2 = 0;
          $staticStatus3 = 0;
          $staticStatus4 = 0;

          if(!empty($listData)){
            foreach($listData as $data){
             

             $action_now = '';

             switch ($data->action_now) {
              case 'call':
                $action_now = 'Gọi điện';
                break;

              case 'message':
                $action_now = 'Nhắn tin';
                break;

              case 'go_meet':
                $action_now = 'Đi gặp';
                break;

              case 'online_meeting':
                $action_now = 'Họp online';
                break;

              case 'create':
                $action_now = 'Tạo mới';
                break;
             }

              $status = '';
              $color = '';
              $statusnote = 0;
              switch ($data->status) {
                case 'new':
                  $status = 'Chưa xử lý';
                  $statusnote = 'new';
                  $color = 'Gold';
                  $staticStatus0 ++;
                  break;
                
                case 'done':
                  $status = 'Đã xử lý';
                  $statusnote = 'done';
                  $color = 'Blue';
                  $staticStatus1 ++;
                  break;

                /*case '2':
                  $status = 'Tù trối';
                  $statusnote = 2;
                  $color = 'Red';
                  $staticStatus2 ++;
                  break;*/
              }

              $apt_times = -1;
              do{
                $apt_times ++;
                $time = $data->time_now + $apt_times*$data->apt_step*24*60*60;
                $id = $data->id;
                if($apt_times>0) $id .= '-'.$apt_times;

                echo '{
                    id: "'.$id.'",
                    idBook: "'.$data->id.'",
                    title: "'.date("H:i", $time).' '.$data->info_customer->full_name.'",
                    name: "'.$data->info_customer->full_name.'",
                    phone: "'.$data->info_customer->phone.'",
                    email: "'.$data->info_customer->email.'",
                    time: "'.date("d/m/Y H:i", $time).'",
                    start: "'.date('Y-m-d', $time).'",
                    end: "'.date('Y-m-d', $time).'",
                    id_parent: "'.$data->id_staff_now.'",
                    status: "'.$status.'",
                    statusnote: "'.$statusnote.'",
                    note: "'.$data->note_now.'",
                    action_now: "'.$action_now.'",
                    action: "'.$data->action_now.'",
                    color: "'.$color.'",
                  },';
              } while (!empty($data->repeat_book) && $data->apt_times>=$apt_times);
            }
          }
        ?>
      ],

      selectable: true,
      select: function(selectionInfo) {
        let now = new Date();
        let time = selectionInfo.startStr.split("-");

        $('#name').val('');
        $('#id_customer').val(0);
        $('#status').val(0);
        $('#phone').val('');
        $('#email').val('');
        $('#time').val(now.getHours()+":"+now.getMinutes()+" "+time[2]+"/"+time[1]+"/"+time[0]);
        $('#id_parent').val('');
        $('#note').val('');
        $('#apt_step').val('');
        $('#apt_times').val('');

        $("#repeat_book").prop( "checked", false );

        repeatBook();

        $('#createBookModal').modal('show');
      },

      eventClick: function(info) {
        // console.log(info.event.extendedProps.statusnote);
        listEvent = calendar.getEvents();

        //display a modal
        var modal = 
        '<div class="modal fade" id="modalinfo">\
          <div class="modal-dialog modal-lg">\
           <div class="modal-content">\
           <form class="no-margin">\
           <div class="modal-body">\
              <label><b>Thông tin khách đặt</b></label>\
              <table class="table table-bordered">\
                <tbody>\
                  <tr>\
                    <th>Khách hàng</th>\
                    <td>' + info.event.extendedProps.name + '</td>\
                    <th>Điện thoại</th>\
                    <td>' + info.event.extendedProps.phone + '</td>\
                  </tr>\
                  <tr>\
                    <th>Email</th>\
                    <td>' + info.event.extendedProps.email + '</td>\
                    <th>Thời gian đặt</th>\
                    <td>' + info.event.extendedProps.time + '</td>\
                  </tr>\
                  <tr>\
                    <th>Trạng thái</th>\
                    <td>' + info.event.extendedProps.status + '</td>\
                    <th>Ghi chú</th>\
                    <td>' + info.event.extendedProps.note + '</td>\
                  </tr>\
                  <tr>\
                    <th>Hành động chăm sóc</th>\
                    <td>' + info.event.extendedProps.action_now + '</td>\
                    <th></th>\
                    <td></td>\
                  </tr>\
                </tbody>\
              </table>\
           </div>\
           <div class="modal-footer">';
           if(info.event.extendedProps.statusnote=="new"){
             modal += '<a href="/treatmentCustomerHistoriesAgency/?id='+info.event.extendedProps.idBook+'" class="btn btn-primary">Xử lý</a>';
           }
           


           modal +=  '</div>\
          </form>\
          </div>\
         </div>\
        </div>';
      
      
        var modal = $(modal).appendTo('body');

        modal.find('button[data-action=delete]').on('click', function() {
          var check= confirm('Bạn có chắc chắn muốn xóa lịch hẹn này không?');
          
          if(check){
            $.ajax({
              method: "GET",
              url: "/deleteBook/?id="+info.event.extendedProps.idBook,
              data: {}
            })
            .done(function( msg ) {
              if(listEvent.length > 0){
                for (var i = 0; i < listEvent.length; i++) {
                  if(listEvent[i]._def.extendedProps.idBook == info.event.extendedProps.idBook){
                    calendar.getEventById(listEvent[i]._def.publicId).remove();
                  }
                }
              }
                
              modal.modal("hide");
            });
          }
          
        });
        
        modal.modal('show').on('hidden', function(){
          modal.remove();
        });

      }
    });

    calendar.render();

    staticStatus0 = "<?php echo number_format($staticStatus0);?>";
    staticStatus1 = "<?php echo number_format($staticStatus1);?>";
    // staticStatus2 = "<?php echo number_format($staticStatus2);?>";
    // staticStatus3 = "<?php echo number_format($staticStatus3);?>";
    // staticStatus4 = "<?php echo number_format($staticStatus4);?>";

    $('#staticStatus0').html(staticStatus0);
    $('#staticStatus1').html(staticStatus1);
    // $('#staticStatus2').html(staticStatus2);
    // $('#staticStatus3').html(staticStatus3);
    // $('#staticStatus4').html(staticStatus4);
</script>

<script type="text/javascript">
  function checkin(id, id_parent){

     $('#idStaff').val(id_parent);
     $('#id_book').val(id);

    //document.getElementById("createBookModal").style.display = 'none';
    $('#modalinfo').remove();
    $('.modal-backdrop').remove();
    $('#checkinbet').modal('show');
  }

  

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
               
                $('#name').val(ui.item.full_name);
                $('#id_customer').val(ui.item.id);
                $('#phone').val(ui.item.phone);
                $('#email').val(ui.item.email);
          
                return false;
            }
        });
    });
</script>

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

<style type="text/css">
.ui-autocomplete{
  z-index: 9999 !important;
}
</style>
<script type="text/javascript">
  $(function() {
       function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $( "#name_customer" )
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
                
                $( "#name_customer" ).val(ui.item.full_name);
                $( "#idcustomer" ).val(ui.item.id);

                return false;
            }
        });
      });
</script>

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

<script type="">
   function createBooking()
  {
    var csrfToken= $('#csrfToken').val();
    var id_customer= $('#id_customer').val();
    var customer_buy= $('#customer_buy').val();
    var action_now= $('#action_now').val();
    var time_now= $('#time').val();
    var status= $('#status').val();
    var note_now= $('#note_now').val();

    if(id_customer != 0 && note_now != '' && time_now != '' && status != ''){
      $.ajax({
        method: "POST",
        url: "/apis/addCustomerHistoriesAjax",
        data: {_csrfToken:csrfToken,
                  id_customer:id_customer,
                  action_now:action_now,
                  time_now:time_now,
                  status:status,
                  note_now:note_now,
              }
      })
      .done(function( msg ) {
        console.log(msg);
        if(msg.code == 1){
          /*let startDate = time_book.split(" ");
          let startTime = startDate[1];

          if(status=='new'){
            statusnote = 'Chưa sử lý';
            color = 'Gold';
          }else{
            statusnote = 'Đã sử lý';
            color ='Blue';
          }

            actionnow = '';

             switch (action_now) {
              case 'call':
                actionnow = 'Gọi điện';
                break;

              case 'message':
                actionnow = 'Nhắn tin';
                break;

              case 'go_meet':
                actionnow = 'Đi gặp';
                break;

              case 'online_meeting':
                actionnow = 'Họp online';
                break;

              case 'create':
                actionnow = 'Tạo mới';
                break;
                default:
                 console.log('Unknown day');
             }
          

          calendar.addEvent({
              id: msg.data.id,
              idBook: msg.data.id,
              title:  startTime+" "+customer_buy,
              name: customer_buy,
              phone: msg.customer.phone,
              email: msg.customer.email,
              time: time_now,
              start: startDate[2]+"-"+startDate[1]+"-"+startDate[0],
              end: startDate[2]+"-"+startDate[1]+"-"+startDate[0],
              id_parent: msg.data.id_staff_now,
              status: statusnote,
              statusnote: status,
              note: note_now,
              action_now: actionnow,
              action: msg.data.action_now,
              color: color,
          });

          $('#createBookModal').modal('hide');*/
          location.reload();
        }else{
          $('#messAddBook').html(msg.mess);
        }
      });
    }else{
      $('#messAddBook').html('<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>');
    }
  }
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<?php include(__DIR__.'/../footer.php'); ?>

