<?php global $settingThemes;?>
		<footer>
            <div class="fter-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="item-fter">
                                <h4><?php echo @$settingThemes['name_company'];?></h4>
                                <div class="desc">
                                    <?php echo nl2br(@$settingThemes['des_company']);?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-fter">
                                <h4>LIÊN HỆ</h4>
                                <div class="social">
                                    <ul>
                                        <li>
                                            <a href="<?php echo @$settingThemes['facebook'];?>" target="_blank">
                                                <img src="<?php echo $urlThemeActive;?>/images/social-1.png" class="img-fluid" alt="">
                                                <span>Facebook: <?php echo @$settingThemes['facebook'];?></span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailto:<?php echo @$settingThemes['email'];?>" target="_blank">
                                                <img src="<?php echo $urlThemeActive;?>/images/social-2.png" class="img-fluid" alt="">
                                                <span><?php echo @$settingThemes['email'];?></span>
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a href="tel:<?php echo @$settingThemes['hotline'];?>" target="_blank">
                                                <img src="<?php echo $urlThemeActive;?>/images/social-3.png" class="img-fluid" alt="">
                                                <span><?php echo @$settingThemes['hotline'];?></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item-fter">
                                <h4>CHÍNH SÁCH VÀ ĐIỀU KHOẢN</h4>
                                <div class="link-fter">
                                    <ul>
                                        
                                        <li>
                                            <a href="/">Test</a>
                                        </li>

                                        <li>
                                            <a href="/">Test</a>
                                        </li>

                                        <li>
                                            <a href="/">Test</a>
                                        </li>

                                        <li>
                                            <a href="/">Test</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script type="text/javascript" src="<?php echo $urlThemeActive;?>/js/lib/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $urlThemeActive;?>/js/lib/slick.min.js"></script> 
        <script type="text/javascript" src="https://channel.mediacdn.vn/Magazine/pc20220829042536/js/aos.min.js"></script> 
        <script type="text/javascript" src="<?php echo $urlThemeActive;?>/js/private.js"></script> 
        <script type="text/javascript" src="<?php echo $urlThemeActive;?>/plugin/jquery.toast.min.js"></script>

        <script>
            function isNumeric (evt) {
                if(this.value>31){this.value='31';}else if(this.value<0){this.value='0';};
            }
        </script>

        <?php if(!empty($mess)){ ?>
            <script>
                function showToast(text, heading){
                    $.toast({
                        text: text,
                        heading: heading,
                        icon: 'success',
                        showHideTransition: 'fade',
                        allowToastClose: false,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-right',
                        textAlign: 'left', 
                        loader: true, 
                        loaderBg: '#9ec600',
                    });   
                }

                jQuery(document).ready(function($) {
                    showToast('<?php echo $mess;?>', 'Thông báo');
                });
            </script>
        <?php }?>
    </body>
</html>