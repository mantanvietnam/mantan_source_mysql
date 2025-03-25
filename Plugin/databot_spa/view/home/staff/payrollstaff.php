  <?php include(__DIR__.'/../header.php');
  $url = '';

  if(!empty($_GET['month'])){
     $url .= '&month='.$_GET['month'];
  }
  if(!empty($_GET['year'])){
     $url .= '&year='.$_GET['year'];
  }
  if(!empty($_GET['id_staff'])){
     $url .= '&id_staff='.$_GET['id_staff'];
  }

   ?>

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
        <form id="summary-form" action="addPayroll" method="get" class="form-horizontal">
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
              <input type="text" class="form-control" name="total_day" id="total_day" onchange="tinhluong();" value="<?php echo $day; ?>">
            </div>
           <!--  <div class="mb-3 col-md-6">
              <label class="form-label">tiền tạm ứng: </label>
             
            </div> -->
            <div class="mb-3 col-md-6">
              <label class="form-label">Lương thanh toán: </label> <span id="total" class="text-danger"><?php echo number_format((int)$salary); ?>đ</span>
              <input type="hidden" class="form-control" name="salary" id="salary" value="<?php echo (int)$salary; ?>">
              <input type="hidden" class="form-control" name="thang" id="thang" value="<?php echo (int)$thang; ?>">
              <input type="hidden" class="form-control" name="nam" id="nam" value="<?php echo (int)$nam; ?>">
              <input type="hidden" class="form-control" name="id_staff" id="id_staff" value="<?php echo (int)$dataStaff->id; ?>">
            </div>
             <div class="mb-3 col-md-6"></div>
             <div class="mb-3 col-md-6">
               
            <button type="submit" class="btn btn-primary d-block">Chấm công</button>
             </div>

            <div class="mb-3 col-md-12">
             <label class="form-label">  <b>Lương = ((lương cứng / công )* ngày công) + (hoa hồng  + tiền thưởng  + phục cấp) – (tiền phạt + Bảo hiểm)</b></label>
            </div>
          </div>
        </form>
      </div>
        <div class="tab-pane fade" id="navs-top-bonus" role="tabpanel">
          <div class="table-responsive">

            <h5 class="card-header">Tổng tiền thưởng là <?php echo number_format($bonus); ?> đ</h5>
            <a href="/addStaffBonus?<?php echo $url; ?>" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a>
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

      },

     
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
