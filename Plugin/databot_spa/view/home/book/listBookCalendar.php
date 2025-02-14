<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Đặt lịch hẹn</h4>
  <p><a href="/addBook" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <label class="form-label">Họ tên</label>
            <input type="text" class="form-control" name="full_name" value="<?php if(!empty($_GET['full_name'])) echo $_GET['full_name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>
          
          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0') echo 'selected';?> >Chưa xác nhận </option>
              <option value="1" <?php if(!empty($_GET['status']) && $_GET['status']=='1') echo 'selected';?> >Xác nhận</option>
              <option value="2" <?php if(!empty($_GET['status']) && $_GET['status']=='2') echo 'selected';?> >Không đến</option>
              <option value="3" <?php if(!empty($_GET['status']) && $_GET['status']=='3') echo 'selected';?> >Đã đến</option>
              <option value="4" <?php if(!empty($_GET['status']) && $_GET['status']=='4') echo 'selected';?> >Hủy lịch</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Kiểu đặt</label>
            <select name="type" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="type1" <?php if(isset($_GET['type']) && $_GET['type']=='type1') echo 'selected';?> >Lịch tư vấn </option>
              <option value="type2" <?php if(isset($_GET['type']) && $_GET['type']=='type2') echo 'selected';?> >Lịch chăm sóc </option>
              <option value="type3" <?php if(isset($_GET['type']) && $_GET['type']=='type3') echo 'selected';?> >Lịch liệu trình </option>
              <option value="type4" <?php if(isset($_GET['type']) && $_GET['type']=='type4') echo 'selected';?> >Lịch điều trị </option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">NV chăm sóc</label>
            <select name="id_staff" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php 
              if(!empty($listStaffs)){
                foreach ($listStaffs as $key => $value) {
                  if(empty($_GET['id_staff']) || $_GET['id_staff']!=$value->id){
                    echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                  }else{
                    echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                  }
                }
              }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Dịch vụ</label>
            <select name="id_service" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php 
              if(!empty($listService)){
                foreach ($listService as $key => $value) {
                  if(empty($_GET['id_service']) || $_GET['id_service']!=$value->id){
                    echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                  }else{
                    echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                  }
                }
              }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Đặt từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Đến ngày</label>
            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
          </div>

          

          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">
      <a href="/listBook" class="btn btn-danger">Xem dạng danh sách</a>
    </h5>
    
    <div class="card-body row">
      <div class="col-md-12 mb-3">
        <span class="statistic"><label id="staticStatus0" class="number" style="background-color: Gold; padding: 0 7px; color: white;">0</label> Chưa xác nhận</span>
        <span class="statistic"><label id="staticStatus1" class="number" style="background-color: Blue; padding: 0 7px; color: white;">0</label> Xác nhận</span>
        <span class="statistic"><label id="staticStatus2" class="number" style="background-color: Red; padding: 0 7px; color: white;">0</label> Không đến</span>
        <span class="statistic"><label id="staticStatus3" class="number" style="background-color: Green; padding: 0 7px; color: white;">0</label> Đã đến</span>
        <span class="statistic"><label id="staticStatus4" class="number" style="background-color: Black; padding: 0 7px; color: white;">0</label> Hủy lịch</span>
      </div>
      <div id='calendar'></div>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>

<div class="modal fade" id="createBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
   <div class="modal-content">
   <form class="no-margin" action="/addBook" method="POST">
   <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
   <div class="modal-body">
      <label><b>Thông tin khách đặt</b></label>
      <div class="row">
        <div class="col-md-5 mb-3">
          <label class="form-label">Tên khách hàng (*)</label>
          <input required type="text" placeholder="Vui lòng nhập tên hoặc sđt khách hàng" class="form-control phone-mask" name="name" id="name" value="" >
          <input type="hidden" name="id_customer" id="id_customer" value="">
          <input type="hidden" name="phone" id="phone" value="" />
          <input type="hidden" name="email" id="email" value="" />
        </div>
        <div class="mb-3 col-md-1">
            <label class="form-label" for="basic-default-phone">&nbsp;</label>
            <a href="javascript:void(0);" onclick="showAddCustom();" title="Thêm khách hàng mới" class="btn btn-primary"><i class='bx bx-plus'></i></a>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Ngày đặt (*)</label>
          <input type="text" name="time_book" class="form-control hasDatepicker datetimepicker" id="time_book" value="">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Nhân viên phụ trách</label>
          <select class="form-select" name="id_staff" id="id_staff">
            <option value="">Chọn nhân viên</option>
            <?php 
            if(!empty($listStaffs)){
              foreach ($listStaffs as $staff) {
                echo "<option value='".$staff->id."'>".$staff->name."</option>";
              }
            }
            ?>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Dịch vụ (*)</label>
          <select class="form-select" name="id_service" id="id_service" required>
            <option value="">Chọn dịch vụ</option>
            <?php 
            if(!empty($CategoryService)){
               foreach ($CategoryService as $cService) { 
                echo '<optgroup label="'.$cService->name.'">';
                if(!empty($cService->service)){
                  foreach($cService->service as $service){
                  /*  if($idService==$service->id){
                      $select= 'selected';
                                                                        //$unit= $product['unit'];
                    }else{
                      $select= '';
                    }*/
                    echo '<option data-unit="'.@$service->id.'" '.$select.' value="'.$service->id.'">'.$service->name.'</option>';
                  }
                }
                echo '</optgroup>';
              }
            }
            ?>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Trạng thái</label>
          <select name="status" id="status" class="form-select">
            <option value="0">Chưa xác nhận</option>
            <option value="1">Xác nhận</option>
            <option value="2">Không đến</option>
            <option value="3">Đã đến</option>
            <option value="4">Hủy lịch</option>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Giường & phòng</label>
          <select name="id_bed" id="id_bed" class="form-select">
            <option value="">Chọn giường</option>
            <?php 
            if(!empty($listRoom)){
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
              }
            }
            ?>
          </select>
        </div>

        <div class="mb-3 col-md-1">
            <label class="form-label">Lặp</label>
            <div class="form-check form-switch mb-2">
              <input onclick="repeatBook();" class="form-check-input" type="checkbox" id="repeat_book" name="repeat_book" value="1" style="width: 40px;height: 20px;">
            </div>
        </div>

        <div class="mb-3 col-md-2">
            <label class="form-label">Cách ngày</label>
            <input disabled type="number" class="form-control" placeholder="" name="apt_step" id="apt_step" value="" required />
        </div>
        
        <div class="mb-3 col-md-3">
            <label class="form-label">Tổng số lần</label>
            <input disabled type="number" class="form-control" placeholder="" name="apt_times" id="apt_times" value="" required />
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Kiểu đặt</label>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="i-checks i-checks-sm">
                  <input type="checkbox" name="type1" id="type1" class="staffcheck" value="1">
                  <span>Lịch tư vấn</span>
              </label>
            </div>
            <div class="col-md-6 mb-3">
              <label class="i-checks i-checks-sm">
                  <input type="checkbox" name="type2" id="type2" class="staffcheck" value="1">
                  <span>Lịch chăm sóc</span>
              </label>
            </div>
            <div class="col-md-6 mb-3">
              <label class="i-checks i-checks-sm">
                  <input type="checkbox" name="type3" id="type3" class="staffcheck" value="1">
                  <span>Lịch liệu trình</span>
              </label>
            </div>
            <div class="col-md-6 mb-3">
              <label class="i-checks i-checks-sm">
                  <input type="checkbox" name="type4" id="type4" class="staffcheck"  value="1">
                  <span>Lịch điều trị</span>
              </label> 
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-3">
          <label class="form-label">Thông tin chung</label>
          <textarea class="form-control" rows="3" name="note" id="note"></textarea>
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

<div class="modal fade" id="checkinbet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
   <div class="modal-content">
   <form class="no-margin" action="/checkinbetBook" method="POST">
   <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
   <div class="modal-body">
      <label><b>Thông tin check in</b></label>
      <div class="row">
        <div class="col-md-5 mb-3">
          <input type="hidden" name="id_book"  id="id_book" value="">
          <label class="form-label">Nhân viên phụ trách</label>
          <select class="form-select" required="" name="idStaff" id="idStaff">
            <option value="">Chọn nhân viên</option>
            <?php 

            if(!empty($listStaffs)){
              foreach ($listStaffs as $staff) {
                echo "<option value='".$staff->id."'  >".$staff->name."</option>";
              }
            }
            ?>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Giường & phòng</label>
          <select name="id_bed" id="idbed" required="" class="form-select">
            <option value="">Chọn giường</option>
            <?php 
            if(!empty($listRoom)){
              foreach ($listRoom as $room) { 
                  echo '<optgroup label="'.$room->name.'">';
                  if(!empty($room->bed)){
                      foreach($room->bed as $bed){
                          $selected = "";
                         if(!empty($data->id_bed) && $data->id_bed==$bed->id){
                              $selected = 'selected';
                         }
                                         
                          echo '<option data-unit="'.@$bed->id.'"  value="'.@$bed->id.'" '.$selected.'>'.@$bed->name.'</option>';
                     }
                  }
                  echo '</optgroup>';
              }
            }
            ?>
          </select>
        </div>
      </div>
   </div>
   <div class="modal-footer">
    <button type="submit" class="btn btn-primary" data-action="create"><i class="bx bx-save"></i> Check in</button>
   </div>
  </form>
  </div>
 </div>
</div>



<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale-all.min.js'></script>


<div id="addCustomer"  class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm thông tin khách hàng mới</h4>
                
            </div>
            <div class="data-content card-body">
                <div id="messAddCustom"></div>
                <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-phone">Họ tên (*)</label>
                        <input required type="text" class="form-control phone-mask" name="name" id="name" value="" />
                        <input  type="hidden" class="form-control phone-mask" name="name" id="id_member" value="<?php echo $user->id_member; ?>" />
                        <input  type="hidden" class="form-control phone-mask" name="name" id="id_spa" value="<?php echo $user->id_spa; ?>" />
                        <input  type="hidden" class="form-control phone-mask" name="name" id="id_staff" value="<?php echo $user->id_staff; ?>" />
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

<script>
    var staticStatus0 = 0;
    var staticStatus1 = 0;
    var staticStatus2 = 0;
    var staticStatus3 = 0;
    var staticStatus4 = 0;

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
              $type = [];
              if(!empty($data->type1)) $type[] = 'Lịch tư vấn';
              if(!empty($data->type2)) $type[] = 'Lịch chăm sóc';
              if(!empty($data->type3)) $type[] = 'Lịch liệu trình';
              if(!empty($data->type4)) $type[] = 'Lịch điều trị';

              $status = '';
              $color = '';
              $statusnote = 0;
              switch ($data->status) {
                case '0':
                  $status = 'Chưa xác nhận';
                  $statusnote = 0;
                  $color = 'Gold';
                  $staticStatus0 ++;
                  break;
                
                case '1':
                  $status = 'Xác nhận';
                  $statusnote = 1;
                  $color = 'Blue';
                  $staticStatus1 ++;
                  break;

                case '2':
                  $status = 'Không đến';
                  $statusnote = 2;
                  $color = 'Red';
                  $staticStatus2 ++;
                  break;

                case '3':
                  $status = 'Đã đến';
                  $statusnote = 3;
                  $color = 'Green';
                  $staticStatus3 ++;
                  break;

                case '4':
                  $status = 'Hủy';
                  $statusnote = 4;
                  $color = 'Black';
                  $staticStatus4 ++;
                  break;
              }

              $apt_times = -1;
              do{
                $apt_times ++;
                $time_book = $data->time_book + $apt_times*$data->apt_step*24*60*60;
                $id = $data->id;
                if($apt_times>0) $id .= '-'.$apt_times;

                echo '{
                    id: "'.$id.'",
                    idBook: "'.$data->id.'",
                    title: "'.date("H:i", $time_book).' '.$data->Services['name'].'",
                    name: "'.$data->name.'",
                    phone: "'.$data->phone.'",
                    email: "'.$data->email.'",
                    time_book: "'.date("d/m/Y H:i", $time_book).'",
                    start: "'.date('Y-m-d', $time_book).'",
                    end: "'.date('Y-m-d', $time_book).'",
                    service: "'.$data->Services['name'].'",
                    staff: "'.$data->Members['name'].'",
                    id_staff: "'.$data->Members['id'].'",
                    bed: "'.$data->Beds['name'].'",
                    id_bed: "'.$data->Beds['id'].'",
                    status: "'.$status.'",
                    statusnote: "'.$statusnote.'",
                    type: "'.implode(', ', $type).'",
                    note: "'.$data->note.'",
                    repeat_book: "'.$data->repeat_book.'",
                    apt_times: "'.$data->apt_times.'",
                    apt_step: "'.$data->apt_step.'",
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
        let time_book = selectionInfo.startStr.split("-");

        $('#name').val('');
        $('#id_customer').val(0);
        $('#status').val(0);
        $('#phone').val('');
        $('#email').val('');
        $('#time_book').val(time_book[2]+"/"+time_book[1]+"/"+time_book[0]+" "+now.getHours()+":"+now.getMinutes());
        $('#id_staff').val('');
        $('#id_service').val('');
        $('#note').val('');
        $('#id_bed').val('');
        $('#apt_step').val('');
        $('#apt_times').val('');

        $("#type1").prop( "checked", false );
        $("#type2").prop( "checked", false );
        $("#type3").prop( "checked", false );
        $("#type4").prop( "checked", false );
        $("#repeat_book").prop( "checked", false );

        repeatBook();

        $('#createBookModal').modal('show');
      },

      eventClick: function(info) {
        listEvent = calendar.getEvents();
        var id_staff = info.event.extendedProps.id_staff;
        var id_bed = info.event.extendedProps.id_bed;
        if(id_staff.length==0){
          id_staff = 0;
        }
          if(id_bed.length==0){
            id_bed = 0;
          }
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
                    <td>' + info.event.extendedProps.time_book + '</td>\
                  </tr>\
                  <tr>\
                    <th>Dịch vụ</th>\
                    <td>' + info.event.extendedProps.service + '</td>\
                    <th>NV phụ trách</th>\
                    <td>' + info.event.extendedProps.staff + '</td>\
                  </tr>\
                  <tr>\
                    <th>Xếp giường</th>\
                    <td>' + info.event.extendedProps.bed + '</td>\
                    <th>Kiểu đặt</th>\
                    <td>' + info.event.extendedProps.type + '</td>\
                  </tr>\
                  <tr>\
                    <th>Trạng thái</th>\
                    <td>' + info.event.extendedProps.status + '</td>\
                    <th>Ghi chú</th>\
                    <td>' + info.event.extendedProps.note + '</td>\
                  </tr>\
                </tbody>\
              </table>\
           </div>\
           <div class="modal-footer">';
           if(info.event.extendedProps.statusnote=="1"|| info.event.extendedProps.statusnote=='0'){
             modal += '<button type="button" class="btn btn-primary" onclick="checkin('+info.event.extendedProps.idBook+','+id_staff+','+id_bed+');"><i class="bx bxs-edit"></i> Check in</button>\
            <a href="/addBook/?id='+info.event.extendedProps.idBook+'" class="btn btn-primary"><i class="bx bxs-edit"></i> Sửa hẹn</a>\
            <button type="button" class="btn btn-danger" data-action="delete"><i class="bx bxs-trash"></i> Xóa hẹn</button>';
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
    staticStatus2 = "<?php echo number_format($staticStatus2);?>";
    staticStatus3 = "<?php echo number_format($staticStatus3);?>";
    staticStatus4 = "<?php echo number_format($staticStatus4);?>";

    $('#staticStatus0').html(staticStatus0);
    $('#staticStatus1').html(staticStatus1);
    $('#staticStatus2').html(staticStatus2);
    $('#staticStatus3').html(staticStatus3);
    $('#staticStatus4').html(staticStatus4);
</script>

<script type="text/javascript">
  function createBooking()
  {
    var csrfToken = "<?php echo $csrfToken;?>";
    var name = $('#name').val();
    var id_customer = $('#id_customer').val();
    var status = $('#status').val();
    var phone = $('#phone').val();
    var email = $('#email').val();
    var time_book = $('#time_book').val();
    var id_staff = $('#id_staff').val();
    var id_service = $('#id_service').val();
    var note = $('#note').val();
    var id_bed = $('#id_bed').val();
    var apt_step = $('#apt_step').val();
    var apt_times = $('#apt_times').val();

    var statustext;
    var statusnote;
    var color;

    if(status=='0'){
      statustext = 'Chưa xác nhận';
      statusnote = 0;
      color = 'Gold';
    }else if(status=='1'){
      statustext = 'Xác nhận';
      statusnote = 1;
      color = 'Blue';
    }else if(status=='2'){
      statustext = 'Không đến';
      statusnote = 2;
      color = 'Red';
    }else if(status=='3'){
      statustext = 'Đã đến';
      statusnote = 3;
      color = 'Green';
    }else if(status=='4'){
      statustext = 'Hủy';
      statusnote = 4;
      color = 'Black';
    }

          console.log(statustext);
    
    var type1 = 0;
    var type2 = 0;
    var type3 = 0;
    var type4 = 0;
    var repeat_book = 0;

    let type1Checked = $("#type1").is(":checked");
    let type2Checked = $("#type2").is(":checked");
    let type3Checked = $("#type3").is(":checked");
    let type4Checked = $("#type4").is(":checked");
    let repeat_book_checked = $("#repeat_book").is(":checked");

    if(type1Checked) type1 = 1;
    if(type2Checked) type2 = 1;
    if(type3Checked) type3 = 1;
    if(type4Checked) type4 = 1;
    if(repeat_book_checked) repeat_book = 1;

    if(name != '' && id_customer != 0 && id_service != '' && time_book != ''){
      $.ajax({
        method: "POST",
        url: "/apis/addBookAPI",
        data: {_csrfToken:csrfToken, name:name , id_customer:id_customer , status:status , phone:phone , email:email , time_book:time_book , id_staff:id_staff , id_service:id_service , note:note , id_bed:id_bed , apt_step:apt_step , apt_times:apt_times , type1:type1 , type2:type2 , type3:type3 , type4:type4 , repeat_book:repeat_book}
      })
      .done(function( msg ) {
        if(msg.code == 1){
          let startDate = time_book.split(" ");
          let startTime = startDate[1];
          startDate = startDate[0].split("/");
          let service = $( "#id_service option:selected" ).text();
          let staff = $( "#id_staff option:selected" ).text();
          let bed = $( "#id_bed option:selected" ).text();
          let typeBook = [];

          if(type1==1) typeBook.push('Lịch tư vấn');
          if(type2==1) typeBook.push('Lịch chăm sóc');
          if(type3==1) typeBook.push('Lịch liệu trình');
          if(type4==1) typeBook.push('Lịch điều trị');

          calendar.addEvent({
            id: msg.id,
            idBook: msg.id,
            title: startTime+" "+service,
            name: name,
            phone: phone,
            email: email,
            time_book: time_book,
            start: startDate[2]+"-"+startDate[1]+"-"+startDate[0],
            end: startDate[2]+"-"+startDate[1]+"-"+startDate[0],
            service: service,
            staff: staff,
            bed: bed,
            status: statustext,
            type: typeBook.join(', '),
            note: note,
            id_bed:id_bed,
            statusnote:statusnote,
            color:color
          });

          $('#createBookModal').modal('hide');
        }else{
          alert(msg.mess);
        }
      });
    }else{
      alert('Bạn không được để trống các trường bắt buộc');
    }
  }

  function checkin(id, id_staff, idbed){

     $('#idStaff').val(id_staff);
     $('#id_book').val(id);
     $('#idbed').val(idbed);

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
               
                $('#name').val(ui.item.name);
                $('#id_customer').val(ui.item.id);
                $('#phone').val(ui.item.phone);
                $('#email').val(ui.item.email);
          
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

    var name = $('#name').val();
    var id_member = $('#id_member').val();
    var phone = $('#phone').val();
    var id_spa = $('#id_spa').val();
    var email = $('#email').val();
    var address = $('#address').val();
    var id_staff = $('#id_staff').val();
    var sex = $('#sex').val();
    
    $.ajax({
          method: "POST",
          url: "/apis/addCustomerApi",
          data: { 
            name: name,
            id_member: id_member,
            phone: phone,
            id_spa: id_spa,
            email: email,
            address: address,
            id_staff: id_staff,
            sex:sex,
        }
    }).done(function( msg ) {
            console.log(msg);

            // var obj = jQuery.parseJSON(msg);
             // console.log(obj);
            if(msg.code==1){
                $('#id_customer').val(msg.data.id);
                $('#full_name').val(msg.data.name);
                $('#addCustomer').modal('hide');
            }else{
                console.log(msg.mess);
               $('#messAddCustom').html(msg.mess); 
            }
        }) 
          
}
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<?php include(__DIR__.'/../footer.php'); ?>