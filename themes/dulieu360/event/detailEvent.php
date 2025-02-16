<?php
getHeader();
global $urlThemeActive;
?>
<main class="">
    <section class="breadcrumb-custom mt-5">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Sự kiện</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo @$data->name ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <section id="skct-article" class="background" style="background-image: url('<?= $urlThemeActive ?>assets/lou_img/su-kien-list-event.png')">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <article class="pe-0 pe-lg-5">
                        <div class="head">
                            <h1 class="mb-4"><?php echo @$data->name ?></h1>
                        </div>
                        <div class="body">
                            <div class="list-image">
                                <div class="su-kien-slider-chi-tiet">
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
                            </div>
                            <div class="content">
                                <?php echo $data->content; ?>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-lg-4">
                    <aside class="">
                        <div class="map">
                                <div id="map_HS"></div>

                        </div>
                        <div class="card rounded-0 border-top-0">
                            <div class="card-body px-lg-5 py-lg-3">
                                <div class="list-info mb-3">
                                    <div class="d-flex">
                                        <img src="<?= $urlThemeActive ?>/assets/lou_icon/icon-location.svg" class="me-3" alt="">
                                        <span>
                                            <?php echo @$data->address ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="list-info mb-3">
                                    <div class="d-flex">
                                        <img src="<?= $urlThemeActive ?>/assets/lou_icon/icon-phone.svg" class="me-3" alt="">
                                        <span>
                                            <?php echo @$data->phone ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="list-info mb-3">
                                    <div class="d-flex">
                                        <img src="<?= $urlThemeActive ?>/assets/lou_icon/icon-clock.svg" class="me-3" alt="">
                                        <span>
                                            <?php echo date("d/m/Y", @$data->datestart) . ' - ' . date("d/m/Y", @$data->dateend); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <?php if (!empty($otherData)) { ?>
        <section id="skct-lien-quan-other">
            <div class="container mt-5">
                <h2 class="mb-4">Sự kiện liên quan</h2>
                <div class="row g-3 g-lg-4">
                    <?php
                    foreach (@$otherData as $key => $value) {
                        if (@$data->id != @$value->id) { ?>
                            <div class="col-12 col-lg-4">
                                <a href="/chi_tiet_su_kien/<?php echo $value->urlSlug ?>.html" class="d-block text-decoration-none">
                                    <div class="card card-event">
                                        <img class="card-img-top" src="<?php echo $value->image ?>" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">
                                                <?php echo $value->name ?>
                                            </h5>
                                            <p class="card-time">
                                                <?php echo date("d/m/Y", @$value->datestart) . ' - ' . date("d/m/Y", @$value->dateend); ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php }
                    } ?>

                </div>
            </div>
        </section>
    <?php } ?>
</main>

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

              $listShowMap[]= '["' . $content . '", ' . $data->latitude . ', ' . $data->longitude . ', "/themes/dulieu360/assets/icon/lehoi.png","su_kien"]';
            }
        
        //  $listShowMap[]= '[]';
        echo implode(',', $listShowMap);
    }
    ?>];

     const map = L.map('map_HS', {
      center: [21.01726882527535, 105.82163919712521],
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
    #skct-lien-quan-other h2 {
        font-style: normal;
        font-weight: 400;
        font-size: 36px;
        line-height: 34px;
        color: #3F4042;
    }

    #skct-lien-quan-other {
        margin-bottom: 60px;
    }

    .slick-slide img {
        width: 100% !important;
        object-fit: cover;
        height: 500px !important
    }
</style>
<?php
getFooter(); ?>