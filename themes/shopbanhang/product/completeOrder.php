<?php
getHeader();
global $urlThemeActive;

$setting = setting();

$slide_home= slide_home($setting['id_slide']);

?>
  <main>
        <section id="section-complete">
            <div class="container">
                <div class="row">
                    <div class="col-12 complete-box">
                        <div class="icon-button-check">
                            <img src="<?php echo $urlThemeActive ?>asset/image/checkbutton.png" alt="">
                        </div>

                        <div class="complete-heading">
                            <h1>Đặt hàng thành công</h1>
                        </div>

                        <div class="complete-text">
                            <!-- <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore </p> -->
                        </div>

                        <div class="complete-info-box">
                            <div class="complete-info-box-detail">
                                <div class="complete-info-heading">
                                    Thông tin đơn hàng
                                </div>

                                <div class="complete-info-detail">
                                    <div class="container">
                                        <div class="row item-complete-info-detail">
                                            <div class="col-md-4">
                                                <span>Người nhận</span>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $data->full_name ?></p>
                                            </div>
                                        </div>

                                        <div class="row item-complete-info-detail">
                                            <div class="col-md-4">
                                                <span>Số điện thoại</span>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $data->phone ?></p>
                                            </div>
                                        </div>

                                        <div class="row item-complete-info-detail" style=" line-height: 18px; ">
                                            <div class="col-md-4">
                                                <span>Địa chỉ</span>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $data->address ?></p>
                                            </div>
                                        </div>

                                        <div class="row item-complete-info-detail">
                                            <div class="col-md-4">
                                                <span>Tổng tiền</span>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo number_format($data->total); ?>đ</p>
                                            </div>
                                        </div>

                                        <div class="row item-complete-info-detail item-complete-info-detail-end ">
                                            <div class="col-md-4">
                                                <span>Phương thức thanh toán</span>
                                            </div>
                                            <div class="col-md-8">
                                            	<?php if (@$data->payment==2){ ?>
                                            		<p>nhận hàng rồi thanh toán</p>
                                            	<?php }else{?>
                                                <p>Chuyển khoản</p>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main>
<?php
getFooter();?>