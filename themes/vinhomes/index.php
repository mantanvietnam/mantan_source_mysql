<?php 
    global $urlThemeActive;
    global $isHome;
    $setting = setting();
    getHeader();
?>
      <!-- Nội dung chính -->
      <div class="absolute bottom-[-22%] z-10 w-full">
        <div
          class="flex flex-col items-center justify-center px-4 py-20 text-center text-white"
        >
          <div class="w-full max-w-4xl">
            <div class="flex font-plus">
              <button
                id="realEstateSaleButton"
                class="py-2 mr-2 text-gray-600 transition-transform duration-300 ease-in-out bg-white rounded-t-lg active x-2 sm:px-8 property-button active:scale-95 hover:bg-gray-100 hover:shadow-md"
              >
                Nhà đất bán
              </button>
              <button
                id="realEstateRentButton"
                class="px-2 py-2 mr-2 text-gray-600 transition-transform duration-300 ease-in-out bg-white rounded-t-lg sm:px-8 property-button hover:bg-gray-100 hover:shadow-md active:scale-95"
              >
                Nhà đất thuê
              </button>
              <button
                id="projectsButton"
                class="px-2 py-2 text-gray-600 transition-transform duration-300 ease-in-out bg-white rounded-t-lg sm:px-8 property-button hover:bg-gray-100 hover:shadow-md active:scale-95"
              >
                Dự án
              </button>
            </div>

            <div
              class="w-full max-w-4xl p-2 bg-white rounded-lg rounded-tl-none shadow-lg sm:p-6"
            >
              <div
                class="flex flex-col items-center justify-between pb-4 border-b font-roboto md:flex-row"
              >
                <div class="flex md:w-[80%] mb-4 md:mb-0">
                  <div class="flex items-center md:w-[30%] p-2 text-gray-600">
                    <img
                      alt="Logo"
                      src="<?= $urlThemeActive ?>image/icons/iconHome.png"
                      width="16"
                    />
                    <select
                      id="projectSelect"
                      class="w-full ml-4 bg-transparent cursor-pointer focus:outline-none"
                    >
                      <option value="default" selected>Dự án</option>
                      <option value="nha-ban">Nhà bán</option>
                      <option value="nha-thue">Nhà thuê</option>
                      <option value="khac">Khác</option>
                    </select>
                  </div>
                  <div class="w-[0.5px] h-10 bg-[#DFDFDF] mx-4"></div>
                  <div class="flex items-center p-2 w-[60%] text-black">
                    <img
                      alt="Logo"
                      src="<?= $urlThemeActive ?>image/icons/iconSearch.png"
                      width="16"
                      class="mr-2"
                    />
                    <input
                      id="searchInput"
                      class="w-full bg-transparent focus:outline-none"
                      placeholder="Tìm kiếm dự án"
                      type="text"
                    />
                  </div>
                </div>
                <button
                  id="searchButton"
                  class="px-12 py-2 text-white rounded-lg bg-gradient-to-r from-[#182c77] to-[#6274bb] hover:from-[#6274bb] hover:to-[#182c77] active:scale-95 focus:ring-4 focus:ring-[#6274bb]/50 transition-transform duration-300 ease-in-out"
                >
                  Tìm kiếm
                </button>
              </div>
              <div
                class="flex flex-col items-center justify-between mt-2 space-y-4 text-gray-600 font-roboto md:flex-row md:space-y-0 md:space-x-4"
              >
                <div class="flex items-center w-full p-2 md:w-auto">
                  <span class="mr-2 text-gray-500"> Bộ lọc tìm kiếm </span>
                </div>
                <div
                  class="flex pace-x-0 sm:space-x-2 md:space-x-6 md:w-[60%] justify-end"
                >
                  <div class="flex items-center w-full p-2 md:w-[24%]">
                    <select
                      id="typeSelect"
                      class="w-full bg-transparent cursor-pointer focus:outline-none"
                    >
                      <option value="default" selected>Loại hình</option>
                      <option value="nha-ban">Nhà bán</option>
                      <option value="nha-thue">Nhà thuê</option>
                      <option value="can-ho">Căn hộ</option>
                    </select>
                  </div>
                  <div class="flex items-center w-full p-2 md:w-[24%]">
                    <select
                      id="priceSelect"
                      class="bg-transparent cursor-pointer focus:outline-none"
                    >
                      <option value="default" selected>Khoảng giá</option>
                      <option value="duoi-1-ty">Dưới 1 tỷ</option>
                      <option value="1-2-ty">1 - 2 tỷ</option>
                      <option value="tren-2-ty">Trên 2 tỷ</option>
                    </select>
                  </div>
                  <div class="flex items-center w-full p-2 md:w-[24%]">
                    <select
                      id="sizeSelect"
                      class="bg-transparent cursor-pointer focus:outline-none"
                    >
                      <option value="default" selected>Diện tích</option>
                      <option value="duoi-50m2">Dưới 50m²</option>
                      <option value="50-100m2">50 - 100m²</option>
                      <option value="tren-100m2">Trên 100m²</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Thông tin nhà bđs -->
    <div
      class="px-4 py-10 mx-auto mt-28 sm:mt-20 md:py-20 sm:px-6 md:container xl:px-20"
    >
      <div class="flex flex-col items-center lg:flex-row slide-right">
        <div class="lg:w-1/2">
          <h1 class="text-2xl font-bold text-blue-900"><?php echo @$setting['title_introduce_1']; ?></h1>
          <h2 class="flex items-center text-2xl font-bold text-blue-900">
          <?php echo @$setting['title_introduce_2']; ?>
            <img
              alt="Vinhomes logo"
              class="ml-2"
              height="40"
              src="<?php echo @$setting['logo_introduce']; ?>"
              width="100"
            />
          </h2>
          <p class="mt-4 text-lg text-blue-900">
          <?php echo @$setting['content1_introduce']; ?>
          </p>
          <p class="mt-4 text-gray-700">
          <?php echo @$setting['content2_introduce']; ?>
          </p>
          <p class="mt-4 text-gray-700">
          <?php echo @$setting['content3_introduce']; ?>
          </p>
          <button
            class="px-6 py-2 mt-6 text-white transition duration-300 bg-blue-900 rounded-full shadow-lg hover:bg-blue-700"
          >
            <a href="/contact">Liên hệ tư vấn</a>
          </button>
        </div>
        <div class="relative mt-6 lg:w-1/2 lg:mt-0 lg:ml-6 slide-left">
          <div class="relative flex justify-center">
            <img
              alt="Person standing in front of a building"
              class="w-[60%] md:w-auto"
              src="<?php echo @$setting['image_introduce']; ?>"
            />
          </div>
        </div>
      </div>
    </div>

    <!-- Các dự án bất động sản -->
    <div
      class="relative min-h-screen text-white bg-center bg-cover font-plus lg:bg-left lg:bg-left-top slide-top"
      style="background-image: url('<?= $urlThemeActive ?>image/index/bgQuickSearch.png')"
    >
      <div class="px-4 py-10 mx-auto md:py-20 sm:px-6 md:container xl:px-20">
        <div class="flex items-center justify-between mb-8">
          <div class="w-[60%] md:w-auto">
            <h1 class="text-2xl font-bold md:text-4xl">
              Các dự án nổi bật hiện tại
            </h1>
            <p class="mt-2 text-gray-400">
              MinhTuanVinhomes cung cấp nhiều dự án bất động sản mà nhiều người
              mong muốn kiếm tìm
            </p>
          </div>
          <button
            class="flex items-center px-6 py-4 text-gray-900 transition duration-300 ease-in-out transform bg-white rounded-xl hover:bg-gray-100 hover:scale-105 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50"
          >
            <a href="/projects">Xem tất cả</a>
            <i class="ml-2 fas fa-arrow-right"></i>
          </button>
        </div>
        <!-- <div
          class="flex mb-8 space-x-8 heroSection-project-select pb-4 border-b-[0.5px] border-[#fff] overflow-x-auto md:overflow-visible scroll-smooth whitespace-nowrap"
        >
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
            <?php if(!empty($listDataproject)){
              foreach($listDataproject as $item){ ?>
                <div class="swiper-slide" data-tab="<?= $item->id_kind ?>">
                  <a href="/project/<?php echo @$item->slug ?>.html">
                    <div class="relative">
                      <img alt="Modern house with large windows and landscaped garden" class="object-cover w-full h-[440px] rounded-lg" src="<?= $item->image?>">
                      <div class="absolute text-white py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4" style="background: <?= $item->color ?>">
                        <?= $item->info ?>
                      </div>
                    </div>
                    <h2 class="mt-4 text-xl font-bold"><?= $item->name ?></h2>
                    <div class="flex items-center mt-2 text-[#fff] font-bold">
                      <img
                        src="<?= $urlThemeActive ?>image/icons/iconLocation.png"
                        alt="icon"
                        class="h-6 mr-2"
                      />
                      <?php echo $item->address; ?>
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

    <!-- Các dự án trọng điểm -->
    <div class="relative min-h-screen font-plus">
      <div
        class="px-4 py-10 mx-auto md:py-20 sm:px-6 md:container xl:px-20 fade-in"
      >
        <div class="flex items-center justify-between mb-8">
          <div class="w-[60%] md:w-auto">
            <h1 class="text-2xl font-bold md:text-4xl text-[#142A72]">
              Các dự án trọng điểm
            </h1>
            <p class="mt-2 text-[#64748B]">
              Những dự án được lượng lớn khách hàng quan tâm và có xu hướng phát
              triển trong tương lai
            </p>
          </div>
          <button
            class="flex items-center px-6 py-4 text-white rounded-xl bg-gradient-to-r from-[#182c77] to-[#6274bb] transition-transform duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg"
          >
            <a href="/projects">Xem tất cả</a>
            <i class="ml-2 fas fa-arrow-right"></i>
          </button>
        </div>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        <?php if (!empty($listDataprojectkeypoint[0])): ?>
          <a href="/project/<?=$listDataprojectkeypoint[0]->slug?>.html" class="rounded-lg">
            <div class="relative overflow-hidden rounded-lg">
              <img
                alt="Modern house with large windows and landscaped garden"
                class="object-cover w-full h-[440px] rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
                src="<?=$listDataprojectkeypoint[0]->image?>"
              />
              <div
                class="absolute text-sm text-white bg-[#239A3D] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
              >
                <?=$listDataprojectkeypoint[0]->info?>
              </div>
            </div>

            <h2 class="mt-4 text-xl font-bold"> <?=$listDataprojectkeypoint[0]->name?></h2>
            <!-- <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Phân khu:</p>
              <p class="underline underline-offset-4 text-[#142A72]">
                The Rainbow
              </p>
            </div> -->
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Tổng diện tích:</p>
              <p class="underline underline-offset-4 text-[#142A72]"> <?=$listDataprojectkeypoint[0]->acreage?></p>
            </div>
            <p class="mt-2 text-gray-400 description">
              <?=$listDataprojectkeypoint[0]->description?>
            </p>
          </a>
        <?php endif; ?>
        <?php if (!empty($listDataprojectkeypoint[1])): ?>
          <a href="detailProject.html" class="rounded-lg">
            <div class="relative overflow-hidden rounded-lg">
              <img
                alt="Modern house with large windows and landscaped garden"
                class="object-cover w-full h-[440px] rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
                src="<?= $urlThemeActive ?>image/index/imageQS2.png"
              />
              <div
                class="absolute text-sm text-white bg-[#E04444] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
              >
                <?=$listDataprojectkeypoint[1]->info?>
              </div>
            </div>

            <h2 class="mt-4 text-xl font-bold"><?=$listDataprojectkeypoint[1]->name?></h2>
            <!-- <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Phân khu:</p>
              <p class="underline underline-offset-4 text-[#142A72]">
                The Rainbow
              </p>
            </div> -->
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Tổng diện tích:</p>
              <p class="underline underline-offset-4 text-[#142A72]"><?=$listDataprojectkeypoint[1]->acreage?></p>
            </div>
            <p class="mt-2 text-gray-400 description">
              <?=$listDataprojectkeypoint[1]->description?>
            </p>
          </a>
          <?php endif; ?>
          <?php if (!empty($listDataprojectkeypoint[2])): ?>
          <a href="detailProject.html" class="rounded-lg">
            <div class="relative overflow-hidden rounded-lg">
              <img
                alt="Modern house with large windows and landscaped garden"
                class="object-cover w-full h-[440px] rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
                src="<?= $urlThemeActive ?>image/index/imageQS3.png"
              />
              <div
                class="absolute text-white text-sm bg-[#239A3D] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
              >
                <?=$listDataprojectkeypoint[2]->info?>
              </div>
            </div>

            <h2 class="mt-4 text-xl font-bold"><?=$listDataprojectkeypoint[2]->name?></h2>
            <!-- <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Phân khu:</p>
              <p class="underline underline-offset-4 text-[#142A72]">
                The Rainbow
              </p>
            </div> -->
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Tổng diện tích:</p>
              <p class="underline underline-offset-4 text-[#142A72]"><?=$listDataprojectkeypoint[2]->acreage?></p>
            </div>
            <p class="mt-2 text-gray-400 description">
              <?=$listDataprojectkeypoint[2]->description?>
            </p>
          </a>
          <?php endif; ?>
        </div>

        <div class="h-[1px] bg-[#DADADA] my-10"></div>

        <div
          class="flex flex-col md:flex-row md:items-center lg:justify-between"
        >
          <div class="flex items-center mb-4 text-lg font-semibold md:mb-0">
            Được quan tâm nhất

            <a href="#" class="flex md:hidden">
              <img
                src="<?= $urlThemeActive ?>image/icons/iconAll.png"
                alt="icon"
                class="h-10 ml-4"
              />
            </a>
          </div>
          <div class="flex flex-wrap gap-4 md:ml-12 w-fit lg:w-auto">
            <div class="bg-[#676DFF1A] px-6 py-2 rounded-full text-[#142A72]">
            <?php echo @$setting['care_about_1']; ?>
            </div>
            <div class="bg-[#676DFF1A] px-6 py-2 rounded-full text-[#142A72]">
            <?php echo @$setting['care_about_2']; ?>
            </div>
            <div class="bg-[#676DFF1A] px-6 py-2 rounded-full text-[#142A72]">
            <?php echo @$setting['care_about_3']; ?>
            </div>
            <div class="bg-[#676DFF1A] px-6 py-2 rounded-full text-[#142A72]">
            <?php echo @$setting['care_about_4']; ?>
            </div>
          </div>
          <!-- <a href="/projects" class="hidden md:flex">
            <img src="<?= $urlThemeActive ?>image/icons/iconAll.png" alt="icon" class="h-10" />
          </a> -->
        </div>
      </div>
    </div>

    <!-- Lý do tìm đến -->
    <div
      class="px-4 py-10 mx-auto md:py-20 sm:px-6 md:container xl:px-20 font-plus slide-bottom"
    >
      <div class="flex flex-col items-center justify-between lg:flex-row">
        <div class="flex flex-col md:flex-row md:space-x-4">
          <div class="relative w-[60%] md:w-auto justify-center">
            <img
              alt="Children playing in a park with high-rise buildings in the background"
              class="rounded-lg"
              height="300"
              src="<?php echo @$setting['image1_news_hot']; ?>"
              width="400"
            />
            <img
              alt="High-rise residential building with a scenic view"
              class="rounded-lg mt-[-40px] ml-[80px]"
              height="300"
              src="<?php echo @$setting['image2_news_hot']; ?>"
              width="400"
            />
          </div>
        </div>
        <div class="mt-6 lg:mt-0 lg:ml-6 w-auto lg:w-[50%]">
          <h2
            class="mb-2 text-lg font-bold text-gray-800 sm:text-4xl text-[#142A72]"
          >
          <?php echo @$setting['title_why_choose']; ?>
            <span class="text-yellow-500">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </span>
          </h2>
          <ul class="space-y-2 text-gray-700">
            <li>
              <i class="text-yellow-500 fas fa-check"></i> <?php echo @$setting['content1_why_choose']; ?>
            </li>
            <li>
              <i class="text-yellow-500 fas fa-check"></i> <?php echo @$setting['content2_why_choose']; ?>
            </li>
            <li>
              <i class="text-yellow-500 fas fa-check"></i> <?php echo @$setting['content3_why_choose']; ?>
            </li>
            <li>
              <i class="text-yellow-500 fas fa-check"></i> <?php echo @$setting['content4_why_choose']; ?>
            </li>
            <li>
              <i class="text-yellow-500 fas fa-check"></i><?php echo @$setting['content55_why_choose']; ?>
            </li>
          </ul>
          <button
            class="px-6 py-2 mt-4 text-white rounded-lg shadow-lg bg-gradient-to-r from-[#182c77] to-[#6274bb] transition-all duration-300 ease-in-out hover:scale-105 hover:shadow-2xl hover:bg-gradient-to-r hover:from-[#6274bb] hover:to-[#182c77]"
          >
            Giới thiệu về công ty
          </button>
        </div>
      </div>
    </div>

    <!-- Tin tức hoạt động  -->
    <div class="relative min-h-screen font-plus fade-in">
      <div class="px-4 py-10 mx-auto md:py-20 sm:px-6 md:container xl:px-20">
        <div class="flex items-center justify-between mb-8">
          <div class="w-[60%] md:w-auto">
            <h1 class="text-2xl font-bold md:text-4xl text-[#142A72]">
              Tin tức - Hoạt động
            </h1>
          </div>
          <button
            class="flex items-center px-6 py-4 rounded-xl bg-[#E2E8F0] text-[#142A72] transition-all duration-300 ease-in-out hover:bg-[#6274bb] hover:text-white hover:scale-105 hover:shadow-lg"
          >
            <a href="/posts">Xem tất cả</a>
            <i class="ml-2 fas fa-arrow-right"> </i>
          </button>
        </div>

        <!-- Tabs -->
        <?php
          $order = array('view' => 'desc');
          $mostViewedPosts = $modelPosts->find()
              ->limit(4)
              ->page(1)
              ->order($order)
              ->all()
              ->toList();
        ?> 

        <div class="flex-col hidden lg:flex lg:flex-row">
            <?php foreach ($mostViewedPosts as $index => $post): ?>
                <?php if ($index == 0): ?>
                    <a href="/<?php echo $post->slug; ?>.html" class="mr-6 overflow-hidden">
                        <div class="relative overflow-hidden rounded-lg">
                            <img
                                alt="<?php echo $post->title; ?>"
                                class="object-cover w-full transition-all duration-300 ease-in-out transform rounded-lg h-96 hover:scale-105"
                                src="<?php echo $post->image; ?>"
                            />
                        </div>
                        <div class="pt-2">
                            <h2 class="mb-2 text-2xl font-bold">
                                <?php echo $post->title; ?>
                            </h2>
                            <p class="mb-4 text-gray-600">
                                <?php echo $post->description; ?>
                            </p>
                            <div class="flex items-center">
                                <div class="text-sm">
                                    <p class="text-gray-600"><?php echo $post->author; ?> - <?php echo date("d/m/Y", $post->time); ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php else: ?>
                    <?php if ($index == 1): ?>
                        <div class="flex flex-col space-y-4">
                    <?php endif; ?>
                        <a href="/<?php echo $post->slug; ?>.html" class="flex overflow-hidden">
                            <div class="relative w-full overflow-hidden rounded-lg">
                                <img
                                    alt="<?php echo $post->title; ?>"
                                    class="object-cover w-full transition-all duration-300 ease-in-out transform rounded-lg h-44 hover:scale-105"
                                    src="<?php echo $post->image; ?>"
                                />
                            </div>
                            <div class="pl-4 w-[90%]">
                                <h3 class="mb-2 text-lg font-bold description-news">
                                    <?php echo $post->title; ?>
                                </h3>
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <p class="text-gray-600"><?php echo $post->author; ?> - <?php echo date("d/m/Y", $post->time); ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if (count($mostViewedPosts) > 1): ?>
                    </div>
                <?php endif; ?>
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