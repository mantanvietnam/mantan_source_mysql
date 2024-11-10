<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Tăng Like Fanpage Facebook</h4>
  <p>
    <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popupInfo"><i class='bx bx-plus'></i> Thêm mới</a>
    &nbsp;&nbsp;&nbsp;
    <a class="btn btn-danger" href="<?php echo $urlCurrent;?>"><i class='bx bx-transfer'></i> Kiểm tra trạng thái</a>
  </p>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Tăng Like Fanpage Facebook</h5>
    <?php echo $mess;?>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>Thời gian tạo</th>
            <th>ID trang</th>
            <th>Hoàn thành</th>
            <th>Yêu cầu</th>
            <th>Số tiền</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(!empty($listData)){
            foreach ($listData as $key => $value) {
              echo '<tr>
                      <td>'.date('H:i d/m/Y', $value->create_at).'</td>
                      <td><a href="'.$value->url_page.'" target="_blank">'.$value->id_page.'</a></td>
                      <td>'.number_format($value->run).'</td>
                      <td>'.number_format($value->number_up).'</td>
                      <td>'.number_format($value->money).'đ</td>
                      <td>'.$value->status.'</td>
                    </tr>';
            }
          }else{
            echo '<tr><td cplspan="10">Chưa có dữ liệu</td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- Phân trang -->
    <div class="demo-inline-spacing">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <?php
            if($totalPage>0){
                if ($page > 5) {
                    $startPage = $page - 5;
                } else {
                    $startPage = 1;
                }

                if ($totalPage > $page + 5) {
                    $endPage = $page + 5;
                } else {
                    $endPage = $totalPage;
                }
                
                echo '<li class="page-item first">
                        <a class="page-link" href="'.$urlPage.'1"
                          ><i class="tf-icon bx bx-chevrons-left"></i
                        ></a>
                      </li>';
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $active= ($page==$i)?'active':'';

                    echo '<li class="page-item '.$active.'">
                            <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                          </li>';
                }

                echo '<li class="page-item last">
                        <a class="page-link" href="'.$urlPage.$totalPage.'"
                          ><i class="tf-icon bx bx-chevrons-right"></i
                        ></a>
                      </li>';
            }
          ?>
        </ul>
      </nav>
    </div>
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>

<div class="modal fade" id="popupInfo"  name="id">    
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Nhập thông tin (số dư: <?php echo number_format($member->coin);?>đ)</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
     <form action="" method="POST">
       <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
       <input type="hidden" name="total_pay" id="total_pay" value="0" />
       <input type="hidden" name="url_page" id="url_page" value="" />
       <input type="hidden" name="price" id="price" value="" />
       <div class="modal-footer">
        <div class="card-body">
          <div class="row gx-3 gy-2 align-items-center">
            <div class="col-md-12">
              <label class="form-label">Link/uid trang</label>
              <input type="text" value="" class="form-control" placeholder="" name="id_page" id="id_page" required onchange="checkUID();">
            </div>

            <div class="col-md-12">
              <label class="form-label">Kênh</label>
              <select name="chanel" id="chanel" class="form-select color-dropdown" required onchange="selectChanel();">
                <option data-price='' value="">Chọn kênh</option>
                <?php
                  if(!empty($listPrice['data']['facebook']['buff']['likepage'])){
                    foreach ($listPrice['data']['facebook']['buff']['likepage'] as $key => $value) {
                      $price = ceil($value['rate'])*3;
                      echo '<option data-price="'.$price.'" value="'.$key.'" title="'.$value['detail'].'">Kênh '.$key.' giá '.$price.'đ/like</option>';
                    }
                  }
                ?>
              </select>
            </div>

            <div class="col-md-12">
              <label class="form-label">Số lượng</label>
              <input type="number" value="" class="form-control" placeholder="" name="number_up" id="number_up" required onchange="tinhgia();">
            </div>

            <div class="col-md-12 text-danger" id="mess_pay"></div>
          </div>
        </div>
        
        <button type="submit" class="btn btn-primary" disabled id="submitRequest" onclick="tinhgia();">Gửi yêu cầu</button>
      </div>
     </form>
      
    </div>
  </div>
</div>

<script type="text/javascript">
  var coin = <?php echo (int) $member->coin;?>;

  function checkUID() 
  {
    var uid = $('#id_page').val();
    $('#submitRequest').prop('disabled', true);

    if(uid != ''){
      $.ajax({
        method: "POST",
        url: "/apis/getUidAPI",
        data: { uid: uid }
      })
        .done(function( msg ) {
          $('#id_page').val(msg.data.uid);
          $('#url_page').val(msg.data.url);

          tinhgia();
        });
    }
  }

  function tinhgia()
  {
    var chanel = $('#chanel').val();
    var number_up = $('#number_up').val();
    var price = $('#price').val();
    var total_pay = 0;
    var mess_pay = '';

    if(price!='' && number_up!=''){
      total_pay = parseInt(price) * parseInt(number_up);
      mess_pay = 'Tổng số tiền cần thanh toán là <b>'+total_pay.toLocaleString('en-US')+'đ</b>';

      if(total_pay <= coin){
        $('#submitRequest').prop('disabled', false);
      }else{
        $('#submitRequest').prop('disabled', true);

        mess_pay += '. Số dư tài khoản của bạn không đủ, vui lòng <a href="/listTransactionHistories">NẠP TIỀN</a>';
      }
    }else{
      $('#submitRequest').prop('disabled', true);
    }

    $('#mess_pay').html(mess_pay);
    $('#total_pay').val(total_pay);
  }

  function selectChanel()
  {
    var selectedOption = $('#chanel').find('option:selected');
    var price = selectedOption.data('price');

    $('#price').val(price);

    tinhgia();
  }
</script>
<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>