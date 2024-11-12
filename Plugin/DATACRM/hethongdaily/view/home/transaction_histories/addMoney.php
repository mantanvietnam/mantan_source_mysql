<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listTransactionHistories">Giao dịch</a> /</span>
    Nạp tiền tài khoản
  </h4>

  <!-- Responsive Table -->
  <div class="card ">
    <h5 class="card-header">Nạp tiền tài khoản</h5>
    <div class="card-header row">
      <div class="col-md-6">
        <h5>Thông tin chuyển khoản ngân hàng theo thông tin sau:</h5>
        <p><b>Ngân hàng:</b> <?php echo $data['name_bank'] ?></p>
        <p><b>Số tài khoản:</b> <span id="stk"><?php echo $data['number_bank'] ?></span></p>
        <p><b>Chủ tài khoản:</b> <?php echo $data['accountName'] ?></p>
        <p id="moneyBanking"><b>Số tiền nạp:</b> <?php echo $data['amount'] ?></p>
        <p>Nội dung chuyển tiền: <b id="contentPay"><?php echo $data['content'] ?></b></p>
        <p>Vui lòng nhập đúng nội dung chuyển tiền, nhập sai không được cộng tiền chúng tôi không chịu trách nhiệm.</p>
        <p id="mess" style="color: red;"></p>
      </div>
      <div class="col-md-6 text-center">
        <p>Quét mã QR để thực hiện nạp tiền vào tài khoản</p>
        <img src="<?php echo $data['linkQR'];?>" style="max-width: 500px; width: 100%;">s
      </div>
    </div>

  </div>
<!--/ Responsive Table -->
</div>
<script type="text/javascript">
  function copyToClipboard(idCopy,messId) {
    var textCopy = $('#'+idCopy).html();
    textCopy = textCopy.replace(/(<([^>]+)>)/ig,"");
    // Create a "hidden" input
    var aux = document.createElement("input");

    // Assign it the value of the specified element
    aux.setAttribute("value", textCopy);

    // Append it to the body
    document.body.appendChild(aux);

    // Highlight its content
    aux.select();

    // Copy the highlighted text
    document.execCommand("copy");

    // Remove it from the body
    document.body.removeChild(aux);

    // show mess
    c

    setInterval(emptyMess, 3000,messId);

}
</script>

<?php include(__DIR__.'/../footer.php'); ?>