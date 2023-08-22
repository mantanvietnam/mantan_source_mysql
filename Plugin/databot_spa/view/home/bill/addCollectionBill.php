<?php include(__DIR__.'/../header.php'); 
global $type_collection_bill;
?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCollectionBill">Phiếu thu</a> /</span>
    Thông tin phiếu thu 
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin phiếu thu</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Ngày sinh (*)</label>
                    <input type="text"  class="form-control hasDatepicker datepicker" placeholder="" name="birthday" id="birthday" value="<?php echo @$data->birthday;?>" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Số tiền (*)</label>
                    <input required type="number" class="form-control phone-mask" name="total" id="total" value="<?php echo @$data->total;?>" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Hình thức (*)</label>
                    <select name="type_collection_bill" class="form-select color-dropdown" required>
                      <option value="">Chọn danh mục</option>
                      <?php
                        
                        foreach ($type_collection_bill as $key => $value) {
                          if(empty(@$data->type_collection_bill) || @$data->type_collection_bill!=$key){
                            echo '<option value="'.$key.'">'.$value.'</option>';
                          }else{
                            echo '<option selected value="'.$key.'">'.$value.'</option>';
                          }
                        }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Nội dung thu</label>
                    <input required type="text" class="form-control phone-mask" name="note" id="note" value="<?php echo @$data->note;?>" />
                  </div>
                </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>
<style type="text/css">
  .datepicker-dropdown .table-condensed{
    width: 100%; 
    text-align: center;
  }
</style>
<!-- <script>
    $( function() {
      $( ".datepicker" ).datepicker({
        dateFormat: "dd/mm/yy H:"
      });
    } );
</script> -->

<script type="text/javascript">
  $(function () {
    $('.datepicker').datetimepicker();
  });
</script>

<?php include(__DIR__.'/../footer.php'); ?>