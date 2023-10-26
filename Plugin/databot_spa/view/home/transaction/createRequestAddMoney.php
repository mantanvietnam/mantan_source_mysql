<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Yêu cầu nạp tiền</h4>

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Thanh toán chuyển khoản</h5>
    <div class="card-body row">
      <div class="col-12">
        Quét mã QR dưới đây để thực hiện chuyển khoản, vui lòng không thay đổi nội dung chuyển khoản mặc định của hệ thống<br/>
        <img src="https://img.vietqr.io/image/TPB-06931228686-compact2.png?amount=<?php echo (int) @$_GET['coin'];?>&addInfo=DATASPA <?php echo $boss_spa->phone;?>&accountName=Tran Ngoc Manh" width="300">
      </div>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>
<?php include(__DIR__.'/../footer.php'); ?>