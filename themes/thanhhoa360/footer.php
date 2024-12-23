<?php
global $urlThemeActive;

$setting = setting();
?>
<style>
  .footer-container{
    background-color: brown;
  }
  </style>
<div class='mt-5 footer-container'>
      <div class='container-fluid pt-5 pb-5'>
        <div class='row'>
          <div class="col-lg-6 col-12 footer-frist-container d-flex flex-column">
            <div class='d-flex align-items-center gap-3'>
              <div><img src="<?php echo $setting['image_logo'] ?>" alt="logo"></div>
              <div class='d-flex flex-column gap-1'>
                <h2><?php echo @$setting['title_footer']; ?></h2>
                <span>Cơ quan chủ quản: <?php echo @$setting['agency']; ?>.</span>
                <span>Chịu trách nhiệm chính: <?php echo @$setting['responsibility']; ?>.</span>
              </div>
            </div>
            <div class='bestnew-info mt-4 mb-3'>
              <div class='bn-contacts gap-3'>
                <div class='bn-contact'>
                  <img src="<?= $urlThemeActive ?>images/location.png" alt="location">
                  <span><?php echo @$setting['address']; ?></span>
                </div>
                <div class='bn-contact'>
                  <img src="<?= $urlThemeActive ?>images/mail.png" alt="date">
                  <span><?php echo @$setting['responsibilityemail']; ?></span>
                </div>
                <div class='bn-contact'>
                  <img src="<?= $urlThemeActive ?>images/phone.png" alt="phon">
                  <span><?php echo @$setting['phone']; ?></span>
                </div>
              </div>
            </div>
          </div>
          <div class="bestnewss-info col-lg-6">
            <div class="col-lg-3 col-6 d-flex flex-column text-white gap-3 footer-mid">
              <h2>Về chúng tôi</h2>
                  <?php
                  if (!empty(getListLinkWeb(@$setting['idlink']))) {
                      foreach (getListLinkWeb(@$setting['idlink']) as $key => $ListLink) { ?>
                          <li>
                              <a href="<?php echo $ListLink['link'] ?>"><?php echo $ListLink['name'] ?></a>
                          </li>
                  <?php }
                  } ?>
            </div>
            <div class="col-lg-3 col-6 d-flex flex-column text-white gap-3 footer-mid">
              <h2>Truy cập hiện tại</h2>
              <span> <?php 
                              if(function_exists('showStatic')){
                                  showStatic();
                              }
                              ?></span>
              <div class='d-flex gap-2'>
                <a href=""><img src="<?= $urlThemeActive ?>images/fb.png" alt=""></a>
                <a href=""><img src="<?= $urlThemeActive ?>images/tw.png" alt=""></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="<?= $urlThemeActive ?>thanhhoa/js/index.js"></script>
</html>

