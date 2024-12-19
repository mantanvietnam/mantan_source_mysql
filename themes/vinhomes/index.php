<?php
getHeader();
global $urlThemeActive;
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
          <h1 class="text-2xl font-bold text-blue-900">MinhTuanVinhomes:</h1>
          <h2 class="flex items-center text-2xl font-bold text-blue-900">
            Phân phối bất động sản
            <img
              alt="Vinhomes logo"
              class="ml-2"
              height="40"
              src="<?= $urlThemeActive ?>image/heroSection/logoVin.png"
              width="100"
            />
          </h2>
          <p class="mt-4 text-lg text-blue-900">
            Hân hạnh là cầu nối giúp khách hàng chạm tới những giá trị sống của
            tương lai
          </p>
          <p class="mt-4 text-gray-700">
            Tôi là một chuyên viên bất động sản đầy nhiệt huyết và giàu kinh
            nghiệm, hiện đang làm việc tại Vinhomes, một trong những thương hiệu
            bất động sản hàng đầu tại Việt Nam. Với vốn am hiểu về thị trường
            bất động sản cùng khả năng tư duy chiến lược sắc bén, tôi sẽ giúp
            khách hàng của mình đưa ra quyết định đầu tư sáng suốt.
          </p>
          <p class="mt-4 text-gray-700">
            Cùng tôn chỉ luôn đặt lợi ích của khách hàng lên hàng đầu, tôi cam
            kết mang lại sự hài lòng tối đa thông qua dịch vụ chuyên nghiệp và
            tận tâm.
          </p>
          <button
            class="px-6 py-2 mt-6 text-white transition duration-300 bg-blue-900 rounded-full shadow-lg hover:bg-blue-700"
          >
            Liên hệ tư vấn
          </button>
        </div>
        <div class="relative mt-6 lg:w-1/2 lg:mt-0 lg:ml-6 slide-left">
          <div class="relative flex justify-center">
            <img
              alt="Person standing in front of a building"
              class="w-[60%] md:w-auto"
              src="./image/heroSection/bgInfo.png"
            />
          </div>
        </div>
      </div>
    </div>

    <!-- Các dự án bất động sản -->
    <div
      class="relative min-h-screen text-white bg-center bg-cover font-plus lg:bg-left lg:bg-left-top slide-top"
      style="background-image: url('./image/index/bgQuickSearch.png')"
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
            Xem tất cả
            <i class="ml-2 fas fa-arrow-right"></i>
          </button>
        </div>
        <div
          class="flex mb-8 space-x-8 heroSection-project-select pb-4 border-b-[0.5px] border-[#fff] overflow-x-auto md:overflow-visible scroll-smooth whitespace-nowrap"
        >
          <a class="active" href="#" data-tab="house">Nhà ở</a>
          <a href="#" data-tab="villa">Biệt thự</a>
          <a href="#" data-tab="apartment">Căn hộ</a>
          <a href="#" data-tab="room">Phòng cho thuê</a>
          <a href="#" data-tab="office">Văn phòng</a>
          <a href="#" data-tab="hotel">Khách sạn</a>
          <a href="#" data-tab="land">Khu đất dự án</a>
        </div>

        <div class="swiper mySwiper mySwiper-Projects">
          <div class="swiper-wrapper" id="swiper-wrapper-project">
            <!-- Thẻ swiper sẽ được chèn ở đây -->
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
            Xem tất cả
            <i class="ml-2 fas fa-arrow-right"></i>
          </button>
        </div>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
          <a href="detailProject.html" class="rounded-lg">
            <div class="relative overflow-hidden rounded-lg">
              <img
                alt="Modern house with large windows and landscaped garden"
                class="object-cover w-full h-[440px] rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
                src="<?= $urlThemeActive ?>image/index/imageQS1.png"
              />
              <div
                class="absolute text-sm text-white bg-[#239A3D] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
              >
                Đang mở bánQ1/2024: Sắp bán khu căn hộ
              </div>
            </div>

            <h2 class="mt-4 text-xl font-bold">Vinhomes Global Gate</h2>
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Phân khu:</p>
              <p class="underline underline-offset-4 text-[#142A72]">
                The Rainbow
              </p>
            </div>
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Tổng diện tích:</p>
              <p class="underline underline-offset-4 text-[#142A72]">385 ha</p>
            </div>
            <p class="mt-2 text-gray-400 description">
              Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi động
              và đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết nối,
              phong cách sống toàn cầu
            </p>
          </a>
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
                Sắp mở bán
              </div>
            </div>

            <h2 class="mt-4 text-xl font-bold">Vinhomes Global Gate</h2>
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Phân khu:</p>
              <p class="underline underline-offset-4 text-[#142A72]">
                The Rainbow
              </p>
            </div>
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Tổng diện tích:</p>
              <p class="underline underline-offset-4 text-[#142A72]">385 ha</p>
            </div>
            <p class="mt-2 text-gray-400 description">
              Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi động
              và đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết nối,
              phong cách sống toàn cầu
            </p>
          </a>
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
                Đang mở bánQ1/2024: Sắp bán khu căn hộ
              </div>
            </div>

            <h2 class="mt-4 text-xl font-bold">Vinhomes Global Gate</h2>
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Phân khu:</p>
              <p class="underline underline-offset-4 text-[#142A72]">
                The Rainbow
              </p>
            </div>
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Tổng diện tích:</p>
              <p class="underline underline-offset-4 text-[#142A72]">385 ha</p>
            </div>
            <p class="mt-2 text-gray-400 description">
              Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi động
              và đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết nối,
              phong cách sống toàn cầu
            </p>
          </a>
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
              Vinhomes Ocean Park 2
            </div>
            <div class="bg-[#676DFF1A] px-6 py-2 rounded-full text-[#142A72]">
              Vinhomes Grand Park
            </div>
            <div class="bg-[#676DFF1A] px-6 py-2 rounded-full text-[#142A72]">
              Vinhomes Ocean Park
            </div>
            <div class="bg-[#676DFF1A] px-6 py-2 rounded-full text-[#142A72]">
              Vinhomes Royal Island
            </div>
          </div>
          <a href="#" class="hidden md:flex">
            <img src="<?= $urlThemeActive ?>image/icons/iconAll.png" alt="icon" class="h-10" />
          </a>
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
              src="<?= $urlThemeActive ?>image/heroSection/bgBenefit1.png"
              width="400"
            />
            <img
              alt="High-rise residential building with a scenic view"
              class="rounded-lg mt-[-40px] ml-[80px]"
              height="300"
              src="<?= $urlThemeActive ?>image/heroSection/bgBenefit2.png"
              width="400"
            />
          </div>
        </div>
        <div class="mt-6 lg:mt-0 lg:ml-6 w-auto lg:w-[50%]">
          <h2
            class="mb-2 text-lg font-bold text-gray-800 sm:text-4xl text-[#142A72]"
          >
            Những lý do nên tìm đến MinhTuanVinhomes
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
              <i class="text-yellow-500 fas fa-check"></i> Tiếp cận thông tin
              minh bạch, đầy đủ
            </li>
            <li>
              <i class="text-yellow-500 fas fa-check"></i> Mua nhà mọi lúc, mọi
              nơi 24/7
            </li>
            <li>
              <i class="text-yellow-500 fas fa-check"></i> Được tư vấn chuyên
              nghiệp, miễn phí
            </li>
            <li>
              <i class="text-yellow-500 fas fa-check"></i> Tiếp kiệm chi phí và
              thời gian
            </li>
            <li>
              <i class="text-yellow-500 fas fa-check"></i> Tìm mua nhà Vinhomes
              từ quỹ căn đủ nhất với giá tốt nhất
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
            <p class="mt-2 text-gray-400">
              Discover the newest additions to our exclusive real estate
              portfolio.
            </p>
          </div>
          <button
            class="flex items-center px-6 py-4 rounded-xl bg-[#E2E8F0] text-[#142A72] transition-all duration-300 ease-in-out hover:bg-[#6274bb] hover:text-white hover:scale-105 hover:shadow-lg"
          >
            Xem tất cả
            <i class="ml-2 fas fa-arrow-right"> </i>
          </button>
        </div>

        <!-- Tabs -->
        <div
          class="flex mb-8 space-x-8 heroSection-news-select font-bold pb-4 border-b-[0.5px] border-[#ccc] overflow-x-auto md:overflow-visible scroll-smooth whitespace-nowrap"
        >
          <a class="tab active" href="#" data-tab="all">Tất cả bài viết</a>
          <a class="tab" href="#" data-tab="project">Dự án triển khai</a>
          <a class="tab" href="#" data-tab="market-analysis"
            >Phân tích thị trường</a
          >
          <a class="tab" href="#" data-tab="financial-solutions"
            >Giải pháp tài chính</a
          >
          <a class="tab" href="#" data-tab="real-estate">Bất động sản</a>
        </div>

        <!-- Tab content -->
        <div class="tab-content">
          <div id="all" class="tab-pane active">
            <!-- Nội dung cho tab "Tất cả bài viết" -->
            <div id="tab-all-content"></div>
          </div>

          <div id="project" class="hidden tab-pane">
            <!-- Nội dung cho tab "Dự án triển khai" -->
            <div id="tab-project-content"></div>
          </div>

          <div id="market-analysis" class="hidden tab-pane">
            <!-- Nội dung cho tab "Phân tích thị trường" -->
            <div id="tab-market-analysis-content"></div>
          </div>

          <div id="financial-solutions" class="hidden tab-pane">
            <!-- Nội dung cho tab "Giải pháp tài chính" -->
            <div id="tab-financial-solutions-content"></div>
          </div>

          <div id="real-estate" class="hidden tab-pane">
            <!-- Nội dung cho tab "Bất động sản" -->
            <div id="tab-real-estate-content"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Liên hệ -->
    <div
      class="relative bg-center bg-cover font-plus slide-top"
      style="background-image: url('./image/index/imageQS2.png')"
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
        <form
          class="p-8 text-gray-800 bg-white rounded-lg shadow-lg md:w-[50%]"
        >
          <div class="mb-4">
            <input
              class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Họ và tên"
              type="text"
            />
          </div>
          <div class="mb-4">
            <input
              class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Số điện thoại"
              type="text"
            />
          </div>
          <div class="mb-4">
            <input
              class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Địa chỉ Email"
              type="email"
            />
          </div>
          <div class="mb-4">
            <textarea
              class="w-full h-32 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Lời nhắn của bạn"
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

<?php
getFooter();
?>
