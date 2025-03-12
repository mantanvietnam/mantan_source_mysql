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
            <input type="hidden" value="<?php echo $dataStaff->id; ?>">   
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
    <h5 class="card-header">Bảng thính lương nhân viên <?php echo $dataStaff->name ?> tháng <?php echo @$thang.'/'.$nam ?></h5>
    <?php echo @$mess;
    debug($dataStaff);
    ?>
     

      <form id="summary-form" action="" method="post" class="form-horizontal">
        <div class="row">
          <div class="mb-3 col-md-6">
            <label class="form-label">Ngày làm việc</label>
            <input type="text" class="form-control" name="working_day" id="working_day" value="<?php echo $working_day; ?>">
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">Tổng ngày</label>
            <input type="text" class="form-control" name="working_day" id="working_day" value="">
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">lương cứng</label>
            <input type="text" class="form-control" name="fixed_salary" id="fixed_salary" value="<?php echo $dataStaff->fixed_salary; ?>">
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">Hoa hồng</label>
            <input type="text" class="form-control" name="commission" id="commission" value="<?php echo $commission ?>">
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">Tiền thưởng</label>
            <input type="text" class="form-control" name="bonus " id="bonus " value="<?php echo $bonus ?>">
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">tiền phụp cấp</label>
            <input type="text" class="form-control" name="allowance" id="allowance" value="<?php echo $dataStaff->allowance; ?>">
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">tiền phạt</label>
            <input type="text" class="form-control" name="punish" id="punish" value="<?php echo $punish ?>">
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">tiền Bảo hiểm</label>
            <input type="text" class="form-control" name="insurance" id="insurance" value="<?php echo $dataStaff->insurance; ?>">
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">tiền tạm ứng </label>
            <input type="text" class="form-control" name="advance" id="advance" value="">
          </div>
         
        </div>
      </form>

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

<script type="text/javascript">
  function upadetimesheet(id_staff,ngay,shift){
    let ca = shift.split(', ');
    $('#ngay').val(ngay);
    $('#id_staff').val(id_staff);

    if (ca.includes('sáng')) {
      let checkbox = document.getElementById('sang');
      checkbox.checked = true;
    }else{
      let checkbox = document.getElementById('sang');
      checkbox.checked = false;
    }

    if (ca.includes('chiều')) {
      let checkbox = document.getElementById('chieu');
      checkbox.checked = true;
    }else{
      let checkbox = document.getElementById('chieu');
      checkbox.checked = false;
    }

    if (ca.includes('tối')) {
      let checkbox = document.getElementById('toi');
      checkbox.checked = true;
    }else{
      let checkbox = document.getElementById('toi');
      checkbox.checked = false;
    }


     console.log(ca);
      $('#basicModal').modal('show');
  }
</script>

<?php include(__DIR__.'/../footer.php'); ?>