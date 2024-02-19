<?php
getHeader();
global $urlThemeActive;

$setting = setting();

$slide_home= slide_home($setting['id_slide']);
?>
 <main>
        <section id="section-detail-order">
            <div class="container">
                <div class="row">
                    <h3>Thanh toán</h3>
                    <div class="col-lg-7 col-12">
                        <h4>Chi tiết đơn hàng</h4>
                        <table class="table table-ord">
                            <thead>
                                <tr>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($data->order)){
                                    foreach($data->order as $key => $item){ 
                                        echo '<tr class="production">
                                                    <td><a href="/san-pham/'.$item->product->slug.'.html">'.$item->product->title.'<span>× '.$item->quantity.'</span></a></td>
                                                    <td>'.number_format($item->quantity*$item->product->price).' ₫</td>
                                                </tr>';
                            }}?>
                               

                                <tr class="payment-method">
                                    <td>Phương thức thanh toán:</td>
                                    <td>
                                        <?php 
                                            if($data->payment==1){
                                                echo 'Chuyển khoản ngân hàng';
                                            }else{
                                                 echo 'Trả tiền mặt khi nhận hàng';
                                            }

                                         ?>
                                    </td>
                                </tr>

                                <tr class="total-price">
                                    <td>Tổng cộng:</td>
                                    <td><?php echo number_format(@$data->money) ?> ₫</td>
                                </tr>

                                <tr class="note">
                                    <td>Lưu ý:</td>
                                    <td><?php echo @$data->note_user ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-5 col-12">
                        <div class="end-order">
                            <p>Cảm ơn bạn. Đơn hàng của bạn đã được nhận.</p>
                            <ul>
                                <li>Mã đơn hàng: <span><?php echo @$data->id ?></span></li>
                                <li>Ngày: <span><?php echo date('d/m/Y',@$data->create_at) ?></span></li>
                                <li>Tổng cộng: <span><?php echo number_format(@$data->money) ?> ₫</span></li>
                                <li>Phương thức thanh toán: 
                                    <span>
                                        <?php 
                                            if($data->payment==1){
                                                echo 'Chuyển khoản ngân hàng';
                                            }else{
                                                 echo 'Trả tiền mặt khi nhận hàng';
                                            }?>
                                             
                                        </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();?>