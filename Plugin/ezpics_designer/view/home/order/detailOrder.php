<?php include(__DIR__.'/../header.php'); ?> 


 <!-- Responsive Table -->
 <div class="card m-4 row">
    <h5 class="card-header">Lịch sử giao dịch - <?php echo $orderProduct['id'] ?></h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>Code</th>
            <th>Total</th>
            <th>Trạng thái</th>
            <th>Payment Type</th>
            <th>Meta payment</th>
            <th>Type</th>
            <th>Ngày giao dịch</th>
            <th>Note</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($orderProduct)){

                $status = '<span class="text-warning">Chưa xử lý</span>';
                $type = '<span class="text-warning">Mua hàng</span>';
                if($orderProduct['status']==2){
                    $status = '<span class="text-success">Đã xử lý</span>';
                }
                if($orderProduct['type']==1){
                    $type = '<span class="text-success">Nạp tiền</span>';
                }
                if($orderProduct['type']==2){
                    $type = '<span class="text-success">Rút tiền</span>';
                }
                if($orderProduct['type']==3){
                    $type = '<span class="text-success">Bán hàng</span>';
                }
                if($orderProduct['type']==4){
                    $type = '<span class="text-success">Xóa ảnh nền</span>';
                }
                echo '<tr>
                        <td>
                          '.$orderProduct['code'].'
                        </td>
                        <td>
                          '.number_format($orderProduct['total']).' VNĐ
                        </td>
                        
                        <td>'.$status.'</td>
                        <td>'.$orderProduct[' payment_type'].'</td>
                        
                        <td align="center">
                          '.$orderProduct['meta_payment'].'
                        </td>

                        <td align="center">
                        '.$type.'
                        </td>
                        <td>'.date('d/m/Y', strtotime($orderProduct->created_at)).'</td>
                        <td>
                          '.$orderProduct['note'].'
                        </td>
                      </tr>';
              }
          ?>
        </tbody>
      </table>
    </div>

    <h5 class="card-header">Thông tin sản phẩm</h5>
    <?php 
            if(!empty($infoProduct)){

                $status = '<span class="text-warning">Khóa</span>';
                $type = '<span class="text-danger">Tạo mới</span>';
                if($infoProduct['status']==1){
                    $status = '<span class="text-success">Mở bán</span>';
                }

                if($infoProduct['type']=='user_edit'){
                    $type = '<span class="text-success">Mua lại</span>';
                }
                if($infoProduct['type']=='user_series'){   
                    $type = '<span class="text-success">Thiết kế hàng loạt</span>';
                }
            echo '
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr class="">
                        <th>Tên người dùng</th>
                        <th>Giá sản phẩm</th>
                        <th>Giảm giá</th>
                        <th>Trạng thái</th>
                        <th>Kiểu sản phẩm</th>
                        <th>Đã bán</th>
                        <th>Lượt xem</th>
                        <th>Lượt thích</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>
                          '.$infoProduct['name'].'
                        </td>
                        <td>'.$infoProduct['price'].'</td>
                        <td>
                          '.$infoProduct['sale_price'].'
                        </td>
                        
                        <td>'.$status.'</td>
                        <td>'.$type.'</td>
                        
                        <td align="center">
                          '.$infoProduct['sold'].'
                        </td>

                        <td align="center">
                        '.$infoProduct['views'].'
                        </td>
                        <td>
                          '.$infoProduct['favorites'].'
                        </td>
                      </tr>
                </tbody>
            </table>
            <div style="display: grid; grid-template-columns: 20% 80%;" class="mt-4">
                <div class="w-100 h-100 pe-2">
                    <img class="w-100 h-100" style="object-fit: contain" src="'.$infoProduct['image'].'" />
                </div>
                <div>
                    <div class="form-floating">
                        <textarea class="form-control" readonly id="floatingTextarea">'.$infoProduct['content'].'</textarea>
                        <label for="floatingTextarea">Nội dung sản phẩm</label>
                    </div>
                    <div class="form-floating mt-4">
                        <textarea class="form-control" readonly id="floatingTextarea">'.$infoProduct['desc'].'</textarea>
                        <label for="floatingTextarea">Mô tả sản phẩm</label>
                    </div>
                </div>
            </div>
            </div>
            ';
            } else {
                echo '<p class="text-danger" style="text-align: center;">'.$mess.'</p>';
            }
        ?>
    <h5 class="card-header">Thông tin thành viên</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>Tên thành viên</th>
            <th>Avatar</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th>Loại thành viên</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($infoMember)){

                $type = '<span class="text-danger">User</span>';
                
                if($infoMember['type']==1){
                    $type = '<span class="text-success">Designer</span>';
                }
                echo '<tr>
                        <td>
                          '.$infoMember['name'].'
                        </td>
                        <td align="center">
                            <img style="width: 60px" src="'.$infoMember['avatar'].'" />
                        </td>
                        <td>
                          '.$infoMember['phone'].'
                        </td>
                        
                        <td>'.$infoMember['email'].'</td>
                        <td>'.$infoMember['status'].'</td>
                        
                        <td align="center">
                          '.$type.'
                        </td>
                      </tr>';
              }
          ?>
        </tbody>
      </table>
    </div>
    
<?php include(__DIR__.'/../footer.php'); ?> 
