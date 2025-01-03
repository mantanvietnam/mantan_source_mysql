 <?php 

 getHeader();
 global $urlThemeActive;
 $categories = listCategoryBytype('post'); 
 ?>
   <style>
        .background-header{
          background-image: none !important;
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
        <a href="/posts" class="hover:underline hover:underline-offset-4"
          >Tin tức</a
        >
        <span>/</span>
        <span class="text-[#142a72] font-bold"><?php echo $post->keyword; ?></span>
      </div>

<!-- Title -->
<h1 class="mt-4 text-lg font-bold sm:text-xl lg:text-2xl">
  <?php echo $post->title; ?>
</h1>

<p class="mt-4 text-sm text-gray-500 sm:text-base">
  <?php echo $post->author . ' - ' . date("d/m/Y", $post->time); ?>
</p>

<!-- Thư viện ảnh -->
<div class="py-4 mx-4 sm:mx-6 lg:mx-20 font-plus slide-top">
  <div class="relative ">
    <div class="">
      <div class=" max-h-[50rem]">
        <img
          src="<?php echo $post->image; ?>"
          alt="Image 1"
          class="object-cover w-full h-full rounded-lg"
        />
      </div>
    </div>
  </div>
</div>

<!-- Nội dung thông tin dự án -->
<div class="py-4 mx-4 sm:mx-6 lg:mx-20 font-plus">
  <div class="flex flex-col justify-between lg:flex-row">
    <!-- Left -->
    <div class="w-full  slide-right">
      <!-- Nội dung chính -->
      <div id="overview" class="mt-4 section">
        <div class="text-base leading-7 content">
          <?php echo $post->content; ?>
        </div>
      </div>
    </div>
  </div>
</div>


    <!-- Các tin tức khác -->
    <?php
    $order = array('id' => 'desc');
    $listDataPost = $modelPosts->find()
        ->page(1)
        ->order($order)
        ->all()
        ->toList();
        if (empty($listDataPost)) {
        echo "<p>Không có bài viết nào.</p>";
    }
    ?>    

    <div class="relative min-h-screen font-plus slide-top">
      <div class="px-4 py-10 mx-auto md:py-20 sm:px-6 md:container xl:px-20">
        <div class="flex items-center justify-between mb-8">
          <div class="w-[60%] md:w-auto">
            <h1 class="text-2xl font-bold md:text-4xl text-[#142A72]">
              Tin tức khác
            </h1>
          </div>
        </div>

        <div class="swiper mySwiper mySwiper-Projects">
          <div class="swiper-wrapper" id="all-posts">
          </div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </div>
    </div>


    <!-- Liên hệ -->
    <div
      class="relative bg-center bg-cover font-plus slide-top"
      style="background-image: url('<?=$urlThemeActive?>image/index/imageQS2.png')"
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

<script>
document.addEventListener("DOMContentLoaded", () => {
  let swiper = new Swiper(".mySwiper-Projects", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      640: { slidesPerView: 2 },
      1024: { slidesPerView: 3 },
    },
  });

  const postsData = <?php echo json_encode($listDataPost); ?>;
  const swiperWrapper = document.getElementById("all-posts");

  if (postsData && postsData.length > 0) {
    postsData.forEach((article) => {
      let articleHTML;
      const formattedTime = new Date(article.time * 1000).toLocaleDateString("vi-VN");

      articleHTML = `
        <div class="swiper-slide">
          <a href="/${article.slug}.html">
            <div class="relative">
              <img alt="${article.title}" class="object-cover w-full h-[440px] rounded-lg" src="${article.image}" />
              <div class="absolute text-white py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4"
                   style="background: ${
                     article.active === false
                       ? "#e04444"
                       : "linear-gradient(90deg, #182c77 0%, #6274bb 100%)"
                   };">
                ${article.keyword}
              </div>
            </div>
            <h2 class="mt-4 text-xl font-bold">${article.title}</h2>
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Tác giả:</p>
              <p class="underline underline-offset-4 text-[#142A72]">${article.author}</p>
            </div>
            <div class="flex items-center mt-2 font-bold">
              <p class="mr-2">Thời gian:</p>
              <p class="underline underline-offset-4 text-[#142A72]">${formattedTime}</p>
            </div>
            <p class="mt-2 text-gray-400 description">${article.description}</p>
          </a>
        </div>
      `;
      swiperWrapper.insertAdjacentHTML("beforeend", articleHTML);
    });
  } else {
    swiperWrapper.innerHTML = `<p class="text-gray-500">Không có tin tức</p>`;
  }
});

</script>


    <?php getFooter();?>