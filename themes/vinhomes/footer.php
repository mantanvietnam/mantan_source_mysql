<?php
global $urlThemeActive;

$setting = setting();
?>
       <!-- Footer -->
       <div class="bg-[#FAF7F4] text-black font-plus overflow-hidden fade-in">
      <footer class="px-4 py-10 mx-auto md:py-20 sm:px-6 md:container xl:px-20">
        <div class="flex flex-col justify-between md:flex-row">
          <div class="mb-8 md:mb-0">
            <h2 class="flex items-center mb-4 text-lg font-bold">
            <img src="<?php echo $setting['image_logo'] ?>" alt="icon" class="h-8 mr-4" />
              MinhTuanVinhomes
            </h2>
            <div class="flex mb-4 space-x-4">
              <a href="<?php echo @$setting['instagram']; ?>" target="_blank"
                ><img src="<?= $urlThemeActive ?>image/icons/instagram.svg" alt="icon"
              /></a>
              <a href="<?php echo @$setting['facebook']; ?>" target="_blank"
                ><img src="<?= $urlThemeActive ?>image/icons/facebook.svg" alt="icon"
              /></a>
              <a href="<?php echo @$setting['linkedin']; ?>" target="_blank"
                ><img src="<?= $urlThemeActive ?>image/icons/linkedin.svg" alt="icon"
              /></a>
              <a href="<?php echo @$setting['youtube']; ?>" target="_blank"
              ><img src="<?= $urlThemeActive ?>image/icons/youtube.svg" alt="icon" /></a>
            </div>
            <address class="mb-4 space-y-2 not-italic">
                <p><?php echo @$setting['address']; ?></p>
                <p><?php echo @$setting['phone']; ?></p>
            <p><a href="mailto:<?php echo @$setting['responsibilityemail']; ?>"><?php echo @$setting['responsibilityemail']; ?></a></p>
            </address>
            <p>© 2024 Minhtuanvinhomes. All rights reserved.</p>
          </div>
          <div class="flex flex-col md:w-[50%]">
            <div>
              <h3 class="mb-4 text-xl font-bold sm:text-3xl text-[#142A72]">
                Xây dựng giấc mơ, giải pháp bất động sản
              </h3>
            </div>
            <div class="flex flex-col justify-between sm:flex-row md:w-[70%]">
              <div>
                <ul class="space-y-4">
                  <li>
                    <a href="#" class="hover:underline">Trang chủ</a>
                  </li>
                  <li>
                    <a href="#" class="hover:underline">Về MinhTuanVinhomes</a>
                  </li>
                  <li>
                    <a href="#" class="hover:underline">Danh sách dự án</a>
                  </li>
                  <li><a href="#" class="hover:underline">Liên hệ</a></li>
                </ul>
              </div>
              <div>
                <ul class="mt-4 space-y-4 sm:mt-0">
                  <li>
                    <a href="#" class="hover:underline"
                      >Lợi ích của khách hàng</a
                    >
                  </li>
                  <li>
                    <a href="#" class="hover:underline">Văn phòng làm việc</a>
                  </li>
                  <li>
                    <a href="#" class="hover:underline">Dịch vụ</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </body>
</html>
