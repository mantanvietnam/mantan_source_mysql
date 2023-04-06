<?php
getHeader();
global $urlThemeActive;
?>
<main>
    <?php if (!empty($data->image360)){ ?>
    
         <section class="page-banner">
            <div class="iframe-banner">
                <iframe src="<?php echo $data->image360 ?>"
                    frameborder="0"></iframe>
            </div>
        </section>
    <?php } ?>
        <section class="section-background-index">
            <div class="container-fluid background-index">
                <img src="<?= $urlThemeActive ?>img/background-index.jpg" alt="">
            </div>
        </section>

        <section id="place-detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 place-content">
                        <div class="place-title">
                            <p><?php echo $data->name ?></p>
                        </div>
                        <div class="place-address">
                            <p><i class="fa-solid fa-phone"></i><?php echo $data->address ?></p>
                        </div>
                         <div class="place-address">
                            <p><i class="fa-solid fa-location-dot"></i> <?php echo $data->phone ?></p>
                        </div>
                         <div class="place-address">
                            <p><i class="fa-solid fa-clock"></i> 8:00 - 17:00</p>
                        </div>
                        <div class="button-content">
                            <div class="button-like">
                                <button type="button"><i class="fa-regular fa-heart"></i>Yêu thích</button>
                            </div>
                            <div class="button-share">
                                <a href=""><button type="button"><i class="fa-solid fa-share-nodes"></i>Chia
                                        sẻ</button></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-8 col-12 place-img-slide">
                        <div class="img-slide-item">
                            <img src="<?php echo $data->image ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section id="place-information" class="mgt-80">
            <div class="container">
               <!--  <div class="title-h1 title-information mgb-32">
                    <p>Chùa bà già</p>
                </div> -->
                <div class="icon-information mgb-32">
                   
                   
                    <!-- <div class="icon-information-price">
                        <p><i class="fa-solid fa-tag"></i> 100.000 vnđ</p>
                    </div> -->
                </div>
                <div class="content-information mgb-32">
                    <?php echo $data->content ?>
                </div>
            </div>
        </section>

        <section id="map-section" class="mgt-80">
            <div class="container">
                <div class="title-section mgb-32">
                    <p>Bản đồ</p>
                </div>

                <div class="map-iframe">
                      <?php if(!empty($data->latitude) & !empty($data->longitude)){ ?>
                                    <div id="map_HS"></div>

                            <?php }else{ ?>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59569.358618264!2d105.78571485795389!3d21.069270504194773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aae54053e2d5%3A0x2d72b1d7c422234b!2zVMOieSBI4buTLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1680656977802!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
                            <?php } ?>
                </div>
            </div>
        </section>
        <!-- Địa điểm xung quanh -->
        <!-- <section id="place-around-section" class="mgt-80">
            <div class="container">
                <div class="title-section mgb-32">
                    <p>Địa điểm xung quanh</p>
                </div>

                <div class="place-around-slide">
                    <div class="place-around-slide-item">
                        <div class="place-around-img">
                            <a href=""><img src="../img/chua-ba-gia-1-1536x1051-0304.png" alt=""></a>
                        </div>


                        <div class="place-around-title">
                            <a href="">Làng cổ Nghi Tầm</a>
                        </div>

                        <div class="place-around-box-address">
                            <div class="place-around-address">
                                <p>Phường Quảng An, Tây Hồ</p>
                            </div>

                            <div class="place-around-size">
                                <p>12 km</p>
                            </div>
                        </div>
                    </div>

                    <div class="place-around-slide-item">
                        <div class="place-around-img">
                            <a href=""><img src="../img/chua-ba-gia-1-1536x1051-0304.png" alt=""></a>
                        </div>


                        <div class="place-around-title">
                            <a href="">Làng cổ Nghi Tầm</a>
                        </div>

                        <div class="place-around-box-address">
                            <div class="place-around-address">
                                <p>Phường Quảng An, Tây Hồ</p>
                            </div>

                            <div class="place-around-size">
                                <p>12 km</p>
                            </div>
                        </div>
                    </div>

                    <div class="place-around-slide-item">
                        <div class="place-around-img">
                            <a href=""><img src="../img/chua-ba-gia-1-1536x1051-0304.png" alt=""></a>
                        </div>


                        <div class="place-around-title">
                            <a href="">Làng cổ Nghi Tầm</a>
                        </div>

                        <div class="place-around-box-address">
                            <div class="place-around-address">
                                <p>Phường Quảng An, Tây Hồ</p>
                            </div>

                            <div class="place-around-size">
                                <p>12 km</p>
                            </div>
                        </div>
                    </div>

                    <div class="place-around-slide-item">
                        <div class="place-around-img">
                            <a href=""><img src="../img/chua-ba-gia-1-1536x1051-0304.png" alt=""></a>
                        </div>


                        <div class="place-around-title">
                            <a href="">Làng cổ Nghi Tầm</a>
                        </div>

                        <div class="place-around-box-address">
                            <div class="place-around-address">
                                <p>Phường Quảng An, Tây Hồ</p>
                            </div>

                            <div class="place-around-size">
                                <p>12 km</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- Đánh gíá -->
        <!-- <section id="place-comment" class="mgt-80">
            <div class="container">
                <div class="title-section mgb-32">
                    <p>Đánh giá</p>
                </div>
                <div class="row mgb-50">
                    <div class="col-lg-7 col-md-7 col-sm-7 box-point-bar">
                        <div class="box-progress">
                            <div class="number-progess"><span>5</span></div>
                            <div class="progress point-progress">
                                <div class="point-progress-bar progress-bar" role="progressbar" style="width: 100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="number-progess"><span>4</span></div>
                            <div class="progress point-progress">
                                <div class="point-progress-bar progress-bar" role="progressbar" style="width: 25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="number-progess"><span>3</span></div>
                            <div class="progress point-progress">
                                <div class="progress-bar point-progress-bar" role="progressbar" style="width: 50%"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="number-progess"><span>2</span></div>
                            <div class="progress point-progress">
                                <div class="progress-bar point-progress-bar" role="progressbar" style="width: 75%"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="number-progess"><span>1</span></div>
                            <div class="progress point-progress">
                                <div class="progress-bar point-progress-bar" role="progressbar" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-lg-5 col-sm-5 box-point-right">
                        <div class="point-right-number">
                            <p>4.1</p>
                        </div>
                        <div class="point-right-star">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>

                        </div>

                        <div class="point-right-post">
                            <p>4.123 <span>bài viết</span></p>
                        </div>
                    </div>
                </div>

                <div class="row box-write-comment">
                    <div class="write-comment">
                        <button class="button-write-comment" type="button">
                            <div class="button-icon-comment">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="bi bi-chat-right-dots" viewBox="0 0 16 16">
                                    <path
                                        d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z" />
                                    <path
                                        d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </div>
                            <p class="button-text-comment">Viết đánh giá</p>
                        </button>
                    </div>

                      <div class="write-comment-content">
                        <div class="information-people-write">
                            <img class="information-people-write-img"
                                src="../img/worried-man-avata-avatar-worried-man-vector-illustration-107469775.jpg"
                                alt="">
                            <p class="information-people-write-name">Nguyễn Quốc Việt</span>
                        </div>

                        <div class="rating-box">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>

                        <div class="form-comment">
                            <textarea class="content-post" name="content-post"
                                placeholder="Viết suy nghĩ của bạn"></textarea>
                            <button type="submit" class="send-comment">Đăng bài</button>
                        </div>

                    </div>
                </div>
            </div>
        </section> -->

        <!--Bài viết Đánh gíá -->
        <section id="place-post-comment">
            <div class="container">
                <div class="row">
                    <div class="title-post-comment">
                        <p>Tất cả các bài đánh giá</p>
                    </div>

                    <div class="post-comment">
                        <div class="post-comment-content">
                            <div class="information-people">
                                <div class="information-people-img">
                                    <img src="../img/worried-man-avata-avatar-worried-man-vector-illustration-107469775.jpg"
                                        alt="">
                                </div>
                                <div class="information-people-box">
                                    <div class="information-people-name">
                                        <span>Nguyễn Quốc Việt</span>
                                    </div>
                                    <div class="information-people-hour">
                                        <span>3 giờ trước</span>
                                    </div>
                                </div>
                            </div>

                            <div class="information-people-star">
                                <div class="point-right-star">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>

                        <div class="post-comment-content-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat
                        </div>
                    </div>

                    <div class="post-comment">
                        <div class="post-comment-content">
                            <div class="information-people">
                                <div class="information-people-img">
                                    <img src="../img/worried-man-avata-avatar-worried-man-vector-illustration-107469775.jpg"
                                        alt="">
                                </div>
                                <div class="information-people-box">
                                    <div class="information-people-name">
                                        <span>Nguyễn Quốc Việt</span>
                                    </div>
                                    <div class="information-people-hour">
                                        <span>3 giờ trước</span>
                                    </div>
                                </div>
                            </div>

                            <div class="information-people-star">
                                <div class="point-right-star">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>

                        <div class="post-comment-content-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat
                        </div>
                    </div>

                    <div class="post-comment">
                        <div class="post-comment-content">
                            <div class="information-people">
                                <div class="information-people-img">
                                    <img src="../img/worried-man-avata-avatar-worried-man-vector-illustration-107469775.jpg"
                                        alt="">
                                </div>
                                <div class="information-people-box">
                                    <div class="information-people-name">
                                        <span>Nguyễn Quốc Việt</span>
                                    </div>
                                    <div class="information-people-hour">
                                        <span>3 giờ trước</span>
                                    </div>
                                </div>
                            </div>

                            <div class="information-people-star">
                                <div class="point-right-star">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>

                        <div class="post-comment-content-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- <section id="pagination-page">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a>
                    </li>
                    <li class="page-item "><a class="page-link active" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>
        </section>  -->

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
    x= 300;
    // document.write(x);
    $('#map, #map_HS').css({'height':x});
  });
</script>
<?php
getFooter();?>