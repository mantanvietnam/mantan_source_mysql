<?php
getHeader();
global $urlThemeActive;
?>
<main>
    <?php if (!empty($data->image360)) { ?>

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
                    <?php echo $data->content ?>
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
                    <form action="">
                        <div class="input-group group-order-table">
                            <label class="input-group-text">Tên</label>
                            <input type="text" class="form-control" placeholder="Nhập họ và tên" required>
                        </div>

                        <div class="input-group group-order-table">
                            <label class="input-group-text">Điện thoại</label>
                            <input type="tel" class="form-control" placeholder="Nhập số điện thoại"
                                   pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
                        </div>

                        <div class="input-group group-order-table">
                            <label class="input-group-text">Số người</label>
                            <input type="number" class="form-control" required>
                        </div>

                        <div class="input-group group-order-table">
                            <label class="input-group-text">Nhận phòng</label>
                            <input type="date" class="form-control" required>
                        </div>

                        <div class="input-group group-order-table">
                            <label class="input-group-text">Nhận phòng</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <button type="submit">Đặt bàn ngay</button>

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
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3722.5804123529997!2d<?= $data->latitude ?>!3d<?= $data->longitude ?>!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aabfcddf68d1%3A0xc5f6bb39271c2a7b!2zQ2jDuWEgQsOgIEdpw6A!5e0!3m2!1svi!2s!4v1678994756041!5m2!1svi!2s"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- Địa điểm xung quanh -->
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
                        <a href="/chi_tiet_co_quan_hanh_chinh/<?php echo $value->urlSlug ?>.html" class="d-block text-decoration-none">
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
<?php
getFooter(); ?>

<script  type="text/javascript">
    
    function addlike(){
         

       $.ajax({
            method: 'POST',
            url: '/apis/addlike',
            data: { idobject: <?php echo $data->id ?>,
                tiype: 'nha_hang',
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
                    tiype: 'nha_hang',
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
                    tiype: 'nha_hang',
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