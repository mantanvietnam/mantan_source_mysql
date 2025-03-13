<?php
global $urlThemeActive;
global $isHome;
$setting = setting();
?>
<!DOCTYPE html>
<html lang="vn">
  <head>
  <?php 
        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Plus+Jakarta+Sans:wght@400;500;600&family=Inter:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <link rel="icon" sizes="16x16" href="<?= $urlThemeActive?>image/icons/iconLogo.png" type="image/png">
    <link rel="icon" sizes="32x32" href="<?= $urlThemeActive?>image/icons/iconLogo.png" type="image/png">
    <link rel="icon" sizes="48x48" href="<?= $urlThemeActive?>image/icons/iconLogo.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <link rel="stylesheet" href="<?= $urlThemeActive ?>bds/css/styles.css?index=1" />
  </head>
  <body>
    <!-----Header ----->
    <div
      class="relative min-h-screen bg-center bg-cover fade-in background-header"
      style="background-image: url('<?php echo $setting['background_image']; ?>')"
      >
      <div class="background-overlay"></div>
      <div class="relative z-20">
        <header class="py-4 mx-4 bg-transparent sm:mx-6 lg:mx-20 font-plus">
          <div class="flex items-center justify-between font-bold">
            <a href="/" class="flex items-center">
              <img
                alt="Logo"
                class="mr-2"
                height="32"
                src="
                <?php echo $setting['image_logo'] ?>
                "                
                width="30"
              />
              <span class="text-lg font-bold text-white setcolor">
              <?php echo $setting['text_logo'] ?>
              </span>
            </a>
            <div
              class="items-center hidden space-x-2 lg:flex md:property-button lg:space-x-6 xl:space-x-16"
            >
            <nav class="flex space-x-2 text-white nav-sectionpage lg:space-x-6 xl:space-x-16 setcolor">
              <?php  
              $menus = getMenusDefault();  
              if (!empty($menus) && is_array($menus)):  
                  foreach ($menus as $categoryMenu): 
              ?>
                  <div class="group">
                      <?php if (empty($categoryMenu['sub'])): ?> 
                          <a href="<?php echo $categoryMenu['link']; ?>" class="flex items-center">
                              <?php echo $categoryMenu['name']; ?>
                          </a>
                      <?php else: ?>
                          <a href="<?php echo $categoryMenu['link']; ?>" class="flex items-center font-semibold text-lg">
                              <?php echo $categoryMenu['name']; ?>
                              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                              </svg>
                          </a>
                          
                          <!-- Mega Menu Dropdown -->
                          <div class="absolute left-1/2 transform -translate-x-1/2 hidden pt-4 group-hover:block z-50">
                              <div class="w-[1200px] bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                              <?php 
                                  $countSubMenu = count($categoryMenu['sub']);
                                  $gridCols = min(6, max(2, $countSubMenu));
                              ?>
                              
                                  <div class="grid grid-cols-<?php echo $gridCols; ?> gap-6">
                                      <?php foreach ($categoryMenu['sub'] as $subMenu): ?>
                                          <div class="border-r border-gray-300 last:border-0 pr-6">
                                              <h4 class="font-bold !text-gray-900 pb-2 border-b border-gray-300 !text-[14px]">
                                                <a href="<?php echo $subMenu['link']; ?>" class="hover:!text-blue-500 transition duration-200 !text-gray-900">
                                                  <?php echo $subMenu['name']; ?>
                                                </a>
                                              </h4>
                                              <ul class="mt-3 space-y-2">
                                                  <?php if (!empty($subMenu['sub'])): ?>
                                                      <?php foreach ($subMenu['sub'] as $subSubMenu): ?>
                                                          <li class="relative">
                                                              <div class="flex items-center space-x-2">
                                                                  <span class="text-gray-500 text-sm">&rsaquo;</span>
                                                                  <a href="<?php echo $subSubMenu['link']; ?>" 
                                                                      class="block px-4 py-2 !text-gray-700 hover:bg-gray-100 rounded-md text-sm !text-[12px]">
                                                                      <?php echo $subSubMenu['name']; ?>
                                                                  </a>
                                                              </div>

                                                              <?php if (!empty($subSubMenu['sub'])): ?>
                                                                  <ul class="pl-6 mt-2 space-y-2">
                                                                      <?php foreach ($subSubMenu['sub'] as $subSubSubMenu): ?>
                                                                          <li class="flex items-center space-x-2">
                                                                              <span class="text-gray-500 text-sm">&rsaquo;</span>
                                                                              <a href="<?php echo $subSubSubMenu['link']; ?>" 
                                                                                  class="block px-4 py-2 !text-gray-700 hover:bg-gray-100 rounded-md text-sm !text-[11px]">
                                                                                  <?php echo $subSubSubMenu['name']; ?>
                                                                              </a>
                                                                          </li>
                                                                      <?php endforeach; ?>
                                                                  </ul>
                                                              <?php endif; ?>
                                                          </li>
                                                      <?php endforeach; ?>
                                                  <?php endif; ?>
                                              </ul>
                                          </div>
                                      <?php endforeach; ?>
                                  </div>
                              </div>
                          </div>
                      <?php endif; ?>
                  </div>
              <?php 
                  endforeach;  
              endif;  
              ?>
          </nav>
            <a
              href="/contact"
              class="set-backgroundcontact px-4 py-2 text-white transition-all duration-300 ease-in-out bg-transparent border border-white shadow-md rounded-xl hover:bg-white hover:text-blue-700 hover:shadow-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >
              Liên hệ tư vấn
            </a>
            </div>
            <!-- Nút Dashboard để hiển thị thanh Nav -->
            <div class="flex lg:hidden">
              <button id="dashboardButton" class="text-white">
                <i class="fas fa-bars"></i>
              </button>
            </div>
          </div>
        </header>

        <!-- Thanh Nav dọc (ẩn trên màn nhỏ) -->
        <div
          id="sideNav"
          class="fixed top-0 right-0 w-64 h-full transition-transform duration-300 transform translate-x-full"
        >
          <div class="p-6">
            <ul class="flex flex-col space-y-4">
              <a href="#" class="active">Trang chủ</a>
              <a href="#">Giới thiệu</a>
              <a href="#">Danh sách dự án</a>
              <a href="#">Vinhomes</a>
              <a href="#">Liên hệ tư vấn</a>
            </ul>
          </div>
        </div>

        <!-- Mờ vùng ngoài khi thanh Nav dọc mở -->
        <div
          id="overlay"
          class="fixed inset-0 hidden bg-black opacity-50"
        ></div>
      </div>