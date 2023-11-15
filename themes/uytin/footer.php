  <!-- ======= Footer ======= -->
  <?php 
    global $themeSettings; 
  ?>

  <footer style="background-image:url('<?php echo @$themeSettings['nenFooter'] ?>');background-color: #000;">

    <div class="footer-top">
      <div class="abc">
        <div class="container ">
          <div class="row">
            <div class="col-md-3 col-sm-6">
              <div class="item-ft">
                <div class="title-ft"> <?php echo @$themeSettings['company']; ?></div>
                <ul class="list-lh mb-3">
                  <li>
                    <p>
                      <i class="bi bi-geo-alt-fill"></i>  <?php echo $contactSite['address']; ?>
                    </p>
                  </li> 
                  <li>
                    <p>
                      <i class="bi bi-telephone-fill"></i>  <?php echo $contactSite['phone']; ?>
                    </p>
                  </li>
                  <li>
                    <p>
                      <i class="bi bi-envelope"></i>  <?php echo $contactSite['email']; ?>
                    </p>
                  </li>
                </ul>
                
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="item-ft">
                <div class="title-ft">ĐĂNG KÍ NHẬN THÔNG TIN</div>
                <div class="box-mail">
                  <form method="post" action="add-subscribe" class="mb-3">
                    <input type="text" name="email" placeholder="Nhập email">
                    <button type="submit" class="btn btn-primary">Gửi</button>
                  </form>

                  <div class="social">
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <a href="<?php echo @$themeSettings['facebook']; ?>">
                          <i class="bi bi-facebook"></i>
                        </a>
                      </li>

                      <li class="list-inline-item">
                        <a href="<?php echo @$themeSettings['youtube']; ?>">
                          <i class="bi bi-youtube"></i>
                        </a>
                      </li>

                      <li class="list-inline-item">
                        <a href="<?php echo @$themeSettings['tiktok']; ?>">
                          <i class="bi bi-tiktok"></i>
                        </a>
                      </li>

                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="item-ft">
                <div class="title-ft">Lượt truy cập</div>
                <div class="desc">
                  <?php 
                    if(function_exists('getStatic')){
                      $static= getStatic();
                      
                      echo '<ul class="rs list-unstyled f_ul">
                              <li class=""> Truy cập trong ngày: '.number_format($static['mday']).'</li>
                              <li class=""> Truy cập trong tháng: '.number_format($static['mon']).'</li>
                              <li class=""> Tổng lượt truy cập: '.number_format($static['total']).'</li>
                            </ul>';
                    }
                    ?>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="item-ft">
                <div class="title-ft">Bản đồ</div>
                <div class="maps">
                  <?php echo @($themeSettings['map']); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

<div class="goTop" style="display: block;">
  <i class="fa fa-chevron-up" aria-hidden="true"></i>
</div>



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo $urlThemeActive;?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="<?php echo $urlThemeActive;?>assets/vendor/aos/aos.js"></script>
  <script src="<?php echo $urlThemeActive;?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo $urlThemeActive;?>assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?php echo $urlThemeActive;?>assets/vendor/purecounter/purecounter.js"></script>
  <script src="<?php echo $urlThemeActive;?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo $urlThemeActive;?>assets/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo $urlThemeActive;?>assets/js/swiper.min.js"></script>
  <script src="<?php echo $urlThemeActive;?>assets/js/owl.carousel.js"></script>
  <script src="<?php echo $urlThemeActive;?>assets/js/main1.js"></script>
  <script src="<?php echo $urlThemeActive;?>assets/js/main.js"></script>
  <script src="<?php echo $urlThemeActive;?>assets/js/plugins.js"></script>

</body>
</html>