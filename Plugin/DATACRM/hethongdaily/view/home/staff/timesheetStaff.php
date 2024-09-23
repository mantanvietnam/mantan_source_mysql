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
                if(!empty($_GET['month']) && $_GET['month']==$i){
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
                if(!empty($_GET['year']) && $_GET['year']==$i){
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                }else{
                  echo '<option value="'.$i.'">'.$i.'</option>';
                }
              }
              ?>
            </select>
          </div>
                   
          <div class="col-md-2">
          <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          
          <div class="col-md-2">
          <label class="form-label">&nbsp;</label></br>
            <a class="btn btn-danger"  data-bs-toggle="modal" style="color: white;" data-bs-target="#basicModal" ><i class='bx bx-plus'></i> Chấm công</a>
          </div> 
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Bảng chấm công nhân viên tháng <?php echo @$thang.'/'.$nam ?></h5>
    <?php echo @$mess;?>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th class="sticky"  width="40%" colspan="3">Nhân viên</th>
              <?php foreach($date as $key => $item){
                echo ' <th align="center" class="" style="text-align: -webkit-center;">'.$key.'</br>'.$item['thu'].'</th>';

              } ?>
             
              
            </tr>
          </thead>
          <tbody>
             <?php 
            if(!empty($listStaff)){
              foreach ($listStaff as $item) {
                
                
                echo '<tr>
                <td class="sticky"  colspan="3">'.$item->name.'</td>';
                foreach($date as $key => $value){
                  $checkdate = checkStaffTimekeepers($value['ngay'],$item->id);
                 
                  if(!empty($checkdate)){
                    echo ' <td align="center ngaychamcong" style="background-color: #d7fada;">'.$checkdate->shift.  '</td>';
                  }else{
                    echo ' <td align="center"> </td>';
                  }

                  

                } 
                echo '</tr>';
              }
            }else{
              $total = count($date);
              $total++;
              echo '<tr>
              <td colspan="'.$total.'" align="center">Chưa có dữ liệu</td>
              </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div id="mobile_view">
    
    </div>

    <div class="modal fade" id="basicModal"  name="id">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header form-label border-bottom">
            <h5 class="modal-title" id="exampleModalLabel1">Chấm công nhân viên</h5>
            <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/checktimesheet" method="GET">
            <div class="modal-footer">
              
              <div class="card-body">
                <div class="row gx-3 gy-2 align-items-center">
                  <div class="col-md-12">
                    <label class="form-label"><b>Nhân viên</b></label>
                    <select class="form-select" name="id_staff" id="id_staff" required="">
                                <option value="">Chọn nhân viên</option>
                                <?php 
                                  foreach ($listStaff as $key => $item) {
                                   echo '<option  value="'.$item->id.'">'.$item->name.'</option>';
                                    
                                  }
                                ?>
                              </select>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label"><b>Ca làm việc</b></label> <br/>
                    <input type="checkbox" name="shift[]" value="sáng"> Sáng  &nbsp; &nbsp;
                    <input type="checkbox" name="shift[]" value="chiều"> Chiều  &nbsp; &nbsp;
                    <input type="checkbox" name="shift[]" value="tối"> Tối
                  </div>
                  <div class="col-md-12">
                    <label class="form-label"><b>Ngày làm việc</b></label>
                    <input type="text" class="form-control datepicker" name="date" value="<?php echo date('d/m/Y'); ?>">
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Chấm công</button>
            </div>
          </form>

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

<?php include(__DIR__.'/../footer.php'); ?>