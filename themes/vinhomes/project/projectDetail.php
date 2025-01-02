<?php 
    global $settingThemes;
    getHeader();
?>
    <style>
        .background-header{
          background-image: none !important;
        }
        .nav-projectpage a{
          color: black !important;
        }
        .setcolor {
          color: #333 !important;
        }
        .setcolor a{
          color: #333 !important;
        }
        .set-backgroundcontact{
          background-color: #182c77;
          
        }
    </style>
    <!-- Thông tin điều hướng , tên dự án -->
    <div class="py-4 mx-4 sm:mx-6 lg:mx-20 font-plus slide-right">
      <!-- Breadcrumb -->
      <div class="flex flex-wrap items-center space-x-2 text-sm text-gray-500">
        <i class="fas fa-chevron-left"></i>
        <a href="/" class="hover:underline hover:underline-offset-4"
          >Trang chủ</a
        >
        <span>/</span>
        <a href="#" class="hover:underline hover:underline-offset-4"
          ><?= $project['name'] ?></a
        >
        <span>/</span>
        <span class="text-[#142a72] font-bold">Phân khu: The Rainbow</span>
      </div>

      <!-- Title -->
      <h1 class="mt-4 text-lg font-bold sm:text-xl lg:text-2xl">
        Phân khu: The Rainbow – <?= $project['name'] ?>
      </h1>

      <!-- Address -->
      <p class="mt-4 text-sm text-gray-500 sm:text-base">
        <?= $project['address'] ?>
        <!-- <a href="" class="text-[#142a72] underline underline-offset-4 ml-2"
          >Xem bản đồ</a
        > -->
      </p>
    </div>

    <!-- Thư viện ảnh -->
    <div class="py-4 mx-4 sm:mx-6 lg:mx-20 font-plus slide-top">
      <div class="relative hidden sm:block">
        <button
          id="viewAllBtn"
          class="absolute px-4 py-2 text-[14px] text-white bg-black rounded-lg opacity-70 bottom-5 right-5 flex items-center"
        >
          <img src="<?= $urlThemeActive ?>image/icons/iconImage.png" alt="icon" class="h-4 mr-2" />
          Xem tất cả ảnh
        </button>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
        <?php if(!empty($project['images'][1])):?>
          <div class="col-span-1 row-span-2 md:col-span-2 max-h-[30rem]">
            <img
              src="<?= $project['images'][1] ?>"
              alt="Image 1"
              class="object-cover w-full h-full rounded-lg"
            />
          </div>
        <?php endif;?>
        <?php if(!empty($project['images'][2])):?>
          <div class="col-span-1 row-span-1 md:col-span-1">
            <img
              src="<?= $project['images'][2] ?>"
              alt="Image 2"
              class="object-cover w-full h-full rounded-lg"
            />
          </div>
        <?php endif;?>
        <?php if(!empty($project['images'][3])):?>
          <div class="col-span-1 row-span-1 md:col-span-1">
            <img
              src="<?= $project['images'][3] ?>"
              alt="Image 3"
              class="object-cover w-full h-full rounded-lg"
            />
          </div>
          <?php endif;?>
          <?php if(!empty($project['images'][4] )):?>
          <div class="col-span-2 row-span-1 md:col-span-2 max-h-[19rem]">
            <img
              src="<?= $project['images'][4] ?>"
              alt="Image 4"
              class="object-cover w-full h-full rounded-lg"
            />
          </div>
          <?php endif;?>
        </div>
      </div>

      <div class="block swiper mySwiper-image sm:hidden">
        <div class="swiper-wrapper">
          <?php foreach ($project['images'] as $image): ?>
            <div class="swiper-slide"> 
              <img
                src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>"
                alt="Project Image"
                class="rounded-lg"
              />
            </div>
          <?php endforeach; ?>
<!-- 
          <div class="swiper-slide">
            <img
              src="<?= $urlThemeActive ?>image/project/imgProject2.png"
              alt="Image 1"
              class="rounded-lg"
            />
          </div>
          <div class="swiper-slide">
            <img
              src="<?= $urlThemeActive ?>image/project/imgProject3.png"
              alt="Image 1"
              class="rounded-lg"
            />
          </div>
          <div class="swiper-slide">
            <img
              src="<?= $urlThemeActive ?>image/project/imgProject4.png"
              alt="Image 1"
              class="rounded-lg"
            />
          </div> -->
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>

    <!-- Modal ảnh -->
    <div
      id="imageModal"
      tabindex="-1"
      aria-hidden="true"
      class="fixed inset-0 z-50 hidden overflow-y-auto"
    >
      <div
        class="flex items-center justify-center min-h-screen px-4 text-center"
      >
        <div
          class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
          aria-hidden="true"
        ></div>
        <div
          class="w-[80%] overflow-hidden transition-all transform bg-white rounded-lg shadow-xl"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-title"
        >
          <div class="relative px-6 pt-5 pb-4 bg-white">
            <button
              type="button"
              class="absolute z-10 inline-flex justify-center px-4 py-2 font-bold text-white bg-red-600 rounded-md shadow-sm w-fit right-5 hover:bg-red-700"
              id="closeModal"
            >
              x
            </button>
            <div class="swiper mySwiper-image">
              <div class="swiper-wrapper">
              <?php foreach ($project['images'] as $image): ?>
                  <?php if (!empty($image)): // Kiểm tra nếu không rỗng ?>
                      <div class="swiper-slide">
                        <img
                          src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>"
                          alt="Image"
                          class="rounded-lg"
                        />
                      </div>
                  <?php endif; ?>
              <?php endforeach; ?>

                <!-- <div class="swiper-slide">
                  <img
                    src="<?= $urlThemeActive ?>image/project/imgProject2.png"
                    alt="Image 1"
                    class="rounded-lg"
                  />
                </div>
                <div class="swiper-slide">
                  <img
                    src="<?= $urlThemeActive ?>image/project/imgProject3.png"
                    alt="Image 1"
                    class="rounded-lg"
                  />
                </div>
                <div class="swiper-slide">
                  <img
                    src="<?= $urlThemeActive ?>image/project/imgProject4.png"
                    alt="Image 1"
                    class="rounded-lg"
                  />
                </div> -->
              </div>
              <div class="swiper-pagination"></div>
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Thanh lựa chọn tin -->
    <div class="py-4 mx-4 sm:mx-6 lg:mx-20 font-plus slide-top">
      <div
        class="flex space-x-8 heroSection-news-select font-bold pb-4 border-b-[0.5px] border-[#ccc] overflow-x-auto md:overflow-visible scroll-smooth whitespace-nowrap"
      >
        <a class="active" href="#overview">Tổng quan dự án</a>
        <!-- <a href="#layout">Mặt bằng</a>
        <a href="#location">Vị trí & Tiện ích cảnh quan</a>
        <a href="#faq">Câu hỏi thường gặp</a> -->
      </div>
    </div>

    <!-- Nội dung thông tin dự án -->
    <div class="py-4 mx-4 sm:mx-6 lg:mx-20 font-plus">
      <div class="flex flex-col justify-between lg:flex-row">
        <!-- Left -->
        <div class="w-full lg:w-[56%] xl:w-[66%] slide-right">
          <!-- Section 1 -->
          <div
            id="overview"
            class="mt-4 section"
            data-section="Tổng quan phân khu: The Rainbow"
          >
            <div class="toggle-content">
              <div
                class="flex items-center justify-between ml-[-6rem] pl-[6rem] py-4 pr-4 rounded-lg mb-4 bg-[#FFFAF1]"
              >
                <h1 class="text-xl font-bold text-blue-900">
                  Tổng quan phân khu: The Rainbow
                </h1>
                <button
                  class="font-semibold text-orange-500"
                  data-expanded="true"
                >
                  Rút gọn <span class="text-orange-500">−</span>
                </button>
              </div>
            </div>
            <div class="text-base leading-7 content">
              <p>
                <?= $project['subdivision'] ?>
              </p>

            </div>
          </div>

          <!-- Section 2 -->
          <div id="layout" class="mt-4 section" data-section="Mặt bằng">
            <div class="toggle-content">
              <div
                class="flex items-center justify-between ml-[-6rem] pl-[6rem] py-4 pr-4 rounded-lg mb-4 bg-[#FFFAF1]"
              >
                <h1 class="text-xl font-bold text-blue-900">Mặt bằng</h1>
                <button
                  class="font-semibold text-orange-500"
                  data-expanded="true"
                >
                  Rút gọn <span class="text-orange-500">−</span>
                </button>
              </div>
            </div>
            <div class="text-base leading-7 content">
              <p>
                <?= $project['premises'] ?>
              </p>
            </div>
          </div>

          <!-- Section 3 -->
          <div
            id="location"
            class="mt-4 section"
            data-sectio="Tiện ích cảnh quan"
          >
            <div class="toggle-content">
              <div
                class="flex items-center justify-between ml-[-6rem] pl-[6rem] py-4 pr-4 rounded-lg mb-4 bg-[#FFFAF1]"
              >
                <h1 class="text-xl font-bold text-blue-900">
                  Tiện ích cảnh quan
                </h1>
                <button
                  class="font-semibold text-orange-500"
                  data-expanded="true"
                >
                  Rút gọn <span class="text-orange-500">−</span>
                </button>
              </div>
            </div>
            <div class="text-base leading-7 content">
              <p>
              <?= $project['landscape'] ?>
              </p>

            <?php if(!empty($project['map'])):?>
            <div class="flex justify-center mt-4">
                    <iframe src="<?= $project['map'] ?>"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
              </div>
            <?php endif;?>

              <!-- <div
                class="flex mt-4 space-x-6 sm:space-x-0 sm:justify-between heroSection-location-select font-bold pb-4 border-b-[0.5px] border-[#ccc] overflow-x-auto md:overflow-visible scroll-smooth whitespace-nowrap"
              >
                <a
                  class="text-blue-700 tab-link active"
                  href="#"
                  data-tab="school"
                  >Trường học</a
                >
                <a class="tab-link" href="#" data-tab="entertainment"
                  >Giải trí</a
                >
                <a class="tab-link" href="#" data-tab="shopping">Mua sắm</a>
                <a class="tab-link" href="#" data-tab="restaurant">Nhà hàng</a>
                <a class="tab-link" href="#" data-tab="park">Công viên</a>
                <a class="tab-link" href="#" data-tab="hospital">Bệnh viện</a>
              </div> -->
<!-- 
              <div id="tab-content" class="max-w-4xl mt-4">
          
              </div> -->
            </div>
          </div>

          <!-- Section 4 -->
          <!-- <div
            id="faq"
            class="mt-4 section"
            data-section="Câu hỏi hỏi thường gặp"
          >
            <div class="toggle-content">
              <div
                class="flex items-center justify-between ml-[-6rem] pl-[6rem] py-4 pr-4 rounded-lg mb-4 bg-[#FFFAF1]"
              >
                <h1 class="text-xl font-bold text-blue-900">
                  Câu hỏi hỏi thường gặg
                </h1>
                <button
                  class="font-semibold text-orange-500"
                  data-expanded="true"
                >
                  Rút gọn <span class="text-orange-500">−</span>
                </button>
              </div>
            </div>
            <div class="text-base leading-7 content">
              <p>Câu hỏi 1 ?</p>
              <p>Câu trả lời 1</p>
            </div>
          </div> -->
        </div>

        <!-- Right -->
        <div class="slide-left">
          <div class="w-full p-6 bg-white rounded-lg shadow-lg lg:max-w-sm">
            <div class="flex justify-center mb-4">
              <img
                alt="Vin Homes logo"
                class="h-24"
                src="<?= $urlThemeActive ?>image/heroSection/logoVin.png"
              />
            </div>
            <h2 class="mb-4 text-lg font-semibold text-center">
              Liên hệ tư vấn với chuyên gia
            </h2>
            <ul class="mb-4 space-y-2 text-[#64748B]">
              <li class="flex items-center">
                <i class="mr-2 text-yellow-500 fas fa-check-circle text-[20px]">
                </i>
                <span>
                  Tư vấn quỹ căn, chính sách của Khách hàng để có lựa chọn căn
                  tốt nhất
                </span>
              </li>
              <li class="flex items-center">
                <i class="mr-2 text-yellow-500 fas fa-check-circle text-[20px]">
                </i>
                <span> Bảo mật thông tin của khách hàng </span>
              </li>
              <li class="flex items-center">
                <i class="mr-2 text-yellow-500 fas fa-check-circle text-[20px]">
                </i>
                <span> Giải đáp mọi thắc mắc của khách hàng </span>
              </li>
            </ul>
            <form action="/contact"  class="space-y-4" method="post">
              <input
                id="full-name"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Họ và tên" name="name"required
                type="text"
              />
              <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
              <input
                class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Địa chỉ Email" name="email" value=" " 
                type="hidden"
              />
              <input type="hidden" placeholder="" name="subject" value="Người liên hệ">
              <input
                id="phone-number"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Số điện thoại" name="phone"required
                type="text"
              />
              <input
                class="w-full h-32 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Lời nhắn của bạn" name="content" value = "Đăng ký tư vấn bật động sản <?=$project['name']?>" type="hidden"
              ></input>
              <button class="w-full py-2 rounded-lg buttonActive" type="submit">
                Đăng ký tư vấn
              </button>
            </form>

            <div class="flex items-center my-4">
              <hr class="flex-grow border-t border-gray-300" />
              <span class="px-2 text-gray-500"> Hoặc </span>
              <hr class="flex-grow border-t border-gray-300" />
            </div>
            <div class="space-y-2">
              <button
                class="flex items-center justify-center w-full py-2 text-gray-700 border rounded-lg hover:bg-gray-100"
              >
                <img
                  src="<?= $urlThemeActive ?>image/icons/iconCall.svg"
                  alt="icon"
                  class="h-6 mr-2"
                />
                Gọi 0123 456 789
              </button>
              <button
                class="flex items-center justify-center w-full py-2 text-gray-700 border rounded-lg hover:bg-gray-100"
              >
                <img
                  src="<?= $urlThemeActive ?>image/icons/iconZalo.png"
                  alt="icon"
                  class="h-6 mr-2"
                />
                Tư vấn qua Zalo
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Dự án bất động sản khác -->
    <div class="relative min-h-screen font-plus slide-top">
  <div class="px-4 py-10 mx-auto md:py-20 sm:px-6 md:container xl:px-20">
    <div class="flex items-center justify-between mb-8">
      <div class="w-[60%] md:w-auto">
        <h1 class="text-2xl font-bold md:text-4xl text-[#142A72]">
          Dự án bất động sản khác
        </h1>
      </div>
      <button class="flex items-center px-6 py-4 rounded-xl bg-[#E2E8F0] text-[#142A72] transition duration-300 hover:bg-[#CBD5E1] hover:text-[#0F172A]">
        <a href="/projects" style="text-decoration:none">Xem tất cả</a>
        <i class="ml-2 fas fa-arrow-right"></i>
      </button>
    </div>

    <!-- <div class="flex mb-8 space-x-8 heroSection-news-select pb-4 border-b-[0.5px] border-[#ccc] overflow-x-auto md:overflow-visible scroll-smooth whitespace-nowrap">
      <a class="active" href="#" data-tab="house">Nhà ở</a>
      <a href="#" data-tab="villa">Biệt thự</a>
      <a href="#" data-tab="apartment">Căn hộ</a>
      <a href="#" data-tab="room">Phòng cho thuê</a>
      <a href="#" data-tab="office">Văn phòng</a>
      <a href="#" data-tab="hotel">Khách sạn</a>
      <a href="#" data-tab="land">Khu đất dự án</a>
    </div> -->

    <div class="swiper mySwiper mySwiper-Projects">
      <div class="swiper-wrapper" id="swiper-wrapper">
        <!-- Slide 1 -->
        <?php if(!empty($listDataproduct_projects)){
          foreach($listDataproduct_projects as $item){ ?>
            <div class="swiper-slide" data-tab="<?= $item->id_kind ?>">
              <a href="<?php echo @$item->slug ?>.html">
                <div class="relative">
                  <img alt="Modern house with large windows and landscaped garden" class="object-cover w-full h-[440px] rounded-lg" src="<?= $item->image?>">
                  <div class="absolute text-white py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4" style="background: linear-gradient(90deg, #182c77 0%, #6274bb 100%);">
                    <?= $item->info ?>
                  </div>
                </div>
                <h2 class="mt-4 text-xl font-bold"><?= $item->name ?></h2>
                <!-- <div class="flex items-center mt-2 font-bold">
                  <p class="mr-2">Phân khu:</p>
                  <p class="underline underline-offset-4 text-[#142A72]">The Rainbow</p>
                </div> -->
                <div class="flex items-center mt-2 font-bold">
                  <p class="mr-2">Tổng diện tích:</p>
                  <p class="underline underline-offset-4 text-[#142A72]"><?= $item->acreage ?></p>
                </div>
                <p class="mt-2 text-gray-400 description"><?= $item->description ?></p>
              </a>
            </div>
        <?php }} ?>
      </div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>

  </div>
</div>

    <!-- Liên hệ -->
    <div
      class="relative bg-center bg-cover font-plus slide-top"
      style="background-image: url('<?= $urlThemeActive ?>image/index/imageQS2.png')"
    >
      <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>
      <div
        class="relative z-10 flex flex-col justify-between px-4 py-10 text-white md:flex-row md:py-20 sm:px-6 xl:px-20"
      >
        <div class="md:w-[45%]">
          <h1 class="mb-4 text-4xl font-bold">
            MinhTuanVinhomes - Chung tay xây dựng cộng đồng Vinhomes
          </h1>
          <p class="mb-8 text-lg">
            Hãy để chúng tôi trở thành cầu nối giúp bạn đến gần hơn với cuộc
            sống thượng lưu tại các quần thể đô thị Vinhomes.
          </p>
        </div>
        <form method="post" action="/contact" class="p-8 text-gray-800 bg-white rounded-lg shadow-lg md:w-[50%]">
            <div class="mb-4">
              <input
                class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Họ và tên" name="name" required
                type="text"
              />
              <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
            </div>
            <div class="mb-4">
              <input
                class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Số điện thoại" name="phone" required
                type="text"
              />
            </div>
            <div class="mb-4">
              <input
                class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Địa chỉ Email" name="email" required
                type="email"
              />
              <input type="hidden" placeholder="" name="subject" value=" ">
            </div>
            <div class="mb-4">
              <textarea
                class="w-full h-32 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Lời nhắn của bạn" name="content" required
              ></textarea>
            </div>
            <button
              class="w-full p-4 text-white transition duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 hover:scale-105 hover:shadow-lg"
              type="submit"
              style="background: linear-gradient(90deg, #182c77 0%, #6274bb 100%)"
            >
              Submit
            </button>
        </form>
      </div>
    </div>


    <?php getFooter();?>
