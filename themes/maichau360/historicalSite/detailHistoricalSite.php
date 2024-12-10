<?php
getHeader();
global $urlThemeActive;
?>
<main>
	<?php if (!empty($data->image360)){ ?>
	
         <section class="page-banner">
            <div class="iframe-banner">
                <iframe allowfullscreen="true" src="<?php echo $data->image360 ?>"
                    frameborder="0"></iframe>
            </div>
        </section>
    <?php } ?>
        <section class="section-background-index">
            <div class="container-fluid background-index">
                <img src="<?= $urlThemeActive ?>images/background-index.jpg" alt="">
            </div>
        </section>

        <section id="place-detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 place-content">
                        <div class="place-title">
                            <h1><?php echo $data->name ?></h1>
                        </div>
                        <?php if(!empty($data->address)){ ?>
                         <div class="place-address">
                            <p><i class="fa-solid fa-location-dot"></i> <?php echo $data->address ?></p>
                        </div>

                        <?php } if(!empty($data->phone)){ ?>
                         <div class="place-address">
                            <p><i class="fa-solid fa-phone"></i> <?php echo $data->phone ?></p>
                        </div>

                        <?php } if(!empty($data->email)){ ?>
                        <div class="place-address">
                            <p><i class="fa-solid fa-envelope"></i> <?php echo $data->email ?></p>
                        </div>
                        <?php } ?>
                        <!-- <div class="place-address">
	                        <p><i class="fa-solid fa-clock"></i> 8:00 - 17:00</p>
	                    </div> -->

                        <div class="button-content">
                           
                                <?php  
                                     global $session;
                                 $infoUser = $session->read('infoUser');
                                    if(!empty($infoUser)){
                                if(empty(getLike($infoUser['id'],$data->id,'dich_tich_lich_su'))){?>
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
                                <!-- <a href=""><button type="button" class="fb-share-button" data-href="/chi_tiet_dich_tich_lich_su/<?php echo $data->urlSlug ?>.html" data-layout="button_count"><i class="fa-solid fa-share-nodes"></i>Chia
                                        sẻ</button></a> -->
                                <div class="fb-share-button" data-href="" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
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
                    <?php echo str_replace(array("&nbsp;", "&nbsp;", "\t"), "", $data->content); ?>
                </div>
            </div>
        </section>

         <?php
                   if(!empty($artifact)){ ?>
        <section id="artifacts-section" class="mgt-80">
            <div class="container">
                <div class="title-section mgb-32">
                    <p>Hiện vật</p>
                </div>

                <div class="place-artifacts-slide">
                     <?php 
                    foreach(@$artifact as $key => $values){?>

                    <div class="place-artifacts-slide-item">
                        <div class="place-artifacts-img">
                            <a href="/chi_tiet_hien_vat/<?php echo $values->urlSlug ?>.html"><img src="<?php echo $values->image ?>" alt=""></a>
                        </div>
                        <div class="place-artifacts-title">
                            <a href="/chi_tiet_hien_vat/<?php echo $values->urlSlug ?>.html"><?php echo $values->name ?></a>          
                        </div>
                    </div>
                   <?php } ?>
                </div>
            </div>
        </section> 
        <?php } ?>

        <section id="map-section" class="mgt-80">
            <div class="container">
                <div class="title-section mgb-32">
                    <p>Bản đồ</p>
                </div>

                <div class="map-iframe">
                    
                      <?php if(!empty($data->latitude) & !empty($data->longitude)){ ?>
                        <div class="map-btn">
                        <a target="_blank" href="https://www.google.com/maps/dir/<?php echo $data->latitude  ?>,+<?php echo $data->longitude  ?>/">Xem chỉ đường</a>
                    </div>
                                    <div id="map_HS"></div>

                            <?php }else{ ?>
                               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126550.56754330949!2d104.92489967144137!3d20.679955282517525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3133f645315ccf35%3A0x5197e8a870126f79!2zTWFpIENow6J1LCBIw7JhIELDrG5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1703474584380!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <?php } ?>
                </div>
            </div>
        </section>
                 <?php
                   if(!empty($otherData)){ ?>
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
                            <a href="/chi_tiet_di_tich_lich_su/<?php echo $value->urlSlug ?>.html"><img src="<?php echo $value->image ?>" alt=""></a>
                        </div>


                        <div class="place-around-title">
                            <a href="/chi_tiet_di_tich_lich_su/<?php echo $value->urlSlug ?>.html"><?php echo $value->name ?></a>
                        </div>

                        <div class="place-around-box-address">
                             <div class="place-around-address">
                                <p><?php echo $value->address ?></p>
                            </div>
                            <?php if (!empty($data->latitude) & !empty($data->longitude) & !empty($value->latitude) & !empty($value->longitude)){
                                $distance = distance(@$data->latitude, @$data->longitude, @$value->latitude, @$value->longitude);
                             ?>
                                <div class="place-around-size">
                                <p><?php echo round(@$distance, 2) ?>Km</p>
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
<!-- <?php // $comment= getComment($data->id,'dich_tich_lich_su'); 
       // if(!empty($comment)){ ?>
        <section id="place-post-comment">
            <div class="container">
                <div class="row">
                    <div class="title-post-comment">
                        <p>Tất cả các bài đánh giá </p>
                    </div>
                <?php
                    foreach($comment as $key => $value){
                   //     debug($value);
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
    <?php //}  ?> -->

       

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

              $listShowMap[]= '["' . $content . '", ' . $data->latitude . ', ' . $data->longitude . ', "/themes/maichau360/tayho/assets/icon/lehoi.png","su_kien"]';
            }
        
        //  $listShowMap[]= '[]';
        echo implode(',', $listShowMap);
    }
    ?>];

     const map = L.map('map_HS', {
       center: [20.668785542548076, 105.00060413875005],
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
            L.marker([locations[i][1], locations[i][2]], {icon: icon}).bindPopup(locations[i][0]).on('mouseover', function (e) {
               this.openPopup();
              }).addTo(map);
          
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
<?php
getFooter();?>

<?php if (!empty($infoUser)){ ?>
    

<script  type="text/javascript">
    
    function addlike(){
        $.ajax({
            method: 'POST',
            url: '/apis/addlike',
            data: { idobject: <?php echo $data->id ?>,
                type: 'dich_tich_lich_su',
                idcustomer: <?php echo @$infoUser['id'] ?>,
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
                    type: 'dich_tich_lich_su',
                    idcustomer: <?php echo @$infoUser['id'] ?>,
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
                    type: 'dich_tich_lich_su',
                    comment: comment,
                    idcustomer: <?php echo @$infoUser['id'] ?>,
                },
                success:function(res){
                  console.log(res);
                  location.reload();
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