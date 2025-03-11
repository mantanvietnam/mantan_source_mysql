<?php
global $settingThemes;
getHeader();
// debug($project);
// die();
?>
<style>
  .background-header {
    background-image: none !important;
  }

  .nav-projectpage a {
    color: black !important;
  }

  .setcolor {
    color: #333 !important;
  }

  .setcolor a {
    color: #333 !important;
  }

  .set-backgroundcontact {
    background-color: #182c77;

  }

  /* Tăng kích thước ảnh ở giữa */
  .swiper-slide-active img {
    transform: scale(1.2);
    /* Ảnh giữa to hơn */
    transition: transform 0.5s ease-in-out;
  }

  @media (max-width: 480px) {
    .swiper {
      width: 100%;
      /* Giúp slider chiếm hết chiều rộng màn hình */
    }

    .swiper-slide img {
      transform: scale(3);
    }
  }

  .swiper-button-next,
  .swiper-button-prev {
    position: absolute;
    width: 50px;
    height: 50px;
    color: white;
    /* Giữ màu trắng cho icon mũi tên */
    z-index: 10;
  }

  .swiper-button-next::before,
  .swiper-button-prev::before {
    content: "";
    position: absolute;
    inset: 0;
    background: black;
    opacity: 0.5;
    /* Chỉ làm mờ màu nền */
    border-radius: 50%;
    z-index: -1;
  }

  .swiper-button-prev::after,
  .swiper-button-next::after {
    font-size: 14px;
    padding: 12px;
  }

  .list-tab-button .active {
    background: #00b3e3 !important;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  table th, table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
  }

  table th {
      background-color: #f4f4f4;
      font-weight: bold;
  }

  table tbody tr:nth-child(odd) {
      background-color: #f9f9f9;
  }

  table tbody tr:hover {
      background-color: #f1f1f1;
  }

  .overflow-x-auto {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
  }

  .commerce-description {
    display: inline;
}

</style>

<div class="relative text-[#444444] slide-right">
  <img
    src="<?= $project['images'][1] ?>"
    alt="Aerial view of Vinhomes Global Gate"
    class="w-full h-[440px] " />

  <div
    class="absolute inset-0 items-center justify-center left-[-29%] hidden md:flex">
    <div class="max-w-lg p-8 bg-white shadow-lg">
      <h1 class="mb-4 text-3xl font-semibold text-center">
        <?= $project['name'] ?>
      </h1>
      <p class="mb-4 text-sm">
        <?php echo $project['description']; ?>
      </p>
    </div>
  </div>

  <div class="flex items-center justify-center md:hidden">
    <div class="max-w-lg p-8 bg-white">
      <h1 class="mb-4 text-3xl font-semibold text-center">
        <?= $project['name'] ?>
      </h1>
      <p class="mb-4 text-sm">
        <?php echo $project['description']; ?>
      </p>
    </div>
  </div>
</div>

<?php 
    // Giải mã JSON từ trường 'officially'
    $officially = json_decode($project->officially, true);
?>

<?php if (!empty($officially['title']) || !empty($officially['description'])) : ?>
    <div
        class="flex flex-col items-center justify-center p-8 md:flex-row slide-left"
        style="background: linear-gradient(270deg, #236093 0%, #345574 100%)"
    >
        <div class="max-w-lg p-8 text-white border border-white">
            <h1 class="px-12 mb-4 text-xl font-bold text-center">
                <?= isset($officially['title']) ? htmlspecialchars($officially['title'], ENT_QUOTES, 'UTF-8') : '' ?>
            </h1>
            <?php if (!empty($officially['description'])) : ?>
                <ul class="pl-2 space-y-2 text-sm">
                    <?= $officially['description'] ?>
                </ul>
            <?php endif; ?>
        </div>

        <div class="flex items-center justify-center mt-8 md:mt-0 md:ml-8">
            <img
                src="<?= !empty($project['images'][2]) ? $project['images'][2] : 'default.jpg' ?>"
                alt="Aerial view of Vinhomes Global Gate with buildings, roads, and water bodies"
                class="object-cover border-8 border-white rounded-full w-[400px] h-[400px]"
            />
        </div>
    </div>
<?php endif; ?>

<div class="flex flex-col items-center justify-center p-8 md:flex-row slide-right">
  <div class="md:w-[45%] lg:w-[33%]">
    <!-- Ảnh lớn hiển thị -->
    <div class="image-container w-[100%] h-[200px] sm:h-[300px] overflow-hidden">
      <img
        id="mainImage"
        src="<?= !empty($project['images'][1]) ? $project['images'][1] : 'default.jpg' ?>"
        alt="Main Image"
        class="w-full h-full p-2 mb-4 transition-all duration-300 border md:mb-0" />
    </div>

    <!-- Danh sách ảnh nhỏ -->
    <div class="grid grid-cols-4 gap-2">
      <?php 
      if (!empty($project['images']) && is_array($project['images'])) {
          $maxImages = 8;
          $count = 0;

          for ($i = 1; $i <= $maxImages + 1; $i++) { 
              if (empty($project['images'][$i])) continue;
              $count++;

      ?>
      <div class="relative group flex flex-col">
        <img
          src="<?= $project['images'][$i] ?>"
          data-src="<?= $project['images'][$i] ?>"
          alt="Thumbnail <?= $i ?>"
          class="w-full h-full p-2 transition-all duration-300 border cursor-pointer hover:opacity-80 "
          onmouseover="changeImage(this)" />
        <span
          class="absolute px-3 py-1 mb-3 text-[10px] text-white transition-opacity duration-300 -translate-x-1/2 bg-black rounded opacity-0 left-1/2 bottom-full group-hover:opacity-100">
        </span>
        <span
          class="absolute w-0 h-0 mb-1 transition-opacity duration-300 -translate-x-1/2 border-t-4 border-l-4 border-r-4 border-transparent opacity-0 left-1/2 bottom-full border-t-black group-hover:opacity-100"></span>
      </div>
      <?php 
          } 
      } ?>
    </div>
  </div>

  <div class="md:w-[45%] lg:w-[33%] md:pl-10 pt-10 md:pt-0">
    <h1 class="mb-4 text-2xl font-semibold text-center">
      TỔNG QUAN DỰ ÁN <?= $project['name'] ?>
    </h1>
    <div class="space-y-2 text-sm">
      <p><strong>Chủ đầu tư: </strong> <?= $project->investor ?></p>
      <p><strong>Tổng diện tích đất dự án: </strong> <?= $project->acreage ?> m²</p>
      <p><strong>Loại hình phát triển: </strong><?= $project['infoType']['name'] ?></p>
      <p><strong>Hướng: </strong><?= $project['direction'] ?></p>
      <p><strong>Địa chỉ: </strong><?= $project['address'] ?></p>
      <p><strong>Hình thức sở hữu: </strong> <?= $project['ownership_type'] ?></p>
    </div>
  </div>
</div>

<div
  class="flex items-center justify-center text-white slide-left"
  style="background: linear-gradient(270deg, #236093 0%, #345574)">
  <div class="max-w-5xl p-8">
    <h1 class="mb-4 text-2xl font-semibold text-center">
      VỊ TRÍ <?= $project['name'] ?>
    </h1>
    <div class="text-xs">
    <?= nl2br($project['text_location']) ?>
    </div>
  </div>
</div>

<?php if (!empty($project['map'])) { ?>
    <div class="flex items-center justify-center border-b fade-in">  
            <?= $project['map'] ?>
    </div>
<?php } ?>

<?php if (!empty($project['images']['img_map'])) { ?>
<div class="flex items-center justify-center border-b fade-in">
  <img
    src="<?= $project['images']['img_map'] ?>"
    alt=""
    class="w-[80%]" />
</div>
<?php } ?>

<?php if (!empty($project->commerceData)) : ?>
    <?php foreach ($project->commerceData as $commerce) : ?>
        <?php if ($commerce->view_type == 1) : ?>
            <div
                class="flex items-center justify-center text-white slide-left"
                style="background: linear-gradient(270deg, #236093 0%, #345574)"
            >
                <div class="max-w-5xl px-4 py-12">
                    <h1 class="mb-8 text-2xl font-semibold text-center md:text-3xl">
                        <?= htmlspecialchars_decode($commerce->main_title) ?>
                    </h1>
                    <p class="mb-12 text-sm">
                        <?= htmlspecialchars_decode($commerce->main_description) ?>
                    </p>
                    <br><br>
                    <div class="grid grid-cols-1 gap-8 text-sm md:grid-cols-3">
                        <?php if (!empty($commerce->items)) : ?>
                            <?php foreach ($commerce->items as $item) : ?>
                                <div class="">
                                    <img
                                        src="<?= !empty($item->image) ? htmlspecialchars($item->image) : 'default.jpg' ?>"
                                        alt="<?= htmlspecialchars_decode($item->title) ?>"
                                        class="mx-auto mb-4 border-4 border-white"
                                    />
                                    <span>
                                        <h2 class="inline font-bold"><?= htmlspecialchars_decode($item->title) ?></h2> &nbsp;– 
                                        <p class="inline">
                                        <?= strip_tags($item->description) ?>
                                        </p>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-center">Không có dữ liệu hiển thị.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="w-full h-[1px] bg-gradient-to-r from-gray-100 via-gray-300 to-gray-100 my-5"></div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (!empty($project['images']['img_premises'])) { ?>
<div class="flex flex-col items-center justify-center mt-8 slide-right">
  <h1 class="mb-8 text-2xl font-semibold text-center">
    Mặt bằng tổng thể <?= $project['name'] ?>
  </h1>
  <img
    src="<?= $project['images']['img_premises'] ?>"
    alt=""
    class="w-[100%]" />
</div>
<?php } ?>

<div
  class="flex items-center justify-center text-white slide-right"
  style="background: linear-gradient(270deg, #236093 0%, #345574)">
  <div class="w-full px-4 py-12 lg:max-w-5xl">
    <h1
      class="mb-8 text-2xl font-semibold text-center uppercase md:text-3xl">
      Dịch vụ tiện ích “All in one”
    </h1>
    <p class="mb-12 text-sm">
     <?= $project['utility_services'] ?>
    </p>

    <!-- Slider -->
    <?php if (!empty($project['images']) && is_array($project['images'])) { ?>
      <div class="swiper w-[90%] lg:max-w-[1200px] h-[230px] md:h-[360px] relative">
        <div class="swiper-wrapper">
          <?php 
            $maxImages = 8;
            for ($i = 2; $i <= $maxImages + 1; $i++) { 
              if (empty($project['images'][$i])) continue;
          ?>
            <div class="flex items-center justify-center swiper-slide">
              <img src="<?= strip_tags($project['images'][$i]) ?>" alt="Ảnh <?= $i ?>" class="rounded-lg shadow-lg " />

            </div>
          <?php } ?>
        </div>

        <!-- Nút điều hướng -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    <?php } ?>
  </div>
</div>

<?php if (!empty($project->commerceData)) : ?>
    <?php foreach ($project->commerceData as $commerce) : ?>
        <?php if ($commerce->view_type == 2) : ?>
            <div class="flex flex-col items-center justify-center slide-left">
                <div class="w-full px-4 mt-10 lg:max-w-5xl">
                    <h1 class="mb-8 text-2xl font-semibold text-center uppercase md:text-3xl">
                        <?= htmlspecialchars_decode($commerce->main_title) ?>
                    </h1>
                    <p class="mb-12 text-sm">
                        <?= htmlspecialchars_decode($commerce->main_description) ?>
                    </p>
                </div>
<br></br>
                <?php if (!empty($commerce->items) && isset($commerce->items[0])) : ?>
                    <img
                        src="<?= $project['images'][3] ?>"
                        alt=" <?= htmlspecialchars_decode($commerce->main_title) ?>"
                        class="w-[100%]"
                    />
                <?php endif; ?>
            </div>

            <div class="py-8 text-white fade-in" style="background: linear-gradient(270deg, #236093 0%, #345574 100%)">
                <?php if (!empty($commerce->items)) : ?>
                    <?php for ($i = 0; $i < count($commerce->items); $i++) : ?>
                        <div class="flex flex-col justify-center p-8 md:flex-row <?= ($i % 2 == 0) ? 'slide-right' : 'slide-left' ?>">
                            <?php if ($i % 2 == 0) : ?>
                                <div class="flex items-center justify-center mt-8 md:mt-0 md:mr-8">
                                    <img
                                        src="<?= htmlspecialchars($commerce->items[$i]->image ?? 'default.jpg') ?>"
                                        alt="<?= htmlspecialchars($commerce->items[$i]->title ?? '') ?>"
                                        class="object-cover border-8 border-gray-200 w-[600px] h-[360px]"
                                    />
                                </div>
                                <div class="pt-6 md:max-w-xs md:pl-6 md:pt-0">
                                    <h1 class="mb-4 text-xl font-semibold text-center uppercase">
                                        <?= $commerce->items[$i]->title ?>
                                    </h1>
                                    <p class="text-xs leading-relaxed" style="font-size: 14px;">
                                    <?= strip_tags($commerce->items[$i]->description) ?>
                                    </p>
                                </div>
                            <?php else : ?>
                                <div class="flex flex-col justify-center p-8 md:flex-row">
                                  <div class="md:pr-6 md:max-w-xs">
                                      <h1 class="mb-4 text-xl font-semibold text-center uppercase">
                                          <?= htmlspecialchars_decode($commerce->items[$i]->title ?? '') ?>
                                      </h1>
                                      <p class="text-xs leading-relaxed" style="font-size: 14px;">
                                      <?= strip_tags($commerce->items[$i]->description) ?>
                                      </p>
                                  </div>
                                  <div class="flex items-center justify-center mt-6 md:mt-0 md:ml-8">
                                      <img
                                          src="<?= htmlspecialchars($commerce->items[$i]->image ?? 'default.jpg') ?>"
                                          alt="<?= htmlspecialchars($commerce->items[$i]->title ?? '') ?>"
                                          class="object-cover border-8 border-gray-200 w-[600px] h-[360px]"
                                      />
                                  </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<div
  class="px-4 md:px-[100px] lg:px-[200px] xl:px-[250px] py-10 text-[#444444] slide-right">
  <h1 class="mb-4 text-2xl font-semibold text-center uppercase">
    GIÁ BÁN <?= isset($project['name']) ? htmlspecialchars($project['name'], ENT_QUOTES, 'UTF-8') : 'Dự án' ?>
  </h1>

  <?php if (!empty($project['price'])) : ?>
    <div class="overflow-x-auto text-xs">
    <?= html_entity_decode($project['price']) ?>
    </div>
  <?php else : ?>
    <div class="text-center text-gray-500">Thông tin giá bán chưa cập nhật</div>
  <?php endif; ?>
</div>

<div
  class="relative min-h-[400px] bg-center bg-cover py-10 fade-in"
  style="
        background-image: url('<?= $project['image'] ?>');
      ">
  <div class="absolute inset-0 bg-black opacity-50"></div>
  <div
    class="relative z-10 flex flex-col items-center justify-center px-4 min-h-[400px]">
    <h1 class="mb-6 text-2xl font-bold text-white">
      ĐĂNG KÝ TƯ VẤN CHUYÊN SÂU DỰ ÁN
    </h1>
    <div>
      <form method="post" action="/contact" class="w-full max-w-4xl">
        <div class="flex flex-wrap mb-4 -mx-2">
          <div class="w-full px-2 mb-4 md:w-1/4 md:mb-0">
            <input
              class="w-full p-2 border border-gray-300 rounded"
              type="text" name="name" required
              placeholder="Họ và tên*" />
          </div>
          <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
          <div class="w-full px-2 mb-4 md:w-1/4 md:mb-0">
            <input
              class="w-full p-2 border border-gray-300 rounded"
              type="text" name="phone" required
              placeholder="Số điện thoại*" />
          </div>
          <div class="w-full px-2 mb-4 md:w-1/4 md:mb-0">
            <input
              class="w-full p-2 border border-gray-300 rounded"
              type="email" name="email" required
              placeholder="Email" />
          </div>
          <div class="w-full px-2 md:w-1/4">
            <input
              class="w-full p-2 border border-gray-300 rounded"
              type="text" name="subject" 
              placeholder="Dự án quan tâm" />
          </div>
        </div>
        <div class="mb-4">
          <textarea
            class="w-full p-2 border border-gray-300 rounded"
            rows="6" name="content" required
            placeholder="Nhu cầu quan tâm"></textarea>
        </div>
      <button class="px-6 py-2 text-white bg-[#345574] rounded">
        ĐĂNG KÝ
      </button>
    </form>
    </div>
  </div>
</div>

<?php getFooter(); ?>

<script src="./script.js"></script>
<script>
  function changeImage(element) {
    const mainImage = document.getElementById("mainImage");
    mainImage.src = element.getAttribute("data-src");
  }
</script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper(".swiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 3, // Hiển thị 3 ảnh cùng lúc
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    coverflowEffect: {
      rotate: 0,
      stretch: 100, // Cách nhau vừa phải
      depth: 300, // Hiệu ứng 3D
      modifier: 1,
      slideShadows: false,
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      480: {
        slidesPerView: 1.5,
      },
    },
  });

  // Kiểm tra kích thước màn hình
  if (window.innerWidth < 768) {
    swiperConfig.effect = "slide"; // Dưới md, dùng hiệu ứng trượt bình thường
  } else {
    swiperConfig.effect = "coverflow"; // Trên md, dùng hiệu ứng 3D
  }

  // Khởi tạo Swiper
  var swiper = new Swiper(".swiper", swiperConfig);

  // Lắng nghe sự thay đổi kích thước màn hình để cập nhật lại Swiper
  window.addEventListener("resize", function() {
    let newEffect = window.innerWidth < 768 ? "slide" : "coverflow";
    if (swiper.params.effect !== newEffect) {
      swiper.destroy(true, true);
      swiperConfig.effect = newEffect;
      swiper = new Swiper(".swiper", swiperConfig);
    }
  });
</script>

<script>
  // Lấy tất cả nút
  const buttons = document.querySelectorAll(".tab-button");
  const image = document.getElementById("display-image");

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      // Bỏ class active ở tất cả nút
      buttons.forEach((btn) =>
        btn.classList.remove("bg-[#00b3e3]", "active")
      );
      // Thêm class active vào nút đang click
      button.classList.add("bg-[#00b3e3]", "active");

      // Đổi ảnh theo data-img
      image.src = button.getAttribute("data-img");
    });
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll(".tab-item");
    const tables = document.querySelectorAll(".payment-table");

    function activateTab(index) {
      // Remove active class from all tabs and hide all tables
      tabs.forEach((tab, i) => {
        tab.classList.toggle("active", i === index);
        tab
          .querySelector(".arrow-icon")
          .classList.toggle("hidden", i !== index);
      });

      tables.forEach((table, i) => {
        table.classList.toggle("hidden", i !== index);
      });
    }

    // Add click event to each tab
    tabs.forEach((tab, index) => {
      tab.addEventListener("click", function() {
        activateTab(index);
      });
    });

    // Activate the first tab by default
    activateTab(0);
  });
</script>