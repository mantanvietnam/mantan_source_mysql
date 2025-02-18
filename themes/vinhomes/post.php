<?php 
getHeader();
$setting = setting();
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

  .news-content img {
    width: 100%;
    border-radius: 10px;
  }
  .colora a{
    color: #0000FF !important;
  }
</style>

<!-- Title -->
<!-- <h1 class="mt-4 text-lg font-bold sm:text-xl lg:text-2xl">
  <?php echo $post->title; ?>
</h1>

<p class="mt-4 text-sm text-gray-500 sm:text-base">
  <?php echo $post->author . ' - ' . date("d/m/Y", $post->time); ?>
</p> -->


<div class="py-4 mx-4 sm:mx-6 lg:mx-20 font-plus slide-right">
  <!-- Breadcrumb -->
  <div class="flex flex-wrap items-center space-x-2 text-sm text-gray-500">
    <i class="fas fa-chevron-left"></i>
    <a href="/" class="hover:underline hover:underline-offset-4">Trang chủ</a>
    <span>/</span>
    <a href="/posts" class="hover:underline hover:underline-offset-4">Tin tức</a>
    <span>/</span>
    <span class="text-[#142a72] font-bold"><?php echo $post->keyword; ?></span>
  </div>
</div>

<div class="py-4 mx-4 sm:mx-6 lg:mx-20 font-plus news-container flex lg:flex-row flex-col justify-between">
  <!-- Nội dung bài viết -->
  <div class="news-content slide-right w-full lg:w-2/3 lg:pr-10">
    <h1 class="mt-4 text-lg font-bold sm:text-xl lg:text-2xl">
      <?php echo $post->title; ?>
    </h1>
    <p class="mt-4 text-sm text-gray-500 sm:text-base">
      <?php echo $post->author . ' - ' . date("d/m/Y", $post->time); ?>
    </p>
    <div class="py-4">
      <img src="<?php echo $post->image; ?>" alt="<?php echo $post->title; ?>">
    </div>
    <div class="colora text-base leading-7 content">
      <?php echo $post->content; ?>
    </div>
  </div>
  
  <!-- Tin tức khác -->
  <div class="related-news slide-left max-w-sm">
    <div class="slide-left">
      <div class="w-full p-6 bg-white rounded-lg shadow-lg ">
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
            placeholder="Lời nhắn của bạn" name="content" value = "Đăng ký tư vấn bật động sản <?= $post->title?>" type="hidden"
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
      <div class="space-y-4 mt-[50px]">
      <h2 class="text-2xl font-bold text-[#142A72] mb-4 text-center">Tin tức khác</h2>
        <?php
        if (!empty($otherPosts)) {
          foreach ($otherPosts as $article) {
            $formattedTime = date("d/m/Y", $article->time);
            echo '<a href="/'.$article->slug.'.html" class="block p-4 border rounded-lg hover:bg-gray-100">';
            echo '<img src="'.$article->image.'" alt="'.$article->title.'" class="w-full h-40 object-cover rounded-lg">';
            echo '<h3 class="mt-2 text-lg font-bold">'.$article->title.'</h3>';
            echo '<p class="text-sm text-gray-500">'.$article->author.' - '.$formattedTime.'</p>';
            echo '</a>';
          }
        } else {
          echo '<p class="text-gray-500">Không có tin tức</p>';
        }
        ?>
      </div>

      <!--------Khung video---->
      <div class="space-y-4 mt-6">
          <h2 class="text-2xl font-bold text-[#142A72] mb-4 text-center">Video / Ảnh liên quan</h2>
          <div class="p-4 border rounded-lg shadow-md bg-white">
            <?php echo $setting['side_bar'] ?>
          </div>
      </div>

    </div>
  </div>
</div>

<?php getFooter(); ?>
