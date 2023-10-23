<?php
getHeader();
global $urlThemeActive;
global $session;
$infoUser = $session->read('infoUser');
?>
<main>
    <section class="banner-top-style-1">
        <div class="place-img-slide-tour">
            <?php if (!empty($data->image)) { ?>
                <div class="img-slide-item">
                    <img src="<?php echo $data->image ?>" alt="">
                </div>
            <?php } ?>
            <?php if (!empty($data->image2)) { ?>
                <div class="img-slide-item">
                    <img src="<?php echo $data->image2 ?>" alt="">
                </div>
            <?php } ?>
            <?php if (!empty($data->image3)) { ?>
                <div class="img-slide-item">
                    <img src="<?php echo $data->image3 ?>" alt="">
                </div>
            <?php } ?>
            <?php if (!empty($data->image4)) { ?>
                <div class="img-slide-item">
                    <img src="<?php echo $data->image4 ?>" alt="">
                </div>
            <?php } ?>
            <?php if (!empty($data->image5)) { ?>
                <div class="img-slide-item">
                    <img src="<?php echo $data->image5 ?>" alt="">
                </div>
            <?php } ?>
            <?php if (!empty($data->image6)) { ?>
                <div class="img-slide-item">
                    <img src="<?php echo $data->image6 ?>" alt="">
                </div>
            <?php } ?>
            <?php if (!empty($data->image7)) { ?>
                <div class="img-slide-item">
                    <img src="<?php echo $data->image7 ?>" alt="">
                </div>
            <?php } ?>
            <?php if (!empty($data->image8)) { ?>
                <div class="img-slide-item">
                    <img src="<?php echo $data->image8 ?>" alt="">
                </div>
            <?php } ?>
            <?php if (!empty($data->image9)) { ?>
                <div class="img-slide-item">
                    <img src="<?php echo $data->image9 ?>" alt="">
                </div>
            <?php } ?>
            <?php if (!empty($data->image10)) { ?>
                <div class="img-slide-item">
                    <img src="<?php echo $data->image10 ?>" alt="">
                </div>
            <?php } ?>
        </div>
    </section>
    <section class="background" style="background-image: url('<?= $urlThemeActive ?>assets/lou_img/su-kien-list-event.png')">
        <div class="container py-3 py-md-5">
            <div class="row">
                <div class="col-12 col-lg-8 col-md-12 info-tour">
                    <section id="tour-chi-tiet-intro" class="mb-4">
                        <!-- <h1 class="header-name"></h1> -->
                        <h3><?php echo @$data->name ?></h3>
                        <p class="intro-content">
                            <?php echo @$data->content ?>
                        </p>
                    </section>
                    <?php if (!empty($data->image360)){ ?>
                        <section class="page-banner">
                            <div class="iframe-banner">
                                <iframe src="<?php echo $data->image360 ?>"
                                allowfullscreen ="true" frameborder="0"></iframe>
                            </div>
                        </section>
                    <?php } ?>
                    <section class="time-line">
                        <div class="">
                            <h3 class="header-name">Lịch trình</h3>
                            <!-- <p class="intro-content">
                                <?php echo @$data->content ?>
                            </p> -->
                            <div class="main-menu">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Ngày 1</button>
                                    </li>
                                    <li class="nav-item date2tou" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Ngày 2</button>
                                    </li>
                                </ul>
                                <div class="tab-content mt-5" id="myTabContent">
                                    <div class="tab-timeline tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                        <div class="row g-3 g-lg-0">
                                            <?php foreach ($listRepor as $keyRepor => $repor1) {
                                                if ($repor1->date == 1) {
                                                    if ($keyRepor % 2 == 0) {
                                            ?>
                                                        <div class="col-12 img-left">
                                                            <div class="d-flex align-items-lg-start">
                                                                <img class="img-detail mb-3" src="<?php echo @$repor1->image ?>" alt="">
                                                                <div class="line-break d-none d-xxl-block px-3">
                                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                                        <div class="circle-top">
                                                                        </div>
                                                                        <div class="line"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="content">
                                                                    <span class="time"><?php echo @$repor1->time ?></span>
                                                                    <h5><?php echo @$repor1->name ?></h5>
                                                                    <p class="title"><?php echo @$repor1->introductory ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="col-12 img-right">
                                                            <div class="d-flex align-items-lg-start">
                                                                <img class="img-detail mb-3" src="<?php echo @$repor1->image ?>" alt="">
                                                                <div class="line-break d-none d-xxl-block px-3">
                                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                                        <div class="circle-top">
                                                                        </div>
                                                                        <div class="line"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="content">
                                                                    <span class="time"><?php echo @$repor1->time ?></span>
                                                                    <h5><?php echo @$repor1->name ?></h5>
                                                                    <p class="title"><?php echo @$repor1->introductory ?></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                            <?php }
                                                }
                                            } ?>

                                        </div>
                                    </div>
                                    <div class="tab-timeline tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                        <div class="row g-3 g-lg-0">
                                            <?php foreach ($listRepor as $keyRepor => $repor1) {
                                                if ($repor1->date == 2) {
                                                    if ($keyRepor % 2 != 0) {
                                            ?>
                                                        <div class="col-12 img-left">
                                                            <div class="d-flex align-items-lg-start">
                                                                <img class="img-detail mb-3" src="<?php echo @$repor1->image ?>" alt="">
                                                                <div class="line-break d-none d-xxl-block px-3">
                                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                                        <div class="circle-top">
                                                                        </div>
                                                                        <div class="line"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="content">
                                                                    <span class="time"><?php echo @$repor1->time ?></span>
                                                                    <h5><?php echo @$repor1->name ?></h5>
                                                                    <p class="title"><?php echo @$repor1->introductory ?></p>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="col-12 img-right">
                                                            <div class="d-flex align-items-lg-start">
                                                                <img class="img-detail mb-3" src="<?php echo @$repor1->image ?>" alt="">
                                                                <div class="line-break d-none d-xxl-block px-3">
                                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                                        <div class="circle-top">
                                                                        </div>
                                                                        <div class="line"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="content">

                                                                    <span class="time"><?php echo @$repor1->time ?></span>
                                                                    <h5><?php echo @$repor1->name ?></h5>
                                                                    <p class="title"><?php echo @$repor1->introductory ?></p>

                                                                </div>
                                                            </div>
                                                        </div>



                                                    <?php } ?>
                                                    <style type="text/css">
                                                        .date2tou {
                                                            display: block;
                                                        }
                                                    </style>
                                                <?php } else { ?>
                                                    <style type="text/css">
                                                        .date2tou {
                                                            display: none;
                                                        }
                                                    </style>

                                            <?php }
                                            } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                </div>
                <div class="col-12 col-lg-4 col-md-12">
                    <section class="tour-chi-tiet-map">
                        <div class="map-contain">
                            <div id="google-map">
                                <div class="map">
                                        <div id="map_HS"></div>
                                </div>
                            </div>
                            <div class="selection"></div>
                            <div class="current-location"></div>
                            <div class="zoom"></div>
                        </div>
                        <div class="p-3 tour-chi-tiet-body">
                            <div class="card-detail d-flex align-items-center">
                                <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-clock-dat-tour.svg" alt="">
                                <span><?php echo date("d/m/Y", @$data->datestart) . ' - ' . date("d/m/Y", @$data->dateend); ?></span>
                            </div>
                            <div class="card-detail d-flex align-items-center">
                                <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-location-dat-tour.svg" alt="">
                                <span> <?php echo @$data->address ?></span>
                            </div>
                            <?php if(!empty($data->price)){ ?>
                            <div class="card-detail d-flex align-items-center">
                                <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-promote-dat-tour.svg" alt="">
                                <span><?php echo number_format(@$data->price); ?> VNĐ</span>
                            </div>
                        <?php } ?>
                            <div class="d-flex align-items-center mt-3">


                                <?php if (!empty($infoUser)) {  ?>
                                    <a href="" class="btn button-outline-primary-custom" data-bs-toggle="modal" data-bs-target="#modal-book-tour">Đặt tour</a>
                                <?php } else { ?>
                                    <a href="/login" class="btn button-outline-primary-custom">Đặt tour</a>
                                <?php } ?>
                                <!-- <a href="" class="btn button-outline-primary-custom">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-share-nodes me-2"></i>
                                            <span>Chia sẻ</span>
                                        </div>
                                    </a> -->
                                <div class="fb-share-button" data-href="<?php echo @$data->u ?>" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <section id="place-around-section" class="mgt-80 tourkhac-section">
        <div class="container">
            <div class="title-section mgb-32">
                <p>Các tour khác </p>
            </div>

            <div class="place-around-slide">
                <?php

                foreach (@$otherData as $key => $value) {
                    if (@$data->id != @$value->id) { ?>
                        <div class="place-around-slide-item">
                            <div>
                                <a href="/chi_tiet_tour/<?php echo $value->urlSlug ?>.html" class="text-decoration-none">
                                    <div class="tour-du-lich-card">
                                        <div class="card border-0 w-100">
                                            <div class="card-top">
                                                <img src="<?php echo $value->image ?>" class="card-img-top" alt="...">
                                                <div class="card-overlay"></div>
                                                <div class="card-num-day">
                                                    <?php echo $value->timetravel ?>
                                                </div>
                                            </div>
                                            <div class="card-body p-lg-4">
                                                <h5 class="card-title"><?php echo $value->name ?></h5>
                                                <!-- sua -->
                                                <div class="d-flex align-items-center card-num-location">
                                                    <i class="fa-solid fa-clock"></i>
                                                    <span class="card-time"><?php echo date("d/m/Y", @$value->datestart) . ' - ' . date("d/m/Y", @$value->dateend); ?></span>      
                                                </div>
                                                <!--  -->
                                                <div class="d-flex align-items-center card-num-location">
                                                    <img class="me-2" src="<?= $urlThemeActive ?>assets/lou_icon/icon-location-white-card.svg" alt="">
                                                    <span><?php echo $value->address ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </section>
     <?php 
if(@$_GET['status']=='bookTourDone'){ ?>   
<div class="modal notification" tabindex="-1" role="dialog" style="display: block;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thông báo</h5>
        <a href="/chi_tiet_tour/<?php echo $data->urlSlug ?>.html" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">
        <p>Bạn đặt tour thành công.</p>
      </div>
      <div class="modal-footer">
       
        <a href="/chi_tiet_tour/<?php echo  $data->urlSlug ?>.html" type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
      </div>
    </div>
  </div>
</div>
<?php }elseif (@$_GET['status']=='bookTourfailure') {?>
  
<div class="modal notification" tabindex="-1" role="dialog" style="display: block;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thông báo</h5>
        <a href="/chi_tiet_khach_san/<?php echo $data->urlSlug; ?>.html" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">
        <p>Bạn đặt tour không thành công.</p>
      </div>
      <div class="modal-footer">
       
        <a href="/chi_tiet_khach_san/<?php echo $data->urlSlug; ?>.html" type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
      </div>
    </div>
  </div>
</div>
<?php }?>
</main>
<!-- Modal -->
<div class="modal fade" id="modal-book-tour" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-lg-5">
                <h5 class="text-center modal-name">Thông tin</h5>
                <form action="/booktour" method="post">
                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                    <input type="hidden" value="<?php echo $data->id; ?>" name="idtour">
                    <input type="hidden" value="<?php echo @$infoUser['id']; ?>" name="idcustomer">
                    <input type="hidden" value="<?php echo $data->urlSlug; ?>" name="urlSlug">
                    <div class="card-body p-lg-5">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="">Họ và tên</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên đăng nhập" required="">
                            </div>
                            <div class="col-12">
                                <label for="">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại" required="">
                            </div>
                            <div class="col-12">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Nhâp email" required="">
                            </div>
                            <div class="col-12">
                                <label for="">Số người</label>
                                <input type="number" class="form-control" name="numberpeople" placeholder="Nhập số người" required="">
                            </div>
                            <div class="col-12">
                                <label for="">Ghi chú</label>
                                <textarea class="form-control" id="" name="not" rows="3" style="height: 170px;" placeholder="Nội dung"></textarea>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-center">
                                    <button class="btn button-submit-custom">Gửi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script type="text/javascript">
  function initMap() {
    var keyMap = 'efe2301638f6af0bd594f5f607d6dc86ea53e3406d158d44';
    var locations = [<?php 
    if (!empty(@$data)) {
        $listShowMap= array();
          if(!empty($data->latitude) & !empty($data->longitude)){
              //$content = '<a href='.$data['urlSlug'].'></a>';
              $content   = '<img src='.$data->image.' style=width:200px;height:156px;  ><br/><a href='.$data->urlSlug.'>' . $data->name. '</a>';
              $content.='<br/>Điện thoạt: ' . $data->phone;
              $content.='<br/>Địa chỉ: ' . $data->address;

              $listShowMap[]= '["' . $content . '", ' . $data->latitude . ', ' . $data->longitude . ', "/themes/tayho360/assets/icon/lehoi.png","su_kien"]';
            }
        
        //  $listShowMap[]= '[]';
        echo implode(',', $listShowMap);
    }
    ?>];

     const map = L.map('map_HS', {
      center: [21.057646992531012, 105.83320869683257],
      zoom: 14,
    });

    L.tileLayer('https://maps.vnpost.vn/api/tm/{z}/{x}/{y}@@2x.png?apikey='+keyMap, {
      attribution: 'Map data &copy; <a href="https://vmap.vn">Vmap</a>, <a href="http://openstreetmap.org">OSM Contributors</a>',
      maxZoom: 15,
      id: 'Vmap.streets',
      accessToken: keyMap
    }).addTo(map);

    var icon, y, i;
     
        for (i = 0; i < locations.length; i++) {
            icon = L.icon({
              iconUrl: locations[i][3],
              iconSize: [40, 40],
            });
          
             console.log(locations[i][1]);
            L.marker([locations[i][1], locations[i][2]], {icon: icon}).bindPopup(locations[i][0]).addTo(map);
          
        }
    }  
  
</script> 

<script>
  $(document).ready(function() {
    var w = $(window).innerHeight();
    var h = $('.map_search').innerHeight();
    // var s = $('#search').innerHeight();
    var f = $('footer').innerHeight();

    var x = w-h-f-10;
    x= 800;
    // document.write(x);
    $('#map, #map_HS').css({'height':x});

    initMap();
  });
</script>

<style>
    .fb_iframe_widget {
        scale: 1;
        padding: 10px 20px;
        background: #1877f2;
        border-radius: 10px;
        margin-left: 10px;
    }

    
</style>

<?php
getFooter(); ?>