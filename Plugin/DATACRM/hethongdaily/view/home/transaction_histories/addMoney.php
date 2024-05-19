<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listTransactionHistories">Giao dịch</a> /</span>
    Nạp tiền tài khoản
  </h4>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Nạp tiền tài khoản</h5>
    <div class="col-md-12 text-center">
      <p>Quét mã QR để thực hiện nạp tiền vào tài khoản</p>
      <img src="<?php echo $linkQR;?>" style="max-width: 500px; width: 100%;">
    </div>
  </div>
<!--/ Responsive Table -->
</div>

<?php include(__DIR__.'/../footer.php'); ?>