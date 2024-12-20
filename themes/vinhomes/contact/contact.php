<?php
global $urlThemeActive;
global $isHome;
$setting = setting();
getHeader();
?>
<section id="lien-he">
<div
      class="relative bg-center bg-cover font-plus slide-bottom"
      style="background-image: url('<?= $urlThemeActive ?>image/contact/bgContact.jpg')"
    >
      <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>
      <div
        class="relative z-10 flex flex-col justify-between px-4 py-10 text-white md:py-20 sm:px-6 xl:px-20"
      >
        <div class="w-auto">
          <h1 class="mb-4 text-4xl font-bold">
          <?php echo @$setting['nameContact']; ?>
          </h1>
          <p class="mb-8 text-lg">
          <?php echo @$setting['contentContact']; ?>
          </p>
        </div>
        <form action="" method = "post"
          class="grid w-full grid-cols-1 gap-4 text-gray-800 sm:grid-cols-2"
        >
        <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
        <div class="contact-form">
          <!-- Họ và tên -->
          <div class="relative col-span-2 sm:col-span-1">
            <input
              class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Họ và tên *"
              type="text"
              value="" name="name"
            />
          </div>

          <!-- Mục đích sử dụng BĐS -->
          <div class="relative col-span-2 sm:col-span-1">
            <input
              class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Mục đích sử dụng BĐS"
              type="text"
              value="" name="subject"
            />
          </div>

          <!-- Số điện thoại -->
          <div class="relative col-span-2 sm:col-span-1">
            <input
              class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Số điện thoại *"
              type="text"
              value="" name="phone_number"
            />
          </div>

          <!-- Địa chỉ Email -->
          <div class="relative col-span-2 sm:col-span-1">
            <input
              class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Địa chỉ Email"
              type="email"
              value="" name="email"
            />
          </div>

          <!-- Lời nhắn -->
          <div class="relative col-span-2">
            <textarea
              class="w-full h-32 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Lời nhắn của bạn *"
              value="" name="content"
            ></textarea>
          </div>

          <!-- Gửi yêu cầu -->
          <button
            class="col-span-2 p-4 text-white bg-gradient-to-r from-[#182c77] to-[#6274bb] transition-all duration-300 rounded-lg sm:col-span-1 hover:from-[#6274bb] hover:to-[#182c77] hover:shadow-lg"
            type="submit"
          >
            Gửi yêu cầu tư vấn
          </button>

          <!-- Chính sách bảo mật -->
          <p class="col-span-2 mt-2 text-sm text-white sm:col-span-1">
            Bằng việc gửi yêu cầu tư vấn, bạn đồng ý với Chính sách bảo mật của
            chúng tôi và đồng ý được MinhTuanVinhomes liên hệ hỗ trợ.
          </p>
        </div>
        </form>
      </div>
    </div>

    <!-- thông tin liên hệ -->
    <div
      class="max-w-4xl px-4 py-16 mx-auto text-center sm:px-6 lg:px-8 slide-bottom"
    >
      <h2 class="text-lg font-semibold text-[#142a72]">
      <?php echo @$setting['nameContactFooter']; ?> <span class="text-yellow-500">Vinhomes</span>
      </h2>
      <p class="mt-4 text-[#64748B]">
        <?php echo @$setting['contentContactFooter']; ?>
      </p>

      <div class="flex justify-center">
        <div
          class="h-[1.5px] mt-8 w-[50%]"
          style="background: linear-gradient(90deg, #ba823a 0%, #e9a822 100%)"
        ></div>
      </div>
      <div class="mt-8">
        <h3 class="text-base font-semibold text-[#142a72]">
          THÔNG TIN LIÊN HỆ
        </h3>
        <div class="mt-4">
          <p class="font-bold">
            Hotline tư vấn dịch vụ:
            <span class="font-medium text-[#64748B]"><?php echo $contactSite['phone'];?></span>
          </p>
          <p class="font-bold">
            Email tư vấn dịch vụ:
            <span class="font-medium text-[#64748B]"
              ><?php echo $contactSite['email'];?></span
            >
          </p>
          <p class="font-bold">
            Địa chỉ văn phòng:
            <span class="font-medium text-[#64748B]"
              ><?php echo $contactSite['address'];?></span
            >
          </p>
        </div>
      </div>
    </div>
    </section>
    <?php
getFooter();