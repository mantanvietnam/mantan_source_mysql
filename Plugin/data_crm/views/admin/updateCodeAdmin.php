<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Cập nhập phiên bản code</h4>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Cập nhập phiên bản code</h5>
    <b>Cập nhập thành công:</b> <br/>
    <?php echo implode('<br/>', $domain_done);?>

    <b>Cập nhập thất bại:</b> <br/>
    <?php echo implode('<br/>', $domain_error);?>

    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>