<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/account">Tài khoản</a> /</span>
    Gia hạn 
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Gia Hạn </h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
              <div class="row mb-3">

                <?php
                if(!empty($priceExtend)){
                  foreach($priceExtend as $key => $item){
                   
                   echo '<div class="col-md-4">
                   <div style=" text-align: center; font-size: 20px; padding: 10px 0; background-color: #edffff; border-radius: 20px; ">
                   <h4> '.$key.' NĂM</p>
                   <p>Giá : '.number_format($item).'đ</p>
                      <p> <a class="btn btn-primary" style=" color: #fff; " onclick="modalAgency('.$key.','.$item.')">Gia hạn</a></p> 
                   </div>
                   </div>';
                 }
               }
               ?>
             </div>
          </div>
        </div>
      </div>

    </div>
</div>

<div class="modal fade" id="deleteAgency"  name="deleteAgency">         
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1"><h5>Thông tin thanh toán gia hạn</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
          <div id="info_bank"></div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function modalAgency(year,price){
        $('#deleteAgency').modal('show');
        var description = '<?php echo @$description ?>Y'+year;
        var html = '';
         if(year!=''){
            $.ajax({
                method: "POST",
                url: "https://icham.vn/apis/getinfobankAPI",
                data: { amount: price,
                        description: description,
                 }
            })
            .done(function( msg ) {
              html += ' <div class="card-header row">\
                  <div class="col-md-6">\
                    <p><b>Thời gian gia hạn:</b> '+year+' năm</p>\
                    <p><b>Ngân hàng:</b> '+msg.code_bank+'</p>\
                    <p><b>Số tài khoản:</b> <span id="stk">'+msg.accountNumber+'</span></p>\
                    <p><b>Chủ tài khoản:</b> '+msg.accountName+'</p>\
                    <p id="moneyBanking"><b>Số tiền:</b> '+msg.amount+'</p>\
                    <p>Nội dung chuyển tiền: <b id="contentPay">'+msg.description+'</b></p>\
                    <p>Vui lòng nhập đúng nội dung chuyển tiền, nhập sai không được cộng tiền chúng tôi không chịu trách nhiệm.</p>\
                    <p id="mess" style="color: red;"></p>\
                  </div>\
                  <div class="col-md-6 text-center">\
                    <p>Quét mã QR để thực hiện nạp tiền vào tài khoản</p>\
                    <img src="'+msg.linkQR+'" style="max-width: 500px; width: 100%;">\
                  </div>\
                </div>';
                console.log(html);

                $('#info_bank').html(html);

            });
        }
        
    }

</script>





<?php include(__DIR__.'/../footer.php'); ?>