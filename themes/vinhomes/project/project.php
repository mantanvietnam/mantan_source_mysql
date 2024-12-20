
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
    </style>

    <!-- Bộ lọc tìm kiếm -->
    <div
      class="slide-top flex flex-col md:flex-row items-center p-4 mx-4 bg-[#E2E8F0] rounded-xl shadow-md sm:mx-6 lg:mx-20 font-plus justify-between"
    >
      <div class="w-full md:w-[30%]">
        <input
          type="text"
          placeholder="Tìm kiếm tại đây"
          class="flex-grow w-full p-2 text-gray-600 form-field rounded-xl focus:outline-none"
        />
      </div>
      <div
        class="flex items-center w-full space-x-2 md:w-[30%] bg-white rounded-xl mt-4 md:mt-0 px-4"
      >
        <img
          src="<?= $urlThemeActive ?>image/icons/iconLocationBlack.png"
          alt="icon"
          class="h-6 ml-2"
        />
        <select class="w-full p-2 text-gray-600 form-field focus:outline-none">
          <option value="" selected>Khu vực</option>
          <option value="hanoi">Hà Nội</option>
          <option value="hcm">TP. Hồ Chí Minh</option>
          <option value="danang">Đà Nẵng</option>
        </select>
      </div>
      <div
        class="flex items-center w-full space-x-2 md:w-[30%] bg-white rounded-xl mt-4 md:mt-0 px-4"
      >
        <img src="<?= $urlThemeActive ?>image/icons/iconBds.png" alt="icon" class="h-6 ml-2" />
        <select class="w-full p-2 text-gray-600 form-field focus:outline-none">
          <option value="" selected>Loại BĐS</option>
          <option value="apartment">Căn hộ</option>
          <option value="house">Nhà đất</option>
          <option value="land">Đất nền</option>
        </select>
      </div>
      <button
        id="searchButtonProject"
        class="p-2 w-full text-white rounded-xl md:w-[50px] flex items-center justify-center mt-4 md:mt-0"
        style="
          background: linear-gradient(90deg, #182c77 0%, #6274bb 100%);
          color: white;
        "
      >
        <img src="<?= $urlThemeActive ?>image/icons/iconSearchWhite.png" alt="icon" class="h-6" />
      </button>
    </div>

    <!-- Danh sách dự án -->
    <div class="py-4 mx-4 sm:mx-6 lg:mx-20 font-plus slide-top">
      <div class="flex flex-col justify-between mt-4 sm:flex-row">
        <div class="flex items-center">
          <p>Số dự án hiển thị:</p>
          <p class="ml-2 text-[#142a72] font-bold">111 dự án</p>
        </div>
        <div class="flex items-center mt-4 sm:mt-0">
          <p>Sắp xếp theo:</p>
          <select class="ml-2 font-bold text-gray-600 focus:outline-none">
            <option value="" selected>Phổ biến nhất</option>
            <option value="apartment">Mới nhất</option>
            <option value="house">Cũ nhất</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-3">
        <a href="detailProject.html" class="rounded-lg">
          <div class="relative overflow-hidden rounded-lg">
            <img
              alt="Modern house with large windows and landscaped garden"
              class="object-cover w-full h-[440px] rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
              src="<?= $urlThemeActive ?>image/index/imageQS1.png"
            />
            <div
              class="absolute text-white bg-[#239A3D] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
            >
              Đang mở bánQ1/2024: Sắp bán khu căn hộ
            </div>
          </div>

          <h2 class="mt-4 text-xl font-bold">Vinhomes Global Gate</h2>
          <div class="flex items-center mt-2 text-[#142A72] font-bold">
            <img
              src="<?= $urlThemeActive ?>image/icons/iconLocationBlack.png"
              alt="icon"
              class="h-6 mr-2"
            />
            Huyện Đông Anh, Thành Phố Hà Nội
          </div>
          <div class="flex items-center mt-2 font-bold">
            <p class="mr-2">Tổng diện tích:</p>
            <p class="text-[#142A72]">385 ha</p>
          </div>
          <p class="mt-2 text-gray-400 description">
            Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi động và
            đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết nối, phong
            cách sống toàn cầu
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
              class="absolute text-white bg-[#E04444] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
            >
              Sắp mở bán
            </div>
          </div>

          <h2 class="mt-4 text-xl font-bold">Vinhomes Global Gate</h2>
          <div class="flex items-center mt-2 text-[#142A72] font-bold">
            <img
              src="<?= $urlThemeActive ?>image/icons/iconLocationBlack.png"
              alt="icon"
              class="h-6 mr-2"
            />
            Huyện Đông Anh, Thành Phố Hà Nội
          </div>
          <div class="flex items-center mt-2 font-bold">
            <p class="mr-2">Tổng diện tích:</p>
            <p class="text-[#142A72]">385 ha</p>
          </div>
          <p class="mt-2 text-gray-400 description">
            Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi động và
            đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết nối, phong
            cách sống toàn cầu
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
              class="absolute text-white bg-[#239A3D] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
            >
              Đang mở bánQ1/2024: Sắp bán khu căn hộ
            </div>
          </div>

          <h2 class="mt-4 text-xl font-bold">Vinhomes Global Gate</h2>
          <div class="flex items-center mt-2 text-[#142A72] font-bold">
            <img
              src="<?= $urlThemeActive ?>image/icons/iconLocationBlack.png"
              alt="icon"
              class="h-6 mr-2"
            />
            Huyện Đông Anh, Thành Phố Hà Nội
          </div>
          <div class="flex items-center mt-2 font-bold">
            <p class="mr-2">Tổng diện tích:</p>
            <p class="text-[#142A72]">385 ha</p>
          </div>
          <p class="mt-2 text-gray-400 description">
            Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi động và
            đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết nối, phong
            cách sống toàn cầu
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
              class="absolute text-white bg-[#239A3D] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
            >
              Đang mở bánQ1/2024: Sắp bán khu căn hộ
            </div>
          </div>

          <h2 class="mt-4 text-xl font-bold">Vinhomes Global Gate</h2>
          <div class="flex items-center mt-2 text-[#142A72] font-bold">
            <img
              src="<?= $urlThemeActive ?>image/icons/iconLocationBlack.png"
              alt="icon"
              class="h-6 mr-2"
            />
            Huyện Đông Anh, Thành Phố Hà Nội
          </div>
          <div class="flex items-center mt-2 font-bold">
            <p class="mr-2">Tổng diện tích:</p>
            <p class="text-[#142A72]">385 ha</p>
          </div>
          <p class="mt-2 text-gray-400 description">
            Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi động và
            đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết nối, phong
            cách sống toàn cầu
          </p>
        </a>
        <a href="detailProject.html" class="rounded-lg">
          <div class="relative overflow-hidden rounded-lg">
            <img
              alt="Modern house with large windows and landscaped garden"
              class="object-cover w-full h-[440px] rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
              src="<?= $urlThemeActive ?>image/index/imageQS1.png"
            />
            <div
              class="absolute text-white bg-[#E04444] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
            >
              Sắp mở bán
            </div>
          </div>

          <h2 class="mt-4 text-xl font-bold">Vinhomes Global Gate</h2>
          <div class="flex items-center mt-2 text-[#142A72] font-bold">
            <img
              src="<?= $urlThemeActive ?>image/icons/iconLocationBlack.png"
              alt="icon"
              class="h-6 mr-2"
            />
            Huyện Đông Anh, Thành Phố Hà Nội
          </div>
          <div class="flex items-center mt-2 font-bold">
            <p class="mr-2">Tổng diện tích:</p>
            <p class="text-[#142A72]">385 ha</p>
          </div>
          <p class="mt-2 text-gray-400 description">
            Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi động và
            đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết nối, phong
            cách sống toàn cầu
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
              class="absolute text-white bg-[#239A3D] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
            >
              Đang mở bánQ1/2024: Sắp bán khu căn hộ
            </div>
          </div>

          <h2 class="mt-4 text-xl font-bold">Vinhomes Global Gate</h2>
          <div class="flex items-center mt-2 text-[#142A72] font-bold">
            <img
              src="<?= $urlThemeActive ?>image/icons/iconLocationBlack.png"
              alt="icon"
              class="h-6 mr-2"
            />
            Huyện Đông Anh, Thành Phố Hà Nội
          </div>
          <div class="flex items-center mt-2 font-bold">
            <p class="mr-2">Tổng diện tích:</p>
            <p class="text-[#142A72]">385 ha</p>
          </div>
          <p class="mt-2 text-gray-400 description">
            Vinhomes Global Gate là một Thành phố Thương mại Quốc tế sôi động và
            đẳng cấp Thế giới, sở hữu 5 thế mạnh tuyệt đối: siêu kết nối, phong
            cách sống toàn cầu
          </p>
        </a>
      </div>

      <div class="flex justify-center my-10 space-x-2">
        <div
          class="flex items-center justify-center w-10 h-10 rounded-md cursor-pointer buttonActive"
        >
          1
        </div>
        <div
          class="flex items-center justify-center w-10 h-10 text-black bg-gray-100 rounded-md cursor-pointer"
        >
          2
        </div>
        <div
          class="flex items-center justify-center w-10 h-10 text-black bg-gray-100 rounded-md cursor-pointer"
        >
          3
        </div>
        <div
          class="flex items-center justify-center w-10 h-10 text-black bg-gray-100 rounded-md cursor-pointer"
        >
          ...
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

    <?php getFooter();?>
