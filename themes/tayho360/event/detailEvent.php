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
        <section id="skct-article">
            <div class="container">
                <div class="row g-4">
                    <div class="col-12 col-lg-8">
                        <article>
                            <div class="head">
                                <h1 class="mb-4"><?php echo @$data->name ?></h1>
                            </div>
                            <div class="body">
                                <div class="list-image">
                                    <div class="su-kien-slider-chi-tiet">
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-12 place-img-slide">
                        <?php if(!empty($data->image)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image2)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image2 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image3)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image3 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image4)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image4 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image5)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image5 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image6)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image6 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image7)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image7 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image8)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image8 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image9)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image9 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image10)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image10 ?>" alt="">
                        </div>
                        <?php } ?>
                    </div>
                                       
                                    </div>
                                </div>
                                <div class="content">
                                    <?php echo @$data->content ?>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-12 col-lg-4">
                        <aside class="">
                            <div class="map">
                                <?php if(!empty($data->latitude) & !empty($data->longitude)){ ?>
                                    <div id="map_HS"></div>

                            <?php }else{ ?>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59569.358618264!2d105.78571485795389!3d21.069270504194773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aae54053e2d5%3A0x2d72b1d7c422234b!2zVMOieSBI4buTLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1680656977802!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
                            <?php } ?>
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
                                               <?php echo date("d/m/Y", @$data->datestart).' - '. date("d/m/Y", @$data->dateend); ?>
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
        <section id="skct-lien-quan">
            <div class="container mt-5">
                <h2 class="mb-4">Sự kiện liên quan</h2>
                <div class="row g-3 g-lg-4">
                    <?php if(!empty($otherData)){
                    foreach(@$otherData as $key => $value){
                    if(@$data->id != @$value->id){ ?>
                    <div class="col-12 col-lg-4">
                        <a href="/chi_tiet_su_kien/<?php echo $value->urlSlug ?>.html" class="d-block text-decoration-none">
                            <div class="card card-event">
                                <img class="card-img-top" src="<?php echo $value->image ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">
                                       <?php echo $value->name ?>
                                    </h5>
                                    <p class="card-time">
                                        <?php echo date("d/m/Y", @$value->datestart).' - '. date("d/m/Y", @$value->dateend); ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php }}} ?>
                    
                </div>
            </div>
        </section>
    </main>

<script type="text/javascript">
  function initMap() {
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

    console.log(locations);


      var lat = <?php echo $data->latitude ?>;
      var log = <?php echo $data->longitude ?>;

        var map = new google.maps.Map(document.getElementById('map_HS'), {
            zoom: 14,
            center: new google.maps.LatLng(lat, log),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [
                      {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "poi",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "transit",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      }
                    ]
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;
        i= -1;
        marker = new google.maps.Marker({map: map});

        for (y = 1; y < 10; y++) {
          if($('#check-all'+y).is(":checked")){
            for (i = 0; i < locations.length; i++) {
              if($('#check-all'+y).val() == locations[i][4]){
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: locations[i][3]
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                  return function () {
                      infowindow.setContent(locations[i][0]);
                      infowindow.open(map, marker);
                  }
                })(marker, i));
              }
            }
          }
        }


        var newPoint = {lat: lat, lng: log};
        marker.setIcon('');
        marker.setPosition(newPoint);
        map.setCenter(newPoint);
        i = locations.length;

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent('');
                infowindow.open(map, marker);
            }
        })(marker, i));
  }
</script> 
<script>
  function checkboxAll(source,idLoad) {
    var checkboxes = document.querySelectorAll('#'+idLoad+' input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }

    initMap();
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDalp-JTnHUVHeh_u0d3mWnySFK204NkU0&callback=initMap"></script>

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
  });
</script>
<?php
getFooter();?>

