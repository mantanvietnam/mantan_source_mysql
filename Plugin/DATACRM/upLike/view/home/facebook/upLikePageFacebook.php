<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Tăng Like Fanpage Facebook</h4>
  <p><a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popupInfo"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Tăng Like Fanpage Facebook</h5>
      <p><?php echo $mess;?></p>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
             <th>ID</th>
            <th>ID trang</th>
             <th>Số lượng</th>
             <th>Số tiền</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>
         
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
        <h5 class="modal-title" id="exampleModalLabel1">Nhập thông tin</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
     <form action="" method="POST">
       <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
       <div class="modal-footer">
        <div class="card-body">
          <div class="row gx-3 gy-2 align-items-center">
            <div class="col-md-12">
              <label class="form-label">Link/uid trang</label>
              <input type="text" value="" class="form-control" placeholder="" name="id_page" id="id_page" required onchange="checkUID();">
            </div>

            <div class="col-md-12">
              <label class="form-label">Kênh</label>
              <select name="chanel" id="chanel" class="form-select color-dropdown" required onchange="tinhgia();">
                <option value="">Chọn kênh</option>
                <?php
                  if(!empty($listPrice['data']['facebook']['buff']['likepage'])){
                    foreach ($listPrice['data']['facebook']['buff']['likepage'] as $key => $value) {
                      $price = $value['rate']*3;
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

          </div>
        </div>
        
        <button type="submit" class="btn btn-primary" onclick="tinhgia();">Gửi yêu cầu</button>
      </div>
     </form>
      
    </div>
  </div>
</div>

<script type="text/javascript">
  function checkUID() 
  {
    var uid = $('#id_page').val();

    if(uid != ''){
      $.ajax({
        method: "POST",
        url: "/apis/getUidAPI",
        data: { uid: uid }
      })
        .done(function( msg ) {
          $('#id_page').val(msg.data.uid);
        });
    }
  }

  function tinhgia()
  {
    var chanel = $('#chanel').val();
    var number_up = $('#number_up').val();

    if(chanel!='' && number_up!=''){

    }else{
      alert('Bạn chưa chọn kênh hoặc chưa nhập số lượng muốn tăng');
    }
  }
</script>
<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>