<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"> <span class="text-muted fw-light"><a href="/listMedicalHistories/?id_customer=<?php echo @$_GET['id_customer'];?>">Hồ sơ khách hàng</a> /</span>
    Phiếu thông tin
  </h4>
  

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Thông tin khách hàng</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-6">
            <label class="form-label">Họ tên: </label><span>&emsp; <?php echo @$dataCustomer->name ?></span>
          </div>
          <div class="col-md-6">
            <label class="form-label">Điện thoại: </label><span>&emsp; <?php echo @$dataCustomer->phone ?></span>
          </div>
          <div class="col-md-6">
            <label class="form-label">Địa chỉ: </label><span>&emsp; <?php echo @$dataCustomer->address ?></span>
          </div>
            <div class="col-md-6">
            <label class="form-label">Email: </label><span>&emsp; <?php echo @$dataCustomer->email ?></span>
          </div>
         
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card card-body">
    <h5 class="">Khám bệnh</h5>
     <?= $this->Form->create(); ?>
    <div class=" row">
     <?php echo $mess;?>
      <div class="mb-3 col-md-6">
        <label class="form-label" for="basic-default-phone">Hình ảnh hiện trạng  (*)</label>
        <?php showUploadFile('image','image',@$data->image,0);?>
      </div>
      <div class="mb-3 col-md-6">
        <label class="form-label" for="basic-default-phone">Mô tả hiện trạng  (*)</label>
        <textarea class="form-control" name="title"><?php echo @$data->title;?></textarea>
      </div>
      <div class="mb-3 col-md-6">
        <label class="form-label" for="basic-default-fullname">Chuẩn đoán (*)</label>
        <textarea class="form-control" name="result"><?php echo @$data->result;?></textarea>
      </div>
      
      <div class="mb-3 col-md-6">
        <label class="form-label" for="basic-default-fullname">Phương pháp xử lý (*)</label>
        <textarea class="form-control" name="treatment_plan"><?php echo @$data->treatment_plan;?></textarea>
      </div>
      <div class="mb-3 col-md-6">
        <label class="form-label" for="basic-default-fullname">Chú ý </label>
        <textarea class="form-control" name="note"><?php echo @$data->note;?></textarea>
      </div>
      <div class="mb-3 col-md-12">
        <button type="submit" style=" width: 70px; " class="btn btn-primary">Lưu</button>
      </div>
    </div>
    <?= $this->Form->end() ?>


    <!-- Phân trang -->
   
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>



<?php include(__DIR__.'/../footer.php'); ?>