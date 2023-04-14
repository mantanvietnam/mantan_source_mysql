<?php
getHeader();
global $urlThemeActive;
global $session;
$infoUser = $session->read('infoUser');
?>
<main>
    <section class="banner-top-style-1">
        <div class="place-img-slide">
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
    <section class="">
        <div class="container py-3 py-md-5">
            <div class="row">
                <div class="col-12 col-md-8">
                    <section id="tour-chi-tiet-intro" class="mb-4">
                        <h1 class="header-name"><?php echo @$data->name ?></h1>
                        <h3>GIỚI THIỆU</h3>
                        <p class="intro-content">
                            <?php echo @$data->introductory ?>
                        </p>
                    </section>
                    <section class="time-line">
                        <div class="">
                            <h3 class="header-name">Lịch trình</h3>
                            <p class="intro-content">
                                <?php echo @$data->content ?>
>>>>>>> 46a8c7cff866123dcefc124b29f88c0107820b4b
                            </p>
                        </div>

                    </section>
                </div>
                <div class="col-12 col-md-4">
                    <section class="tour-chi-tiet-map">
                        <div class="map-contain">
                            <div id="google-map">
                                <div class="map">
                                    <?php if (!empty($data->latitude) & !empty($data->longitude)) { ?>
                                        <div id="map_HS"></div>

                                    <?php } else { ?>
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59569.358618264!2d105.78571485795389!3d21.069270504194773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aae54053e2d5%3A0x2d72b1d7c422234b!2zVMOieSBI4buTLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1680656977802!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    <?php } ?>
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
                            <div class="card-detail d-flex align-items-center">
                                <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-promote-dat-tour.svg" alt="">
                                <span><?php echo number_format(@$data['price']); ?> VNĐ</span>
                            </div>
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
<<<<<<< HEAD
 
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </main>
      <!-- Modal -->
    <div class="modal fade" id="modal-book-tour" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-lg-5">
                    <h5 class="text-center modal-name">Thông tin</h5>
                    <form action="/booktour"  method="post">
                        <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                    <input type="hidden" value="<?php echo $data->id ;?>" name="idtour">
                                    <input type="hidden" value="<?php echo @$infoUser['id'];?>" name="idcustomer">
                                    <input type="hidden" value="<?php echo $data->urlSlug; ?>" name="urlSlug">
                        <div class="card-body p-lg-5">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="">Họ và tên</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nhập tên đăng nhập"
                                        required="">
                                </div>
                                <div class="col-12">
                                    <label for="">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại"
                                        required="">
                                </div>
                                <div class="col-12">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Nhâp email"
                                        required="">
                                </div>
                                <div class="col-12">
                                    <label for="">Số người</label>
                                    <input type="number" class="form-control" name="numberpeople" placeholder="Nhập số người" required="">
                                </div>
                                <div class="col-12">
                                    <label for="">Ghi chú</label>
                                    <textarea class="form-control" id="" name="not" rows="3" style="height: 170px;"
                                        placeholder="Nội dung"></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn button-submit-custom">Gửi</button>
                                    </div>
                                </div>
                                <div class="fb-share-button" data-href="<?php echo @$data->u ?>" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
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

<script type="text/javascript">
    function initMap() {
        var locations = [<?php
                            if (!empty(@$data)) {
                                $listShowMap = array();
                                if (!empty($data->latitude) & !empty($data->longitude)) {
                                    //$content = '<a href='.$data['urlSlug'].'></a>';
                                    $content   = '<img src=' . $data->image . ' style=width:200px;height:156px;  ><br/><a href=' . $data->urlSlug . '>' . $data->name . '</a>';
                                    $content .= '<br/>Điện thoạt: ' . $data->phone;
                                    $content .= '<br/>Địa chỉ: ' . $data->address;

                                    $listShowMap[] = '["' . $content . '", ' . $data->latitude . ', ' . $data->longitude . ', "/themes/tayho360/assets/icon/lehoi.png","su_kien"]';
                                }

                                //  $listShowMap[]= '[]';
                                echo implode(',', $listShowMap);
                            }
                            ?>];

        console.log(locations);


        var lat = <?php echo $data->latitude ?>;
        var log = <?php echo $data->longitude ?>;
        Đa
        var map = new google.maps.Map(document.getElementById('map_HS'), {
            zoom: 14,
            center: new google.maps.LatLng(lat, log),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [{
                    "featureType": "administrative",
                    "elementType": "geometry",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "poi",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "transit",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }
            ]
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;
        i = -1;
        marker = new google.maps.Marker({
            map: map
        });

        for (y = 1; y < 10; y++) {
            if ($('#check-all' + y).is(":checked")) {
                for (i = 0; i < locations.length; i++) {
                    if ($('#check-all' + y).val() == locations[i][4]) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            map: map,
                            icon: locations[i][3]
                        });

                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                                infowindow.setContent(locations[i][0]);
                                infowindow.open(map, marker);
                            }
                        })(marker, i));
                    }
                }
            }
        }


        var newPoint = {
            lat: lat,
            lng: log
        };
        marker.setIcon('');
        marker.setPosition(newPoint);
        map.setCenter(newPoint);
        i = locations.length;

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent('');
                infowindow.open(map, marker);
            }
        })(marker, i));
    }
</script>
<script>
    function checkboxAll(source, idLoad) {
        var checkboxes = document.querySelectorAll('#' + idLoad + ' input[type="checkbox"]');
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

        var x = w - h - f - 10;
        x = 300;
        // document.write(x);
        $('#map, #map_HS').css({
            'height': x
        });
    });
</script>

<style>
    .fb_iframe_widget {
        scale: 1;
        padding: 10px;
        background: #1877f2;
        border-radius: 10px;
        margin-left: 10px;
    }
</style>

<?php
getFooter(); ?>