<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/account">Tài khoản</a> /</span>
    Nạp tiền vào tài khoản
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Nạp tiền</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label">Số tiền muốn nạp (*)</label>
                  <input type="number" id="money" class="form-control" value="">
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <button type="button" class="btn btn-primary" onclick="showInfoBanking();">Nạp tiền</button>
                </div>
              </div>
            </div>

            <div class="row" style="display: none;" id="infoBanking">
              <div class="col-12 col-sm-12 col-md-12">
                  Quý khách vui lòng quét mã QR thanh toán bên dưới hoặc chuyển khoản ngân hàng theo thông tin sau:
                  <p><b>Mã QR thanh toán:</b></p>
                  <img id="imageQR" src="https://img.vietqr.io/image/TPB-06931228001-compact2.png?amount=50000&addInfo=<?php echo $session->read('infoUser')->phone;?> thuezoom&accountName=Tran Ngoc Manh" width="200">

                  <p><b>Ngân hàng:</b> TP Bank</p>
                  <p onclick="copyToClipboard('stk','mess')"><b>Số tài khoản:</b> <span id="stk">06931228001</span> <i class='bx bx-copy' ></i></p>
                  <p><b>Chủ tài khoản:</b> Trần Ngọc Mạnh</p>
                  <p id="moneyBanking"><b>Số tiền nạp:</b> 50.000đ</p>
                  <p onclick="copyToClipboard('contentPay','mess')">Nội dung chuyển tiền: <b id="contentPay"><?php echo $session->read('infoUser')->phone;?> thuezoom</b> <i class='bx bx-copy' ></i></p>
                  <p>Vui lòng nhập đúng nội dung chuyển tiền, nhập sai không được cộng tiền chúng tôi không chịu trách nhiệm.</p>
                  <p id="mess" style="color: red;"></p>
                  
              </div>
          </div>
          </div>
        </div>
      </div>

    </div>
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
    $('#'+messId).html('Đã sao chép');

    setInterval(emptyMess, 3000,messId);

}

function showInfoBanking()
{
  var money = parseInt($('#money').val());
  var phone = "<?php echo $session->read('infoUser')->phone;?>";
  $('#moneyBanking').html('<b>Số tiền nạp:</b> '+money+'đ');
  $('#imageQR').attr("src","https://img.vietqr.io/image/TPB-06931228001-compact2.png?amount="+money+"&addInfo="+phone+" thuezoom&accountName=Tran Ngoc Manh");

  $('#infoBanking').show();
}
</script>

<?php include(__DIR__.'/../footer.php'); ?>