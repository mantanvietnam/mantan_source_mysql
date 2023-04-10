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
                            <h1><?php echo $data->name ?></h1>
                        </div>
                        <div class="place-address">
                            <p><i class="fa-solid fa-location-dot"></i> <?php echo $data->address ?></p>
                        </div>
                         <div class="place-address">
                        	<p><i class="fa-solid fa-phone"></i> <?php echo $data->phone ?></p>
                    	</div>
                        <div class="place-address">
	                        <p><i class="fa-solid fa-envelope"></i> <?php echo $data->email ?></p>
	                    </div>
                        <!-- <div class="place-address">
	                        <p><i class="fa-solid fa-clock"></i> 8:00 - 17:00</p>
	                    </div> -->

                        <div class="button-content">
                            <?php  
                                     global $session;
                                 $infoUser = $session->read('infoUser');
                                    if(!empty($infoUser)){
                                if(empty(getLike($infoUser['id'],$data->id,'dich_vu_ho_tro_du_lich'))){?>
                            <div class="button-like">
                                <button type="button" onclick="addlike()"><i class="fa-regular fa-heart"></i>Yêu thích</button>
                            </div>
                                <?php }else{
                                  
                                 ?>
                                    <div class="button-like">

                                <button type="button" onclick="delelelike()" style="background-color: rgb(24, 129, 129); color: rgb(255, 255, 255);"><i class="fa-regular fa-heart" style="color: rgb(255, 255, 255);"></i>Yêu thích</button>
                            </div>
                           
                                <?php }  }else{ ?>
                                     <div class="button-like">
                                        <a  class="like" href="/login" ><button type="button" ><i class="fa-regular fa-heart"></i>Yêu thích</button></a>
                                        </div>
                                <?php   } ?>
                            <div class="button-share">
                                <a href=""><button type="button"><i class="fa-solid fa-share-nodes"></i>Chia
                                        sẻ</button></a>
                            </div>
                        </div>
                    </div>

                    
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

        </section>

        <section id="place-information" class="mgt-30">
            <div class="container">
                <div class="title-h1 title-information mgb-32">
                    <p>Giới thiệu</p>
                </div>
                <!-- <div class="icon-information mgb-32">   
                    <div class="icon-information-price">
                        <p><i class="fa-solid fa-tag"></i> 100.000 vnđ</p>
                    </div>
                </div> -->
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
         <?php  if(!empty($otherData)){ ?>
        <section id="skct-lien-quan">
            <div class="container mt-5">
                <h2 class="mb-4">Điển đến khác</h2>
                <div class="row g-3 g-lg-4">
                    <?php 
                    foreach(@$otherData as $key => $value){
                    if(@$data->id != @$value->id){ ?>
                    <div class="col-12 col-lg-4">
                        <a href="/chi_tiet_dich_vu_ho_tro/<?php echo $value->urlSlug ?>.html" class="d-block text-decoration-none">
                            <div class="card card-event">
                                <img class="card-img-top" src="<?php echo $value->image ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">
                                       <?php echo $value->name ?>
                                    </h5>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                <?php }} ?>
                    
                </div>
            </div>
        </section>
        <?php } ?>

       

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

<script  type="text/javascript">
    
    function addlike(){
         

       $.ajax({
            method: 'POST',
            url: '/apis/addlike',
            data: { idobject: <?php echo $data->id ?>,
                tiype: 'dich_vu_ho_tro_du_lich',
                idcustomer: <?php echo $infoUser['id'] ?>,
            },
            success:function(res){
              console.log('res');
                $('#like_save').load(location.href + ' #like_save>*');
                $('#place-detail .button-like button').css('background-color', '#188181');
                $('#place-detail .button-like button').css('color', '#fff')
                $('.button-like i').css('color', '#fff');
            }
        })
            
    };
 function delelelike(){

          $.ajax({
                method: 'POST',
                url: '/apis/delelelike',
                data: { idobject: <?php echo $data->id ?>,
                    tiype: 'dich_vu_ho_tro_du_lich',
                    idcustomer: <?php echo $infoUser['id'] ?>,
                },
                success:function(res){
                  console.log('res');
                    $('#like_save').load(location.href + ' #like_save>*');
                    $('#place-detail .button-like button').css('background-color', 'rgb(24 129 129 / 0%)');
                    $('#place-detail .button-like button').css('color', '#3F4042')
                    $('.button-like i').css('color', '#126B66');
                }
            })
               
        };  
</script>