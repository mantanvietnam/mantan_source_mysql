<?php getHeader();
 global $session;
    $infoUser = $session->read('infoUser');
?>

    <script src="<?php echo @$urlThemeActive ?>assets/js/jquery.datetimepicker.full.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js'></script>
    <!-- <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css'> -->
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css'>
    <link rel="stylesheet" href="<?php echo @$urlThemeActive ?>assets/css/datetimepicker.css">
  <main>
  			<?php if(!empty($data['HotelManmo']['data']['Hotel']['link360'])){ ?>
        <section class="page-banner">
            <div class="iframe-banner">
                <iframe src="<?php echo @$data['HotelManmo']['data']['Hotel']['link360'];?>"
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
                            <h1><?php echo @$data['HotelManmo']['data']['Hotel']['name'];?></h1>
                        </div>
                        <div class="place-address">
                            <p><i class="fa-solid fa-location-dot"></i> <?php echo @$data['HotelManmo']['data']['Hotel']['address'];?></p>
                        </div>
                        <div class="place-address">
                        <p><i class="fa-solid fa-phone"></i> <?php echo @$data['HotelManmo']['data']['Hotel']['phone'];?></p>
                    </div>
                        <div class="button-content">
                             <?php  
                                     global $session;
                                 $infoUser = $session->read('infoUser');
                                    if(!empty($infoUser)){
                                if(empty(getLike($infoUser['id'],$data['HotelManmo']['data']['Hotel']['id'],'khach_san'))){?>
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
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-8 col-12 place-img-slide">
                   <?php if(!empty($data['HotelManmo']['data']['Hotel']['image'])){ 
                   		foreach($data['HotelManmo']['data']['Hotel']['image'] as $keyImage => $valueImage){
                   	?>
                        <div class="img-slide-item">
                            <img src="<?php echo $valueImage;  ?>" alt="">
                        </div>
                        <?php }} ?>
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
                    <?php foreach ($data['HotelManmo']['data']['Hotel']['furniture'] as $furniture) { ?>	
                    <div class="col-lg-4 col-md-4 col-6 convenient-box">
                        <div class="convenient-item">
                            <!-- <div class="convenient-icon">
                                <img src="../img/Vector (2).png" alt="">
                            </div> -->
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
                    <h2>Giới Thiệu <?php echo @$data['HotelManmo']['data']['Hotel']['name'];?></h2>
				 <?php
                        if(empty($data['HotelManmo']['data']['Hotel']['info'])){
                            $numberRoomText= (!empty($data['HotelManmo']['data']['Hotel']['numberRoom']))?$data['HotelManmo']['data']['Hotel']['name'].' có quy mô '.$data['HotelManmo']['data']['Hotel']['numberRoom'].' phòng, ':'';
                            $pointText= (!empty($data['HotelManmo']['data']['Hotel']['point']))?' và họ đã cho '.$data['HotelManmo']['data']['Hotel']['point'].' điểm sau khi nghỉ tại đây':'';

                            $data['HotelManmo']['data']['Hotel']['info']= $data['Hotel']['name'].' là một '.$data['HotelManmo']['typeHotel'].' đẹp có địa chỉ ngay tại '.$data['HotelManmo']['data']['Hotel']['address'].', đường đi rất thuận tiện và dễ tìm. '.$data['HotelManmo']['data']['Hotel']['name'].' có đội ngũ nhân viên chuyên nghiệp, luôn cố gắng phục vụ mọi nhu cầu của khách hàng, vui lòng khách đến, vừa lòng khách đi, '.$numberRoomText.'phòng ốc của '.$data['HotelManmo']['data']['Hotel']['name'].' sạch đẹp, đầy đủ tiện ích trong phòng, có đầy đủ nóng lạnh, internet. Các cặp đôi đặc biệt thích địa điểm '.$data['HotelManmo']['data']['Hotel']['name'].$pointText.'. Chỗ nghỉ này cũng được đánh giá là đáng giá tiền nhất ở quanh khu vực, bạn sẽ tiết kiệm được nhiều hơn so với các chỗ nghỉ khác. ';
                        }

                        echo  str_replace(array("&nbsp;", "&nbsp;", "\t"), "", $data['HotelManmo']['data']['Hotel']['info']);
                    ?>
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
                      <?php if(!empty(@$data['HotelManmo']['data']['Hotel']['coordinates_x']) & !empty($data['HotelManmo']['data']['Hotel']['coordinates_y'])){ ?>
                                    <div id="map_HS"></div>

                            <?php }else{ ?>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59569.358618264!2d105.78571485795389!3d21.069270504194773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aae54053e2d5%3A0x2d72b1d7c422234b!2zVMOieSBI4buTLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1680656977802!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
                            <?php } ?>
                </div>
                </div>
            </div>
        </section>

        <!-- Danh sách phòng -->
        <section class="danh-sach-phong mgt-80">
            <div class="container">
                <div class="title-section mgb-32">
                    <p>Danh sách phòng</p>
                </div>
                <div class="body">
                    <div class="row g-3">
                    	<?php
				if(!empty($tmpVariable['data']['HotelManmo']['listTypeRoom'])){ 
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
                                                       <!--  <span class="badge badge-discount">-25%</span>
                                                        <div class="mt-3">
                                                            <del>1.411.574 đ</del>
                                                        </div> -->
                                                        <div class="price mb-3">
                                                            <?php echo number_format($value['TypeRoom']['ngay_thuong']['gia_ngay']) ?> đ
                                                        </div>
                                                        <div class="button">
                                                        	 <?php if(!empty($infoUser)){  ?>
																<a href="" class="btn button-submit-custom" data-bs-toggle="modal" data-bs-target="#modal-book-room">Đặt phòng</a>
															<?php }else{ ?>	
																<a href="/login" class="btn button-submit-custom" >Đặt phòng</a>
															<?php } ?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php   }
	                        }
	                    ?>

                    </div>
                </div>
            </div>
        </section>

        <!-- Địa điểm xung quanh -->
        <section id="place-around-section" class="mgt-80">
            <div class="container">
                <div class="title-section mgb-32">
                    <p>Khách sạn xung quang</p>
                </div>

                <div class="place-around-slide">
                	<?php if(!empty($data['HotelManmo']['otherData'])){ 
                		foreach ($data['HotelManmo']['otherData']as $value){
                		?>
                    <div class="place-around-slide-item">
                        <div class="place-around-img">
                            <a href="<?php echo $value['Hotel']['slug'] ?>"><img src="<?php echo $value['Hotel']['imageDefault'] ?>" alt=""></a>
                        </div>


                        <div class="place-around-title">
                            <a href="<?php echo $value['Hotel']['slug'] ?>"><?php echo $value['Hotel']['name'] ?></a>
                        </div>

                        <div class="place-around-box-address">
                            <div class="place-around-address">
                                <p><?php echo $value['Hotel']['address'] ?></p>
                            </div>
                            <?php if (!empty(@$data['HotelManmo']['data']['Hotel']['coordinates_x']) & !empty($data['HotelManmo']['data']['Hotel']['coordinates_y']) & !empty($value['Hotel']['coordinates_x']) & !empty($value['Hotel']['coordinates_y'])){
                                $distance = distance($data['HotelManmo']['data']['Hotel']['coordinates_x'], $data['HotelManmo']['data']['Hotel']['coordinates_y'], $value['Hotel']['coordinates_x'], $value['Hotel']['coordinates_y']);
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

 $comment= getComment($data['HotelManmo']['data']['Hotel']['id'],'khach_san'); 
        if(!empty($comment)){ ?>
        <section id="place-post-comment">
            <div class="container">
                <div class="row">
                    <div class="title-post-comment">
                        <p>Tất cả các bài đánh giá </p>
                    </div>
                <?php
                    foreach($comment as $key => $value){
                        if(empty($value)){?>
                            <style type="text/css">
                                #place-post-comment{
                                    display: none;
                                }
                            </style>
                        <?php }
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
        <a href="/chi_tiet_nha_hang/<?php echo $data['HotelManmo']['data']['Hotel']['slug'] ?>.html" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">
        <p>Bạn đặt phòng thành công.</p>
      </div>
      <div class="modal-footer">
       
        <a href="/chi_tiet_nha_hang/<?php echo $data['HotelManmo']['data']['Hotel']['slug'] ?>.html" type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
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
        <a href="/chi_tiet_khach_san/<?php echo $data['HotelManmo']['data']['Hotel']['slug'] ?>.html" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">
        <p>Bạn đặt phòng không thành công.</p>
      </div>
      <div class="modal-footer">
       
        <a href="/chi_tiet_khach_san/<?php echo $data['HotelManmo']['data']['Hotel']['slug'] ?>.html" type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
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
				        <input type="hidden" value="<?php echo $data['HotelManmo']['data']['Hotel']['id'] ;?>" name="idhotel">
                        <input type="hidden" value="<?php echo @$infoUser['id'];?>" name="idcustomer">
                        <input type="hidden" value="<?php echo $data['HotelManmo']['data']['Hotel']['slug']; ?>" name="urlSlug">
		
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
					<div class="col-md-6">
						<p>Hình thức nghỉ</p>
						<select name="type_register" class="form-control" id="type_register" onchange="tinhphi();">
							<option value=""  class="form-control" data-imagesrc="">Hình thức nghỉ </option>
                            <option value="gia_theo_gio" data-imagesrc="">Nghỉ giờ</option>
                            <option value="gia_theo_dem" data-imagesrc="">Nghỉ đêm</option>
                            <option value="gia_theo_ngay" data-imagesrc="">Nghỉ ngày</option>
						</select>
					</div>
					<div class="col-md-6">
						<p>Loại phòng</p>
						<select name="typeRoom" class="form-control" id="typeRoom" onchange="tinhphi();">
							<option  class="form-control" value="">Chọn loại phòng</option>
							<?php if (!empty($tmpVariable['data']['HotelManmo']['listTypeRoom'])){
									foreach($tmpVariable['data']['HotelManmo']['listTypeRoom'] as $keytype => $typeRoom){?>
										<option value="<?php echo $typeRoom['TypeRoom']['id'] ?>"><?php echo $typeRoom['TypeRoom']['roomtype'] ?></option>

							<?php }} ?>
								
						</select>
					</div>
					<div class="col-md-6">
						<p>Số người</p>
						<input type="number" name="number_people" class="input_date form-control" id="number_people"  required=""  value="" min="1" >
					</div>
					<div class="col-md-6">
						<p>Số phòng</p>
						<input type="number" name="number_room" class="input_date form-control" id="number_room" required="" value="" min="1" onchange="tinhphi();">
					</div>
					<div class="col-md-6">
						<p>Thời gian dự kiến</p>
						<input type="text" name="timePay" class="input_date form-control" id="timePay" value="" required="" disabled="" placeholder="Thời gian ở">
					</div>
					<div class="col-md-6">
						<p>Chi phí dự kiến</p>
						<input type="text" name="pricepay" class="input_date form-control" id="pricePay" value="" required=""  disabled="" placeholder="Chi phí dự kiến">
                        <input type="hidden" name="pricepay1" class="input_date form-control" id="pricePay1" value=""  placeholder="Chi phí dự kiến">
					</div>
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
<script>
    var keyManMo= '5dc8f2652ac5db08348b4567';
    var priceRoom= [];
    var numberDay= 0;
    var numberHours= 0;

    priceRoom["gia_theo_gio"]= [];
    priceRoom["gia_theo_ngay"]= [];
    priceRoom["gia_qua_dem"]= [];
</script>

<script type="text/javascript">
    date = 0;
    time = 0;
    

   function tinhthoigian()
   {
    var date_start= $('#date_start').val();
    var date_end= $('#date_end').val();



    if(date_start!='' && date_end!=''){
        var resStart = date_start.split(" ");
        var resEnd = date_end.split(" ");
        var today = new Date();

        date_start= resStart[0];
        date_end= resEnd[0];

        time_starts = resStart[1]
        time_ends = resEnd[1]


        var time_start = resStart[1].split(":");
        var time_end = resEnd[1].split(":");



        //console.log(date_start);

        var date_start_splitted = date_start.split("/", 3);
        var date_end_splitted = date_end.split("/", 3);

        //console.log(date_start_splitted);

        var time1 = new Date(date_start_splitted[2], date_start_splitted[1]-1, date_start_splitted[0], time_start[0], time_start[1]);
        var time2 = new Date(date_end_splitted[2], date_end_splitted[1]-1, date_end_splitted[0], time_end[0], time_end[1]);

        var date1 = new Date(date_start_splitted[2], date_start_splitted[1]-1, date_start_splitted[0], 0,0);
        var date2 = new Date(date_end_splitted[2], date_end_splitted[1]-1, date_end_splitted[0], 0, 0);


        var ngay= Math.ceil((date2.getTime() - date1.getTime())/86400000);

        var timePay= ngay+ ' ngày';
        date =ngay;

        //console.log('a'+timePay);

        if(ngay==0){
            numberHours= Math.ceil((time2.getTime() - time1.getTime())/3600000);
            timePay= numberHours+' giờ';
            time = numberHours;
        }

        $('#timePay').val(timePay);





        if(ngay>1){
            $('#type_register').html('<select class="required ddslick form-control" id="type_register" name="type_register"  onchange="tinhphi();"><option value="gia_theo_ngay">Nghỉ theo ngày</option></select>'); 
            numberDay= ngay;
            numberHours= 0;
            //console.log('ngày: '+numberDay);
        }else if(ngay==1){
            $('#type_register').html('<select class="required ddslick form-control" id="type_register" name="type_register"  onchange="tinhphi();"><option value="gia_theo_ngay">Nghỉ theo ngày</option><option value="gia_qua_dem">Nghỉ qua đêm</option></select>');
            numberDay= 1;
            numberHours= 0;
            //console.log('ngày: '+numberDay);
       /* }else if(ngay < 1){
        	alert('Ngày check Out không hợp lệ vui lòng nhập lại');*/
        }else{
            $('#type_register').html('<select class="required ddslick form-control" id="type_register" name="type_register"  onchange="tinhphi();"><option value="gia_theo_gio">Nghỉ theo giờ</option></select>');
            numberHours= Math.ceil((time2.getTime() - time1.getTime())/3600000);
            numberDay= 0;
            //console.log('giờ: '+numberHours);
        }

        $('#textNumberDate').val(ngay);


    }else{
        $('#timePay').val('Chưa xác định');
        $('#textNumberDate').val('Chưa xác định');
    }
}

/*function cancel(){
    $('#number_people').val('');
    $('#number_room').val('');
    $('#email').val('');
    $('#phone').val('');
    $('#typeRoom').val('');
    $('#name').val('');
    $('#date_start').val('');
    $('#date_end').val('');
    $('#type_register').val('');
    $('#timePay').val('');
    $('#pricePay').val('');

}*/


function tinhphi()
{

    var typePay= $('#type_register').val();
    var number_room= parseInt($('#number_room').val());
    var showPriceDate= 'Chưa xác định';
    var typeRoom= $('#typeRoom').val();
    var priceDate= 0;
    var price= 0;
    var giagio = 0;
    var giadem= 0;
    var giangay = 0;
    var discount= parseInt($('#discount').val());
    var number_rooms= $('#number_room').val();
    var allprice = [];
    // console.log(typePay);  
    // console.log("-------------");  

   
    <?php  
    if(!empty($tmpVariable['data']['HotelManmo']['listTypeRoom'])) {
        foreach($tmpVariable['data']['HotelManmo']['listTypeRoom'] as $ros) { ?>
        allprice['<?php echo $ros['TypeRoom']['id']; ?>']=['<?php echo $ros['TypeRoom']['id']; ?>',<?php echo $ros['TypeRoom']['ngay_thuong']['gia_ngay']; ?>,<?php echo $ros['TypeRoom']['ngay_thuong']['gia_qua_dem']; ?>,<?php echo $ros['TypeRoom']['ngay_thuong']['gia_ngay']; ?>,<?php echo $ros['TypeRoom']['ngay_thuong']['phu_troi_them_khach']; ?>];

    <?php }
    }
    ?>

   	 console.log(allprice[typeRoom]);  
   	 console.log(time);
   	 console.log((time-2)*allprice[typeRoom][4]);

   if(allprice[typeRoom][0]==typeRoom){

    if(typePay=='gia_theo_gio'){
        if(time<3){
           showPriceDate = allprice[typeRoom][1];
       }else{
        showPriceDate = ((allprice[typeRoom][1]) + ((time-2)*allprice[typeRoom][4]))*number_rooms;
    }

}else if(typePay=='gia_qua_dem'){
   showPriceDate =  allprice[typeRoom][2]*number_rooms;

}else if(typePay=='gia_theo_ngay'){
   showPriceDate = (allprice[typeRoom][3]* date)*number_rooms;

}
}

$('#pricePay').val(showPriceDate);
$('#pricePay1').val(showPriceDate);
$('#textDeposits').val(showPriceDate);
$('#deposits').val(priceDate);
$('#price').val(price);
}

</script>

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

	<script type="text/javascript">
  function initMap() {
    var locations = [<?php 
    if (!empty(@$data)) {
        $listShowMap= array();
          if(!empty(@$data['HotelManmo']['data']['Hotel']['coordinates_x']) & !empty($data['HotelManmo']['data']['Hotel']['coordinates_y'])){
              //$content = '<a href='.$data['urlSlug'].'></a>';
              $content   = '<img src='.$data['HotelManmo']['data']['Hotel']['image'][0].' style=width:200px;height:156px;  ><br/><a href='.$data['HotelManmo']['data']['Hotel']['slug'].'>' . $data['HotelManmo']['data']['Hotel']['name']. '</a>';
              $content.='<br/>Điện thoạt: ' . $data['HotelManmo']['data']['Hotel']['phone'];
              $content.='<br/>Địa chỉ: ' . $data['HotelManmo']['data']['Hotel']['address'];

              $listShowMap[]= '["' . $content . '", ' . $data['HotelManmo']['data']['Hotel']['coordinates_x'] . ', ' . $data['HotelManmo']['data']['Hotel']['coordinates_y'] . ', "/themes/tayho360/assets/icon/lehoi.png","su_kien"]';
            }
        
        //  $listShowMap[]= '[]';
        echo implode(',', $listShowMap);
    }
    ?>];

    console.log(locations);


      var lat = <?php echo $data['HotelManmo']['data']['Hotel']['coordinates_x'] ?>;
      var log = <?php echo $data['HotelManmo']['data']['Hotel']['coordinates_y'] ?>;

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
<?php if (!empty($infoUser)){ ?>

<script  type="text/javascript">
    
    function addlike(){
         

       $.ajax({
            method: 'POST',
            url: '/apis/addlike',
            data: { idobject: '<?php echo @$data['HotelManmo']['data']['Hotel']['id']; ?>',
                tiype: 'khach_san',
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
                data: { idobject: '<?php echo @$data['HotelManmo']['data']['Hotel']['id']; ?>',
                    tiype: 'khach_san',
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
                data: { idobject: '<?php echo @$data['HotelManmo']['data']['Hotel']['id']; ?>',
                    tiype: 'khach_san',
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