<?php
global $urlThemeActive;

$setting= setting();


?>
<footer>
    <div class="main-footer px-0 py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-2">
                    <div class="logo-footer mb-4">
                        <img class="w-100" src="<?php echo @$setting['image_logo'];?>" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="list-info">
                        <h5><?php echo @$setting['title_footer'];?></h5>
                        <div class="list-info">
                            <ul class="p-0 list-unstyled">
                                <li>Cơ quan chủ quản: <?php echo @$setting['agency'];?></li>
                                <li>Địa chỉ: <?php echo @$setting['address'];?></li>
                                <li>Điện thoại: <?php echo @$setting['phone'];?></li>
                                <li>Email: <?php echo @$setting['email'];?></li>
                                <li class="mt-3">Chịu trách nhiệm chính: <?php echo @$setting['responsibility'];?></li>
                                <li>Điện thoại: <?php echo @$setting['responsibilityphone'];?></li>
                                <li>Hòm thư công vụ: <?php echo @$setting['responsibilityemail'];?>n</li>
                                <li class="mt-3">Theo dõi chúng tôi qua:<?php echo @$setting['follow'];?></li>
                                <ul class="list-unstyled p-0">
                                </ul>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-2">
                    <div class="list-info thong-tin-chung">
                        <h5>Thông tin chung</h5>
                        <div class="list-info">
                            <ul class="p-0 list-unstyled">
                                 <?php
                                if(!empty(getListLinkWeb(@$setting['idlink']))){

                                 foreach(getListLinkWeb(@$setting['idlink']) as $key => $ListLink){ ?>
                                <li><a href="<?php echo $ListLink['link'] ?>"><?php echo $ListLink['name'] ?></a></li>
                                <?php } }?> 
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="d-flex justify-content-between flex-column flex-md-row">
                <span>Copyright Tay Ho 360 © 2020. Developed & Managed by VinGG</span>
                <span>Lượt truy cập: 1.000.000</span>
            </div>
        </div>
    </div>
</footer>   

</body>
</html>
