<?php
    global $urlThemeActive;
    global $settingThemes;
?>

<!-- footer -->
      <div class='mt-5 footer-container'>
        <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 pt-5 pb-5'>
          <div class='row'>
            <div class="col-lg-3 col-12 footer-frist-container d-flex flex-column">
              <div class='gap-3 d-flex align-items-center'>
                <div><img src="<?php echo @$settingThemes['image_logo']; ?>" alt="logo"></div>
              </div>
              <div class='mt-4 mb-3 bestnew-info'>
                <div class='gap-3 bn-contacts'>
                  <div class='bn-contact'>
                    <span><?php echo @$settingThemes['footer_address']; ?></span>
                  </div>
                  <div class='bn-contact'>
                    <span><?php echo @$settingThemes['footer_email']; ?></span>
                  </div>
                  <div class='bn-contact'>
                    <span><?php echo @$settingThemes['footer_phone_number']; ?></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="gap-3 text-white col-lg-3 col-6 d-flex flex-column footer-mid">
              <h2>VỀ MỘC MIÊN</h2>
              <span>Câu chuyện thương hiệu</span>
              <span>Về chúng tôi</span>
              <span>Liên hệ</span>
            </div>
            <div class="gap-3 text-white col-lg-3 col-6 d-flex flex-column footer-mid">
              <h2>CHÍNH SÁCH</h2>
              <span>Chính sách và quy định chung</span>
              <span>Chính sách và giao nhận thanh toán</span>
              <span>Chính sách đổi trả</span>
              <span>Điều khoản sử dụng</span>
            </div>
            <div class="gap-3 text-white col-lg-3 col-6 d-flex flex-column footer-mid">
              <h2>TẠI MỘC MIÊN</h2>
              <span>Quyền lợi thành viên</span>
              <span>Thông tin thành viên</span>
              <span>Theo dõi đơn hàng</span>
              <span>Hướng dẫn mua hàng Online</span>
              <div class='gap-2 d-flex'>
                <a href="<?php echo $settingThemes['instagram_link'] ?>" class='social-icon'><img src="<?= $urlThemeActive?>/assets/images/insta.png" alt="insta"></a>
                <a href="<?php echo $settingThemes['facebook_link'] ?>" class='social-icon'><img src="<?= $urlThemeActive?>/assets/images/fb.png" alt="fb"></a>
                <a href="<?php echo $settingThemes['linkedin_link'] ?>" class='social-icon'><img src="<?= $urlThemeActive?>/assets/images/linkedin.png" alt="linkedin"></a>
                <a href="<?php echo $settingThemes['youtube_link'] ?>" class='social-icon'><img src="<?= $urlThemeActive?>/assets/images/yt.png" alt="youtube"></a>
              </div>
            </div>
          </div>
          <h2 class='footer-slogant color-green'>MỘC MIÊN - ĐẸP THUẦN NHIÊN!</h2>
        </div>
      </div>
  </div>
</body>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: ".swiper-pagination",
      },
    });
  </script>
  <script src="<?php echo @$urlThemeActive; ?>scripts/index.js"></script>
</html>