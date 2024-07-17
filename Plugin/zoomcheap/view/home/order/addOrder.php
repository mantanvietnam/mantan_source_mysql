<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listOrder">Thuê Zoom</a> /</span>
    Tạo đơn mới
  </h4>
  <p><a href="/addMoney" class="btn btn-danger"><i class='bx bx-plus'></i> Nạp tiền (<?php echo number_format($infoUser->coin);?>đ)</a></p>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Đơn hàng thuê Zoom</h5>
          </div>
          <div class="row ms-2">
            <div class="col-6 col-sm-6 col-md-3">
              <b>Zoom 100:</b> <?php echo $numberAcc100;?>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <b>Zoom 300:</b> <?php echo $numberAcc300;?>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <b>Zoom 500:</b> <?php echo $numberAcc500;?>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <b>Zoom 1000:</b> <?php echo $numberAcc1000;?>
            </div>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Loại tài khoản Zoom (*)</label>
                    <select class="form-control" name="type" id="type" required onchange="selectTypeZoom()">
                      <option value="">Chọn loại Zoom</option>
                      <option value="100">Zoom 100</option>
                      <option value="300">Zoom 300</option>
                      <option value="500">Zoom 500</option>
                      <option value="1000">Zoom 1000</option>
                    </select>
                  </div>
                  
                  <div class="mb-3">
                    <label class="form-label">Tự động gia hạn (*)</label><br/>
                    <input type="radio" name="extend_time_use" value="0" checked /> Tắt &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="extend_time_use" value="1" /> Bật 
                  </div>
                  
                </div>

                <div class="col-md-6">
                  
                  <div class="mb-3">
                    <label class="form-label">Thời gian thuê (*)</label>
                    <select class="form-control" name="id_price" id="id_price" required>
                      <option value="">Chọn thời gian</option>
                    </select>
                  </div>
                  
                </div>
              </div>
              <p class="text-danger">Chú ý: hệ thống sẽ tính thời gian thuê kể từ khi bạn tạo đơn thành công. Nếu muốn có link để truyền thông trước mà không bị tính giờ thuê thì hãy sử dụng chức năng <b><a href="/listLink">Link cố định</a></b></p>
              <button type="submit" class="btn btn-primary">Tạo đơn</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
  var prices = {};
  prices[100] = {};
  prices[300] = {};
  prices[500] = {};
  prices[1000] = {};

  <?php 
  if(!empty($listPrices)){
    foreach ($listPrices as $key => $value) {
      echo 'prices['.$value->type.']['.$value->hour.'] = ['.$value->price.','.$value->id.'];';
    }
  }
  ?>

  function selectTypeZoom()
  {
    var type = $('#type').val();
    var optionSelect = '<option value="">Chọn thời gian</option>';
    var text = '';
    var time;

    if(type != ''){
      Object.keys(prices[type]).forEach(function(key) {
        if(key < 24){
          text = key+' giờ giá '+prices[type][key][0].toLocaleString()+'đ';
        }else if(key < 720){
          time = key/24;
          text = time+' ngày giá '+prices[type][key][0].toLocaleString()+'đ';
        }else{
          time = key/720;
          text = time+' tháng giá '+prices[type][key][0].toLocaleString()+'đ';
        }


        optionSelect += '<option value="'+prices[type][key][1]+'">'+text+'</option>';
      });
    }

    $('#id_price').html(optionSelect);
  }

  console.log(prices);
</script>
<?php include(__DIR__.'/../footer.php'); ?>