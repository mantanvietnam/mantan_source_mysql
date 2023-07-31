<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listPrepayCard">Mệnh giá thẻ trả trước</a> /</span>
    Thông tin Mệnh giá thẻ trả trước
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin mệnh giá thẻ trả trước</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên thẻ (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mệnh giá </label>
                    <input type="number" class="form-control" placeholder="" name="price" id="price" value="<?php echo @$data->price;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Chiết khấu</label>
                    <input type="number" required class="form-control " placeholder="" name="discount_money" id="discount_money" value="<?php echo @$data->discount_money;?>" />
                  </div>
                   <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <input type="radio" name="status" class="" id="status" value="1" <?php if(@ $data['status']==1) echo 'checked="checked"';   ?> > Hiển thị&ensp;
                      <input type="radio" name="status" class="" id="status" value="0" <?php if(@ $data['status']==0) echo 'checked="checked"';   ?> > Ẩn
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Giá bán</label>
                    <input type="number" class="form-control" placeholder="" name="total_price" id="total_price" value="<?php echo @$data->total_price;?>" />
                  </div>
                   <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Giá ưu đãi trên thương mại điện tử</label>
                    <input type="number"  class="form-control" placeholder="" name="special_price_momo" id="special_price_momo" value="<?php echo @$data->special_price_momo; ?>" />
                  </div>
                 <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Thời gian</label>
                    <input type="number" autocomplete="off" class="form-control" placeholder="" name="use_time" id="use_time" value="" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mô tả thẻ</label>
                    <textarea class="form-control phone-mask" rows="2" name="note"><?php echo @$data->note;?></textarea>
                  </div>
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
<script>
    $( function() {
      $( ".datepicker" ).datepicker({
        dateFormat: "dd/mm/yy"
      });
    } );
    </script>

<?php include(__DIR__.'/../footer.php'); ?>