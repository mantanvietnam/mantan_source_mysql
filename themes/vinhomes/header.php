<?php
global $urlThemeActive;
global $isHome;
$setting = setting();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MinhTuanVinhomes</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="<?= $urlThemeActive ?>bds/css/styles.css">
    <script src="<?= $urlThemeActive ?>bds/js/script.js"></script>
    <?php mantan_header(); ?>

  </head>
  <body>
    <!-----Header -----> 
    <div
  class="relative min-h-screen bg-center bg-cover fade-in"
  style="background-image: url('<?php echo !empty($setting['background_image']) ? $setting['background_image'] : './image/index/bgHeader.png'; ?>')"
>
      <div class="background-overlay"></div>
      <header class="py-4 mx-4 bg-transparent sm:mx-6 lg:mx-20 font-plus">
        <div class="flex items-center justify-between font-bold">
          <a href="/" class="flex items-center">
            <img
              alt="Logo"
              class="mr-2"
              height="32"
              src="<?php echo $setting['image_logo'] ?>"
              width="30"
            />
            <span class="text-lg font-bold text-white">
              MinhTuanVinhomes
            </span>
          </a>
          <div class="items-center hidden space-x-2 lg:flex md:property-button lg:space-x-6 xl:space-x-16">
            <?php 
                $menu = getMenusDefault();

                if (!empty($menu)) {
                foreach ($menu as $key => $value) {
                    if (empty($value['sub'])) {
            ?>
                    <nav class="flex space-x-2 text-white nav-sectionpage lg:space-x-6 xl:space-x-16">
                        <a href="<?php echo $value['link']; ?>" class="active"><?php echo $value['name']; ?></a>
                    </nav>
            <?php 
                    } else {
            ?>
                    <nav class="flex space-x-2 text-white nav-sectionpage lg:space-x-6 xl:space-x-16">
                        <a href="<?php echo $value['link']; ?>" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $value['name']; ?>
                        </a>
                        <ul class="dropdown-menu">
                        <?php 
                            foreach ($value['sub'] as $sub_key => $sub_value) {
                        ?>
                            <li><a class="dropdown-item" href="<?php echo $sub_value['link']; ?>"><?php echo $sub_value['name']; ?></a></li>
                        <?php 
                            }
                        ?>
                        </ul>
                    </nav>
            <?php 
                    }
                }
                }
            ?>
            <a href="contact.php" class="px-4 py-2 text-white border border-white rounded-xl">
                Liên hệ tư vấn
            </a>
            </div>
        </div>
      </header>
