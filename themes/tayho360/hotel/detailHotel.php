<?php getHeader();
 global $session;
    $infoUser = $session->read('infoUser');
   /* debug($data);
    die;*/
?>

    <script src="<?php echo @$urlThemeActive ?>assets/js/jquery.datetimepicker.full.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js'></script>
    <!-- <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css'> -->
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css'>
    <link rel="stylesheet" href="<?php echo @$urlThemeActive ?>assets/css/datetimepicker.css">
  <main>
  			<?php if(!empty($data->image360)){ ?>
        <section class="page-banner">
            <div class="iframe-banner">
                <iframe src="<?php echo @$data->image360;?>"
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
                            <h1><?php echo @$data->name;?></h1>
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
                        
                        <div class="button-content">
                             <?php  
                                     global $session;
                                 $infoUser = $session->read('infoUser');
                                    if(!empty($infoUser)){
                                if(empty(getLike($infoUser['id'],$data->id,'khach_san'))){?>
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
                                <!-- <a href=""><button type="button"><i class="fa-solid fa-share-nodes"></i>Chia
                                        sẻ</button></a> -->
                                <div class="fb-share-button" data-href="" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                            </div>                          
                        </div>
                        <div class="button-book">
                                <?php if(!empty($infoUser)){  ?>
                                    <a href="" class="btn button-submit-custom" data-bs-toggle="modal" data-bs-target="#modal-book-room">Đặt phòng</a>
                                <?php }else{ ?> 
                                    <a href="/login" class="btn button-submit-custom" >Đặt phòng</a>
                                <?php } ?>
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

        <!-- Tiện nghi -->
        <section id="section-convenient" class="mgt-80">
            <div class="container">
                <div class="row">
                    <div class="title-h2 mgb-32">
                        <h3>Tiện Nghi Dịch Vụ</h3>
                    </div>
                    <?php foreach ( explode(',', @$data->furniture) as $furniture) { ?>	
                    <div class="col-lg-4 col-md-4 col-6 convenient-box">
                        <div class="convenient-item">
                            <p><i class="far fa-check-circle"></i>  <?php echo $tmpVariable['listFurniture'][$furniture]['name']  ?></p>
                        </div>
                    </div>
                 <?php } ?>
                </div>
            </div>
        </section>

        <section id="place-information" class="mgt-80">
            <div class="container">
                <div class="title-h1 title-information mgb-32">
                    <p>Giới thiệu</p>
                </div>
                <div class="content-information mgb-32">
                    <?php echo str_replace(array("&nbsp;", "&nbsp;", "\t"), "", $data->content); ?>
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
                    <div class="map-iframe">
                                    <div id="map_HS"></div>
                </div>
                </div>
            </div>
        </section>

        <!--Danh sách phòng 
        <?php if(!empty($tmpVariable['data']['HotelManmo']['listTypeRoom'])){  ?>
        <section class="danh-sach-phong mgt-80">
            <div class="container">
                <div class="title-section mgb-32">
                    <p>Danh sách phòng</p>
                </div>
                <div class="body">
                    <div class="row g-3">
                    	<?php
				
					     foreach ($tmpVariable['data']['HotelManmo']['listTypeRoom'] as $value) { ?>
                        <div class="col-12 room-item">
                            <div class="danh-sach-phong-item">
                                <div class="card">
                                    <div class="card-body px-lg-5">
                                        <div class="row g-3">
                                            <div class="col-12 col-lg-3">
                                                <img src="<?php echo @$value['TypeRoom']['image']?>" alt="">
                                            </div>
                                            <div class="col-12 col-lg-6 border-right-line">
                                                <div class="room-detail">
                                                    <h6>Phòng 2 giường đơn</h6>
                                                    <div class="row g-2">
                                                        <div class="col-12 col-md-6">
                                                            <div class="roon-service">
                                                                <div class="d-flex align-items-center">
                                                                    <img class="me-2"
                                                                        src="../assets/lou_icon/icon-bed.svg" alt="">
                                                                    <span> <?php echo @$value['TypeRoom']['so_giuong']?> giường đơn</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="roon-service">
                                                                <div class="d-flex align-items-center">
                                                                    <img class="me-2"
                                                                        src="<?= $urlThemeActive ?>/assets/lou_icon/icon-dien-tich.svg"
                                                                        alt="">
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="roon-service">
                                                                <div class="d-flex align-items-center">
                                                                    <img class="me-2"
                                                                        src="<?= $urlThemeActive ?>/assets/lou_icon/icon-person.svg" alt="">
                                                                    <span>Tối đa <?php echo @$value['TypeRoom']['so_giuong']?>  người</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="roon-service">
                                                                <div class="d-flex align-items-center">
                                                                    <img class="me-2"
                                                                        src="<?= $urlThemeActive ?>/assets/lou_icon/icon-eye-room.svg"
                                                                        alt="">
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <div class="room-price h-100">
                                                    <div class="d-flex flex-column justify-content-end align-items-end">
                                                      
                                                        <div class="price mb-3">
                                                            <?php echo number_format($value['TypeRoom']['ngay_thuong']['gia_ngay']) ?> đ
                                                        </div>
                                                        <div class="button">
                                                        	 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php   } ?>

                    </div>
                </div>
            </div>
        </section> 
        <?php   } ?>-->
        <!-- Địa điểm xung quanh -->
        <section id="place-around-section" class="mgt-80">
            <div class="container">
                <div class="title-section mgb-32">
                    <p>Khách sạn xung quanh</p>
                </div>

                <div class="place-around-slide">
                     <?php 

                    foreach(@$otherData as $key => $value){
                    if(@$data->id != @$value->id){ ?>
                    <div class="place-around-slide-item">
                        <div class="place-around-img">
                            <a href="/chi_tiet_khach_san/<?php echo $value->urlSlug ?>.html"><img src="<?php echo $value->image ?>" alt=""></a>
                        </div>


                        <div class="place-around-title">
                            <a href="/chi_tiet_khach_san/<?php echo $value->urlSlug ?>.html"><?php echo $value->name ?></a>
                        </div>

                        <div class="place-around-box-address">
                            <div class="place-around-address">
                                <p><?php echo $value->address ?></p>
                            </div>
                            <?php if (!empty($data->latitude) && !empty($data->longitude) && !empty($value->latitude) && !empty($value->longitude)){
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
<?php 

 $comment= getComment($data->id,'khach_san'); 
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
    <?php 
if(@$_GET['status']=='bookHotelDone'){ ?>   
<div class="modal notification" tabindex="-1" role="dialog" style="display: block;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thông báo</h5>
        <a href="/chi_tiet_khach_san/<?php echo $data->urlSlug ?>.html" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">
        <p>Bạn đặt phòng thành công.</p>
      </div>
      <div class="modal-footer">
       
        <a href="/chi_tiet_khach_san/<?php echo $data->urlSlug ?>.html" type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
      </div>
    </div>
  </div>
</div>
<?php }elseif (@$_GET['status']=='bookHotelfailure') {?>
  
<div class="modal notification" tabindex="-1" role="dialog" style="display: block;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thông báo</h5>
        <a href="/chi_tiet_khach_san/<?php echo $data->urlSlug ?>.html" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">
        <p>Bạn đặt phòng không thành công.</p>
      </div>
      <div class="modal-footer">
       
        <a href="/chi_tiet_khach_san/<?php echo $data->urlSlug ?>.html" type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
      </div>
    </div>
  </div>
</div>
<?php }?>
    </main>
        <div class="modal fade" id="modal-book-room" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="text-center modal-name">Đặt phòng</h5>
                    <form action="/bookHotel" method="post"  >
                        <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                        <input type="hidden" value="<?php echo @$infoUser['id'];?>" name="idcustomer">
                        <input type="hidden" value="<?php echo @$data->id;?>" name="idhotel">
                        <input type="hidden" value="<?php echo @$data->urlSlug ;?>" name="urlSlug">
				<div class="row">
					<div class="col-md-6">
						<p>Họ Tên</p>
						<input type="text"  name="name"  required="" class="form-control" id="name" value="<?php echo @$infoUser['full_name']; ?>">
					</div>
					<div class="col-md-6">
						<p>Số điện thoại</p>
						<input type="text" name="phone" required="" class="form-control" id="phone" value="<?php echo @$infoUser['phone']; ?>">
					</div>
					<div class="col-md-6">
						<p>Email</p>
						<input type="text" required="" name="email" class="form-control" id="email" value="<?php echo @$infoUser['email']; ?>">
					</div>
					<div class="col-md-6">
						<p>Ngày vào dự kiến</p>
						<!-- <input type="text" id="date_start" required="" autocomplete="off"	> -->
						<input type="text" value="" name="date_start" id="date_start" class="input_date form-control" required="" onclick="tinhthoigian();" onchange="tinhthoigian();" autocomplete="off">
					</div>
					<div class="col-md-6">
						<p>Ngày ra dự kiến</p>
						<!-- <input type="text" id="date_end"> -->
						<input type="text" value="" name="date_end" id="date_end" class="input_date form-control" required="" onclick="tinhthoigian();" onchange="tinhthoigian();" autocomplete="off">
					</div>
					<!-- <div class="col-md-6">
						<p>Hình thức nghỉ</p>
						<select name="type_register" class="form-control" id="type_register" onchange="tinhphi();">
							<option value=""  class="form-control" data-imagesrc="">Hình thức nghỉ </option>
                            <option value="gia_theo_gio" data-imagesrc="">Nghỉ giờ</option>
                            <option value="gia_theo_dem" data-imagesrc="">Nghỉ đêm</option>
                            <option value="gia_theo_ngay" data-imagesrc="">Nghỉ ngày</option>
						</select>
					</div> -->
					<!-- <div class="col-md-6">
						<p>Loại phòng</p>
						<select name="typeRoom" class="form-control" id="typeRoom" onchange="tinhphi();">
							<option  class="form-control" value="">Chọn loại phòng</option>
							<?php if (!empty($tmpVariable['data']['HotelManmo']['listTypeRoom'])){
									foreach($tmpVariable['data']['HotelManmo']['listTypeRoom'] as $keytype => $typeRoom){?>
										<option value="<?php echo $typeRoom['TypeRoom']['id'] ?>"><?php echo $typeRoom['TypeRoom']['roomtype'] ?></option>

							<?php }} ?>
								
						</select>
					</div> -->
					<div class="col-md-6">
						<p>Số người</p>
						<input type="number" name="number_people" class="input_date form-control" id="number_people"  required=""  value="" min="1" >
					</div>
					<!-- <div class="col-md-6">
						<p>Số phòng</p>
						<input type="number" name="number_room" class="input_date form-control" id="number_room" required="" value="" min="1" onchange="tinhphi();">
					</div> -->
					<!-- <div class="col-md-6">
						<p>Thời gian dự kiến</p>
						<input type="text" name="timePay" class="input_date form-control" id="timePay" value="" required="" disabled="" placeholder="Thời gian ở">
					</div> -->
					<!-- <div class="col-md-6">
						<p>Chi phí dự kiến</p>
						<input type="text" name="pricepay" class="input_date form-control" id="pricePay" value="" required=""  disabled="" placeholder="Chi phí dự kiến">
                        <input type="hidden" name="pricepay1" class="input_date form-control" id="pricePay1" value=""  placeholder="Chi phí dự kiến">
					</div> -->
					<div class="col-md-12" style=" margin-top: 55px;">
						<button type="submit" class="btn button-submit-custom">Đặt Phòng</button>
					</div>
				</div>
			</form>
                </div>
            </div>
        </div>
    </div>



		<script type="text/javascript">
    jQuery('#date_start, #date_end').datetimepicker({
    	format:'d/m/Y H:i'
   	}).on('dp.change', function (e) { tinhthoigian(); });
</script> 

 <?php getfooter()?>


<script>
	$('.btn_pop_book').click(function(){
		$('.booking').css('display','block');
		$('.remover_form').css({ 'visibility': 'visible', 'opacity': '1' })
	})

$('.click_forms').click(function() {
    $('.booking').css('display', 'none');
    $('.remover_form').css({ 'visibility': 'hidden', 'opacity': '0' })
})
</script>

<!-- booking -->




<script type="text/javascript">
		$('[data-fancybox="images"]').fancybox({
			  buttons : [ 
			    'slideShow',
			    'share',
			    'zoom',
			    'fullScreen',
			    'close'
			  ],
			  thumbs : {
			    autoStart : true
			  }
			});
	</script>

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
<?php if (!empty($infoUser)){ ?>

<script  type="text/javascript">
    
    function addlike(){
         

       $.ajax({
            method: 'POST',
            url: '/apis/addlike',
            data: { idobject: '<?php echo @$data->id; ?>',
                type: 'khach_san',
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
                data: { idobject: '<?php echo @$data->id; ?>',
                    type: 'khach_san',
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
                data: { idobject: '<?php echo @$data->id; ?>',
                    type: 'khach_san',
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