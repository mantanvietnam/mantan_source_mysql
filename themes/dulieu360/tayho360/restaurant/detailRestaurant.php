<?php
getHeader();
global $urlThemeActive;
global $session;
?>
<main>
    <?php if (!empty($data->image360)) { ?>

        <section class="page-banner">
            <div class="iframe-banner">
                <iframe allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" src="<?php echo $data->image360 ?>"
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
                    <div class="button-content">
                        <?php  
                                     global $session;
                                 $infoUser = $session->read('infoUser');
                                    if(!empty($infoUser)){
                                if(empty(getLike($infoUser['id'],$data->id,'nha_hang'))){?>
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
                            <a href="">
                                <button type="button"><i class="fa-solid fa-share-nodes"></i>Chia
                                    sẻ
                                </button>
                            </a>
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
                    <?php echo str_replace(array("&nbsp;", "&nbsp;", "\t"), "", $data->content) ?>
                </div>
            </div>
        </section>

    <!-- Đặt bàn -->
    <section id="order-table" style="background-image:url(<?=$urlThemeActive?>/img/background_Res.png)">
        <div class="container-order-table container">
            <div class="row-order-table row">
                <div class="col-lg-6 col-lg-6 col-md-6 col-sm-12">

                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-order-table">
                    <div class="title-order-table">
                        <p>Đặt bàn</p>
                    </div>
                    <form action="/booktour"  method="post">

                                    <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                    <input type="hidden" value="<?php echo $data->id ;?>" name="idrestaurant">
                                    <input type="hidden" value="<?php echo @$infoUser['id'];?>" name="idcustomer">
                                    <input type="hidden" value="<?php echo $data->urlSlug; ?>" name="urlSlug">
                        <div class="input-group group-order-table">
                            <label class="input-group-text">Tên</label>
                            <input type="text" class="form-control"  name="name" placeholder="Nhập họ và tên" required>
                        </div>

                        <div class="input-group group-order-table">
                            <label class="input-group-text">Điện thoại</label>
                            <input type="tel" class="form-control"  name="phone" placeholder="Nhập số điện thoại"
                                    required>
                        </div>
                        <div class="input-group group-order-table">
                            <label class="input-group-text">Email</label>
                            <input type="tel" class="form-control"  name="email" placeholder="Nhập email"
                                    required>
                        </div>

                        <div class="input-group group-order-table">
                            <label class="input-group-text">Số người</label>
                            <input type="number" class="form-control"  name="numberpeople" required>
                        </div>

                        <div class="input-group group-order-table">
                            <label class="input-group-text">Thời gian đặn</label>
                            <input type="datetime-local" class="form-control"  name="timebook" required>
                        </div>
                        <div class="input-group group-order-table">
                            <label class="input-group-text">Ghi chú</label>
                             <textarea name="not" id="not"  placeholder="Nội dung" onkeyup="" class="form-control" rows="3"></textarea>
                        </div>
                       <?php if(!empty($infoUser)){ ?>
                        <button type="submit">Đặt bàn ngay</button>
                    <?php }else{ ?>
                        <a  class="like" href="/login" ><button type="submit">Đặt bàn ngay</button></a>
                    <?php } ?>
                    </form>
                </div>


            </div>
        </div>
    </section>

    <!-- Bản đồ -->
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
         <?php  if(!empty($otherData)){ ?>
        <section id="place-around-section" class="mgt-80">
            <div class="container">
                <div class="title-section mgb-32">
                    <p>Địa điểm xung quanh</p>
                </div>

                <div class="place-around-slide">
                     <?php 
                    foreach(@$otherData as $key => $value){
                    if(@$data->id != @$value->id){ ?>
                    <div class="place-around-slide-item">
                        <div class="place-around-img">
                            <a href="/chi_tiet_nha_hang/<?php echo $value->urlSlug ?>.html"><img src="<?php echo $value->image ?>" alt=""></a>
                        </div>


                        <div class="place-around-title">
                            <a href="/chi_tiet_nha_hang/<?php echo $value->urlSlug ?>.html"><?php echo $value->name ?></a>
                        </div>

                        <div class="place-around-box-address">
                            <div class="place-around-address">
                                <p><?php echo $value->address ?></p>
                            </div>
                            <?php if (!empty($data->latitude) & !empty($data->longitude) & !empty($value->latitude) & !empty($value->longitude)){
                                $distance = distance($data->latitude, $data->longitude, $value->latitude, $value->longitude);
                             ?>
                                <div class="place-around-size">
                                <p><?php echo round($distance, 2) ?>Km</p>
                            </div>
                            <?php } ?>
                            

                            
                        </div>
                    </div>
                   <?php }} ?>
                </div>
            </div>
        </section> 
        <?php } ?>

         <?php     global $session;
                                 $infoUser = $session->read('infoUser');
                                    if(!empty($infoUser)){
                                        ?>

       <section id="place-comment" class="mgt-80">
            <div class="container">
                <div class="title-section mgb-32">
                    <p>Đánh giá</p>
                </div>
               
                <div class="row box-write-comment">
                    <div class="write-comment">
                        <button class="button-write-comment" type="button">
                            <div class="button-icon-comment">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-chat-right-dots" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"></path>
                                    <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                                </svg>
                            </div>
                            <p class="button-text-comment">Viết đánh giá</p>
                        </button>
                    </div>

                    <!-- viet content  -->
                    <div class="write-comment-content" style="">
                        <div class="information-people-write">
                            <img class="information-people-write-img" src="<?php echo $infoUser['avatar'] ?>" alt="">
                            <p class="information-people-write-name"><?php echo $infoUser['full_name'] ?>
                        </p></div>
                        <div class="form-comment">
                    
                            <textarea class="content-post" name="content-post" id="comment" placeholder="Viết suy nghĩ của bạn"></textarea>
                            <button type="submit" class="send-comment" onclick="addComment()">Đăng bài</button>
            
                        </div>

                    </div>
                </div>
            </div>
        </section>
<?php } ?>
<?php  $comment= getComment($data->id,'nha_hang'); 
        if(!empty($comment)){ ?>
        <section id="place-post-comment">
            <div class="container">
                <div class="row">
                    <div class="title-post-comment">
                        <p>Tất cả các bài đánh giá </p>
                    </div>
                <?php
                    foreach($comment as $key => $value){
                    $custom =  getCustomer($value->idcustomer);
                
                     if(!empty($custom)){
                ?>
                    <div class="post-comment">
                        <div class="post-comment-content">
                            <div class="information-people">
                                <div class="information-people-img">
                                    <img src="<?php echo $custom->avatar ?>"
                                        alt="">
                                </div>
                                <div class="information-people-box">
                                    <div class="information-people-name">
                                        <span><?php echo $custom->full_name ?></span>
                                    </div>
                                    <div class="information-people-hour">
                                        <span><?php echo date("d/m/Y H:i:s",$value->created); ?></span>
                                    </div>
                                </div>
                            </div>

        
                        </div>

                        <div class="post-comment-content-text">
                            <?php echo $value->comment ?>
                        </div>
                          <?php  if(@$infoUser['id']==@$value->idcustomer){ ?>
                         <div class="post-comment-content-text">
                            <a href="javascript:void(0);" onclick="deteleComment(<?php echo $value->id ?>)">xóa</a>
                        </div>
                    <?php } ?>
                    </div>
                   

                     <?php }} ?>             
                    
                </div>
            </div>
        </section>
    <?php }  ?>

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
getFooter(); ?>
<?php if (!empty(@$infoUser)){ ?>
<script  type="text/javascript">
    
    function addlike(){
         

       $.ajax({
            method: 'POST',
            url: '/apis/addlike',
            data: { idobject: <?php echo $data->id ?>,
                type: 'nha_hang',
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
                    type: 'nha_hang',
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

    function addComment(){
    var comment= $('#comment').val();

    $.ajax({
                method: 'POST',
                url: '/apis/addComment',
                data: { idobject: <?php echo $data->id ?>,
                    type: 'nha_hang',
                    comment: comment,
                    idcustomer: <?php echo $infoUser['id'] ?>,
                },
                success:function(res){
                  console.log(res);
                }
            })
               
        };

    function deteleComment($id){
    $.ajax({
                method: 'POST',
                url: '/apis/deleleComment',
                data: { id: $id },
                success:function(res){
                  console.log(res);
                  location.reload();
                }
            })
               
        }; 
</script>
<?php } ?>