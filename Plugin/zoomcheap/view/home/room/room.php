<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listOrder">Thuê Zoom</a> /</span>
    Thông tin phòng họp
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin phòng họp</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Giới hạn phòng họp</label>
                  <input type="text" class="form-control" name="" value="<?php echo $order->type;?> người">
                </div>

                <div class="mb-3">
                  <label class="form-label">Tên phòng họp</label>
                  <input type="text" class="form-control" name="" value="<?php echo $room['topic'];?>">
                </div>
                
                <div class="mb-3">
                  <label class="form-label">ID phòng họp</label>
                  <input type="text" class="form-control" name="" value="<?php echo $room['id'];?>">
                </div>
                
              </div>

              <div class="col-md-6">
                
                <div class="mb-3">
                  <label class="form-label">Mật khẩu phòng họp</label>
                  <input type="text" class="form-control" name="" value="<?php echo @$room['password'];?>">
                </div>

                <div class="mb-3">
                  <label class="form-label">Key host</label>
                  <input type="text" class="form-control" name="" value="<?php echo $zoom->key_host;?>">
                </div>

                <div class="mb-3">
                  <label class="form-label">Link phòng họp</label>
                  <input type="text" class="form-control" name="" value="<?php echo $room['join_url'];?>">
                </div>
                
              </div>
            </div>

            <button type="submit" class="btn btn-primary" onclick="copyFormatted('contentShare','mess')">Chia sẻ</button>
            <p id="mess" style="color: red;"></p>
          </div>
        </div>
      </div>

    </div>
</div>

<p style="display: none;" id="contentShare">ID phòng: <?php echo $room['id'];?><br/>Mật khẩu: <?php echo @$room['password'];?><br/>Link tham gia: <?php echo $room['join_url'];?></p>

<script type="text/javascript">
function copyFormatted(idDivCopy, idDivMess) {
  // Create container for the HTML
  // [1]
  var container = document.createElement('div')
  container.innerHTML = $('#'+idDivCopy).html();

  // Detect all style sheets of the page
  var activeSheets = Array.prototype.slice.call(document.styleSheets)
    .filter(function (sheet) {
      return !sheet.disabled
    })

  // Mount the container to the DOM to make `contentWindow` available
  // [3]
  document.body.appendChild(container)

  // Copy to clipboard
  // [4]
  window.getSelection().removeAllRanges()

  var range = document.createRange()
  range.selectNode(container)
  window.getSelection().addRange(range)

  // [5.1]
  document.execCommand('copy')

  // [5.2]
  for (var i = 0; i < activeSheets.length; i++) activeSheets[i].disabled = true

  // [5.3]
  document.execCommand('copy')

  // [5.4]
  for (var i = 0; i < activeSheets.length; i++) activeSheets[i].disabled = false

  // Remove the container
  // [6]
  document.body.removeChild(container)

  $('#'+idDivMess).html('Đã sao chép');
}
</script>

<?php include(__DIR__.'/../footer.php'); ?>