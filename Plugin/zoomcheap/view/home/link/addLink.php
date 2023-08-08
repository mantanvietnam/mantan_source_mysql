<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listLink">Link cố định</a> /</span>
    Mua link mới
  </h4>
  <p><a href="/addMoney" class="btn btn-danger"><i class='bx bx-plus'></i> Nạp tiền (<?php echo number_format($infoUser->coin);?>đ)</a></p>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Mua link mới</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên link (*)</label>
                    <input type="text" class="form-control" required name="title" value="<?php echo @$data->title;?>">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Mã link (*)</label>
                    <input type="text" class="form-control" required name="code" value="<?php echo @$data->code;?>">
                  </div>
                  
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Phòng họp</label>
                    <select class="form-select color-dropdown" name="idOrder" id="idOrder" onchange="selectOrder();">
                      <option value="0">Chọn phòng họp</option>
                      <?php 
                      if(!empty($listOrder)){
                        foreach ($listOrder as $key => $order) {
                          if(empty($data->idOrder) || $data->idOrder!=$order->id){
                            echo '<option data-link="'.$order->room->info['join_url'].'" value="'.$order->id.'">Order '.$order->id.': '.$order->room->info['topic'].'</option>';
                          }else{
                            echo '<option selected data-link="'.$order->room->info['join_url'].'" value="'.$order->id.'">Order '.$order->id.': '.$order->room->info['topic'].'</option>';
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Link đích (*)</label>
                    <input type="text" class="form-control" required name="goto" id="goto" value="<?php echo @$data->goto;?>">
                  </div>
                  
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Tạo link (<?php echo number_format($price_link);?>đ)</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
  function selectOrder()
  {
    var goto = $('#idOrder').find(':selected').data('link');
    $('#goto').val(goto);
  }
</script>
<?php include(__DIR__.'/../footer.php'); ?>