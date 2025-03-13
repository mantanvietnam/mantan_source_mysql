  <?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
<style type="text/css">
  .sticky {
            position: -webkit-sticky;
            position: sticky;
            left: 0;
            background-color: #ecfbf7 !important;
            z-index: 2;
            border-color: inherit;
            border-style: solid;
        }
     
</style>
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listStaff">Nhân viên</a> /</span>
    Bảng chấm công nhân viên
  </h4>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="mb-3 col-md-4">
            <label class="form-label" for="basic-default-phone">Tháng</label>
            <select name="month" class="form-select color-dropdown">
              <option value="0">Tháng</option>
              <?php
              for ($i=1; $i <= 12 ; $i++) { 
                if($thang==$i){
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                }else{
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
              ?>
            </select>
          </div>

          <div class="mb-3 col-md-4">
            <label class="form-label" for="basic-default-phone">năm</label>
            <select name="year" class="form-select color-dropdown">
              <option value="0">Năm</option>
              <?php
              for ($i = date("Y"); $i >= 2020; $i--) { 
                if($nam==$i){
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                }else{
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
              ?>
            </select>
            <input type="hidden" name="id_staff" value="<?php echo $dataStaff->id; ?>">   
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
  <div class="card row">
    <h5 class="card-header">Bảng tính lương nhân viên <?php echo $dataStaff->name ?> tháng <?php echo @$thang.'/'.$nam ?></h5>
    <?php echo @$mess;
  //  debug($dataStaff);
    ?>
     
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-working" aria-controls="navs-top-info" aria-selected="false">
          Bảng công 
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-bonus" aria-controls="navs-top-info" aria-selected="false">
          Tiền thưởng
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-punish" aria-controls="navs-top-info" aria-selected="false">
          Tiền phạt
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-commission" aria-controls="navs-top-info" aria-selected="false">
          Hoa hồng 
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
          Tính lương
        </button>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade " id="navs-top-home" role="tabpanel">
        <form id="summary-form" action="" method="post" class="form-horizontal">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">Ngày làm việc: </label>: <?php echo $working_day; ?>
              <input type="hidden" class="form-control" name="working_day" id="working_day" value="<?php echo $working_day; ?>">
            </div>
           
            <div class="mb-3 col-md-6">
              <label class="form-label">lương cứng: </label> <?php echo number_format($dataStaff->fixed_salary); ?>đ
              <input type="hidden" class="form-control" name="fixed_salary" id="fixed_salary" value="<?php echo $dataStaff->fixed_salary; ?>">
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Hoa hồng: </label> <?php echo number_format($commission) ?>đ
              <input type="hidden" class="form-control" name="commission" id="commission" value="<?php echo $commission ?>">
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Tiền thưởng: </label> <?php echo number_format($bonus) ?>đ
              <input type="hidden" class="form-control" name="bonus" id="bonus" value="<?php echo $bonus ?>">
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">tiền phụp cấp: </label> <?php echo number_format($dataStaff->allowance); ?>đ
              <input type="hidden" class="form-control" name="allowance" id="allowance" value="<?php echo $dataStaff->allowance; ?>">
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">tiền phạt: </label> <?php echo number_format($punish) ?>đ
              <input type="hidden" class="form-control" name="punish" id="punish" value="<?php echo $punish ?>">
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">tiền Bảo hiểm: </label> <?php echo number_format($dataStaff->insurance); ?>đ
              <input type="hidden" class="form-control" name="insurance" id="insurance" value="<?php echo $dataStaff->insurance; ?>">
               <input type="hidden" class="form-control" name="advance" id="advance" value="0">
            </div>
             <div class="mb-3 col-md-6">
              <label class="form-label">Tổng ngày </label>
              <input type="text" class="form-control" name="total_day" id="total_day" onchange="tinhluong();" value="">
            </div>
           <!--  <div class="mb-3 col-md-6">
              <label class="form-label">tiền tạm ứng: </label>
             
            </div> -->
            <div class="mb-3 col-md-6">
              <label class="form-label">Lương thanh toán: </label> <span id="total"></span>
              <input type="hidden" class="form-control" name="salary" id="salary" value="0">
            </div>
          </div>
        </form>
      </div>
        <div class="tab-pane fade" id="navs-top-bonus" role="tabpanel">
          <div class="table-responsive">
            <h5 class="card-header">Tổng tiền thưởng là <?php echo number_format($bonus); ?> đ</h5>
            <table class="table table-bordered">
              <thead>
                <tr class="">
                  <th>ID</th>
                  <th>Thời gian</th>
                  <th>Nhân viên</th>
                  <th>Số tiền <?php echo @$type ?></th>
                  <th>Nội dung</th>
                  <th>Trạng thái</th>
                  <th>Sửa</th>
                  <!-- <th>in</th> -->
                </tr>
              </thead>
              <tbody>
                <?php 
                  if(!empty($listDatabonus)){
                    foreach ($listDatabonus as $item) {
                       

                       if($item->status=='new'){
                          $status = '<p class="text-danger">chưa thanh toán</p>';
                       }else{
                          $status = '<p class="text-success">Đã thanh toán</p>';
                       }


                      echo '<tr>
                              <td>'.$item->id.'</td>
                              <td>'.date('H:i d/m/Y', $item->time).'</td>
                              <td>'.$item->infoStaff->name.'</td>
                              <td>'.number_format($item->total).'đ</td>
                              <td>'.$item->note.'</td>
                              <td>'.$status.'</td>
                              <td align="center">
                                <a class="dropdown-item" href="/addStaff'.@$slug.'/?id='.$item->id.'">
                                  <i class="bx bx-edit-alt me-1"></i>
                                </a>
                              </td>
                              
                            </tr>';
                    }
                  }else{
                    echo '<tr>
                            <td colspan="10" align="center">Chưa có phiếu chi nào</td>
                          </tr>';
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-punish" role="tabpanel">
          <div class="table-responsive">
            <h5 class="card-header">Tổng tiền phạt là <?php echo number_format($punish); ?> đ</h5>
            <table class="table table-bordered">
              <thead>
                <tr class="">
                  <th>ID</th>
                  <th>Thời gian</th>
                  <th>Nhân viên</th>
                  <th>Số tiền <?php echo @$type ?></th>
                  <th>Nội dung</th>
                  <th>Trạng thái</th>
                  <th>Sửa</th>
                  <!-- <th>in</th> -->
                </tr>
              </thead>
              <tbody>
                <?php 
                  if(!empty($listDatapunish)){
                    foreach ($listDatapunish as $item) {
                       

                       if($item->status=='new'){
                          $status = '<p class="text-danger">chưa thanh toán</p>';
                       }else{
                          $status = '<p class="text-success">Đã thanh toán</p>';
                       }


                      echo '<tr>
                              <td>'.$item->id.'</td>
                              <td>'.date('H:i d/m/Y', $item->time).'</td>
                              <td>'.$item->infoStaff->name.'</td>
                              <td>'.number_format($item->total).'đ</td>
                              <td>'.$item->note.'</td>
                              <td>'.$status.'</td>
                              <td align="center">
                                <a class="dropdown-item" href="/addStaff'.@$slug.'/?id='.$item->id.'">
                                  <i class="bx bx-edit-alt me-1"></i>
                                </a>
                              </td>
                              
                            </tr>';
                    }
                  }else{
                    echo '<tr>
                            <td colspan="10" align="center">Chưa có phiếu chi nào</td>
                          </tr>';
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-top-commission" role="tabpanel">
             <div class="table-responsive">
              <h5 class="card-header">Tổng tiền hoa hồng  là <?php echo number_format($commission); ?> đ</h5>
              <table class="table table-bordered">
                <thead>
                  <tr class="" align="center">
                    <th>ID</th>
                    <th>nhân viên</th>
                    <th>thông tin khách hàng</th>
                    <th>Thời gian</th>
                    <th>Hoa hồng</th>
                    <th>Dịch vụ </th>
                    <th>ID đơn</th>
                    <th>Loại</th>
                    <th>Trạnh thái</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  if(!empty($listDatacommission)){
                    foreach ($listDatacommission as $item) {
                      $status = '<span class="text-success">Đã thanh toán</span>';
                      if($item->status ==0){
                        $status = '<span class="text-danger">Chưa thanh toán</span>

                        <a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">
                        <i class="bx bxs-credit-card"></i>
                        </a>';
                      }

                      echo '<tr>
                      <td>'.$item->id.'</td>

                      <td>'.$item->infoStaff->name.'</td>
                      <td>'.@$item->order->customer->name.'<br/>
                      '.@$item->order->customer->phone.'
                      </td>
                      <td>'.date('H:i d/m/Y', @$item->created_at).'</td>
                      <td>'.number_format($item->money).'đ</td>
                      <td>'.@$item->service.'</td>
                      <td>'.@$item->id_order.'</td>
                      <td>'.@$item->type.'</td>
                      <td>'.$status.'</td>
                      </tr>';
                    }
                  }else{
                    echo '<tr>
                    <td colspan="10" align="center">Chưa có khách hàng</td>
                    </tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
        </div>
        <div class="tab-pane fade active show" id="navs-top-working" role="tabpanel">
          <div class="card-body row">
           <h5 class="card-header">Tổng công trong tháng là <?php echo $working_day; ?> công</h5>
          <div id='calendar'></div>
        </div>
        </div>
    </div>

  <!-- Phân trang -->
  <div class="demo-inline-spacing">
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
       
      </ul>
    </nav>
  </div>
  <!--/ Basic Pagination -->
</div>
<!--/ Responsive Table -->
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale-all.min.js'></script>
<script type="text/javascript">
  function tinhluong(){
    var working_day = parseFloat($('#working_day').val());
    var total_day = parseFloat($('#total_day').val());
    var fixed_salary = parseFloat($('#fixed_salary').val());
    var commission = parseFloat($('#commission').val());
    var bonus = parseFloat($('#bonus').val());
    var allowance = parseFloat($('#allowance').val());
    var punish = parseFloat($('#punish').val());
    var insurance = parseFloat($('#insurance').val());
    var advance = parseFloat($('#advance').val());

    var salary = 0;

    salary = ((fixed_salary/total_day)* working_day)+ (commission + bonus + allowance) -(advance + insurance + punish);

   console.log(working_day);
    console.log(total_day);
    console.log(fixed_salary);
    console.log(commission);
    console.log(bonus);
    console.log(allowance);
    console.log(punish);
    console.log(insurance);
    console.log(advance);
    console.log(salary);

    let intNum = Math.floor(salary); // Kết quả: 41153

    $('#salary').val(intNum);
      var showPay= new Intl.NumberFormat().format(intNum);
    $('#total').html(showPay+'đ');

  }
</script>

<script>
   
    var listEvent = [];
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      initialDate: formatDate( <?php echo @$nam.','.$thang .',1'; ?>), 
      locale: 'vi',
      headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },

     events: [
        <?php
          if(!empty($listStaffTimekeeper)){
            foreach($listStaffTimekeeper as $data){
             
              $status = '';
              $color = '';
              $statusnote = 0;

              $apt_times = -1;
              do{
                $apt_times ++;
                $time_book = $data->time_book + $apt_times*$data->apt_step*24*60*60;
                $id = $data->id;
                if($apt_times>0) $id .= '-'.$apt_times;

                echo '{
                    id: "'.$id.'",
                    id_member: "'.$data->id_member.'",
                    title: "'.$data->shift.'",
                    time_book: "'.date("H:i d/m/Y", $data->check_in).'",
                    time_chekin: "'.$data->check_in.'",
                    time_book: "'.date("H:i d/m/Y", $data->check_in).'",
                    time_chekin: "'.$data->check_in.'",
                    start: "'.date('Y-m-d', $data->check_in).'",
                    end: "'.date('Y-m-d', $data->check_in).'",
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
        $('#time_book').val(time_book[2]+"/"+time_book[1]+"/"+time_book[0]+" "+now.getHours()+":"+now.getMinutes());
        

        repeatBook();

        //$('#createBookModal').modal('show');
      },

     /* eventClick: function(info) {
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
             modal += '<button type="button" class="btn btn-primary" onclick="checkin('+info.event.extendedProps.idBook+','+id_staff+','+id_bed+','+info.event.extendedProps.time_chekin+');"><i class="bx bxs-edit"></i> Check in</button>\
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

      }*/
    });

    calendar.render();


    function formatDate(year, month, day) {
    let mm = month < 10 ? '0' + month : month; 
    let dd = day < 10 ? '0' + day : day; 
    return `${year}-${mm}-${dd}`;
}

</script>

<?php include(__DIR__.'/../footer.php'); ?>

ương = ((lương cứng / công )* ngày công) + (hoa hồng  + tiền thưởng  + phục cấp)   –  (tiền phạt + Bảo hiểm + tạm ứng)
