<?php
global $urlThemeActive;
$setting = setting();
global $session;
$infoUser = $session->read('infoUser');

?>

   <footer>
        <section id="section-footer">
            <div class="container">
                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="logo-footer">
                        <img src="<?php echo $urlThemeActive ?>asset/image/logophong.png" alt="">
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12 footer-item footer-left">
                        <div class="footer-info">
                            <div class="copyright">
                                <strong><?php echo $setting['company'] ?></strong>
                            </div>
                            <div class="footer-info-list">
                                <div class="footer-info-item">
                                    <p><?php echo $setting['address'] ?></p>
                                    <p>ĐT:<span class="blue-text"><?php echo $setting['phone'] ?></span>-Fax:<span class="blue-text"><?php echo $setting['fax'] ?></span></p>
                                </div>

                                <div class="footer-info-item">
                                    <p><span class="blue-text">Giấy chứng nhận đăng ký doanh nghiệp: <?php echo $setting['business'] ?></span></p>
                                    <p><?php echo $setting['side_plan'] ?></p>
                                </div>

                                <div class="footer-info-item">
                                    <p>Tổng đài hỗ trợ (08:00-21:00, miễn phí gọi)</p>  
                                    <p>Gọi mua: <span class="blue-text"><?php echo $setting['call_buy'] ?></span></p>  
                                    <p>Khiếu nại: <span class="blue-text"><?php echo $setting['complain'] ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-12 footer-item footer-center">
                        <div class="menu-footer">
                            <div class="footer-menu-name">
                                <p>Danh mục</p>
                            </div>
                            <ul>
                                 <?php
                                if (!empty(getListLinkWeb(@$setting['id_category']))) {
                                    foreach (getListLinkWeb(@$setting['id_category']) as $key => $ListLink) { ?>
                                        <li>
                                            <a href="<?php echo $ListLink['link'] ?>"><?php echo $ListLink['name'] ?></a>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                        </div>

                        <div class="menu-footer">
                            <div class="footer-menu-name">
                                <p>Dịch vụ khách hàng</p>
                            </div>
                            <ul>
                                 <?php
                                if (!empty(getListLinkWeb(@$setting['id_service']))) {
                                    foreach (getListLinkWeb(@$setting['id_service']) as $key => $ListLink) { ?>
                                        <li>
                                            <a href="<?php echo $ListLink['link'] ?>"><?php echo $ListLink['name'] ?></a>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-12 footer-item footer-right">
                        <div class="footer-social">
                            <div class="footer-menu-name">
                                <p>KẾT NỐI VỚI CHÚNG TÔI</p>
                            </div>
                            <div class="group-social">
                                <ul>
                                    <li><a href="<?php echo $setting['facebook'] ?>"><img src="<?php echo $urlThemeActive ?>asset/image/face.png" alt=""></a></li>
                                    <li><a href="<?php echo $setting['youtube'] ?>"><img src="<?php echo $urlThemeActive ?>asset/image/youtube.png" alt=""></a></li>
                                    <li><a href="<?php echo $setting['instagram'] ?>"><img src="<?php echo $urlThemeActive ?>asset/image/insta.png" alt=""></a></li>
                                    <li><a href="<?php echo $setting['email'] ?>"><img src="<?php echo $urlThemeActive ?>asset/image/mail.png" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="footer-contact">
                            <div class="footer-menu-name">
                                <p>Đăng ký với chúng tôi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    <script src="<?php echo $urlThemeActive ?>asset/js/slick.js"></script>
    <script src="<?php echo $urlThemeActive ?>asset/js/main.js"></script>
    <script src="<?php echo $urlThemeActive ?>asset/js/mainplusproduct.js"></script>


</body>
</html>