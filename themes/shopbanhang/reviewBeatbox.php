<?php
getHeader();
global $urlThemeActive;
global $session;
$settinghom = setting();

 $infoUser = $session->read('infoUser');

// debug($list_product);
?>
<main>
    <section id="section-breadcrumb">
        <div class="breadcrumb-center">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active">Review sản phẩm</li>
            </ul>
        </div>
    </section>

    <div id="review">
        <div class="container">
            <div class="tab-menu">
                <ul class="nav nav-tabs">
                    <li><a class="nav-link" href="nhan_xet_tu_kol">Nhận xét từ các KOL, KOC</a></li>
                    <li><a class="nav-link active" href="khach_hang_dap_hop">Khách hàng đập hộp</a></li>
                    <li><a class="nav-link" href="review_san_pham">Review sản phẩm</a></li>
                </ul>
            </div>

            	<div class="tab-content">
                  
                    <div id="unboxing" class="tab-pane fade show active">
                        <?php if(!empty($session->read('infoUser'))){
                            $infoUser = $session->read('infoUser');
                         ?>
                        <!-- Khi đã đăng nhập -->
                        <div class="row log-in">
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <div class="title-unbox">
                                    <p>Tìm kiếm theo sản phẩm</p>
                                </div>
                                <div class="list-product-review">
                                     <?php if(!empty($list_product)){

                                        foreach($list_product as $key => $item){
                                           
                                     ?>
                                    <div class="item-slick-product">
                                        <a href="/khach_hang_dap_hop?code=<?php echo $item->code ?>">
                                            <img src="<?php echo $item->image; ?>">
                                            <p><?php echo $item->title; ?></p>
                                        </a>
                                    </div>
                                    <?php }} ?>

                                </div>
                                 <?php 
                                            if(!empty($review)){
                                              foreach($review as $k => $value){  
                                     ?>
                                        <div class="content-unbox posts">
                                            <div class="detail-unbox">
                                                <div class="avt-user">
                                                    <img src="<?php echo $value->user->avatar ?>">
                                                </div>
                                                <div class="text-detail">
                                                    <h4>
                                                        <span><?php echo $value->user->full_name ?></span> chia sẻ hình ảnh đập hộp trên Tiktok về
                                                        <span><?php echo $value->product->title ?></span>
                                                    </h4>
                                                    <!-- <div class="five-star">
                                                        <ul>
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                            <li><i class="fa-regular fa-star"></i></li>
                                                        </ul>
                                                        <p>2 ngày trước</p>
                                                    </div> -->

                                                </div>
                                                <div class="icon-product">
                                                    <img src="<?php echo $value->product->image ?>">
                                                </div>
                                            </div>
                                            <div class="image-unbox">
                                                <a href="<?php echo $value->note;  ?>" target="_blank"><img src="<?php echo $value->product->image; ?>"></a>
                                            </div>
                                            <div class="icon-interact">
                                                <?php  
                                    

                                    if(!empty($infoUser)){
                                if(empty(getLike($infoUser['id'],$value->id,'review'))){?>
            
                                <a class="like" onclick="addlike(<?php echo $value->id; ?>)"><i class="fa-regular fa-thumbs-up"></i><?php echo $value->number_like; ?></a>
                                <?php }else{
                                  
                                 ?>
                                 <a class="like" onclick="delelelike(<?php echo $value->id; ?>)"><i class="fa-regular fa-thumbs-up"></i><?php echo $value->number_like; ?></a>
                                   
                           
                                <?php }  }else{ ?>
                                        <a  class="like" href="#" ><i class="fa-regular fa-thumbs-up"></i><?php echo $value->number_like; ?></a>
                                      
                                <?php   } ?>
                                                <a class="share" onclick="addNumberShare('<?php echo $value->note ?>','<?php echo $value->id; ?>')"><i class="fa-solid fa-share"></i><?php echo $value->number_share; ?></a>
                                                <p id="id<?php echo $value->id; ?>" style="color: red;"></p>
                                            </div> 
                                        </div>
                                    <?php }} ?>

                                <!-- <div class="icon-loading">
                                    <i class="fa-solid fa-spinner"></i>
                                </div> -->
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="share-link">
                                    <div class="title-share-link">
                                        <h4>Chia sẻ link đập hộp</h4>
                                        <p>Để được nhận
                                            <span>voucher 50K cho đơn từ 0đ</span>
                                        </p>
                                    </div>

                                    <div class="content-share-link">
                                        <div class="info-user-box">

                                            <div class="infor-user">
                                                <img src="<?php echo $infoUser->avatar ?>">
                                                <p><?php echo $infoUser->full_name ?></p>
                                            </div>
                                            <p id="mess"></p>
                                        </div>
                                       
                                        <div class="input-link">
                                            <input type="text" id="note" placeholder="Chia sẻ link đập hộp tại đây">
                                            <div class="btn-submit">
                                                <button onclick="addReview()">Chia sẻ</button>
                                            </div>
                                        </div>
                                        <div class="detail-share-link">
                                            <p>Những lưu ý cần biết để nhận thưởng voucher 50k:</p>
                                            <ul>
                                                <li>Video hợp lệ là video được đăng tải ở chế độ công khai trên ứng dụng TikTok hoặc bất cứ ứng dụng.</li>
                                                <li>Chỉ ghi nhận 1 video đập hộp cho mỗi đơn hàng .</li>
                                                <li>Sau khi đăng tải Video và thực hiện đúng yêu cầu trên, dán link video vào mục "chia sẻ link video đập hộp".</li>
                                                <li>Đội ngũ Bumas sẽ
                                                    <span>kiểm duyệt video trong vòng 48 giờ</span> làm việc (không tính Chủ nhật). Nếu đạt yêu cầu, bạn sẽ được
                                                    <span>nhận ngay voucher 50k</span> vào kho voucher của bạn.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <!-- Khi chưa đăng nhập -->
                        <div class="row log-in">
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <div class="title-unbox">
                                    <p>Tìm kiếm theo sản phẩm</p>
                                </div>
                                <div class="list-product-review">
                                     <?php if(!empty($list_product)){
                                        foreach($list_product as $key => $item){
                                     ?>
                                    <div class="item-slick-product">
                                        <a href="/san-pham/<?php echo $item->slug ?>">
                                            <img src="<?php echo $item->image; ?>">
                                            <p><?php echo $item->title; ?></p>
                                        </a>
                                    </div>
                                    <?php }} ?>

                                </div>
                                 <?php 
                                     if(!empty($review)){
                                              foreach($review as $k => $value){ 
                                                   
                                     ?>
                                        <div class="content-unbox posts">
                                            <div class="detail-unbox">
                                                <div class="avt-user">
                                                    <img src="<?php echo $value->user->avatar ?>">
                                                </div>
                                                <div class="text-detail">
                                                    <h4>
                                                        <span><?php echo $value->user->full_name ?></span> chia sẻ hình ảnh đập hộp trên Tiktok về
                                                        <span><?php echo $value->product->title ?></span>
                                                    </h4>
                                                    <!-- <div class="five-star">
                                                        <ul>
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                            <li><i class="fa-regular fa-star"></i></li>
                                                        </ul>
                                                        <p>2 ngày trước</p>
                                                    </div> -->

                                                </div>
                                                <div class="icon-product">
                                                    <img src="<?php echo $value->product->image ?>">
                                                </div>
                                            </div>
                                            <div class="image-unbox">
                                                <a href="<?php echo $value->note;  ?>" target="_blank"><img src="<?php echo $value->image; ?>"></a>
                                            </div>
                                             <div class="icon-interact">
                                                 <a  class="like" href="#"  data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa-regular fa-thumbs-up"></i><?php echo $value->number_like; ?></a>
                                                
                                                <a class="share"  data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-share"></i><?php echo $value->number_share; ?></a>
                                            </div>
                                        </div>
                                    <?php }}

                                     ?>

                                <!-- <div class="icon-loading">
                                    <i class="fa-solid fa-spinner"></i>
                                </div> -->
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="title-share-link">
                                    <h4>Chia sẻ link đập hộp</h4>
                                    <p>Để được nhận
                                        <span>voucher 50K cho đơn từ 0đ</span>
                                    </p>
                                </div>

                                <div class="content-share-link">

                                    <div class="input-link">
                                        <input type="text" placeholder="Chia sẻ link đập hộp tại đây">
                                        <div class="btn-submit">
                                            <button data-bs-toggle="modal" data-bs-target="#exampleModal" >Chia sẻ</button>
                                        </div>
                                    </div>
                                    <div class="detail-share-link">
                                        <p>Những lưu ý cần biết để nhận thưởng voucher 50k:</p>
                                        <ul>
                                            <li>Video hợp lệ là video được đăng tải ở chế độ công khai trên ứng dụng TikTok hoặc bất cứ ứng dụng.</li>
                                            <li>Chỉ ghi nhận 1 video đập hộp cho mỗi đơn hàng .</li>
                                            <li>Sau khi đăng tải Video và thực hiện đúng yêu cầu trên, dán link video vào mục "chia sẻ link video đập hộp".</li>
                                            <li>Đội ngũ Bumas sẽ
                                                <span>kiểm duyệt video trong vòng 48 giờ</span> làm việc (không tính Chủ nhật). Nếu đạt yêu cầu, bạn sẽ được
                                                <span>nhận ngay voucher 50k</span> vào kho voucher của bạn.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</main>
<script type="text/javascript">
    function addReview(){
        var note = $('#note').val();
          var html = "";

           var modalemailSubscribe =  document.getElementById("modalemailSubscribe");
    var addClass =  document.getElementById("addClass");
        $.ajax({
                method: 'GET',
                url: '/apis/addReview',
                data: { note: note },
                success:function(res){
                  console.log(res);
                    if(res.code==1){
                        html += '<p class="text-success">Bạn chia sẻ thành công đang chờ duyệt</p>';
                         
                    }else{
                         html += '<p class="text-danger">Bạn chia sẻ không thành công</p>';
                          
                    }
                    document.getElementById("messSubscribe").innerHTML = html;
                modalemailSubscribe.style.display = 'block';
                modalemailSubscribe.classList.add("show");
                addClass.classList.add("show");
                addClass.classList.add("modal-backdrop");
                addClass.classList.add("fade");
                }
            });
        
    }

function addlike(id){
    $.ajax({
            method: 'POST',
            url: '/apis/addlike',
            data: { idobject: id,
                type: 'review',
                idcustomer: <?php echo @$infoUser['id'] ?>,
            },
            success:function(res){
              console.log(res);
               
                 location.reload();
            }
        })
            
}
function delelelike(id){

          $.ajax({
                method: 'POST',
                url: '/apis/delelelike',
                data: { idobject: id,
                    type: 'review',
                    idcustomer: <?php echo @$infoUser['id'] ?>,
                },
                success:function(res){
                  console.log('res');
                    
                     location.reload();
                }
            })
               
}
function addNumberShare(textCopy, messId){
    var modalemailSubscribe =  document.getElementById("modalemailSubscribe");
    var addClass =  document.getElementById("addClass");
    $.ajax({
            method: 'POST',
            url: '/apis/addNumberShare',
            data: { id: messId},
            success:function(res){
              console.log(res);
               // Create a "hidden" input
                var aux = document.createElement("input");

                // Assign it the value of the specified element
                aux.setAttribute("value", textCopy);

                // Append it to the body
                document.body.appendChild(aux);

                // Highlight its content
                aux.select();

                // Copy the highlighted text
                document.execCommand("copy");

                // Remove it from the body
                document.body.removeChild(aux);

               /* // show mess
                $('#id'+messId).html('Đã sao chép link');

                const element = document.getElementById("idbutton"+messId);
                element.remove();

                setInterval(emptyMess, 3000,messId);*/

                 document.getElementById("messSubscribe").innerHTML = 'Đã sao chép link';
                modalemailSubscribe.style.display = 'block';
                modalemailSubscribe.classList.add("show");
                addClass.classList.add("show");
                addClass.classList.add("modal-backdrop");
                addClass.classList.add("fade");
                
                
            }
        })
            
}
</script>
<?php
getFooter();?>

