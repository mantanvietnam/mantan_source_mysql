<?php
getHeader();
global $urlThemeActive;
?>
 <main>
        <section id="section-banner-home">
            <div class="banner-home-slide">
               <?php if(!empty($slide_home->imageinfo)){
                        foreach($slide_home->imageinfo as $key => $item){ ?>
                <div class="banner-home-item">
                    <img src="<?php echo $item->image ?>" alt="">
                </div>
            <?php }} ?>
               
            </div>
        </section>
        
        <section id="section-advertisement-home">
            <div class="advertisement-home-inner">
                <div class="container-fluid">
                    <div class="row">
                        <div class="advertisement-home-item col-lg-4 col-md-4 col-sm-4 col-12">
                            <img src="<?php echo @$setting['image1'] ?>" alt="">
                        </div>
            
                        <div class="advertisement-home-item col-lg-4 col-md-4 col-sm-4 col-12">
                            <img src="<?php echo @$setting['image2'] ?>" alt="">
                        </div>
            
                        <div class="advertisement-home-item col-lg-4 col-md-4 col-sm-4 col-12">
                            <img src="<?php echo @$setting['image3'] ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Flash sale -->
        <section id="section-flash-sale">
            <div class="container">
                <div class="section-flash-sale-inner">
                    <div class="flash-sale-title">
                        <p>Flash Sale - Deal chớp nhoáng</p>
                    </div>
                    <div class="flash-sale-link">
                        <a href="">Xem chi tiết</a>
                    </div>
                    <div class="time-flash-sale" id="countdown">
                        
                    </div>

                    <div class="list-product">
                        <div class="row">
                            <?php if(!empty($product_flasl)){ 
                                foreach($product_flasl as $key => $item){
                                     $giam = 0;
                                    if(!empty($item->price_old) && !empty($item->price)){
                                        $giam = 100 - 100*$item->price/$item->price_old;
                                    }

                                    $ban = 0;
                                    if(!empty($item->quantity) && !empty($item->sold)){
                                        if($item->quantity>$item->sold){
                                            $ban = 100*$item->sold/$item->quantity;
                                        }
                                    }
                                ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-6 best-sale-item">
                                <div class="best-sale-item-inner">
                                    <div class="ribbon ribbon-top-right"><span><?php echo number_format($giam) ?>%</span></div>
                                    <div class="best-sale-img">
                                        <a href="product/<?php echo $item->slug ?>.html"><img src="<?php echo $item->image ?>" alt=""></a>
                                    </div>
        
                                    <div class="best-sale-info">
                                        <div class="best-sale-name">
                                            <a href="product/<?php echo $item->slug ?>.html"><?php  echo $item->title ?></a>
                                        </div>
        
                                        <div class="best-sale-price">
                                            <p><?php  echo number_format($item->price); ?>đ</p>
                                        </div>

                                        <div class="best-sale-discount">
                                            <del><?php  echo number_format($item->price_old); ?>đ</del><!-- <span> (50%)</span> -->
                                        </div>
                                    </div>

                                    <div class="progress-box">
                                        <div class="best-sale-progress">
                                            <div class="text-progress">Sản phẩm <?php  echo @$item->sold; ?> Đã bán</div>
                                            <div class="sale-progress-val" style="width: <?php echo $ban; ?>%"></div>
                                        </div>
                                    </div>
        
                                    <div class="best-sale-rate">
                                        <div class="rate-best-item rate-star">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/star.png" alt="">
                                            <p><?php echo @$item->point ?><span>(<?php echo @$item->evaluatecount ?>)</span></p>
                                        </div>
        
                                        <div class="rate-best-item rate-sold">
                                            <p><?php  echo @$item->sold; ?> Đã bán</p>
                                            <img src="<?php echo $urlThemeActive ?>asset/image/heart.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }} ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Xu hướng tìm kiếm -->
        <!-- <section id="section-top-search">
            <div class="container">
                <div class="title-section">
                    <h2>Xu hướng tìm kiếm</h2>
                </div>

                <div class="top-search-slide">
                     <?php if(!empty($product_search)){ 
                                foreach($product_search as $key => $item){
                                ?>
                    <div class="top-serach-item">
                        <div class="top-serach-item-inner">
                            <div class="top-search-item-image">
                                <img src="<?php echo $item->image ?>" alt="">
                            </div>
                            <a href="product/<?php echo $item->slug ?>.html" class="name-top-search"><?php echo $item->title ?></a>
                        </div>
                    </div>

                    <?php }} ?>

                </div>
            </div>
 

        </section> -->

        <!-- Bán chạy nhất -->
        <div id="section-best-sale">
            <div class="container">
                <div class="title-section">
                    <h2>Sản phẩm bán chạy</h2>
                </div>

                <div class="best-sale-list">
                    <div class="best-sale-list-inner">
                        <div class="row">
                            <?php if(!empty($product_sold)){ 
                                foreach($product_sold as $key => $item){
                                    $ban = 0;
                                    if(!empty($item->quantity) && !empty($item->sold)){
                                        $ban = 100 - 100*$item->sold/$item->quantity;
                                    }
                                ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-6 best-sale-item">
                                <div class="best-sale-item-inner">
                                    <div class="best-sale-img">
                                        <a href="product/<?php echo $item->slug ?>.html"><img src="<?php echo $item->image ?>" alt=""></a>
                                    </div>
        
                                    <div class="best-sale-info">
                                        <div class="best-sale-name">
                                            <a href="product/<?php echo $item->slug ?>.html"><?php echo $item->title ?></a>
                                        </div>
        
                                        <div class="best-sale-price">
                                            <p><?php  echo number_format($item->price); ?>đ</p>
                                        </div>
        
                                        <div class="best-sale-discount">
                                            <del><?php  echo number_format($item->price_old); ?>đ</del><!-- <span> (50%)</span> -->
                                        </div>
                                    </div>
        
                                    <div class="best-sale-rate">
                                        <div class="rate-best-item rate-star">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/star.png" alt="">
                                            <p><?php echo @$item->point ?><span>(<?php echo @$item->evaluatecount ?>)</span></p>
                                        </div>
        
                                        <div class="rate-best-item rate-sold">
                                            <p><?php  echo @$item->sold; ?>  Đã bán</p>
                                            <img src="<?php echo $urlThemeActive ?>asset/image/heart.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <?php }} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chuyên mục -->
        <section id="section-home-category">
            <div class="container-fluid">
                <div class="row">
                    <div class="home-category-big col-12 ">
                        <div class="category-home-img">
                            <a href="<?php echo @$setting['link_image1'] ?>"><img src="<?php echo @$setting['image4'] ?>" alt=""></a>
                        </div>
                    </div>

                    <div class="home-category-small col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="category-home-img">
                            <a href="<?php echo @$setting['link_image2'] ?>"><img src="<?php echo @$setting['image5'] ?>" alt=""></a>
                        </div>
                    </div>

                    <div class="home-category-small col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="category-home-img">
                            <a href="<?php echo @$setting['link_image3'] ?>"><img src="<?php echo @$setting['image6'] ?>" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Banner chinh sách công ty -->
        <section id="section-banner-policy">
            <div class="container-fluid">
                <div class="banner-policy">
                    <img src="<?php echo @$setting['image7'] ?>" alt="">
                </div>
            </div>
        </section>

        <!-- Bình luận -->
        <section id="section-comment-customer">
            <div class="container">
                <div class="title-section">
                    <h2>Trải nghiệm, đánh giá từ khách hàng </h2>
                </div>

                <div class="title-section-sub">
                    <p>Những đánh giá và cảm nhận từ khách hàng sau khi sử dụng sản phẩm của Bumas</p>
                </div>
                 <?php if(!empty(showFeedback())){ ?>
                <div class="container">
                    <div class="comment-customer-slide slick">
                       <?php foreach(showFeedback() as $key => $item){ ?>
                        <div class="comment-customer-item" >
                            <div class="comment-customer-img" >
                                <img src="<?php echo @$item->avatar ?>" alt="">
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="comment-text-slide">
                        <?php foreach(showFeedback() as $key => $item){ ?>
                        <div class="comment-text-item">
                            <div class="comment-text-description">
                               <?php echo @$item->content ?>
                            </div>

                            <div class="comment-text-name">
                                <?php echo @$item->full_name ?>
                            </div>

                            <div class="comment-text-position">
                                <?php echo @$item->position ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                </div>
            <?php } ?>
            </div>
        </section>

        <!-- Báo chí nói gì về bumas -->
        <section id="section-tell">
            <div class="container-fluid">
                <div class="row">
                    <div class="title-section">
                        <h2>Báo chí nói gì về Bumas</h2>
                    </div>

                    <div class="news-tell">
                         <?php if(!empty($news->imageinfo)){
                        foreach($news->imageinfo as $key => $item){ ?>
                         <div class="news-tell-item">
                            <img src="<?php echo $item->image; ?>" alt="">
                        </div>
                    <?php }} ?>
                        
                    </div>
                </div>
            </div>
        </section>
    </main>
<script>
    function updateCountdown() {
      // Thời gian bạn muốn đếm ngược đến (ví dụ: 2023-12-31 23:59:59)
     
      <?php if(!empty(@@$setting['targetTime'])){?>
        const targetTime = new Date("<?php echo date('Y-m-d H:i:s' , @@$setting['targetTime']) ?>").getTime();

    <?php }else{?>
     const targetTime = 0;
     <?php } ?>

      // Lấy thời gian hiện tại
      const currentTime = new Date().getTime();

      // Tính thời gian còn lại
      const timeLeft = targetTime - currentTime;

      if (timeLeft <= 0) {
         var html = '';
         html +='        <div class="time-flash-item">'
        html +='                    <div class="time-flash-number">'
        html +='                        <p>00</p>'
        html +='                    </div>'
        html +='                    <div class="time-flash-text">'
        html +='                        <p>Ngày</p>'
        html +='                    </div>'
        html +='                </div>'

        html +='        <div class="time-flash-item">'
        html +='                    <div class="time-flash-number">'
        html +='                        <p>00</p>'
        html +='                    </div>'
        html +='                    <div class="time-flash-text">'
        html +='                        <p>Giờ</p>'
        html +='                    </div>'
        html +='                </div>'

        html +='                <div class="time-flash-item">'
        html +='                    <div class="time-flash-number">'
        html +='                        <p>00</p>'
        html +='                    </div>'
        html +='                    <div class="time-flash-text">'
        html +='                        <p>Phút</p>'
        html +='                    </div>'
        html +='                </div>'

        html +='                <div class="time-flash-item">'
        html +='                    <div class="time-flash-number">'
        html +='                        <p>00</p>'
        html +='                    </div>'
        html +='                    <div class="time-flash-text">'
        html +='                        <p>Giây</p>'
        html +='                    </div>'
        html +='                </div>'
        document.getElementById("countdown").innerHTML = html;
      } else {
        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
        var html = '';
         html +='        <div class="time-flash-item">'
        html +='                    <div class="time-flash-number">'
        html +='                        <p>'+String(days).padStart(2, '0')+'</p>'
        html +='                    </div>'
        html +='                    <div class="time-flash-text">'
        html +='                        <p>Ngày</p>'
        html +='                    </div>'
        html +='                </div>'

        html +='        <div class="time-flash-item">'
        html +='                    <div class="time-flash-number">'
        html +='                        <p>'+String(hours).padStart(2, '0')+'</p>'
        html +='                    </div>'
        html +='                    <div class="time-flash-text">'
        html +='                        <p>Giờ</p>'
        html +='                    </div>'
        html +='                </div>'

        html +='                <div class="time-flash-item time-flash-item-center">'
        html +='                    <div class="time-flash-number">'
        html +='                        <p>'+String(minutes).padStart(2, '0')+'</p>'
        html +='                    </div>'
        html +='                    <div class="time-flash-text">'
        html +='                        <p>Phút</p>'
        html +='                    </div>'
        html +='                </div>'

        html +='                <div class="time-flash-item">'
        html +='                    <div class="time-flash-number">'
        html +='                        <p>'+String(seconds).padStart(2, '0')+'</p>'
        html +='                    </div>'
        html +='                    <div class="time-flash-text">'
        html +='                        <p>Giây</p>'
        html +='                    </div>'
        html +='                </div>'
        document.getElementById("countdown").innerHTML = html;
        //document.getElementById("countdown").innerHTML = `Còn lại:  ngày, ${hours} giờ, ${minutes} phút, ${seconds} giây`;
      }
    }

    // Cập nhật thời gian còn lại mỗi giây
    setInterval(updateCountdown, 1000);

    // Gọi hàm cập nhật ngay khi trang được tải
    updateCountdown();
  </script>
<?php
getFooter();?>