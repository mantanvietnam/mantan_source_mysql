<?php
getHeader();
global $urlThemeActive;
$setting = setting();

$slide_home= slide_home($setting['id_slide']);
?>
  <main>
        <section id="section-breadcrumb">
            <div class="breadcrumb-center">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                  <li class="breadcrumb-item"><a href="#">Blog</a></li>
                </ul>
            </div>
        </section>

        <!-- <section id="section-banner-blog">
            <div class="banner-blog">
                <img src="<?php echo $urlThemeActive ?>asset/image/background-home.png" alt="">
            </div>
        </section> -->

        <section id="section-banner-home">
            <div class="container">
                <div class="banner-home-slide">
                    <?php if(!empty($slide_home->imageinfo)){
                        foreach($slide_home->imageinfo as $key => $item){ ?>
                <div class="banner-home-item">
                    <a href="<?php echo $item->link ?>">
                    <img src="<?php echo $item->image ?>" alt="">
                    </a>
                </div>
            <?php }} ?>
                </div>
            </div>
        </section>

        <section id="section-blog-content">
            <div class="container">
                <div class="form-search-blog">
                    <form action="/search">
                        <input type="text" class="form-control" name="key" id="" placeholder="Tìm kiếm bài viết">
                        <input type="submit" style="display:none" name="">
                    </form>
                </div>

                <div class="main-blog">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-12 main-blog-left">
                        	<?php if(!empty($listDatatop)){ 
                        		foreach($listDatatop as $key => $item){
                                    $Category = getByIdCategory($item->idCategory);
                        		?>
                            <div class="main-blog-left-item">
                                <div class="main-blog-left-item-img">
                                    <a href="/<?php echo @$item->slug ?>.html"><img src="<?php echo @$item->image ?>" alt=""></a>
                                </div>
    
                                <div class="main-blog-left-item-meta">
                                    <div class="meta-date">
                                        <span><?php echo date('H:i d/m/Y', $item->time); ?></span>
                                    </div>
    
                                    <div class="meata-category">
                                        <span><?php echo @$Category->name ?></span>
                                    </div>
                                </div>
    
                                <div class="main-blog-left-title">
                                    <a href="/<?php echo @$item->slug ?>.html"><?php echo @$item->title ?></a>
                                </div>
    
                                <div class="main-blog-left-description">
                                    <?php echo @$item->description ?>
                                </div>
                            </div>
                        <?php }} ?>
                        </div>
    
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 main-blog-right">
                            <div class="main-blog-right-list">
                                <div class="main-blog-right-heading">
                                    <p>Xem nhiều nhất</p>
                                </div>
    							<?php if(!empty($listDataView)){ 
                        		foreach($listDataView as $key => $item){
                                    $Category = getByIdCategory($item->idCategory);
                        		?>
                                <div class="main-blog-right-item">
                                    <div class="row">
                                        <div class="main-blog-right-img col-5">
                                            <a href="/<?php echo @$item->slug ?>.html"><img src="<?php echo @$item->image ?>" alt=""></a>
                                        </div>
    
                                        <div class="main-blog-right-text col-7">
                                            <div class="main-blog-right-category">
                                                <span><?php echo @$Category->name ?></span>
                                            </div>
                                            <div class="main-blog-right-title">
                                                <a href="/<?php echo @$item->slug ?>.html"><?php echo @$item->title ?></a>
                                            </div>
                                            <div class="main-blog-right-meta">
                                                <span><?php echo date('H:i d/m/Y', $item->time); ?>	</span>
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
        </section>

        <section id="section-blog-new">
            <div class="container">
                <div class="section-blog-new-inner">
                    <div class="title-section">
                        <p>Bài viết mới nhất</p>
                    </div>
                    <div class="blog-new-slide">
                        <?php if(!empty($listDataNew)){ 
                        		foreach($listDataNew as $key => $item){
                                    $Category = getByIdCategory($item->idCategory);
                        		?>
                        <div class="blog-slide-item">
                            <div class="blog-slide-title">
                                <a href="/<?php echo @$item->slug ?>.html"><?php echo @$item->title ?></a>
                            </div>
    
                            <div class="blog-slide-meta">
                                <p class="blog-slide-date"><?php echo date('H:i d/m/Y', $item->time); ?>	</p>
                                <p class="blog-slide-category"><?php echo @$Category->name ?></p>
                            </div>
    
                            <div class="blog-slide-image">
                                <a href="/<?php echo @$item->slug ?>.html"><img src="<?php echo @$item->image ?>" alt=""></a>
                            </div>
                        </div>
                        <?php }} ?>
                      
                    </div>
                </div>
            </div>
        </section>

        <section id="section-blog-col">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 blog-col-item blog-col-item-left">
                        <div class="title-section">
                            <p><?php echo $Category1 ?></p>
                        </div>
    
                        <div class="list-blog-col">
                            <?php if(!empty($listDataCategory1)){ 
                        		foreach($listDataCategory1 as $key => $item){
                                    $Category = getByIdCategory($item->idCategory);
                        		?>
                            <div class="list-blog-item">
                                <div class="row">
                                    <div class="list-blog-col-img col-6">
                                        <div class="list-blog-col-img-inner">
                                            <a href="/<?php echo @$item->slug ?>.html"><img src="<?php echo @$item->image ?>" alt=""></a>
                                        </div>
                                    </div>
        
                                    <div class="list-blog-col-text col-6">
                                        <div class="list-blog-col-category">
                                            <span><?php echo @$Category->name ?></span>
                                        </div>
                                        <div class="list-blog-col-title">
                                            <a href="/<?php echo @$item->slug ?>.html"><?php echo @$item->title ?></a>
                                        </div>
                                        <div class="list-blog-col-meta">
                                            <span><?php echo date('H:i d/m/Y', $item->time); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 blog-col-item blog-col-item-right">
                        <div class="title-section">
                            <p><?php echo $Category2 ?></p>
                        </div>
    
                        <div class="list-blog-col">
                            <?php if(!empty($listDataCategory2)){ 
                        		foreach($listDataCategory2 as $key => $item){
                                    $Category = getByIdCategory($item->idCategory);
                        		?>
                            <div class="list-blog-item">
                                <div class="row">
                                    <div class="list-blog-col-img col-6">
                                        <div class="list-blog-col-img-inner">
                                            <a href="/<?php echo @$item->slug ?>.html"><img src="<?php echo @$item->image ?>" alt=""></a>
                                        </div>
                                    </div>
        
                                    <div class="list-blog-col-text col-6">
                                        <div class="list-blog-col-category">
                                            <span><?php echo @$Category->name ?></span>
                                        </div>
                                        <div class="list-blog-col-title">
                                            <a href="/<?php echo @$item->slug ?>.html"><?php echo @$item->title ?></a>
                                        </div>
                                        <div class="list-blog-col-meta">
                                            <span><?php echo date('H:i d/m/Y', $item->time); ?></span>
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

        <section id="section-blog-last">
            <div class="blog-last-inner">
                <div class="container">
                    <div class="row">
                         <?php if(!empty($listDataPost)){ 
                        		foreach($listDataPost as $key => $item){
                                    $Category = getByIdCategory($item->idCategory);
                        		?>
                        <div class="blog-last-item col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="blog-last-title">
                                <a href="/<?php echo @$item->slug ?>.html"><?php echo @$item->title ?></a>
                            </div>

                            <div class="blog-last-meta">
                                <p class="blog-last-date"><?php echo date('H:i d/m/Y', $item->time); ?></p>
                                <p class="blog-last-category"></p>
                            </div>

                            <div class="blog-last-image">
                                <a href="/<?php echo @$item->slug ?>.html"><img src="<?php echo @$item->image ?>" alt=""></a>
                            </div>
                        </div>
                        <?php }} ?>
                       
                    </div>
                </div>
            </div>
        </section>

        <section id="section-blog-contact">
            <div class="container">
                <div class="title-section">
                    <h2>Đăng ký để nhận bản tin</h2>
                </div>

                <div class="title-section-sub">
                    <p>Để cập nhập những tin tức về sức khỏe, làm đẹp,.. và những ưu đãi đặc biệt sớm nhất</p>
                </div>

                <div class="form-blog-contact">
                        <div class="input-blog-contact">
                            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                            <input type="email" name="email" id='emailSubscribenew' class="form-control" placeholder="Nhập email của bạn" required>
                            <button onclick="addSubscribenew()"; class="btn btn-primary">Đăng ký</button>
                        </div>
                </div>
            </div>
        </section>
    </main>
    <script type="text/javascript">
        
function addSubscribenew(){
        var email = $('#emailSubscribenew').val();
          console.log(code);
        var modalemailSubscribe =  document.getElementById("modalemailSubscribe");
        var addClass =  document.getElementById("addClass");


       
        $.ajax({
            method: "POST",
            data:{email: email,
                },
            url: "/apis/addSubscribeAPI",
        })
        .done(function(msg) {
            console.log(msg);
                document.getElementById("messSubscribe").innerHTML = msg.mess;
                modalemailSubscribe.style.display = 'block';
                modalemailSubscribe.classList.add("show");
                addClass.classList.add("show");
                addClass.classList.add("modal-backdrop");
                addClass.classList.add("fade");

           
        });
    }
    </script>
<?php
getFooter();?>