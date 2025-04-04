
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
        .short-description {
            display: -webkit-box;              /* Thiết lập kiểu hiển thị cho các phần tử con theo kiểu box */
            -webkit-line-clamp: 3;             /* Giới hạn văn bản hiển thị chỉ 3 dòng */
            -webkit-box-orient: vertical;      /* Chỉ định rằng các dòng sẽ được xếp theo chiều dọc */
            overflow: hidden;                  /* Ẩn phần văn bản vượt quá 3 dòng */
            text-overflow: ellipsis;           /* Thêm dấu ba chấm (...) nếu có văn bản bị cắt */
            line-height: 1.5em;                /* Tùy chỉnh chiều cao của mỗi dòng */
            max-height: 4.5em;                 /* Giới hạn chiều cao tổng của 3 dòng */
        }
    </style>

    <form action="" method="get">
    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
      <div
        class="slide-top flex flex-col md:flex-row items-center p-4 mx-4 bg-[#E2E8F0] rounded-xl  shadow-md sm:mx-6 lg:mx-20 font-plus justify-between"
      >
        <div class="w-full md:w-[30%] mt-4 md:mt-0">
          <input
            type="text"
            placeholder="Tìm kiếm tại đây"
            class="flex-grow w-full p-2 text-gray-600 form-field rounded-xl focus:outline-none" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>"
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
          <select name="id_kind" class="w-full p-2 text-gray-600 form-field focus:outline-none">
            <option value="" <?php echo empty($_GET['id_kind']) ? 'selected' : ''; ?>>Loại BĐS</option>
            <?php foreach ($listDatacategory as $project): ?>
                <option value="<?php echo $project->id; ?>" <?php echo (isset($_GET['id_kind']) && $_GET['id_kind'] == $project->id) ? 'selected' : ''; ?>>
                    <?php echo $project->name; ?>
                </option>
            <?php endforeach; ?>
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
    </form>
    <!-- Danh sách dự án -->
    <div class="py-4 mx-4 sm:mx-6 lg:mx-20 font-plus slide-top">
      <div class="flex flex-col justify-between mt-4 sm:flex-row">
        <div class="flex items-center">
          <p>Số dự án hiển thị:</p>
          <p class="ml-2 text-[#142a72] font-bold"><?=$numberOfProjects?></p>
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
      <?php foreach ($listDataproject as $key => $value) { ?>
        <a href="/project/<?= $value->slug;?>" class="rounded-lg border p-4 bg-slate-100">
          <div class="relative overflow-hidden rounded-lg">
            <img
              alt="Modern house with large windows and landscaped garden"
              class="object-cover w-full h-[440px] rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
              src="<?=$value->image?>"
            />
            <!-- <div
              class="absolute text-white bg-[#239A3D] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
            >
              <?=$value->info?>
            </div> -->
          </div>

          <h2 class="mt-4 text-xl font-bold"><?=$value->name?></h2>
          <div class="flex items-center mt-2 text-[#142A72] font-bold">
            <img
              src="<?= $urlThemeActive ?>image/icons/iconLocationBlack.png"
              alt="icon"
              class="h-6 mr-2"
            />
            <?php echo $value->address; ?>
          </div>
          <div class="flex items-center mt-2 font-bold">
            <p class="mr-2">Tổng diện tích:</p>
            <p class="text-[#142A72]"><?php echo $value->acreage; ?> ha</p>
          </div>
          <div class="short-description">
              <?= $value->description ?>
          </div>
        </a>
      <?php } ?>

      </div>

      <div class="pagination" style="margin:38px 0px">
          <nav aria-label="Page navigation" >
            <?php
            if ($totalPage > 0) {
                if ($page > 5) {
                    $startPage = $page - 5;
                } else {
                    $startPage = 1;
                }

                if ($totalPage > $page + 5) {
                    $endPage = $page + 5;
                } else {
                    $endPage = $totalPage;
                }
            ?>
                <ul class="pagination" style="display: flex;justify-content: center;">
                    <li class="page-item" style="">
                        <a class="page-link flex items-center justify-center w-10 h-10 rounded-md cursor-pointer buttonActive page-link" href="<?php echo $urlPage; ?>1" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>
                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <li style="margin:0 8px 0 8px" class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>"><a class="flex items-center justify-center w-10 h-10 rounded-md cursor-pointer buttonActive page-link" href="<?php echo $urlPage . $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                    <li class="page-item" style="">
                        <a class="page-link flex items-center justify-center w-10 h-10 rounded-md cursor-pointer buttonActive page-link" href="<?php echo $urlPage . $totalPage; ?>" aria-label="Next">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            <?php
            }
            ?>
          </nav>
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
